<?php
include "header.php";
?>
<div class="container">
  <h2>Contact</h2>
  <hr>
  <div class="jumbotron"><strong>Hubungi</strong>
    <br>Nama Sekolah : <?= strtoupper($sekolah); ?>
    <br><?= $contact; ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jasny-bootstrap.min.js"></script>
  </div>
</div>

<?php
include "footer.php";
?>