<?php
    session_start();
    $halaman = 'Admin';
    include '../koneksi.php';
	include 'header.php';
?>
			<main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12 d-flex">
							<div class="card flex-fill">
                                <div class="card-header">
                                    <a href="addAdmin.php" class="btn btn-primary btn-sm">Tambah Admin</a>
                                </div>
								<table class="table table-hover my-0">
									<thead>
										<tr>
											<th>No</th>
											<th class="d-none d-xl-table-cell">Username</th>
											<th class="d-none d-md-table-cell">Aksi</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
                                        ###login sebagai unit
                                        $mahasiswa = mysqli_query($koneksi, "SELECT * FROM login") or die(mysqli_error($koneksi));
                                        $edit =false;
                                        $no = 1;
                                        foreach ( $mahasiswa as $row){
                                            echo "<tr>
                                                <td>".$no++."</td>
                                                <td>".$row['username']."</td>
                                                    <td>
                                                    <a href='editAdmin.php?id=".$row['username']."' class='btn btn-success btn-circle btn-sm'>
                                                        Edit
                                                    </a>
                                                    <a href='../action/deleteAdmin.php?id=".$row['username']."' class='btn btn-danger btn-circle btn-sm' name='hapus' onclick='return";
                                                        echo ' confirm("Apakah ingin menghapus admin '.$row['username'].'?")';
                                                        echo"'>Delete
                                                    </a>
                                                </td>
                                                </tr>";               
                                        }
                                        ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div>
			</main>
<?php 
	include 'footer.php';
?>