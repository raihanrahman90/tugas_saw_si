<?php
session_start();
$halaman = 'Alternatif';
include '../koneksi.php';
include 'header.php';
$id_alternatif = $koneksi -> real_escape_string($_GET['id']);
$sintax = mysqli_query($koneksi, "SELECT * FROM alternatif where id_alternatif='$id_alternatif'") or die(mysqli_error($koneksi));
if($data = mysqli_fetch_array($sintax)){
    $nama = $data['nama'];
}else{
    header("Location:listAlternatif.php");
}
?>
       <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
					<div class="row">
						<div class="col-12 d-flex">
							<div class="card flex-fill">
                                <form>
                                    <table class="table" id="" width="100%" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <div class="col-lg-3">
                                                <td>
                                                    <label>Nama</label>
                                                </td>
                                            </div>
                                            <div class="col-lg-3">
                                                <td><label>:</label></td>
                                            </div>
                                            <div class="col-lg-6">
                                                <td>
                                                    <input type="text" class="form-control" name="nama" required disabled value=<?php echo "'$nama'";?>>
                                                </td>
                                            </div>
                                        </tr> 
                                        <?php
                                            $kriteria = mysqli_query($koneksi, "SELECT * FROM kriteria
                                                                                    left join alternatif_bobot on alternatif_bobot.kode_kriteria = kriteria.kode_kriteria
                                                                                    left join subkriteria on subkriteria.id_sub_kriteria = alternatif_bobot.id_sub_kriteria
                                                                                    where alternatif_bobot.id_alternatif = '$id_alternatif' order by kriteria.kode_kriteria") or die(mysqli_error($koneksi));
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
                                                    <td><input name="'.$row['kode_kriteria'].'" class="form-control" value="'.$row['nama_sub_kriteria'].'" disabled/>
                                                </td>
                                                </div>';
                                            echo '<tr>';
                                            }
                                        ?>
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