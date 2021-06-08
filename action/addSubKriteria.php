<?php
    session_start();
    include '../koneksi.php';
    $id = $koneksi -> real_escape_string($_POST['id']);
    $subkriteria = $koneksi -> real_escape_string($_POST['nama_subkriteria']);
    $bobot = $koneksi -> real_escape_string($_POST['bobot']);
    $sintax = mysqli_query($koneksi, "INSERT INTO subkriteria value(0,'$id','$subkriteria','$bobot')") or die(mysqli_error($koneksi));
    header('location:../Admin/listSubKriteria.php?id='.$id);

?>