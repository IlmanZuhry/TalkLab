<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TALKLAB - Komunitas</title>
  <?php include 'includes/layout_css.php'; ?>
  <style>
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

    .btn-posting:hover { background-color: #a5924a; }

    .clearfix::after { content: ""; display: table; clear: both; }

    .post-list { display: flex; flex-direction: column; gap: 20px; }

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

    .post-header { display: flex; align-items: center; gap: 14px; }

    .post-avatar {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #bca451;
      flex-shrink: 0;
    }

    .post-author-info { display: flex; flex-direction: column; gap: 4px; user-select: text; }
    .post-author { font-weight: 700; font-size: 16px; color: #101828; line-height: 1.1; }
    .post-username-time { font-size: 13px; color: #8f95a6; user-select: none; }

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

    .post-menu:hover { color: #bca451; }

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

    .post-footer .reactions { display: flex; gap: 20px; user-select: none; }

    .reaction-icon { display: flex; align-items: center; gap: 6px; }
    .reaction-icon svg { width: 16px; height: 16px; fill: #8f95a6; }
    .reaction-icon img { width: 18px; height: 18px; display: inline-block; }

    .post-share {
      cursor: pointer;
      font-weight: 600;
      color: #8f95a6;
      transition: color 0.3s;
      user-select: none;
      background: none;
      border: none;
      padding: 0;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .post-share:hover { color: #bca451; }
  </style>
</head>

<body>
  <?php include 'includes/header.php'; ?>
  <?php include 'includes/sidebar.php'; ?>

  <main role="main" tabindex="-1">
    <div class="clearfix">
      <h1 style="font-size:40px; font-weight:700; color:#000;">Komunitas</h1>
      <p style="color:#777; font-size:20px; margin-bottom:30px;">Berbagi pengalaman dan belajar bersama</p>
      <button class="btn-posting" type="button" aria-label="Buat Postingan">Buat Postingan</button>
    </div>

    <section class="post-list" aria-label="Daftar posting komunitas">

      <article class="post" tabindex="0">
        <header class="post-header">
          <img src="https://i.pravatar.cc/44?u=fathul" alt="Avatar Fathul Khairah" class="post-avatar" width="44" height="44" />
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
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
              </svg>
              20
            </div>
            <div class="reaction-icon" aria-label="15 komentar">
              <img src="icon/komen.svg" style="width:18px; height:18px;">
              15 komentar
            </div>
          </div>
          <button class="post-share" aria-label="Bagikan postingan">
            <img src="icon/share.svg" style="width:18px; height:18px;"> Bagikan
          </button>
        </footer>
      </article>

      <article class="post" tabindex="0">
        <header class="post-header">
          <img src="https://i.pravatar.cc/44?u=ilman" alt="Avatar Ilman Ethanol" class="post-avatar" width="44" height="44" />
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
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
              </svg>
              20
            </div>
            <div class="reaction-icon" aria-label="15 komentar">
              <img src="icon/komen.svg" style="width:18px; height:18px;">
              15 komentar
            </div>
          </div>
          <button class="post-share" aria-label="Bagikan postingan">
            <img src="icon/share.svg" style="width:18px; height:18px;"> Bagikan
          </button>
        </footer>
      </article>

      <article class="post" tabindex="0">
        <header class="post-header">
          <img src="https://i.pravatar.cc/44?u=riski" alt="Avatar Riski Galon" class="post-avatar" width="44" height="44" />
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
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
              </svg>
              20
            </div>
            <div class="reaction-icon" aria-label="15 komentar">
              <img src="icon/komen.svg" style="width:18px; height:18px;">
              15 komentar
            </div>
          </div>
          <button class="post-share" aria-label="Bagikan postingan">
            <img src="icon/share.svg" style="width:18px; height:18px;"> Bagikan
          </button>
        </footer>
      </article>

      <article class="post" tabindex="0">
        <header class="post-header">
          <img src="https://i.pravatar.cc/44?u=fadhillah" alt="Avatar Fadhillah" class="post-avatar" width="44" height="44" />
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
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
              </svg>
              20
            </div>
            <div class="reaction-icon" aria-label="15 komentar">
              <img src="icon/komen.svg" style="width:18px; height:18px;">
              15 komentar
            </div>
          </div>
          <button class="post-share" aria-label="Bagikan postingan">
            <img src="icon/share.svg" style="width:18px; height:18px;"> Bagikan
          </button>
        </footer>
      </article>

    </section>
  </main>
</body>

</html>
