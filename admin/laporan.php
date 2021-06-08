<?php
// (c) Xavier Nicolay
// Exemple de g�n�ration de devis/facture PDF
require('./laporan/invoice.php');
require('../koneksi.php');

$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->addSociete( "Laporan Hasil Penilaian",
                  " ");
$cols=array( "No"    => 20,
             "Nama Alternatif"    => 60,
             "Hasil"    => 30);
$pdf->addCols( $cols, 30);
$cols=array( "No"    =>  "No",
                "Nama Alternatif"    =>  "Nama Alternatif",
                "Hasil"    =>  "Hasil");
$pdf->addLineFormat($cols);

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
    $id_alternatif = $row['id_alternatif'];
    $dataAlternatif['nama_alternatif'] = $row['nama'];
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
        $nilaiV += $kriteria['bobot']*$normalisasi;
    }
    $dataAlternatif['nilaiV']=$nilaiV;
    array_push($alternatifBobot, $dataAlternatif);
}

usort($alternatifBobot, function ($item1, $item2) {
    return $item2["nilaiV"] <=> $item1["nilaiV"];
});
$y    = 40;
$no     =1;
foreach($alternatifBobot as $alternatif){
    $line = array(  "No" => $no,
                    "Nama Alternatif" => $alternatif['nama_alternatif'],
                    "Hasil" => $alternatif['nilaiV']);
    $size = $pdf->addLine($y, $line);
    $y +=$size+2;
    $no++;
}

$pdf->Output();
?>
