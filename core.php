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

	public function getComments($postId){
	$postIdEsc = (int) $postId;
	$sql = "SELECT
		pc.id,
		pc.content,
		pc.created_at,

		u.Nama,
		u.Username,
		u.Id_User

		FROM post_comments pc
		JOIN users u ON pc.user_id = u.Id_User
		WHERE pc.post_id = $postIdEsc ORDER BY pc.created_at ASC";

	$res = mysqli_query($this->koneksi, $sql);
	$comments = [];
	if ($res) {
		while ($row = mysqli_fetch_assoc($res)) {
			$comments[] = $row;
		}
	}

	return $comments;
}

}