<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TALKLAB Dashboard</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>


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

            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTF9kb4Z-541wLQd0fNTOTUyExgV9kJG6TXDw&s"
                class="avatar">
            <div class="user-info">
                <div class="name">Bahenol</div>
                <div class="username">@bahlulethanol</div>
            </div>
        </div>
    </header>


    <aside class="sidebar">
        <ul>
            <li class="menu-item active">
                <svg class="icon" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 3l9 8h-3v9h-5v-6H11v6H6v-9H3l9-8z" />
                </svg>
                <span>Beranda</span>
            </li>

            <li class="menu-item">
                <a href="Materi.php">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M21 4H14C12.9 4 12 4.9 12 6V18C12 16.9 12.9 16 14 16H21V4M10 6C10 4.9 9.1 4 8 4H3V16H10C11.1 16 12 16.9 12 18V6C12 4.9 11.1 4 10 4M3 18V20H8C9.1 20 10 19.1 10 18H3M14 18C14 19.1 14.9 20 16 20H21V18H14Z" />
                    </svg>
                    <span>Materi</span>
                </a>
            </li>


            <li class="menu-item">
                <a href="Komunitas.php">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zM8 11c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                    </svg>
                    <span>Komunitas</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="Profil.php">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M12 12c2.67 0 8 1.34 8 4v3H4v-3c0-2.66 5.33-4 8-4zm0-2a4 4 0 110-8 4 4 0 010 8z" />
                    </svg>
                    <span>Profil</span>
                </a>
            </li>
        </ul>
    </aside>



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
                    <p>Kamu menyelesaikan materi “Vokal yang jelas”</p>
                    <small>2 jam lalu</small>
                </div>
            </div>

            <div class="activity-item">
                <img class="activity-icon" src="icon/cup.svg" alt="">
                <div class="text">
                    <p>Kamu mendapatkan badge “Pemula berbicara”</p>
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
