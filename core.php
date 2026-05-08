<?php
class manz{
	var $talkhost = "localhost";
    var $user = "root";
    var $pass = "";
    var $dbname = "talklab";
	var $koneksi ="";
	
	function __construct(){
		$this->koneksi=mysqli_connect($this->talkhost,$this->user,$this->pass,$this->dbname);
		if(mysqli_connect_errno()){
			echo"Koneksi gagal:".mysqli_connect_error();
		}
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
}