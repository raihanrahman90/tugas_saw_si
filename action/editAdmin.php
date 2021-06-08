<?php
include '../koneksi.php';
$usernameLama = $koneksi -> real_escape_string($_GET['id']);
$username = $koneksi -> real_escape_string($_POST['username']);
$password = $koneksi -> real_escape_string($_POST['password']);
$cekUsername = mysqli_query($koneksi, "SELECT * FROM login where username ='$usernameLama'") or die(mysqli_error($koneksi));
if(mysqli_num_rows($cekUsername)>0){
    mysqli_query($koneksi, "UPDATE login SET username='$username', password=md5('$password') where username='$usernameLama'") or die(mysqli_error($koneksi));
    header("Location:../admin/listAdmin.php");
}else{
    $_SESSION['pesan'] = 'Username tidak ditemukan';
    header("Location:../admin/listAdmin.php");
}
?>