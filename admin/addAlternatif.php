<?php
session_start();
$halaman = 'Alternatif';
include '../koneksi.php';
include 'header.php';
?>
       <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
					<div class="row">
						<div class="col-12 d-flex">
							<div class="card flex-fill">
              <form action="../action/addAlternatif.php" id="my_form" method="post">
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
                      <td><input type="text" class="form-control" name="nama" required></td></div>
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
                                <td>';
                            echo '<select name="'.$row['kode_kriteria'].'" class="form-control">';
                            $subkriteria= mysqli_query($koneksi, "SELECT * from subkriteria where kode_kriteria='".$row["kode_kriteria"]."' order by nilai");
                            foreach($subkriteria as $row){
                              echo '<option value="'.$row['id_sub_kriteria'].'">'.$row['nama_sub_kriteria'].'</option>';
                            }
                            echo '</select>
                              </td>
                              </div>';
                          echo '<tr>';
                        }
                    ?>
                    
                    <tr>
                      
                      <td colspan="3">
                        <button type="submit" class="btn btn-info float-right">Tambah</button>        
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