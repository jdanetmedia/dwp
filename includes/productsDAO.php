<?php
require_once('connection.php');
$query = "SELECT * FROM `Product` INNER JOIN `ProductImg` ON Product.ItemNumber = ProductImg.ItemNumber
          INNER JOIN `ImgGallery` ON ProductImg.ImgID = ImgGallery.ImgID WHERE IsPrimary = true AND Product.ProductStatus = 1";
if (isset($_GET["cat"])) {
  if ($_GET["cat"] != "0") {
    $cat = $_GET["cat"];
    $query .= " AND `ProductCategoryID` = $cat ";
    $catResult = mysqli_query($connection, "SELECT * FROM `ProductCategory` WHERE `ProductCategoryID` = $cat");
  }
}
// TODO: check if set
if (isset($_GET["cat"]) && $_GET["cat"] != 0) {
  if (isset($_GET["minPrice"]) && $_GET["minPrice"]!= "") {
    $minPrice = $_GET["minPrice"];
    $query .= " AND `Price` >= $minPrice";
  }
} else {
  if (isset($_GET["minPrice"]) && $_GET["minPrice"] != "") {
    $minPrice = $_GET["minPrice"];
    $query .= " AND `Price` >= $minPrice";
  }
}

if (isset($_GET["cat"]) && $_GET["cat"] != 0) {
  if (isset($_GET["maxPrice"]) && $_GET["maxPrice"] != "") {
    $maxPrice = $_GET["maxPrice"];
    $query .= " AND `Price` <= $maxPrice";
  }
} elseif (isset($_GET["maxPrice"]) && $_GET["maxPrice"] != "" && isset($_GET["minPrice"]) && $_GET["minPrice"] != "") {
  $maxPrice = $_GET["maxPrice"];
  $query .= " AND `Price` <= $maxPrice";
} else {
  if (isset($_GET["maxPrice"]) && $_GET["maxPrice"] != "") {
    $maxPrice = $_GET["maxPrice"];
    $query .= " AND `Price` <= $maxPrice";
  }
}

if (isset($_GET["order"])) {
  if ($_GET["order"] != "none") {
    $order = $_GET["order"];
    $query .= " ORDER BY `Price` $order";
  }
}
//echo $query;

function getProducts() {
    global $connection, $query;

    $prodResult = mysqli_query($connection, $query);
    return $prodResult;
}

function getReviewForProduct($itemNumber) {
  global $connection;

  $ratingResult = mysqli_query($connection, "SELECT `Rating` FROM `Review` WHERE ItemNumber = $itemNumber");
  $rated = 0;
  $divide = 0;
  while ($ratingrow = mysqli_fetch_array($ratingResult)) {
    $rating = $ratingrow["Rating"];
    $rated = $rated + $rating;
    $divide = $divide + count($ratingResult);
  }
  $rated = $rated / $divide;

  $i = 1;
  $ratedRemaining = 5 - $rated;
  $i2 = 1;
  while ($i <= $rated) {
    echo "<i class='material-icons tiny rated'>star</i>";
    $i++;
  }
  while($i2 <= $ratedRemaining) {
      echo "<i class='material-icons tiny'>star_border</i>";
    $i2++;
  }
}

function getCategories() {
  global $connection;

  $prodCatResult = mysqli_query($connection, "SELECT * FROM `ProductCategory`");
  return $prodCatResult;
}
?>
