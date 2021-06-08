<?php
    include '../koneksi.php';
    $id = $koneksi -> real_escape_string($_GET['id']);
    $hapus = mysqli_query($koneksi, "DELETE FROM alternatif where id_alternatif='$id'") or die(mysqli_error($koneksi));
    header('Location:../Admin/listAlternatif.php');
?>