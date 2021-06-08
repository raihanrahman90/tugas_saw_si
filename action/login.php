<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
$username = $koneksi -> real_escape_string($_POST['username']);
$password = $koneksi -> real_escape_string($_POST['password']);

// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"SELECT * FROM login WHERE username='$username' and password=md5('$password')");
// menghitung jumlah data yang ditemukan
if($data = mysqli_fetch_array($data)){
	$_SESSION['username'] = $data['username'];
	header('location:../Admin/listKriteria.php');
}else{
	$_SESSION['pesan']="gagal login";
	header("location:../login.php");
}
?>