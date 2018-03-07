<?php require_once('includes/header.php') ?>
<div class="container">
  <div class="carousel carousel-slider center" data-indicators="true">
    <div class="carousel-item white-text slider-image" style="background-image: URL('http://via.placeholder.com/1920x1080');">
      <h2>First Panel</h2>
      <p class="white-text">This is your first panel</p>
      <div class="carousel-fixed-item center">
        <a class="btn waves-effect white grey-text darken-text-2" href="contact.php">button</a>
      </div>
    </div>
    <div class="carousel-item white-text slider-image" style="background-image: URL('http://via.placeholder.com/1920x1080');">
      <h2>First Panel</h2>
      <p class="white-text">This is your first panel</p>
      <div class="carousel-fixed-item center">
        <a class="btn waves-effect white grey-text darken-text-2" href="contact.php">button</a>
      </div>
    </div>
    <div class="carousel-item white-text slider-image" style="background-image: URL('http://via.placeholder.com/1920x1080');">
      <h2>First Panel</h2>
      <p class="white-text">This is your first panel</p>
      <div class="carousel-fixed-item center">
        <a class="btn waves-effect white grey-text darken-text-2" href="contact.php">button</a>
      </div>
    </div>
  </div>
</div>
<div class="outer">
  <div class="container">
    <div class="carousel">
      <h4>Recommended</h4>
      <?php
      $i2 = 1;
      while ($i2 <= 7) {
        output();
        $i2++;
      }
      ?>
    </div>
  </div>
</div>
<div class="outer gray">
	<div class="container">
		<div class="carousel product-slider">
			<h4>New producks!</h4>
			<?php
			function output() {
			echo "
			<a class='carousel-item' href='product.php'>
			    <div class='card'>
			      <div class='card-image'>
			        <img src='http://via.placeholder.com/400x400'>
			        <span class='card-title'>Card Title</span>
			      </div>
			      <div class='card-action'>
			        <p class='price'>$99.95</p>
			        <div class='stars right'>
			          <i class='material-icons tiny rated'>star</i>
			          <i class='material-icons tiny rated'>star</i>
			          <i class='material-icons tiny rated'>star</i>
			          <i class='material-icons tiny rated'>star</i>
			          <i class='material-icons tiny'>star_border</i>
			        </div>
			      </div>
			    </div>
			</a>
			";
			}

			$i = 1;
			while ($i <= 7) {
			output();
			$i++;
			}
			?>
    </div>
	</div>
</div>

<?php require_once('includes/footer.php') ?>
