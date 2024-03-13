<?php
session_start();
if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
  include "../database.php";
  include '_header.php';
?>

  <div class="container">
    <h2>Konfigurasi</h2>
    <hr>
    <?php

    if (isset($_REQUEST['submit'])) {
      $cfgID = $_REQUEST['cfgID'];
      $cfgsekolah = $_REQUEST['cfgSekolah'];
      $cfgTgl = $_REQUEST['cfgTanggal'] . ' ' . $_REQUEST['cfgJam'];
      $cfgabout = $_REQUEST['cfgabout'];
      $cfgcontact = $_REQUEST['cfgcontact'];
      $cfgnopesformat1 = trim($_REQUEST['cfgnopesformat']);
      $cfglogo = $_FILES['cfglogo']['name'];
      $cfgkepsek = $_REQUEST['cfgkepsek'];
      $cfgnip = $_REQUEST['cfgnip'];
      $cfgno_surat = $_REQUEST['cfgno_surat'];
      $cfgttd = $_FILES['cfgttd']['name'];
      $cfgkop = $_FILES['cfgkop']['name'];
      $cfgcap = $_FILES['cfgcap']['name'];

      // EDIT format no ujian
      //membagi nomor peserta menjadi 2 bagian
      $nopes_ke1 = substr($cfgnopesformat1, 0, 5);
      //bagian nomor digit ke 6 yang akan di konversi
      $nopes_ke6 = substr($cfgnopesformat1, 5);
      //mengganti karakter angka 0-8 menjadi angka 9
      $angkanopes = array('0', '1', '2', '3', '4', '5', '6', '7', '8');
      $cfgnopesformat2 = str_replace($angkanopes, "9", $nopes_ke6);
      //menggabungkan kembali nope dari digit ke 1 - 5 dan digit ke 6 dst yang sudah di convert jadi angka 9 
      $cfgnopesformat = trim($nopes_ke1 . $cfgnopesformat2);
      // $cfgnopesformat = $_REQUEST['cfgnopesformat'];
      // selesai EDIT format no ujian
      
        //cek dulu jika merubah gambar ttd jalankan coding ini
        if($cfgttd != "") {
          $x = explode('.', $cfgttd); //memisahkan nama file dengan ekstensi yang diupload
          $ekstensi = strtolower(end($x));
          $file_tmp = $_FILES['cfgttd']['tmp_name'];   
          $nama_png    = "ttd.png";
          $nama_jpg    = "ttd.jpg";
            if($ekstensi == 'png') {
              move_uploaded_file($file_tmp, '../img/'.$nama_png ); //memindah file gambar ke folder gambar
                $ttd = "$nama_png";
                  
            } else if($ekstensi == 'jpg') {
              move_uploaded_file($file_tmp, '../img/'.$nama_jpg); //memindah file gambar ke folder gambar
                $ttd = "$nama_jpg";
            }else{
              {     
                //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                $ttd = $hsl['ttd'];
                    echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='konfigurasi.php';</script>";
                }
            }
        }else{
          $ttd = $hsl['ttd'];
        }
      //------------------- akhir cek TTD

              //cek dulu jika merubah gambar cap jalankan coding ini
              if($cfgcap != "") {
                $x = explode('.', $cfgcap); //memisahkan nama file dengan ekstensi yang diupload
                $ekstensi = strtolower(end($x));
                $file_tmp = $_FILES['cfgcap']['tmp_name'];   
                $nama_png    = "cap.png";
                  if($ekstensi == 'png') {
                    move_uploaded_file($file_tmp, '../img/'.$nama_png ); //memindah file gambar ke folder gambar
                      $cap = "$nama_png";
                  }else{
                    {     
                      //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                      $cap = $hsl['cap'];
                          echo "<script>alert('Ekstensi gambar yang boleh hanya PNG dan transparan');window.location='konfigurasi.php';</script>";
                      }
                  }
              }else{
                $cap = $hsl['cap'];
              }
            //------------------- akhir cek CAP

            //cek dulu jika merubah gambar KOP Surat jalankan coding ini
            if($cfgkop != "") {
              $x = explode('.', $cfgkop); //memisahkan nama file dengan ekstensi yang diupload
              $ekstensi = strtolower(end($x));
              $file_tmp = $_FILES['cfgkop']['tmp_name'];   
              $nama_png    = "kopsurat.png";
              $nama_jpg    = "kopsurat.jpg";
                if($ekstensi == 'png') {
                  move_uploaded_file($file_tmp, '../img/'.$nama_png ); //memindah file gambar ke folder gambar
                    $kop = "$nama_png";

                  } else if($ekstensi == 'jpg') {
                    move_uploaded_file($file_tmp, '../img/'.$nama_jpg); //memindah file gambar ke folder gambar
                      $ttd = "$nama_jpg";
                }else{
                  {     
                    //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                    $kop = $hsl['kop'];
                        echo "<script>alert('Ekstensi gambar yang boleh untuk Kop Suarat hanya PNG dan JPG');window.location='konfigurasi.php';</script>";
                    }
                }
            }else{
              $kop = $hsl['kop'];
            }
          //------------------- akhir cek CAP
      


      //------------------------------------------

        //cek dulu jika merubah gambar logo jalankan coding ini
        if($cfglogo != "") {
          $ekstensi_diperbolehkan = array('png','jpg'); //ekstensi file gambar yang bisa diupload 
          $x = explode('.', $cfglogo); //memisahkan nama file dengan ekstensi yang diupload
          $ekstensi = strtolower(end($x));
          $file_tmp = $_FILES['cfglogo']['tmp_name'];   
          $nama_gambar_baru = 'logo sekolah-'.$cfglogo; //menggabungkan angka acak dengan nama file sebenarnya
          if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
            //menghapus gambar lama
              unlink('../img/'.$hsl['logo']);
              move_uploaded_file($file_tmp, '../img/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
              $logo ="$nama_gambar_baru";  
                sleep(2);
          } else {     
            //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
              echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='konfigurasi.php';</script>";
          }
        }else{
          $logo= $hsl['logo'];
        }
      //--------------------
      
      //Menjalankan Queri Edit tanpa update logo
      $qCfg = "UPDATE un_konfigurasi SET sekolah='$cfgsekolah', kepsek='$cfgkepsek', nip='$cfgnip', no_surat='$cfgno_surat',ttd='$ttd',cap='$cap',kop='$kop',about='$cfgabout',tgl_pengumuman='$cfgTgl',contact='$cfgcontact',nopesformat='$cfgnopesformat', logo='$logo' WHERE id='$cfgID'";
      $upCfg = mysqli_query($db_conn, $qCfg);
      sleep(2);
                                // periska query apakah ada error
                                if(!$upCfg){
                                  die ("Query gagal dijalankan: ".mysqli_errno($db_conn).
                                      " - ".mysqli_error($db_conn));
                              } else {
                                //tampil alert dan akan redirect ke halaman index.php
                                //silahkan ganti index.php sesuai halaman yang akan dituju
                                echo "<script>alert('Data berhasil diperbarui...');window.location='konfigurasi.php';</script>";
                              }
    }

    $qconfig = mysqli_query($db_conn, "SELECT * FROM un_konfigurasi");
    $hsl = mysqli_fetch_array($qconfig);
    ?>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
      <input type="hidden" name="cfgID" value="<?= $hsl['id'] ?>">

      <div class="form-group">
      <label class="col-sm-3 control-label"></label>
        <div class="col-sm-3">
          <!-- menampilan logo -->
          <img src="../img/<?= $hsl['logo'] ?>" style="width: 120px;float: left;margin-bottom: 5px;"> 
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Logo Sekolah</label>
        <div class="col-sm-3">
          <input type="file" name="cfglogo" class="form-control" disabled />
          <i style="float: left;font-size: 11px;color: red">Abaikan jika tidak merubah gambar logo</i>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Nama Sekolah</label>
        <div class="col-sm-6">
          <input type="text" name="cfgSekolah" class="form-control" value="<?= $hsl['sekolah'] ?>" readonly>
          <i style="float: left;font-size: 11px;">Masukan nama sekolah</i>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Tanggal Pengumuman</label>
        <div class="col-sm-3">
          <input type="date" name="cfgTanggal" class="form-control" value="<?= date('Y-m-d', strtotime($hsl['tgl_pengumuman'])) ?>" readonly>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Jam Pengumuman</label>
        <div class="col-sm-3">
          <input type="time" name="cfgJam" class="form-control" value="<?= date('H:i', strtotime($hsl['tgl_pengumuman'])) ?>" readonly>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">About</label>
        <div class="col-sm-6">
          <textarea name="cfgabout" class="form-control" readonly><?= $hsl['about'] ?></textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Contact</label>
        <div class="col-sm-6">
          <textarea name="cfgcontact" class="form-control" readonly><?= $hsl['contact'] ?></textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Format No Peserta</label>
        <div class="col-sm-3">
          <input type="text" name="cfgnopesformat" class="form-control" readonly pattern="(\-)[0-9]" placeholder="" value="<?= trim($hsl['nopesformat']) ?>" title="Masukan Angka dan strip">
          <i style="float: left;font-size: 11px;">masukan Format nomor ujian, hanya 'angka' dan '-'</i>
        </div>
      </div>

      <fieldset>
        <legend>Konfigurasi Surat</legend>     
        <div class="form-group">
              <label class="col-sm-3 control-label">Nama Kepala Sekolah</label>
              <div class="col-sm-4">
                <input type="text" name="cfgkepsek" class="form-control" value="<?= $hsl['kepsek'] ?>" readonly>
                <i style="float: left;font-size: 11px;">Nama kepala sekolah</i>
              </div>
        </div>
        <div class="form-group">
              <label class="col-sm-3 control-label">NIP kepala sekolah</label>
              <div class="col-sm-4">
                <input type="text" name="cfgnip" class="form-control" value="<?= $hsl['nip'] ?>" readonly>
                <i style="float: left;font-size: 11px;">NIP Kepala sekolah, ketik "-" jika tidak ada NIP</i>
              </div>
        </div>
        <div class="form-group">
              <label class="col-sm-3 control-label">Nomor Surat Kelulusan</label>
              <div class="col-sm-4">
                <input type="text" name="cfgno_surat" class="form-control" value="<?= $hsl['no_surat'] ?>" readonly>
                <i style="float: left;font-size: 11px;">Nomor surat keterangan kelulusan</i>
              </div>
        </div>
        <div class="form-group">
              <label for="kop" class="col-sm-3 control-label">KOP Surat </label>
              <div class="col-sm-4">
                <img src="../img/<?= $hsl['kop'] ?>" style="width: 364px;float: left;margin-bottom: 5px;">
                <input type="file" name="cfgkop" id="kop" class="form-control" disabled />
                <i style="float: left;font-size: 11px;">Kop sekolah format gambar PNG</i>
              </div>
        </div>
        <div class="form-group">
              <label class="col-sm-3 control-label">Tanda Tangan</label>
              <div class="col-sm-4">
                <img src="../img/<?= $hsl['ttd'] ?>" style="width: 100px;float: left;margin-bottom: 5px;">
                <input type="file" name="cfgttd" class="form-control" disabled />
                <i style="float: left;font-size: 11px;">Tanda tangan kepala sekolahformat gambar PNG/JPG</i>
              </div>
        </div>
        <div class="form-group">
              <label for="cap" class="col-sm-3 control-label">Cap/stempel Sekolah </label>
              <div class="col-sm-4">
                <img src="../img/<?= $hsl['cap'] ?>" style="width: 100px;float: left;margin-bottom: 5px;">
                <input type="file" name="cfgcap" id="cap" class="form-control" disabled />
                <i style="float: left;font-size: 11px;">Cap/stempel Sekolah format gambar PNG </i>
              </div>
        </div>
      </fieldset> 
      
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="submit" name="submit" class="btn btn-primary" disabled="disabled">Simpan</button>
          <button type="button" id="btEnable" class="btn btn-primary">Edit</button>
        </div>
      </div>
    </form>
    
  </div>
  <script>
    $('button[name="submit"]').prop('disabled', true);
    $('#btEnable').click(function() {
      $('input[name="cfglogo"]').removeAttr('disabled');
      $('input[name="cfgttd"]').removeAttr('disabled');
      $('input[name="cfgkop"]').removeAttr('disabled');
      $('input[name="cfgcap"]').removeAttr('disabled');
      $("input").removeAttr('readonly','disable');
      $("textarea").removeAttr('readonly');
      $('button[name="submit"]').removeAttr('disabled');
    });
  </script>
<?php
  include '_footer.php';
} else {
  header('Location: ./login.php');
}
?>