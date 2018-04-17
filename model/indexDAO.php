<?php
require_once('../includes/connection.php');

function getSlides() {
  global $connection;

  $query = "SELECT * FROM FrontSlider";

  $slideResult = mysqli_query($connection, $query);
  return $slideResult;
}

function getNewestProducts() {
    global $connection;

    $query = "SELECT * FROM Product WHERE Product.ProductStatus = 1 ORDER BY CreationDate DESC LIMIT 5";
    $result = mysqli_query($connection, $query);
    return $result;
}

function getHighestRatedProducts() {
    global $connection;

    $query = "SELECT Review.ItemNumber, Product.ProductName, Product.Price, Product.ProductStatus, AVG(Rating) FROM Review INNER JOIN Product ON Product.ItemNumber = Review.ItemNumber WHERE Product.ProductStatus = 1 GROUP BY ItemNumber ORDER BY AVG(Rating) DESC LIMIT 5";
    $result = mysqli_query($connection, $query);
    return $result;
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
?>
