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

$slide = new Slide();

$allSlides = $slide->getAllSlides();
?>
<div class="container">
	<div class="card">
	  <div class="card-content">
      <span class="card-title">Sliders<a class="waves-effect waves-light btn grey darken-4 new-prod-btn" href="new-slide.php">Add new</a></span>
      <table class="responsive-table striped">
        <thead>
          <tr>
              <th>Header</th>
              <th>Text</th>
              <th>CTA text</th>
              <th>CTA URL</th>
              <th>Image</th>
              <th>Edit</th>
          </tr>
        </thead>
        <?php // TODO: Ændre farve på select felter ?>
        <tbody>
          <?php
            foreach ($allSlides as $slide) {
                ?>
                <tr>
                  <td><?php echo $slide["SliderHeader"]; ?></td>
                  <td><?php echo $slide["SliderText"]; ?></td>
                  <td><?php echo $slide["CTAButtonText"]; ?></td>
                  <td><?php echo $slide["CTAURL"]; ?></td>
                  <td><img style="height: 60px;" src="<?php echo $slide["SliderImg"]; ?>" /></td>
                  <td><a href="<?php echo "edit-slide.php?slideID=" . $slide["SlideID"]; ?>">Edit</a></td>
                </tr>
                <?php
            }
          ?>
        </tbody>
      </table>
	  </div>
	</div>
</div>
<?php require_once("../admin/includes/footer.php"); ?>
