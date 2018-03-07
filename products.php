<?php require_once('includes/header.php');
require_once('productsfunc.php');
$url = $_SERVER['REQUEST_URI'];
echo $url;
?>
<script type="text/javascript">
  if(window.location.href.indexOf("?") > -1) {
  } else {
  window.location.search += '?';
  }
</script>
<div class="container">
  <div class="row">
    <div class="input-field col s12 m3">
      <select id="select_id" onchange="val()">
        <option value="0" selected>All Categories</option>
        <?php
        $categories = getCategories();
        while ($row = mysqli_fetch_array($categories)) {
        ?>
        <option value='<?php echo $row["ProductCategoryID"] ?>'><?php echo $row["CategoryName"]; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <div class="col s12 m6">
      <div id="price-slider"></div>
    </div>
    <div class="input-field col s12 m3">
      <select id="select_id2" onchange="val2()">
        <option value="none" selected>Sort by</option>
        <option value="DESC">Desc. Price</option>
        <option value="ASC">Asc. Price</option>
        <option value="REV">***Reviews</option>
        <option value="POP">***Popularity</option>
      </select>
    </div>
    <script type="text/javascript">
      function val() {
        d = document.getElementById("select_id").value;
        href = window.location.href;
        if(!~href.indexOf('cat'))
            window.location.href = href + 'cat=' + d + "&";
        else
            // Regular expression searches for cat=, one or more numbers, and one character
            window.location.href = href.replace(/(cat=)\d+\D/, '$1' + d + "&");
      }

      function val2() {
        d = document.getElementById("select_id2").value;
        href = window.location.href;
        if(!~href.indexOf('order'))
            window.location.href = href + 'order=' + d + "&";
        else
            // Regular expression searches for order=, and one or more characters + & at the end
            window.location.href = href.replace(/(order=)\D+(&)/, '$1' + d + "&");
      }
    </script>
  </div>
  <div class="row">
    <?php
    $prodResult = getProducts();
    while ($row = mysqli_fetch_array($prodResult)) {
      $itemNumber = $row["ItemNumber"];
    ?>
    <a href="product.php?item=<?php echo $itemNumber; ?>">
      <div class="col s12 m3">
        <div class="card">
          <div class="card-image">
            <img src="<?php getImg($itemNumber) ?>">
            <span class="card-title"><?php echo $row["ProductName"]; ?></span>
          </div>
          <div class="card-action">
            <p class="price">$<?php echo $row["Price"]; ?></p>
            <div class="stars right">
              <?php
                $rated = getReviewForProduct($itemNumber);
                $i = 1;
                while ($i <= $rated) {
                  ?>
                  <i class="material-icons tiny rated">star</i>
                  <?php
                  $i++;
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </a>
    <?php
  }
    ?>
  </div>
  <?php
  if(isset($catResult)) {
    while ($row = mysqli_fetch_array($catResult)) {
  ?>
  <div class="row">
    <div class="col s12 m12">
      <h3><?php echo $row["CategoryName"]; ?></h3>
      <p><?php echo $row["Description"]; ?></p>
    </div>
  </div>
  <?php
    }
  }
  ?>
</div>
<?php require_once('includes/footer.php'); ?>
