<?php
    include '../koneksi.php';
    $id = $koneksi -> real_escape_string($_GET['id']);
    $getKodeKriteria = mysqli_query($koneksi, "SELECT kode_kriteria from subkriteria where id_sub_kriteria='$id'") or die(mysqli_error($koneksi));
    if($data = mysqli_fetch_array($getKodeKriteria)){
        $hapus = mysqli_query($koneksi, "DELETE FROM subkriteria where id_sub_kriteria='$id'") or die(mysqli_error($koneksi));
        header('Location:../Admin/listSubKriteria.php?id='.$data['kode_kriteria']);
    }else{
        echo 'data tidak ditemukan';
    }
?>