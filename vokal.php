<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TALKLAB - Vokal</title>
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
    .vokal { background-color: #5f73b6; }
    .intonasi { background-color: #f41968; color: white; font-weight: 700; font-size: 48px; }
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
      <button class="active">Vokal</button>
      <a href="Gerak-tubuh.php"><button>Gerak Tubuh</button></a>
      <a href="lainnya.php"><button>Lainnya</button></a>
    </div>

    <div class="cards">
      <div class="card">
        <div class="card-header vokal" title="Vokal yang Jelas">
          <img src="icon/mic.svg" width="88" height="88" alt="Mic Icon">
        </div>
        <div class="card-body">
          <h2 class="card-title">Vokal yang Jelas</h2>
          <p class="card-desc">Belajar mengucapkan kata dengan jelas dan tegas</p>
          <div class="card-info">
            <div class="time">
              <svg viewBox="0 0 24 24"><path d="M12 22c5.52 0 10-4.48 10-10S17.52 2 12 2s-10 4.48-10 10 4.48 10 10 10zm-.5-15h1v6l5.25 3.15-.75 1.23L11.5 13V7z" /></svg>
              15 menit
            </div>
            <div>vokal</div>
          </div>
          <div class="progress-text"><span>Progress</span><span>50%</span></div>
          <div class="progress-bar"><div class="progress" style="width: 50%;"></div></div>
        </div>
      </div>

      <div class="card">
        <div class="card-header intonasi" title="Intonasi Suara">
          <img src="icon/ear.svg" width="88" height="88" alt="Ear Icon">
        </div>
        <div class="card-body">
          <h2 class="card-title">Intonasi Suara</h2>
          <p class="card-desc">Mengatur naik turunnya suara saat berbicara</p>
          <div class="card-info">
            <div class="time">
              <svg viewBox="0 0 24 24"><path d="M12 22c5.52 0 10-4.48 10-10S17.52 2 12 2s-10 4.48-10 10 4.48 10 10 10zm-.5-15h1v6l5.25 3.15-.75 1.23L11.5 13V7z" /></svg>
              10 menit
            </div>
            <div>vokal</div>
          </div>
          <div class="progress-text"><span>Progress</span><span>50%</span></div>
          <div class="progress-bar"><div class="progress" style="width: 50%;"></div></div>
        </div>
      </div>
    </div>
  </main>

</body>
</html>
