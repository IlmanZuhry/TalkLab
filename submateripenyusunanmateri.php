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
    <?php include 'includes/sidebar.php'; ?>

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
            <h1 class="course-header">Overview of Penyusunan Materi</h1>

            <div class="course-container">
                <!-- Sidebar Menu -->
                <div class="course-sidebar">
                    <div class="course-sidebar-header">
                        <span>Materi Penyusunan Materi</span>
                    </div>
                    <ul class="course-menu-list">
                        <li class="course-menu-item active">
                            <div class="course-menu-icon">
                                <span class="icon-text">▶</span> 1. Analisis Audiens
                            </div>
                            <span class="course-check-icon">✓</span>
                        </li>
                        <li class="course-menu-item">
                            <div class="course-menu-icon">
                                <span class="icon-text">▶</span> 2. Struktur & Outline Materi
                            </div>
                            <span class="course-check-icon">✓</span>
                        </li>
                        <li class="course-menu-item">
                            <div class="course-menu-icon">
                                <span class="icon-text">▶</span> 3. Penyusunan Slide & Visual
                            </div>
                            <span class="course-check-icon">✓</span>
                        </li>
                        <li class="course-menu-item">
                            <div class="course-menu-icon">
                                <span class="icon-text">▶</span> 4. Penyusunan Contoh & Latihan
                            </div>
                            <span class="course-check-icon">✓</span>
                        </li>
                        <li class="course-menu-item">
                            <div class="course-menu-icon">
                                <span class="icon-text">▶</span> 5. Finalisasi & Rehearsal
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
                title: "1. Analisis Audiens",
                videoSrc: "https://www.w3schools.com/html/mov_bbb.mp4",
                script: "Menentukan siapa audiens Anda, kebutuhan mereka, dan bagaimana menyesuaikan pesan agar relevan dan mudah diterima."
            },
            {
                title: "2. Struktur & Outline Materi",
                videoSrc: "https://www.w3schools.com/html/mov_bbb.mp4",
                script: "Cara membuat kerangka materi yang logis: pembukaan, isi, dan penutup dengan flow yang jelas."
            },
            {
                title: "3. Penyusunan Slide & Visual",
                videoSrc: "https://www.w3schools.com/html/mov_bbb.mp4",
                script: "Prinsip desain slide efektif: visual hierarchy, sedikit teks, dan penggunaan grafik yang mendukung pesan."
            },
            {
                title: "4. Penyusunan Contoh & Latihan",
                videoSrc: "https://www.w3schools.com/html/mov_bbb.mp4",
                script: "Menambahkan studi kasus, contoh nyata, dan latihan interaktif untuk membantu audiens menerapkan konsep."
            },
            {
                title: "5. Finalisasi & Rehearsal",
                videoSrc: "https://www.w3schools.com/html/mov_bbb.mp4",
                script: "Tips finalisasi materi dan sesi latihan untuk memastikan kelancaran penyampaian di depan audiens."
            },
        ];

        let currentIndex = 0;
        let video = document.getElementById('course-video');
        const nextBtn = document.getElementById('next-btn');
        const prevBtn = document.getElementById('prev-btn');
        const scriptText = document.getElementById('script-text');
        const menuItems = document.querySelectorAll('.course-menu-item');
        const videoContainer = document.querySelector('.video-player-placeholder');

        const MATERIAL_ID = 'penyusunan_materi';

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
                alert("Selamat! Anda telah menyelesaikan kelas Penyusunan Materi.");
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
