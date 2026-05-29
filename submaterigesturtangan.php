<?php
require_once 'core.php';
$app = new manz();
$app->ensureSession();
?>
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

    /* Course Layout Styles */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #1c407a;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 16px;
        font-size: 16px;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: #15305c;
        text-decoration: underline;
    }

    .course-header {
        font-size: 28px;
        font-weight: bold;
        color: #1c407a;
        margin-bottom: 24px;
    }

    .course-container {
        display: flex;
        gap: 32px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 32px;
        min-height: 600px;
    }

    .course-sidebar {
        width: 320px;
        border-right: 1px solid #eee;
        padding-right: 24px;
    }

    .course-sidebar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        font-weight: 600;
        font-size: 18px;
        color: #333;
    }

    .course-completed-text {
        font-size: 14px;
        color: #28a745;
        font-weight: 600;
    }

    .course-menu-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .course-menu-item {
        padding: 14px 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #555;
        cursor: pointer;
        font-size: 15px;
        border-radius: 8px;
        transition: background-color 0.2s;
        margin-bottom: 4px;
    }

    .course-menu-item:hover {
        background-color: #f8f9fa;
    }

    .course-menu-item.active {
        background-color: #eef3fc;
        color: #1c407a;
        font-weight: 600;
    }

    .course-menu-icon {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .course-menu-icon svg,
    .course-menu-icon .icon-text {
        color: inherit;
    }

    .course-check-icon {
        color: #28a745;
        font-weight: bold;
        display: none;
    }

    .course-menu-item.completed .course-check-icon {
        display: block;
    }

    .course-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .video-player-placeholder {
        width: 100%;
        aspect-ratio: 16 / 9;
        background: #f0f0f0;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        margin-bottom: 24px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .play-button {
        width: 64px;
        height: 64px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: transform 0.2s;
    }

    .play-button:hover {
        transform: scale(1.05);
    }

    .play-button svg {
        fill: #1c407a;
        width: 28px;
        height: 28px;
        margin-left: 4px;
    }

    .script-section {
        flex: 1;
    }

    .script-title {
        font-weight: 700;
        color: #333;
        margin-bottom: 12px;
        font-size: 16px;
    }

    .script-text {
        color: #555;
        line-height: 1.7;
        font-size: 15px;
        margin-bottom: 32px;
    }

    .course-navigation {
        display: flex;
        justify-content: center;
        gap: 16px;
        margin-top: auto;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .nav-btn {
        padding: 10px 24px;
        border: 1px solid #ddd;
        background: #fff;
        border-radius: 20px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        color: #555;
        transition: all 0.2s;
        min-width: 120px;
    }

    .nav-btn:hover {
        background: #f8f9fa;
        border-color: #ccc;
    }

    .nav-btn.next {
        background: #1c407a;
        color: white;
        border: 1px solid #1c407a;
    }

    .nav-btn.next:hover {
        background: #15305c;
        border-color: #15305c;
    }
</style>

<body>
    <?php include 'includes/header.php'; ?>

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

            <li class="menu-item active">
                <svg class="icon" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M21 4H14C12.9 4 12 4.9 12 6V18C12 16.9 12.9 16 14 16H21V4M10 6C10 4.9 9.1 4 8 4H3V16H10C11.1 16 12 16.9 12 18V6C12 4.9 11.1 4 10 4M3 18V20H8C9.1 20 10 19.1 10 18H3M14 18C14 19.1 14.9 20 16 20H21V18H14Z" />
                </svg>
                <span>Materi</span>
            </li>

            <li class="menu-item">
                <a href="Latihan.php">
                    <svg class="icon" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.5 37.5V29.8126L20.0625 30.1876C21.0996 30.1299 22.0811 29.6999 22.8266 28.9765C23.572 28.2531 24.0313 27.285 24.12 26.2501V15.5626C24.1324 12.8613 23.0713 10.2658 21.17 8.34694C19.2688 6.42809 16.6831 5.34311 13.9819 5.33067C11.2806 5.31824 8.68511 6.37938 6.76626 8.28065C4.84741 10.1819 3.76243 12.7676 3.75 15.4688C3.75 20.7188 4.98 21.1951 5.625 24.0001C6.05868 25.6944 6.07734 27.4683 5.67938 29.1713L3.75 37.5M37.125 33.3751C39.7609 30.7388 41.2422 27.1639 41.2432 23.4359C41.2443 19.7079 39.765 16.1321 37.1306 13.4944M31.875 28.1251C32.4885 27.5117 32.9742 26.7829 33.3042 25.9806C33.6342 25.1784 33.8019 24.3187 33.7975 23.4512C33.7931 22.5838 33.6169 21.7258 33.2788 20.9269C32.9408 20.128 32.4477 19.4041 31.8281 18.7969" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Latihan</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="Ebook.php">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M21 4H14C12.9 4 12 4.9 12 6V18C12 16.9 12.9 16 14 16H21V4M10 6C10 4.9 9.1 4 8 4H3V16H10C11.1 16 12 16.9 12 18V6C12 4.9 11.1 4 10 4M3 18V20H8C9.1 20 10 19.1 10 18H3M14 18C14 19.1 14.9 20 16 20H21V18H14Z" />
                    </svg>
                    <span>E-Book</span>
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
        <div
            style="margin-left: 260px; padding: 120px 40px 40px; width: calc(100% - 260px); display: flex; flex-direction: column; box-sizing: border-box;">
            <div>
                <a href="materi.php" class="back-link">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <path fill="currentColor" d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
                    </svg>
                    Kembali ke Materi
                </a>
            </div>
            <h1 class="course-header">Overview of Gestur Tangan</h1>

            <div class="course-container">
                <!-- Sidebar Menu -->
                <div class="course-sidebar">
                    <div class="course-sidebar-header">
                        <span>Materi Gestur Tangan</span>
                    </div>
                    <ul class="course-menu-list">
                        <li class="course-menu-item active">
                            <div class="course-menu-icon">
                                <span class="icon-text">▶</span> 1. Jenis Gesture & Maknanya
                            </div>
                            <span class="course-check-icon">✓</span>
                        </li>
                        <li class="course-menu-item">
                            <div class="course-menu-icon">
                                <span class="icon-text">▶</span> 2. Timing & Sinkronisasi dengan Bicara
                            </div>
                            <span class="course-check-icon">✓</span>
                        </li>
                        <li class="course-menu-item">
                            <div class="course-menu-icon">
                                <span class="icon-text">▶</span> 3. Menghindari Gesture yang Mengganggu
                            </div>
                            <span class="course-check-icon">✓</span>
                        </li>
                        <li class="course-menu-item">
                            <div class="course-menu-icon">
                                <span class="icon-text">▶</span> 4. Koordinasi Mata, Gesture & Suara
                            </div>
                            <span class="course-check-icon">✓</span>
                        </li>
                        <li class="course-menu-item">
                            <div class="course-menu-icon">
                                <span class="icon-text">▶</span> 5. Latihan Praktis Gesture
                            </div>
                            <span class="course-check-icon">✓</span>
                        </li>
                    </ul>
                </div>

                <!-- Main Content -->
                <div class="course-content">
                    <div class="video-player-placeholder">
                        <video id="course-video" width="100%" height="100%" controls style="object-fit: cover;">
                            <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                            Your browser does not support HTML video.
                        </video>
                    </div>

                    <div class="script-section">
                        <div class="script-title">Penjelasan:</div>
                        <div class="script-text" id="script-text">
                            Halo, selamat datang di kursus TalkLab tentang Artikulasi Dasar. Apa yang baru saja kita
                            lihat dalam ilustrasi sebelumnya adalah bagaimana bentuk mulut yang tepat dapat memengaruhi
                            kejernihan suara Anda. Menguasai artikulasi adalah langkah pertama yang krusial untuk
                            berbicara dengan jelas, percaya diri, dan mudah dipahami oleh audiens Anda. Mari kita mulai
                            melatihnya!
                        </div>
                    </div>

                    <div class="course-navigation">
                        <button class="nav-btn" id="prev-btn" disabled style="opacity: 0.5; cursor: not-allowed;">« Previous</button>
                        <button class="nav-btn next" id="next-btn" disabled style="opacity: 0.5; cursor: not-allowed;">Next »</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const materials = [
            {
                title: "1. Jenis Gesture & Maknanya",
                videoSrc: "https://www.w3schools.com/html/mov_bbb.mp4",
                script: "Mengenal gesture ilustratif, emblem, dan regulator serta arti nonverbal yang mereka bawa."
            },
            {
                title: "2. Timing & Sinkronisasi dengan Bicara",
                videoSrc: "https://www.w3schools.com/html/mov_bbb.mp4",
                script: "Memadukan gesture dengan ritme bicara agar terlihat natural dan mendukung pesan."
            },
            {
                title: "3. Menghindari Gesture yang Mengganggu",
                videoSrc: "https://www.w3schools.com/html/mov_bbb.mp4",
                script: "Kebiasaan tangan yang mengganggu dan cara menggantinya dengan gesture yang efektif."
            },
            {
                title: "4. Koordinasi Mata, Gesture & Suara",
                videoSrc: "https://www.w3schools.com/html/mov_bbb.mp4",
                script: "Menyelaraskan kontak mata, ekspresi wajah, dan gesture untuk dampak maksimal."
            },
            {
                title: "5. Latihan Praktis Gesture",
                videoSrc: "https://www.w3schools.com/html/mov_bbb.mp4",
                script: "Latihan sederhana untuk membangun kebiasaan gesture yang mendukung presentasi."
            },
        ];

        let currentIndex = 0;
        let video = document.getElementById('course-video');
        const nextBtn = document.getElementById('next-btn');
        const prevBtn = document.getElementById('prev-btn');
        const scriptText = document.getElementById('script-text');
        const menuItems = document.querySelectorAll('.course-menu-item');
        const videoContainer = document.querySelector('.video-player-placeholder');

        const MATERIAL_ID = 'gestur_tangan';

        function saveProgressToDB(index) {
            const formData = new FormData();
            formData.append('action', 'save_progress');
            formData.append('material_id', MATERIAL_ID);
            formData.append('progress', index);

            fetch('api_progress.php', {
                method: 'POST',
                body: formData
            }).then(res => res.json()).then(data => {
                console.log('Progress saved:', data);
            }).catch(err => console.error(err));
        }

        function attachVideoEvent(vid) {
            vid.addEventListener('ended', () => {
                // Tandai materi saat ini sebagai selesai
                menuItems[currentIndex].classList.add('completed');
                
                // Simpan progress ke database
                saveProgressToDB(currentIndex);

                nextBtn.disabled = false;
                nextBtn.style.opacity = '1';
                nextBtn.style.cursor = 'pointer';
            });
        }

        if (video) {
            attachVideoEvent(video);
        }

        function loadMaterial(index) {
            if (index < 0 || index >= materials.length) return;
            
            menuItems.forEach((item, i) => {
                if (i === index) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });

            const mat = materials[index];
            scriptText.innerText = mat.script;

            if (mat.videoSrc) {
                videoContainer.innerHTML = `<video id="course-video" width="100%" height="100%" controls autoplay style="object-fit: cover;">
                                                <source src="${mat.videoSrc}" type="video/mp4">
                                                Your browser does not support HTML video.
                                            </video>`;
                video = document.getElementById('course-video');
                attachVideoEvent(video);
                
                nextBtn.disabled = true;
                nextBtn.style.opacity = '0.5';
                nextBtn.style.cursor = 'not-allowed';
            } else {
                videoContainer.innerHTML = `<div style="display:flex; justify-content:center; align-items:center; height:100%; width:100%; background:#f0f0f0; border-radius:12px; font-size:24px; font-weight:bold; color:#1c407a;">
                                                Ujian Akhir
                                            </div>`;
                nextBtn.disabled = false;
                nextBtn.style.opacity = '1';
                nextBtn.style.cursor = 'pointer';
            }

            prevBtn.disabled = index === 0;
            prevBtn.style.opacity = index === 0 ? '0.5' : '1';
            prevBtn.style.cursor = index === 0 ? 'not-allowed' : 'pointer';

            if (index === materials.length - 1) {
                nextBtn.innerText = "Selesai";
            } else {
                nextBtn.innerText = "Next »";
            }

            currentIndex = index;

            // Cek status dari menuItems untuk menentukan apakah tombol next aktif
            if (menuItems[index].classList.contains('completed')) {
                nextBtn.disabled = false;
                nextBtn.style.opacity = '1';
                nextBtn.style.cursor = 'pointer';
            }
        }

        nextBtn.addEventListener('click', () => {
            if (currentIndex < materials.length - 1) {
                loadMaterial(currentIndex + 1);
            } else {
                alert("Selamat! Anda telah menyelesaikan kelas Gestur Tangan.");
                window.location.href = 'Materi.php';
            }
        });

        // Load progress dari database saat halaman pertama kali dibuka
        window.addEventListener('DOMContentLoaded', () => {
            const formData = new FormData();
            formData.append('action', 'get_progress');
            formData.append('material_id', MATERIAL_ID);

            fetch('api_progress.php', {
                method: 'POST',
                body: formData
            }).then(res => res.json()).then(data => {
                if(data.status && data.progress !== undefined) {
                    let maxProgress = parseInt(data.progress);
                    menuItems.forEach((item, i) => {
                        if (i <= maxProgress) {
                            item.classList.add('completed');
                        }
                    });
                    if (currentIndex <= maxProgress) {
                        nextBtn.disabled = false;
                        nextBtn.style.opacity = '1';
                        nextBtn.style.cursor = 'pointer';
                    }
                }
            }).catch(err => console.error(err));
        });

        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                loadMaterial(currentIndex - 1);
            }
        });
        
        // To allow clicking directly on the menu items for demonstration purposes (optional, can be removed if strict sequence is required)
        menuItems.forEach((item, i) => {
            item.addEventListener('click', () => {
                // If you want to force them to watch it linearly, comment this out. 
                // Currently allowing for better UX in testing.
                loadMaterial(i);
            });
        });
    </script>
</body>

</html>
