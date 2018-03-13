<?php require_once('includes/header.php');
require_once('includes/productsDAO.php');
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
    <form action="products.php" method="get">
      <div class="input-field col s12 m3">
        <select name="cat" id="select_id">
          <option value="0" selected>All Categories</option>
          <?php
          $categories = getCategories();
          while ($row = mysqli_fetch_array($categories)) {
            if ($_GET["cat"] == $row["ProductCategoryID"]) {
              ?>
              <option selected value='<?php echo $row["ProductCategoryID"] ?>'><?php echo $row["CategoryName"]; ?></option>
              <?php
            } else {
          ?>
          <option value='<?php echo $row["ProductCategoryID"] ?>'><?php echo $row["CategoryName"]; ?></option>
          <?php
            }
          }
          ?>
        </select>
      </div>
      <div class="col s12 m4">
        <div class="input-field col s6">
          <?php
          if(isset($_GET["minPrice"])) {
            if($_GET["minPrice"] != 0) {
          ?>
          <input value="<?php echo $_GET["minPrice"]; ?>" name="minPrice" id="minPrice" type="number" class="validate">
        <?php
      } else {
        ?>
        <input name="minPrice" id="minPrice" type="number" class="validate">
        <?php
    }} else { ?>
          <input name="minPrice" id="minPrice" type="number" class="validate">
        <?php } ?>
          <label class="active" for="minPrice2">Min. Price</label>
        </div>
        <div class="input-field col s6">
          <?php
          if(isset($_GET["maxPrice"])) {
            if($_GET["maxPrice"] != 0) {
          ?>
          <input value="<?php echo $_GET["maxPrice"]; ?>" name="maxPrice" id="maxPrice" type="number" class="validate">
        <?php
      } else {
        ?>
        <input name="maxPrice" id="maxPrice" type="number" class="validate">
        <?php
    }} else { ?>
          <input name="maxPrice" id="maxPrice" type="number" class="validate">
        <?php } ?>
          <label class="active" for="maxPrice2">Max Price</label>
        </div>
      </div>
      <div class="input-field col s12 m3">
        <select name="order" id="select_id2">
          <?php
          $sorting = array(
            array("none", "Sort by"),
            array("DESC", "Desc. Price"),
            array("ASC", "Asc. Price"),
            array("REV", "***Reviews"),
            array("POP", "***Popularity")
          );
          ?>
          <option value="none">Sort by</option>
          <option value="DESC">Desc. Price</option>
          <option value="ASC">Asc. Price</option>
          <option value="REV">***Reviews</option>
          <option value="POP">***Popularity</option>
        </select>
        <?php
        for ($row = 0; $row < 4; $row++) {
          for ($col = 0; $col < 3; $col++) {
            echo $sorting[$row][$col]. "<br>";
          }
        } ?>
      </div>
      <input type="submit" class="waves-effect waves-light btn" value="Filter">
    </form>
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
                echo getReviewForProduct($itemNumber);
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
