<?php
$conn = mysqli_connect("localhost","root","","spp");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>