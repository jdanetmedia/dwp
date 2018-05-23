<?php
// DB Connection


if(isset($_POST["submitreview"])) {
  addReview($_GET["item"]);
}

// Function to get the current item on single productpage
function getCurrentProduct($itemNumber) {
    try {
        $conn = DB::connect();
        $secItem = Security::secureString($itemNumber);

        $statement = "SELECT Product.*, ImgGallery.URL, ProductImg.IsPrimary FROM Product INNER JOIN ProductImg ON ProductImg.ItemNumber = Product.ItemNumber INNER JOIN ImgGallery ON ImgGallery.ImgID = ProductImg.ImgID WHERE Product.ItemNumber = :ItemNumber";
        $handle = $conn->prepare($statement);
        $handle->bindParam(":ItemNumber", $secItem);
        $handle->execute();

        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
        $conn = DB::close();
        return $result;
    }
    catch(\PDOException $ex) {
        return print($ex->getMessage());
    }
}

// Get reviews for current product
function getReviews($itemNumber) {
    try {
        $conn = DB::connect();
        $secItem = Security::secureString($itemNumber);

        $statement = "SELECT * FROM Review WHERE ItemNumber = :ItemNumber";
        $handle = $conn->prepare($statement);
        $handle->bindParam(":ItemNumber", $secItem);
        $handle->execute();

        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
        $conn = DB::close();
        return $result;

    }
    catch(\PDOException $ex) {
        return print($ex->getMessage());
    }
}

// Add review for current product
function addReview($item) {
  $errMsg = "";
  if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
    //your site secret key
    $secret = '6LfRflkUAAAAANg0eaCe2bfDQ4w_khZq5xPDKMy0';
    //get verify response data
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);
    if($responseData->success){
        try {
            $conn = DB::connect();
            $rating = Security::secureString($_POST["rating"]);
            $reviewTitle = Security::secureString($_POST["reviewTitle"]);
            $reviewContent = Security::secureString($_POST["reviewText"]);
            $itemNumber = Security::secureString($item);

            if (isset($_SESSION["FirstName"])) {
              $name = $_SESSION["FirstName"];
            } else {
              $name = "Anonymous";
            }

            $statement = "INSERT INTO Review VALUES (NULL, NULL, :Rating, :ReviewTitle, :Name, :ReviewContent, :ItemNumber)";

            $handle = $conn->prepare($statement);
            $handle->bindParam(":Rating", $rating);
            $handle->bindParam(":ReviewTitle", $reviewTitle);
            $handle->bindParam(":ReviewContent", $reviewContent);
            $handle->bindParam(":ItemNumber", $itemNumber);
            $handle->bindParam(":Name", $name);
            $handle->execute();

            $conn = DB::close();

        } catch(\PDOException $ex) {
            return print($ex->getMessage());
        }
    } else {
      $errMsg .= 'Robot verification failed, please try again.';
    }
  } else {
    $errMsg .= 'Please click on the reCAPTCHA box.';
  }
}

function getRelatedProducts($productCat, $itemNumber) {
    try {
        $conn = DB::connect();
        $itemNumber = Security::secureString($itemNumber);
        $productCat = Security::secureString($productCat);

        $statement = "SELECT ProductImg.IsPrimary, ImgGallery.*, Product.* FROM `Product` INNER JOIN `ProductImg` ON Product.ItemNumber = ProductImg.ItemNumber INNER JOIN `ImgGallery` ON ProductImg.ImgID = ImgGallery.ImgID WHERE IsPrimary = 1 AND Product.ProductStatus = 1 AND Product.ProductCategoryID = :ProductCategoryID AND NOT Product.ItemNumber = :ItemNumber LIMIT 4";
        $handle = $conn->prepare($statement);
        $handle->bindParam(":ProductCategoryID", $productCat);
        $handle->bindParam(":ItemNumber", $itemNumber);
        $handle->execute();

        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
        $conn = DB::close();
        return $result;
    }
    catch(\PDOException $ex) {
        return print($ex->getMessage());
    }
}

function getRelatedProductsForBlog($productCat) {
    try {
        $conn = DB::connect();
        $secProdCat = Security::secureString($productCat);

        $statement = "SELECT ProductImg.IsPrimary, ImgGallery.*, Product.* FROM `Product` INNER JOIN `ProductImg` ON Product.ItemNumber = ProductImg.ItemNumber INNER JOIN `ImgGallery` ON ProductImg.ImgID = ImgGallery.ImgID WHERE IsPrimary = 1 AND Product.ProductStatus = 1 AND Product.ProductCategoryID = :ProductCategoryID LIMIT 4";
        $handle = $conn->prepare($statement);
        $handle->bindParam(":ProductCategoryID", $secProdCat);
        $handle->execute();

        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
        $conn = DB::close();
        return $result;

    }
    catch(\PDOException $ex) {
        return print($ex->getMessage());
    }
}
