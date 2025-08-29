<?php

declare(strict_types=1);

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;
use PHPMailer\PHPMailer\SMTP;

class MailService
{
    private string $to;
    private string $from;
    private string $fromName = '';
    private string $subject;
    private string $message;
    private string $smtpHost = 'smtp.one.com';
    private int $smtpPort = 465;
    private string $smtpUsername = 'noreply@larsenator.com';
    private string $smtpPassword = 'your-smtp-password';
    private string $smtpSecure = PHPMailer::ENCRYPTION_SMTPS;

    public function __construct(string $to = 'larsenator@live.com')
    {
        $this->to = $to;
        $this->from = $this->smtpUsername; // Use SMTP username as from address
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function setFrom(string $email, string $name = ''): self
    {
        $this->from = $email;
        $this->fromName = $name;
        return $this;
    }

    public function send(): bool
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = $this->smtpHost;
            $mail->Port = $this->smtpPort;
            $mail->SMTPAuth = true;
            $mail->Username = $this->smtpUsername;
            $mail->Password = $this->smtpPassword;
            $mail->SMTPSecure = $this->smtpSecure;

            // Recipients
            $mail->setFrom($this->from, $this->fromName);
            $mail->addAddress($this->to);
            $mail->addReplyTo($this->from, $this->fromName);

            // Content
            $mail->isHTML(false);
            $mail->Subject = $this->subject;
            $mail->Body = $this->message;

            $mail->send();
            return true;
        } catch (PHPMailerException $e) {
            error_log('Mailer Error: ' . $mail->ErrorInfo);
            return false;
        }
    }

    /**
     * Configure SMTP settings
     */
    public function setSmtpConfig(
        string $host,
        int $port,
        string $username,
        string $password,
        string $secure = PHPMailer::ENCRYPTION_SMTPS
    ): self {
        $this->smtpHost = $host;
        $this->smtpPort = $port;
        $this->smtpUsername = $username;
        $this->smtpPassword = $password;
        $this->smtpSecure = $secure;
        $this->from = $username; // Update from address to match SMTP username
        
        return $this;
    }
}
