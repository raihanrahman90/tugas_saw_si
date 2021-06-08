<?php
session_start();
$halaman = 'Alternatif';
include '../koneksi.php';
include 'header.php';
$id_alternatif = $_GET['id'];
$sintax = mysqli_query($koneksi, "SELECT * FROM alternatif where id_alternatif='$id_alternatif'") or die(mysqli_error($koneksi));
if($data = mysqli_fetch_array($sintax)){
    $nama = $data['nama'];
}else{
    header("Location:listAlternatif.php");
}
?>
       <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Edit</strong> Alternatif</h1>
					<div class="row">
						<div class="col-12 d-flex">
							<div class="card flex-fill">
                                <form action=<?php echo "../action/editAlternatif.php?id=".$id_alternatif ?>id="my_form" method="post">
                                    <table class="table" id="" width="100%" cellspacing="0">
                                    <tbody>
                                        <tr>
                                        <div class="row">
                                        <div class="col-lg-3">
                                        <td><label>Nama</label></td>
                                        </div>
                                        <div class="col-lg-3">
                                        <td><label>:</label></td></div>
                                        <div class="col-lg-6">
                                        <td><input type="text" class="form-control" name="nama" required value=<?php echo "'".$nama."'"?>></td></div>
                                        </tr>
                                        <?php
                                            $kriteria = mysqli_query($koneksi, "SELECT * FROM kriteria") or die(mysqli_error($koneksi));
                                            foreach($kriteria as $row){
                                            echo '<tr>
                                                <div class="row">
                                                <div class="row-lg-3">
                                                    <td><label>'.$row['nama_kriteria'].'</label></td>
                                                </div>
                                                <div class="col-lg-3">
                                                    <td><label>:</label></td>
                                                </div>
                                                <div class="col-lg-6">
                                                    <td>
                                                        <select name="'.$row['kode_kriteria'].'" class="form-control">';
                                                            $subkriteria= mysqli_query($koneksi, "SELECT subkriteria. id_sub_kriteria, subkriteria.nama_sub_kriteria, id_alternatif from subkriteria 
                                                            left join (select id_alternatif, id_sub_kriteria from alternatif_bobot where id_alternatif='$id_alternatif') as pilihan
                                                                on pilihan.id_sub_kriteria = subkriteria.id_sub_kriteria
                                                            where subkriteria.kode_kriteria='".$row["kode_kriteria"]."' order by kode_kriteria, nilai");
                                                            foreach($subkriteria as $row){
                                                                if(is_null($row['id_alternatif'])){
                                                                echo '<option value="'.$row['id_sub_kriteria'].'">'.$row['nama_sub_kriteria'].'</option>';
                                                                }else{
                                                                echo '<option value="'.$row['id_sub_kriteria'].'" selected>'.$row['nama_sub_kriteria'].'</option>';
                                                                }
                                                            }
                                                echo    '</select>
                                                    </td>
                                                </div>';
                                            echo '<tr>';
                                            }
                                        ?>
                                        
                                        <tr>
                                        
                                        <td colspan="3">
                                            <button type="submit" class="btn btn-info float-right">Simpan</button>        
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </form>
							</div>
						</div>
					</div>

				</div>
			</main>
      <!-- End of Main Content -->
<?php include 'footer.php';
?>