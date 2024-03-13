<?php
include "../database.php";
// echo '<script type ="text/JavaScript">';  
// echo 'alert("Catatan: untuk cetak tekan klik kanan pada halaman ini kemudian pilih cetak/print, atur ukuran kerta ke Folio/F4")';  
// echo '</script>';  
//qrcode
	include "../phpqrcode/qrlib.php";    // Ini adalah letak pemyimpanan plugin qrcode

	$tempdir = "../qrcode-img/";        // Nama folder untuk pemyimpanan file img qrcode

	if (!file_exists($tempdir))        //jika folder belum ada, maka buat
	mkdir($tempdir);
//qrcode end


if (isset($_POST['submit'])){
	$no_ujian = base64_decode(base64_decode(($_POST['nomor'])));
	$nomor = mysqli_real_escape_string($db_conn, $no_ujian);
	$no_ujian = stripslashes($nomor);

	$hasil = mysqli_query($db_conn, "SELECT * FROM un_siswa WHERE no_ujian='$no_ujian'");
	if (mysqli_num_rows($hasil) > 0) {
		$data = mysqli_fetch_array($hasil);
		$no_ujian = htmlspecialchars($data['no_ujian']);
		$nama = htmlspecialchars($data['nama']);
		$nis = htmlspecialchars($data['nis']);
		$nisn = htmlspecialchars($data['nisn']);
		$kelas = htmlspecialchars($data['kelas']);
		$keterangan = htmlspecialchars($data['keterangan']);
		$predikat = htmlspecialchars($data['predikat']);
		
		$status = htmlspecialchars($data['status']);

	} else{
		header('Location: ../');
	}

	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
		<meta name=Generator content="Microsoft Word 15 (filtered)">
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="../img/<?= $hsl['logo'] ?>">
		<title>Cetak SKL <?=$nama;?></title>
	<style>
	
	.cap {
		visibility: visible;
		background-image: url(../img/cap.png) !important;
		background-position: 77%;
		background-repeat: no-repeat;
		background-size: 22%;
		-webkit-print-color-adjust: exact;
		}
	.cap-said {
		visibility: visible;
		//background-image: url(../img/cap.png) !important;
		background-position: 77%;
		background-repeat: no-repeat;
		background-size: 22%;
		-webkit-print-color-adjust: exact;
	}
	
	</style>


	</head>
	<body onload="window.print()">
	<center>
		<!-- Halaman Satu -->
	<table cellpadding="1" width="50%" border="0">
	<tr>
	<td>
	<div class=WordSection1>
		<center><img height=150 src="../img/kopsurat-2.png"></center>

		<center>
			<b>Surat Keterangan Membaca Al-Quran</b> <br>
			Nomor : <?=$no_surat;?> <br><br>
		</center>
	
		Yang bertanda tangan dibawah ini Kepala SMK Negeri 2 Sumedang Provinsi Jawa Barat, menerangkan bahwa; <br>

		<table cellspacing="0" cellpadding="2" border="0">
			<tr>
				<td width="230">Nama </td>
				<td>&nbsp; :&nbsp;&nbsp;</td>
				<td> <?=$nama;?> </td>
			</tr>
			
			<tr>
				<td>Nomor Induk Siswa Nasional</td>
				<td>&nbsp; :&nbsp;&nbsp;</td>
				<td><?=$nisn;?> </td>
			</tr>
			
		</table>
		<br>Yang bersangkutan benar benar siswa SMK Negeri 2 Sumedang tahun pelajaran 2023/2024.
		<table cellspacing="0" cellpadding="1" border="0">
			<tr>
				<td width="230">Keterangan </td>
				<td>&nbsp;:&nbsp;&nbsp;</td>
				<td> <strong>Mampu membaca Al-Qur’an dengan Predikat  <?=$keterangan;?> (<?=$predikat;?>) </strong></td>
			</tr>
			
		</table>
		Penilaian/Daftar Nilai  Terlampir 

		<br><br>Demikian surat ini dibuat untuk dipergunakan sebagaimana mestinya.<br><br>
		</center>

			<table class="cap" border="0" >
				<tr> 
					<td width="65%"  >
					
						
					</td>
					<td width="35%" valign="top">
							Sumedang, 7 Maret 2024 <br> Kepala Sekolah,
							<img style="width: 129px; height: 67px" src="../img/<?= $hsl['ttd'] ?>" >
							<br>
							
							<u>
							<b><?=$kepsek;?></b>
							</u>
							<br>
							NIP. <?=$nip;?>
					</td>
				</tr>
			</table>
		</div>
		</div>
		</td>
		</tr>
		</table>
		</center>
	<div style="page-break-before:always;"></div>	
	<center>
	<table cellpadding="1" width="50%" border="0">
	<tr>
	<td>
	<div class=WordSection1>
		<center><img height=150 src="../img/kopsurat-2.png"></center>

		<center>
			<b>PENILAIAN BACA QUR’AN (PBQ)</b> <br>
			 <br><br>
		</center>

		<table cellspacing="0" cellpadding="2" border="0">
			<tr>
				<td width="230">Nama </td>
				<td>&nbsp; :&nbsp;&nbsp;</td>
				<td> <?=$nama;?> </td>
			</tr>
			
			<tr>
				<td>Nomor Induk Siswa Nasional</td>
				<td>&nbsp; :&nbsp;&nbsp;</td>
				<td><?=$nisn;?> </td>
			</tr>
			
		</table>
		<br><br>
		<center>
		<table border="1" cellpadding="2" cellspacing="0">
			
				<thead align="center" bgcolor="#DEEAF6">
					<td width="47" height="30">
						<strong>No.</strong>
					</td>
					<td width="454">
						<strong>Uraian</strong>
					</td>
					<td width="123">
						<strong>Nilai </strong>
					</td>
				</thead>
			<tbody>
				<tr>
							<!-- // htmlspecialchars() digunakan agar tidak mengeksekusi kode html-->
							<td class="text-center" align="center">1. </td>
							<td>Makhrojul Huruf</td>
							<td class="text-center" align="center"><?= htmlspecialchars($data['predikat']); ?></td>
						</tr>
						<tr>
							<td class="text-center" align="center">2. </td>
							<td>Shiftul Huruf </td>
							<td class="text-center" align="center"><?= htmlspecialchars($data['predikat']); ?></td>
						</tr>
						<tr>
							<td class="text-center"align="center">3. </td>
							<td>Ahkamul Waqf Wal- Ibtida</td>
							<td class="text-center" align="center"><?= htmlspecialchars($data['predikat']); ?></td>
						</tr>
						<tr>
							
							<td colspan="3"><strong>Keterangan</strong> <br> <i><?= htmlspecialchars($data['ket_pbq']); ?></i></td>
						</tr>
				<tr>
				
			</tbody>
		</table>
		</center>
			<!-- <?php 
				// berikut adalah parameter qr code
				// $teks_qrcode    ="SKL: ".$no_surat.", ".$nama.", ".$no_ujian.", ".$nis.", ".$nisn.", ".$status;
				// $namafile       ="qrc-".$no_ujian.".png";
				// $quality        ="H"; // ini ada 4 pilihan yaitu L (Low), M(Medium), Q(Good), H(High)
				// $ukuran         =7; // 1 adalah yang terkecil, 10 paling besar
				// $padding        =1;
				// QRCode::png($teks_qrcode, $tempdir.$namafile, $quality, $ukuran, $padding);
				// qrcode berakhir
			?>
 -->
<br><br>
			<table class="cap-said" border="0" >
				<tr> 
					<td width="55%"  >
					
						
					</td>
					<td width="45%" valign="top">
							Sumedang, 7 Maret 2024 <br> Ketua Dewan Hakim/Penguji, <br>
							<img style="width: 129px; height: 67px" src="../img/ttd-said_harismansyah.png" alt="ttd pa said">
							<br>
							
							<u>
							<b>Dr.Said Harismansyah,S.Pd.I,M.Pd.,M.Ag</b>
							</u>
							<br>
							NIP. <?=$nip;?>
					</td>
				</tr>
			</table>
		</div>
		</div>
		</td>
		</tr>
		</table>
		</center>

	</body>
	</html>


<?php 
} else{
	header('Location: ../');
}

?>
