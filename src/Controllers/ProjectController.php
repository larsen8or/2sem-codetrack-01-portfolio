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
                code: 'https://github.com/madh-zealand/2sem-codetrack-01-portfolio',
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
                link: 'https://beyondkick.com/interview/exclusive-interview-jackie-buntan-ahead-of-one-on-prime-video-5/',
            )
        ];
    }
}
