<?php
require_once __DIR__ . '/../core.php';
$app = new manz();
$app->ensureSession();
?>

<header class="header">
    <div class="header-left">
        <img src="assets/ayooo.png" class="logo-header" alt="Logo">
        <span class="brand-text">TALKLAB</span>
    </div>

    <input type="text" placeholder="Cari apapun di TALKLAB..." class="search">

    <div class="user-area">
        <div class="notif">
            <svg viewBox="0 0 24 24" class="icon-bell">
                <path fill="white"
                    d="M12 2a7 7 0 00-7 7v4.268l-.894 2.683A1 1 0 005 18h14a1 1 0 00.894-1.449L19 13.268V9a7 7 0 00-7-7zm0 20a3 3 0 003-3H9a3 3 0 003 3z" />
            </svg>
        </div>

        <?php if ($app->isLoggedIn()):
            $displayName = $app->getDisplayName();
            $displayUsername = $app->getDisplayUsername();
        ?>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTF9kb4Z-541wLQd0fNTOTUyExgV9kJG6TXDw&s" class="avatar">
            <div class="user-info">
                <div class="name"><?= $displayName ?></div>
                <div class="username">@<?= $displayUsername ?></div>
            </div>
        <?php else: ?>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTF9kb4Z-541wLQd0fNTOTUyExgV9kJG6TXDw&s" class="avatar">
            <div class="user-info">
                <div class="name">Tamu</div>
                <div class="username">@guest</div>
                <div style="margin-top:6px"><a href="login.php" style="color:#fff;opacity:0.9;text-decoration:underline;">Masuk</a> &nbsp; <a href="regis.php" style="color:#fff;opacity:0.9;text-decoration:underline;">Daftar</a></div>
            </div>
        <?php endif; ?>
    </div>
</header>
