<?php
require_once '../core.php';
$app = new manz();
$app->ensureSession();
$error = '';
$isFirstMentorSetup = !$app->hasMentorAccounts();

if ($app->getCurrentMentor()) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mode = $_POST['mode'] ?? 'login';
    $name = trim($_POST['name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $passwordConfirm = $_POST['password_confirm'] ?? '';

    if ($isFirstMentorSetup && $mode === 'setup') {
        if ($name === '' || $username === '' || $password === '') {
            $error = 'Nama, username, dan kata sandi mentor wajib diisi.';
        } elseif (strlen($password) < 8) {
            $error = 'Kata sandi mentor minimal 8 karakter.';
        } elseif ($password !== $passwordConfirm) {
            $error = 'Konfirmasi kata sandi belum sama.';
        } elseif (!$app->createMentorAccount($name, $username, $password)) {
            $error = 'Akun mentor pertama gagal dibuat. Coba username lain.';
        } else {
            $mentor = $app->authenticateMentor($username, $password);
            $app->setMentorSession($mentor);
            header('Location: dashboard.php');
            exit;
        }
    } elseif ($username === '' || $password === '') {
        $error = 'Username dan kata sandi wajib diisi.';
    } else {
        $mentor = $app->authenticateMentor($username, $password);
        if ($mentor === false) {
            $error = 'Username atau kata sandi mentor tidak cocok.';
        } else {
            $app->setMentorSession($mentor);
            header('Location: dashboard.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TALKLAB Mentor Login</title>
    <link rel="stylesheet" href="../style2.css">
    <style>
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #1c407a;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 24px;
            transition: color 0.2s;
        }
        .back-link:hover {
            color: #15305c;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-container">


        <div class="login-left">


            <div class="brand">
                <img src="../assets/ayooo.png" class="brand-logo" alt="Logo">
                <span class="brand-text">
                    <span class="talk">TALK</span><span class="lab">LAB</span>
                </span>
            </div>



            <div class="hero-illustration">
                <div class="circle-border">
                    <img src="../assets/log.png" class="character" alt="Character">
                </div>
            </div>

            <h2 class="hero-title">Siap Melihat Perkembangan Murid?</h2>
            


            <div class="ornament bottom-left"></div>
            <div class="ornament top-right"></div>

        </div>


        <div class="login-right">
            
            <h1 style="font-size: 49px;"><?= $isFirstMentorSetup ? 'Setup mentor' : 'Selamat datang!' ?></h1>
            <p style="font-size: 25px;"><?= $isFirstMentorSetup ? 'Buat akun mentor pertama untuk membuka dashboard.' : 'Masuk ke dashboard mentor.' ?></p>

            <div class="form-wrapper">
                
            <?php if (!empty($error)): ?>
                    <div style="background:#fee2e2;color:#991b1b;padding:10px;border-radius:6px;margin-bottom:12px;">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="loginad.php">
                    <input type="hidden" name="mode" value="<?= $isFirstMentorSetup ? 'setup' : 'login' ?>">

                    <?php if ($isFirstMentorSetup): ?>
                        <label>Nama Mentor</label>
                        <input type="text" name="name" placeholder="Ketik nama mentor" required>
                    <?php endif; ?>

                    <label>Username</label>
                    <input type="text" name="username" placeholder="Ketik username anda" required>

                    <label>Kata Sandi</label>
                    <div class="password-wrapper">
                        <input id="password-input" type="password" name="password" placeholder="Ketik kata sandi anda" required>

                        <img class="eye-toggle" id="toggle-eye" src="../icon/pw.svg" style="width:32px; height:32px;">
                    </div>

                    <?php if ($isFirstMentorSetup): ?>
                        <label>Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirm" placeholder="Ulangi kata sandi" required>
                    <?php endif; ?>

                    <button type="submit" class="btn-login"><?= $isFirstMentorSetup ? 'Buat Akun' : 'Masuk' ?></button>
                </form>

                    
            </div>

                

        </div>

    </div>
    <script>
        const passwordInput = document.getElementById("password-input");
        const toggleEye = document.getElementById("toggle-eye");

        toggleEye.addEventListener("click", () => {
            const isHidden = passwordInput.type === "password";

            passwordInput.type = isHidden ? "text" : "password";


            toggleEye.src = isHidden
                ? "../icon/buka.svg"
                : "../icon/pw.svg";
        });
    </script>


</body>

</html>
