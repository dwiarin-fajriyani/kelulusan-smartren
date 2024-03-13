<?php
include "database.php";
// $que = mysqli_query($db_conn, "SELECT * FROM un_konfigurasi");
// $hsl = mysqli_fetch_array($que);
// $timestamp = strtotime($hsl['tgl_pengumuman']);
// // menghapus tags html (mencegah serangan jso pada halaman index)
// $sekolah = strip_tags($hsl['sekolah']);
// $tahun = strip_tags($hsl['tahun']);
// $tgl_pengumuman = strip_tags($hsl['tgl_pengumuman']);
// $nopesformat = strip_tags($hsl['nopesformat']);
// $contact = strip_tags($hsl['contact']);
// $about = strip_tags($hsl['about']);
// //echo $timestamp;

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="aplikasi sederhana untuk menampilkan pengumuman hasil ujian nasional secara online">
    <meta name="author" content="slamet.bsan@gmail.com">
    <title>Pengumuman Kelulusan</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="css/kelulusan.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="img/<?= $hsl['logo'] ?>">
</head>

<body class="bg-image" style="background-image: url('img/batik.png'); background-attachment:fixed;
      height: 100%">
    <nav class="navbar navbar-inverse navbar-fixed-top ">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./"><?= $sekolah; ?></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="./">Home</a></li>
                    <li><a href="./about.php">About</a></li>
                    <li><a href="./contact.php">Contact</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
    <br>