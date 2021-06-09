<?php
session_start();
$halaman = 'Kriteria';
$idSubKriteria = $_GET['id'];
include '../koneksi.php';
include 'header.php';
$sintaxKriteria = mysqli_query($koneksi, "SELECT * FROM subkriteria where id_sub_kriteria='$idSubKriteria'") or die(mysqli_error($koneksi));
if($data = mysqli_fetch_array($sintaxKriteria)){
    $namaSubKriteria = $data['nama_sub_kriteria'];
    $bobot = $data['nilai'];
}else{
    header("Location:listKriteria.php");
}
?>
       <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Edit Kriteria <?php echo $idSubKriteria ?></h1>
					<div class="row">
						<div class="col-12 d-flex">
							<div class="card flex-fill">
                                <form action=<?php echo '"../action/editSubKriteria.php?id='.$idSubKriteria.'"'; ?> id="my_form" method="post" onsubmit="return validasi();">
                                    <table class="table" id="" width="100%" cellspacing="0">
                                    <tbody>
                                        <?php
                                        if(isset($_SESSION['pesan'])){
                                                echo'
                                                <tr>
                                                    <td colspan="3">
                                                        <div class="alert alert-info alert-dismissible">
                                                        '.$_SESSION['pesan'].'
                                                        </div>
                                                    </td>
                                                </tr>
                                                ';
                                                unset($_SESSION['pesan']);
                                        }
                                        ?>
                                        
                                        <tr>
                                        <div class="row">
                                        <div class="col-lg-3">
                                        <td><label>Sub Kriteria</label></td>
                                        </div>
                                        <div class="col-lg-3">
                                        <td><label>:</label></td></div>
                                        <div class="col-lg-6">
                                        <td><input type="text" class="form-control" name="nama_sub_kriteria"required value=<?php echo "'$namaSubKriteria'"?>></td></div>
                                        </tr>
                                        <tr>
                                        <div class="row">
                                        <div class="col-lg-3">
                                        <td><label>Bobot</label></td>
                                        </div>
                                        <div class="col-lg-3">
                                        <td><label>:</label></td></div>
                                        <div class="col-lg-6">
                                        <td><input type="number"  step=0.001 class="form-control" name="nilai" required  value=<?php echo "'$bobot'"?>></td></div>
                                        </tr>
                                        
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