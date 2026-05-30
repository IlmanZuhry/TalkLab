<?php
require_once __DIR__ . '/../../core.php';
if (!isset($app) || !($app instanceof manz)) {
    $app = new manz();
}

$app->ensureSession();
$mentor = $mentor ?? $app->getCurrentMentor();

if (!$mentor) {
    header('Location: loginad.php');
    exit;
}
?>

<header class="header">
    <div class="header-left">
        <img src="../assets/ayooo.png" class="logo-header" alt="Logo">
        <span class="brand-text">TALKLAB</span>
    </div>

    <div class="user-area">
        <div class="notif">
            <svg viewBox="0 0 24 24" class="icon-bell">
                <path fill="white"
                    d="M12 2a7 7 0 00-7 7v4.268l-.894 2.683A1 1 0 005 18h14a1 1 0 00.894-1.449L19 13.268V9a7 7 0 00-7-7zm0 20a3 3 0 003-3H9a3 3 0 003 3z" />
            </svg>
        </div>

        <div class="avatar" style="background:#d2a06b;display:flex;align-items:center;justify-content:center;">
            <svg viewBox="0 0 24 24" width="30" height="30"><path fill="white" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
        </div>

        <div class="user-info">
            <div class="name"><?= htmlspecialchars($mentor['name']) ?></div>
            <div class="username">@<?= htmlspecialchars($mentor['username']) ?></div>
        </div>
    </div>
</header>
