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

if(isset($_POST["saveSlide"])) {
  $slide->createSlide($_POST);
} elseif(isset($_POST["toGallery"])) {
  $slide->createSlide($_POST);
  ?>
  <script type="text/javascript">
    window.location.href = "gallery.php?slide=<?php echo $_POST[]; ?>";
  </script>
  <?php
}
?>
<div class="container">
  <div class="card">
    <div class="card-content">
      <div style="margin-bottom: 30px;" class="card-title">New slide</div>
      <form action="" method="post">
        <div class="row">
          <div class="input-field col s12">
            <input id="SliderHeader" type="text" name="SliderHeader" class="validate" required="" aria-required="true">
            <label for="SliderHeader">Slide name</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="SliderText" type="text" name="SliderText" class="validate" required="" aria-required="true">
            <label for="SliderText">SliderText</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <input id="CTAURL" type="text" name="CTAURL" class="validate" required="" aria-required="true">
            <label for="CTAURL">CTA Url</label>
          </div>
          <div class="input-field col s6">
            <input id="CTAButtonText" type="text" name="CTAButtonText" class="validate" required="" aria-required="true">
            <label for="CTAButtonText">CTA Buttontext</label>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
              <input class="waves-effect waves-light btn grey darken-4" type="submit" name="toGallery" value="Add image">
              <p><small>On upload the image is cropped to 1170 x 400 px</small></p>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input name="saveSlide" type="submit" value="Save" class="waves-effect waves-light btn grey darken-4 btn right">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require_once("../admin/includes/footer.php"); ?>
