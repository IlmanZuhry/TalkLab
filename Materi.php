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

  main {
    flex: 1;
    padding: 120px 40px 40px;
    margin-left: 327px;
  }


  main h1 {
    font-size: 1.8rem;
    margin-bottom: 4px;
    font-weight: 700;
    text-align: left;
    width: 50%;
  }


  main p.subheading {
    color: #b2b2b2;
    margin-top: 0;
    margin-bottom: 20px;
    font-weight: 500;
    text-align: left;
    width: 90%;
  }


  .search-bar {
    max-width: 500px;
    width: 100%;
    margin-bottom: 20px;
    display: flex;
    justify-content: flex-start;
  }

  .search-bar input[type="search"] {
    width: 100%;
    border: none;
    padding: 14px 26px;
    border-radius: 20px;
    box-shadow: 0px 0px 15px rgb(0 0 0 / 0.1);
    font-size: 14px;
    color: #888;
  }

  .search-bar input[type="search"]::placeholder {
    color: #ccc;
  }


  .filter-group {
    display: flex;
    gap: 10px;
    margin-bottom: 25px;
    justify-content: flex-start;
  }

  .filter-group button {
    border: none;
    padding: 14px 26px;
    border-radius: 20px;
    background-color: white;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 0 5px rgb(0 0 0 / 0.1);
    color: #1f2b52;
    transition: all 0.3s;
  }

  .filter-group button.active {
    background-color: #ba8e58;
    color: white;
    font-weight: 700;
    box-shadow: none;
  }



  .cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 25px;
    justify-content: center;
    width: 100%;
    max-width: 1200px;
  }


  .card {
    background: white;
    border-radius: 15px;
    box-shadow: 0px 4px 8px rgb(0 0 0 / 0.1);
    overflow: hidden;
    transition: transform 0.3s;
    cursor: pointer;
    height: 300px;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 6px 12px rgb(0 0 0 / 0.15);
  }

  .card-header {
    height: 120px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 50px;
    font-weight: 700;
    background-color: #5f73b6;
  }

  .vokal {
    background-color: #5f73b6;
  }

  .gerak-tubuh {
    background-color: #bddbec;
    color: #a6c8ca;
    font-weight: 900;
    font-size: 48px;
  }

  .kontak-mata {
    background-color: #c9db28;
    color: white;
    font-weight: 700;
    font-size: 48px;
  }

  .intonasi {
    background-color: #f41968;
    color: white;
    font-weight: 700;
    font-size: 48px;
  }

  .mengatasi-grogi {
    background-color: #f8cae0;
    color: #bb8aa1;
    font-weight: 700;
    font-size: 48px;
  }

  .gestur-tangan {
    background-color: #f16722;
    color: white;
    font-weight: 700;
    font-size: 48px;
  }

  .penyusunan-materi {
    background-color: #f1e64c;
    color: white;
    font-weight: 700;
    font-size: 48px;
  }

  .media-presentasi {
    background-color: #f8a435;
    color: white;
    font-weight: 700;
    font-size: 48px;
  }

  .card-body {
    padding: 12px 15px 20px;
    color: #b4b4b4;
  }

  .card-title {
    font-weight: 700;
    font-size: 17px;
    margin-bottom: 4px;
    color: #2a2a34;
  }

  a {
    text-decoration: none;
  }

  .card-desc {
    font-weight: 400;
    font-size: 15px;
    color: #b4b4b4;
    margin-bottom: 14px;
    min-height: 42px;
  }

  .card-info {
    font-size: 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-weight: 400;

  }

  .card-info .time {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .card-info .time svg {
    width: 14px;
    height: 14px;
  }

  .progress-text {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: #555;
    font-weight: 600;
    margin-bottom: -35px;
    margin-top: 10px;
    font-size: 14px;

  }



  .progress-text span {
    font-weight: 600;
    color: #ba8e58;
  }

  .progress-bar {
    height: 6px;
    background-color: #eee;
    border-radius: 4px;
    margin-top: 40px;
    overflow: hidden;

  }

  .progress {
    height: 6px;
    background-color: #ba8e58;
    border-radius: 4px;
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

      <li class="menu-item active">
        <svg class="icon" viewBox="0 0 24 24">
          <path fill="currentColor"
            d="M21 4H14C12.9 4 12 4.9 12 6V18C12 16.9 12.9 16 14 16H21V4M10 6C10 4.9 9.1 4 8 4H3V16H10C11.1 16 12 16.9 12 18V6C12 4.9 11.1 4 10 4M3 18V20H8C9.1 20 10 19.1 10 18H3M14 18C14 19.1 14.9 20 16 20H21V18H14Z" />
        </svg>
        <span>Materi</span>
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
    <h1 style="font-size:40px; font-weight:700; color:#000;">Materi Pembelajaran</h1>
    <p style="color:#777; font-size:20px; margin-bottom:30px;">Pilih materi yang ingin kamu pelajari</p>
    <div class="search-bar">
      <input type="search" placeholder="Cari materi..." />
    </div>

    <div class="filter-group">
      <button class="active">Semua</button>
      <a href="vokal.php">
        <button>Vokal</button>
      </a>
      <a href="Gerak-tubuh.php">
        <button>Gerak Tubuh</button>
      </a>
      <a href="lainnya.php">
        <button>Lainnya</button>
      </a>
    </div>

    <div class="cards">
      <a href="submaterivokal.php">
        <div class="card">
          <div class="card-header vokal" title="Vokal yang Jelas">
            <img src="icon/mic.svg" width="88" height="88" alt="Mic Icon">
          </div>

          <div class="card-body">
            <h2 class="card-title">Vokal yang Jelas</h2>
            <p class="card-desc">Belajar mengucapkan kata dengan jelas dan tegas</p>
            <div class="card-info">
              <div class="time">
                <svg viewBox="0 0 24 24">
                  <path
                    d="M12 22c5.52 0 10-4.48 10-10S17.52 2 12 2s-10 4.48-10 10 4.48 10 10 10zm-.5-15h1v6l5.25 3.15-.75 1.23L11.5 13V7z" />
                </svg>
                15 menit
              </div>
              <div>vokal</div>
            </div>
            <div class="progress-text">
              <span>Progress</span>
              <span>50%</span>
            </div>
            <div class="progress-bar">
              <div class="progress" style="width: 50%;"></div>
            </div>
          </div>
        </div>
      </a>

      <a href="submateripostertubuh.php">
        <div class="card">
          <div class="card-header gerak-tubuh" title="Postur Tubuh">
            <img src="icon/badan.svg" width="88" height="88" alt="Body Icon">
          </div>
          <div class="card-body">
            <h2 class="card-title">Postur Tubuh</h2>
            <p class="card-desc">Cara berdiri dan bergerak yang percaya diri</p>
            <div class="card-info">
              <div class="time">
                <svg viewBox="0 0 24 24">
                  <path
                    d="M12 22c5.52 0 10-4.48 10-10S17.52 2 12 2s-10 4.48-10 10 4.48 10 10 10zm-.5-15h1v6l5.25 3.15-.75 1.23L11.5 13V7z" />
                </svg>
                20 menit
              </div>
              <div>gerak tubuh</div>
            </div>
            <div class="progress-text">
              <span>Progress</span>
              <span>70%</span>
            </div>
            <div class="progress-bar">
              <div class="progress" style="width: 70%;"></div>
            </div>
          </div>
        </div>
      </a>

      <a href="submaterikontakmata.php">
        <div class="card">
          <div class="card-header kontak-mata" title="Kontak Mata">
            <img src="icon/mata.svg" width="88" height="88" alt="Mata Icon">
          </div>
          <div class="card-body">
            <h2 class="card-title">Kontak Mata</h2>
            <p class="card-desc">Teknik menatap audiens dengan nyaman</p>
            <div class="card-info">
              <div class="time">
                <svg viewBox="0 0 24 24">
                  <path
                    d="M12 22c5.52 0 10-4.48 10-10S17.52 2 12 2s-10 4.48-10 10 4.48 10 10 10zm-.5-15h1v6l5.25 3.15-.75 1.23L11.5 13V7z" />
                </svg>
                10 menit
              </div>
              <div>gerak tubuh</div>
            </div>
            <div class="progress-text">
              <span>Progress</span>
              <span>30%</span>
            </div>
            <div class="progress-bar">
              <div class="progress" style="width: 30%;"></div>
            </div>
          </div>
        </div>
      </a>

      <a href="submateriinotasisuara.php">
        <div class="card">
          <div class="card-header intonasi" title="Intonasi Suara">
            <img src="icon/ear.svg" width="88" height="88" alt="Ear Icon">
          </div>
          <div class="card-body">
            <h2 class="card-title">Intonasi Suara</h2>
            <p class="card-desc">Mengatur naik turunnya suara saat berbicara</p>
            <div class="card-info">
              <div class="time">
                <svg viewBox="0 0 24 24">
                  <path
                    d="M12 22c5.52 0 10-4.48 10-10S17.52 2 12 2s-10 4.48-10 10 4.48 10 10 10zm-.5-15h1v6l5.25 3.15-.75 1.23L11.5 13V7z" />
                </svg>
                10 menit
              </div>
              <div>vokal</div>
            </div>
            <div class="progress-text">
              <span>Progress</span>
              <span>50%</span>
            </div>
            <div class="progress-bar">
              <div class="progress" style="width: 50%;"></div>
            </div>
          </div>
        </div>
      </a>

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
                <svg viewBox="0 0 24 24">
                  <path
                    d="M12 22c5.52 0 10-4.48 10-10S17.52 2 12 2s-10 4.48-10 10 4.48 10 10 10zm-.5-15h1v6l5.25 3.15-.75 1.23L11.5 13V7z" />
                </svg>
                25 menit
              </div>
              <div>lainnya</div>
            </div>
            <div class="progress-text">
              <span>Progress</span>
              <span>50%</span>
            </div>
            <div class="progress-bar">
              <div class="progress" style="width: 50%;"></div>
            </div>
          </div>
        </div>
      </a>

      <a href="submaterigesturtangan.php">
        <div class="card">
          <div class="card-header gestur-tangan" title="Gestur Tangan">
            <img src="icon/emot.svg" width="88" height="88" alt="Emot Icon">
          </div>
          <div class="card-body">
            <h2 class="card-title">Gestur Tangan</h2>
            <p class="card-desc">Menggunakan gerakan tangan untuk memperkuat pesan</p>
            <div class="card-info">
              <div class="time">
                <svg viewBox="0 0 24 24">
                  <path
                    d="M12 22c5.52 0 10-4.48 10-10S17.52 2 12 2s-10 4.48-10 10 4.48 10 10 10zm-.5-15h1v6l5.25 3.15-.75 1.23L11.5 13V7z" />
                </svg>
                10 menit
              </div>
              <div>gerak tubuh</div>
            </div>
            <div class="progress-text">
              <span></span>
              <span></span>
            </div>
            <div class="progress-bar">
              <div class="progress" style="width: 0%;"></div>
            </div>
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
                <svg viewBox="0 0 24 24">
                  <path
                    d="M12 22c5.52 0 10-4.48 10-10S17.52 2 12 2s-10 4.48-10 10 4.48 10 10 10zm-.5-15h1v6l5.25 3.15-.75 1.23L11.5 13V7z" />
                </svg>
                15 menit
              </div>
              <div>lainnya</div>
            </div>
            <div class="progress-text">
              <span></span>
              <span></span>
            </div>
            <div class="progress-bar">
              <div class="progress" style="width: 0%;"></div>
            </div>
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
                <svg viewBox="0 0 24 24">
                  <path
                    d="M12 22c5.52 0 10-4.48 10-10S17.52 2 12 2s-10 4.48-10 10 4.48 10 10 10zm-.5-15h1v6l5.25 3.15-.75 1.23L11.5 13V7z" />
                </svg>
                15 menit
              </div>
              <div>lainnya</div>
            </div>
            <div class="progress-text">
              <span></span>
              <span></span>
            </div>
            <div class="progress-bar">
              <div class="progress" style="width: 0%;"></div>
            </div>
          </div>
        </div>
      </a>
    </div>
  </main>

</body>

</html>
