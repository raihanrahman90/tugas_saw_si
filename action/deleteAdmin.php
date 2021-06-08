<?php
    require('../koneksi.php');
    $username = $koneksi -> real_escape_string($_GET['id']);
    mysqli_query($koneksi, "DELETE FROM login where username='$username'") or die(mysqli_error($koneksi));
    header('Location:../admin/listAdmin.php');
?>