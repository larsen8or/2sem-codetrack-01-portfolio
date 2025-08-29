<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controller;
use App\Dto\ContactFormDto;
use App\Http\Request;
use App\Http\Response;
use App\Repositories\MessageRepository;
use App\Security\RateLimiter;
use App\Services\MailService;

/**
 * Handles the contact form display and form submission.
 */
class ContactController extends Controller
{
    private RateLimiter $limiter;

    public function __construct()
    {
        $this->limiter = new RateLimiter(
            maxAttempts: 5, // 5 attempts allowed
            decayMinutes: 5, // within 5 minutes
            sessionKey: 'contact_attempts'
        );
    }

    /**
     * Show the contact form page with any flash messages from previous submissions.
     */
    public function index(Request $request): Response
    {
        $response = new Response();
        $response->setTemplate($this->template, 'contact', [
            ...$this->pullFlash($response),
            'request' => $request,
        ]);
        return $response;
    }

    /**
     * Handle the contact form submission.
     * Validates the input and redirects back with success or error messages.
     */
    public function post(Request $request): Response
    {
        $response = new Response();

        // Check CSRF token
        if (!$request->validateCsrfToken()) {
            return $this->handleInvalidRequest(
                $response, 
                'Invalid security token',
                $request->getAll(),
            );
        }

        // Check rate limiting
        if ($this->isRateLimited()) {
            return $this->handleInvalidRequest(
                $response,
                'Too many attempts. Please try again later.',
                $request->getAll(),
            );
        }

        $contactForm = ContactFormDto::fromRequest($request);
        $errors = $contactForm->validate();

        if (!empty($errors)) {
            $this->flashErrors($response, $errors);
            $this->flashOldInput($response, $contactForm->toArray());
            $response->redirect('/contact');
            return $response;
        }

        try {
            // Save the contact form data
            $repository = new MessageRepository();
            $repository->create(
                name: $contactForm->name,
                email: $contactForm->email,
                subject: $contactForm->subject,
                message: $contactForm->message
            );

            // Send email notification
            $this->sendNotificationEmail($contactForm);

            $this->flashSuccess($response, $contactForm->name);
        } catch (\Exception $e) {
            // Log the error (you might want to implement proper logging)
            error_log('Error processing contact form: ' . $e->getMessage());
            $response->setFlash('error', 'There was an error processing your request. Please try again later.');
        }
        $response->redirect('/contact');
        return $response;
    }

    /**
     * Flash success message to session.
     */
    private function flashSuccess(Response $response, string $name): void
    {
        $response->setFlash('success', "Thank you for contacting us, {$name}!");
    }

    /**
     * Check if the request is rate limited.
     */
    private function isRateLimited(): bool
    {
        if ($this->limiter->tooManyAttempts('contact')) {
            return true;
        }

        $this->limiter->hit('contact');
        return false;
    }
    
    /**
     * Send email notification about the new contact form submission.
     */
    private function sendNotificationEmail(ContactFormDto $contactForm): void
    {
        $mailer = new MailService();
        
        $subject = "New Contact Form Submission: {$contactForm->subject}";
        $message = "You have received a new message from your website contact form.\n\n"
            . "Name: {$contactForm->name}\n"
            . "Email: {$contactForm->email}\n"
            . "Subject: {$contactForm->subject}\n"
            . "Message:\n{$contactForm->message}";
            
        $mailer->setSubject($subject)
               ->setMessage($message)
               ->setFrom($contactForm->email, $contactForm->name)
               ->send();
    }
}
