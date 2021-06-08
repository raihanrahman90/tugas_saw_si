<?php
$halaman = 'Kriteria';
session_start();
include 'header.php';
?>
       <main class="content">
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3"><strong>Ganti Password</h1>
					<div class="row">
						<div class="col-12 d-flex">
							<div class="card flex-fill">
                                <form action="../action/changePassword.php" id="my_form" method="post">
                                    <table class="table" id="" width="100%" cellspacing="0">
                                        <tbody>
                                            <?php
                                                if(isset($_SESSION['pesan'])){
                                                    if($_SESSION['pesan']=='Berhasil'){
                                                        echo'
                                                        <tr>
                                                            <td colspan="3">
                                                                <div class="alert alert-info alert-dismissible">
                                                                Password berhasil diganti
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        ';
                                                        unset($_SESSION['pesan']);
                                                    }else{
                                                        echo'
                                                        <tr>
                                                            <td colspan="3">
                                                                <div class="alert alert-warning alert-dismissible">
                                                                Password anda salah
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        ';
                                                        unset($_SESSION['pesan']);
                                                    }
                                                }
                                            ?>
                                            <tr>
                                            <div class="row">
                                            <div class="col-lg-3">
                                            <td><label>Password Lama</label></td>
                                            </div>
                                            <div class="col-lg-3">
                                            <td><label>:</label></td></div>
                                            <div class="col-lg-6">
                                            <td><input type="password" class="form-control" name="password" required></td></div>
                                            </tr>
                                            
                                            <tr>
                                            <div class="row">
                                            <div class="col-lg-3">
                                            <td><label>Password Baru</label></td>
                                            </div>
                                            <div class="col-lg-3">
                                            <td><label>:</label></td></div>
                                            <div class="col-lg-6">
                                            <td><input type="text" class="form-control" name="password_baru" required></td></div>
                                            </tr>
                                            
                                            <tr>
                                            
                                            <td colspan="3">
                                                <button type="submit" class="btn btn-info float-right">Ganti Password</button>        
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