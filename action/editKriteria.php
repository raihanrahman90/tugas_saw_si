<?php
    include '../koneksi.php';

    $kode_edit = $koneksi -> real_escape_string($_GET['id']);
    $kode_kriteria = $koneksi -> real_escape_string($_POST['kode_kriteria']);
    $nama_kriteria = $koneksi -> real_escape_string($_POST['nama_kriteria']);
    $bobot = $koneksi -> real_escape_string($_POST['bobot']);
    $tipe = $koneksi -> real_escape_string($_POST['tipe']);
    
    $crud = mysqli_query($koneksi, "UPDATE kriteria set kode_kriteria='$kode_kriteria', nama_kriteria='$nama_kriteria', bobot='$bobot', tipe='$tipe' 
                                    where kode_kriteria='$kode_edit'") or die(mysqli_error($koneksi));
    header('location:../Admin/listKriteria.php');
?>