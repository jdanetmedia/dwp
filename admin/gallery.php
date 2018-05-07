<?php
  require_once("../includes/sessionstart.php");
  require_once("../admin/includes/header.php");

  if (!logged_in()) {
  ?>
  <script type="text/javascript">
  	window.location.href = 'login.php';
  </script>
  <?php
  	//redirect_to("login.php");
  }

  $gallery = new Gallery();
  $allImages = $gallery->getAllImages();

  if(isset($_POST["submit"])) {
    if(isset($_POST["imgId"])) {
      $gallery->attachImage($_GET["item"], $_POST["imgId"]); ?>
      <script type="text/javascript">
        window.location.href = 'edit-product.php?item=<?php echo $_GET["item"]; ?>&select=images';
      </script>
    <?php }
  }
  if(isset($_POST["uploadImg"])) {
    if($_FILES && $_FILES['fileToUpload']['size'] > 0) {
        $gallery->uploadImages($_FILES);
    }

  }
?>
  <div class="container gallery-cnt">
    <div class="row">
      <h2>Choose/Upload image</h2>
      <form class="upload-form" action="gallery.php?item=<?php echo $_GET["item"]; ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" name="uploadImg" value="Upload">
      </form>
    </div>
    <?php $rowCount = 0; ?>
    <div class="row">
    <?php foreach ($allImages as $img) { ?>
      <div class="gallery-item">
        <div class="img-bg">
          <img class="img-item" id="<?php echo $img->ImgID; ?>" src="<?php echo $img->URL; ?>" alt="">
        </div>
      </div>
      <?php
        $rowCount++;
        if($rowCount % 5 == 0) echo '</div><div class="row">';
      ?>
    <?php } ?>
    </div>
    <form class="img-form" action="" method="post">
      <input class="sendId" type="hidden" name="imgId">
      <input type="submit" name="submit" value="Choose image">
    </form>
  </div>
<?php require_once("includes/footer.php"); ?>
