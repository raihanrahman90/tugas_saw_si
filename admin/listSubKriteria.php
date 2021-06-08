<?php
    session_start();
    $kodeKriteria = $_GET['id'];
    $halaman ='Kriteria';
    include '../koneksi.php';
	include 'header.php';
    $sintaxKriteria = mysqli_query($koneksi, "SELECT * FROM kriteria where kode_kriteria='$kodeKriteria'") or die(mysqli_error($koneksi));
    if($data = mysqli_fetch_array($sintaxKriteria)){
        $namaKriteria = $data['nama_kriteria'];
        $bobot = $data['bobot'];
        $tipe = $data['tipe'];
    }else{
        header("Location:listKriteria.php");
    }
?>
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Sub Kriteria <?php  echo $kodeKriteria; ?></h1>
					<div class="row">
						<div class="col-12 d-flex">
							<div class="card flex-fill">
                                
								<div class="card-body">
									<h5 class="h6 card-title">About</h5>
									<ul class="list-unstyled mb-0">
										<li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> <?php echo $kodeKriteria." - ".$namaKriteria?></li>

										<li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> <?php echo  "Bobot ".$bobot; ?></li>
										<li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> <?php echo "Tipe ".$tipe; ?></li>
									</ul>
								</div>
								<div class="card-header">

                                <a href=<?php echo "addSubKriteria.php?id=".$kodeKriteria ?> class="btn btn-primary btn-sm">Tambah Sub Kriteria</a>
								</div>
								<table class="table table-hover my-0">
									<thead>
										<tr>
                                            <th>No</th>
                                            <th>Nama Sub Kriteria</th>
                                            <th>Bobot</th>
                                            <th>Lakukan</th> 
										</tr>
									</thead>
									<tbody>
                                    <?php
                                        $mahasiswa = mysqli_query($koneksi, "SELECT * FROM subkriteria where kode_kriteria='$kodeKriteria' order by nilai") or die(mysqli_error($koneksi));
                                        $edit =false;
                                        $no = 1;
                                        foreach ( $mahasiswa as $row){
                                            echo "<tr>
                                                <td>".$no++."</td>
                                                <td>".$row['nama_sub_kriteria']."</td>
                                                <td>".$row['nilai']."</td>
                                                    <td>
                                                    <a href='editSubKriteria.php?id=".$row['id_sub_kriteria']."' class='btn btn-info btn-circle btn-sm'>
                                                        Edit
                                                    </a>
                                                    <a href='../action/deleteSubKriteria.php?id=".$row['id_sub_kriteria']."' class='btn btn-danger btn-circle btn-sm' name='hapus' onclick='return";
                                                        echo ' confirm("Apakah ingin menghapus subkriteria '.$row['nama_sub_kriteria'].'?")';
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