<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TALKLAB Login</title>
    <link rel="stylesheet" href="style2.css">
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
                <img src="assets/ayooo.png" class="brand-logo" alt="Logo">
                <span class="brand-text">
                    <span class="talk">TALK</span><span class="lab">LAB</span>
                </span>
            </div>



            <div class="hero-illustration">
                <div class="circle-border">
                    <img src="assets/log.png" class="character" alt="Character">
                </div>
            </div>

            <h2 class="hero-title">Siap bicara dengan percaya diri?</h2>
            <p class="hero-subtitle">Lakukan perjalanan belajarmu hari ini</p>


            <div class="ornament bottom-left"></div>
            <div class="ornament top-right"></div>

        </div>


        <div class="login-right">
            <a href="index.php" class="back-link">
                <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
                Kembali ke Beranda
            </a>
            <h1 style="font-size: 49px;">Selamat datang!</h1>
            <p style="font-size: 25px;">Silahkan masuk untuk melanjutkan.</p>

            <div class="form-wrapper">
                <form>

                    <label>Username</label>
                    <input type="text" placeholder="Ketik username anda">

                    <label>Kata Sandi</label>
                    <div class="password-wrapper">
                        <input id="password-input" type="password" placeholder="Ketik kata sandi anda">

                        <img class="eye-toggle" id="toggle-eye" src="icon/pw.svg" style="width:32px; height:32px;">
                    </div>

                    <a class="lost-password" href="#">Lupa kata sandi?</a>
                    <button type="button" class="btn-login" onclick="location.href='Beranda.php'">Masuk</button>

                    <p class="register-text">Belum punya akun? <a href="regis.php">Daftar sekarang</a></p>
                </form>
            </div>

            <div class="login-options">
                <button class="btn-social google">
                    <img class="social-icon" src="assets/google.png" alt="">
                    <span>Login dengan Google</span>
                </button>

                <button class="btn-social facebook">
                    <img class="social-icon" src="assets/fb.png" alt="">
                    <span>Login dengan Facebook</span>
                </button>

                <button class="btn-social email">
                    <img class="social-icon" src="assets/email.png" alt="">
                    <span>Login dengan E-mail</span>
                </button>

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
                ? "icon/buka.svg"
                : "icon/pw.svg";
        });
    </script>


</body>

</html>
