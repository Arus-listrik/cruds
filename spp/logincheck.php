<?php 
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'conn.php';
 
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
 
// menyeleksi data user dengan username dan password yang sesuai
$result = mysqli_query($conn,"SELECT * FROM login where username='$username' and password='$password'");

$cek = mysqli_num_rows($result);
 
if($cek > 0) {
	$data = mysqli_fetch_assoc($result);
	//menyimpan session user, nama, status dan id login
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "sudah_login";
	header("location:menu.php");
} else {
	header("location:login.php?pesan=Gagal login data tidak ditemukan.");
}
?>