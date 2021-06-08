<?php
    include '../koneksi.php';
    $nama = $koneksi-> real_escape_string($_POST['nama']);
    $insert = mysqli_query($koneksi, "INSERT INTO alternatif value(0,'$nama')") or die(mysqli_error($koneksi));
    $id_alternatif = mysqli_insert_id($koneksi);
    $getKriteria = mysqli_query($koneksi, "SELECT * FROM kriteria") or die(mysqli_error($koneksi));
    foreach($getKriteria as $kriteria){
        $kode_kriteria = $kriteria['kode_kriteria'];
        $id_sub_kriteria = $koneksi->real_escape_string($_POST[$kode_kriteria]);
        $insertAlternatifBobot = mysqli_query($koneksi, "INSERT INTO alternatif_bobot value('$id_alternatif', '$kode_kriteria','$id_sub_kriteria')") or die(mysqli_error($koneksi));
    }
    header('Location:../Admin/listAlternatif.php');
?>