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

  if(isset($_GET["item"])) {
    $item = $_GET["item"];
    $link = "gallery.php?item=" . $_GET["item"];
    $backlink = "edit-product.php?item=" . $_GET["item"];
    if(isset($_POST["submit"])) {
      if(isset($_POST["imgId"])) {
        $gallery->attachImage($_GET["item"], $_POST["imgId"], "product"); ?>
        <script type="text/javascript">
          window.location.href = 'edit-product.php?item=<?php echo $_GET["item"]; ?>&select=images';
        </script>
      <?php }
    }
    if(isset($_POST["uploadImg"])) {
      if($_FILES && $_FILES['fileToUpload']['size'] > 0) {
          $gallery->uploadImage($_FILES, $_GET["item"], "product");
      }
    }
  } elseif(isset($_GET["logo"])) {
    $link = "gallery.php?logo=true";
    $backlink = "manage-settings.php";
    if(isset($_POST["submit"])) {
      if(isset($_POST["imgId"])) {
        $gallery->addLogo($_POST["imgId"]); ?>
        <script type="text/javascript">
          window.location.href = 'manage-settings.php';
        </script>
      <?php }
    }
    if(isset($_POST["uploadImg"])) {
      if($_FILES && $_FILES['fileToUpload']['size'] > 0) {
          $gallery->uploadImage($_FILES, "logo");
      }

    }
  } elseif(isset($_GET["slide"])) {
    $item = $_GET["slide"];
    $link = "gallery.php?slide=" . $_GET["slide"];
    $backlink = "edit-slide.php?slideID=" . $_GET["slideID"];
    if(isset($_POST["submit"])) {
      if(isset($_POST["imgId"])) {
        $gallery->addSlideImg($_POST["imgId"], $_GET["slide"]); ?>
        <script type="text/javascript">
          window.location.href = 'edit-slide.php?slideID=<?php echo $_GET["slide"]; ?>';
        </script>
      <?php }
    }
    if(isset($_POST["uploadImg"])) {
      if($_FILES && $_FILES['fileToUpload']['size'] > 0) {
          $gallery->uploadImage($_FILES, "slide");
      }
    }
  }

  if(isset($_GET["item"]) || isset($_GET["slide"])) {
    $allImages = $gallery->getAllImages($item);
  } else {
    $allImages = $gallery->getAllImages();
  }
?>
  <div class="container gallery-cnt">
    <div class="row">
      <h2>Choose/Upload image</h2>
      <?php
        if(isset($_GET["item"])) {
          $link = "gallery.php?item=" . $_GET["item"];
        } elseif(isset($_GET["logo"])) {
          $link = "gallery.php?logo=true";
        }
      ?>
      <form class="upload-form" action="<?php echo $link; ?>" method="post" enctype="multipart/form-data">
        <div class="file-field input-field">
          <div class="waves-effect waves-light btn grey darken-4">
            <span>Choose file</span>
            <input type="file" name="fileToUpload" id="fileToUpload">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>
        <input class="waves-effect waves-light btn grey darken-4" type="submit" name="uploadImg" value="Upload">
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
      <input class="waves-effect waves-light btn grey darken-4 right choose-image" type="submit" name="submit" value="Choose image">
      <a class="waves-effect waves-light btn grey darken-2 right" href="<?php echo $backlink; ?>">Cancel</a>
    </form>
  </div>
<?php require_once("includes/footer.php"); ?>
