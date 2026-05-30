<?php
require_once 'core.php';
if (session_status() == PHP_SESSION_NONE) session_start();
$app = new manz();

$currentUser = $app->getCurrentUser();
$progressData = [];

$material_totals = [
    'vokal' => 3,
    'postur_tubuh' => 5,
    'kontak_mata' => 5,
    'intonasi_suara' => 5,
    'mengatasi_grogi' => 5,
    'gestur_tangan' => 5,
    'penyusunan_materi' => 5,
    'media_presentasi' => 5
];

if ($currentUser) {
    foreach ($material_totals as $mId => $total) {
        $prog = $app->getMaterialProgress($currentUser['Id_User'], $mId);
        $completed = $prog + 1;
        if ($completed > $total) $completed = $total;
        if ($completed < 0) $completed = 0;
        $pct = round(($completed / $total) * 100);
        $progressData[$mId] = $pct;
    }
} else {
    foreach ($material_totals as $mId => $total) {
        $progressData[$mId] = 0;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TALKLAB - Lainnya</title>
  <?php include 'includes/layout_css.php'; ?>
  <style>
    main { flex: 1; padding: 120px 40px 40px; margin-left: 327px; }
    a { text-decoration: none; }

    .search-bar { max-width: 500px; width: 100%; margin-bottom: 20px; display: flex; justify-content: flex-start; }
    .search-bar input[type="search"] { width: 100%; border: none; padding: 14px 26px; border-radius: 20px; box-shadow: 0px 0px 15px rgb(0 0 0 / 0.1); font-size: 14px; color: #888; }
    .search-bar input[type="search"]::placeholder { color: #ccc; }

    .filter-group { display: flex; gap: 10px; margin-bottom: 25px; justify-content: flex-start; }
    .filter-group button { border: none; padding: 14px 26px; border-radius: 20px; background-color: white; font-weight: 600; cursor: pointer; box-shadow: 0 0 5px rgb(0 0 0 / 0.1); color: #1f2b52; transition: all 0.3s; }
    .filter-group button.active { background-color: #ba8e58; color: white; font-weight: 700; box-shadow: none; }

    .cards { display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px; width: 100%; max-width: 1200px; }
    .card { background: white; border-radius: 15px; box-shadow: 0px 4px 8px rgb(0 0 0 / 0.1); overflow: hidden; transition: transform 0.3s; cursor: pointer; height: 300px; }
    .card:hover { transform: translateY(-5px); box-shadow: 0px 6px 12px rgb(0 0 0 / 0.15); }
    .card-header { height: 120px; display: flex; justify-content: center; align-items: center; color: white; font-size: 50px; font-weight: 700; }
    .mengatasi-grogi { background-color: #f8cae0; color: #bb8aa1; font-weight: 700; font-size: 48px; }
    .penyusunan-materi { background-color: #f1e64c; color: white; font-weight: 700; font-size: 48px; }
    .media-presentasi { background-color: #f8a435; color: white; font-weight: 700; font-size: 48px; }
    .card-body { padding: 12px 15px 20px; color: #b4b4b4; }
    .card-title { font-weight: 700; font-size: 17px; margin-bottom: 4px; color: #2a2a34; }
    .card-desc { font-weight: 400; font-size: 15px; color: #b4b4b4; margin-bottom: 14px; min-height: 42px; }
    .card-info { font-size: 15px; display: flex; align-items: center; justify-content: space-between; font-weight: 400; }
    .card-info .time { display: flex; align-items: center; gap: 5px; }
    .card-info .time svg { width: 14px; height: 14px; }
    .progress-text { display: flex; justify-content: space-between; font-size: 14px; color: #555; font-weight: 600; margin-bottom: -35px; margin-top: 10px; }
    .progress-text span { font-weight: 600; color: #ba8e58; }
    .progress-bar { height: 6px; background-color: #eee; border-radius: 4px; margin-top: 40px; overflow: hidden; }
    .progress { height: 6px; background-color: #ba8e58; border-radius: 4px; }
  </style>
</head>

<body>
  <?php include 'includes/header.php'; ?>
  <?php include 'includes/sidebar.php'; ?>

  <main>
    <h1 style="font-size:40px; font-weight:700; color:#000;">Materi Pembelajaran</h1>
    <p style="color:#777; font-size:20px; margin-bottom:30px;">Pilih materi yang ingin kamu pelajari</p>

    <div class="search-bar">
      <input type="search" placeholder="Cari materi..." />
    </div>

    <div class="filter-group">
      <a href="Materi.php"><button>Semua</button></a>
      <a href="vokal.php"><button>Vokal</button></a>
      <a href="Gerak-tubuh.php"><button>Gerak Tubuh</button></a>
      <button class="active">Lainnya</button>
    </div>

    <div class="cards">
      <a href="submaterimengatasigrogi.php">
      <div class="card">
        <div class="card-header mengatasi-grogi" title="Mengatasi Grogi">
          <img src="icon/halo.svg" width="88" height="88" alt="Halo Icon">
        </div>
        <div class="card-body">
          <h2 class="card-title">Mengatasi Grogi</h2>
          <p class="card-desc">Tips menghilangkan rasa gugup di depan umum</p>
          <div class="card-info">
            <div class="time">
              <svg viewBox="0 0 24 24"><path d="M12 22c5.52 0 10-4.48 10-10S17.52 2 12 2s-10 4.48-10 10 4.48 10 10 10zm-.5-15h1v6l5.25 3.15-.75 1.23L11.5 13V7z" /></svg>
              25 menit
            </div>
            <div>lainnya</div>
          </div>
          <div class="progress-text"><span>Progress</span><span><?= $progressData['mengatasi_grogi'] ?>%</span></div>
          <div class="progress-bar"><div class="progress" style="width: <?= $progressData['mengatasi_grogi'] ?>%;"></div></div>
        </div>
      </div>
      </a>

      <a href="submateripenyusunanmateri.php">
      <div class="card">
        <div class="card-header penyusunan-materi" title="Penyusunan Materi">
          <img src="icon/book.svg" width="88" height="88" alt="Book Icon">
        </div>
        <div class="card-body">
          <h2 class="card-title">Penyusunan Materi</h2>
          <p class="card-desc">Penyampaian isi yang sistematis</p>
          <div class="card-info">
            <div class="time">
              <svg viewBox="0 0 24 24"><path d="M12 22c5.52 0 10-4.48 10-10S17.52 2 12 2s-10 4.48-10 10 4.48 10 10 10zm-.5-15h1v6l5.25 3.15-.75 1.23L11.5 13V7z" /></svg>
              15 menit
            </div>
            <div>lainnya</div>
          </div>
          <div class="progress-text"><span>Progress</span><span><?= $progressData['penyusunan_materi'] ?>%</span></div>
          <div class="progress-bar"><div class="progress" style="width: <?= $progressData['penyusunan_materi'] ?>%;"></div></div>
        </div>
      </div>
      </a>

      <a href="submaterimediapesentasi.php">
      <div class="card">
        <div class="card-header media-presentasi" title="Media Presentasi">
          <img src="icon/media.svg" width="88" height="88" alt="Media Icon">
        </div>
        <div class="card-body">
          <h2 class="card-title">Media Presentasi</h2>
          <p class="card-desc">Tips menggunakan microphone dan panggung</p>
          <div class="card-info">
            <div class="time">
              <svg viewBox="0 0 24 24"><path d="M12 22c5.52 0 10-4.48 10-10S17.52 2 12 2s-10 4.48-10 10 4.48 10 10 10zm-.5-15h1v6l5.25 3.15-.75 1.23L11.5 13V7z" /></svg>
              15 menit
            </div>
            <div>lainnya</div>
          </div>
          <div class="progress-text"><span>Progress</span><span><?= $progressData['media_presentasi'] ?>%</span></div>
          <div class="progress-bar"><div class="progress" style="width: <?= $progressData['media_presentasi'] ?>%;"></div></div>
        </div>
      </div>
      </a>
    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.querySelector('.search-bar input[type="search"]');
      const cards = document.querySelectorAll('.cards > a');
      
      if (searchInput) {
        searchInput.addEventListener('input', function(e) {
          const searchTerm = e.target.value.toLowerCase();
          
          cards.forEach(cardLink => {
            const titleEl = cardLink.querySelector('.card-title');
            if (titleEl) {
              const title = titleEl.textContent.toLowerCase();
              if (title.includes(searchTerm)) {
                cardLink.style.display = 'block';
              } else {
                cardLink.style.display = 'none';
              }
            }
          });
        });
      }
    });
  </script>
</body>
</html>
