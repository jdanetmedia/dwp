
<?php require_once('includes/header.php') ?>
<div class="container">
  <div class="row">
    <div class="input-field col s12 m3">
      <select>
        <option value="" disabled selected>Categories</option>
        <option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>
      </select>
    </div>
    <div class="col s12 m6">
      <div id="price-slider"></div>
    </div>
    <div class="input-field col s12 m3">
      <select>
        <option value="" disabled selected>Sort by</option>
        <option value="1">Desc. Price</option>
        <option value="2">Asc. Price</option>
        <option value="3">Reviews</option>
        <option value="3">Popularity</option>
      </select>
    </div>
  </div>
  <div class="row">
    
    <?php

    function output() {
      echo "<div class='col s12 m3'>
        <div class='card'>
          <div class='card-image'>
            <img src='http://via.placeholder.com/400x400'>
            <span class='card-title'>Card Title</span>
          </div>
          <div class='card-action'>
            <a href='#'>$99.95</a>
            <div class='stars right'>
              <i class='material-icons tiny rated'>star</i>
              <i class='material-icons tiny rated'>star</i>
              <i class='material-icons tiny rated'>star</i>
              <i class='material-icons tiny rated'>star</i>
              <i class='material-icons tiny'>star_border</i>
            </div>
          </div>
        </div>
      </div>";
    }

    $i = 1;
    while ($i <= 12) {
      output();
      $i++;
    }

    ?>

  </div>
  <div class="row">
    <div class="col s12 m12">
      <h3>Category text</h3>
      <p>
        The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ in their grammar, their pronunciation and their most common words. Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words.If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages.The new common language will be more simple and regular than the existing European languages. It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is.
        <br>
        The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ in their grammar, their pronunciation and their most common words.Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators.To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words.
      </p>
    </div>
  </div>
</div>
<?php require_once('includes/footer.php') ?>
