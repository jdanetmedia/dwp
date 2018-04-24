<?php
  require_once("../admin/includes/header.php");
  $gallery = new Gallery();
  $allImages = $gallery->getAllImages();

  if(isset($_POST["submit"])) {
    $gallery->attachImage($_GET["item"], $imgId);
    ?>
      <script type="text/javascript">location.href = 'edit-product.php?item=<?php echo $_GET["item"]; ?>';</script>
    <?php
  }
?>
  <div class="container gallery-cnt">
    <?php $rowCount = 0; ?>
    <div class="row">
    <?php foreach ($allImages as $img) { ?>
      <div class="gallery-item">
        <div class="img-bg">
          <img id="<?php echo $img->ImgID; ?>" src="<?php echo $img->URL; ?>" alt="">
        </div>
      </div>
      <?php
        $rowCount++;
        if($rowCount % 5 == 0) echo '</div><div class="row">';
      ?>
    <?php } ?>
    </div>
    <form class="img-form" action="" method="post">
      <input type="hidden" name="imgId">
      <input type="submit" name="submit" value="Choose image">
    </form>
  </div>
<?php require_once("includes/footer.php"); ?>
