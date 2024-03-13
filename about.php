<?php
include "header.php";
?>

<div class="container">
  <h2>About</h2>
  <hr>
  <div class="jumbotron">
    <strong>Website Informasi <?= $sekolah; ?></strong><br> <?= $about; ?>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jasny-bootstrap.min.js"></script>
</div>

<?php
include "footer.php";
?>