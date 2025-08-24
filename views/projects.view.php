<?php
/** @var \App\Template $this */
/** @var string|null $success */
/** @var array<string, array<string>> $errors */
/** @var \App\Dto\ProjectDto[] $projects */

$this->extend('layout');
?>

<?php $this->start('title', 'Projects') ?>

<section class="page-header">
    <div class="container">
        <h1 class="page-heading">
            My Work
        </h1>

    </div>
</section>

<section class="project-list">
    <div class="container">
        <div class="project-grid">
            <?php foreach ($projects as $index => $project): ?>
                <div
                    class="project-row <?= $index % 2 === 1 ? 'project-row--reverse' : '' ?>"
                >
                    <div class="project-image">
                        <img
                            src="<?= htmlspecialchars($project->image) ?>"
                            alt="<?= htmlspecialchars($project->title) ?>"
                        >
                    </div>
                    <div class="project-content">
                        <h2>
                            <?= htmlspecialchars($project->title) ?>
                        </h2>
                        <p class="project-description">
                            <?= htmlspecialchars($project->description) ?>
                        </p>
                        <p class="technologies">
                            <strong>Tools:</strong>
                            <?= htmlspecialchars($project->technologies) ?>
                        </p>
                        <div class="project-actions">
                            <a
                                href="<?= htmlspecialchars($project->link) ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="btn-view-project"
                            >
                                Visit Website
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
