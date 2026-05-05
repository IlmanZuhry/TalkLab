<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TALKLAB Login</title>
    <link rel="stylesheet" href="style3.css">
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

            <h1 style="font-size: 49px;">Halo, Salam Kenal</h1>
            <p style="font-size: 25px;">Silahkan isi data anda.</p>

            <div class="form-wrapper">
                <form>

                    <label>Nama Depan</label>
                    <input type="text" placeholder="Ketik nama depan anda">

                    <label>Nama Belakang</label>
                    <input type="text" placeholder="Ketik nama belakang anda">

                    <label>Tempat Lahir</label>
                    <input type="text" placeholder="Ketik kota tempat lahir anda">

                    <label>Tanggal Lahir</label>
                    <input type="date" placeholder="Ketik nama depan anda">

                    <label>Username</label>
                    <input type="text" placeholder="Ketik username anda">

                    <label>Kata Sandi</label>
                    <div class="password-wrapper">
                        <input id="password-input" type="password" placeholder="Ketik kata sandi anda">

                        <img class="eye-toggle" id="toggle-eye" src="icon/pw.svg" style="width:32px; height:32px;">
                    </div>

                    <label>Keting ulang Kata Sandi</label>
                    <div class="password-wrapper">
                        <input id="password-input2" type="password" placeholder="Ketik kata sandi anda">

                        <img class="eye-toggle" id="toggle-eye2" src="icon/pw.svg" style="width:32px; height:32px;">
                    </div>
                    <button type="button" class="btn-login" onclick="location.href='login.php'">Daftar</button>

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
                ? "icon/buka.svg"
                : "icon/pw.svg";
        });
    </script>
    <script>
        const passwordInput2 = document.getElementById("password-input2");
        const toggleEye2 = document.getElementById("toggle-eye2");

        toggleEye2.addEventListener("click", () => {
            const isHidden = passwordInput2.type === "password";

            passwordInput2.type = isHidden ? "text" : "password";


            toggleEye2.src = isHidden
                ? "icon/buka.svg"
                : "icon/pw.svg";
        });
    </script>

</body>

</html>
