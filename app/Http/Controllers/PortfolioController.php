<?php

namespace App\Http\Controllers;

class PortfolioController extends Controller
{
    public function index()
    {
        return view('portfolio', [
            'bio'      => $this->bio(),
            'skills'   => $this->skills(),
            'contacts' => $this->contacts(),
            'orgs'     => $this->orgs(),

            'stats' => [
                ['num' => '5+',   'label' => 'projects shipped'],
                ['num' => '18',   'label' => 'happy teammates'],
                ['num' => '100%', 'label' => 'satisfaction rate'],
            ],

            // Home only shows featured projects.
            'projects' => array_values(array_filter(
                $this->projects(),
                fn ($p) => $p['featured']
            )),
        ]);
    }

    public function work()
    {
        return view('work', [
            'projects' => $this->projects(),
        ]);
    }

    public function about()
    {
        return view('about', [
            'bio'      => $this->bio(),
            'skills'   => $this->skills(),
            'contacts' => $this->contacts(),
            'orgs'     => $this->orgs(),
        ]);
    }

    public function resume()
    {
        return view('resume', [
            'summary'  => $this->bio(),
            'skills'   => $this->skills(),
            'contacts' => $this->contacts(),

            'experience' => [
                [
                    'role'   => 'Core Team Member',
                    'org'    => 'Ureeka Binus',
                    'period' => 'Apr. 2024 - 2026',
                    'points' => [
                        'Organized events, hackathons, and teaching sessions.',
                        'Participated in hackathons every semester.',
                        'Led teaching and group sessions on Laravel, HTML, CSS, Flask, and Flutter.',
                    ],
                ],
                [
                    'role'   => 'Member',
                    'org'    => 'Bina Nusantara Computer Club (BNCC)',
                    'period' => 'Sep. 2023 - 2025',
                    'points' => [
                        'Studied various programming languages and UI/UX design principles.',
                        'Built backend features backed by MySQL.',
                    ],
                ],
            ],

            'education' => [
                [
                    'school'   => 'Bina Nusantara University',
                    'detail'   => 'B.Sc. in Computer Science',
                    'period'   => '2022 - 2026',
                    'location' => 'Jakarta, Indonesia',
                ],
            ],
        ]);
    }

    // `featured` controls whether a project appears on the home page's "selected work" section.

    private function projects(): array
    {
        return [
            [
                'title'    => 'This Website',
                'desc'     => 'The site you are on is a Laravel app, containerized with Docker.',
                'emoji'    => '🐳',
                'tag'      => 'Web',
                'color'    => 'blue',
                'featured' => false,
                'context'  => 'This website',
                'longDesc' => 'This website started as a single static HTML/CSS page and then refactored into a Laravel application, and then containerised so anyone can run it with one command.',
                'highlights' => [
                    'Refactored from static HTML into a Laravel app where every page is data-driven where content is in the controller and then rendered through Blade.',
                    'Multiple pages (home, work, about, resume) built on a single shared Blade layout.',
                    'Fully containerized with Docker, so it runs anywhere with one command, with no local PHP setup required.',
                    'Runs with no database (file-based sessions/cache), so it can also be exported to static hosting.',
                ],
                'stack' => ['Laravel', 'PHP 8.5', 'Blade', 'Docker', 'CSS'],
                'runnable' => true,
            ],
            [
                'title'    => '2048-in-C',
                'desc'     => '2048 game built using C.',
                'emoji'    => '🎮',
                'tag'      => 'Game',
                'color'    => 'teal',
                'featured' => true,
                'context'  => 'Data Structures coursework',
                'longDesc' => 'A terminal-based clone of the game 2048, written in C for Windows. It renders a playable board directly in the console, supports two board sizes, and keeps a persistent, ranked leaderboard between sessions.',
                'highlights' => [
                    'Selectable 4x4 or 6x6 board, with the grid allocated dynamically as a 2D array (int**) via malloc.',
                    'WASD controls with full tile-sliding and merge logic, accumulating score on every merge.',
                    'Random 2/4 tile spawning and game-over detection that checks for both empty cells and any remaining merges.',
                    'Persistent high-score table written to a file, parsed back on launch and ranked with qsort, with auto-generated player IDs.',
                    'Console menu system: New Game / High-score / Exit.',
                ],
                'stack' => ['C', 'Win32 console', 'Dynamic memory', 'File I/O', 'qsort'],
            ],
            [
                'title'    => 'MayaSense',
                'desc'     => 'An AI chat bot designed to help new students in navigating university life.',
                'emoji'    => '🤖',
                'tag'      => 'AI',
                'color'    => 'purple',
                'featured' => true,
                'context'  => 'Team project',
                'longDesc' => 'A Flask-based AI assistant chatbot that helps BINUS University students navigate and adapt to campus life, pairing an OpenAI-powered conversational core with voice interaction and live web scraping for up-to-date campus information.',
                'highlights' => [
                    'Conversational core powered by the OpenAI API, driven by a defined assistant persona.',
                    'Voice interaction that captures and plays back spoken questions and answers via PyAudio.',
                    'Scrapes the web with BeautifulSoup and requests to surface up-to-date campus information.',
                    'Multilingual replies through automatic translation (googletrans).',
                    'Flask backend serving a custom HTML/CSS/JavaScript chat interface, with JSON-persisted conversation history.',
                ],
                'stack' => ['Python', 'Flask', 'OpenAI API', 'PyAudio', 'BeautifulSoup', 'JavaScript', 'HTML/CSS'],
            ],
            [
                'title'    => 'JoymarKet',
                'desc'     => 'Responsive e-commerce app in Java.',
                'emoji'    => '🛍️',
                'tag'      => 'E-commerce',
                'color'    => 'amber',
                'featured' => true,
                'longDesc' => 'A desktop e-commerce marketplace application built with JavaFX and backed by a MySQL database.',
                'highlights' => [
                    'JavaFX desktop interface with layouts defined in FXML.',
                    'MySQL database backend accessed over JDBC, with the schema provided in joymarket.sql.',
                    'Built with Maven on Java 11, with the application entry point in the view layer.',
                    'Ships with a user guide documenting the application.',
                ],
                'stack' => ['Java 11', 'JavaFX', 'FXML', 'MySQL', 'JDBC', 'Maven'],
            ],
        ];
    }

    private function bio(): string
    {
        return 'Computer Science undergraduate with a strong preference towards Back End Development. '
            . 'Have experience in developing responsive applications and integrating '
            . 'backend services with PHP, SQL, and JS. Experienced in team collaboration using GitHub and '
            . 'deploying applications to production environments. Additional background in Embedded Systems '
            . 'and Internet of Things.';
    }

    private function skills(): array
    {
        return ['Java', 'HTML/CSS', 'JavaScript', '.NET', 'MySQL', 'C/C#'];
    }

    private function contacts(): array
    {
        return [
            ['icon' => 'mail',     'text' => 'zahwan.satria@gmail.com'],
            ['icon' => 'linkedin', 'text' => 'linkedin/zahwansatria'],
            ['icon' => 'location', 'text' => 'Jakarta, Indonesia'],
        ];
    }

    private function orgs(): array
    {
        return [
            [
                'logo'      => 'BNCC',
                'color'     => 'purple',
                'role'      => 'Member',
                'name'      => 'Bina Nusantara Computer Club',
                'period'    => 'Sep. 2023 - 2025',
                'desc'      => 'Learned various programming languages, topics (Java and UI/UX design principles), and backend development using MySQL.',
                'tags'      => ['Learning'],
            ],
            [
                'logo'      => 'URK',
                'color'     => 'teal',
                'role'      => 'Core Team Member',
                'name'      => 'Ureeka Binus',
                'period'    => '2024 - 2026',
                'desc'      => 'Organized events, hackathons, and teaching sessions. Participated in hackathons every semester. Teaching and group sessions about Laravel, HTML, CSS, Flask, Flutter, etc.',
                'tags'      => ['Leadership', 'Teaching'],
            ],
        ];
    }
}
