<?php
session_start();
$halaman = 'Kriteria';
include 'header.php';
?>
       <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
					<div class="row">
						<div class="col-12 d-flex">
							<div class="card flex-fill">
              <form action="../action/addSubKriteria.php" method="post" onsubmit="return validasi();">
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
                      <td><label>Nama Sub Kriteria</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="text" class="form-control" name="nama_subkriteria"required></td></div>
                    </tr>
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Bobot</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="number" step=0.001 class="form-control" name="bobot" id="bobot"required></td></div>
                    </tr>
                    
                    <tr>
                      
                      <td colspan="3">
                        <button type="submit" class="btn btn-info float-right">Tambah</button>        
                      </td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" value=<?php echo "'".$_GET['id']."'";?> name="id">
              </form>
							</div>
						</div>
					</div>

				</div>
			</main>
      <!-- End of Main Content -->
<?php include 'footer.php';
?>