<?php
    session_start();
    include('../koneksi.php');
    $username = $koneksi-> real_escape_string($_SESSION['username']);
    $password = $koneksi->real_escape_string($_POST['password']);
    $password_baru = $koneksi -> real_escape_string($_POST['password_baru']);
    $getData = mysqli_query($koneksi, "SELECT * FROM login where username='$username' and password=md5('$password')") or die(mysqli_error($koneksi));
    if($data = mysqli_fetch_array($getData)){
        $gantiPassword = mysqli_query($koneksi, "UPDATE login set password=md5('$password_baru') where username='$username'") or die(mysqli_error($koneksi));
        $_SESSION['pesan'] = 'Berhasil';
    }else{
        $_SESSION['pesan'] = 'Gagal';
    }
    header('Location:../Admin/changePassword.php');
?>