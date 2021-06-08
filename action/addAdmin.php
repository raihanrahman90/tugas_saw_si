<?php
    include '../koneksi.php';
    $username = $koneksi-> real_escape_string($_POST['username']);
    $password = $koneksi-> real_escape_string($_POST['password']);
    $cekUsername = mysqli_query($koneksi, "SELECT * FROM login where username='$username'") or die(mysqli_error($koneksi));
    if(mysqli_num_rows($cekUsername)>0){
        header('Location:../admin/addAdmin.php');
    }else{
        mysqli_query($koneksi, "INSERT INTO login values('$username', md5('$password'))")  or die(mysqli_error($koneksi));
        header('Location:../admin/listAdmin.php');
    }
?>