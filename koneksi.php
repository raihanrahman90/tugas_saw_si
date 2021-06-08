<?php
$koneksi = mysqli_connect("localhost","root","","fikar");
date_default_timezone_set('Asia/Singapore');
//mysqli_connect(server, user, password, database)
// Check connection
//https://github.com/kingsakti87/bandara
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>