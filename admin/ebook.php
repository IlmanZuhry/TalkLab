<?php
require_once '../core.php';
require_once '../includes/ebook_data.php';

$app = new manz();
$mentor = $app->getCurrentMentor();

if (!$mentor) {
    header('Location: loginad.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TALKLAB - E-Book Mentor</title>
    <?php include 'inc/layout_css.php'; ?>
</head>
<body>
    <?php include 'inc/header.php'; ?>
    <?php include 'inc/sidebar.php'; ?>

    <main>
        <h1 class="admin-page-title">E-Book</h1>
        <p class="admin-page-subtitle">Referensi materi public speaking untuk mentor.</p>

        <section class="admin-grid">
            <?php foreach ($ebooks as $ebook): ?>
                <article class="admin-card">
                    <h2><?= htmlspecialchars($ebook['title']) ?></h2>
                    <p><?= htmlspecialchars($ebook['author']) ?></p>
                    <p><?= (int) $ebook['pages'] ?> halaman</p>
                    <a class="admin-button" href="../assets/ebook/<?= htmlspecialchars($ebook['pdf']) ?>" target="_blank">Buka PDF</a>
                </article>
            <?php endforeach; ?>
        </section>
    </main>
</body>
</html>
