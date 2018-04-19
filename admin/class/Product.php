<?php

class Product {
  private $itemNumber;

  function getAllProducts() {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT * FROM Product");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function searchResult($search) {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT * FROM Product WHERE ProductName LIKE '%{$search}%' OR ShortDescription LIKE '%{$search}%' OR LongDescription LIKE '%{$search}%'");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function getProductDetails($itemNumber) {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT Product.*, ImgGallery.URL, ImgGallery.IsPrimary FROM Product INNER JOIN ProductImg ON ProductImg.ItemNumber = Product.ItemNumber INNER JOIN ImgGallery ON ImgGallery.ImgID = ProductImg.ImgID WHERE Product.ItemNumber = $itemNumber");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      return $result;

      // $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function getCategories() {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT * FROM ProductCategory");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function updateProduct($itemNumber) {
      global $connection;

      $productName = $_POST["ProductName"];
      $productCategoryID = $_POST["ProductCategoryID"];
      $productStatus = $_POST["ProductStatus"];
      $shortDescription = $_POST["ShortDescription"];
      $longDescription = $_POST["LongDescription"];
      $price = $_POST["Price"];
      $offerPrice = $_POST["OfferPrice"];
      $stockStatus = $_POST["StockStatus"];
      $seoTitel = $_POST["SeoTitel"];
      $metaDescription = $_POST["MetaDescription"];


      $query = "
        UPDATE Product
        SET ProductName = '{$productName}',
        ProductCategoryID = '{$productCategoryID}',
        ProductStatus = '{$productStatus}',
        ShortDescription = '{$shortDescription}',
        LongDescription = '{$longDescription}',
        Price = '{$price}',
        OfferPrice = '{$offerPrice}',
        StockStatus = '{$stockStatus}',
        SeoTitel = '{$seoTitel}',
        MetaDescription = '{$metaDescription}'
        WHERE ItemNumber = '{$itemNumber}'";

      $updateProd = mysqli_query($connection, $query);
  }

  function uploadImages($img, $item) {
    $target_dir = "productimgs/";
    $target_file = $target_dir . basename($img["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check = getimagesize($img["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    // Check file size
    if ($img["fileToUpload"]["size"] > 5000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($img["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $img["fileToUpload"]["name"]). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
    // Save to database
    try {
      $conn = connectToDB();
      $path = $_SERVER["DOCUMENT_ROOT"] . getcwd();
      $cleanedPath = str_replace('/Applications/MAMP/htdocs/Applications/MAMP/htdocs', 'http://localhost:8888', $path);
      $filepath = $cleanedPath . "/" . $target_file;

      // $handle = $conn->prepare("
      //   INSERT INTO ImgGallery ('URL') VALUES ('$filename');
      //   SET @last_id = LAST_INSERT_ID();
      //   INSERT INTO ProductImg ('ItemNumber', 'ImgID') VALUES ('$item', @last_id);
      // ");
      $primary = $_GET["makePrimary"];
      $handle = $conn->prepare("INSERT INTO ImgGallery (URL, IsPrimary) VALUES ('$filepath', '$primary'); SET @last_id = LAST_INSERT_ID(); INSERT INTO ProductImg (ItemNumber, ImgID) VALUES ('$item', @last_id)");
      $handle->execute();

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }
}
