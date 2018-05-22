<?php
require_once('../includes/connection.php');
require_once('../admin/class/DB.php');
require_once('../admin/class/Security.php');
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
  /*try {
    $conn = DB::connect();

    $handle = $conn->prepare($query);
    $handle->execute();

  } catch(\PDOException $ex) {
      print($ex->getMessage());
  }*/
    global $connection, $query;

    $prodResult = mysqli_query($connection, $query);
    return $prodResult;
}

function getReviewForProduct($itemNumber) {
    /*try {
         $conn = DB::connect();

         $secItem = Security::secureString($itemNumber);

         $ratingResult = "SELECT `Rating` FROM `Review` WHERE ItemNumber = :ItemNumber";
         $handle = $conn->prepare($ratingResult);
         $handle->bindParam("ItemNumber",$secItem);
         $handle->execute();
         $ratingrow = $handle->fetchAll( \PDO::FETCH_OBJ );

         $rated = 0;
         $divide = 0;
         while ($ratingrow DON*T RUN THIS) {
             $rating = $ratingrow["Rating"];
             $rated = $rated + $rating;
             $divide = $divide + count($ratingResult);
         }
         if ($divide > 0) {
             $rated = $rated / $divide;

             $i = 1;
             $ratedRemaining = 5 - $rated;
             $i2 = 1;
             while ($i <= $rated) {
                 echo "<i class='material-icons tiny rated'>star</i>";
                 $i++;
             }
             while($i2 <= $ratedRemaining) {
                 echo "<i class='material-icons tiny rated'>star_border</i>";
                 $i2++;
             }
         } else {
             $i3 = 1;
             while($i3 <= 5) {
                 echo "<i class='material-icons tiny rated'>star_border</i>";
                 $i3++;
             }
         }

     } catch(\PDOException $ex) {
         print($ex->getMessage());
     }*/

    global $connection;

  $ratingResult = mysqli_query($connection, "SELECT `Rating` FROM `Review` WHERE ItemNumber = $itemNumber");
    $rated = 0;
    $divide = 0;
    while ($ratingrow = mysqli_fetch_array($ratingResult)) {
      $rating = $ratingrow["Rating"];
      $rated = $rated + $rating;
      $divide = $divide + count($ratingResult);
    }
    if ($divide > 0) {
      $rated = $rated / $divide;

      $i = 1;
      $ratedRemaining = 5 - $rated;
      $i2 = 1;
      while ($i <= $rated) {
        echo "<i class='material-icons tiny rated'>star</i>";
        $i++;
      }
      while($i2 <= $ratedRemaining) {
          echo "<i class='material-icons tiny rated'>star_border</i>";
        $i2++;
      }
    } else {
      $i3 = 1;
      while($i3 <= 5) {
          echo "<i class='material-icons tiny rated'>star_border</i>";
        $i3++;
      }
    }
}

function getCategories() {
    /*try {
        $conn = DB::connect();

        $handle = $conn->prepare("SELECT * FROM ProductCategory");
        $handle->execute();

        $result = $handle->fetchAll( \PDO::FETCH_OBJ );
        $conn = DB::close();
        return $result;

    }
    catch(\PDOException $ex) {
        return print($ex->getMessage());
    }*/


  global $connection;

  $prodCatResult = mysqli_query($connection, "SELECT * FROM `ProductCategory`");
  return $prodCatResult;

}
?>
