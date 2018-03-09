<?php
require_once('connection.php');
$query = "SELECT * FROM `Product`";
if (isset($_GET["cat"])) {
  if ($_GET["cat"] != "0") {
    $cat = $_GET["cat"];
    $query = "SELECT * FROM `Product` WHERE `ProductCategoryID` = $cat ";
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
    $query .= " WHERE `Price` >= $minPrice";
  }
}

if (isset($_GET["cat"]) && $_GET["cat"] != 0) {
  if ($_GET["maxPrice"] != "") {
    $maxPrice = $_GET["maxPrice"];
    $query .= " AND `Price` <= $maxPrice";
  }
} elseif (isset($_GET["maxPrice"]) && $_GET["maxPrice"] != "" && isset($_GET["minPrice"]) && $_GET["minPrice"] != "") {
  $maxPrice = $_GET["maxPrice"];
  $query .= " AND `Price` <= $maxPrice";
} else {
  if (isset($_GET["maxPrice"]) && $_GET["maxPrice"] != "") {
    $maxPrice = $_GET["maxPrice"];
    $query .= " WHERE `Price` <= $maxPrice";
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

function getImg($itemNumber) {
  global $connection;

  $imgResult = mysqli_query($connection, "SELECT `ImgID` FROM `ProductImg` WHERE ItemNumber = $itemNumber");
  while ($imgrow = mysqli_fetch_array($imgResult)) {
    $imgID = $imgrow["ImgID"];
    $imgResult2 = mysqli_query($connection, "SELECT `URL` FROM `ImgGallery` WHERE ImgID = $imgID AND IsPrimary = true");
    while ($imgrow2 = mysqli_fetch_array($imgResult2)) {
      echo $imgrow2["URL"];
    }
  }
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
  return array($rated, $divide);
}

function getCategories() {
  global $connection;

  $prodCatResult = mysqli_query($connection, "SELECT * FROM `ProductCategory`");
  return $prodCatResult;
}
?>
