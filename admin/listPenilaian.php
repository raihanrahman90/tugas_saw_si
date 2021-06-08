<?php
    session_start();
    $halaman = 'Penilaian';
    include '../koneksi.php';
	include 'header.php';
    $listKriteria=[];
    $queryKriteria = mysqli_query($koneksi,"SELECT * FROM kriteria") or die(mysqli_error($koneksi));
    while($kriteria = mysqli_fetch_array($queryKriteria)){
        $listKriteria[$kriteria['kode_kriteria']] = [
                                                        'nama_kriteria'=>$kriteria['nama_kriteria'],
                                                        'bobot'=>$kriteria['bobot'],
                                                        'tipe'=>$kriteria['tipe']
                                                    ];
    }
    
    $queryNormalisasi = mysqli_query($koneksi, "SELECT MIN(nilai), MAX(nilai), kriteria.kode_kriteria,tipe FROM kriteria 
                                                    inner join alternatif_bobot on alternatif_bobot.kode_kriteria = kriteria.kode_kriteria 
                                                    inner join subkriteria on alternatif_bobot.id_sub_kriteria = subkriteria.id_sub_kriteria
                                                    group by kriteria.kode_kriteria") or die(mysqli_error($koneksi));
    while($row = mysqli_fetch_array($queryNormalisasi)){
        $listKriteria[$row['kode_kriteria']]['Min']= $row['MIN(nilai)'];
        $listKriteria[$row['kode_kriteria']]['Max']= $row['MAX(nilai)'];
    }
    $jumlahKriteria = count($listKriteria);

    
    $alternatif = mysqli_query($koneksi, "SELECT * FROM alternatif") or die(mysqli_error($koneksi));
    $alternatifBobot = [];

    foreach ( $alternatif as $row){
        $nilaiV = 0;
        $dataAlternatif = ['kriteria'=>[]];
        $id_alternatif = $row['id_alternatif'];
        $dataAlternatif['nama_alternatif'] = $row['nama'];
        $dataAlternatif['id_alternatif'] = $id_alternatif;
        $query = mysqli_query($koneksi,"SELECT * FROM kriteria 
                                        left join alternatif_bobot on alternatif_bobot.kode_kriteria = kriteria.kode_kriteria
                                        inner join subkriteria on alternatif_bobot.id_sub_kriteria = subkriteria.id_sub_kriteria
                                        where id_alternatif='$id_alternatif' order by kriteria.kode_kriteria");
        while($alternatif = mysqli_fetch_array($query)){
            $kriteria = $listKriteria[$alternatif['kode_kriteria']];
            if($kriteria['tipe']=='Cost'){
                $normalisasi = round($kriteria['Min']/$alternatif['nilai'], 2);
            }else{
                $normalisasi = round($alternatif['nilai']/$kriteria['Max'],2);
            }
            $listKriteria[
                    $alternatif['kode_kriteria']
                ]['alternatif'][
                    $alternatif['id_alternatif']
                 ]['normalisasi'] = $normalisasi;
            $listKriteria[
                    $alternatif['kode_kriteria']
                ]['alternatif'][
                    $alternatif['id_alternatif']
                ]['nilai'] = $alternatif['nilai'];
            $nilaiV += $kriteria['bobot']*$normalisasi;
            $dataAlternatif['kriteria'][$alternatif['kode_kriteria']] = [
                                                                'id_sub_kriteria'=>$alternatif['id_sub_kriteria'],
                                                                'sub_kriteria'=>[
                                                                                    'nama_sub_kriteria'=>$alternatif['nama_sub_kriteria'],
                                                                                    'nilai'=>$alternatif['nilai'],
                                                                                    'normalisasi'=>$normalisasi,
                                                                                    'bobot'=>$kriteria['bobot'],
                                                                                    'V'=>$normalisasi*$kriteria['bobot']
                                                                                ]
                                                            ];
        }
        $dataAlternatif['nilaiV']=$nilaiV;
        array_push($alternatifBobot, $dataAlternatif);
    }
?>
			<main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12 d-flex">
							<div class="card flex-fill">
                                <div class="card-header">
                                    <a href="addAlternatif.php" class="btn btn-primary btn-sm">Tambah Alternatif</a>
                                </div>
								<table class="table table-hover my-0">
									<thead>
										<tr>
											<th>No</th>
											<th class="d-none d-xl-table-cell">Nama Alternatif</th>
                                            <?php
                                                foreach($listKriteria as $kriteria){
                                                    echo  "<th class='d-none d-xl-table-cell'>".$kriteria['nama_kriteria']."</th>";
                                                }
                                            ?>
										</tr>
									</thead>
									<tbody>
                                        <?php
                                            $no = 1;
                                            foreach($alternatifBobot as $alternatif){
                                                echo "
                                                    <tr>
                                                        <td>$no</td>
                                                        <td>".$alternatif['nama_alternatif']."</td>";
                                                        foreach($alternatif['kriteria'] as $bobotKriteria){
                                                            $namaSubKriteria=$bobotKriteria['sub_kriteria']['nama_sub_kriteria'];
                                                            echo "<td>$namaSubKriteria</td>";
                                                        }
                                                echo "                                                    
                                                    </tr>
                                                ";
                                                $no++;
                                            }
                                        ?>
									</tbody>
								</table>
                            </div>
                        </div>        
						<div class="col-12 d-flex">
							<div class="card flex-fill">
								<table class="table table-hover my-0">
									<thead>
										<tr>
											<th>Id</th>
											<th class="d-none d-xl-table-cell">Nama Alternatif</th>
                                            <?php
                                                foreach($listKriteria as $kodeKriteria=>$kriteria){
                                                    echo  "<th class='d-none d-xl-table-cell'>".$kodeKriteria."</th>";
                                                }
                                            ?>
										</tr>
									</thead>
                                    
									<tbody>
                                        <?php
                                            $no = 1;
                                            foreach($alternatifBobot as $alternatif){
                                                echo "
                                                    <tr>
                                                        <td>$no</td>
                                                        <td>".$alternatif['nama_alternatif']."</td>";
                                                        foreach($alternatif['kriteria'] as $bobotKriteria){
                                                            $namaSubKriteria=$bobotKriteria['sub_kriteria']['nilai'];
                                                            echo "<td>$namaSubKriteria</td>";
                                                        }
                                                echo "                                                    
                                                    </tr>
                                                ";
                                                $no++;
                                            }
                                        ?>
									</tbody>
								</table>
                            </div>
                        </div>
						<div class="col-12 d-flex">
							<div class="card flex-fill">
                                <div class="card-header">
                                    Matriks Normalisasi
                                </div>
                                <div class="card-body">
                                    <?php
                                        $x=1;
                                        foreach($listKriteria as $kodeKriteria=>$kriteria){
                                            echo "<h3 class='card-title'>".$kodeKriteria."</h3>";
                                            if($kriteria['tipe']=='Cost'){
                                                $pembagi = $kriteria['Min'];
                                            }else{
                                                $pembagi = $kriteria['Max'];
                                            }
                                            echo "<h3 class='card-title'>Maximal = $pembagi</h3>";
                                            $y=1;
                                            foreach($kriteria['alternatif'] as $id_alternatif=>$alternatif){
                                                $nilai = $alternatif['nilai'];
                                                $normalisasi = $alternatif['normalisasi'];
                                                echo "r$y$x = $pembagi/$nilai = $normalisasi<br/>";
                                                $y++;
                                            }
                                            $x++;
                                            echo "<br/>";
                                        }
                                    ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
							<div class="card flex-fill">
                                <div class="card-header">
                                    <div class="card-title">
                                        Hasil matriks normalisasi
                                    </div>
                                </div>
								<table class="table table-hover my-0">
									<tbody>
                                        <?php
                                            $no = 1;
                                            foreach($alternatifBobot as $alternatif){
                                                echo "
                                                    <tr>";
                                                        foreach($alternatif['kriteria'] as $bobotKriteria){
                                                            $normalisasi=$bobotKriteria['sub_kriteria']['normalisasi'];
                                                            echo "<td>$normalisasi</td>";
                                                        }
                                                echo "                                                    
                                                    </tr>
                                                ";
                                                $no++;
                                            }
                                        ?>
									</tbody>
								</table>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
							<div class="card flex-fill">
                                <div class="card-header">
                                    <div class="card-title">
                                        Bobot Preferensi
                                    </div>
                                    <div class="card-title">
                                        W = [
                                        <?php
                                            $index = 0;
                                            foreach($listKriteria as $kriteria){
                                                if($index==$jumlahKriteria-1){
                                                    echo $kriteria['bobot'];
                                                }else{
                                                    echo $kriteria['bobot'].",";
                                                }
                                                $index++;
                                            }
                                        ?>
                                        ]
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
							<div class="card flex-fill">
								<table class="table table-hover my-0" id="dataTable">
                                    
                                    <thead>
                                        <tr>
                                            <td>Nama Alternatif</td>
                                            <td>Perhitungan</td>
                                            <td>hasil</td>
                                        </tr>
                                    </thead>
									<tbody>
                                        <?php
                                            $no = 1;
                                            foreach($alternatifBobot as $alternatif){
                                                echo "
                                                    <tr>
                                                        <td>".$alternatif['nama_alternatif']."</td>
                                                        <td>";
                                                        $index = 0;
                                                        foreach($alternatif['kriteria'] as $bobotKriteria){
                                                            $normalisasi=$bobotKriteria['sub_kriteria']['normalisasi'];
                                                            $bobot=$bobotKriteria['sub_kriteria']['bobot'];
                                                            if($index == $jumlahKriteria-1){
                                                                echo "($bobot)($normalisasi)";
                                                            }else{
                                                                echo "($bobot)($normalisasi)+";
                                                            }
                                                            $index++;
                                                        }
                                                        echo"</td>
                                                        <td>".$alternatif['nilaiV']."</td>                 
                                                    </tr>
                                                ";
                                                $no++;
                                            }
                                        ?>
									</tbody>
								</table>
                                <div class="card-header">
                                    <a class="btn btn-primary btn-sm" href="laporan.php">Buat Laporan PDF</a>
                                </div>
                            </div>
                        </div>

					</div>

				</div>
			</main>
<?php 
	include 'footer.php';
?>