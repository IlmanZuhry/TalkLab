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
}

$practiceHistory = $currentUser ? $app->getPracticeHistory($currentUser['Id_User']) : [];
$challengeHistory = $currentUser ? $app->getChallengeHistory($currentUser['Id_User']) : [];
$practiceScripts = [
  [
    'category' => 'Pidato',
    'scripts' => [
      [
        'level' => 'Beginner',
        'duration' => 30,
        'title' => 'Pidato Singkat Tentang Disiplin',
        'text' => "Selamat pagi semuanya.\n\n[JEDA]\n\nHari ini saya ingin menyampaikan pesan singkat tentang disiplin.\n\nDisiplin membantu kita menggunakan waktu dengan lebih baik.\n\n[TEKANAN]\n\nJika kita konsisten, tujuan kecil setiap hari akan membawa perubahan besar."
      ],
      [
        'level' => 'Intermediate',
        'duration' => 60,
        'title' => 'Pentingnya Berani Berbicara',
        'text' => "Selamat pagi dan salam sejahtera untuk kita semua.\n\n[JEDA]\n\nKemampuan berbicara di depan umum bukan hanya bakat, tetapi keterampilan yang dapat dilatih.\n\nSaat kita berani menyampaikan pendapat, kita belajar menyusun pikiran dengan lebih jelas.\n\n[TEKANAN]\n\nKeberanian berbicara membuka kesempatan untuk memimpin, bekerja sama, dan memberi pengaruh positif.\n\nMari mulai dari langkah kecil: berbicara jelas, mendengar dengan baik, dan menyampaikan pesan dengan percaya diri."
      ],
      [
        'level' => 'Advanced',
        'duration' => 180,
        'title' => 'Pidato Tentang Generasi Pembelajar',
        'text' => "Assalamualaikum warahmatullahi wabarakatuh.\n\n[JEDA]\n\nHadirin yang saya hormati, hari ini kita hidup di masa ketika perubahan terjadi sangat cepat. Teknologi berkembang, cara belajar berubah, dan tantangan masa depan semakin beragam.\n\nNamun ada satu hal yang tetap penting, yaitu kemauan untuk terus belajar.\n\n[TEKANAN]\n\nGenerasi pembelajar bukan generasi yang selalu tahu semua jawaban. Generasi pembelajar adalah generasi yang berani bertanya, mau mencoba, dan tidak berhenti ketika gagal.\n\n[JEDA]\n\nDalam kehidupan sehari-hari, sikap belajar dapat dimulai dari hal sederhana. Kita membaca lebih teliti, mendengarkan pendapat orang lain, melatih kemampuan komunikasi, dan mengevaluasi diri setelah melakukan sesuatu.\n\nKemampuan public speaking juga bagian dari proses itu. Saat berbicara di depan orang lain, kita belajar mengatur pikiran, menjaga emosi, dan menyampaikan pesan secara bertanggung jawab.\n\n[TEKANAN]\n\nKarena itu, marilah kita menjadi generasi yang tidak hanya mengejar nilai, tetapi juga membangun karakter, keberanian, dan kemampuan untuk memberi manfaat.\n\nTerima kasih."
      ]
    ]
  ],
  [
    'category' => 'Presentasi',
    'scripts' => [
      [
        'level' => 'Beginner',
        'duration' => 30,
        'title' => 'Pembuka Presentasi Tugas',
        'text' => "Halo semuanya.\n\n[JEDA]\n\nPada kesempatan ini, saya akan mempresentasikan hasil tugas kelompok kami.\n\nMateri ini akan saya sampaikan dalam tiga bagian: latar belakang, pembahasan, dan kesimpulan.\n\n[TEKANAN]\n\nSemoga penjelasan ini mudah dipahami."
      ],
      [
        'level' => 'Intermediate',
        'duration' => 60,
        'title' => 'Presentasi Ide Aplikasi Belajar',
        'text' => "Selamat siang semuanya.\n\n[JEDA]\n\nHari ini saya akan memperkenalkan ide aplikasi belajar yang membantu siswa melatih public speaking secara mandiri.\n\nMasalah yang sering terjadi adalah siswa ingin berlatih, tetapi tidak tahu harus mulai dari topik apa.\n\n[TEKANAN]\n\nSolusi kami adalah menyediakan naskah, timer, rekaman, dan riwayat latihan agar proses belajar lebih terarah.\n\nDengan fitur ini, pengguna dapat membaca naskah, merekam suara, lalu mengevaluasi cara berbicara mereka secara bertahap."
      ],
      [
        'level' => 'Advanced',
        'duration' => 180,
        'title' => 'Presentasi Rencana Program Kelas',
        'text' => "Selamat pagi Bapak, Ibu, dan teman-teman.\n\n[JEDA]\n\nPada presentasi ini, saya akan menyampaikan rencana program kelas yang bertujuan meningkatkan kemampuan komunikasi siswa.\n\nProgram ini berangkat dari kebutuhan sederhana: banyak siswa memiliki ide yang baik, tetapi belum terbiasa menyampaikannya dengan jelas di depan umum.\n\n[TEKANAN]\n\nKarena itu, program ini dirancang dalam tiga tahap. Tahap pertama adalah latihan membaca naskah pendek untuk melatih artikulasi dan ritme. Tahap kedua adalah tantangan bicara singkat untuk melatih spontanitas. Tahap ketiga adalah praktik menggunakan kamera untuk melatih ekspresi dan bahasa tubuh.\n\n[JEDA]\n\nPelaksanaan program dapat dilakukan dua kali seminggu. Setiap sesi berlangsung singkat agar tidak membebani jadwal belajar. Siswa akan mendapat tema latihan, melakukan rekaman, lalu mencatat evaluasi sederhana.\n\nManfaat yang diharapkan bukan hanya kemampuan berbicara yang lebih baik, tetapi juga peningkatan rasa percaya diri, kemampuan menyusun pesan, dan keberanian menerima masukan.\n\n[TEKANAN]\n\nDengan program yang konsisten, kelas dapat menjadi ruang aman untuk belajar berbicara, mencoba, dan berkembang bersama.\n\nTerima kasih."
      ]
    ]
  ],
  [
    'category' => 'Seminar',
    'scripts' => [
      [
        'level' => 'Beginner',
        'duration' => 30,
        'title' => 'Pembuka Seminar Singkat',
        'text' => "Selamat pagi para peserta.\n\n[JEDA]\n\nTerima kasih sudah hadir dalam seminar hari ini.\n\nKita akan membahas cara membangun komunikasi yang lebih percaya diri.\n\n[TEKANAN]\n\nSemoga sesi ini memberi manfaat dan bisa langsung dipraktikkan."
      ],
      [
        'level' => 'Intermediate',
        'duration' => 60,
        'title' => 'Pengantar Seminar Komunikasi',
        'text' => "Selamat pagi dan salam sejahtera.\n\n[JEDA]\n\nPada seminar ini, kita akan membahas pentingnya komunikasi yang jelas dalam kehidupan akademik maupun profesional.\n\nKomunikasi bukan hanya tentang berbicara, tetapi juga tentang menyusun pesan, memilih kata, dan memahami audiens.\n\n[TEKANAN]\n\nKetika pesan disampaikan dengan baik, audiens lebih mudah memahami tujuan kita.\n\nMari ikuti sesi ini dengan aktif, terbuka, dan siap berlatih."
      ],
      [
        'level' => 'Advanced',
        'duration' => 180,
        'title' => 'Seminar Membangun Kepercayaan Diri',
        'text' => "Selamat pagi para peserta seminar yang saya hormati.\n\n[JEDA]\n\nKepercayaan diri sering dianggap sebagai sesuatu yang muncul secara alami. Padahal, dalam banyak situasi, kepercayaan diri tumbuh karena latihan yang konsisten dan pengalaman yang berulang.\n\nDalam public speaking, rasa percaya diri bukan berarti tidak pernah gugup. Rasa percaya diri berarti kita tetap mampu menyampaikan pesan meskipun ada rasa gugup.\n\n[TEKANAN]\n\nAda tiga hal yang dapat membantu kita membangun kepercayaan diri. Pertama, kuasai pesan utama yang ingin disampaikan. Kedua, latih suara agar terdengar jelas dan stabil. Ketiga, biasakan memberi jeda agar pikiran dan napas tetap terkontrol.\n\n[JEDA]\n\nSelain itu, evaluasi setelah latihan sangat penting. Dengarkan rekaman suara, perhatikan bagian yang terlalu cepat, lalu ulangi dengan ritme yang lebih baik. Proses sederhana ini dapat menghasilkan perkembangan nyata.\n\nPublic speaking bukan perlombaan untuk terlihat sempurna. Public speaking adalah proses menyampaikan pesan dengan jujur, terarah, dan mudah dipahami.\n\n[TEKANAN]\n\nSemoga setelah seminar ini, kita tidak hanya memahami teori, tetapi juga berani memulai latihan kecil secara rutin.\n\nTerima kasih."
      ]
    ]
  ],
  [
    'category' => 'MC',
    'scripts' => [
      [
        'level' => 'Beginner',
        'duration' => 30,
        'title' => 'Pembukaan Acara Kelas',
        'text' => "Selamat pagi semuanya.\n\n[JEDA]\n\nSaya sebagai pembawa acara mengucapkan selamat datang dalam kegiatan hari ini.\n\nSebelum acara dimulai, marilah kita berdoa agar kegiatan berjalan lancar.\n\n[TEKANAN]\n\nSemoga acara ini memberi manfaat bagi kita semua."
      ],
      [
        'level' => 'Intermediate',
        'duration' => 60,
        'title' => 'MC Seminar Sekolah',
        'text' => "Assalamualaikum warahmatullahi wabarakatuh.\n\n[JEDA]\n\nSelamat pagi Bapak, Ibu, narasumber, dan teman-teman yang berbahagia.\n\nSaya akan memandu jalannya seminar pada hari ini dengan tema komunikasi percaya diri.\n\n[TEKANAN]\n\nSebelum memasuki acara inti, mari kita siapkan perhatian dan semangat belajar.\n\nSemoga kegiatan ini berjalan lancar dari awal hingga akhir."
      ],
      [
        'level' => 'Advanced',
        'duration' => 180,
        'title' => 'MC Acara Formal',
        'text' => "Assalamualaikum warahmatullahi wabarakatuh.\n\n[JEDA]\n\nYang terhormat Bapak dan Ibu guru, yang kami hormati para tamu undangan, serta teman-teman yang saya banggakan.\n\nPuji syukur kita panjatkan ke hadirat Tuhan Yang Maha Esa karena pada hari ini kita dapat berkumpul dalam keadaan sehat untuk mengikuti acara yang telah kita nantikan bersama.\n\n[TEKANAN]\n\nSaya selaku pembawa acara akan memandu rangkaian kegiatan dari awal hingga selesai. Adapun susunan acara pada hari ini meliputi pembukaan, sambutan, penyampaian materi utama, sesi tanya jawab, dan penutup.\n\n[JEDA]\n\nSebelum memasuki acara pertama, kami mengajak seluruh hadirin untuk menjaga suasana tetap tertib dan memberikan perhatian penuh kepada setiap pengisi acara.\n\nSemoga kegiatan hari ini dapat berjalan lancar, memberi wawasan baru, dan menjadi pengalaman yang bermanfaat bagi seluruh peserta.\n\n[TEKANAN]\n\nBaik, marilah kita mulai acara ini dengan membaca doa menurut agama dan kepercayaan masing-masing. Berdoa dimulai.\n\nTerima kasih."
      ]
    ]
  ],
  [
    'category' => 'Storytelling',
    'scripts' => [
      [
        'level' => 'Beginner',
        'duration' => 30,
        'title' => 'Cerita Tentang Hari Pertama',
        'text' => "Hari pertama saya masuk kelas baru terasa menegangkan.\n\n[JEDA]\n\nSaya duduk diam dan belum berani menyapa siapa pun.\n\nNamun, satu teman tersenyum dan mengajak berbicara.\n\n[TEKANAN]\n\nDari situ saya belajar bahwa keberanian kecil bisa membuka pertemanan baru."
      ],
      [
        'level' => 'Intermediate',
        'duration' => 60,
        'title' => 'Cerita Belajar dari Kegagalan',
        'text' => "Beberapa waktu lalu, saya pernah gagal saat presentasi.\n\n[JEDA]\n\nSaya lupa urutan materi, berbicara terlalu cepat, dan merasa sangat gugup.\n\nSetelah itu, saya mendengarkan masukan dari teman dan mulai berlatih dengan naskah pendek.\n\n[TEKANAN]\n\nSaya belajar bahwa kegagalan bukan akhir, tetapi tanda bahwa kita perlu memperbaiki cara berlatih.\n\nSekarang, saya lebih siap karena tahu apa yang harus diperbaiki."
      ],
      [
        'level' => 'Advanced',
        'duration' => 180,
        'title' => 'Cerita Tentang Keberanian Mencoba',
        'text' => "Dulu saya selalu menghindar ketika diminta berbicara di depan kelas.\n\n[JEDA]\n\nSetiap kali guru meminta sukarelawan, saya menunduk dan berharap nama saya tidak dipanggil. Saya merasa suara saya tidak cukup bagus, kalimat saya tidak rapi, dan semua orang akan memperhatikan kesalahan saya.\n\nSuatu hari, kelompok saya harus mempresentasikan hasil diskusi. Tidak ada yang siap membuka presentasi, lalu saya mencoba mengambil bagian itu.\n\n[TEKANAN]\n\nAwalnya suara saya bergetar. Saya berhenti sebentar, menarik napas, lalu membaca kalimat pembuka yang sudah saya siapkan.\n\n[JEDA]\n\nTernyata, setelah kalimat pertama selesai, rasa takut itu mulai berkurang. Teman-teman mendengarkan, dan saya mulai memahami bahwa audiens tidak selalu menunggu kesalahan. Banyak dari mereka justru ingin memahami pesan yang kita sampaikan.\n\nSejak hari itu, saya tidak langsung menjadi pembicara yang hebat. Tetapi saya mulai berani berlatih. Saya merekam suara, memperbaiki tempo, dan belajar memberi jeda.\n\n[TEKANAN]\n\nKeberanian tidak selalu datang sebelum kita mencoba. Kadang keberanian muncul setelah kita mengambil langkah pertama.\n\nItulah pelajaran yang saya ingat sampai sekarang."
      ]
    ]
  ],
  [
    'category' => 'Perkenalan Diri',
    'scripts' => [
      [
        'level' => 'Beginner',
        'duration' => 30,
        'title' => 'Perkenalan Diri Singkat',
        'text' => "Halo semuanya.\n\n[JEDA]\n\nPerkenalkan nama saya Ahmad.\n\nSaya adalah mahasiswa yang tertarik pada teknologi dan komunikasi.\n\n[TEKANAN]\n\nSaya ingin melatih public speaking agar dapat menyampaikan ide dengan lebih percaya diri."
      ],
      [
        'level' => 'Intermediate',
        'duration' => 60,
        'title' => 'Perkenalan Diri yang Percaya Diri',
        'text' => "Halo semuanya.\n\n[JEDA]\n\nPerkenalkan nama saya Ahmad.\n\nSaya merupakan mahasiswa yang memiliki minat pada bidang teknologi dan komunikasi.\n\n[TEKANAN]\n\nSaya percaya bahwa kemampuan public speaking merupakan salah satu keterampilan penting untuk masa depan.\n\nMelalui latihan yang konsisten, saya ingin belajar berbicara dengan lebih jelas, terstruktur, dan percaya diri.\n\nTerima kasih."
      ],
      [
        'level' => 'Advanced',
        'duration' => 180,
        'title' => 'Perkenalan Diri Profesional',
        'text' => "Halo semuanya, perkenalkan nama saya Ahmad.\n\n[JEDA]\n\nSaya adalah mahasiswa yang memiliki ketertarikan besar pada bidang teknologi, komunikasi, dan pengembangan diri. Selama ini saya belajar bahwa kemampuan teknis saja tidak cukup. Kita juga perlu mampu menjelaskan ide, bekerja sama, dan menyampaikan pendapat dengan jelas.\n\n[TEKANAN]\n\nKarena itu, saya terus melatih public speaking sebagai bagian dari proses membangun kepercayaan diri.\n\nDalam kegiatan sehari-hari, saya senang mempelajari hal baru, terutama yang berhubungan dengan cara teknologi membantu manusia berkomunikasi dan belajar lebih efektif.\n\n[JEDA]\n\nSaya juga percaya bahwa setiap orang dapat berkembang jika memiliki kemauan untuk mencoba, menerima masukan, dan memperbaiki diri secara bertahap.\n\nMelalui kesempatan ini, saya ingin memperkenalkan diri bukan hanya sebagai seseorang yang sedang belajar, tetapi juga sebagai pribadi yang ingin terus tumbuh dan memberi kontribusi positif.\n\n[TEKANAN]\n\nHarapan saya, latihan ini membantu saya berbicara lebih runtut, mengatur intonasi, dan menyampaikan pesan dengan lebih meyakinkan.\n\nTerima kasih atas perhatiannya."
      ]
    ]
  ],
  [
    'category' => 'Motivasi',
    'scripts' => [
      [
        'level' => 'Beginner',
        'duration' => 30,
        'title' => 'Motivasi Memulai Latihan',
        'text' => "Setiap kemampuan besar dimulai dari latihan kecil.\n\n[JEDA]\n\nKita tidak harus langsung sempurna saat pertama mencoba.\n\nYang penting adalah berani memulai dan mau memperbaiki diri.\n\n[TEKANAN]\n\nSatu latihan hari ini bisa menjadi langkah penting untuk masa depan."
      ],
      [
        'level' => 'Intermediate',
        'duration' => 60,
        'title' => 'Motivasi Menghadapi Rasa Gugup',
        'text' => "Rasa gugup saat berbicara di depan umum adalah hal yang wajar.\n\n[JEDA]\n\nBahkan pembicara berpengalaman pun pernah mengalaminya.\n\nYang membedakan adalah cara kita mengelola rasa gugup tersebut.\n\n[TEKANAN]\n\nTarik napas, atur tempo, dan fokus pada pesan yang ingin disampaikan.\n\nSemakin sering berlatih, semakin kuat kepercayaan diri kita."
      ],
      [
        'level' => 'Advanced',
        'duration' => 180,
        'title' => 'Motivasi Untuk Terus Bertumbuh',
        'text' => "Dalam perjalanan belajar, sering kali kita ingin melihat hasil yang cepat.\n\n[JEDA]\n\nKita ingin langsung lancar berbicara, langsung percaya diri, dan langsung mampu memukau audiens. Namun, kemampuan yang kuat biasanya dibangun melalui proses yang tidak selalu terlihat.\n\nLatihan kecil yang dilakukan berulang kali akan membentuk kebiasaan. Kebiasaan akan membentuk kepercayaan diri. Dan kepercayaan diri akan membantu kita tampil lebih baik saat kesempatan datang.\n\n[TEKANAN]\n\nJangan menunggu sampai rasa takut hilang sepenuhnya untuk mulai berbicara. Mulailah berbicara, lalu biarkan latihan membantu mengurangi rasa takut itu.\n\n[JEDA]\n\nSetiap rekaman yang kita buat adalah bahan evaluasi. Setiap kesalahan adalah petunjuk. Setiap pengulangan adalah investasi untuk kemampuan diri.\n\nMungkin hari ini suara kita masih terdengar ragu. Mungkin tempo kita belum stabil. Tetapi selama kita mau memperbaiki, kita sedang bergerak maju.\n\n[TEKANAN]\n\nTeruslah bertumbuh, karena pembicara yang baik bukan lahir dari satu penampilan sempurna, melainkan dari keberanian untuk terus berlatih.\n\nTerima kasih."
      ]
    ]
  ]
];
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TALKLAB - Latihan</title>
  <?php include 'includes/layout_css.php'; ?>
  <script>
    window.tailwind = window.tailwind || {};
    window.tailwind.config = { corePlugins: { preflight: false } };
  </script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
  <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
  <script crossorigin src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
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

    .camera-card {
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 8px 24px rgb(0 0 0 / 0.07);
      border: 1px solid #e5e7eb;
      transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
    }

    .camera-card.interactive:hover {
      transform: translateY(-4px);
      box-shadow: 0 16px 34px rgb(16 32 79 / 0.12);
      border-color: #d2a06b;
    }

    .camera-btn {
      border: 0;
      border-radius: 14px;
      padding: 12px 20px;
      font-weight: 800;
      font-size: 15px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: 0.2s;
    }

    .camera-btn:disabled {
      cursor: not-allowed;
      opacity: 0.55;
    }

    .btn-primary-camera { background: #d2a06b; color: #fff; }
    .btn-muted-camera { background: #eef2f7; color: #344054; }
    .btn-danger-camera { background: #b42318; color: #fff; }

    .start-recording-cta {
      box-shadow: 0 14px 30px rgb(210 160 107 / 0.28);
    }

    .start-recording-cta:not(:disabled):hover {
      transform: translateY(-2px);
      box-shadow: 0 18px 38px rgb(210 160 107 / 0.36);
    }

    .start-recording-cta:not(:disabled) {
      animation: ctaBreath 2.8s ease-in-out infinite;
    }

    .recording-glow {
      box-shadow: 0 0 0 2px rgb(239 68 68 / 0.45), 0 20px 60px rgb(210 160 107 / 0.28);
    }

    .recording-dot {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: #ef4444;
      box-shadow: 0 0 0 0 rgb(239 68 68 / 0.7);
      animation: recordPulse 1.2s infinite;
    }

    .camera-status-pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      border-radius: 999px;
      background: #eef2f7;
      color: #344054;
      padding: 8px 12px;
      font-size: 12px;
      font-weight: 900;
    }

    .camera-status-pill.live {
      background: #ecfdf3;
      color: #027a48;
    }

    .audio-wave {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      height: 24px;
    }

    .audio-wave span {
      width: 4px;
      height: 8px;
      border-radius: 999px;
      background: #d2a06b;
      opacity: 0.45;
    }

    .audio-wave.active span {
      animation: waveBounce 0.9s ease-in-out infinite;
      opacity: 1;
    }

    .audio-wave span:nth-child(2) { animation-delay: 0.12s; }
    .audio-wave span:nth-child(3) { animation-delay: 0.24s; }
    .audio-wave span:nth-child(4) { animation-delay: 0.36s; }
    .audio-wave span:nth-child(5) { animation-delay: 0.48s; }

    @keyframes waveBounce {
      0%, 100% { height: 8px; }
      50% { height: 22px; }
    }

    .history-video-card .play-overlay {
      opacity: 0;
      transition: opacity 0.22s ease;
    }

    .history-video-card:hover .play-overlay {
      opacity: 1;
    }

    @keyframes recordPulse {
      0% { box-shadow: 0 0 0 0 rgb(239 68 68 / 0.7); }
      70% { box-shadow: 0 0 0 12px rgb(239 68 68 / 0); }
      100% { box-shadow: 0 0 0 0 rgb(239 68 68 / 0); }
    }

    @keyframes ctaBreath {
      0%, 100% { box-shadow: 0 14px 30px rgb(210 160 107 / 0.25); }
      50% { box-shadow: 0 18px 42px rgb(210 160 107 / 0.4); }
    }

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

    .category-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 12px;
      margin-bottom: 22px;
    }

    .category-btn {
      border: 1px solid #e5e7eb;
      background: #fff;
      color: #344054;
      border-radius: 14px;
      padding: 14px 15px;
      font-weight: 900;
      cursor: pointer;
      text-align: left;
      transition: border-color 0.2s, background 0.2s, color 0.2s;
    }

    .category-btn.active {
      border-color: #d2a06b;
      background: #fffaf3;
      color: #10204f;
    }

    .script-layout {
      display: grid;
      grid-template-columns: minmax(0, 1.1fr) minmax(260px, 0.55fr);
      gap: 18px;
      margin-bottom: 22px;
    }

    .script-card,
    .guide-card {
      border: 1px solid #e5e7eb;
      border-radius: 18px;
      background: #fff;
      padding: 22px;
    }

    .script-card {
      box-shadow: 0 8px 22px rgb(16 32 79 / 0.06);
    }

    .script-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin: 12px 0 18px;
    }

    .script-title {
      color: #10204f;
      font-size: 28px;
      line-height: 1.25;
      margin: 0;
    }

    .script-text {
      color: #344054;
      font-size: 18px;
      line-height: 1.8;
      white-space: pre-line;
    }

    .script-text .script-cue {
      display: inline-flex;
      margin: 4px 0;
      border-radius: 999px;
      padding: 3px 10px;
      background: #fffaf3;
      color: #b8752b;
      font-size: 13px;
      font-weight: 900;
      letter-spacing: 0.3px;
    }

    .guide-card h3 {
      color: #10204f;
      font-size: 18px;
      margin-bottom: 12px;
    }

    .guide-list {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .guide-list li {
      color: #344054;
      font-weight: 700;
      line-height: 1.45;
    }

    .guide-list li::before {
      content: "✓";
      color: #027a48;
      font-weight: 900;
      margin-right: 8px;
    }

    .recording-status-line {
      display: flex;
      align-items: center;
      gap: 10px;
      color: #667085;
      font-size: 13px;
      font-weight: 800;
      margin-bottom: 12px;
    }

    .recording-status-line .recording-dot {
      display: none;
    }

    .recording-status-line.active .recording-dot {
      display: inline-flex;
      flex-shrink: 0;
    }

    .voice-wave {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      height: 28px;
      margin-top: 8px;
    }

    .voice-wave span {
      width: 5px;
      height: 9px;
      border-radius: 999px;
      background: #d2a06b;
      opacity: 0.42;
    }

    .voice-wave.active span {
      animation: waveBounce 0.9s ease-in-out infinite;
      opacity: 1;
    }

    .voice-wave span:nth-child(2) { animation-delay: 0.1s; }
    .voice-wave span:nth-child(3) { animation-delay: 0.2s; }
    .voice-wave span:nth-child(4) { animation-delay: 0.3s; }
    .voice-wave span:nth-child(5) { animation-delay: 0.4s; }

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
      .script-layout,
      .practice-stage,
      .score-card,
      .score-card.four,
      .achievement-grid,
      .control-grid {
        grid-template-columns: 1fr;
      }

      .category-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }

      .page-head,
      .panel-title,
      .timer-wrap {
        align-items: flex-start;
        flex-direction: column;
      }
    }

    @media (max-width: 560px) {
      .category-grid {
        grid-template-columns: 1fr;
      }

      .script-title {
        font-size: 23px;
      }

      .script-text {
        font-size: 16px;
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
        <div class="feature-icon">📹</div>
        <h2>Camera Practice</h2>
        <p>Latih ekspresi, eye contact, dan gestur.</p>
      </button>
    </section>

    <section class="workspace feature-section active" id="voiceSection">
      <div class="panel">
        <div class="panel-title">
          <div>
            <h2>Guided Speaking Practice</h2>
            <p>Pilih kategori, baca naskah latihan, rekam, lalu dengarkan ulang hasilmu.</p>
          </div>
        </div>

        <div class="coach-strip">
          <img src="assets/jjjj.png" alt="Coach TalkLab">
          <div>
            <strong>Siap latihan suara?</strong>
            <span>Ikuti naskah yang tersedia untuk melatih artikulasi, intonasi, jeda, dan penyampaian pesan.</span>
          </div>
        </div>

        <div class="category-grid" aria-label="Kategori latihan speaking">
          <?php foreach ($practiceScripts as $index => $group): ?>
            <button class="category-btn <?= $index === 0 ? 'active' : '' ?>" type="button" data-category="<?= htmlspecialchars($group['category']) ?>">
              <?= htmlspecialchars($group['category']) ?>
            </button>
          <?php endforeach; ?>
        </div>

        <div class="script-layout">
          <article class="script-card">
            <div class="topic-label">Training Script</div>
            <h3 class="script-title" id="scriptTitle"></h3>
            <div class="script-meta">
              <span class="badge" id="scriptCategory"></span>
              <span class="badge" id="scriptDuration"></span>
              <span class="badge" id="scriptLevel"></span>
            </div>
            <div class="script-text" id="scriptText"></div>
          </article>

          <aside class="guide-card">
            <h3>Speaking Guide</h3>
            <ul class="guide-list">
              <li>Baca dengan suara jelas</li>
              <li>Berikan jeda pada tanda [JEDA]</li>
              <li>Tekankan kata pada tanda [TEKANAN]</li>
              <li>Jangan berbicara terlalu cepat</li>
              <li>Jaga ritme bicara tetap stabil</li>
            </ul>
          </aside>
        </div>

        <div class="control-grid">
          <div class="control-box">
            <h3>Topic & Script Generator</h3>
            <div class="action-row">
              <button class="btn btn-primary" type="button" id="randomTopicBtn">Topik Acak</button>
              <button class="btn btn-muted" type="button" id="nextTopicBtn">Naskah Berikutnya</button>
            </div>
          </div>

          <div class="control-box">
            <h3>Tingkat Latihan</h3>
            <div class="duration-options">
              <button class="duration-btn active" type="button" data-level="Beginner" data-duration="30">Beginner</button>
              <button class="duration-btn" type="button" data-level="Intermediate" data-duration="60">Intermediate</button>
              <button class="duration-btn" type="button" data-level="Advanced" data-duration="180">Advanced</button>
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
                  <div class="timer-caption">Durasi target: <span id="selectedDuration">30 detik</span></div>
                </div>
                <div class="status-pill" id="recordStatus">READY</div>
              </div>

              <div class="recording-status-line" id="recordingLine">
                <span class="recording-dot"></span>
                <span id="recordingLineText">Siap mulai latihan terstruktur.</span>
              </div>

              <div class="meter" aria-hidden="true">
                <div class="meter-fill" id="meterFill"></div>
              </div>

              <div class="voice-wave" id="voiceWave" aria-hidden="true">
                <span></span><span></span><span></span><span></span><span></span>
              </div>
            </div>
          </div>

          <div class="action-row">
            <button class="btn btn-primary" type="button" id="startBtn">Mulai Latihan</button>
            <button class="btn btn-danger" type="button" id="stopBtn" disabled>Stop Recording</button>
            <button class="btn btn-muted" type="button" id="replayBtn" disabled>Putar Ulang Hasil</button>
            <button class="btn btn-dark" type="button" id="saveBtn" disabled>Simpan Riwayat</button>
          </div>

          <div class="result-box" id="resultBox">
            <h3>Playback Result</h3>
            <div class="result-meta">
              <span class="badge" id="resultTopic">Judul: -</span>
              <span class="badge" id="resultCategory">Kategori: -</span>
              <span class="badge" id="resultLevel">Level: -</span>
              <span class="badge" id="resultDuration">Durasi: -</span>
            </div>
            <audio id="playback" controls></audio>
          </div>

          <div class="toast info" id="messageBox">Tekan Mulai Latihan untuk memberi izin microphone dan memulai timer.</div>
        </div>
      </div>

      <aside class="panel history-panel">
        <h2>Practice History</h2>
        <p>Riwayat menampilkan judul latihan, kategori, tanggal, durasi, dan audio playback yang tersimpan di akun pengguna.</p>

        <div class="history-list" id="historyList">
          <?php if (!$currentUser): ?>
            <div class="empty-state">Silakan login terlebih dahulu agar hasil latihan bisa disimpan ke akun.</div>
          <?php elseif (empty($practiceHistory)): ?>
            <div class="empty-state">Belum ada riwayat latihan. Selesaikan satu rekaman lalu simpan riwayat.</div>
          <?php else: ?>
            <?php foreach ($practiceHistory as $item): ?>
              <div class="history-card">
                <strong><?= htmlspecialchars($item['script_title'] ?? $item['topic']) ?></strong>
                <small>Kategori: <?= htmlspecialchars($item['category'] ?? 'Latihan Suara') ?></small>
                <small><?= htmlspecialchars(date('d M Y H:i', strtotime($item['created_at']))) ?> - <?= (int) $item['duration_seconds'] ?> detik<?= !empty($item['level_name']) ? ' - ' . htmlspecialchars($item['level_name']) : '' ?></small>
                <audio controls src="<?= htmlspecialchars($item['audio_path']) ?>"></audio>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </aside>
    </section>

    <section class="workspace feature-section" id="challengeSection">
      <div id="conversation-challenge-root"></div>

      <aside class="panel history-panel">
        <h2>Riwayat Tantangan</h2>
        <p>Riwayat menampilkan nama simulasi, tingkat kesulitan, jumlah pertanyaan, tanggal latihan, durasi total, dan status penyelesaian.</p>

        <div class="history-list" id="challengeHistoryList">
          <?php if (!$currentUser): ?>
            <div class="empty-state">Silakan login terlebih dahulu agar hasil tantangan bisa disimpan ke akun.</div>
          <?php elseif (empty($challengeHistory)): ?>
            <div class="empty-state">Belum ada riwayat tantangan. Selesaikan satu simulasi lalu simpan hasilnya.</div>
          <?php else: ?>
            <?php foreach ($challengeHistory as $item): ?>
              <div class="history-card">
                <strong><?= htmlspecialchars($item['challenge_type']) ?></strong>
                <small><?= htmlspecialchars($item['level_name']) ?></small>
                <small><?= (int) ($item['question_count'] ?? 1) ?> Pertanyaan</small>
                <small><?= htmlspecialchars(date('d M Y H:i', strtotime($item['created_at']))) ?> - <?= (int) $item['actual_seconds'] ?> detik</small>
                <div class="result-meta">
                  <span class="badge"><?= (int) $item['completed'] === 1 ? 'Selesai' : 'Belum selesai' ?></span>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </aside>
    </section>

    <section class="feature-section" id="aiSection">
      <div id="camera-practice-root"></div>
    </section>
  </main>

  <script>
    const practiceScripts = <?= json_encode($practiceScripts, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
    const isLoggedIn = <?= $currentUser ? 'true' : 'false' ?>;
    const categoryBtns = document.querySelectorAll(".category-btn");
    const scriptTitle = document.getElementById("scriptTitle");
    const scriptCategory = document.getElementById("scriptCategory");
    const scriptDuration = document.getElementById("scriptDuration");
    const scriptLevel = document.getElementById("scriptLevel");
    const scriptText = document.getElementById("scriptText");
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
    const replayBtn = document.getElementById("replayBtn");
    const saveBtn = document.getElementById("saveBtn");
    const playback = document.getElementById("playback");
    const resultBox = document.getElementById("resultBox");
    const resultTopic = document.getElementById("resultTopic");
    const resultCategory = document.getElementById("resultCategory");
    const resultLevel = document.getElementById("resultLevel");
    const resultDuration = document.getElementById("resultDuration");
    const recordingLine = document.getElementById("recordingLine");
    const recordingLineText = document.getElementById("recordingLineText");
    const voiceWave = document.getElementById("voiceWave");
    const messageBox = document.getElementById("messageBox");
    const historyList = document.getElementById("historyList");
    const featureCards = document.querySelectorAll(".feature-card");
    const voiceSection = document.getElementById("voiceSection");
    const challengeSection = document.getElementById("challengeSection");
    const aiSection = document.getElementById("aiSection");
    const challengeHistoryList = document.getElementById("challengeHistoryList");

    let activeCategory = practiceScripts[0].category;
    let scriptIndex = 0;
    let activePracticeLevel = "Beginner";
    let activeScript = practiceScripts[0].scripts[0];
    let selectedSeconds = 30;
    let remainingSeconds = 30;
    let elapsedSeconds = 0;
    let timerInterval = null;
    let mediaRecorder = null;
    let audioChunks = [];
    let recordedBlob = null;

    function formatTime(seconds) {
      const mins = String(Math.floor(seconds / 60)).padStart(2, "0");
      const secs = String(seconds % 60).padStart(2, "0");
      return `${mins}:${secs}`;
    }

    function setMessage(type, text) {
      messageBox.className = `toast ${type}`;
      messageBox.textContent = text;
    }

    function switchFeature(feature) {
      featureCards.forEach(card => {
        card.classList.toggle("active", card.dataset.feature === feature);
      });

      voiceSection.classList.toggle("active", feature === "voice");
      challengeSection.classList.toggle("active", feature === "challenge");
      aiSection.classList.toggle("active", feature === "ai");
    }

    function durationLabel(seconds) {
      return seconds === 60 ? "1 Menit" : seconds === 180 ? "3 Menit" : "30 Detik";
    }

    function getCategoryGroup(category) {
      return practiceScripts.find(group => group.category === category) || practiceScripts[0];
    }

    function getLevelScripts(category = activeCategory, level = activePracticeLevel) {
      const group = getCategoryGroup(category);
      const scripts = group.scripts.filter(item => item.level === level);
      return scripts.length ? scripts : group.scripts;
    }

    function renderScriptText(text) {
      const escaped = text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;");

      scriptText.innerHTML = escaped.replace(/\[(JEDA|TEKANAN)\]/g, '<span class="script-cue">[$1]</span>');
    }

    function setActiveScript(index = 0) {
      const scripts = getLevelScripts();
      scriptIndex = ((index % scripts.length) + scripts.length) % scripts.length;
      activeScript = scripts[scriptIndex];
      selectedSeconds = Number(activeScript.duration);

      scriptTitle.textContent = activeScript.title;
      scriptCategory.textContent = `Kategori: ${activeCategory}`;
      scriptDuration.textContent = `Durasi: ${durationLabel(selectedSeconds)}`;
      scriptLevel.textContent = `Level: ${activePracticeLevel}`;
      renderScriptText(activeScript.text);

      resultTopic.textContent = `Judul: ${activeScript.title}`;
      resultCategory.textContent = `Kategori: ${activeCategory}`;
      resultLevel.textContent = `Level: ${activePracticeLevel}`;
      updateDurationLabel();
      resetTimer();
    }

    function setCategory(category) {
      activeCategory = category;
      categoryBtns.forEach(btn => btn.classList.toggle("active", btn.dataset.category === category));
      setActiveScript(0);
    }

    function resetTimer() {
      remainingSeconds = selectedSeconds;
      elapsedSeconds = 0;
      timer.textContent = formatTime(remainingSeconds);
      meterFill.style.width = "0%";
    }

    function updateDurationLabel() {
      selectedDuration.textContent = durationLabel(selectedSeconds);
    }

    function resetRecordingResult() {
      recordedBlob = null;
      playback.removeAttribute("src");
      resultBox.style.display = "none";
      saveBtn.disabled = true;
      replayBtn.disabled = true;
    }

    randomTopicBtn.addEventListener("click", () => {
      let nextCategoryIndex = Math.floor(Math.random() * practiceScripts.length);
      if (practiceScripts.length > 1 && practiceScripts[nextCategoryIndex].category === activeCategory) {
        nextCategoryIndex = (nextCategoryIndex + 1) % practiceScripts.length;
      }
      activeCategory = practiceScripts[nextCategoryIndex].category;
      const scripts = getLevelScripts(activeCategory, activePracticeLevel);
      const nextScriptIndex = Math.floor(Math.random() * scripts.length);
      setCategory(activeCategory);
      setActiveScript(nextScriptIndex);
      resetRecordingResult();
    });

    nextTopicBtn.addEventListener("click", () => {
      setActiveScript(scriptIndex + 1);
      resetRecordingResult();
    });

    categoryBtns.forEach(btn => {
      btn.addEventListener("click", () => {
        setCategory(btn.dataset.category);
        resetRecordingResult();
      });
    });

    durationBtns.forEach(btn => {
      btn.addEventListener("click", () => {
        durationBtns.forEach(item => item.classList.remove("active"));
        btn.classList.add("active");
        activePracticeLevel = btn.dataset.level;
        setActiveScript(0);
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
          resultTopic.textContent = `Judul: ${activeScript.title}`;
          resultCategory.textContent = `Kategori: ${activeCategory}`;
          resultLevel.textContent = `Level: ${activePracticeLevel}`;
          resultDuration.textContent = `Durasi: ${elapsedSeconds} detik`;
          resultBox.style.display = "block";
          replayBtn.disabled = false;
          saveBtn.disabled = false;
          recordStatus.textContent = "FINISHED";
          recordingLine.classList.remove("active");
          voiceWave.classList.remove("active");
          recordingLineText.textContent = "Latihan selesai. Putar ulang hasil atau simpan riwayat.";
          setMessage("success", "Rekaman selesai. Dengarkan kembali hasil latihanmu atau simpan ke riwayat.");
        };

        resetTimer();
        resetRecordingResult();
        mediaRecorder.start();
        startBtn.disabled = true;
        stopBtn.disabled = false;
        randomTopicBtn.disabled = true;
        nextTopicBtn.disabled = true;
        categoryBtns.forEach(btn => btn.disabled = true);
        durationBtns.forEach(btn => btn.disabled = true);
        recordStatus.textContent = "RECORDING";
        recordStatus.classList.add("status-recording");
        micOrb.classList.add("recording");
        recordingLine.classList.add("active");
        voiceWave.classList.add("active");
        recordingLineText.textContent = "Recording aktif. Baca naskah dengan ritme stabil.";
        setMessage("info", "Latihan sedang berlangsung. Baca naskah dan ikuti tanda jeda serta tekanan.");

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
      categoryBtns.forEach(btn => btn.disabled = false);
      durationBtns.forEach(btn => btn.disabled = false);
      recordStatus.textContent = "FINISHED";
      recordStatus.classList.remove("status-recording");
      micOrb.classList.remove("recording");
      recordingLine.classList.remove("active");
      voiceWave.classList.remove("active");

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
      formData.append("topic", activeScript.title);
      formData.append("script_title", activeScript.title);
      formData.append("category", activeCategory);
      formData.append("level_name", activePracticeLevel);
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
      title.textContent = item.script_title || item.topic;

      const category = document.createElement("small");
      category.textContent = `Kategori: ${item.category || "Latihan Suara"}`;

      const meta = document.createElement("small");
      const level = item.level_name ? ` - ${item.level_name}` : "";
      meta.textContent = `${new Date(item.created_at.replace(" ", "T")).toLocaleString("id-ID")} - ${item.duration_seconds} detik${level}`;

      const audio = document.createElement("audio");
      audio.controls = true;
      audio.src = item.audio_path;

      card.append(title, category, meta, audio);
      historyList.prepend(card);
    }

    function prependChallengeHistory(item) {
      const empty = challengeHistoryList.querySelector(".empty-state");
      if (empty) empty.remove();

      const card = document.createElement("div");
      card.className = "history-card";

      const title = document.createElement("strong");
      title.textContent = item.challenge_type;

      const meta = document.createElement("small");
      meta.textContent = item.level_name;

      const count = document.createElement("small");
      count.textContent = `${item.question_count || 1} Pertanyaan`;

      const date = document.createElement("small");
      date.textContent = `${new Date(item.created_at.replace(" ", "T")).toLocaleString("id-ID")} - ${item.actual_seconds} detik`;

      const stats = document.createElement("div");
      stats.className = "result-meta";

      const completed = document.createElement("span");
      completed.className = "badge";
      completed.textContent = Number(item.completed) === 1 ? "Selesai" : "Belum selesai";

      stats.append(completed);
      card.append(title, meta, count, date, stats);
      challengeHistoryList.prepend(card);
    }

    window.prependChallengeHistory = prependChallengeHistory;

    featureCards.forEach(card => {
      card.addEventListener("click", () => {
        switchFeature(card.dataset.feature);
      });
    });

    startBtn.addEventListener("click", startRecording);
    stopBtn.addEventListener("click", stopRecording);
    replayBtn.addEventListener("click", () => {
      if (playback.src) {
        playback.currentTime = 0;
        playback.play();
      }
    });
    saveBtn.addEventListener("click", savePractice);

    setActiveScript(0);
    switchFeature("voice");
  </script>
  <script type="text/babel">
    (function () {
      const simulasiPercakapan = [
        {
          nama: "Simulasi Wawancara",
          deskripsi: "Latihan menjawab pertanyaan wawancara kerja dengan jelas, percaya diri, dan terstruktur.",
          pertanyaan: [
            "Ceritakan tentang diri Anda.",
            "Apa kelebihan terbesar Anda?",
            "Apa kelemahan terbesar Anda?",
            "Mengapa kami harus memilih Anda?",
            "Di mana Anda melihat diri Anda dalam lima tahun ke depan?",
            "Ceritakan pengalaman saat Anda menyelesaikan masalah.",
            "Bagaimana cara Anda bekerja dalam tekanan?",
            "Apa kontribusi yang bisa Anda berikan?"
          ]
        },
        {
          nama: "Tanya Jawab Seminar",
          deskripsi: "Latihan menjawab pertanyaan audiens setelah menyampaikan materi seminar.",
          pertanyaan: [
            "Apa inti dari presentasi Anda?",
            "Mengapa topik ini penting?",
            "Apa solusi yang Anda tawarkan?",
            "Apa bukti bahwa solusi tersebut dapat diterapkan?",
            "Bagaimana cara mengukur keberhasilannya?",
            "Apa tantangan terbesar dari gagasan Anda?",
            "Bagaimana jika audiens tidak setuju dengan pendapat Anda?",
            "Apa langkah pertama yang perlu dilakukan?"
          ]
        },
        {
          nama: "Simulasi Presentasi",
          deskripsi: "Latihan mempertahankan ide presentasi melalui pertanyaan lanjutan.",
          pertanyaan: [
            "Jelaskan ide utama presentasi Anda.",
            "Apa manfaat dari solusi yang Anda tawarkan?",
            "Bagaimana cara penerapannya?",
            "Siapa yang paling membutuhkan solusi ini?",
            "Apa risiko yang perlu diperhatikan?",
            "Mengapa pendekatan Anda lebih efektif?",
            "Apa data atau alasan yang mendukung ide Anda?",
            "Bagaimana Anda menutup presentasi dengan kuat?"
          ]
        },
        {
          nama: "Pembawa Acara",
          deskripsi: "Latihan merespons situasi acara sebagai MC secara ramah dan profesional.",
          pertanyaan: [
            "Buka acara seminar ini.",
            "Perkenalkan narasumber.",
            "Tutup acara secara profesional.",
            "Arahkan peserta menuju sesi tanya jawab.",
            "Isi jeda ketika narasumber belum siap.",
            "Sampaikan perubahan susunan acara dengan tenang.",
            "Ajak peserta memberi apresiasi kepada narasumber.",
            "Berikan pengumuman singkat sebelum acara selesai."
          ]
        },
        {
          nama: "Perkenalan Profesional",
          deskripsi: "Latihan memperkenalkan diri dalam kegiatan formal, komunitas, atau dunia kerja.",
          pertanyaan: [
            "Perkenalkan diri Anda.",
            "Ceritakan latar belakang Anda.",
            "Apa tujuan Anda mengikuti kegiatan ini?",
            "Apa pengalaman yang paling relevan dengan bidang Anda?",
            "Apa kemampuan utama yang ingin Anda tunjukkan?",
            "Bagaimana Anda ingin dikenal oleh orang lain?",
            "Apa nilai yang Anda bawa dalam kerja sama?",
            "Apa target pengembangan diri Anda saat ini?"
          ]
        },
        {
          nama: "Diskusi Kelompok",
          deskripsi: "Latihan memberi respons dalam diskusi, menyanggah dengan sopan, dan merangkum pendapat.",
          pertanyaan: [
            "Apa pendapat Anda tentang ide kelompok ini?",
            "Bagaimana Anda menanggapi pendapat yang berbeda?",
            "Apa usulan Anda agar diskusi lebih terarah?",
            "Bagaimana cara Anda menyampaikan ketidaksetujuan dengan sopan?",
            "Apa keputusan terbaik menurut Anda?",
            "Bagaimana Anda merangkum hasil diskusi?",
            "Apa peran yang bisa Anda ambil dalam kelompok?",
            "Bagaimana cara menjaga semua anggota tetap terlibat?"
          ]
        }
      ];

      const tingkatKesulitan = [
        { nama: "Pemula", jumlah: 3, persiapan: 20, jawab: 45, deskripsi: "3 pertanyaan, persiapan 20 detik, menjawab 45 detik." },
        { nama: "Menengah", jumlah: 5, persiapan: 15, jawab: 60, deskripsi: "5 pertanyaan, persiapan 15 detik, menjawab 60 detik." },
        { nama: "Lanjutan", jumlah: 8, persiapan: 10, jawab: 90, deskripsi: "8 pertanyaan, persiapan 10 detik, menjawab 90 detik." }
      ];

      function formatDurasi(seconds) {
        const mins = String(Math.floor(seconds / 60)).padStart(2, "0");
        const secs = String(seconds % 60).padStart(2, "0");
        return `${mins}:${secs}`;
      }

      function susunPertanyaan(simulasi, level, modeCepat) {
        const semua = modeCepat
          ? simulasiPercakapan.flatMap((item) => item.pertanyaan.map((teks) => ({ teks, asal: item.nama })))
          : simulasi.pertanyaan.map((teks) => ({ teks, asal: simulasi.nama }));
        const pool = modeCepat ? [...semua].sort(() => Math.random() - 0.5) : semua;
        const jumlah = modeCepat ? 5 : level.jumlah;
        return Array.from({ length: jumlah }, (_, index) => pool[index % pool.length]);
      }

      function TantanganPercakapan() {
        const [simulasi, setSimulasi] = React.useState(simulasiPercakapan[0]);
        const [level, setLevel] = React.useState(tingkatKesulitan[0]);
        const [modeCepat, setModeCepat] = React.useState(false);
        const [fase, setFase] = React.useState("ringkasan");
        const [pertanyaan, setPertanyaan] = React.useState([]);
        const [nomor, setNomor] = React.useState(0);
        const [sisaWaktu, setSisaWaktu] = React.useState(tingkatKesulitan[0].persiapan);
        const [durasiJawaban, setDurasiJawaban] = React.useState([]);
        const [pesan, setPesan] = React.useState("Pilih jenis simulasi dan tingkat kesulitan, lalu mulai tantangan.");
        const [tersimpan, setTersimpan] = React.useState(false);
        const recorderRef = React.useRef(null);
        const streamRef = React.useRef(null);
        const chunksRef = React.useRef([]);

        const aturan = modeCepat
          ? { nama: "Mode Respon Cepat", jumlah: 5, persiapan: 5, jawab: 30, deskripsi: "Pertanyaan acak, persiapan 5 detik, menjawab 30 detik." }
          : level;
        const aktif = pertanyaan[nomor] || { teks: simulasi.pertanyaan[0], asal: simulasi.nama };
        const selesai = fase === "selesai";
        const jumlahTerjawab = durasiJawaban.length;
        const progres = pertanyaan.length ? Math.min((jumlahTerjawab / pertanyaan.length) * 100, 100) : 0;
        const waktuTotal = durasiJawaban.reduce((total, item) => total + item, 0);

        React.useEffect(() => {
          if (fase !== "persiapan" && fase !== "menjawab") return;
          if (sisaWaktu <= 0) {
            if (fase === "persiapan") mulaiMenjawab();
            if (fase === "menjawab") selesaiMenjawab(true);
            return;
          }
          const timerId = setTimeout(() => setSisaWaktu((current) => Math.max(current - 1, 0)), 1000);
          return () => clearTimeout(timerId);
        }, [fase, sisaWaktu]);

        React.useEffect(() => {
          return () => hentikanStream();
        }, []);

        function pilihSimulasi(item) {
          if (fase !== "ringkasan") return;
          setModeCepat(false);
          setSimulasi(item);
          setPesan("Jenis simulasi diperbarui. Baca ringkasan sebelum memulai.");
        }

        function pilihModeCepat() {
          if (fase !== "ringkasan") return;
          setModeCepat(true);
          setPesan("Mode Respon Cepat aktif. Pertanyaan akan muncul secara acak.");
        }

        function pilihLevel(item) {
          if (fase !== "ringkasan") return;
          setLevel(item);
          setPesan("Tingkat kesulitan diperbarui. Waktu dan jumlah pertanyaan akan mengikuti pilihan ini.");
        }

        function mulaiTantangan() {
          const daftar = susunPertanyaan(simulasi, level, modeCepat);
          setPertanyaan(daftar);
          setNomor(0);
          setDurasiJawaban([]);
          setTersimpan(false);
          setFase("persiapan");
          setSisaWaktu(modeCepat ? 5 : level.persiapan);
          setPesan("Fase persiapan dimulai. Susun jawaban singkat dan jelas.");
        }

        async function mulaiMenjawab() {
          try {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
              const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
              streamRef.current = stream;
              chunksRef.current = [];
              const preferredMime = MediaRecorder.isTypeSupported("audio/webm") ? "audio/webm" : "";
              const recorder = preferredMime ? new MediaRecorder(stream, { mimeType: preferredMime }) : new MediaRecorder(stream);
              recorder.ondataavailable = (event) => {
                if (event.data.size > 0) chunksRef.current.push(event.data);
              };
              recorder.onstop = () => {
                chunksRef.current = [];
                hentikanStream();
              };
              recorderRef.current = recorder;
              recorder.start();
            }
            setFase("menjawab");
            setSisaWaktu(modeCepat ? 30 : level.jawab);
            setPesan("Mulai menjawab. Rekaman aktif, jaga jawaban tetap fokus.");
          } catch (error) {
            setFase("menjawab");
            setSisaWaktu(modeCepat ? 30 : level.jawab);
            setPesan("Mikrofon tidak dapat diakses. Timer tetap berjalan untuk latihan simulasi.");
          }
        }

        function hentikanStream() {
          if (streamRef.current) {
            streamRef.current.getTracks().forEach((track) => track.stop());
            streamRef.current = null;
          }
          recorderRef.current = null;
        }

        function selesaiMenjawab(otomatis = false) {
          if (recorderRef.current && recorderRef.current.state !== "inactive") {
            recorderRef.current.stop();
          } else {
            hentikanStream();
          }
          const target = modeCepat ? 30 : level.jawab;
          const durasi = otomatis ? target : Math.max(target - sisaWaktu, 1);
          setDurasiJawaban((current) => [...current, durasi]);
          setFase("jawaban");
          setPesan("Jawaban berhasil disimpan. Lanjut ke pertanyaan berikutnya?");
        }

        function lanjutPertanyaan() {
          if (nomor + 1 >= pertanyaan.length) {
            setFase("selesai");
            setPesan("Seluruh pertanyaan selesai. Simpan hasil latihan ke riwayat tantangan.");
            return;
          }
          setNomor((current) => current + 1);
          setFase("persiapan");
          setSisaWaktu(modeCepat ? 5 : level.persiapan);
          setPesan("Pertanyaan berikutnya siap. Gunakan waktu persiapan dengan efektif.");
        }

        async function simpanRiwayat() {
          if (!isLoggedIn) {
            setPesan("Silakan login terlebih dahulu agar riwayat tantangan tersimpan ke akun.");
            return;
          }

          const formData = new FormData();
          formData.append("action", "save_challenge");
          formData.append("challenge_type", modeCepat ? "Mode Respon Cepat" : simulasi.nama);
          formData.append("level_name", aturan.nama);
          formData.append("question_count", pertanyaan.length);
          formData.append("prompt", pertanyaan.map((item, index) => `${index + 1}. ${item.teks}`).join("\n"));
          formData.append("prep_seconds", aturan.persiapan);
          formData.append("speak_seconds", aturan.jawab);
          formData.append("actual_seconds", waktuTotal);
          formData.append("score", Math.round(progres));
          formData.append("completed", selesai ? 1 : 0);

          setPesan("Menyimpan riwayat tantangan...");
          try {
            const response = await fetch("Latihan.php", { method: "POST", body: formData });
            const data = await response.json();
            if (!data.status) {
              setPesan(data.message || "Gagal menyimpan riwayat tantangan.");
              return;
            }
            setTersimpan(true);
            window.prependChallengeHistory?.(data.item);
            setPesan(data.message || "Riwayat tantangan berhasil disimpan.");
          } catch (error) {
            setPesan("Terjadi kesalahan saat menyimpan riwayat tantangan.");
          }
        }

        function resetSimulasi() {
          hentikanStream();
          setFase("ringkasan");
          setPertanyaan([]);
          setNomor(0);
          setDurasiJawaban([]);
          setTersimpan(false);
          setSisaWaktu(aturan.persiapan);
          setPesan("Pilih jenis simulasi dan tingkat kesulitan, lalu mulai tantangan.");
        }

        return (
          <div className="panel">
            <div className="panel-title">
              <div>
                <h2>Tantangan Bicara</h2>
                <p>Latihan simulasi percakapan dan tanya jawab interaktif untuk melatih respons spontan tanpa naskah.</p>
              </div>
              <span className={`status-pill ${fase === "menjawab" ? "status-recording" : ""}`}>
                {fase === "menjawab" ? "SEDANG MEREKAM" : selesai ? "SELESAI" : "SIAP SIMULASI"}
              </span>
            </div>

            <div className="challenge-layout">
              <div className="control-box">
                <h3>Jenis Simulasi</h3>
                <div className="option-grid">
                  {simulasiPercakapan.map((item) => (
                    <button
                      key={item.nama}
                      type="button"
                      className={`option-card ${!modeCepat && simulasi.nama === item.nama ? "active" : ""}`}
                      onClick={() => pilihSimulasi(item)}
                    >
                      <strong>{item.nama}</strong>
                      <span>{item.deskripsi}</span>
                    </button>
                  ))}
                  <button type="button" className={`option-card ${modeCepat ? "active" : ""}`} onClick={pilihModeCepat}>
                    <strong>Mode Respon Cepat</strong>
                    <span>Pertanyaan acak, persiapan 5 detik, dan menjawab maksimal 30 detik.</span>
                  </button>
                </div>
              </div>

              <div className="control-box">
                <h3>Tingkat Kesulitan</h3>
                <div className="option-grid">
                  {tingkatKesulitan.map((item) => (
                    <button
                      key={item.nama}
                      type="button"
                      className={`option-card ${!modeCepat && level.nama === item.nama ? "active" : ""}`}
                      onClick={() => pilihLevel(item)}
                    >
                      <strong>{item.nama}</strong>
                      <span>{item.deskripsi}</span>
                    </button>
                  ))}
                </div>

                <div className="mt-4 rounded-2xl border border-[#f2d7b8] bg-[#fffaf3] p-4">
                  <div className="topic-label">Ringkasan Simulasi</div>
                  <h3 className="mb-2 text-xl font-extrabold text-[#10204f]">{modeCepat ? "Mode Respon Cepat" : simulasi.nama}</h3>
                  <p className="text-sm font-semibold leading-6 text-[#667085]">
                    {modeCepat ? "Pertanyaan muncul secara acak untuk melatih improvisasi cepat." : simulasi.deskripsi}
                  </p>
                  <div className="mt-4 grid gap-3 sm:grid-cols-3">
                    <div className="score-item"><span>Jumlah Pertanyaan</span><strong>{aturan.jumlah}</strong></div>
                    <div className="score-item"><span>Waktu Persiapan</span><strong>{aturan.persiapan}s</strong></div>
                    <div className="score-item"><span>Waktu Menjawab</span><strong>{aturan.jawab}s</strong></div>
                  </div>
                </div>
              </div>
            </div>

            <div className="topic-box">
              <div className="topic-label">{modeCepat ? "Mode Respon Cepat" : aktif.asal}</div>
              <div className="topic-text">
                {fase === "ringkasan"
                  ? "Tekan Mulai Tantangan untuk memulai simulasi pertanyaan."
                  : `Pertanyaan ${Math.min(nomor + 1, pertanyaan.length)} dari ${pertanyaan.length}`}
              </div>
              {fase !== "ringkasan" && (
                <p className="relative z-[1] mt-4 text-xl font-bold leading-relaxed text-white">"{aktif.teks}"</p>
              )}
            </div>

            <div className="recorder-box">
              <div className="timer-wrap">
                <div className="countdown-card">
                  <div className="topic-label">{fase === "persiapan" ? "PERSIAPAN" : fase === "menjawab" ? "MULAI MENJAWAB" : selesai ? "TANTANGAN SELESAI" : "SIMULASI"}</div>
                  <div className="timer challenge-timer">{formatDurasi(fase === "ringkasan" || fase === "jawaban" || selesai ? 0 : sisaWaktu)}</div>
                  <div className="timer-caption">
                    {fase === "persiapan"
                      ? "Gunakan waktu ini untuk menyusun jawaban Anda."
                      : fase === "menjawab"
                        ? "Jawab dengan jelas, ringkas, dan percaya diri."
                        : selesai
                          ? "Semua pertanyaan sudah dijawab."
                          : "Ringkasan simulasi siap dibaca."}
                  </div>
                </div>
                <div className={`status-pill ${fase === "menjawab" ? "status-recording" : ""}`}>
                  {fase === "menjawab" && <span className="recording-dot" style={{ display: "inline-flex", marginRight: 8 }}></span>}
                  {fase === "menjawab" ? "SEDANG MEREKAM" : fase === "persiapan" ? "PERSIAPAN" : selesai ? "SELESAI" : "SIAP"}
                </div>
              </div>

              <div className="mb-3 flex items-center justify-between gap-3">
                <span className="text-sm font-extrabold text-[#667085]">Progres Simulasi</span>
                <span className="text-sm font-black text-[#d2a06b]">{Math.round(progres)}% Selesai</span>
              </div>
              <div className="meter" aria-hidden="true">
                <div className="meter-fill" style={{ width: `${progres}%` }}></div>
              </div>

              <div className="action-row">
                {fase === "ringkasan" && <button className="btn btn-primary" type="button" onClick={mulaiTantangan}>Mulai Tantangan</button>}
                {fase === "menjawab" && <button className="btn btn-danger" type="button" onClick={() => selesaiMenjawab(false)}>Selesai Menjawab</button>}
                {fase === "jawaban" && <button className="btn btn-primary" type="button" onClick={lanjutPertanyaan}>Lanjut</button>}
                {selesai && <button className="btn btn-dark" type="button" onClick={simpanRiwayat} disabled={tersimpan}>Simpan Riwayat</button>}
                {(fase !== "ringkasan") && <button className="btn btn-muted" type="button" onClick={resetSimulasi}>Ulangi Simulasi</button>}
              </div>

              <div className={`toast ${pesan.includes("berhasil") || pesan.includes("selesai") ? "success" : pesan.includes("Gagal") || pesan.includes("kesalahan") ? "error" : "info"}`}>
                {pesan}
              </div>
            </div>
          </div>
        );
      }

      ReactDOM.createRoot(document.getElementById("conversation-challenge-root")).render(<TantanganPercakapan />);
    })();
  </script>
  <script type="text/babel">
    const { useEffect, useMemo, useRef, useState } = React;

    const cameraTopics = [
      "Ceritakan pengalaman paling berkesan saat berbicara di depan orang.",
      "Jelaskan mengapa eye contact penting dalam public speaking.",
      "Presentasikan ide kegiatan kelas dalam satu menit.",
      "Ceritakan cara kamu membangun rasa percaya diri.",
      "Berikan opini singkat tentang pentingnya bahasa tubuh.",
      "Simulasikan pembukaan sebagai MC acara sekolah."
    ];

    const cameraDurations = [
      { label: "1 minute", seconds: 60 },
      { label: "3 minutes", seconds: 180 },
      { label: "5 minutes", seconds: 300 }
    ];

    const cameraDummyHistory = [
      {
        id: "dummy-1",
        topic: "Jelaskan mengapa eye contact penting dalam public speaking.",
        date: "23 Mei 2026, 09.10",
        duration: 60,
        videoUrl: "",
        confidence: "Confident"
      },
      {
        id: "dummy-2",
        topic: "Simulasikan pembukaan sebagai MC acara sekolah.",
        date: "22 Mei 2026, 20.35",
        duration: 180,
        videoUrl: "",
        confidence: "Steady"
      }
    ];

    const simulationModes = [
      {
        name: "Presentation",
        objective: "Sampaikan ide utama dengan pembuka, tiga poin, dan penutup yang jelas.",
        tip: "Gunakan gesture tangan saat berpindah poin."
      },
      {
        name: "Interview",
        objective: "Jawab dengan struktur singkat: situasi, tindakan, dan hasil.",
        tip: "Tatap kamera seperti sedang melihat pewawancara."
      },
      {
        name: "MC Opening",
        objective: "Buka acara dengan salam, perkenalan, dan energi yang ramah.",
        tip: "Mulai dengan senyum dan intonasi naik di kalimat pembuka."
      }
    ];

    const focusItems = ["Eye contact", "Facial expression", "Body language", "Confidence"];

    function formatCameraTime(seconds) {
      const mins = String(Math.floor(seconds / 60)).padStart(2, "0");
      const secs = String(seconds % 60).padStart(2, "0");
      return `${mins}:${secs}`;
    }

    function CameraPracticeDashboard() {
      const liveVideoRef = useRef(null);
      const replayVideoRef = useRef(null);
      const mediaRecorderRef = useRef(null);
      const streamRef = useRef(null);
      const chunksRef = useRef([]);
      const timerRef = useRef(null);
      const elapsedRef = useRef(0);

      const [selectedDuration, setSelectedDuration] = useState(60);
      const [topic, setTopic] = useState(cameraTopics[0]);
      const [isRecording, setIsRecording] = useState(false);
      const [elapsed, setElapsed] = useState(0);
      const [recordedUrl, setRecordedUrl] = useState("");
      const [statusMessage, setStatusMessage] = useState("Camera dan microphone akan aktif saat latihan dimulai.");
      const [history, setHistory] = useState(cameraDummyHistory);
      const [activeMode, setActiveMode] = useState(simulationModes[0]);
      const [focusProgress, setFocusProgress] = useState({
        "Eye contact": false,
        "Facial expression": false,
        "Body language": false,
        "Confidence": false
      });
      const [cameraReady, setCameraReady] = useState(false);
      const [micReady, setMicReady] = useState(false);

      const remainingTime = Math.max(selectedDuration - elapsed, 0);
      const progress = Math.min((elapsed / selectedDuration) * 100, 100);
      const recordingStatus = isRecording ? "RECORDING" : recordedUrl ? "FINISHED" : "READY";
      const speakingTip = isRecording
        ? activeMode.tip
        : "Siapkan posisi kamera sejajar mata dan pastikan bahu terlihat natural.";

      const randomTopic = () => {
        const nextTopics = cameraTopics.filter((item) => item !== topic);
        const nextTopic = nextTopics[Math.floor(Math.random() * nextTopics.length)] || cameraTopics[0];
        setTopic(nextTopic);
      };

      const attachStream = (stream) => {
        streamRef.current = stream;
        setCameraReady(stream.getVideoTracks().length > 0);
        setMicReady(stream.getAudioTracks().length > 0);
        if (liveVideoRef.current) {
          liveVideoRef.current.srcObject = stream;
        }
      };

      const stopTracks = () => {
        if (streamRef.current) {
          streamRef.current.getTracks().forEach((track) => track.stop());
          streamRef.current = null;
        }
        setCameraReady(false);
        setMicReady(false);
      };

      const stopRecording = () => {
        clearInterval(timerRef.current);
        timerRef.current = null;
        setIsRecording(false);

        if (mediaRecorderRef.current && mediaRecorderRef.current.state !== "inactive") {
          mediaRecorderRef.current.stop();
        } else {
          stopTracks();
        }
      };

      const startRecording = async () => {
        try {
          const stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
          attachStream(stream);
          chunksRef.current = [];
          setRecordedUrl("");
          setElapsed(0);
          elapsedRef.current = 0;

          const preferredMime = MediaRecorder.isTypeSupported("video/webm;codecs=vp9,opus")
            ? "video/webm;codecs=vp9,opus"
            : MediaRecorder.isTypeSupported("video/webm")
              ? "video/webm"
              : "";
          const recorder = preferredMime ? new MediaRecorder(stream, { mimeType: preferredMime }) : new MediaRecorder(stream);
          mediaRecorderRef.current = recorder;

          recorder.ondataavailable = (event) => {
            if (event.data.size > 0) chunksRef.current.push(event.data);
          };

          recorder.onstop = () => {
            const blob = new Blob(chunksRef.current, { type: preferredMime || "video/webm" });
            const videoUrl = URL.createObjectURL(blob);
            setRecordedUrl(videoUrl);
            setHistory((current) => [
              {
                id: `local-${Date.now()}`,
                topic,
                date: new Date().toLocaleString("id-ID", { dateStyle: "medium", timeStyle: "short" }),
                duration: elapsedRef.current || selectedDuration,
                videoUrl,
                confidence: elapsedRef.current > selectedDuration * 0.75 ? "Confident" : "Growing"
              },
              ...current
            ]);
            stopTracks();
            setStatusMessage("Recording selesai. Replay video tersedia di bawah.");
          };

          recorder.start();
          setIsRecording(true);
          setStatusMessage("Recording berjalan. Jaga eye contact dan bahasa tubuh.");

          timerRef.current = setInterval(() => {
            setElapsed((current) => {
              const next = current + 1;
              elapsedRef.current = Math.min(next, selectedDuration);
              if (next >= selectedDuration) setTimeout(stopRecording, 0);
              return Math.min(next, selectedDuration);
            });
          }, 1000);
        } catch (error) {
          setStatusMessage("Camera atau microphone tidak bisa diakses. Periksa izin browser.");
        }
      };

      const replayVideo = (videoUrl) => {
        if (!videoUrl) return;
        setRecordedUrl(videoUrl);
        setTimeout(() => replayVideoRef.current?.play(), 100);
      };

      useEffect(() => {
        return () => {
          clearInterval(timerRef.current);
          stopTracks();
        };
      }, []);

      const instruction = useMemo(() => {
        if (isRecording) return "Bicara menghadap kamera, jaga gestur tetap natural, dan gunakan jeda yang jelas.";
        return "Pilih durasi dan topik, lalu mulai recording untuk melatih ekspresi, eye contact, dan body language.";
      }, [isRecording]);

      const toggleFocus = (item) => {
        setFocusProgress((current) => ({ ...current, [item]: !current[item] }));
      };

      return (
        <div className="space-y-6">
          <section className="camera-card p-6">
            <div className="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
              <div>
                <div className="text-sm font-black uppercase tracking-wide text-[#d2a06b]">Camera Speaking Practice</div>
                <h2 className="mt-2 text-3xl font-extrabold text-[#10204f]">Latihan dengan webcam</h2>
                <p className="mt-2 text-sm font-semibold leading-6 text-[#667085]">Latih ekspresi, eye contact, body language, dan confidence langsung dari browser.</p>
              </div>
              <div className="flex flex-wrap gap-3">
                <div className="camera-status-pill live">Level 4 Speaker</div>
                <div className="camera-status-pill">840 XP</div>
                <div className="camera-status-pill">Streak 5 hari</div>
                <button type="button" className="camera-btn btn-muted-camera" onClick={randomTopic}>
                  Topik Acak
                </button>
              </div>
            </div>
          </section>

          <section className="grid gap-4 md:grid-cols-3">
            {simulationModes.map((mode) => (
              <button
                key={mode.name}
                type="button"
                onClick={() => setActiveMode(mode)}
                className={`camera-card interactive p-5 text-left transition ${activeMode.name === mode.name ? "border-[#d2a06b] bg-[#fffaf3]" : ""}`}
              >
                <div className="text-sm font-black uppercase tracking-wide text-[#d2a06b]">Simulation</div>
                <h3 className="mt-2 text-xl font-extrabold text-[#10204f]">{mode.name}</h3>
                <p className="mt-2 text-sm font-semibold leading-6 text-[#667085]">{mode.objective}</p>
              </button>
            ))}
          </section>

          <section className="grid gap-6 xl:grid-cols-[minmax(0,1.55fr)_minmax(300px,0.55fr)]">
            <div className="camera-card overflow-hidden">
              <div className="border-b border-[#e5e7eb] p-6">
                <div className="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                  <div>
                    <div className="text-sm font-black uppercase tracking-wide text-[#d2a06b]">Topic Prompt</div>
                    <h3 className="mt-2 text-2xl font-extrabold leading-snug text-[#10204f]">{topic}</h3>
                  </div>
                  <div className="flex flex-wrap items-center gap-2">
                    <div className={`camera-status-pill ${cameraReady ? "live" : ""}`}>
                      <span className={cameraReady ? "recording-dot" : ""}></span>
                      LIVE Camera
                    </div>
                    <div className={`camera-status-pill ${micReady ? "live" : ""}`}>
                      Mic {micReady ? "On" : "Standby"}
                    </div>
                    <div className={`camera-status-pill ${isRecording ? "live" : ""}`}>
                      {isRecording && <span className="recording-dot"></span>}
                      {recordingStatus}
                    </div>
                  </div>
                </div>
              </div>

              <div className="grid gap-6 p-6 lg:grid-cols-[minmax(0,1fr)_240px]">
                <div className={`relative overflow-hidden rounded-[18px] bg-[#10204f] transition duration-300 ${isRecording ? "recording-glow" : ""}`}>
                  <video ref={liveVideoRef} className="aspect-video w-full bg-[#10204f] object-cover" autoPlay muted playsInline></video>
                  <div className="pointer-events-none absolute left-4 top-4 flex items-center gap-2 rounded-full bg-black/35 px-3 py-2 text-xs font-black uppercase tracking-wide text-white">
                    {isRecording && <span className="recording-dot"></span>}
                    {recordingStatus}
                  </div>
                  <div className="pointer-events-none absolute right-4 top-4 hidden rounded-full bg-black/35 px-3 py-2 text-xs font-black uppercase tracking-wide text-white sm:block">
                    {activeMode.name} Mode
                  </div>
                  <div className={`audio-wave ${isRecording ? "active" : ""} pointer-events-none absolute bottom-4 left-4 rounded-full bg-black/35 px-3 py-2`}>
                    <span></span><span></span><span></span><span></span><span></span>
                  </div>
                  <div className="pointer-events-none absolute bottom-4 right-4 hidden rounded-full bg-black/35 px-3 py-2 text-xs font-black uppercase tracking-wide text-white sm:block">
                    Eye Contact Practice
                  </div>
                </div>

                <div className="space-y-4">
                  <div className="rounded-[18px] border border-[#e5e7eb] bg-[#fbfbfd] p-5">
                    <div className="text-sm font-extrabold text-[#667085]">Speaking Timer</div>
                    <div className="mt-2 text-6xl font-black tracking-tight text-[#10204f]">{formatCameraTime(remainingTime)}</div>
                    <div className="mt-4 h-3 overflow-hidden rounded-full bg-[#e5e7eb]">
                      <div className="h-full rounded-full bg-[#d2a06b] transition-all" style={{ width: `${progress}%` }}></div>
                    </div>
                    <div className="mt-3 text-xs font-black uppercase tracking-wide text-[#d2a06b]">{recordingStatus}</div>
                  </div>

                  <div className="rounded-[18px] border border-[#e5e7eb] bg-[#fbfbfd] p-5">
                    <div className="mb-3 text-sm font-extrabold text-[#667085]">Duration</div>
                    <div className="flex flex-wrap gap-2">
                      {cameraDurations.map((duration) => (
                        <button
                          key={duration.seconds}
                          type="button"
                          disabled={isRecording}
                          onClick={() => {
                            setSelectedDuration(duration.seconds);
                            setElapsed(0);
                          }}
                          className={`rounded-xl px-4 py-2 text-sm font-extrabold transition ${
                            selectedDuration === duration.seconds
                              ? "bg-[#d2a06b] text-white"
                              : "bg-white text-[#344054] ring-1 ring-[#d0d5dd]"
                          }`}
                        >
                          {duration.label}
                        </button>
                      ))}
                    </div>
                  </div>
                </div>
              </div>

              <div className="flex flex-col gap-4 border-t border-[#e5e7eb] p-6 lg:flex-row lg:items-center lg:justify-between">
                <div>
                  <div className="text-sm font-black uppercase tracking-wide text-[#d2a06b]">Instruction</div>
                  <p className="mt-1 max-w-2xl text-sm font-semibold leading-6 text-[#667085]">{instruction}</p>
                  <div className="mt-3 grid gap-2 md:grid-cols-2">
                    <div className="rounded-2xl bg-[#f8fafc] px-4 py-3 text-sm font-bold text-[#344054] ring-1 ring-[#e5e7eb]">
                      Objective: {activeMode.objective}
                    </div>
                    <div className="rounded-2xl bg-[#fffaf3] px-4 py-3 text-sm font-bold text-[#7c4a12] ring-1 ring-[#f2d7b8]">
                      Tip: {speakingTip}
                    </div>
                  </div>
                </div>
                <div className="flex flex-wrap gap-3">
                  <button type="button" className="camera-btn btn-primary-camera start-recording-cta" onClick={startRecording} disabled={isRecording}>Start Recording</button>
                  <button type="button" className="camera-btn btn-danger-camera" onClick={stopRecording} disabled={!isRecording}>Stop Recording</button>
                </div>
              </div>
            </div>

            <aside className="space-y-6">
              <div className="camera-card p-6">
                <h2 className="text-2xl font-extrabold text-[#10204f]">Replay Result</h2>
                <p className="mt-2 text-sm font-semibold leading-6 text-[#667085]">{statusMessage}</p>
                <div className="mt-5 overflow-hidden rounded-[18px] bg-[#10204f]">
                  {recordedUrl ? (
                    <video ref={replayVideoRef} className="aspect-video w-full object-cover" src={recordedUrl} controls></video>
                  ) : (
                    <div className="flex aspect-video items-center justify-center text-sm font-bold text-white/75">Hasil recording akan muncul di sini</div>
                  )}
                </div>
              </div>

              <div className="camera-card p-6">
                <h2 className="text-2xl font-extrabold text-[#10204f]">Practice Focus</h2>
                <div className="mt-4 grid gap-3">
                  {focusItems.map((item) => (
                    <button
                      key={item}
                      type="button"
                      onClick={() => toggleFocus(item)}
                      className={`flex items-center justify-between rounded-2xl px-4 py-3 text-left text-sm font-extrabold ring-1 transition ${
                        focusProgress[item]
                          ? "bg-[#ecfdf3] text-[#027a48] ring-[#abefc6]"
                          : isRecording
                            ? "bg-[#fffaf3] text-[#7c4a12] ring-[#f2d7b8]"
                            : "bg-[#f8fafc] text-[#344054] ring-[#e5e7eb]"
                      }`}
                    >
                      <span>{item}</span>
                      <span>{focusProgress[item] ? "Completed" : isRecording ? "Active" : "Ready"}</span>
                    </button>
                  ))}
                </div>
              </div>

              <div className="camera-card p-6">
                <h2 className="text-2xl font-extrabold text-[#10204f]">Daily Challenge</h2>
                <p className="mt-2 text-sm font-semibold leading-6 text-[#667085]">Selesaikan 1 rekaman camera practice hari ini untuk mendapatkan 120 XP.</p>
                <div className="mt-4 h-3 overflow-hidden rounded-full bg-[#e5e7eb]">
                  <div className="h-full w-[68%] rounded-full bg-[#d2a06b]"></div>
                </div>
                <div className="mt-3 text-sm font-black text-[#d2a06b]">68% menuju target harian</div>
              </div>
            </aside>
          </section>

          <section className="camera-card p-6">
            <div className="mb-5">
              <h2 className="text-2xl font-extrabold text-[#10204f]">History Latihan Speaking</h2>
              <p className="mt-1 text-sm font-semibold text-[#667085]">Recording sementara tersimpan di local state selama halaman masih terbuka.</p>
            </div>

            <div className="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
              {history.map((item) => (
                <article key={item.id} className="camera-card interactive rounded-[18px] border border-[#e5e7eb] bg-[#fbfbfd] p-4">
                  <div className="history-video-card relative overflow-hidden rounded-2xl bg-[#10204f]">
                    {item.videoUrl ? (
                      <video className="aspect-video w-full object-cover" src={item.videoUrl} controls></video>
                    ) : (
                      <div className="flex aspect-video items-center justify-center px-4 text-center text-sm font-bold text-white/75">Dummy preview</div>
                    )}
                    <button
                      type="button"
                      onClick={() => replayVideo(item.videoUrl)}
                      disabled={!item.videoUrl}
                      className="play-overlay absolute inset-0 flex items-center justify-center bg-black/35 text-sm font-black text-white disabled:cursor-not-allowed"
                    >
                      Replay
                    </button>
                  </div>
                  <h3 className="mt-4 text-base font-extrabold leading-snug text-[#10204f]">{item.topic}</h3>
                  <div className="mt-3 flex flex-wrap gap-2">
                    <span className="rounded-full bg-[#eef2f7] px-3 py-1 text-xs font-black text-[#344054]">{item.date}</span>
                    <span className="rounded-full bg-[#fffaf3] px-3 py-1 text-xs font-black text-[#7c4a12]">{formatCameraTime(item.duration)}</span>
                    <span className="rounded-full bg-[#ecfdf3] px-3 py-1 text-xs font-black text-[#027a48]">{item.confidence}</span>
                  </div>
                  <button type="button" className="camera-btn btn-muted-camera mt-4 w-full" onClick={() => replayVideo(item.videoUrl)} disabled={!item.videoUrl}>Replay</button>
                </article>
              ))}
            </div>
          </section>
        </div>
      );
    }

    ReactDOM.createRoot(document.getElementById("camera-practice-root")).render(<CameraPracticeDashboard />);
  </script>
</body>

</html>
