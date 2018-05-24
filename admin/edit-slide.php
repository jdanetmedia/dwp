<?php
require_once("../includes/sessionstart.php");
require_once("../admin/includes/header.php");
spl_autoload_register(function($class) {
    include "class/".$class.".php";
});

if (!logged_in()) {
?>
<script type="text/javascript">
	window.location.href = 'login.php';
</script>
<?php
	//redirect_to("login.php");
}

$slide = new Slide();

if(isset($_POST["updateSlide"])) {
  $slide->updateSlide($_POST, $_GET["slideID"]);
  ?>
  <script type="text/javascript">
    window.location.href = "manage-slider.php";
  </script>
  <?php
} elseif(isset($_POST["deleteSlide"])) {
  $slide->deleteSlide($_GET["slideID"]);
  ?>
  <script type="text/javascript">
    window.location.href = "manage-slider.php";
  </script>
  <?php
} elseif(isset($_POST["toGallery"])) {
  $slide->updateSlide($_POST, $_GET["slideID"]);
  ?>
  <script type="text/javascript">
    window.location.href = "gallery.php?slide=<?php echo $_GET['slideID']; ?>";
  </script>
  <?php
}

$curSlide = $slide->getCurrentSlide($_GET["slideID"]);
?>

<div class="container">
  <div class="card">
    <div class="card-content">
      <div style="margin-bottom: 30px;" class="card-title">Edit slide</div>
      <form action="edit-slide.php?slideID=<?php echo $_GET["slideID"]; ?>" method="post">
        <div class="row">
          <div class="input-field col s12">
            <input id="SliderHeader" type="text" name="SliderHeader" class="validate" <?php if(isset($curSlide["SliderHeader"])) echo "value='" . $curSlide["SliderHeader"] . "'"; ?> required="" aria-required="true">
            <label for="SliderHeader">Slide name</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="SliderText" type="text" name="SliderText" class="validate" <?php if(isset($curSlide["SliderText"])) echo "value='" . $curSlide["SliderText"] . "'"; ?> required="" aria-required="true">
            <label for="SliderText">SliderText</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <input id="CTAURL" type="text" name="CTAURL" class="validate" <?php if(isset($curSlide["CTAURL"])) echo "value='" . $curSlide["CTAURL"] . "'"; ?> required="" aria-required="true">
            <label for="CTAURL">CTA Url</label>
          </div>
          <div class="input-field col s6">
            <input id="CTAButtonText" type="text" name="CTAButtonText" class="validate" <?php if(isset($curSlide["CTAButtonText"])) echo "value='" . $curSlide["CTAButtonText"] . "'"; ?> required="" aria-required="true">
            <label for="CTAButtonText">CTA Buttontext</label>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <?php if(isset($curSlide["SliderImg"]) && !empty($curSlide["SliderImg"])) : ?>
              <img class="responsive-img" src="<?php echo $curSlide["SliderImg"]; ?>" alt="Slide image">
              <input class="waves-effect waves-light btn grey darken-4" type="submit" name="toGallery" value="Change image">
              <p><small>On upload the image is cropped to 1170 x 400 px</small></p>
            <?php else : ?>
              <input class="waves-effect waves-light btn grey darken-4" type="submit" name="toGallery" value="Change image">
              <p><small>On upload the image is cropped to 1170 x 400 px</small></p>
            <?php endif; ?>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input name="updateSlide" type="submit" value="Update" class="waves-effect waves-light btn grey darken-4 btn right">
            <input name="deleteSlide" type="submit" value="Delete" class="waves-effect waves-light btn grey darken-4 btn right">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require_once("../admin/includes/footer.php"); ?>
