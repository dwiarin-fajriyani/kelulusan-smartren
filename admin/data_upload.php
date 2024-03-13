<?php
session_start();
if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
	include "../database.php";
?>
		
	<?php
	echo '<center><br><br><br><br><br><br><br><br><br><img src="../img/loading_2.gif" alt="memuat"></center>';
	if (isset($_REQUEST['submit'])) {
		$filename = $_FILES["file"]["tmp_name"];

		//Validasi jika File kosong
		if (!empty($_FILES["file"]["tmp_name"])) {

			//jika file bukan tipe csv
			$ekstensi_diperbolehkan	= array('csv', 'xlsx');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
				// lakukan upload jika file ada
				if ($_FILES["file"]["size"] > 0) {
					$file = fopen($filename, "r");
					
					//Menghapus semua data pada tabel un_siswa
					mysqli_query($db_conn, "TRUNCATE TABLE un_siswa");

					//abil data dengan perulangan
					while (($unData = fgetcsv($file, 100000, ";")) !== FALSE) {
						//lewati baris pertama
						if ($unData[0] == "NO_UJIAN" or $unData[1] == "NIS") {
							continue;
						}
						$namasiswa = addslashes($unData[3]);
						//kolom mapel di memasukan ke variabel//
						$pai = $unData[7];
						$pkn = $unData[8];
						$bind = $unData[9];
						$mtk = $unData[10];
						$sjr = $unData[11];
						$ing = $unData[12];
						$sbd = $unData[13];
						$pjok = $unData[14];
						$mulok1 = $unData[15];
						$mulok2 = $unData[16];
						$simdig = $unData[17];
						$eb_fisika = $unData[18];
						$adum_kimia = $unData[19];
						$ipa = $unData[20];
						$dasprog = $unData[21];
						$kk = $unData[22];
						$rata2 = $unData[23];

						//jumlah pembagi jika mulok 1 dan 2 ada atau salahsatu nya ada
						if($unData[20]== ""){
							$ipa = "-";
							//$adum_kimia = "-";
						}
						// elseif($unData[18] >0 && $unData[19]== ""){
						// 	$jml_mapel ="15";
						// 	$ = "-";

						// }
						//selesai Membuat nilai rata2

						//query insert
						$sql = "INSERT INTO un_siswa VALUES(
							'$unData[0]','$unData[1]','$unData[2]','$namasiswa','$unData[4]','$unData[5]','$unData[6]','$pai',
							'$pkn','$bind','$mtk','$sjr','$ing','$sbd','$pjok','$mulok1',
							'$mulok2','$simdig','$eb_fisika','$adum_kimia','$ipa','$dasprog','$kk','$rata2','$unData[24]')";
						$res = mysqli_query($db_conn, $sql);

						if (!$res) {
							echo "<script type=\"text/javascript\">alert(\"GAGAL Upload data! Mohon cek kembali data yang di upload.\");window.location = \"data.php\"</script>";
						}
					}
					//Selesai abil data dengan perulangan

					fclose($file);

					echo "<script type=\"text/javascript\">alert('File CSV BERHASIL diimpor...');window.location = \"data.php\"</script>";
				}
			} else {
				echo "<script type=\"text/javascript\">alert(\" EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN! \");window.location = \"data.php\"</script>";
			}
		} else {
			echo "<script type=\"text/javascript\">alert(\" Mohon masukan File CSV ! \");window.location = \"data.php\"</script>";
		}
	} else {
		header('Location: data.php');
	}
} else {
	header('Location: ./login.php');
}
