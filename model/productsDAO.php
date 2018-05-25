<?php

$query = "SELECT * FROM `Product` LEFT JOIN `ProductImg` ON Product.ItemNumber = ProductImg.ItemNumber
          LEFT JOIN `ImgGallery` ON ProductImg.ImgID = ImgGallery.ImgID WHERE Product.ProductStatus = 1 AND ProductImg.IsPrimary = 1";
if (isset($_GET["cat"])) {
  if ($_GET["cat"] != "0") {
    $cat = $_GET["cat"];
    $query .= " AND `ProductCategoryID` = $cat ";
    try {
      $conn = DB::connect();

      $handle = $conn->prepare("SELECT * FROM `ProductCategory` WHERE `ProductCategoryID` = $cat");
      $handle->execute();
      $catResult = $handle->fetchAll( \PDO::FETCH_ASSOC);

    } catch(\PDOException $ex) {
        print($ex->getMessage());
    }

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

function getProducts($query) {
  try {
    $conn = DB::connect();

    $handle = $conn->prepare($query);
    $handle->execute();
    $result = $handle->fetchAll( \PDO::FETCH_ASSOC);
    return $result;

  } catch(\PDOException $ex) {
      print($ex->getMessage());
  }
}

function getReviewForProduct($itemNumber) {
    try {
         $conn = DB::connect();

         $secItem = Security::secureString($itemNumber);

         $ratingResult = "SELECT `Rating` FROM `Review` WHERE ItemNumber = :ItemNumber";
         $handle = $conn->prepare($ratingResult);
         $handle->bindParam("ItemNumber",$secItem);
         $handle->execute();
         $ratings = $handle->fetchAll( \PDO::FETCH_ASSOC );
         $rated = 0;
         $divide = count($ratings);
         foreach ($ratings as $ratingrow) {
             $rating = $ratingrow["Rating"];
             $rated = $rated + $rating;
         }
         if ($divide > 0) {
             $rated = $rated / $divide;
             $rated = round($rated);
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
     }
}

function getCategories() {
    try {
        $conn = DB::connect();

        $handle = $conn->prepare("SELECT * FROM ProductCategory");
        $handle->execute();

        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
        $conn = DB::close();
        return $result;

    }
    catch(\PDOException $ex) {
        return print($ex->getMessage());
    }
}
?>
