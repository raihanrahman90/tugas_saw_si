<?php
    include '../koneksi.php';
    $nama = $koneksi-> real_escape_string($_POST['nama']);
    $id_edit = $koneksi -> real_escape_string($_GET['id']);
    $insert = mysqli_query($koneksi, "UPDATE alternatif SET nama='$nama'
                                        where id_alternatif = '$id_edit'") or die(mysqli_error($koneksi));
    $id_alternatif = $id_edit;
    $getKriteria = mysqli_query($koneksi, "SELECT kriteria.*, id_alternatif FROM kriteria 
                                            left join (Select * from alternatif_bobot where id_alternatif='$id_alternatif') as tb_alter
                                            on tb_alter.kode_kriteria = kriteria.kode_kriteria") or die(mysqli_error($koneksi));
    foreach($getKriteria as $kriteria){
        $kode_kriteria = $kriteria['kode_kriteria'];
        $kode_kriteria;
        $id_sub_kriteria = $koneksi->real_escape_string($_POST[$kode_kriteria]);
        if(is_null($kriteria['id_alternatif'])){
            $insertAlternatifBobot = mysqli_query($koneksi, "INSERT INTO alternatif_bobot value('$id_alternatif', '$kode_kriteria', '$id_sub_kriteria')") or die(mysqli_error($koneksi));
        }else{
            $insertAlternatifBobot = mysqli_query($koneksi, "UPDATE alternatif_bobot set id_sub_kriteria = '$id_sub_kriteria'
            where kode_kriteria = '$kode_kriteria' and id_alternatif = '$id_alternatif'") or die(mysqli_error($koneksi));
        }
    }
    header('Location:../Admin/listAlternatif.php');
?>