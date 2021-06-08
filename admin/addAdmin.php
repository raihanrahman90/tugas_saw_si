<?php
session_start();
$halaman = 'Alternatif';
include '../koneksi.php';
include 'header.php';
?>
       <main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12 d-flex">
							<div class="card flex-fill">
              <form action="../action/addAdmin.php" id="my_form" method="post">
                <table class="table" id="" width="100%" cellspacing="0">
                  <tbody>
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Username</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="text" class="form-control" name="username" required></td></div>
                    </tr>
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Password</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="password" class="form-control" name="password" required></td></div>
                    </tr>
                    
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