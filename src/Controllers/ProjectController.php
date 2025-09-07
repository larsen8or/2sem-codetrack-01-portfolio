<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controller;
use App\Dto\ProjectDto;
use App\Http\Request;
use App\Http\Response;

/**
 * Controller for handling requests to the projects page.
 *
 * Provides actions for rendering the projects page with a list of projects.
 */
class ProjectController extends Controller
{
    /**
     * Show the projects page.
     * Renders the 'projects' view with a list of projects.
     *
     * @param Request $request The current HTTP request instance.
     * @return Response
     */
    public function index(Request $request): Response
    {
        $response = new Response();
        $response->setTemplate(
            $this->template,
            'projects',
            [
                ...$this->pullFlash(
                    $response
                ),
                'request' => $request,
                'projects' => $this->getProjects(),
            ],
        );
        return $response;
    }

    /**
     * Get list of projects to display.
     *
     * @return array<int, ProjectDto>
     */
    private function getProjects(): array
    {
        return [
            new ProjectDto(
                title: 'Turning Design Into Digital Awareness',
                description: 'How do you guide young minds through the ethical
                maze of AI? This project blends behavioral insight, UX strategy
                , and multi-audience design to create a platform that informs,
                 engages, and empowers. A top-graded exam case with real-world
                  relevance.',
                technologies: 'HTML5, CSS3, JavaScript, Figma, Photoshop, AI',
                image: 'images/aikon.jpg',
                code: 'https://github.com/madh-zealand/2sem-codetrack-01-
                portfolio',
                link: 'https://www.aikon.nu',
            ),
            new ProjectDto(
                title: 'Search Engine Optimization (SEO)',
                description: 'Search Engine Optimization (SEO) for a fitness
                center running on WordPress. Implemented keyword research,
                on-page SEO, and technical SEO improvements. Resulted in a 40%
                increase in organic traffic and improved search rankings within
                three months.',
                technologies: 'Content Creation, SEO Tools, WordPress',
                image: 'images/SEO.gif',
                code: 'https://github.com/madh-zealand/tba',
                link: 'https://www.anytimegym.dk',
            ),
            new ProjectDto(
                title: 'Content Creation',
                description: 'Interview of ONE Championship Muay Thai fighter
                Jackie Buntan.
                 Published on Beyond Kick - the leading kickboxing and Muay Thai
                  news website.',
                technologies: 'Imagination and words',
                image: 'images/Buntan.gif',
                code: 'https://github.com/madh-zealand/tba',
                link: 'https://beyondkick.com/interview/exclusive-interview-
                jackie-buntan-ahead-of-one-on-prime-video-5/'
            ),
            new ProjectDto(
                title: 'Advanced PHP Guestbook',
                description: 'This project involved enhancing a digital guestbook
                 with a custom front-end and new back-end features.
                I began by personalizing the user interface with a custom design
                 and color scheme. I then extended its functionality by adding a
                  new input field to the form, which included implementing
                  server-side validation, updating the database schema, and
                   using cookies to remember user data. Finally, to make messages
                    more expressive, I developed a PHP function which
                    dynamically converts text-based smileys into emojis when
                    displayed, ensuring the original data in the database remains
                     unaltered.',
                technologies: 'Backend: PHP - Database: SQL - Front-end HTML5 &
                CSS3 - Client Side: Cookies',
                image: 'images/Guestbook.jpg',
                code: 'https://github.com/larsen8or/Guestbook.git',
                link: 'https://guestbook.nator.dk/',
            ),
            new ProjectDto(
                title: 'Style Swithcer',
                description: 'A custom theme extension was developed to enhance
                the flexibility and visual identity of the application. A new
                "Cyber" theme was designed, implementing unique color variables
                and button styles that integrate seamlessly with the existing
                theme system. To showcase dynamic adaptability, a styled alert
                box component was built, which automatically inherits and applies
                the active theme’s design properties, ensuring consistency across
                the interface. Additionally, functionality was added to track
                and log theme-switching activity in real time, providing valuable
                insight into user interactions. The result is a modular, scalable
                solution that strengthens brand expression while maintaining
                clean code architecture and usability.',
                technologies: 'Front-end: HTML5 for structure, CSS3 with custom
                properties for theme styling - Client-side: JavaScript (ES6) for
                dynamic theme switching, state management, and logging - Server-
                side: Not required (purely client-rendered application)',
                image: 'images/Video.mp4',
                code: 'https://github.com/larsen8or/Guestbook.git',
                link: 'https://guestbook.nator.dk/',
            )
        ];
    }
}
