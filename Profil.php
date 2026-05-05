<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: system-ui, sans-serif;
    }


    body {
        display: flex;
        background: #f5f5f5;
    }


    .header {
        position: fixed;
        top: 0;
        left: 0;
        height: 90px;
        width: 100%;
        padding: 12px 32px;
        background: #0e1e4d;
        display: flex;
        align-items: center;
        justify-content: space-between;
        z-index: 1000;
    }


    .header-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .logo-header {
        width: 75px;
        height: 75px;
        object-fit: contain;
    }

    .brand-text {
        color: white;
        font-weight: 700;
        font-size: 32px;
        letter-spacing: 1px;
    }

    .notif {
        width: 44px;
        height: 44px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .icon-bell {
        width: 30px;
        height: 30px;
    }

    .menu-item {
        display: flex;
        height: 50px;
        align-items: center;
        gap: 10px;
        padding: 29px 29px;
        border-radius: 29px;
        background: rgba(255, 255, 255, 0.08);
        cursor: pointer;
        transition: 0.25s;
        font-size: 18px;
    }

    .menu-item a {
        text-decoration: none;
        color: inherit;
        display: flex;
        height: 50px;
        align-items: center;
        transition: 0.25s;
        font-size: 18px;
        gap: 10px;
    }

    .menu-item.active {
        background: #d2a06b !important;
        color: #ffffff;
        font-weight: 600;
    }

    .menu-item.active .icon {
        fill: #ffffff;
    }


    .menu-item:hover:not(.active) {
        background: rgba(255, 255, 255, 0.18);
    }

    .icon {
        width: 22px;
        height: 22px;
        fill: white;
    }

    .sidebar ul {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }


    .search {
        width: 500px;
        padding: 10px 14px;
        background: rgba(255, 255, 255, 0.15) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 24 24'%3E%3Cpath d='M10 2a8 8 0 105.293 14.293l4.707 4.707 1.414-1.414-4.707-4.707A8 8 0 0010 2zm0 2a6 6 0 110 12 6 6 0 010-12z'/%3E%3C/svg%3E") no-repeat 18px center;
        background-size: 28px;
        padding-left: 60px;
        border: none;
        outline: none;
        border-radius: 25px;
        color: white;
        margin-left: -60px;
        font-size: 20px;
    }

    .search::placeholder {
        color: #c9cbda;
    }


    .user-area {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .notif {
        font-size: 20px;
    }

    .avatar {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-info {
        color: white;
        font-size: 18px;
    }


    .sidebar {
        width: 260px;
        background: #1c407a;
        color: white;
        padding: 140px 24px 24px;
        min-height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
    }

    .sidebar ul li {
        list-style: none;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 8px;
        cursor: pointer;
    }

    .sidebar ul li.active,
    .sidebar ul li:hover {
        background: #476097;
    }

    .mari {
        font-size: 50px;
    }

    .karena {
        font-size: 30px;
        word-spacing: 2.5px;
        color: #d2a06b;

    }

    .ornamen-left {
        position: absolute;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: rgba(80, 64, 64, 0.45);
        left: -80px;
        bottom: -120px;
    }

    .ornamen-right {
        position: absolute;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: rgba(80, 64, 64, 0.45);
        right: -80px;
        top: -120px;
    }
</style>

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

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <ul>
            <li class="menu-item">
                <a href="Beranda.php">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12 3l9 8h-3v9h-5v-6H11v6H6v-9H3l9-8z" />
                    </svg>
                    <span>Beranda</span>
                </a>
            </li>

            <li class="menu-item ">
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

            <li class="menu-item active">
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

    <!-- MAIN CONTENT -->
    <div style="margin-left:260px; padding-top:120px; width:100%; padding-left:40px; padding-right:40px;">

        <!-- Judul -->
        <h1 style="font-size:40px; font-weight:700; color:#000;">Profil</h1>
        <p style="color:#777; font-size:20px; margin-bottom:30px;">Kelola akun dan lihat progres kamu</p>

        <!-- Banner Profil -->
        <div class="banner-profil" style="
        width:100%;
        background:#0e1e4d;
        padding:95px 40px;
        border-radius:20px;
        display:flex;
        align-items:center;
        justify-content:space-between;
        color:white;
        min-height:240px; 
        position:relative;   /* penting untuk dekor */
        overflow:hidden;     /* sembunyikan ornamen keluar */
">
            <div class="ornamen-left"></div>
            <div class="ornamen-right"></div>
            <div style="display:flex; align-items:center; gap:25px;">
                <div style="
                width:200px; height:200px;
                border-radius:50%;
                border:5px solid #d2a06b;
                overflow:hidden;
            ">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTF9kb4Z-541wLQd0fNTOTUyExgV9kJG6TXDw&s"
                        style="width:100%; height:100%; object-fit:cover;">
                </div>

                <div>
                    <h2 style="font-size:32px; font-weight:700;">Bahenol</h2>
                    <p style="font-size:22px; color:#d2a06b;">@bahlulethanol</p>
                    <p style="font-size:20px; margin-top:10px;">“yang penting bicara aja dulu”</p>
                </div>
            </div>

            <button style="
            background:#d2a06b;
            padding:10px 26px;
            color:white;
            font-size:20px;
            border:none;
            border-radius:12px;
            cursor:pointer;
            margin-right: 40px;

        ">
                Edit Profil
            </button>
        </div>

        <!-- Box Statistik -->
        <div style="
        display:flex;
        gap:35px;               /* Jarak lebih pas */
        margin-top:40px;
        flex-wrap:wrap;
         justify-content:space-between;
">

            <!-- Materi Selesai -->
            <div style="
    width:30%;
    min-width:260px;
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 3px 6px rgba(0,0,0,0.1);
">

                <!-- Kotak ikon -->
                <div style="
        width:55px;
        height:55px;
        background:#EC1763;
        border-radius:12px;
        display:flex;
        align-items:center;
        justify-content:center;
        margin-bottom:15px;
    ">
                    <img src="icon/award.svg" style="width:32px; height:32px;">
                </div>

                <h3 style="font-size:22px; font-weight:600;">Materi Selesai</h3>
                <p style="font-size:32px; margin-top:10px;">3</p>
            </div>


            <!-- Hari Belajar -->
            <div style="
    width:30%;
    min-width:260px;
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 3px 6px rgba(0,0,0,0.1);
">

                <div style="
        width:55px;
        height:55px;
        background:#E59600;
        border-radius:12px;
        display:flex;
        align-items:center;
        justify-content:center;
        margin-bottom:15px;
    ">
                    <img src="icon/date.svg" style="width:32px; height:32px;">
                </div>

                <h3 style="font-size:22px; font-weight:600;">Hari Belajar</h3>
                <p style="font-size:32px; margin-top:10px;">10</p>
            </div>



            <!-- Target Bulan -->
            <div style="
    width:30%;
    min-width:260px;
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 3px 6px rgba(0,0,0,0.1);
">

                <div style="
        width:55px;
        height:55px;
        background:#1355B2;
        border-radius:12px;
        display:flex;
        align-items:center;
        justify-content:center;
        margin-bottom:15px;
    ">
                    <img src="icon/target.svg" style="width:32px; height:32px;">
                </div>

                <h3 style="font-size:22px; font-weight:600;">Target Bulan Ini</h3>
                <p style="font-size:32px; margin-top:10px;">65%</p>
            </div>

        </div>


        <!-- Menu Bantuan -->
        <!-- Menu Bantuan -->
        <div style="
    background:white;
    margin-top:35px;
    padding:25px;
    border-radius:18px;
    box-shadow:0 3px 6px rgba(0,0,0,0.1);
    font-size:22px;
    display:flex;
    flex-direction:column;
    gap:18px;
    margin-bottom: 45px;  
">
            <p style="display:flex; align-items:center; gap:12px;">
                <img src="icon/help.svg" style="width:36px; height:36px;">
                Bantuan
            </p>


            <p style="display:flex; align-items:center; gap:12px;">
                <img src="icon/info.svg" style="width:36px; height:36px;">
                Informasi Versi
            </p>

            <p style="display:flex; align-items:center; gap:12px;">
                <img src="icon/logout.svg" style="width:36px; height:36px;">
                <a href="login.php">Logout</a>
            </p>
        </div>


        <!-- Pencapaian -->
        <h2 style="margin-top:45px; font-size:34px;">Pencapaian</h2>

        <div style="
    display:flex;
    gap:25px;
    margin-top:20px;
    flex-wrap:wrap;
    padding-bottom: 40px;
    justify-content:space-between;
">
            <!-- Card 1 -->
            <div style="
        width:22%;
        min-width:200px;
        background:white;
        padding:25px;
        border-radius:18px;
        box-shadow:0 3px 6px rgba(0,0,0,0.1);
        text-align:center;
    ">
                <img src="icon/tropy.svg" style="width:60px;">
                <p style="margin-top:10px; font-size:20px;">Pemula Berbicara</p>
            </div>

            <!-- Card 2 -->
            <div style="
        width:22%;
        min-width:200px;
        background:white;
        padding:25px;
        border-radius:18px;
        box-shadow:0 3px 6px rgba(0,0,0,0.1);
        text-align:center;
    ">
                <img src="icon/planet.svg" style="width:60px;">
                <p style="margin-top:10px; font-size:20px;">Fokus Belajar</p>
            </div>

            <!-- Card 3 -->
            <div style="
        width:22%;
        min-width:200px;
        background:white;
        padding:25px;
        border-radius:18px;
        box-shadow:0 3px 6px rgba(0,0,0,0.1);
        text-align:center;
    ">
                <img src="icon/api.svg" style="width:60px;">
                <p style="margin-top:10px; font-size:20px;">Streak 5 Hari</p>
            </div>

            <!-- Card 4 -->
            <div style="
        width:22%;
        min-width:200px;
        background:white;
        padding:25px;
        border-radius:18px;
        box-shadow:0 3px 6px rgba(0,0,0,0.1);
        text-align:center;
    ">
                <img src="icon/star.svg" style="width:60px;">
                <p style="margin-top:10px; font-size:20px;">Bintang Panggung</p>
            </div>


        </div>


</body>

</html>
