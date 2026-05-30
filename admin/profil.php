<?php
require_once '../core.php';

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
    <title>TALKLAB - Profil Mentor</title>
    <?php include 'inc/layout_css.php'; ?>
</head>
<body>
    <?php include 'inc/header.php'; ?>
    <?php include 'inc/sidebar.php'; ?>

    <main>
        <h1 class="admin-page-title">Profil</h1>
        <p class="admin-page-subtitle">Informasi akun mentor yang sedang aktif.</p>

        <section class="admin-panel">
            <div class="admin-card">
                <h2><?= htmlspecialchars($mentor['name']) ?></h2>
                <p>@<?= htmlspecialchars($mentor['username']) ?></p>
                <p>Role: Mentor Admin</p>
                <a class="admin-button" href="logoutad.php">Logout</a>
            </div>
        </section>
    </main>
</body>
</html>
