<?php
    session_start();
    include '../koneksi.php';
    $kode = $koneksi -> real_escape_string($_POST['kode']);
    $kriteria = $koneksi -> real_escape_string($_POST['kriteria']);
    $bobot = $koneksi -> real_escape_string($_POST['bobot']);
    $tipe = $koneksi -> real_escape_string($_POST['tipe']);
    $cek_kode = mysqli_query($koneksi, "SELECT * FROM kriteria where kode_kriteria='$kode'") or die(mysqli_error($koneksi));
    if(mysqli_num_rows($cek_kode)>0){
        $_SESSION['pesan'] = 'Kode telah digunakan, mohon isikan kode lain';
        header('Location:../Admin/addKriteria.php');
    }else{
        $sintax = mysqli_query($koneksi, "INSERT INTO kriteria value('$kode','$kriteria','$bobot', '$tipe')") or die(mysqli_error($koneksi));
        header('location:../Admin/listKriteria.php');
    }

?>