
<?php require_once('includes/header.php') ?>
<div class="container">
  <div class="row">
    <h4>New producks!</h4>
    <div class="carousel">
    <?php
    function output() {
      echo "
      <a class='carousel-item' href='#one!'>
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
    <h4>Recommended</h4>
    <div class="carousel">
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
<?php require_once('includes/footer.php') ?>
