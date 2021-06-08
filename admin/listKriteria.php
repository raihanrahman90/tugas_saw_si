<?php
    session_start();
    $halaman = 'Kriteria';
    include '../koneksi.php';
	include 'header.php';
?>
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
					<div class="row">
						<div class="col-12 d-flex">
							<div class="card flex-fill">
                                <div class="card-header">
                                    <a href="addKriteria.php" class="btn btn-primary btn-sm">Tambah Kriteria</a>
                                </div>
								<table class="table table-hover my-0">
									<thead>
										<tr>
											<th>No</th>
											<th class="d-none d-xl-table-cell">Kode Kriteria</th>
											<th class="d-none d-xl-table-cell">Nama Kriteria</th>
											<th>Bobot</th>
											<th class="d-none d-md-table-cell">Tipe</th>
											<th class="d-none d-md-table-cell">Aksi</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
                                        ###login sebagai unit
                                        $mahasiswa = mysqli_query($koneksi, "SELECT * FROM kriteria") or die(mysqli_error($koneksi));
                                        $edit =false;
                                        $no = 1;
                                        foreach ( $mahasiswa as $row){
                                            echo "<tr>
                                                <td>".$no++."</td>
                                                <td>".$row['kode_kriteria']."</td>
                                                <td>".$row['nama_kriteria']."</td>
                                                <td>".$row['bobot']."</td>
                                                <td>".$row['tipe']."</td>
                                                    <td>
                                                    <a href='editKriteria.php?id=".$row['kode_kriteria']."' class='btn btn-success btn-circle btn-sm'>
                                                        Edit
                                                    </a>
                                                    <a href='../action/deleteKriteria.php?id=".$row['kode_kriteria']."' class='btn btn-danger btn-circle btn-sm' name='hapus' onclick='return";
                                                        echo ' confirm("Apakah ingin menghapus kriteria '.$row['nama_kriteria'].'?")';
                                                        echo"'>Delete
                                                    </a>
                                                    <a href='listSubKriteria.php?id=".$row['kode_kriteria']."' class='btn btn-info btn-circle btn-sm'>
                                                        Sub Kriteria
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