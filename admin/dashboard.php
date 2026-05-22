<?php
require_once '../core.php';

$app = new manz();
$mentor = $app->getCurrentMentor();

if (!$mentor) {
    header('Location: loginad.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save_review') {
    $submissionId = (int) ($_POST['submission_id'] ?? 0);
    $strengths = trim($_POST['strengths'] ?? '');
    $improvements = trim($_POST['improvements'] ?? '');
    $feedback = trim($_POST['feedback'] ?? '');

    if ($submissionId <= 0 || $strengths === '' || $improvements === '' || $feedback === '') {
        $error = 'Isi rubric dan catatan penilaian sebelum menyimpan.';
    } else {
        $saved = $app->saveMentorReview(
            $submissionId,
            $mentor['id'],
            [
                'articulation' => $_POST['articulation_score'] ?? 0,
                'fluency' => $_POST['fluency_score'] ?? 0,
                'confidence' => $_POST['confidence_score'] ?? 0,
                'structure' => $_POST['structure_score'] ?? 0,
                'intonation' => $_POST['intonation_score'] ?? 0
            ],
            $strengths,
            $improvements,
            $feedback
        );

        if ($saved) {
            header('Location: dashboard.php?submission=' . $submissionId . '&saved=1');
            exit;
        }

        $error = 'Penilaian belum tersimpan.';
    }
}

$stats = $app->getMentorDashboardStats();
$queue = $app->getMentorReviewQueue();
$selectedSubmissionId = (int) ($_GET['submission'] ?? 0);
$selectedSubmission = $selectedSubmissionId > 0 ? $app->getMentorSubmissionById($selectedSubmissionId) : false;
$reviewSaved = isset($_GET['saved']);

function mentorStatusLabel($status) {
    if ($status === 'reviewed') return 'Sudah dinilai';
    if ($status === 'revision_requested') return 'Revisi';
    return 'Menunggu';
}

function mentorScoreValue($submission, $key, $fallback = 75) {
    return isset($submission[$key]) && $submission[$key] !== null ? (int) $submission[$key] : $fallback;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TALKLAB - Dashboard Mentor</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            color: #142033;
            background: #f4f6fa;
            font-family: system-ui, sans-serif;
        }

        button,
        input,
        textarea { font: inherit; }

        .shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 248px minmax(0, 1fr);
        }

        .sidebar {
            background: #10204f;
            color: #fff;
            padding: 30px 24px;
            display: flex;
            flex-direction: column;
            gap: 34px;
        }

        .brand {
            color: inherit;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand img {
            width: 56px;
            height: 56px;
            object-fit: contain;
        }

        .brand strong {
            display: block;
            font-size: 26px;
            letter-spacing: 0;
        }

        .brand span,
        .mentor-meta span {
            color: #e0b278;
        }

        .mentor-meta {
            border-top: 1px solid rgb(255 255 255 / 0.18);
            padding-top: 22px;
        }

        .mentor-meta strong,
        .mentor-meta span {
            display: block;
            overflow-wrap: anywhere;
        }

        .mentor-meta strong { font-size: 18px; }
        .mentor-meta span { margin-top: 6px; }

        .nav {
            display: grid;
            gap: 10px;
        }

        .nav a {
            border-radius: 8px;
            color: inherit;
            padding: 13px 14px;
            text-decoration: none;
        }

        .nav a.active { background: #d2a06b; font-weight: 700; }
        .nav a:not(.active) { background: rgb(255 255 255 / 0.09); }

        .logout {
            margin-top: auto;
            background: #fff;
            border-radius: 8px;
            color: #10204f;
            font-weight: 700;
            padding: 13px 14px;
            text-align: center;
            text-decoration: none;
        }

        main {
            min-width: 0;
            padding: 36px;
        }

        .topbar {
            align-items: end;
            display: flex;
            gap: 18px;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        h1,
        h2,
        h3,
        p { margin-top: 0; }

        h1 {
            color: #10204f;
            font-size: 36px;
            letter-spacing: 0;
            margin-bottom: 8px;
        }

        .muted { color: #667085; }

        .date-pill,
        .status {
            border-radius: 999px;
            display: inline-flex;
            padding: 8px 12px;
            white-space: nowrap;
        }

        .date-pill {
            background: #fff;
            border: 1px solid #d8dee9;
            color: #344054;
        }

        .stats {
            display: grid;
            gap: 16px;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            margin-bottom: 24px;
        }

        .stat,
        .panel {
            background: #fff;
            border: 1px solid #e4e7ec;
            border-radius: 8px;
            box-shadow: 0 12px 32px rgb(16 32 79 / 0.07);
        }

        .stat {
            min-height: 132px;
            padding: 22px;
        }

        .stat span {
            color: #667085;
            display: block;
            margin-bottom: 18px;
        }

        .stat strong {
            color: #10204f;
            font-size: 38px;
            letter-spacing: 0;
        }

        .layout {
            align-items: start;
            display: grid;
            gap: 20px;
            grid-template-columns: minmax(360px, 1.08fr) minmax(380px, 0.92fr);
        }

        .panel { padding: 24px; }

        .panel-head {
            align-items: center;
            display: flex;
            gap: 14px;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .panel h2 {
            color: #10204f;
            font-size: 24px;
            letter-spacing: 0;
            margin-bottom: 6px;
        }

        .queue {
            display: grid;
            gap: 12px;
        }

        .queue-item {
            align-items: start;
            background: #f8fafc;
            border: 1px solid #e4e7ec;
            border-radius: 8px;
            color: inherit;
            display: grid;
            gap: 12px;
            grid-template-columns: minmax(0, 1fr) auto;
            padding: 16px;
            text-decoration: none;
        }

        .queue-item:hover,
        .queue-item.selected {
            border-color: #d2a06b;
            background: #fff8ef;
        }

        .queue-item strong,
        .queue-item small { display: block; }

        .queue-item strong {
            color: #10204f;
            margin-bottom: 6px;
        }

        .queue-item small,
        .queue-item p {
            color: #667085;
            margin-bottom: 0;
        }

        .queue-item p {
            line-height: 1.45;
            margin-top: 10px;
        }

        .status {
            background: #fff1df;
            color: #9a5600;
            font-size: 13px;
            font-weight: 700;
        }

        .status.reviewed {
            background: #dcfae6;
            color: #067647;
        }

        .empty {
            border: 1px dashed #c7cfdb;
            border-radius: 8px;
            color: #667085;
            padding: 34px 20px;
            text-align: center;
        }

        .notice {
            border-radius: 8px;
            margin-bottom: 16px;
            padding: 13px 15px;
        }

        .notice.success {
            background: #dcfae6;
            color: #067647;
        }

        .notice.error {
            background: #fee4e2;
            color: #b42318;
        }

        .submission-meta {
            display: grid;
            gap: 10px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            margin-bottom: 18px;
        }

        .submission-meta div {
            background: #f8fafc;
            border-radius: 8px;
            min-width: 0;
            padding: 12px;
        }

        .submission-meta span,
        label {
            color: #667085;
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .submission-meta strong {
            display: block;
            overflow-wrap: anywhere;
        }

        audio {
            margin-bottom: 18px;
            width: 100%;
        }

        .score-grid {
            display: grid;
            gap: 12px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        input[type="number"],
        textarea {
            background: #fff;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            color: #142033;
            outline: none;
            padding: 12px;
            width: 100%;
        }

        input[type="number"]:focus,
        textarea:focus {
            border-color: #1c407a;
            box-shadow: 0 0 0 3px rgb(28 64 122 / 0.14);
        }

        textarea {
            min-height: 86px;
            resize: vertical;
        }

        .field { margin-top: 14px; }

        .save {
            background: #10204f;
            border: 0;
            border-radius: 8px;
            color: #fff;
            cursor: pointer;
            font-weight: 800;
            margin-top: 16px;
            padding: 14px 18px;
            width: 100%;
        }

        @media (max-width: 1080px) {
            .shell,
            .layout { grid-template-columns: 1fr; }

            .sidebar {
                gap: 18px;
                position: static;
            }

            .nav { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .logout { margin-top: 0; }
            .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 640px) {
            main { padding: 24px 16px; }
            .topbar { align-items: start; flex-direction: column; }
            .stats,
            .score-grid,
            .submission-meta { grid-template-columns: 1fr; }
            .queue-item { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <aside class="sidebar">
            <a class="brand" href="dashboard.php">
                <img src="../assets/ayooo.png" alt="Talklab">
                <strong>TALK<span>LAB</span></strong>
            </a>

            <div class="mentor-meta">
                <strong><?= htmlspecialchars($mentor['name']) ?></strong>
                <span>@<?= htmlspecialchars($mentor['username']) ?></span>
            </div>

            <nav class="nav">
                <a class="active" href="dashboard.php">Dashboard</a>
                <a href="#review-queue">Latihan Masuk</a>
            </nav>

            <a class="logout" href="logoutad.php">Logout</a>
        </aside>

        <main>
            <header class="topbar">
                <div>
                    <h1>Dashboard Mentor</h1>
                    <p class="muted">Review latihan public speaking yang masuk dari peserta.</p>
                </div>
                <span class="date-pill"><?= htmlspecialchars(date('d M Y')) ?></span>
            </header>

            <section class="stats" aria-label="Statistik mentor">
                <div class="stat">
                    <span>Menunggu nilai</span>
                    <strong><?= (int) $stats['pending'] ?></strong>
                </div>
                <div class="stat">
                    <span>Sudah dinilai</span>
                    <strong><?= (int) $stats['reviewed'] ?></strong>
                </div>
                <div class="stat">
                    <span>Peserta terkirim</span>
                    <strong><?= (int) $stats['students'] ?></strong>
                </div>
                <div class="stat">
                    <span>Rata-rata review</span>
                    <strong><?= (int) $stats['average_score'] ?></strong>
                </div>
            </section>

            <section class="layout">
                <article class="panel" id="review-queue">
                    <div class="panel-head">
                        <div>
                            <h2>Latihan Masuk</h2>
                            <p class="muted"><?= (int) $stats['practice_audio'] ?> rekaman latihan tersimpan</p>
                        </div>
                    </div>

                    <div class="queue">
                        <?php if (empty($queue)): ?>
                            <div class="empty">Belum ada latihan yang dikirim ke mentor.</div>
                        <?php else: ?>
                            <?php foreach ($queue as $item): ?>
                                <a class="queue-item <?= $selectedSubmissionId === (int) $item['id'] ? 'selected' : '' ?>" href="dashboard.php?submission=<?= (int) $item['id'] ?>">
                                    <div>
                                        <strong><?= htmlspecialchars($item['student_name']) ?> @<?= htmlspecialchars($item['student_username']) ?></strong>
                                        <small><?= htmlspecialchars(date('d M Y H:i', strtotime($item['submitted_at']))) ?> - <?= (int) $item['duration_seconds'] ?> detik</small>
                                        <p><?= htmlspecialchars($item['topic']) ?></p>
                                    </div>
                                    <span class="status <?= $item['status'] === 'reviewed' ? 'reviewed' : '' ?>">
                                        <?= htmlspecialchars(mentorStatusLabel($item['status'])) ?>
                                    </span>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </article>

                <article class="panel">
                    <?php if ($reviewSaved): ?>
                        <div class="notice success">Penilaian mentor tersimpan.</div>
                    <?php endif; ?>

                    <?php if ($error !== ''): ?>
                        <div class="notice error"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <?php if (!$selectedSubmission): ?>
                        <div>
                            <h2>Panel Penilaian</h2>
                            <p class="muted">Pilih latihan masuk untuk mendengarkan rekaman dan mengisi nilai.</p>
                            <div class="empty">Rubric mentor siap untuk artikulasi, kelancaran, percaya diri, struktur, dan intonasi.</div>
                        </div>
                    <?php else: ?>
                        <div class="panel-head">
                            <div>
                                <h2>Nilai Latihan</h2>
                                <p class="muted"><?= htmlspecialchars($selectedSubmission['topic']) ?></p>
                            </div>
                            <span class="status <?= $selectedSubmission['status'] === 'reviewed' ? 'reviewed' : '' ?>">
                                <?= htmlspecialchars(mentorStatusLabel($selectedSubmission['status'])) ?>
                            </span>
                        </div>

                        <div class="submission-meta">
                            <div>
                                <span>Peserta</span>
                                <strong><?= htmlspecialchars($selectedSubmission['student_name']) ?></strong>
                            </div>
                            <div>
                                <span>Username</span>
                                <strong>@<?= htmlspecialchars($selectedSubmission['student_username']) ?></strong>
                            </div>
                            <div>
                                <span>Durasi</span>
                                <strong><?= (int) $selectedSubmission['duration_seconds'] ?> detik</strong>
                            </div>
                            <div>
                                <span>Dikirim</span>
                                <strong><?= htmlspecialchars(date('d M Y H:i', strtotime($selectedSubmission['submitted_at']))) ?></strong>
                            </div>
                        </div>

                        <audio controls src="../<?= htmlspecialchars($selectedSubmission['audio_path']) ?>"></audio>

                        <form method="POST" action="dashboard.php?submission=<?= (int) $selectedSubmission['id'] ?>">
                            <input type="hidden" name="action" value="save_review">
                            <input type="hidden" name="submission_id" value="<?= (int) $selectedSubmission['id'] ?>">

                            <div class="score-grid">
                                <div>
                                    <label for="articulation_score">Artikulasi</label>
                                    <input id="articulation_score" type="number" name="articulation_score" min="0" max="100" value="<?= mentorScoreValue($selectedSubmission, 'articulation_score') ?>" required>
                                </div>
                                <div>
                                    <label for="fluency_score">Kelancaran</label>
                                    <input id="fluency_score" type="number" name="fluency_score" min="0" max="100" value="<?= mentorScoreValue($selectedSubmission, 'fluency_score') ?>" required>
                                </div>
                                <div>
                                    <label for="confidence_score">Percaya Diri</label>
                                    <input id="confidence_score" type="number" name="confidence_score" min="0" max="100" value="<?= mentorScoreValue($selectedSubmission, 'confidence_score') ?>" required>
                                </div>
                                <div>
                                    <label for="structure_score">Struktur</label>
                                    <input id="structure_score" type="number" name="structure_score" min="0" max="100" value="<?= mentorScoreValue($selectedSubmission, 'structure_score') ?>" required>
                                </div>
                                <div>
                                    <label for="intonation_score">Intonasi</label>
                                    <input id="intonation_score" type="number" name="intonation_score" min="0" max="100" value="<?= mentorScoreValue($selectedSubmission, 'intonation_score') ?>" required>
                                </div>
                                <div>
                                    <label>Nilai Akhir</label>
                                    <input type="number" value="<?= mentorScoreValue($selectedSubmission, 'final_score') ?>" disabled>
                                </div>
                            </div>

                            <div class="field">
                                <label for="strengths">Kelebihan</label>
                                <textarea id="strengths" name="strengths" required><?= htmlspecialchars($selectedSubmission['strengths'] ?? '') ?></textarea>
                            </div>

                            <div class="field">
                                <label for="improvements">Perlu Diperbaiki</label>
                                <textarea id="improvements" name="improvements" required><?= htmlspecialchars($selectedSubmission['improvements'] ?? '') ?></textarea>
                            </div>

                            <div class="field">
                                <label for="feedback">Feedback Mentor</label>
                                <textarea id="feedback" name="feedback" required><?= htmlspecialchars($selectedSubmission['feedback'] ?? '') ?></textarea>
                            </div>

                            <button class="save" type="submit">Simpan Penilaian</button>
                        </form>
                    <?php endif; ?>
                </article>
            </section>
        </main>
    </div>
</body>
</html>
