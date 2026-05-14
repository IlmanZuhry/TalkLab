<?php
class manz{
	var $talkhost = "localhost";
    var $user = "root";
    var $pass = "";
    var $dbname = "talklab";
	public mysqli $koneksi;
	
	function __construct(){
		$this->koneksi=mysqli_connect($this->talkhost,$this->user,$this->pass,$this->dbname);
		if(mysqli_connect_errno()){
			echo"Koneksi gagal:".mysqli_connect_error();
		}
		$this->ensureCommunityPostsTable();
		$this->ensureLikesAndCommentsTable();
		$this->ensurePracticeTables();
	}

	// Generate ID unik 6 karakter (huruf kapital + angka)
	function generateId(){
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		do {
			$id = '';
			for ($i = 0; $i < 6; $i++) {
				$id .= $chars[random_int(0, strlen($chars) - 1)];
			}
			$cek = mysqli_query($this->koneksi, "SELECT Id_User FROM users WHERE Id_User = '$id'");
		} while (mysqli_num_rows($cek) > 0);
		return $id;
	}

	// Registrasi user baru
	function register($nama, $tempat_lahir, $tanggal_lahir, $username, $password){
		// Cek apakah username sudah dipakai
		$usernameEsc = mysqli_real_escape_string($this->koneksi, $username);
		$cekUser = mysqli_query($this->koneksi, "SELECT Username FROM users WHERE Username = '$usernameEsc'");
		if(mysqli_num_rows($cekUser) > 0){
			return ['status' => false, 'pesan' => 'Username sudah digunakan, coba yang lain.'];
		}

		$id            = $this->generateId();
		$namaEsc       = mysqli_real_escape_string($this->koneksi, $nama);
		$tempatEsc     = mysqli_real_escape_string($this->koneksi, $tempat_lahir);
		$tglEsc        = mysqli_real_escape_string($this->koneksi, $tanggal_lahir);
		$hashedPass    = password_hash($password, PASSWORD_BCRYPT);

		$query = "INSERT INTO users (Id_User, Nama, Tempat_Lahir, Tanggal_Lahir, Username, Password)
		          VALUES ('$id', '$namaEsc', '$tempatEsc', '$tglEsc', '$usernameEsc', '$hashedPass')";

		if(mysqli_query($this->koneksi, $query)){
			return ['status' => true, 'pesan' => 'Registrasi berhasil! Silakan login.'];
		} else {
			return ['status' => false, 'pesan' => 'Gagal menyimpan data: ' . mysqli_error($this->koneksi)];
		}
	}

	// Autentikasi user berdasarkan username dan password.
	// Mengembalikan baris user (array) jika berhasil, atau false jika gagal.
	public function authenticate($username, $password){
		$usernameEsc = mysqli_real_escape_string($this->koneksi, $username);
		$res = mysqli_query($this->koneksi, "SELECT * FROM users WHERE Username = '$usernameEsc' LIMIT 1");
		if($res && mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_assoc($res);
			if(password_verify($password, $row['Password'])){
				return $row;
			}
		}
		return false;
	}

	// Ambil data user berdasarkan username (atau false jika tidak ada)
	public function getUserByUsername($username){
		$usernameEsc = mysqli_real_escape_string($this->koneksi, $username);
		$res = mysqli_query($this->koneksi, "SELECT * FROM users WHERE Username = '$usernameEsc' LIMIT 1");
		if($res && mysqli_num_rows($res) > 0){
			return mysqli_fetch_assoc($res);
		}
		return false;
	}

	// Set variabel session PHP dari data user
	public function setSessionFromUser($row){
		if (session_status() == PHP_SESSION_NONE) session_start();
		$_SESSION['name'] = $row['Nama'];
		$_SESSION['username'] = $row['Username'];
		$_SESSION['user_id'] = $row['Id_User'];
	}

	// Bantuan logout (menghapus session)
	public function logout(){
		if (session_status() == PHP_SESSION_NONE) session_start();
		session_unset();
		session_destroy();
	}

	// Periksa apakah sudah login
	public function isLoggedIn(){
		if (session_status() == PHP_SESSION_NONE) session_start();
		return !empty($_SESSION['user_id']);
	}

	// Pastikan session dimulai (dipanggil sebelum output)
	public function ensureSession(){
		if (session_status() == PHP_SESSION_NONE) session_start();
	}

	// Kembalikan data user saat ini dari session (atau false jika tidak ada)
	public function getCurrentUser(){
		$this->ensureSession();
		if (!empty($_SESSION['user_id'])){
			return [
				'Id_User' => $_SESSION['user_id'] ?? null,
				'Nama' => $_SESSION['name'] ?? null,
				'Username' => $_SESSION['username'] ?? null,
			];
		}
		return false;
	}

	// Kembalikan nama yang aman untuk ditampilkan
	public function getDisplayName(){
		$user = $this->getCurrentUser();
		if ($user !== false && !empty($user['Nama'])) return htmlspecialchars($user['Nama']);
		return 'User';
	}

	// Kembalikan username yang aman untuk ditampilkan
	public function getDisplayUsername(){
		$user = $this->getCurrentUser();
		if ($user !== false && !empty($user['Username'])) return htmlspecialchars($user['Username']);
		return '';
	}

	// Pastikan tabel komunitas ada di database
	public function ensureCommunityPostsTable(){
	$create = "CREATE TABLE IF NOT EXISTS Komunitas (
		Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
		Id_User VARCHAR(6) NOT NULL,
		Isi TEXT NOT NULL,
		Dibuat DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
		Update_Post DATETIME NULL DEFAULT NULL
		ON UPDATE CURRENT_TIMESTAMP,
		PRIMARY KEY (Id),

		KEY idx_user_id (Id_User),

		CONSTRAINT fk_community_user FOREIGN KEY (Id_User) REFERENCES users(Id_User)
		ON DELETE CASCADE
		ON UPDATE CASCADE

	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
	mysqli_query($this->koneksi, $create);
}

	public function getCommunityPosts(){
	$sql = "SELECT p.Id,p.Id_User,p.Isi,p.Dibuat,
		u.Nama AS name,u.Username AS username
		FROM Komunitas p LEFT JOIN users u ON p.Id_User = u.Id_User ORDER BY p.Dibuat DESC";

	$res = mysqli_query($this->koneksi, $sql);

	$posts = [];
	if ($res){
		while ($row = mysqli_fetch_assoc($res)){
			$posts[] = $row;
		}
	}
	return $posts;
}

	public function getCommunityPostById($postId){
	$postIdEsc = (int) $postId;
	$sql = "SELECT Id,Id_User,Isi,Dibuat
		FROM Komunitas WHERE Id = $postIdEsc LIMIT 1";
	$res = mysqli_query($this->koneksi, $sql);

	if ($res && mysqli_num_rows($res) > 0){
		return mysqli_fetch_assoc($res);
	}
	return false;
}

	public function createCommunityPost($userId, $content){
	$userIdEsc = mysqli_real_escape_string($this->koneksi, $userId);
	$contentEsc = mysqli_real_escape_string($this->koneksi, $content);
	$sql = "INSERT INTO Komunitas (Id_User, Isi) VALUES ('$userIdEsc', '$contentEsc')";
	return mysqli_query($this->koneksi, $sql);
}

	public function updateCommunityPost($postId, $userId,$content){
	$postIdEsc = (int) $postId;
	$userIdEsc = mysqli_real_escape_string($this->koneksi, $userId);
	$contentEsc = mysqli_real_escape_string($this->koneksi, $content);
	$sql = "UPDATE Komunitas SET Isi = '$contentEsc'
		WHERE Id = $postIdEsc
		AND Id_User = '$userIdEsc'
		LIMIT 1";
	return mysqli_query($this->koneksi, $sql);
}
	public function deleteCommunityPost($postId, $userId){
	$postIdEsc = (int) $postId;
	$userIdEsc = mysqli_real_escape_string($this->koneksi, $userId);
	$sql = "DELETE FROM Komunitas WHERE Id = $postIdEsc AND Id_User = '$userIdEsc' LIMIT 1";
	return mysqli_query($this->koneksi, $sql);
}

	// Pastikan tabel likes dan comments ada di database
	public function ensureLikesAndCommentsTable(){
	// Tabel untuk likes
	$createLikes = "CREATE TABLE IF NOT EXISTS post_likes (
		id INT UNSIGNED NOT NULL AUTO_INCREMENT,
		post_id INT UNSIGNED NOT NULL,
		user_id VARCHAR(6) NOT NULL,
		created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id),
		UNIQUE KEY unique_like (post_id, user_id),
		KEY idx_post (post_id),
		KEY idx_user (user_id),
		CONSTRAINT fk_like_post FOREIGN KEY (post_id) REFERENCES Komunitas(Id) ON DELETE CASCADE,
		CONSTRAINT fk_like_user FOREIGN KEY (user_id) REFERENCES users(Id_User) ON DELETE CASCADE
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
	mysqli_query($this->koneksi, $createLikes);

	// Tabel untuk comments
	$createComments = "CREATE TABLE IF NOT EXISTS post_comments (
		id INT UNSIGNED NOT NULL AUTO_INCREMENT,
		post_id INT UNSIGNED NOT NULL,
		user_id VARCHAR(6) NOT NULL,
		content TEXT NOT NULL,
		created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
		updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
		PRIMARY KEY (id),
		KEY idx_post (post_id),
		KEY idx_user (user_id),
		CONSTRAINT fk_comment_post FOREIGN KEY (post_id) REFERENCES Komunitas(Id) ON DELETE CASCADE,
		CONSTRAINT fk_comment_user FOREIGN KEY (user_id) REFERENCES users(Id_User) ON DELETE CASCADE
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
	mysqli_query($this->koneksi, $createComments);
}

	// Toggle like (add or remove)
	public function toggleLike($postId, $userId){
	$postIdEsc = (int) $postId;
	$userIdEsc = mysqli_real_escape_string($this->koneksi, $userId);

	// Cek apakah sudah like
	$cek = mysqli_query($this->koneksi, "SELECT id FROM post_likes WHERE post_id = $postIdEsc AND user_id = '$userIdEsc'");

	if (mysqli_num_rows($cek) > 0) {
		// Jika sudah like, hapus
		$sql = "DELETE FROM post_likes WHERE post_id = $postIdEsc AND user_id = '$userIdEsc'";
		return mysqli_query($this->koneksi, $sql);
	} else {
		// Jika belum, tambah
		$sql = "INSERT INTO post_likes (post_id, user_id) VALUES ($postIdEsc, '$userIdEsc')";
		return mysqli_query($this->koneksi, $sql);
	}
}

	// Ambil jumlah like
	public function getLikeCount($postId){
	$postIdEsc = (int) $postId;
	$sql = "SELECT COUNT(*) as count FROM post_likes WHERE post_id = $postIdEsc";
	$res = mysqli_query($this->koneksi, $sql);
	if ($res) {
		$row = mysqli_fetch_assoc($res);
		return (int) $row['count'];
	}
	return 0;
}

	// Cek apakah user sudah like
	public function getUserLikeStatus($postId, $userId){
	if (empty($userId)) return false;
	$postIdEsc = (int) $postId;
	$userIdEsc = mysqli_real_escape_string($this->koneksi, $userId);
	$sql = "SELECT id FROM post_likes WHERE post_id = $postIdEsc AND user_id = '$userIdEsc' LIMIT 1";
	$res = mysqli_query($this->koneksi, $sql);
	return mysqli_num_rows($res) > 0;
}

	// Tambah comment
	public function addComment($postId, $userId, $content){
	$postIdEsc = (int) $postId;
	$userIdEsc = mysqli_real_escape_string($this->koneksi, $userId);
	$contentEsc = mysqli_real_escape_string($this->koneksi, trim($content));

	if (empty($contentEsc)) return false;

	$sql = "INSERT INTO post_comments (post_id, user_id, content) VALUES ($postIdEsc, '$userIdEsc', '$contentEsc')";
	return mysqli_query($this->koneksi, $sql);
}

	// Ambil jumlah comment
	public function getCommentCount($postId){
	$postIdEsc = (int) $postId;
	$sql = "SELECT COUNT(*) as count FROM post_comments WHERE post_id = $postIdEsc";
	$res = mysqli_query($this->koneksi, $sql);
	if ($res) {
		$row = mysqli_fetch_assoc($res);
		return (int) $row['count'];
	}
	return 0;
}

	public function ensurePracticeTables(){
		$this->ensurePracticeHistoryTable();
		$this->ensureChallengeHistoryTable();
		$this->ensureAiFeedbackTable();
	}

	public function ensurePracticeHistoryTable(){
		$sql = "CREATE TABLE IF NOT EXISTS practice_history (
			id INT UNSIGNED NOT NULL AUTO_INCREMENT,
			user_id VARCHAR(6) NOT NULL,
			topic VARCHAR(255) NOT NULL,
			duration_seconds INT UNSIGNED NOT NULL,
			audio_path VARCHAR(255) NOT NULL,
			created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (id),
			KEY idx_practice_user (user_id),
			CONSTRAINT fk_practice_user FOREIGN KEY (user_id) REFERENCES users(Id_User)
			ON DELETE CASCADE ON UPDATE CASCADE
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
		mysqli_query($this->koneksi, $sql);
	}

	public function ensureChallengeHistoryTable(){
		$sql = "CREATE TABLE IF NOT EXISTS speaking_challenge_history (
			id INT UNSIGNED NOT NULL AUTO_INCREMENT,
			user_id VARCHAR(6) NOT NULL,
			challenge_type VARCHAR(60) NOT NULL,
			level_name VARCHAR(30) NOT NULL,
			prompt TEXT NOT NULL,
			prep_seconds INT UNSIGNED NOT NULL,
			speak_seconds INT UNSIGNED NOT NULL,
			actual_seconds INT UNSIGNED NOT NULL,
			score INT UNSIGNED NOT NULL,
			completed TINYINT(1) NOT NULL DEFAULT 1,
			created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (id),
			KEY idx_challenge_user (user_id),
			CONSTRAINT fk_challenge_user FOREIGN KEY (user_id) REFERENCES users(Id_User)
			ON DELETE CASCADE ON UPDATE CASCADE
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
		mysqli_query($this->koneksi, $sql);
	}

	public function ensureAiFeedbackTable(){
		$sql = "CREATE TABLE IF NOT EXISTS ai_feedback_history (
			id INT UNSIGNED NOT NULL AUTO_INCREMENT,
			user_id VARCHAR(6) NOT NULL,
			source_type VARCHAR(40) NOT NULL,
			duration_seconds INT UNSIGNED NOT NULL,
			clarity_score INT UNSIGNED NOT NULL,
			fluency_score INT UNSIGNED NOT NULL,
			confidence_score INT UNSIGNED NOT NULL,
			consistency_score INT UNSIGNED NOT NULL,
			filler_count INT UNSIGNED NOT NULL,
			speaking_speed INT UNSIGNED NOT NULL,
			feedback TEXT NOT NULL,
			created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (id),
			KEY idx_ai_feedback_user (user_id),
			CONSTRAINT fk_ai_feedback_user FOREIGN KEY (user_id) REFERENCES users(Id_User)
			ON DELETE CASCADE ON UPDATE CASCADE
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
		mysqli_query($this->koneksi, $sql);
	}

	public function getPracticeHistory($userId, $limit = 10){
		$history = [];
		$limit = (int) $limit;
		$stmt = mysqli_prepare($this->koneksi, "SELECT topic, duration_seconds, audio_path, created_at FROM practice_history WHERE user_id = ? ORDER BY created_at DESC LIMIT $limit");
		if (!$stmt) return $history;
		mysqli_stmt_bind_param($stmt, "s", $userId);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while ($row = mysqli_fetch_assoc($result)){
			$history[] = $row;
		}
		mysqli_stmt_close($stmt);
		return $history;
	}

	public function getChallengeHistory($userId, $limit = 10){
		$history = [];
		$limit = (int) $limit;
		$stmt = mysqli_prepare($this->koneksi, "SELECT challenge_type, level_name, prompt, prep_seconds, speak_seconds, actual_seconds, score, completed, created_at FROM speaking_challenge_history WHERE user_id = ? ORDER BY created_at DESC LIMIT $limit");
		if (!$stmt) return $history;
		mysqli_stmt_bind_param($stmt, "s", $userId);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while ($row = mysqli_fetch_assoc($result)){
			$history[] = $row;
		}
		mysqli_stmt_close($stmt);
		return $history;
	}

	public function getAiFeedbackHistory($userId, $limit = 10){
		$history = [];
		$limit = (int) $limit;
		$stmt = mysqli_prepare($this->koneksi, "SELECT source_type, duration_seconds, clarity_score, fluency_score, confidence_score, consistency_score, filler_count, speaking_speed, feedback, created_at FROM ai_feedback_history WHERE user_id = ? ORDER BY created_at DESC LIMIT $limit");
		if (!$stmt) return $history;
		mysqli_stmt_bind_param($stmt, "s", $userId);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while ($row = mysqli_fetch_assoc($result)){
			$history[] = $row;
		}
		mysqli_stmt_close($stmt);
		return $history;
	}

	public function savePracticeHistory($userId, $topic, $durationSeconds, $audioPath){
		$stmt = mysqli_prepare($this->koneksi, "INSERT INTO practice_history (user_id, topic, duration_seconds, audio_path) VALUES (?, ?, ?, ?)");
		if (!$stmt) return false;
		$durationSeconds = (int) $durationSeconds;
		mysqli_stmt_bind_param($stmt, "ssis", $userId, $topic, $durationSeconds, $audioPath);
		$saved = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		return $saved;
	}

	public function saveChallengeHistory($userId, $challengeType, $levelName, $prompt, $prepSeconds, $speakSeconds, $actualSeconds, $score, $completed){
		$stmt = mysqli_prepare($this->koneksi, "INSERT INTO speaking_challenge_history (user_id, challenge_type, level_name, prompt, prep_seconds, speak_seconds, actual_seconds, score, completed) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		if (!$stmt) return false;
		$prepSeconds = (int) $prepSeconds;
		$speakSeconds = (int) $speakSeconds;
		$actualSeconds = (int) $actualSeconds;
		$score = (int) $score;
		$completed = (int) $completed;
		mysqli_stmt_bind_param($stmt, "ssssiiiii", $userId, $challengeType, $levelName, $prompt, $prepSeconds, $speakSeconds, $actualSeconds, $score, $completed);
		$saved = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		return $saved;
	}

	public function saveAiFeedbackHistory($userId, $sourceType, $durationSeconds, $clarity, $fluency, $confidence, $consistency, $fillerCount, $speakingSpeed, $feedback){
		$stmt = mysqli_prepare($this->koneksi, "INSERT INTO ai_feedback_history (user_id, source_type, duration_seconds, clarity_score, fluency_score, confidence_score, consistency_score, filler_count, speaking_speed, feedback) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		if (!$stmt) return false;
		$durationSeconds = (int) $durationSeconds;
		$clarity = (int) $clarity;
		$fluency = (int) $fluency;
		$confidence = (int) $confidence;
		$consistency = (int) $consistency;
		$fillerCount = (int) $fillerCount;
		$speakingSpeed = (int) $speakingSpeed;
		mysqli_stmt_bind_param($stmt, "ssiiiiiiis", $userId, $sourceType, $durationSeconds, $clarity, $fluency, $confidence, $consistency, $fillerCount, $speakingSpeed, $feedback);
		$saved = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		return $saved;
	}

}
