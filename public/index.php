<?php
// ----------------------------------------------------
// index.php
// Én én-sides løsning med GET-parametre for sprogskift
// ----------------------------------------------------

// 1) Bestem sprog (default = da)
$lang = isset($_GET['lang']) && $_GET['lang'] === 'en' ? 'en' : 'da';

// 2) Oversættelser
$t = [
    'da' => [
        'html_lang'       => 'da',
        'title'           => '',
        'description'     => '<em>"Mit job som designer er, at få brugeren til at føle sig<br>som et geni - ikke at minde dem om, hvor hårdt jeg<br>har arbejdet på designet."</em>',
        'nav_home'        => 'Hjem',
        'nav_about'       => 'Om',
        'nav_projects'    => 'Projekter',
        'nav_contact'     => 'Kontakt',
        'switcher_small'  => 'Language',
        'about_heading'   => 'Om mig',
        'about_text'      => 'Livslang autodidakt designer med over 20 års erfaring med Content Creation, SEO og SoMe marketing.
                          Moderne og skarp kommunikator med kreativ tankegang, intellektuel nysgerrighed, stor erfaring med at formidle og undervise,
                          samt mere end 25 års erfaring fra den private og offentlige sektor i Danmark og England.',
        'projects_heading'=> 'Mine Projekter',
        'contact_heading' => 'Kontakt mig',
        'contact_email'   => 'Send e-mail',
        'contact_phone'   => 'Ring til mig',
    ],
    'en' => [
        'html_lang'       => 'en',
        'title'           => '',
        'description'     => '<em>"My job as a designer is to make the user feel like a<br>genius - not to remind them how hard I worked on<br>the design."</em>',
        'nav_home'        => 'Home',
        'nav_about'       => 'About',
        'nav_projects'    => 'Projects',
        'nav_contact'     => 'Contact',
        'switcher_small'  => 'Sprog',
        'about_heading'   => 'About me',
        'about_text'      => 'A lifelong self-taught designer with over 20 years of experience in content creation, SEO, and social media marketing.
                          A modern and sharp communicator with a creative mindset, intellectual curiosity, solid teaching and communication skills,
                          and over 25 years of experience across both public and private sectors in Denmark and the UK.',
        'projects_heading'=> 'My Projects',
        'contact_heading' => 'Get in touch',
        'contact_email'   => 'Send e-mail',
        'contact_phone'   => 'Call me',
    ],
];

// 3) Accordion-data
$accordions = [
    ['da'=>'Full Stack Udvikling',     'en'=>'Full Stack Development',    'key'=>'fullstack'],
    ['da'=>'Indholdsproduktion',        'en'=>'Content Creation',         'key'=>'content'],
    ['da'=>'Re-design af logo',         'en'=>'Logo re-design',           'key'=>'logo'],
];

// Hent gældende sprog-pakke
$L = $t[$lang];
?>
<!DOCTYPE html>
<html lang="<?= $L['html_lang'] ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $L['title'] ?></title>
    <meta name="description" content="<?= htmlspecialchars(strip_tags($L['description'])) ?>" />

    <!-- hreflang for SEO -->
    <link rel="alternate" hreflang="da" href="?lang=da" />
    <link rel="alternate" hreflang="en" href="?lang=en" />

    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        /* ========== Mobile First Styles ========== */
        :root {
            --background: #111111;
            --text: #ffffff;
            --accent: #03e9f4;
            --header-bg: rgba(17, 17, 17, 0.95);
        }

        body {
            margin: 0;
            font-family: 'Nunito', sans-serif;
            line-height: 1.5;
            scroll-behavior: smooth;
            background: var(--background);
            color: var(--text);
        }

        header {
            position: sticky;
            top: 0;
            background: var(--header-bg);
            padding: 0.5rem 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 1rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text);
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: var(--accent);
        }

        .language-switcher {
            text-align: right;
        }

        .language-switcher small {
            color: var(--text);
        }

        .language-switcher a,
        .language-switcher span {
            color: var(--text);
            text-decoration: none;
            margin: 0 0.2rem;
        }

        main > section {
            padding: 2rem 1rem;
        }

        #home {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            text-align: center;
        }

        #home img {
            max-width: 200px;
            border-radius: 50%;
            margin: 0 auto;
        }

        h1, h2 {
            margin-top: 0;
            color: var(--text);
        }

        .accordion-item {
            margin-bottom: 1rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }

        .accordion-header {
            width: 100%;
            background: #222;
            color: var(--text);
            border: 1px solid #333;
            padding: 1rem;
            text-align: left;
            font-size: 1rem;
            cursor: pointer;
        }

        .accordion-header:focus {
            outline: 3px solid var(--accent);
        }

        .accordion-content {
            padding: 1rem;
            background: #222;
            border: 1px solid #333;
            color: var(--text);
        }

        .contact-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .contact-list li {
            margin: 0.5rem 0;
        }

        .contact-list a {
            text-decoration: none;
            color: var(--text);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.3s;
        }

        .contact-list a:hover {
            color: var(--accent);
        }

        @media (min-width: 768px) {
            #home {
                grid-template-columns: 1fr 1fr;
                text-align: left;
            }
        }
    </style>
</head>

<body>
<header>
    <nav aria-label="Global navigation">
        <!-- Navigation links -->
        <ul class="nav-links">
            <li><a href="#home"><?= $L['nav_home'] ?></a></li>
            <li><a href="#about"><?= $L['nav_about'] ?></a></li>
            <li><a href="#projects"><?= $L['nav_projects'] ?></a></li>
            <li><a href="#contact"><?= $L['nav_contact'] ?></a></li>
        </ul>

        <!-- Sprogskifter -->
        <div class="language-switcher" aria-label="Sprog skifter">
            <small><?= $L['switcher_small'] ?></small>
            <?php if ($lang === 'da'): ?>
                <a href="?lang=en" aria-label="English">EN</a>/<span aria-current="page">DA</span>
            <?php else: ?>
                <a href="?lang=da" aria-label="Dansk">DA</a>/<span aria-current="page">EN</span>
            <?php endif; ?>
        </div>
    </nav>
</header>

<main>
    <!-- 1) Hjem/Home -->
    <section id="home" aria-labelledby="home-heading">
        <div>
            <h1 id="home-heading"><?= $L['title'] ?></h1>
            <p><?= $L['description'] ?></p>
        </div>
        <div>
            <img src="images/copilotBillede.png" alt="Portræt" />
        </div>
    </section>

    <!-- 2) Om/About -->
    <section id="about" aria-labelledby="about-heading">
        <h2 id="about-heading"><?= $L['about_heading'] ?></h2>
        <p><?= nl2br($L['about_text']) ?></p>
    </section>

    <!-- 3) Projekter/Projects -->
    <section id="projects" aria-labelledby="projects-heading">
        <h2 id="projects-heading"><?= $L['projects_heading'] ?></h2>

        <?php foreach ($accordions as $item): ?>
            <div class="accordion-item">
                <button
                    class="accordion-header"
                    aria-expanded="false"
                    aria-controls="acc-<?= $item['key'] ?>"
                    id="heading-<?= $item['key'] ?>"
                >
                    <?= $item[$lang] ?>
                </button>

                <div
                    class="accordion-content"
                    id="acc-<?= $item['key'] ?>"
                    role="region"
                    aria-labelledby="heading-<?= $item['key'] ?>"
                    hidden
                >
                    <!-- Du kan indsætte dit eget indhold her -->
                    <p>Her kommer indholdet for "<?= $item[$lang] ?>".</p>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <!-- 4) Kontakt/Contact -->
    <section id="contact" aria-labelledby="contact-heading">
        <h2 id="contact-heading"><?= $L['contact_heading'] ?></h2>
        <ul class="contact-list">
            <li>
                <a href="mailto:larsenator@live.com">
                    <span class="material-icons" aria-hidden="true">email</span>
                    <span><?= $L['contact_email'] ?></span>
                </a>
            </li>
            <li>
                <a href="tel:+4531488197">
                    <span class="material-icons" aria-hidden="true">phone</span>
                    <span><?= $L['contact_phone'] ?></span>
                </a>
            </li>
        </ul>
    </section>
</main>

<script>
    // Accordion toggle
    document.querySelectorAll('.accordion-header').forEach(btn => {
        btn.addEventListener('click', () => {
            const panel = document.getElementById(btn.getAttribute('aria-controls'));
            const expanded = btn.getAttribute('aria-expanded') === 'true';
            btn.setAttribute('aria-expanded', String(!expanded));
            panel.hidden = expanded;
        });
    });
</script>
</body>
</html>
