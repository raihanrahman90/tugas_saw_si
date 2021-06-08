<?php
    include '../koneksi.php';

    $id_sub_kriteria = $koneksi -> real_escape_string($_GET['id']);
    $nama_sub_kriteria = $koneksi -> real_escape_string($_POST['nama_sub_kriteria']);
    $nilai = $koneksi -> real_escape_string($_POST['nilai']);
    $query = mysqli_query($koneksi, "SELECT kode_kriteria from subkriteria where id_sub_kriteria='$id_sub_kriteria'") or die(mysqli_query($koneksi));
    if($data=mysqli_fetch_array($query)){
        
        $crud = mysqli_query($koneksi, "UPDATE subkriteria set nama_sub_kriteria='$nama_sub_kriteria', nilai='$nilai' 
            where id_sub_kriteria='$id_sub_kriteria'") or die(mysqli_error($koneksi));

        header('location:../Admin/listSubKriteria.php?id='.$data['kode_kriteria']);
    }
?>