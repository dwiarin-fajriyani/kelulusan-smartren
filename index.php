<?php
include "header.php";
// $qconfig = mysqli_query($db_conn, "SELECT * FROM un_konfigurasi");
// $hsl = mysqli_fetch_array($qconfig);
?>

<div class="container">
<div class="align text-center" >

	<img src="img/<?= $hsl['logo'] ?>" style="width: 120px;float: none;margin-top: 40px; margin-Bottom: 17px;"> 
	<br>
	<label style=" font-size:40px;">
		PENGUMUMAN SMARTTREN 
	</label><br>
	<label style=" font-size:20px;">
		<?= $hsl['sekolah'] ?> <br>
		<?php 
		echo "TAHUN PELAJARAN 2023/2024";
		?>
	</label>
</div>

	<!-- countdown -->

	<div id="clock" class="lead"></div>

	<div id="xpengumuman">
		<?php
		if (isset($_POST['submit'])) {
			//tampilkan hasil queri jika ada
			$nomor = mysqli_real_escape_string($db_conn, $_POST['nomor']);
			$no_ujian = stripslashes($nomor);

			$hasil = mysqli_query($db_conn, "SELECT * FROM un_siswa WHERE no_ujian='$no_ujian'");
			if (mysqli_num_rows($hasil) > 0) {
				$data = mysqli_fetch_array($hasil);

		?>
				<table class="table table-bordered table-responsive table-hover ">
					<tr class="">
						<td colspan="2" class="text text-center "><label class=" navmenu-text">Data Siswa</label></td>
					</tr>

					<tr>
						<td>Nomor Induk Nasional</td>
						<td><?= htmlspecialchars($data['no_ujian']); ?></td>
					</tr>
					<tr>
						<td>Nama Siswa</td>
						<td><?= htmlspecialchars($data['nama']); ?></td>
					</tr>
					<tr>
						<td>Kelas</td>
						<td><?= htmlspecialchars($data['kelas']); ?></td>
					</tr>
				</table>
				<table class="table table-bordered table-responsive table-hover">
					<thead>
						<tr>
							<th  style="vertical-align: middle; text-align: center;">No</th>
							<th  style="vertical-align: middle; text-align: center;">Uraian</th>
							<th  style="vertical-align: middle; text-align: center;">Nilai</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="3"> <b> Penilaian Baca Al-Qura'an</b></td>

						</tr>
						<tr>
							<!-- // htmlspecialchars() digunakan agar tidak mengeksekusi kode html-->
							<td class="text-center">1. </td>
							<td>Makhrojul Huruf</td>
							<td class="text-center"><?= htmlspecialchars($data['predikat']); ?></td>
						</tr>
						<tr>
							<td class="text-center">2. </td>
							<td>Shiftul Huruf </td>
							<td class="text-center"><?= htmlspecialchars($data['predikat']); ?></td>
						</tr>
						<tr>
							<td class="text-center">3. </td>
							<td>Ahkamul Waqf Wal- Ibtida</td>
							<td class="text-center"><?= htmlspecialchars($data['predikat']); ?></td>
						</tr>
						<tr>
							
							<td colspan="3">Keterangan <br> <i><?= htmlspecialchars($data['ket_pbq']); ?></i></td>
						</tr>					
						
						<!-- <tr>
								<td colspan="4">Kelompok C</td>
							</tr>
							<tr>
								<td class="text-center">1. </td>
								<td>Kejuruan</td>
								<td class="text-center"><?= htmlspecialchars($data['n_kejuruan']); ?></td>
								<td class="text-center "><?= htmlspecialchars($data['us_kejuruan']); ?></td>
							</tr> -->
						<!-- <tr>
							<td colspan="2"class="text-center"> <b>Rata-rata </b></td>
							<td class="text-center"><?= htmlspecialchars($data['rata2']);?></td>
						</tr> -->
					</tbody>
				</table>
				<?php 
				$no_ujian = base64_encode(base64_encode(htmlspecialchars($data['no_ujian']))); ?>
				<form method="post" action="print/" target="_blank">
						<center> 
						<div class="alert alert-success" role="alert">
							
							<br><i>Cetak surat keterangan :</i> &nbsp; &nbsp; <br>
							<input type="hidden" name="nomor" value="<?=$no_ujian;?>">
							<Button class="btn-primary" type="submit" name="submit"><i class="fa fa-print"> </i> &nbsp; CETAK </Button>
							<!-- <a href="print.php?id=<?= htmlspecialchars($data['nisn']);?>" class=" btn btn-primary" type="button" name="download"><i class="fa fa-print"> </i> &nbsp; PRINT </a> -->
							<!-- <a href="download.php?file=<?= htmlspecialchars($data['kls']."_".$data['nama']); ?>_0001.pdf" class=" btn btn-primary" type="button" name="download"><i class="fa fa-print"> </i> &nbsp; DOWNLOAD </a> -->
						</div> 
						</center>
					</form>
				

			<?php
			} else {
				echo '<div class="alert alert-warning"> <font color="#F0F8FF" >  Nomor ujian yang anda masukankan tidak ditemukan !<br>  Periksa kembali nomor ujian anda.</font></div>';
				echo '<br><center><a href="./"><button class="btn btn-primary">KEMBALI</button></a></center> <br>';
				echo '<center><img height="240px" src="img/notfound.gif" alt="data tidak di temukan" title="data tidak di temukan"></center>';
				//tampilkan pop-up dan kembali tampilkan form
			}
		} else {
			//tampilkan form input nomor ujian
			?>
		
		<center style="float: top;font-size: 16px;color: #008000"><p>Masukkan NISN (Nomor Induk Siswa Nasional) untuk mengecek status kelulusan</p></center>
		
		<form method="post">
				<div class="input-group" class=" alert-dismissable">
					<!-- <input type="text" name="nomor" class="form-control" style=" font-size:20px;" data-mask="<?= $nopesformat; ?>" placeholder="Nomor Ujian" required> -->
					<input type="text" name="nomor" class="form-control" style=" font-size:20px;" placeholder="Nomor Induk Siswa Nasional (NISN)" required>
					<span class="input-group-btn">
						<button class="btn btn-primary" type="submit" name="submit">
							C E K !
						</button>
					</span>
				</div>
			</form>
		<?php
		}
		?>
	</div>
</div><!-- /.container -->




<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jasny-bootstrap.min.js"></script>
<script type="text/javascript">
	var skrg = Date.now();
	$('#clock').countdown("<?= $tgl_pengumuman; ?>", {
			elapse: true
		})
		.on('update.countdown', function(event) {
			var $this = $(this);
			if (event.elapsed) {
				$("#xpengumuman").show();
				$("#clock").hide();
			} else {
				$this.html(event.strftime(
					'<center> Pengumuman dapat dilihat pada waktu : <?= $waktu; ?> <br><b><div class="alert alert-warning"><span>%D Hari %H Jam %M Menit %S Detik</span> lagi <center></div></b>'));
				$("#xpengumuman").hide();
			}
		});
</script>

<?php
include "footer.php"
?>