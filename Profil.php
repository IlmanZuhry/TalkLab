<?php
require_once 'core.php';
if (session_status() == PHP_SESSION_NONE) session_start();
$app = new manz();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TALKLAB - Profil</title>
    <?php include 'includes/layout_css.php'; ?>
    <style>
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
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/sidebar.php'; ?>

    <div style="margin-left:260px; padding-top:120px; width:100%; padding-left:40px; padding-right:40px;">

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
            position:relative;
            overflow:hidden;
        ">
            <div class="ornamen-left"></div>
            <div class="ornamen-right"></div>
            <div style="display:flex; align-items:center; gap:25px;">
                <div style="width:200px; height:200px; border-radius:50%; border:5px solid #d2a06b; overflow:hidden;">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTF9kb4Z-541wLQd0fNTOTUyExgV9kJG6TXDw&s"
                        style="width:100%; height:100%; object-fit:cover;">
                </div>
                <div>
                    <h2 style="font-size:32px; font-weight:700;">Bahenol</h2>
                    <p style="font-size:22px; color:#d2a06b;">@bahlulethanol</p>
                    <p style="font-size:20px; margin-top:10px;">"yang penting bicara aja dulu"</p>
                </div>
            </div>
            <button style="background:#d2a06b; padding:10px 26px; color:white; font-size:20px; border:none; border-radius:12px; cursor:pointer; margin-right: 40px;">
                Edit Profil
            </button>
        </div>

        <!-- Box Statistik -->
        <div style="display:flex; gap:35px; margin-top:40px; flex-wrap:wrap; justify-content:space-between;">

            <div style="width:30%; min-width:260px; background:white; padding:30px; border-radius:18px; box-shadow:0 3px 6px rgba(0,0,0,0.1);">
                <div style="width:55px; height:55px; background:#EC1763; border-radius:12px; display:flex; align-items:center; justify-content:center; margin-bottom:15px;">
                    <img src="icon/award.svg" style="width:32px; height:32px;">
                </div>
                <h3 style="font-size:22px; font-weight:600;">Materi Selesai</h3>
                <p style="font-size:32px; margin-top:10px;">3</p>
            </div>

            <div style="width:30%; min-width:260px; background:white; padding:30px; border-radius:18px; box-shadow:0 3px 6px rgba(0,0,0,0.1);">
                <div style="width:55px; height:55px; background:#E59600; border-radius:12px; display:flex; align-items:center; justify-content:center; margin-bottom:15px;">
                    <img src="icon/date.svg" style="width:32px; height:32px;">
                </div>
                <h3 style="font-size:22px; font-weight:600;">Hari Belajar</h3>
                <p style="font-size:32px; margin-top:10px;">10</p>
            </div>

            <div style="width:30%; min-width:260px; background:white; padding:30px; border-radius:18px; box-shadow:0 3px 6px rgba(0,0,0,0.1);">
                <div style="width:55px; height:55px; background:#1355B2; border-radius:12px; display:flex; align-items:center; justify-content:center; margin-bottom:15px;">
                    <img src="icon/target.svg" style="width:32px; height:32px;">
                </div>
                <h3 style="font-size:22px; font-weight:600;">Target Bulan Ini</h3>
                <p style="font-size:32px; margin-top:10px;">65%</p>
            </div>

        </div>

        <!-- Menu Bantuan -->
        <div style="background:white; margin-top:35px; padding:25px; border-radius:18px; box-shadow:0 3px 6px rgba(0,0,0,0.1); font-size:22px; display:flex; flex-direction:column; gap:18px; margin-bottom: 45px;">
            <p style="display:flex; align-items:center; gap:12px;">
                <img src="icon/help.svg" style="width:36px; height:36px;"> Bantuan
            </p>
            <p style="display:flex; align-items:center; gap:12px;">
                <img src="icon/info.svg" style="width:36px; height:36px;"> Informasi Versi
            </p>
            <p style="display:flex; align-items:center; gap:12px;">
                <img src="icon/logout.svg" style="width:36px; height:36px;">
                <a href="login.php">Logout</a>
            </p>
        </div>

        <!-- Pencapaian -->
        <h2 style="margin-top:45px; font-size:34px;">Pencapaian</h2>

        <div style="display:flex; gap:25px; margin-top:20px; flex-wrap:wrap; padding-bottom: 40px; justify-content:space-between;">
            <div style="width:22%; min-width:200px; background:white; padding:25px; border-radius:18px; box-shadow:0 3px 6px rgba(0,0,0,0.1); text-align:center;">
                <img src="icon/tropy.svg" style="width:60px;">
                <p style="margin-top:10px; font-size:20px;">Pemula Berbicara</p>
            </div>
            <div style="width:22%; min-width:200px; background:white; padding:25px; border-radius:18px; box-shadow:0 3px 6px rgba(0,0,0,0.1); text-align:center;">
                <img src="icon/planet.svg" style="width:60px;">
                <p style="margin-top:10px; font-size:20px;">Fokus Belajar</p>
            </div>
            <div style="width:22%; min-width:200px; background:white; padding:25px; border-radius:18px; box-shadow:0 3px 6px rgba(0,0,0,0.1); text-align:center;">
                <img src="icon/api.svg" style="width:60px;">
                <p style="margin-top:10px; font-size:20px;">Streak 5 Hari</p>
            </div>
            <div style="width:22%; min-width:200px; background:white; padding:25px; border-radius:18px; box-shadow:0 3px 6px rgba(0,0,0,0.1); text-align:center;">
                <img src="icon/star.svg" style="width:60px;">
                <p style="margin-top:10px; font-size:20px;">Bintang Panggung</p>
            </div>
        </div>

    </div>

</body>

</html>
