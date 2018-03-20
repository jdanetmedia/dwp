<?php require_once('includes/header.php');
require_once('includes/productsDAO.php');
$url = $_SERVER['REQUEST_URI'];
//echo "<br>". $url;
?>
<script type="text/javascript">
  if(window.location.href.indexOf("?") > -1) {
  } else {
  window.location.search += '?';
  }
</script>
<div class="container">
  <?php
  require_once('includes/filter.php');
  ?>
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
            <img src="<?php echo $row["URL"]; ?>">
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
