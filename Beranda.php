<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TALKLAB - Beranda</title>
    <link rel="stylesheet" href="style.css" />
    <?php include 'includes/layout_css.php'; ?>
</head>

<body>

    <?php include 'includes/header.php'; ?>
    <?php include 'includes/sidebar.php'; ?>

    <main>
        <section class="hero">
            <div class="ornamen-left"></div>
            <div class="ornamen-right"></div>
            <div class="hero-content">
                <h1 class="mari">Mari Bicara Dengan Percaya Diri !</h1>
                <p class="karena">Karena percaya diri itu bisa dilatih, bukan di tunggu.</p>

                <div class="progress-box">
                    <span class="label">Progres Belajar</span>
                    <span class="percent">0%</span>
                    <div class="progress-bar">
                        <div class="fill"></div>
                    </div>
                    <p>Kamu belum menyelesaikan tugas apapun</p>
                </div>

                <button class="btn-primary">Mulai Belajar</button>
            </div>

            <div class="hero-img">
                <div class="image-wrapper">
                    <img src="assets/jjjj.png" alt="character">
                </div>
            </div>

        </section>

        <h2 style="font-size: 35px;">Akses Cepat</h2>

        <div class="quick-cards">

            <div class="quick-card">
                <div class="icon-box materi-icon">
                    <img src="icon/bukuuu.svg" alt="">
                </div>
                <h3>Materi</h3>
                <p>Klik untuk memulai</p>
            </div>

            <div class="quick-card">
                <div class="icon-box latihan-icon">
                    <img src="icon/ngomong.svg" alt="">
                </div>
                <h3>Latihan</h3>
                <p>Klik untuk memulai</p>
            </div>

            <div class="quick-card">
                <div class="icon-box ebook-icon">
                    <img src="icon/buk.svg" alt="">
                </div>
                <h3>E-Book</h3>
                <p>Klik untuk memulai</p>
            </div>

            <div class="quick-card">
                <div class="icon-box komunitas-icon">
                    <img src="icon/dua.svg" alt="">
                </div>
                <h3>Komunitas</h3>
                <p>Klik untuk memulai</p>
            </div>

        </div>


        <h2 style="font-size: 33px;">Aktifitas Terbaru</h2>
        <div class="activity-list">

            <div class="activity-item">
                <img class="activity-icon" src="icon/panah.svg" alt="">
                <div class="text">
                    <p>Kamu menyelesaikan materi "Vokal yang jelas"</p>
                    <small>2 jam lalu</small>
                </div>
            </div>

            <div class="activity-item">
                <img class="activity-icon" src="icon/cup.svg" alt="">
                <div class="text">
                    <p>Kamu mendapatkan badge "Pemula berbicara"</p>
                    <small>1 hari lalu</small>
                </div>
            </div>

            <div class="activity-item">
                <img class="activity-icon" src="icon/bye.svg" alt="">
                <div class="text">
                    <p>Kamu bergabung dengan komunitas TALKLAB</p>
                    <small>3 hari lalu</small>
                </div>
            </div>

        </div>

    </main>

</body>

</html>
