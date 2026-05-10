<?php
require_once 'core.php';
if (session_status() == PHP_SESSION_NONE) session_start();
$app = new manz();
$app->ensureSession();
$currentUser = $app->getCurrentUser();

$feedback = '';
$feedbackType = 'info';
$editPost = null;

function redirectWith(array $params = []){
    $url = 'Komunitas.php';
    if (!empty($params)){
        $url .= '?' . http_build_query($params);
    }
    header('Location: ' . $url);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$app->isLoggedIn()) {
        redirectWith(['error' => 'Anda harus masuk untuk melakukan aksi ini.']);
    }

    $action = $_POST['action'] ?? '';
    $content = trim($_POST['content'] ?? '');

    if ($action === 'create') {
        if ($content === '') {
            redirectWith(['error' => 'Isi postingan tidak boleh kosong.']);
        }
        if ($app->createCommunityPost($currentUser['Id_User'],$content)) {
            redirectWith(['success' => 'Postingan berhasil dibuat.']);
        }
        redirectWith(['error' => 'Gagal membuat postingan. Silakan coba lagi.']);
    }

    if ($action === 'update') {
        $postId = $_POST['post_id'] ?? '';
        if ($postId === '' || $title === '' || $content === '') {
            redirectWith(['error' => 'Data tidak lengkap untuk memperbarui postingan.']);
        }
        if ($app->updateCommunityPost($postId, $currentUser['Id_User'],$content)) {
            redirectWith(['success' => 'Postingan berhasil diperbarui.']);
        }
        redirectWith(['error' => 'Gagal memperbarui postingan.']);
    }

    if ($action === 'delete') {
        $postId = $_POST['post_id'] ?? '';
        if ($postId === '') {
            redirectWith(['error' => 'Postingan tidak ditemukan.']);
        }
        if ($app->deleteCommunityPost($postId, $currentUser['Id_User'])) {
            redirectWith(['success' => 'Postingan berhasil dihapus.']);
        }
        redirectWith(['error' => 'Gagal menghapus postingan.']);
    }
}

if (!empty($_GET['success'])) {
    $feedback = htmlspecialchars($_GET['success']);
    $feedbackType = 'success';
} elseif (!empty($_GET['error'])) {
    $feedback = htmlspecialchars($_GET['error']);
    $feedbackType = 'error';
}

if (!empty($_GET['edit']) && $currentUser) {
    $post = $app->getCommunityPostById($_GET['edit']);
    if ($post && $post['Id_User'] === $currentUser['Id_User']) {
        $editPost = $post;
    }
}

$posts = $app->getCommunityPosts();
?>
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

    .btn-submit{
  background-color: #bca451;
  color: white;
  padding: 10px 25px;
  border: none;
  border-radius: 12px;
  font-size: 18px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.btn-submit:hover{
  background-color: #a5924a;
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
      padding: 20px;
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
      gap: 16px;
      flex-wrap: wrap;
    }

    .post-footer .reactions { display: flex; gap: 35px; user-select: none; align-items: center; }

    .reaction-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 12px;
      border-radius: 999px;
      border: 1px solid #e5e7eb;
      background: #f8fafc;
      color: #4b5563;
      font-weight: 700;
      cursor: pointer;
      transition: background-color 0.2s, border-color 0.2s, color 0.2s;
    }

    .reaction-btn:hover {
      background-color: #f3f4f6;
      border-color: #d1d5db;
      color: #bca451;
    }

    .reaction-btn span {
      min-width: 20px;
      text-align: center;
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
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .post-share:hover { color: #bca451; }

    .alert {
      padding: 16px 20px;
      border-radius: 14px;
      margin-bottom: 24px;
      font-size: 15px;
      max-width: 900px;
    }

    .alert.success { background-color: #e6f4ea; color: #175c3f; }
    .alert.error { background-color: #fce8e6; color: #9a2a22; }

    .post-form {
      background: white;
      padding: 24px;
      border-radius: 16px;
      box-shadow: 0 2px 10px rgb(0 0 0 / 0.08);
      margin-bottom: 30px;
      max-width: 900px;
    }

    .post-form h2 {
      margin-top: 0;
      margin-bottom: 18px;
      font-size: 22px;
      color: #101828;
    }

    .form-group { margin-bottom: 18px; }
    .form-group label {
      display: block;
      margin-bottom: 8px;
      color: #4b5563;
      font-weight: 600;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 14px 16px;
      border: 1px solid #d1d5db;
      border-radius: 12px;
      font-size: 15px;
      color: #111827;
      background: #f8fafc;
    }

    .form-group textarea { min-height: 140px; resize: vertical; }

    .form-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      align-items: center;
    }

    .btn-cancel {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 10px 24px;
      color: #374151;
      background: #f3f4f6;
      border-radius: 12px;
      text-decoration: none;
      font-size: 15px;
    }

    .info-box {
      background: white;
      max-width: 900px;
      padding: 18px 22px;
      border-radius: 16px;
      box-shadow: 0 2px 10px rgb(0 0 0 / 0.05);
      margin-bottom: 30px;
      color: #334155;
      font-size: 15px;
    }

    .post-list { display: flex; flex-direction: column; gap: 20px; }

    .post-actions {
      margin-left: auto;
      display: flex;
      gap: 10px;
      align-items: center;
    }

    .post-action,
    .post-action.delete {
      font-size: 13px;
      font-weight: 700;
      color: #6b7280;
      background: none;
      border: none;
      cursor: pointer;
      text-decoration: none;
      padding: 6px 10px;
      border-radius: 10px;
    }

    .post-action.delete { color: #b91c1c; }

    .post-title {
      margin: 0;
      font-size: 18px;
      font-weight: 700;
      color: #111827;
    }

    .empty-state {
      padding: 24px;
      border-radius: 16px;
      background: white;
      border: 1px dashed #cbd5e1;
      color: #334155;
      max-width: 900px;
    }

    @media (max-width: 1024px) {
      main { padding: 24px; margin-left: 0; }
      .btn-posting { float: none; display: block; width: 100%; margin-top: 12px; }
    }
  </style>
</head>

<body>
  <?php include 'includes/header.php'; ?>
  <?php include 'includes/sidebar.php'; ?>

  <main role="main" tabindex="-1">
    <div class="clearfix">
      <h1 style="font-size:40px; font-weight:700; color:#000;">Komunitas</h1>
      <p style="color:#777; font-size:20px; margin-bottom:30px;">Berbagi pengalaman dan belajar bersama</p>
      <?php if ($currentUser): ?>
        <button class="btn-posting" id="toggle-post-form" type="button" aria-label="Buat Postingan">Buat Postingan</button>
      <?php endif; ?>
    </div>

    <?php if ($feedback): ?>
      <div class="alert <?= $feedbackType ?>"><?= $feedback ?></div>
    <?php endif; ?>

    <?php if ($currentUser): ?>
      <section class="post-form" id="post-form" style="<?= $editPost ? 'display:block;' : 'display:none;' ?>">
        <h2><?= $editPost ? 'Sunting Postingan' : 'Tulis Postingan Baru' ?></h2>
        <form action="Komunitas.php" method="post">
          <input type="hidden" name="action" value="<?= $editPost ? 'update' : 'create' ?>">
          <?php if ($editPost): ?>
            <input type="hidden" name="post_id" value="<?= htmlspecialchars($editPost['Id']) ?>">
          <?php endif; ?>

          <div class="form-group">
            <label for="content">Isi</label>
            <textarea id="content" name="content" required><?= htmlspecialchars($editPost['Isi'] ?? '') ?></textarea>
          </div>

          <div class="form-actions">
            <button class="btn-submit" type="submit"><?= $editPost ? 'Simpan Perubahan' : 'Posting' ?></button>
            <?php if ($editPost): ?>
              <a href="Komunitas.php" class="btn-cancel">Batal</a>
            <?php endif; ?>
          </div>
        </form>
      </section>
    <?php else: ?>
      <div class="info-box">Silakan <a href="login.php">masuk</a> atau <a href="regis.php">daftar</a> untuk membuat postingan komunitas.</div>
    <?php endif; ?>

    <section class="post-list" aria-label="Daftar posting komunitas">
      <?php if (empty($posts)): ?>
        <div class="empty-state">Belum ada postingan. Jadilah yang pertama untuk berbagi!</div>
      <?php endif; ?>

      <?php foreach ($posts as $post): ?>
        
        <article class="post" tabindex="0">
          <header class="post-header">
            <img src="https://i.pravatar.cc/44?u=<?= urlencode($post['username'] ?: $post['Id_User']) ?>" alt="Avatar <?= htmlspecialchars($post['name'] ?: 'Pengguna') ?>" class="post-avatar" width="44" height="44">
            <div class="post-author-info">
              <div class="post-author"><?= htmlspecialchars($post['name'] ?: 'Pengguna') ?></div>
              <div class="post-username-time">@<?= htmlspecialchars($post['username'] ?: 'guest') ?> • <?= htmlspecialchars(date('d M Y H:i', strtotime($post['Dibuat']))) ?></div>
            </div>
            <?php if ($currentUser && $post['Id_User'] === $currentUser['Id_User']): ?>
              <div class="post-actions">
                <a class="post-action" href="Komunitas.php?edit=<?= urlencode($post['Id']) ?>">Edit</a>
                <form action="Komunitas.php" method="post" onsubmit="return confirm('Hapus postingan ini?');">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['Id']) ?>">
                  <button type="submit" class="post-action delete">Hapus</button>
                </form>
              </div>
            <?php endif; ?>
          </header>

          
          <p class="post-text"><?= nl2br(htmlspecialchars($post['Isi'])) ?></p>
          <footer class="post-footer">
            <div class="reactions" aria-label="Reaksi postingan">
              <button type="button" class="reaction-btn like-btn" data-post-id="<?= $post['Id'] ?>" data-action="like" aria-label="Suka">
                <img src="icon/like.svg" style="width:20px; height:20px;" alt="Like">
                <span class="like-count"><?= $app->getLikeCount($post['Id']) ?></span>
              </button>
              <button type="button" class="reaction-btn comment-btn" data-post-id="<?= $post['Id'] ?>" data-action="comment" aria-label="Komentar">
                <img src="icon/komen.svg" style="width:20px; height:20px;" alt="Komentar">
                <span class="comment-count"><?= $app->getCommentCount($post['Id']) ?></span>
              </button>
            </div>
          </footer>
        </article>
      <?php endforeach; ?>
    </section>
  </main>

  <script>
    document.getElementById('toggle-post-form')?.addEventListener('click', function () {
      const form = document.getElementById('post-form');
      if (!form) return;
      const isHidden = form.style.display === 'none' || form.style.display === '';
      form.style.display = isHidden ? 'block' : 'none';
      this.textContent = isHidden ? 'Batalkan' : 'Buat Postingan';
      this.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
    });

    // Handle like button
    document.querySelectorAll('.like-btn').forEach(btn => {
      btn.addEventListener('click', async function() {
        const postId = this.dataset.postId;
        const formData = new FormData();
        formData.append('action', 'toggle_like');
        formData.append('post_id', postId);

        try {
          const response = await fetch('api_komunitas.php', {
            method: 'POST',
            body: formData
          });

          const data = await response.json();

          if (data.status) {
            const countSpan = this.querySelector('.like-count');
            countSpan.textContent = data.like_count;
          } else {
            if (response.status === 401) {
              window.location.href = 'login.php';
            } else {
              alert(data.message || 'Gagal mengubah like');
            }
          }
        } catch (error) {
          console.error('Error:', error);
          alert('Terjadi kesalahan');
        }
      });
    });

    // Handle comment button
    document.querySelectorAll('.comment-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const postId = this.dataset.postId;
        const commentForm = prompt('Tulis komentar Anda:');
        
        if (commentForm === null) return; // User cancel

        if (commentForm.trim() === '') {
          alert('Komentar tidak boleh kosong');
          return;
        }

        submitComment(postId, commentForm, this);
      });
    });

    async function submitComment(postId, content, btn) {
      const formData = new FormData();
      formData.append('action', 'add_comment');
      formData.append('post_id', postId);
      formData.append('content', content);

      try {
        const response = await fetch('api_komunitas.php', {
          method: 'POST',
          body: formData
        });

        const data = await response.json();

        if (data.status) {
          const countSpan = btn.querySelector('.comment-count');
          countSpan.textContent = data.comment_count;
          alert('Komentar berhasil ditambahkan');
        } else {
          if (response.status === 401) {
            window.location.href = 'login.php';
          } else {
            alert(data.message || 'Gagal menambahkan komentar');
          }
        }
      } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan');
      }
    }
  </script>
</body>

</html>
