<?php
/** @var \App\Template $this */
/** @var string|null $success */
/** @var array<string, array<string>> $errors */

$this->extend('layout');
?>

<?php $this->start('title', 'About Me') ?>

<section class="page-header">
    <div class="container">
        <h1 class="page-heading">
            About Me
        </h1>
        <p class="page-intro">
            My dream is to join a bold team where direct communication,
            creativity as a responsibility, branding insight and digital
            solutions come together. I thrive in teams which appreciate attitude
            , flexibility, team spirit and individuality – where ideas are
            allowed to grow and perform.
            I plan to pursue a top-up bachelor’s degree following my Multimedia
            Design education.

        </p>
    </div>
</section>

<section class="bio">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <h2 class="section-heading">Bio</h2>
                <p>
                    Lifelong creator and customizer – with a strong creative
                    approach to both digital and physical solutions. Over 20
                    years of experience in Content Creation, SEO, and SoMe
                    marketing. A modern and sharp communicator with a creative
                    mindset, intellectual curiosity, and extensive experience in
                    teaching and knowledge-sharing – supported by more than 25
                    years of professional background in both the private and
                    public sectors in Denmark and the UK.
                </p>
                <p>
                    My journey in web development began with a fascination for problem-solving
                    and has evolved into a deep appreciation for well-structured, maintainable code.
                    I believe in writing code that not only works but is also easy to understand
                    and maintain.
                </p>

            </div>

            <div class="about-image">
                <img src="<?= __DIR__ . '/../../public/images/copilotBillede.png' ?>" alt="Headshot of Thomas
                Larsen" class="portrait-image">
            </div>
        </div>
    </div>
</section>

<section class="skills section-padding">
    <div class="container">
        <h2 class="section-heading">Skills</h2>
        <div class="skill-items">
            <span class="skill-tag">HTML5</span>
            <span class="skill-tag">CSS</span>
            <span class="skill-tag">JavaScript</span>
            <span class="skill-tag">PHP</span>
            <span class="skill-tag">Adobe Creative Suite</span>
            <span class="skill-tag">Content Creation</span>
            <span class="skill-tag">SEO</span>
            <span class="skill-tag">SoMe Marketing</span>
            <span class="skill-tag">Graphic Design</span>
        </div>
    </div>
</section>
