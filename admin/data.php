<?php
session_start();
if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
	include "../database.php";
	include '_header.php';
?>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


	<div class="container">
		<h2>Data Kelulusan</h2>
		<hr>
		<div class="row col-sm-8">
			<form class="form-horizontal well" method="post" action="data_upload.php" enctype="multipart/form-data">
				<div class="form-group">
					<label for="importCsv" class="col-sm-3 control-label">CSV/Excel File</label>
					<div class="col-sm-9">
						<div class="fileinput fileinput-new input-group" data-provides="fileinput">
							<div class="form-control" data-trigger="fileinput">
								<i class="glyphicon glyphicon-file fileinput-exists"></i>
								<span class="fileinput-filename"></span>
							</div>
							<span class="input-group-addon btn btn-default btn-file">
								<span class="fileinput-new">Pilih file</span>
								<span class="fileinput-exists">Ganti</span>
								<input type="file" name="file" accept=".csv">
							</span>
							<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Buang</a>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">
						<a href="../files/nilai_siswa_22.csv"> <button type="button" name="download" class="btn btn-default">Download Template</button> </a>
						<button type="submit" name="submit" class="btn btn-default">Upload File</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="container">
			<!-- input Cari data -->
			<form action="data.php" method="get">
				<div class="control-label ">
					<input type="text" name="cari" class="col-sm-3 " style="height:43px"> &nbsp;
					<input type="submit" class="btn btn-primary" value=" Cari">
				</div>
			</form>
			
<br>
			<!-- Wilayah Tabel -->
			<div class="table table-responsive wrapper">

				<table class="table table-bordered table-hover table-striped table-fixed header-fixed table-fixed head">
					<thead>
						<tr class="">
							<th rowspan="2" style=" min-width:40px; vertical-align: middle; text-align: center;">
								No.
							</th>
							<th rowspan="2" style=" min-width:120px; vertical-align: middle; text-align: center;">
								<a href="<?php $_SERVER['PHP_SELF'] ?>?by=no_ujiana"><span class="fa fa-arrow-up"></span></a>
								NO. Ujian
								<a href="<?php $_SERVER['PHP_SELF'] ?>?by=no_ujianb"><span class="fa fa-arrow-down"></span></a>
							</th>

							<th rowspan="2" style=" min-width:120px; vertical-align: middle; text-align: center;">
								NIS
							</th>

							<th rowspan="2" style=" min-width:120px; vertical-align: middle; text-align: center;">
								NISN
							</th>

							<th rowspan="2" style=" min-width:13em; vertical-align: middle; text-align: center;"">
							<a href=" <?php $_SERVER['PHP_SELF'] ?>?by=namaa"><span class="fa fa-arrow-up"></span></a>
								Nama Siswa
								<a href="<?php $_SERVER['PHP_SELF'] ?>?by=namab"><span class="fa fa-arrow-down"></span></a>
							</th>

							<th rowspan="2" style=" min-width:210px; vertical-align: middle; text-align: center;">
								Tempat tanggal Lahir
							</th>

							<th rowspan="2" style=" min-width:130px; vertical-align: middle; text-align: center;">
								Nama Orang Tua
							</th>

							<th rowspan=" 2" style=" min-width:7em; vertical-align: middle; text-align: center;">
								<a href=" <?php $_SERVER['PHP_SELF'] ?>?by=klsa"><span class="fa fa-arrow-up"></span></a>
								Kelas
								<a href="<?php $_SERVER['PHP_SELF'] ?>?by=klsb"><span class="fa fa-arrow-down"></span></a>
							</th>
							<th colspan="16" class=" bg-primary text-center">Nilai Akhir Mata Pelajaran Kurikulum 2013</th>
							
							<th rowspan="2" style=" min-width:80px; vertical-align: middle; text-align: center;">
								Rata-rata
							</th>

							<th rowspan="2" style=" min-width:120px; vertical-align: middle; text-align: center;">
								<a href=" <?php $_SERVER['PHP_SELF'] ?>?by=statusa"><span class="fa fa-arrow-up"></span></a>
								Setatus
								<a href="<?php $_SERVER['PHP_SELF'] ?>?by=statusb"><span class="fa fa-arrow-down"></span></a>
							</th>

						</tr>
						<tr class="bg-primary">
							<th>PAI</th>
							<th>PKn</th>
							<th>BInd</th>
							<th>MTK</th>
							<th>SJR</th>
							<th>ING</th>
							<th>SBD</th>
							<th>PJOK</th>
							<th>MULOK1</th>
							<th>MULOK2</th>
							<th>SIMDIG</th>
							<th>EBIS / FISIKA</th>
							<th>ADUM / KIMIA</th>
							<th>IPA</th>
							<th>DASPROG</th>
							<th>KK</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//cari
						if (isset($_GET['cari'])) {	
							$cari = addslashes($_GET['cari']);
							$qsiswa = mysqli_query($db_conn, "SELECT * FROM un_siswa WHERE no_ujian like '%" . $cari . "%' OR nama like '%" . $cari . "%' OR kls like '%" . $cari . "%' ORDER BY no_ujian ASC");
						} else if (isset($_GET['by'])) {
								$sort = $_GET['by'];
								switch ($sort) {
									case 'no_ujiana':
										$qsiswa = mysqli_query($db_conn, "SELECT * FROM un_siswa ORDER BY no_ujian ASC");
										break;
									case 'no_ujianb':
										$qsiswa = mysqli_query($db_conn, "SELECT * FROM un_siswa ORDER BY no_ujian DESC");
										break;
									case 'namaa':
										$qsiswa = mysqli_query($db_conn, "SELECT * FROM un_siswa ORDER BY nama ASC");
										break;
									case 'namab':
										$qsiswa = mysqli_query($db_conn, "SELECT * FROM un_siswa ORDER BY nama DESC");
										break;
									case 'klsa':
										$qsiswa = mysqli_query($db_conn, "SELECT * FROM un_siswa ORDER BY kls ASC");
										break;
									case 'klsb':
										$qsiswa = mysqli_query($db_conn, "SELECT * FROM un_siswa ORDER BY kls DESC");
										break;
									case 'statusa':
										$qsiswa = mysqli_query($db_conn, "SELECT * FROM un_siswa ORDER BY status ASC");
										break;
									case 'statusb':
										$qsiswa = mysqli_query($db_conn, "SELECT * FROM un_siswa ORDER BY status DESC");
										break;

									default:
										$qsiswa = mysqli_query($db_conn, "SELECT * FROM un_siswa");
										break;
								}
							} else {
							$qsiswa = mysqli_query($db_conn, "SELECT * FROM un_siswa");
						}
						$no = 1; //variabel no
						if (mysqli_num_rows($qsiswa) > 0) {
							while ($data = mysqli_fetch_array($qsiswa)) {
								echo '<tr>';
								echo '<td class="text-center">' . $no++ . '</td>';
								echo '<td>' . $data['no_ujian'] . '</td>';
								echo '<td>' . $data['nis'] . '</td>';
								echo '<td>' . $data['nisn'] . '</td>';
								echo '<td>' . $data['nama'] . '</td>';
								echo '<td>' . $data['ttl'] . '</td>';
								echo '<td>' . $data['ortu'] . '</td>';
								echo '<td class="text-center">' . $data['kls'] . '</td>';
								echo '<td class="text-center">' . $data['n_pai'] . '</td>';
								echo '<td class="text-center">' . $data['n_pkn'] . '</td>';
								echo '<td class="text-center">' . $data['n_bin'] . '</td>';
								echo '<td class="text-center">' . $data['n_mat'] . '</td>';
								echo '<td class="text-center">' . $data['n_sjr'] . '</td>';
								echo '<td class="text-center">' . $data['n_ing'] . '</td>';
								echo '<td class="text-center">' . $data['n_sbd'] . '</td>';
								echo '<td class="text-center">' . $data['n_pjok'] . '</td>';
								echo '<td class="text-center">' . $data['n_mulok1'] . '</td>';
								echo '<td class="text-center">' . $data['n_mulok2'] . '</td>';
								echo '<td class="text-center">' . $data['n_simdig'] . '</td>';
								echo '<td class="text-center">' . $data['n_eb_fisika'] . '</td>';
								echo '<td class="text-center">' . $data['n_adum_kimia'] . '</td>';
								echo '<td class="text-center">' . $data['n_ipa'] . '</td>';
								echo '<td class="text-center">' . $data['n_dasprog'] . '</td>';
								echo '<td class="text-center">' . $data['n_kk'] . '</td>';
								echo '<td class="text-center">' . $data['rata2'] . '</td>';
								echo '<td class="text-center">';
								echo ($data['status'] == 1) ? '<b class="text-success" >Lulus </b>' : '<em class="text-danger">Tidak Lulus</em>';
								echo '</td>';
								echo '</tr>';

								
							}
						} else {
							echo '<tr><td colspan="8"><em>Tidak ada data yang bisa di tampilkan !</em></td></tr>';
						}
						?>
					</tbody>
				</table>

				<form action="../print/print.php" method="POST" target="_blank">
					<div class="row col-sm-8">
					<button class=" btn btn-primary" type="submit" name="submit"><i class="fa fa-print"> </i> &nbsp; CETAK SKL </button>
					</div>
				</form>
			</div>

		</div>



	<?php
	include '_footer.php';
} else {
	header('Location: ./login.php');
}
	?>