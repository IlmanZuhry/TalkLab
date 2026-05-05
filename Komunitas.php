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
    margin-left: 250px;
    margin-top: 64px;
    padding: 40px;
    flex-grow: 1;
    background-color: #f7f7fc;
    min-height: calc(90vh - 64px);
    overflow-y: auto;
  }

  main h1 {
    font-weight: 700;
    font-size: 28px;
    color: #101828;
    margin-bottom: 6px;
    margin-top: 20px;
  }

  main p.subheading {
    color: #8f95a6;
    font-weight: 400;
    font-size: 15px;
    margin-bottom: 24px;
  }

  .btn-posting {
    float: right;
    background-color: #bca451;
    color: white;
    padding: 10px 25px;
    border: none;
    border-radius: 12px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s;
    user-select: none;
    margin-bottom: 24px;
    margin-top: -55px;
  }

  .btn-posting:hover {
    background-color: #a5924a;
  }

  .clearfix::after {
    content: "";
    display: table;
    clear: both;
  }


  .post-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }


  article.post {
    background-color: white;
    padding: 20px 24px;
    border-radius: 16px;
    box-shadow: 0 2px 6px rgb(0 0 0 / 0.08);
    display: flex;
    flex-direction: column;
    gap: 12px;
    position: relative;
  }


  .post-header {
    display: flex;
    align-items: center;
    gap: 14px;
  }

  .post-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #bca451;
    flex-shrink: 0;
  }

  .post-author-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
    user-select: text;
  }

  .post-author {
    font-weight: 700;
    font-size: 16px;
    color: #101828;
    line-height: 1.1;
  }

  .post-username-time {
    font-size: 13px;
    color: #8f95a6;
    user-select: none;
  }


  .post-menu {
    position: absolute;
    top: 20px;
    right: 20px;
    background: none;
    border: none;
    font-size: 22px;
    color: #c4c4c4;
    cursor: pointer;
    user-select: none;
  }

  .post-menu:hover {
    color: #bca451;
  }


  .post-text {
    font-size: 15px;
    line-height: 1.5;
    color: #434445;
    background-color: #f5f5f5;
    border-radius: 12px;
    padding: 18px 0;
    white-space: pre-wrap;
    user-select: text;
    text-align: left;

  }


  .post-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 13px;
    color: #8f95a6;
  }

  .post-share {
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .post-share img {
    width: 18px;
    height: 18px;
  }

  .reaction-icon img {
    width: 18px;
    height: 18px;
    display: inline-block;
  }

  .reaction-icon {
    display: flex;
    align-items: center;
    gap: 6px;
  }


  .post-footer .reactions {
    display: flex;
    gap: 20px;
    user-select: none;
  }

  .reaction-icon {
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .reaction-icon svg {
    width: 16px;
    height: 16px;
    fill: #8f95a6;
  }

  .post-share {
    cursor: pointer;
    font-weight: 600;
    color: #8f95a6;
    transition: color 0.3s;
    user-select: none;
    background: none;
    border: none;
    padding: 0;
  }

  .post-share:hover {
    color: #bca451;
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


      <li class="menu-item active">
        <svg class="icon" viewBox="0 0 24 24">
          <path fill="currentColor"
            d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zM8 11c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
        </svg>
        <span>Komunitas</span>
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

  <main role="main" tabindex="-1">
    <div class="clearfix">
      <h1 style="font-size:40px; font-weight:700; color:#000;">Komunitas</h1>
      <p style="color:#777; font-size:20px; margin-bottom:30px;">Berbagi pengalaman dan belajar bersama</p>
      <button class="btn-posting" type="button" aria-label="Buat Postingan">
        Buat Postingan
      </button>
    </div>

    <section class="post-list" aria-label="Daftar posting komunitas">

      <article class="post" tabindex="0">
        <header class="post-header">
          <img src="https://i.pravatar.cc/44?u=fathul" alt="Avatar Fathul Khairah" class="post-avatar" width="44"
            height="44" />
          <div class="post-author-info">
            <div class="post-author">Fathul Khairah</div>
            <div class="post-username-time">@fathulimoet • 3 hari lalu</div>
          </div>
          <button class="post-menu" aria-label="Opsi postingan">&#8942;</button>
        </header>
        <p class="post-text">
          Kalian biasanya belajar sendiri apa bareng-bareng guys? Aku lebih suka bareng
          temen soalnya bisa saling kasih feedback
        </p>
        <footer class="post-footer">
          <div class="reactions" aria-label="Reaksi postingan">
            <div class="reaction-icon" aria-label="20 likes">
              <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09
                  C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
              </svg>
              20
            </div>
            <div class="reaction-icon" aria-label="15 komentar">
              <img src="icon/komen.svg" style="width:18px; height:18px;">
              15 komentar
            </div>
          </div>
          <button class="post-share" aria-label="Bagikan postingan">
            <img src="icon/share.svg" style="width:18px; height:18px; margin-right:6px;">
            Bagikan
          </button>

        </footer>
      </article>

      <article class="post" tabindex="0">
        <header class="post-header">
          <img src="https://i.pravatar.cc/44?u=ilman" alt="Avatar Ilman Ethanol" class="post-avatar" width="44"
            height="44" />
          <div class="post-author-info">
            <div class="post-author">Ilman Ethanol</div>
            <div class="post-username-time">@ilmannol • 4 hari lalu</div>
          </div>
          <button class="post-menu" aria-label="Opsi postingan">&#8942;</button>
        </header>
        <p class="post-text">
          Baru aja selesai latihan vokal! Rasanya progress banget dari minggu kemarin. Tips:
          jangan lupa warming up dulu ya sebelum latihan!
        </p>
        <footer class="post-footer">
          <div class="reactions" aria-label="Reaksi postingan">
            <div class="reaction-icon" aria-label="20 likes">
              <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09
                  C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
              </svg>
              20
            </div>
            <div class="reaction-icon" aria-label="15 komentar">
              <img src="icon/komen.svg" style="width:18px; height:18px;">
              15 komentar
            </div>

          </div>
          <button class="post-share" aria-label="Bagikan postingan">
            <img src="icon/share.svg" style="width:18px; height:18px; margin-right:6px;">
            Bagikan
          </button>
        </footer>
      </article>

      <article class="post" tabindex="0">
        <header class="post-header">
          <img src="https://i.pravatar.cc/44?u=riski" alt="Avatar Riski Galon" class="post-avatar" width="44"
            height="44" />
          <div class="post-author-info">
            <div class="post-author">Riski Galon</div>
            <div class="post-username-time">@kanggalon • 1 minggu lalu</div>
          </div>
          <button class="post-menu" aria-label="Opsi postingan">&#8942;</button>
        </header>
        <p class="post-text">
          Yang masih grogi pas speaking di depan umum, kalian gak sendirian! Aku dulu super
          gugup, tapi dengan latihan terus jadi lebih PD. Semangat teman-teman!
        </p>
        <footer class="post-footer">
          <div class="reactions" aria-label="Reaksi postingan">
            <div class="reaction-icon" aria-label="20 likes">
              <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09
                  C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
              </svg>
              20
            </div>
            <div class="reaction-icon" aria-label="15 komentar">
              <img src="icon/komen.svg" style="width:18px; height:18px;">
              15 komentar
            </div>
          </div>
          <button class="post-share" aria-label="Bagikan postingan">
            <img src="icon/share.svg" style="width:18px; height:18px; margin-right:6px;">
            Bagikan
          </button>

        </footer>
      </article>

      <article class="post" tabindex="0">
        <header class="post-header">
          <img src="https://i.pravatar.cc/44?u=fadhillah" alt="Avatar Fadhillah" class="post-avatar" width="44"
            height="44" />
          <div class="post-author-info">
            <div class="post-author">Fadhillah</div>
            <div class="post-username-time">@fadhillah • 3 jam lalu</div>
          </div>
          <button class="post-menu" aria-label="Opsi postingan">&#8942;</button>
        </header>
        <p class="post-text">
          Ada yang mau practice partner gak? Lagi cari temen buat latihan bareng virtual setiap
          weekend. Drop DM ya!
        </p>
        <footer class="post-footer">
          <div class="reactions" aria-label="Reaksi postingan">
            <div class="reaction-icon" aria-label="20 likes">
              <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09
                  C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
              </svg>
              20
            </div>
            <div class="reaction-icon" aria-label="15 komentar">
              <img src="icon/komen.svg" style="width:18px; height:18px;">
              15 komentar
            </div>
          </div>
          <button class="post-share" aria-label="Bagikan postingan">
            <img src="icon/share.svg" style="width:18px; height:18px; margin-right:6px;">
            Bagikan
          </button>
        </footer>
      </article>

    </section>
  </main>
</body>

</html>
