<?php

// connect to database
$conn = mysqli_connect("localhost", "root", "", "db_hotel");

// read data
function read($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$records = [];
	while ($tuples = mysqli_fetch_assoc($result)) {
		$records[] = $tuples;
	}
	return $records;
}

function execute_query($query)
{
	global $conn;
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		return true;
	}
	return false;
}

function execute_multi_query($query)
{
	global $conn;
	mysqli_multi_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		return true;
	}
	return false;
}

function check_username($uname) {
	global $conn;
	mysqli_query($conn, "SELECT * FROM user_account WHERE username = '$uname';");
	return mysqli_affected_rows($conn);
}

function check_NIK($nik) {
	global $conn;
	mysqli_query($conn, "SELECT * FROM user_account WHERE NIK = '$nik';");
	return mysqli_affected_rows($conn);
}

function register_new_user($record) {
	global $conn;
	$nik = $record["NIK"];
	$uname = stripslashes($record["username"]);
	$pwd = mysqli_real_escape_string($conn, $record["password_akun_login"]);
	$pwd_konf = mysqli_real_escape_string($conn, $record["password_akun_konfirmasi"]);
	if ($pwd !== $pwd_konf) {
		return 1;
	} elseif (check_NIK($nik) > 0) {
		return 2;
	} elseif ((check_username($uname)) > 0) {
		return 3;
	} else {
  		$nama = $record["nama"];
  		$alamat = $record["alamat"];
  		$jenis_kelamin = $record["jenis_kelamin"];
  		$email = $record["email"];
  		$hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
  		$query_akun = "INSERT INTO user_account VALUES('', '$nama', '$alamat', '$nik', 'user', '$jenis_kelamin', '$uname', '$hashed_pwd', '$email');";
  		if (execute_query($query_akun)) {
  			return 4;
  		}
	}
}

function login($username, $password) {
	global $conn;
	$uname = stripslashes($username);
	$pwd = mysqli_real_escape_string($conn, $password);
	$query = "SELECT username, password_user, role FROM user_account WHERE username = '$uname';";
	$res = mysqli_query($conn, $query);
	if(mysqli_num_rows($res) === 1){
		$account = mysqli_fetch_assoc($res);
		if (password_verify($pwd, $account['password_user'])) {
			if ($account['role'] == 'user') {

			} else {

			}
		}
	}
}

function reserve($id_tipe_kamar, $checkin, $checkout) {
	global $conn;
	$query_1 = "SELECT COUNT(DISTINCT(reservasi_kamar.ID_kamar)) AS jumlah FROM reservasi_kamar INNER JOIN kamar_hotel ON reservasi_kamar.ID_kamar = kamar_hotel.ID_kamar WHERE (tgl_checkin BETWEEN '$checkin' AND '$checkout') AND (tgl_checkout BETWEEN '$checkin' AND '$checkout') AND (ID_tipe_kamar = $id_tipe_kamar);";
	$query_2 = "SELECT reservasi_kamar.ID_kamar FROM reservasi_kamar INNER JOIN kamar_hotel ON reservasi_kamar.ID_kamar = kamar_hotel.ID_kamar WHERE (tgl_checkin BETWEEN '$checkin' AND '$checkout') AND (tgl_checkout BETWEEN '$checkin' AND '$checkout') AND (ID_tipe_kamar = $id_tipe_kamar) ORDER BY reservasi_kamar.ID_kamar;";
	$query_3 = "SELECT COUNT(DISTINCT(kamar_hotel.ID_kamar)) AS jumlah FROM kamar_hotel INNER JOIN tipe_kamar ON kamar_hotel.ID_tipe_kamar = tipe_kamar.ID_tipe_kamar WHERE kamar_hotel.ID_tipe_kamar = $id_tipe_kamar;";
	$query_4 = "SELECT kamar_hotel.ID_kamar FROM kamar_hotel INNER JOIN tipe_kamar ON kamar_hotel.ID_tipe_kamar = tipe_kamar.ID_tipe_kamar WHERE kamar_hotel.ID_tipe_kamar = $id_tipe_kamar ORDER BY ID_kamar";
	$jmlh_kamar_reservasi = read($query_1);
	$jmlh_kamar = read($query_3);
	$nomor_kamar_reservasi = read($query_2);
	$nomor_kamar = read($query_4);
	$jmlh_kamar_reservasi = $jmlh_kamar_reservasi[0]['jumlah'];
	$jmlh_kamar = $jmlh_kamar[0]['jumlah'];
	// check availability
	if (($jmlh_kamar_reservasi) < $jmlh_kamar) {
		// temukan ID kamar yang tidak direservasi
		$list_kamar = [];
		$list_kamar_reservasi = [];
		foreach ($nomor_kamar as $kamar) {
			array_push($list_kamar, $kamar["ID_kamar"]);
		}
		foreach ($nomor_kamar_reservasi as $kamar) {
			array_push($list_kamar_reservasi, $kamar["ID_kamar"]);
		}
		$ID_kamar_kosong = array_diff($list_kamar, $list_kamar_reservasi);
		$ID_kamar_kosong = array_values($ID_kamar_kosong);
		$ID_kamar = $ID_kamar_kosong[0];
		return $ID_kamar;
		// $query_reservation = "INSERT INTO reservasi_kamar VALUE('', );";
	} else {
		return NULL;
	}

}
