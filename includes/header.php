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
            $displayFoto = $app->getDisplayFoto();
        ?>
            <?php if (!empty($displayFoto)): ?>
                <img src="<?= $displayFoto ?>" class="avatar">
            <?php else: ?>
                <div class="avatar" style="background:#d2a06b;display:flex;align-items:center;justify-content:center;">
                    <svg viewBox="0 0 24 24" width="30" height="30"><path fill="white" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                </div>
            <?php endif; ?>
            <div class="user-info">
                <div class="name"><?= $displayName ?></div>
                <div class="username">@<?= $displayUsername ?></div>
            </div>
        <?php else: ?>
            <div class="avatar" style="background:#555;display:flex;align-items:center;justify-content:center;">
                <svg viewBox="0 0 24 24" width="30" height="30"><path fill="white" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            </div>
            <div class="user-info">
                <div class="name">Tamu</div>
                <div class="username">@guest</div>
                <div style="margin-top:6px"><a href="login.php" style="color:#fff;opacity:0.9;text-decoration:underline;">Masuk</a> &nbsp; <a href="regis.php" style="color:#fff;opacity:0.9;text-decoration:underline;">Daftar</a></div>
            </div>
        <?php endif; ?>
    </div>
</header>
