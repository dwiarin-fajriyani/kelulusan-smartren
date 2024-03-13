<?php
// memanggil library FPDF
require('vendor/fpdf186/fpdf.php');
include 'database.php';
 
// intance object dan memberikan pengaturan halaman PDF
$pdf=new FPDF('P','mm','A4');
$pdf->AddPage();
 
$pdf->SetFont('Times','B',13);
$pdf->Cell(200,10,'PEMERINTAH DAERAH PROVINSI JAWA BARAT',0,0,'C');
 
$pdf->Cell(10,15,'',0,1);
$pdf->SetFont('Times','B',9);
$pdf->Cell(10,7,'NO',1,0,'C');
$pdf->Cell(50,7,'NAMA' ,1,0,'C');
$pdf->Cell(75,7,'ALAMAT',1,0,'C');
$pdf->Cell(55,7,'EMAIL',1,0,'C');


 
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Times','',10);
$no=1;
$nomor = mysqli_real_escape_string($db_conn, $_GET['id']);
$nisn = stripslashes($nomor);
$hasil = mysqli_query($db_conn, "SELECT * FROM un_siswa WHERE nisn='$nisn'");
while($d = mysqli_fetch_array($hasil)){
  $pdf->Cell(10,6, $no++,1,0,'C');
  $pdf->Cell(50,6, $d['nama'],1,0);
  $pdf->Cell(75,6, $d['nama'],1,0);  
  $pdf->Cell(55,6, $d['nama'],1,1);
}
 
$pdf->Output();
 
?>