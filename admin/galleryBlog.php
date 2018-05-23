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

$gallery = new GalleryBlog();
$allImages = $gallery->getAllImages();

if(isset($_POST["submit"])) {
    if(isset($_POST["imgId"])) {
        $gallery->attachImage($_GET["ID"], $_POST["imgId"]); ?>
        <script type="text/javascript">
            window.location.href = 'edit-blog-post.php?ID=<?php echo $_GET["ID"]; ?>&select=images';
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
        <form class="upload-form" action="galleryBlog.php?ID=<?php echo $_GET["ID"]; ?>" method="post" enctype="multipart/form-data">
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
        <a class="waves-effect waves-light btn grey darken-2 right" href="edit-blog-post.php?ID=<?php echo $_GET["ID"]; ?>">Cancel</a>
    </form>
</div>
<?php require_once("includes/footer.php"); ?>
