<?php
require_once 'core.php';

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

$app = new manz();
$app->ensureSession();
$currentUser = $app->getCurrentUser();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	header('Content-Type: application/json');

	$action = $_POST['action'] ?? '';

	if ($action === 'save_practice') {
		echo json_encode($app->handleSavePractice($currentUser));
		exit;
	}

	if ($action === 'save_challenge') {
		echo json_encode($app->handleSaveChallenge($currentUser));
		exit;
	}

	if ($action === 'save_ai_feedback') {
		echo json_encode($app->handleSaveAiFeedback($currentUser));
		exit;
	}
}

$practiceHistory = $currentUser ? $app->getPracticeHistory($currentUser['Id_User']) : [];
$challengeHistory = $currentUser ? $app->getChallengeHistory($currentUser['Id_User']) : [];
$aiFeedbackHistory = $currentUser ? $app->getAiFeedbackHistory($currentUser['Id_User']) : [];
$totalPracticeDuration = array_sum(array_map(fn($item) => (int) $item['duration_seconds'], $practiceHistory));
$totalChallengeDuration = array_sum(array_map(fn($item) => (int) $item['actual_seconds'], $challengeHistory));
$averageAiScore = 0;

if (!empty($aiFeedbackHistory)) {
    $scoreTotal = 0;
    foreach ($aiFeedbackHistory as $item) {
        $scoreTotal += ((int) $item['clarity_score'] + (int) $item['fluency_score'] + (int) $item['confidence_score'] + (int) $item['consistency_score']) / 4;
    }
    $averageAiScore = (int) round($scoreTotal / count($aiFeedbackHistory));
}
$uniqueActivityDays = [];
foreach (array_merge($practiceHistory, $challengeHistory, $aiFeedbackHistory) as $item) {
    if (!empty($item['created_at'])) {
        $uniqueActivityDays[date('Y-m-d', strtotime($item['created_at']))] = true;
    }
}
$streakDays = count($uniqueActivityDays);
$topics = [
    'Perkenalkan diri kamu secara singkat dan percaya diri.',
    'Ceritakan pengalaman pribadi yang membuat kamu belajar hal baru.',
    'Jelaskan hobi kamu dan mengapa hobi itu menarik.',
    'Sampaikan opini sederhana tentang pentingnya public speaking.',
    'Ceritakan satu tujuan yang ingin kamu capai bulan ini.',
    'Bagikan tips sederhana agar tidak gugup saat berbicara.'
];
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TALKLAB - Latihan</title>
  <?php include 'includes/layout_css.php'; ?>
  <style>
    body { background: #f7f7fc; }

    main {
      flex: 1;
      margin-left: 260px;
      padding: 120px 40px 48px;
      color: #101828;
    }

    .page-head {
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      gap: 20px;
      margin-bottom: 28px;
    }

    .page-head h1 {
      font-size: 40px;
      line-height: 1.1;
      margin-bottom: 8px;
    }

    .page-head p {
      color: #777;
      font-size: 20px;
    }

    .btn {
      border: 0;
      border-radius: 14px;
      padding: 12px 20px;
      font-weight: 800;
      font-size: 15px;
      cursor: pointer;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .btn-primary { background: #d2a06b; color: #fff; }
    .btn-dark { background: #10204f; color: #fff; }
    .btn-muted { background: #eef2f7; color: #344054; }
    .btn-danger { background: #b42318; color: #fff; }
    .btn:disabled { cursor: not-allowed; opacity: 0.55; }

    .feature-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 18px;
      margin-bottom: 28px;
    }

    .feature-card {
      background: #fff;
      border: 2px solid transparent;
      border-radius: 18px;
      padding: 24px;
      box-shadow: 0 8px 24px rgb(0 0 0 / 0.07);
      min-height: 175px;
      cursor: pointer;
      text-align: left;
      width: 100%;
      overflow: hidden;
      position: relative;
      transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
    }

    .feature-card.active {
      border-color: #d2a06b;
      background: #fffaf3;
    }

    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 14px 34px rgb(16 32 79 / 0.14);
    }

    .feature-card::after {
      content: "";
      position: absolute;
      width: 120px;
      height: 120px;
      border-radius: 50%;
      right: -46px;
      top: -46px;
      background: rgb(210 160 107 / 0.14);
    }

    .feature-icon {
      width: 58px;
      height: 58px;
      border-radius: 18px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 18px;
      background: #10204f;
      color: #fff;
      font-size: 30px;
      box-shadow: 0 10px 22px rgb(16 32 79 / 0.18);
      position: relative;
      z-index: 1;
    }

    .feature-card[data-feature="challenge"] .feature-icon { background: #6d2d59; }
    .feature-card[data-feature="ai"] .feature-icon { background: #b8752b; }

    .feature-card h2 {
      color: #10204f;
      font-size: 24px;
      margin-bottom: 10px;
      position: relative;
      z-index: 1;
    }

    .feature-card p {
      color: #667085;
      font-size: 15px;
      line-height: 1.5;
      margin-bottom: 18px;
      position: relative;
      z-index: 1;
    }

    .badge {
      display: inline-flex;
      border-radius: 999px;
      padding: 7px 12px;
      font-size: 12px;
      font-weight: 800;
      background: #eef2f7;
      color: #344054;
    }

    .badge-ready { background: #ecfdf3; color: #027a48; }

    .workspace {
      display: grid;
      grid-template-columns: minmax(0, 1.25fr) minmax(320px, 0.75fr);
      gap: 24px;
      align-items: start;
    }

    .feature-section {
      display: none;
    }

    .feature-section.active {
      display: grid;
    }

    .panel,
    .history-card {
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 8px 24px rgb(0 0 0 / 0.07);
    }

    .panel {
      padding: 28px;
      overflow: hidden;
    }

    .panel-title {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 18px;
      margin-bottom: 24px;
    }

    .panel-title h2 {
      color: #10204f;
      font-size: 26px;
      margin-bottom: 8px;
    }

    .panel-title p {
      color: #667085;
      font-size: 15px;
      line-height: 1.5;
      max-width: 720px;
    }

    .coach-strip {
      display: flex;
      align-items: center;
      gap: 16px;
      background: #fffaf3;
      border: 1px solid #f2d7b8;
      border-radius: 18px;
      padding: 14px 16px;
      margin-bottom: 22px;
    }

    .coach-strip img {
      width: 74px;
      height: 74px;
      object-fit: contain;
      flex-shrink: 0;
    }

    .coach-strip strong {
      display: block;
      color: #10204f;
      font-size: 18px;
      margin-bottom: 3px;
    }

    .coach-strip span {
      color: #667085;
      font-size: 14px;
      line-height: 1.45;
    }

    .topic-box {
      background: #10204f;
      border-radius: 18px;
      color: #fff;
      padding: 26px;
      position: relative;
      overflow: hidden;
      margin-bottom: 22px;
    }

    .topic-box::after {
      content: "";
      position: absolute;
      width: 190px;
      height: 190px;
      border-radius: 50%;
      right: -64px;
      top: -78px;
      background: rgb(210 160 107 / 0.32);
    }

    .topic-label {
      color: #d2a06b;
      font-size: 13px;
      font-weight: 900;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      margin-bottom: 10px;
    }

    .topic-text {
      position: relative;
      z-index: 1;
      font-size: 28px;
      font-weight: 800;
      line-height: 1.25;
      max-width: 760px;
    }

    .control-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 18px;
      margin-bottom: 22px;
    }

    .challenge-layout {
      display: grid;
      grid-template-columns: minmax(0, 0.95fr) minmax(0, 1.05fr);
      gap: 18px;
      margin-bottom: 22px;
    }

    .option-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 12px;
    }

    .option-card {
      border: 1px solid #e5e7eb;
      background: #fff;
      border-radius: 14px;
      padding: 15px;
      text-align: left;
      cursor: pointer;
    }

    .option-card.active {
      border-color: #d2a06b;
      background: #fffaf3;
    }

    .option-card strong {
      display: block;
      color: #10204f;
      font-size: 16px;
      margin-bottom: 5px;
    }

    .option-card span {
      color: #667085;
      font-size: 14px;
      line-height: 1.45;
    }

    .control-box {
      border: 1px solid #e5e7eb;
      border-radius: 16px;
      background: #fbfbfd;
      padding: 18px;
    }

    .control-box h3 {
      color: #10204f;
      font-size: 17px;
      margin-bottom: 12px;
    }

    .duration-options,
    .action-row {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
    }

    .duration-btn {
      border: 1px solid #d0d5dd;
      background: #fff;
      color: #344054;
      border-radius: 12px;
      padding: 10px 15px;
      font-weight: 800;
      cursor: pointer;
    }

    .duration-btn.active {
      border-color: #d2a06b;
      background: #d2a06b;
      color: #fff;
    }

    .recorder-box {
      border: 1px solid #e5e7eb;
      border-radius: 18px;
      background: #fbfbfd;
      padding: 22px;
    }

    .practice-stage {
      display: grid;
      grid-template-columns: 190px minmax(0, 1fr);
      gap: 22px;
      align-items: center;
      margin-bottom: 18px;
    }

    .mic-orb {
      width: 172px;
      height: 172px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: radial-gradient(circle at 35% 25%, #fff4e5, #d2a06b 48%, #10204f 100%);
      color: #fff;
      font-size: 58px;
      box-shadow: 0 18px 40px rgb(16 32 79 / 0.2);
      position: relative;
      isolation: isolate;
    }

    .mic-orb::before,
    .mic-orb::after {
      content: "";
      position: absolute;
      inset: -12px;
      border-radius: 50%;
      border: 2px solid rgb(210 160 107 / 0.28);
      opacity: 0;
      z-index: -1;
    }

    .mic-orb.recording::before { animation: pulseRing 1.4s ease-out infinite; }
    .mic-orb.recording::after { animation: pulseRing 1.4s ease-out 0.45s infinite; }

    @keyframes pulseRing {
      0% { transform: scale(0.82); opacity: 0.85; }
      100% { transform: scale(1.24); opacity: 0; }
    }

    .timer-wrap {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 18px;
      margin-bottom: 16px;
    }

    .timer {
      color: #10204f;
      font-size: 48px;
      font-weight: 900;
      line-height: 1;
    }

    .challenge-timer {
      font-size: 64px;
    }

    .countdown-card {
      background: #10204f;
      color: #fff;
      border-radius: 22px;
      padding: 24px;
      min-width: 220px;
      text-align: center;
      box-shadow: 0 16px 34px rgb(16 32 79 / 0.18);
    }

    .countdown-card .timer,
    .countdown-card .timer-caption {
      color: #fff;
    }

    .countdown-card .timer-caption {
      color: #dbe4ff;
    }

    .timer-caption {
      color: #667085;
      font-weight: 700;
      margin-top: 6px;
    }

    .status-pill {
      border-radius: 999px;
      padding: 9px 14px;
      background: #eef2f7;
      color: #344054;
      font-weight: 900;
      font-size: 13px;
    }

    .status-recording {
      background: #fee4e2;
      color: #b42318;
    }

    .meter {
      height: 10px;
      background: #e5e7eb;
      border-radius: 999px;
      overflow: hidden;
      margin-bottom: 18px;
    }

    .meter-fill {
      width: 0;
      height: 100%;
      background: #d2a06b;
      border-radius: 999px;
      transition: width 0.2s;
    }

    audio {
      width: 100%;
      margin-top: 18px;
    }

    .result-box {
      display: none;
      margin-top: 18px;
      padding: 18px;
      border-radius: 16px;
      background: #f8fafc;
      border: 1px solid #e5e7eb;
    }

    .result-box h3 {
      color: #10204f;
      margin-bottom: 12px;
    }

    .result-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 12px;
    }

    .score-card {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 12px;
      margin-top: 14px;
    }

    .score-card.four {
      grid-template-columns: repeat(4, minmax(0, 1fr));
    }

    .score-item {
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 14px;
      padding: 14px;
    }

    .score-item span {
      display: block;
      color: #667085;
      font-size: 12px;
      font-weight: 800;
      margin-bottom: 6px;
    }

    .score-item strong {
      color: #10204f;
      font-size: 22px;
    }

    .score-ring {
      width: 116px;
      height: 116px;
      border-radius: 50%;
      margin: 0 auto 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: conic-gradient(#d2a06b var(--score, 0%), #eef2f7 0);
      position: relative;
    }

    .score-ring::after {
      content: "";
      position: absolute;
      width: 84px;
      height: 84px;
      border-radius: 50%;
      background: #fff;
    }

    .score-ring strong {
      position: relative;
      z-index: 1;
      color: #10204f;
      font-size: 24px;
    }

    .analysis-input {
      width: 100%;
      min-height: 130px;
      border: 1px solid #d0d5dd;
      border-radius: 14px;
      padding: 14px;
      font-size: 15px;
      line-height: 1.5;
      color: #344054;
      resize: vertical;
    }

    .achievement-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 12px;
      margin-top: 14px;
    }

    .achievement {
      border-radius: 14px;
      border: 1px solid #e5e7eb;
      background: #f8fafc;
      padding: 15px;
    }

    .achievement.unlocked {
      background: #ecfdf3;
      border-color: #abefc6;
    }

    .achievement strong {
      display: block;
      color: #10204f;
      margin-bottom: 6px;
    }

    .achievement span {
      color: #667085;
      font-size: 13px;
      line-height: 1.4;
    }

    .toast {
      display: none;
      margin-top: 16px;
      border-radius: 14px;
      padding: 14px 16px;
      font-weight: 700;
      line-height: 1.5;
    }

    .toast.success { display: block; background: #ecfdf3; color: #027a48; }
    .toast.error { display: block; background: #fef3f2; color: #b42318; }
    .toast.info { display: block; background: #eff8ff; color: #175cd3; }

    .history-panel {
      padding: 24px;
    }

    .history-panel h2 {
      color: #10204f;
      font-size: 24px;
      margin-bottom: 8px;
    }

    .history-panel p {
      color: #667085;
      font-size: 15px;
      line-height: 1.5;
      margin-bottom: 18px;
    }

    .history-list {
      display: flex;
      flex-direction: column;
      gap: 14px;
      max-height: 620px;
      overflow-y: auto;
      padding-right: 4px;
    }

    .history-card {
      box-shadow: 0 4px 14px rgb(0 0 0 / 0.06);
      padding: 16px;
    }

    .history-card strong {
      display: block;
      color: #10204f;
      line-height: 1.35;
      margin-bottom: 8px;
    }

    .history-card small {
      display: block;
      color: #667085;
      margin-bottom: 10px;
    }

    .history-card audio {
      margin-top: 8px;
    }

    .empty-state {
      color: #667085;
      background: #f8fafc;
      border: 1px dashed #cbd5e1;
      border-radius: 16px;
      padding: 18px;
      line-height: 1.5;
    }

    @media (max-width: 1100px) {
      main {
        margin-left: 0;
        padding: 112px 24px 36px;
      }

      .feature-grid,
      .workspace,
      .challenge-layout,
      .practice-stage,
      .score-card,
      .score-card.four,
      .achievement-grid,
      .control-grid {
        grid-template-columns: 1fr;
      }

      .page-head,
      .panel-title,
      .timer-wrap {
        align-items: flex-start;
        flex-direction: column;
      }
    }
  </style>
</head>

<body>
  <?php include 'includes/header.php'; ?>
  <?php include 'includes/sidebar.php'; ?>

  <main>
    <section class="page-head">
      <div>
        <h1>Latihan</h1>
        <p>Pilih fitur latihan public speaking yang ingin kamu gunakan.</p>
      </div>
      <a href="Beranda.php" class="btn btn-muted">Kembali</a>
    </section>

    <section class="feature-grid" aria-label="Pilihan fitur latihan">
      <button class="feature-card active" type="button" data-feature="voice">
        <div class="feature-icon">🎙</div>
        <h2>Rekam Suara</h2>
        <p>Pilih topik, bicara, dengarkan ulang.</p>
      </button>
      <button class="feature-card" type="button" data-feature="challenge">
        <div class="feature-icon">⏱</div>
        <h2>Tantangan Bicara</h2>
        <p>Mode cepat dengan level dan skor.</p>
      </button>
      <button class="feature-card" type="button" data-feature="ai">
        <div class="feature-icon">📊</div>
        <h2>Feedback AI</h2>
        <p>Lihat skor, saran, dan progress.</p>
      </button>
    </section>

    <section class="workspace feature-section active" id="voiceSection">
      <div class="panel">
        <div class="panel-title">
          <div>
            <h2>Voice Practice & Recording</h2>
            <p>Pilih topik, rekam, dengarkan ulang.</p>
          </div>
        </div>

        <div class="coach-strip">
          <img src="assets/jjjj.png" alt="Coach TalkLab">
          <div>
            <strong>Siap latihan suara?</strong>
            <span>Fokus pada pembuka, isi, dan penutup. Rekamanmu bisa diputar ulang setelah selesai.</span>
          </div>
        </div>

        <div class="topic-box">
          <div class="topic-label">Topic Prompt</div>
          <div class="topic-text" id="topicText"><?= htmlspecialchars($topics[0]) ?></div>
        </div>

        <div class="control-grid">
          <div class="control-box">
            <h3>Topik Latihan</h3>
            <div class="action-row">
              <button class="btn btn-primary" type="button" id="randomTopicBtn">Topik Acak</button>
              <button class="btn btn-muted" type="button" id="nextTopicBtn">Topik Berikutnya</button>
            </div>
          </div>

          <div class="control-box">
            <h3>Timer Latihan</h3>
            <div class="duration-options">
              <button class="duration-btn active" type="button" data-duration="30">30 detik</button>
              <button class="duration-btn" type="button" data-duration="60">1 menit</button>
              <button class="duration-btn" type="button" data-duration="180">3 menit</button>
            </div>
          </div>
        </div>

        <div class="recorder-box">
          <div class="practice-stage">
            <div class="mic-orb" id="micOrb">🎙</div>
            <div>
              <div class="timer-wrap">
                <div>
                  <div class="timer" id="timer">00:30</div>
                  <div class="timer-caption">Durasi dipilih: <span id="selectedDuration">30 detik</span></div>
                </div>
                <div class="status-pill" id="recordStatus">Siap Latihan</div>
              </div>

              <div class="meter" aria-hidden="true">
                <div class="meter-fill" id="meterFill"></div>
              </div>
            </div>
          </div>

          <div class="action-row">
            <button class="btn btn-primary" type="button" id="startBtn">Mulai Latihan</button>
            <button class="btn btn-danger" type="button" id="stopBtn" disabled>Selesai</button>
            <button class="btn btn-dark" type="button" id="saveBtn" disabled>Simpan Riwayat</button>
          </div>

          <div class="result-box" id="resultBox">
            <h3>Playback Result</h3>
            <div class="result-meta">
              <span class="badge" id="resultTopic">Topik: -</span>
              <span class="badge" id="resultDuration">Durasi: -</span>
            </div>
            <audio id="playback" controls></audio>
          </div>

          <div class="toast info" id="messageBox">Tekan Mulai Latihan untuk memberi izin microphone dan memulai timer.</div>
        </div>
      </div>

      <aside class="panel history-panel">
        <h2>Save Practice History</h2>
        <p>Riwayat menampilkan tanggal latihan, durasi berbicara, topik, dan file audio yang tersimpan di akun pengguna.</p>

        <div class="history-list" id="historyList">
          <?php if (!$currentUser): ?>
            <div class="empty-state">Silakan login terlebih dahulu agar hasil latihan bisa disimpan ke akun.</div>
          <?php elseif (empty($practiceHistory)): ?>
            <div class="empty-state">Belum ada riwayat latihan. Selesaikan satu rekaman lalu simpan riwayat.</div>
          <?php else: ?>
            <?php foreach ($practiceHistory as $item): ?>
              <div class="history-card">
                <strong><?= htmlspecialchars($item['topic']) ?></strong>
                <small><?= htmlspecialchars(date('d M Y H:i', strtotime($item['created_at']))) ?> - <?= (int) $item['duration_seconds'] ?> detik</small>
                <audio controls src="<?= htmlspecialchars($item['audio_path']) ?>"></audio>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </aside>
    </section>

    <section class="workspace feature-section" id="challengeSection">
      <div class="panel">
        <div class="panel-title">
          <div>
            <h2>Interactive Speaking Challenge</h2>
            <p>Pilih mode, siapkan jawaban, mulai bicara.</p>
          </div>
        </div>

        <div class="challenge-layout">
          <div class="control-box">
            <h3>Jenis Challenge</h3>
            <div class="option-grid">
              <button class="option-card challenge-type active" type="button" data-type="Random Topic Challenge">
                <strong>Random Topic Challenge</strong>
                <span>Topik acak untuk melatih improvisasi dan menyusun ide cepat.</span>
              </button>
              <button class="option-card challenge-type" type="button" data-type="Time Challenge">
                <strong>Time Challenge</strong>
                <span>Persiapan singkat lalu bicara efektif dalam batas waktu.</span>
              </button>
              <button class="option-card challenge-type" type="button" data-type="Scenario Simulation">
                <strong>Scenario Simulation</strong>
                <span>Simulasi interview, presentasi kelas, MC, pitching, atau debat sederhana.</span>
              </button>
            </div>
          </div>

          <div class="control-box">
            <h3>Speaking Challenge Level</h3>
            <div class="option-grid">
              <button class="option-card challenge-level active" type="button" data-level="Beginner" data-prep="20" data-speak="45" data-weight="1">
                <strong>Beginner</strong>
                <span>Persiapan 20 detik, bicara 45 detik. Cocok untuk pemanasan.</span>
              </button>
              <button class="option-card challenge-level" type="button" data-level="Intermediate" data-prep="15" data-speak="60" data-weight="1.12">
                <strong>Intermediate</strong>
                <span>Persiapan 15 detik, bicara 1 menit. Fokus pada struktur ide.</span>
              </button>
              <button class="option-card challenge-level" type="button" data-level="Advanced" data-prep="10" data-speak="90" data-weight="1.25">
                <strong>Advanced</strong>
                <span>Persiapan 10 detik, bicara 90 detik. Latihan tekanan waktu.</span>
              </button>
            </div>
          </div>
        </div>

        <div class="topic-box">
          <div class="topic-label" id="challengeTypeLabel">Random Topic Challenge</div>
          <div class="topic-text" id="challengePrompt">Mengapa public speaking penting?</div>
        </div>

        <div class="recorder-box">
          <div class="timer-wrap">
            <div class="countdown-card">
              <div class="timer challenge-timer" id="challengeTimer">00:20</div>
              <div class="timer-caption" id="challengePhaseText">Fase persiapan. Susun pembuka, isi, dan penutup.</div>
            </div>
            <div class="status-pill" id="challengeStatus">Siap Challenge</div>
          </div>

          <div class="meter" aria-hidden="true">
            <div class="meter-fill" id="challengeMeterFill"></div>
          </div>

          <div class="action-row">
            <button class="btn btn-primary" type="button" id="newChallengeBtn">Challenge Baru</button>
            <button class="btn btn-dark" type="button" id="startChallengeBtn">Mulai Challenge</button>
            <button class="btn btn-danger" type="button" id="finishChallengeBtn" disabled>Selesai Bicara</button>
            <button class="btn btn-muted" type="button" id="saveChallengeBtn" disabled>Simpan Challenge</button>
          </div>

          <div class="result-box" id="challengeResultBox">
            <h3>Challenge Result & Score</h3>
            <div class="result-meta">
              <span class="badge" id="challengeResultType">Jenis: -</span>
              <span class="badge" id="challengeResultLevel">Level: -</span>
              <span class="badge" id="challengeResultDone">Status: -</span>
            </div>
            <div class="score-card">
              <div class="score-item">
                <span>Durasi Bicara</span>
                <strong id="challengeActualDuration">0s</strong>
              </div>
              <div class="score-item">
                <span>Target</span>
                <strong id="challengeTargetDuration">0s</strong>
              </div>
              <div class="score-item">
                <span>Skor</span>
                <strong id="challengeScore">0</strong>
              </div>
            </div>
          </div>

          <div class="toast info" id="challengeMessageBox">Pilih jenis challenge dan level, lalu tekan Mulai Challenge.</div>
        </div>
      </div>

      <aside class="panel history-panel">
        <h2>Riwayat Challenge</h2>
        <p>Riwayat menampilkan jenis challenge, level, prompt, durasi, dan skor performa pengguna.</p>

        <div class="history-list" id="challengeHistoryList">
          <?php if (!$currentUser): ?>
            <div class="empty-state">Silakan login terlebih dahulu agar hasil challenge bisa disimpan ke akun.</div>
          <?php elseif (empty($challengeHistory)): ?>
            <div class="empty-state">Belum ada riwayat challenge. Selesaikan satu challenge lalu simpan hasilnya.</div>
          <?php else: ?>
            <?php foreach ($challengeHistory as $item): ?>
              <div class="history-card">
                <strong><?= htmlspecialchars($item['prompt']) ?></strong>
                <small><?= htmlspecialchars(date('d M Y H:i', strtotime($item['created_at']))) ?> - <?= htmlspecialchars($item['challenge_type']) ?> - <?= htmlspecialchars($item['level_name']) ?></small>
                <div class="result-meta">
                  <span class="badge"><?= (int) $item['actual_seconds'] ?> detik</span>
                  <span class="badge">Skor <?= (int) $item['score'] ?></span>
                  <span class="badge"><?= (int) $item['completed'] === 1 ? 'Selesai' : 'Belum selesai' ?></span>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </aside>
    </section>

    <section class="workspace feature-section" id="aiSection">
      <div class="panel">
        <div class="panel-title">
          <div>
            <h2>AI Feedback & Progress Tracking</h2>
            <p>Masukkan transkrip untuk melihat skor dan saran.</p>
          </div>
        </div>

        <div class="control-grid">
          <div class="control-box">
            <h3>Sumber Analisis</h3>
            <div class="duration-options">
              <button class="duration-btn active ai-source" type="button" data-source="Voice Practice">Voice Practice</button>
              <button class="duration-btn ai-source" type="button" data-source="Challenge">Challenge</button>
            </div>
          </div>

          <div class="control-box">
            <h3>Durasi Latihan</h3>
            <div class="duration-options">
              <button class="duration-btn active ai-duration" type="button" data-duration="30">30 detik</button>
              <button class="duration-btn ai-duration" type="button" data-duration="60">1 menit</button>
              <button class="duration-btn ai-duration" type="button" data-duration="180">3 menit</button>
            </div>
          </div>
        </div>

        <div class="control-box" style="margin-bottom:22px;">
          <h3>Transkrip / Catatan Bicara</h3>
          <textarea class="analysis-input" id="aiTranscript" placeholder="Tulis atau tempel transkrip latihan di sini. Contoh: eee hari ini saya akan menjelaskan mengapa public speaking penting..."></textarea>
        </div>

        <div class="action-row">
          <button class="btn btn-primary" type="button" id="analyzeAiBtn">Analisis Feedback</button>
          <button class="btn btn-dark" type="button" id="saveAiBtn" disabled>Simpan Feedback</button>
        </div>

        <div class="result-box" id="aiResultBox">
          <h3>Performance Score</h3>
          <div class="score-card four">
            <div class="score-item">
              <div class="score-ring" id="confidenceRing"><strong id="confidenceScore">0</strong></div>
              <span>Confidence Score</span>
            </div>
            <div class="score-item">
              <div class="score-ring" id="clarityRing"><strong id="clarityScore">0</strong></div>
              <span>Clarity Score</span>
            </div>
            <div class="score-item">
              <div class="score-ring" id="fluencyRing"><strong id="fluencyScore">0</strong></div>
              <span>Fluency Score</span>
            </div>
            <div class="score-item">
              <div class="score-ring" id="consistencyRing"><strong id="consistencyScore">0</strong></div>
              <span>Speaking Consistency</span>
            </div>
          </div>

          <div class="score-card">
            <div class="score-item">
              <span>Speaking Speed</span>
              <strong id="speakingSpeed">0 WPM</strong>
            </div>
            <div class="score-item">
              <span>Filler Words</span>
              <strong id="fillerCount">0</strong>
            </div>
            <div class="score-item">
              <span>Durasi</span>
              <strong id="aiDurationResult">0s</strong>
            </div>
          </div>

          <div class="toast info" id="aiFeedbackText">Feedback otomatis akan muncul setelah analisis.</div>
        </div>

        <div class="toast info" id="aiMessageBox">Isi transkrip atau gunakan catatan latihan, lalu tekan Analisis Feedback.</div>
      </div>

      <aside class="panel history-panel">
        <h2>Progress Tracking</h2>
        <p>Ringkasan perkembangan dari latihan, challenge, dan feedback yang tersimpan di akun.</p>

        <div class="score-card" style="margin-bottom:18px;">
          <div class="score-item">
            <span>Total Latihan</span>
            <strong><?= count($practiceHistory) + count($challengeHistory) ?></strong>
          </div>
          <div class="score-item">
            <span>Total Durasi</span>
            <strong><?= (int) round(($totalPracticeDuration + $totalChallengeDuration) / 60) ?>m</strong>
          </div>
          <div class="score-item">
            <span>Skor Rata-rata</span>
            <strong><?= $averageAiScore ?></strong>
          </div>
        </div>

        <h2 style="font-size:20px;">Achievement & Streak</h2>
        <div class="achievement-grid">
          <div class="achievement <?= $streakDays >= 7 ? 'unlocked' : '' ?>">
            <strong><?= $streakDays >= 7 ? 'Terbuka' : 'Terkunci' ?></strong>
            <span>Latihan 7 hari aktif. Saat ini: <?= $streakDays ?> hari aktivitas.</span>
          </div>
          <div class="achievement <?= count($challengeHistory) >= 50 ? 'unlocked' : '' ?>">
            <strong><?= count($challengeHistory) >= 50 ? 'Terbuka' : 'Terkunci' ?></strong>
            <span>Menyelesaikan 50 challenge. Saat ini: <?= count($challengeHistory) ?> challenge.</span>
          </div>
          <div class="achievement <?= $averageAiScore >= 80 ? 'unlocked' : '' ?>">
            <strong><?= $averageAiScore >= 80 ? 'Terbuka' : 'Terkunci' ?></strong>
            <span>Skor performa rata-rata mencapai 80+. Saat ini: <?= $averageAiScore ?>.</span>
          </div>
        </div>

        <h2 style="font-size:20px; margin-top:22px;">Riwayat Feedback</h2>
        <div class="history-list" id="aiHistoryList">
          <?php if (!$currentUser): ?>
            <div class="empty-state">Silakan login terlebih dahulu agar AI feedback bisa disimpan ke akun.</div>
          <?php elseif (empty($aiFeedbackHistory)): ?>
            <div class="empty-state">Belum ada riwayat AI feedback. Jalankan analisis lalu simpan hasilnya.</div>
          <?php else: ?>
            <?php foreach ($aiFeedbackHistory as $item): ?>
              <div class="history-card">
                <strong><?= htmlspecialchars($item['source_type']) ?> - Skor <?= (int) round(((int) $item['clarity_score'] + (int) $item['fluency_score'] + (int) $item['confidence_score'] + (int) $item['consistency_score']) / 4) ?></strong>
                <small><?= htmlspecialchars(date('d M Y H:i', strtotime($item['created_at']))) ?> - <?= (int) $item['duration_seconds'] ?> detik - <?= (int) $item['speaking_speed'] ?> WPM</small>
                <div class="result-meta">
                  <span class="badge">Clarity <?= (int) $item['clarity_score'] ?></span>
                  <span class="badge">Fluency <?= (int) $item['fluency_score'] ?></span>
                  <span class="badge">Filler <?= (int) $item['filler_count'] ?></span>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </aside>
    </section>
  </main>

  <script>
    const topics = <?= json_encode($topics, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
    const isLoggedIn = <?= $currentUser ? 'true' : 'false' ?>;
    const topicText = document.getElementById("topicText");
    const randomTopicBtn = document.getElementById("randomTopicBtn");
    const nextTopicBtn = document.getElementById("nextTopicBtn");
    const durationBtns = document.querySelectorAll(".duration-btn");
    const timer = document.getElementById("timer");
    const selectedDuration = document.getElementById("selectedDuration");
    const meterFill = document.getElementById("meterFill");
    const recordStatus = document.getElementById("recordStatus");
    const micOrb = document.getElementById("micOrb");
    const startBtn = document.getElementById("startBtn");
    const stopBtn = document.getElementById("stopBtn");
    const saveBtn = document.getElementById("saveBtn");
    const playback = document.getElementById("playback");
    const resultBox = document.getElementById("resultBox");
    const resultTopic = document.getElementById("resultTopic");
    const resultDuration = document.getElementById("resultDuration");
    const messageBox = document.getElementById("messageBox");
    const historyList = document.getElementById("historyList");
    const featureCards = document.querySelectorAll(".feature-card");
    const voiceSection = document.getElementById("voiceSection");
    const challengeSection = document.getElementById("challengeSection");
    const aiSection = document.getElementById("aiSection");
    const challengePrompts = {
      "Random Topic Challenge": [
        "Mengapa public speaking penting?",
        "Ceritakan pengalaman paling berkesan.",
        "Bagaimana cara menghadapi rasa grogi?",
        "Jelaskan cita-cita kamu dalam 1 menit."
      ],
      "Time Challenge": [
        "Sampaikan tiga alasan mengapa percaya diri bisa dilatih.",
        "Jelaskan satu ide sederhana dalam pembuka, isi, dan penutup.",
        "Yakinkan audiens untuk berani bertanya saat presentasi.",
        "Berikan tips singkat agar bicara lebih jelas."
      ],
      "Scenario Simulation": [
        "Interview kerja: jawab pertanyaan 'ceritakan tentang diri kamu'.",
        "Presentasi kelas: jelaskan manfaat belajar komunikasi.",
        "Menjadi MC acara: buka acara seminar sekolah dengan ramah.",
        "Pitching produk: tawarkan aplikasi belajar public speaking.",
        "Debat sederhana: setujukah tugas presentasi dilakukan berkelompok?"
      ]
    };
    const challengeTypeBtns = document.querySelectorAll(".challenge-type");
    const challengeLevelBtns = document.querySelectorAll(".challenge-level");
    const challengeTypeLabel = document.getElementById("challengeTypeLabel");
    const challengePrompt = document.getElementById("challengePrompt");
    const challengeTimer = document.getElementById("challengeTimer");
    const challengePhaseText = document.getElementById("challengePhaseText");
    const challengeStatus = document.getElementById("challengeStatus");
    const challengeMeterFill = document.getElementById("challengeMeterFill");
    const newChallengeBtn = document.getElementById("newChallengeBtn");
    const startChallengeBtn = document.getElementById("startChallengeBtn");
    const finishChallengeBtn = document.getElementById("finishChallengeBtn");
    const saveChallengeBtn = document.getElementById("saveChallengeBtn");
    const challengeResultBox = document.getElementById("challengeResultBox");
    const challengeResultType = document.getElementById("challengeResultType");
    const challengeResultLevel = document.getElementById("challengeResultLevel");
    const challengeResultDone = document.getElementById("challengeResultDone");
    const challengeActualDuration = document.getElementById("challengeActualDuration");
    const challengeTargetDuration = document.getElementById("challengeTargetDuration");
    const challengeScore = document.getElementById("challengeScore");
    const challengeMessageBox = document.getElementById("challengeMessageBox");
    const challengeHistoryList = document.getElementById("challengeHistoryList");
    const aiSourceBtns = document.querySelectorAll(".ai-source");
    const aiDurationBtns = document.querySelectorAll(".ai-duration");
    const aiTranscript = document.getElementById("aiTranscript");
    const analyzeAiBtn = document.getElementById("analyzeAiBtn");
    const saveAiBtn = document.getElementById("saveAiBtn");
    const aiResultBox = document.getElementById("aiResultBox");
    const confidenceScore = document.getElementById("confidenceScore");
    const clarityScore = document.getElementById("clarityScore");
    const fluencyScore = document.getElementById("fluencyScore");
    const consistencyScore = document.getElementById("consistencyScore");
    const confidenceRing = document.getElementById("confidenceRing");
    const clarityRing = document.getElementById("clarityRing");
    const fluencyRing = document.getElementById("fluencyRing");
    const consistencyRing = document.getElementById("consistencyRing");
    const speakingSpeed = document.getElementById("speakingSpeed");
    const fillerCount = document.getElementById("fillerCount");
    const aiDurationResult = document.getElementById("aiDurationResult");
    const aiFeedbackText = document.getElementById("aiFeedbackText");
    const aiMessageBox = document.getElementById("aiMessageBox");
    const aiHistoryList = document.getElementById("aiHistoryList");

    let topicIndex = 0;
    let selectedSeconds = 30;
    let remainingSeconds = 30;
    let elapsedSeconds = 0;
    let timerInterval = null;
    let mediaRecorder = null;
    let audioChunks = [];
    let recordedBlob = null;
    let activeChallengeType = "Random Topic Challenge";
    let activeChallengePrompt = challengePrompts[activeChallengeType][0];
    let activeLevel = {
      name: "Beginner",
      prep: 20,
      speak: 45,
      weight: 1
    };
    let challengeInterval = null;
    let challengePhase = "idle";
    let challengeRemaining = 20;
    let challengeActualSeconds = 0;
    let latestChallengeResult = null;
    let activeAiSource = "Voice Practice";
    let activeAiDuration = 30;
    let latestAiResult = null;
    const fillerWords = ["eee", "ee", "anu", "hmm", "emm", "eh", "apa ya"];

    function formatTime(seconds) {
      const mins = String(Math.floor(seconds / 60)).padStart(2, "0");
      const secs = String(seconds % 60).padStart(2, "0");
      return `${mins}:${secs}`;
    }

    function setMessage(type, text) {
      messageBox.className = `toast ${type}`;
      messageBox.textContent = text;
    }

    function setChallengeMessage(type, text) {
      challengeMessageBox.className = `toast ${type}`;
      challengeMessageBox.textContent = text;
    }

    function setAiMessage(type, text) {
      aiMessageBox.className = `toast ${type}`;
      aiMessageBox.textContent = text;
    }

    function switchFeature(feature) {
      featureCards.forEach(card => {
        card.classList.toggle("active", card.dataset.feature === feature);
      });

      voiceSection.classList.toggle("active", feature === "voice");
      challengeSection.classList.toggle("active", feature === "challenge");
      aiSection.classList.toggle("active", feature === "ai");
    }

    function setTopic(index) {
      topicIndex = index;
      topicText.textContent = topics[topicIndex];
      if (!mediaRecorder || mediaRecorder.state === "inactive") {
        resultTopic.textContent = `Topik: ${topics[topicIndex]}`;
      }
    }

    function resetTimer() {
      remainingSeconds = selectedSeconds;
      elapsedSeconds = 0;
      timer.textContent = formatTime(remainingSeconds);
      meterFill.style.width = "0%";
    }

    function updateDurationLabel() {
      selectedDuration.textContent = selectedSeconds === 60 ? "1 menit" : selectedSeconds === 180 ? "3 menit" : "30 detik";
    }

    function resetRecordingResult() {
      recordedBlob = null;
      playback.removeAttribute("src");
      resultBox.style.display = "none";
      saveBtn.disabled = true;
    }

    function pickChallengePrompt(random = true) {
      const prompts = challengePrompts[activeChallengeType];
      let nextPrompt = prompts[0];

      if (random) {
        nextPrompt = prompts[Math.floor(Math.random() * prompts.length)];
        if (prompts.length > 1 && nextPrompt === activeChallengePrompt) {
          const currentIndex = prompts.indexOf(nextPrompt);
          nextPrompt = prompts[(currentIndex + 1) % prompts.length];
        }
      }

      activeChallengePrompt = nextPrompt;
      challengeTypeLabel.textContent = activeChallengeType;
      challengePrompt.textContent = activeChallengePrompt;
      resetChallenge(false);
    }

    function resetChallenge(clearResult = true) {
      clearInterval(challengeInterval);
      challengePhase = "idle";
      challengeRemaining = activeLevel.prep;
      challengeActualSeconds = 0;
      latestChallengeResult = null;
      challengeTimer.textContent = formatTime(activeLevel.prep);
      challengePhaseText.textContent = "Fase persiapan. Susun pembuka, isi, dan penutup.";
      challengeStatus.textContent = "Siap Challenge";
      challengeStatus.classList.remove("status-recording");
      challengeMeterFill.style.width = "0%";
      startChallengeBtn.disabled = false;
      finishChallengeBtn.disabled = true;
      saveChallengeBtn.disabled = true;
      newChallengeBtn.disabled = false;
      challengeTypeBtns.forEach(btn => btn.disabled = false);
      challengeLevelBtns.forEach(btn => btn.disabled = false);
      if (clearResult) {
        challengeResultBox.style.display = "none";
      }
      setChallengeMessage("info", "Pilih jenis challenge dan level, lalu tekan Mulai Challenge.");
    }

    function setChallengePhase(phase) {
      challengePhase = phase;

      if (phase === "prep") {
        challengeRemaining = activeLevel.prep;
        challengeTimer.textContent = formatTime(challengeRemaining);
        challengePhaseText.textContent = "Fase persiapan. Susun pembuka, isi, dan penutup.";
        challengeStatus.textContent = "Persiapan";
        challengeStatus.classList.remove("status-recording");
        challengeMeterFill.style.width = "0%";
        setChallengeMessage("info", "Gunakan waktu persiapan untuk menyusun poin utama sebelum berbicara.");
        return;
      }

      challengeRemaining = activeLevel.speak;
      challengeActualSeconds = 0;
      challengeTimer.textContent = formatTime(challengeRemaining);
      challengePhaseText.textContent = "Fase bicara. Sampaikan ide dengan jelas dan percaya diri.";
      challengeStatus.textContent = "Sedang Bicara";
      challengeStatus.classList.add("status-recording");
      challengeMeterFill.style.width = "0%";
      finishChallengeBtn.disabled = false;
      setChallengeMessage("info", "Mulai bicara sesuai instruksi challenge.");
    }

    function startChallenge() {
      resetChallenge(true);
      challengeResultBox.style.display = "none";
      startChallengeBtn.disabled = true;
      newChallengeBtn.disabled = true;
      challengeTypeBtns.forEach(btn => btn.disabled = true);
      challengeLevelBtns.forEach(btn => btn.disabled = true);
      setChallengePhase("prep");

      challengeInterval = setInterval(() => {
        challengeRemaining -= 1;

        if (challengePhase === "prep") {
          challengeTimer.textContent = formatTime(Math.max(challengeRemaining, 0));
          challengeMeterFill.style.width = `${Math.min(((activeLevel.prep - challengeRemaining) / activeLevel.prep) * 100, 100)}%`;

          if (challengeRemaining <= 0) {
            setChallengePhase("speak");
          }
          return;
        }

        if (challengePhase === "speak") {
          challengeActualSeconds = activeLevel.speak - challengeRemaining;
          challengeTimer.textContent = formatTime(Math.max(challengeRemaining, 0));
          challengeMeterFill.style.width = `${Math.min((challengeActualSeconds / activeLevel.speak) * 100, 100)}%`;

          if (challengeRemaining <= 0) {
            finishChallenge(true);
          }
        }
      }, 1000);
    }

    function finishChallenge(autoCompleted = false) {
      clearInterval(challengeInterval);
      if (challengePhase !== "speak" && !autoCompleted) {
        return;
      }

      if (autoCompleted) {
        challengeActualSeconds = activeLevel.speak;
      } else {
        challengeActualSeconds = Math.max(activeLevel.speak - challengeRemaining, 1);
      }

      const completionRatio = Math.min(challengeActualSeconds / activeLevel.speak, 1);
      const completed = completionRatio >= 0.75 ? 1 : 0;
      const baseScore = completionRatio * 70;
      const levelBonus = activeLevel.weight * 12;
      const finishBonus = completed ? 18 : 6;
      const score = Math.min(100, Math.round(baseScore + levelBonus + finishBonus));

      latestChallengeResult = {
        challenge_type: activeChallengeType,
        level_name: activeLevel.name,
        prompt: activeChallengePrompt,
        prep_seconds: activeLevel.prep,
        speak_seconds: activeLevel.speak,
        actual_seconds: challengeActualSeconds,
        score,
        completed
      };

      challengePhase = "done";
      challengeTimer.textContent = formatTime(0);
      challengeMeterFill.style.width = `${Math.min(completionRatio * 100, 100)}%`;
      challengePhaseText.textContent = "Challenge selesai. Lihat hasil dan simpan riwayat jika sudah sesuai.";
      challengeStatus.textContent = "Challenge Selesai";
      challengeStatus.classList.remove("status-recording");
      startChallengeBtn.disabled = false;
      finishChallengeBtn.disabled = true;
      saveChallengeBtn.disabled = false;
      newChallengeBtn.disabled = false;
      challengeTypeBtns.forEach(btn => btn.disabled = false);
      challengeLevelBtns.forEach(btn => btn.disabled = false);
      renderChallengeResult(latestChallengeResult);
      setChallengeMessage("success", "Challenge selesai. Skor performa sudah dihitung.");
    }

    function renderChallengeResult(result) {
      challengeResultType.textContent = `Jenis: ${result.challenge_type}`;
      challengeResultLevel.textContent = `Level: ${result.level_name}`;
      challengeResultDone.textContent = result.completed ? "Status: Selesai" : "Status: Belum penuh";
      challengeActualDuration.textContent = `${result.actual_seconds}s`;
      challengeTargetDuration.textContent = `${result.speak_seconds}s`;
      challengeScore.textContent = result.score;
      challengeResultBox.style.display = "block";
    }

    function countAiFillers(text) {
      const normalized = text.toLowerCase();
      return fillerWords.reduce((total, word) => {
        const pattern = new RegExp(`(^|\\s)${word.replace(" ", "\\s+")}(?=\\s|$|[,.!?])`, "g");
        const matches = normalized.match(pattern);
        return total + (matches ? matches.length : 0);
      }, 0);
    }

    function analyzeAiFeedback() {
      const text = aiTranscript.value.trim();
      const words = text ? text.split(/\s+/).filter(Boolean).length : 0;
      const fillers = countAiFillers(text);
      const wpm = activeAiDuration > 0 ? Math.round((words / activeAiDuration) * 60) : 0;
      const speedPenalty = wpm >= 100 && wpm <= 160 ? 0 : Math.min(28, Math.abs(130 - wpm) * 0.35);
      const fillerPenalty = Math.min(35, fillers * 6);
      const lengthScore = Math.min(100, Math.max(45, (words / Math.max(activeAiDuration / 3, 1)) * 18));

      const clarity = Math.max(35, Math.round(88 - fillerPenalty * 0.55 + (words > 12 ? 6 : -8)));
      const fluency = Math.max(30, Math.round(90 - speedPenalty - fillerPenalty * 0.45));
      const confidence = Math.max(35, Math.round(62 + Math.min(activeAiDuration, 90) * 0.18 + (fillers <= 2 ? 10 : -5)));
      const consistency = Math.max(30, Math.round((fluency * 0.45) + (clarity * 0.35) + (lengthScore * 0.2)));

      const notes = [];
      if (wpm === 0) {
        notes.push("Transkrip belum diisi, jadi analisis kecepatan dan filler words masih terbatas.");
      } else if (wpm < 100) {
        notes.push("Kecepatan berbicara masih pelan. Coba kurangi jeda panjang dan susun poin sebelum mulai.");
      } else if (wpm > 160) {
        notes.push("Kecepatan berbicara terlalu cepat. Perlambat tempo agar audiens lebih mudah mengikuti.");
      } else {
        notes.push("Kecepatan berbicara sudah berada di rentang yang nyaman.");
      }

      if (fillers > 4) {
        notes.push("Penggunaan filler words masih terlalu sering. Ganti filler dengan jeda diam singkat.");
      } else if (fillers > 0) {
        notes.push("Filler words masih ada, tetapi masih bisa dikendalikan.");
      } else {
        notes.push("Penggunaan filler words sangat minim.");
      }

      if (clarity >= 80 && confidence >= 80) {
        notes.push("Penyampaian sudah cukup percaya diri dan jelas.");
      } else if (clarity < 65) {
        notes.push("Kejelasan pengucapan perlu ditingkatkan dengan artikulasi yang lebih tegas.");
      }

      latestAiResult = {
        source_type: activeAiSource,
        duration_seconds: activeAiDuration,
        clarity_score: Math.min(100, clarity),
        fluency_score: Math.min(100, fluency),
        confidence_score: Math.min(100, confidence),
        consistency_score: Math.min(100, consistency),
        filler_count: fillers,
        speaking_speed: wpm,
        feedback: notes.join(" ")
      };

      renderAiResult(latestAiResult);
      saveAiBtn.disabled = false;
      setAiMessage("success", "Analisis selesai. Simpan feedback agar masuk ke progress tracking akun.");
    }

    function renderAiResult(result) {
      confidenceScore.textContent = result.confidence_score;
      clarityScore.textContent = result.clarity_score;
      fluencyScore.textContent = result.fluency_score;
      consistencyScore.textContent = result.consistency_score;
      confidenceRing.style.setProperty("--score", `${result.confidence_score}%`);
      clarityRing.style.setProperty("--score", `${result.clarity_score}%`);
      fluencyRing.style.setProperty("--score", `${result.fluency_score}%`);
      consistencyRing.style.setProperty("--score", `${result.consistency_score}%`);
      speakingSpeed.textContent = `${result.speaking_speed} WPM`;
      fillerCount.textContent = result.filler_count;
      aiDurationResult.textContent = `${result.duration_seconds}s`;
      aiFeedbackText.className = "toast info";
      aiFeedbackText.textContent = result.feedback;
      aiResultBox.style.display = "block";
    }

    randomTopicBtn.addEventListener("click", () => {
      let nextIndex = Math.floor(Math.random() * topics.length);
      if (topics.length > 1 && nextIndex === topicIndex) {
        nextIndex = (nextIndex + 1) % topics.length;
      }
      setTopic(nextIndex);
      resetRecordingResult();
    });

    nextTopicBtn.addEventListener("click", () => {
      setTopic((topicIndex + 1) % topics.length);
      resetRecordingResult();
    });

    durationBtns.forEach(btn => {
      btn.addEventListener("click", () => {
        durationBtns.forEach(item => item.classList.remove("active"));
        btn.classList.add("active");
        selectedSeconds = Number(btn.dataset.duration);
        updateDurationLabel();
        resetTimer();
        resetRecordingResult();
      });
    });

    async function startRecording() {
      if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        setMessage("error", "Browser ini belum mendukung rekaman suara.");
        return;
      }

      try {
        const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
        audioChunks = [];
        recordedBlob = null;
        const preferredMime = MediaRecorder.isTypeSupported("audio/webm") ? "audio/webm" : "";
        mediaRecorder = preferredMime ? new MediaRecorder(stream, { mimeType: preferredMime }) : new MediaRecorder(stream);

        mediaRecorder.ondataavailable = event => {
          if (event.data.size > 0) {
            audioChunks.push(event.data);
          }
        };

        mediaRecorder.onstop = () => {
          stream.getTracks().forEach(track => track.stop());
          recordedBlob = new Blob(audioChunks, { type: preferredMime || "audio/webm" });
          playback.src = URL.createObjectURL(recordedBlob);
          resultTopic.textContent = `Topik: ${topics[topicIndex]}`;
          resultDuration.textContent = `Durasi: ${elapsedSeconds} detik`;
          resultBox.style.display = "block";
          saveBtn.disabled = false;
          setMessage("success", "Rekaman selesai. Dengarkan kembali hasil latihanmu atau simpan ke riwayat.");
        };

        resetTimer();
        resetRecordingResult();
        mediaRecorder.start();
        startBtn.disabled = true;
        stopBtn.disabled = false;
        randomTopicBtn.disabled = true;
        nextTopicBtn.disabled = true;
        durationBtns.forEach(btn => btn.disabled = true);
        recordStatus.textContent = "Sedang Merekam";
        recordStatus.classList.add("status-recording");
        micOrb.classList.add("recording");
        setMessage("info", "Latihan sedang berlangsung. Bicara sesuai topik sampai selesai.");

        timerInterval = setInterval(() => {
          remainingSeconds -= 1;
          elapsedSeconds = selectedSeconds - remainingSeconds;
          timer.textContent = formatTime(Math.max(remainingSeconds, 0));
          meterFill.style.width = `${Math.min((elapsedSeconds / selectedSeconds) * 100, 100)}%`;

          if (remainingSeconds <= 0) {
            stopRecording();
          }
        }, 1000);
      } catch (error) {
        setMessage("error", "Microphone tidak bisa diakses. Pastikan izin microphone aktif di browser.");
      }
    }

    function stopRecording() {
      clearInterval(timerInterval);
      if (mediaRecorder && mediaRecorder.state !== "inactive") {
        mediaRecorder.stop();
      }

      startBtn.disabled = false;
      stopBtn.disabled = true;
      randomTopicBtn.disabled = false;
      nextTopicBtn.disabled = false;
      durationBtns.forEach(btn => btn.disabled = false);
      recordStatus.textContent = "Latihan Selesai";
      recordStatus.classList.remove("status-recording");
      micOrb.classList.remove("recording");

      if (elapsedSeconds <= 0) {
        elapsedSeconds = selectedSeconds - remainingSeconds;
      }
    }

    async function savePractice() {
      if (!recordedBlob) {
        setMessage("error", "Belum ada rekaman yang bisa disimpan.");
        return;
      }

      if (!isLoggedIn) {
        setMessage("error", "Silakan login terlebih dahulu agar riwayat latihan tersimpan ke akun.");
        return;
      }

      const formData = new FormData();
      formData.append("action", "save_practice");
      formData.append("topic", topics[topicIndex]);
      formData.append("duration", elapsedSeconds);
      formData.append("audio", recordedBlob, "practice.webm");

      saveBtn.disabled = true;
      setMessage("info", "Menyimpan riwayat latihan...");

      try {
        const response = await fetch("Latihan.php", {
          method: "POST",
          body: formData
        });
        const data = await response.json();

        if (!data.status) {
          saveBtn.disabled = false;
          setMessage("error", data.message || "Gagal menyimpan riwayat latihan.");
          return;
        }

        prependHistory(data.item);
        setMessage("success", data.message);
      } catch (error) {
        saveBtn.disabled = false;
        setMessage("error", "Terjadi kesalahan saat menyimpan riwayat latihan.");
      }
    }

    function prependHistory(item) {
      const empty = historyList.querySelector(".empty-state");
      if (empty) empty.remove();

      const card = document.createElement("div");
      card.className = "history-card";

      const title = document.createElement("strong");
      title.textContent = item.topic;

      const meta = document.createElement("small");
      meta.textContent = `${new Date(item.created_at.replace(" ", "T")).toLocaleString("id-ID")} - ${item.duration_seconds} detik`;

      const audio = document.createElement("audio");
      audio.controls = true;
      audio.src = item.audio_path;

      card.append(title, meta, audio);
      historyList.prepend(card);
    }

    async function saveChallenge() {
      if (!latestChallengeResult) {
        setChallengeMessage("error", "Belum ada hasil challenge yang bisa disimpan.");
        return;
      }

      if (!isLoggedIn) {
        setChallengeMessage("error", "Silakan login terlebih dahulu agar riwayat challenge tersimpan ke akun.");
        return;
      }

      const formData = new FormData();
      formData.append("action", "save_challenge");
      formData.append("challenge_type", latestChallengeResult.challenge_type);
      formData.append("level_name", latestChallengeResult.level_name);
      formData.append("prompt", latestChallengeResult.prompt);
      formData.append("prep_seconds", latestChallengeResult.prep_seconds);
      formData.append("speak_seconds", latestChallengeResult.speak_seconds);
      formData.append("actual_seconds", latestChallengeResult.actual_seconds);
      formData.append("score", latestChallengeResult.score);
      formData.append("completed", latestChallengeResult.completed);

      saveChallengeBtn.disabled = true;
      setChallengeMessage("info", "Menyimpan riwayat challenge...");

      try {
        const response = await fetch("Latihan.php", {
          method: "POST",
          body: formData
        });
        const data = await response.json();

        if (!data.status) {
          saveChallengeBtn.disabled = false;
          setChallengeMessage("error", data.message || "Gagal menyimpan riwayat challenge.");
          return;
        }

        prependChallengeHistory(data.item);
        setChallengeMessage("success", data.message);
      } catch (error) {
        saveChallengeBtn.disabled = false;
        setChallengeMessage("error", "Terjadi kesalahan saat menyimpan riwayat challenge.");
      }
    }

    function prependChallengeHistory(item) {
      const empty = challengeHistoryList.querySelector(".empty-state");
      if (empty) empty.remove();

      const card = document.createElement("div");
      card.className = "history-card";

      const title = document.createElement("strong");
      title.textContent = item.prompt;

      const meta = document.createElement("small");
      meta.textContent = `${new Date(item.created_at.replace(" ", "T")).toLocaleString("id-ID")} - ${item.challenge_type} - ${item.level_name}`;

      const stats = document.createElement("div");
      stats.className = "result-meta";

      const duration = document.createElement("span");
      duration.className = "badge";
      duration.textContent = `${item.actual_seconds} detik`;

      const score = document.createElement("span");
      score.className = "badge";
      score.textContent = `Skor ${item.score}`;

      const completed = document.createElement("span");
      completed.className = "badge";
      completed.textContent = Number(item.completed) === 1 ? "Selesai" : "Belum selesai";

      stats.append(duration, score, completed);
      card.append(title, meta, stats);
      challengeHistoryList.prepend(card);
    }

    async function saveAiFeedback() {
      if (!latestAiResult) {
        setAiMessage("error", "Belum ada hasil AI feedback yang bisa disimpan.");
        return;
      }

      if (!isLoggedIn) {
        setAiMessage("error", "Silakan login terlebih dahulu agar AI feedback tersimpan ke akun.");
        return;
      }

      const formData = new FormData();
      formData.append("action", "save_ai_feedback");
      formData.append("source_type", latestAiResult.source_type);
      formData.append("duration_seconds", latestAiResult.duration_seconds);
      formData.append("clarity_score", latestAiResult.clarity_score);
      formData.append("fluency_score", latestAiResult.fluency_score);
      formData.append("confidence_score", latestAiResult.confidence_score);
      formData.append("consistency_score", latestAiResult.consistency_score);
      formData.append("filler_count", latestAiResult.filler_count);
      formData.append("speaking_speed", latestAiResult.speaking_speed);
      formData.append("feedback", latestAiResult.feedback);

      saveAiBtn.disabled = true;
      setAiMessage("info", "Menyimpan AI feedback...");

      try {
        const response = await fetch("Latihan.php", {
          method: "POST",
          body: formData
        });
        const data = await response.json();

        if (!data.status) {
          saveAiBtn.disabled = false;
          setAiMessage("error", data.message || "Gagal menyimpan AI feedback.");
          return;
        }

        prependAiHistory(data.item);
        setAiMessage("success", data.message);
      } catch (error) {
        saveAiBtn.disabled = false;
        setAiMessage("error", "Terjadi kesalahan saat menyimpan AI feedback.");
      }
    }

    function prependAiHistory(item) {
      const empty = aiHistoryList.querySelector(".empty-state");
      if (empty) empty.remove();

      const card = document.createElement("div");
      card.className = "history-card";
      const avg = Math.round((Number(item.clarity_score) + Number(item.fluency_score) + Number(item.confidence_score) + Number(item.consistency_score)) / 4);

      const title = document.createElement("strong");
      title.textContent = `${item.source_type} - Skor ${avg}`;

      const meta = document.createElement("small");
      meta.textContent = `${new Date(item.created_at.replace(" ", "T")).toLocaleString("id-ID")} - ${item.duration_seconds} detik - ${item.speaking_speed} WPM`;

      const stats = document.createElement("div");
      stats.className = "result-meta";

      ["Clarity " + item.clarity_score, "Fluency " + item.fluency_score, "Filler " + item.filler_count].forEach(text => {
        const pill = document.createElement("span");
        pill.className = "badge";
        pill.textContent = text;
        stats.appendChild(pill);
      });

      card.append(title, meta, stats);
      aiHistoryList.prepend(card);
    }

    featureCards.forEach(card => {
      card.addEventListener("click", () => {
        switchFeature(card.dataset.feature);
      });
    });

    aiSourceBtns.forEach(btn => {
      btn.addEventListener("click", () => {
        aiSourceBtns.forEach(item => item.classList.remove("active"));
        btn.classList.add("active");
        activeAiSource = btn.dataset.source;
        latestAiResult = null;
        saveAiBtn.disabled = true;
      });
    });

    aiDurationBtns.forEach(btn => {
      btn.addEventListener("click", () => {
        aiDurationBtns.forEach(item => item.classList.remove("active"));
        btn.classList.add("active");
        activeAiDuration = Number(btn.dataset.duration);
        latestAiResult = null;
        saveAiBtn.disabled = true;
      });
    });

    challengeTypeBtns.forEach(btn => {
      btn.addEventListener("click", () => {
        challengeTypeBtns.forEach(item => item.classList.remove("active"));
        btn.classList.add("active");
        activeChallengeType = btn.dataset.type;
        pickChallengePrompt(true);
      });
    });

    challengeLevelBtns.forEach(btn => {
      btn.addEventListener("click", () => {
        challengeLevelBtns.forEach(item => item.classList.remove("active"));
        btn.classList.add("active");
        activeLevel = {
          name: btn.dataset.level,
          prep: Number(btn.dataset.prep),
          speak: Number(btn.dataset.speak),
          weight: Number(btn.dataset.weight)
        };
        resetChallenge(true);
      });
    });

    startBtn.addEventListener("click", startRecording);
    stopBtn.addEventListener("click", stopRecording);
    saveBtn.addEventListener("click", savePractice);
    newChallengeBtn.addEventListener("click", () => pickChallengePrompt(true));
    startChallengeBtn.addEventListener("click", startChallenge);
    finishChallengeBtn.addEventListener("click", () => finishChallenge(false));
    saveChallengeBtn.addEventListener("click", saveChallenge);
    analyzeAiBtn.addEventListener("click", analyzeAiFeedback);
    saveAiBtn.addEventListener("click", saveAiFeedback);

    updateDurationLabel();
    resetTimer();
    setTopic(0);
    pickChallengePrompt(false);
    switchFeature("voice");
  </script>
</body>

</html>
