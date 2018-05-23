<?php


function getAllProducts() {
  try {
    $conn = DB::connect();

    $handle = $conn->prepare("SELECT * FROM Product");
    $handle->execute();

    $result = $handle->fetchAll( \PDO::FETCH_OBJ );
    return $result;

    DB::close();
  }
  catch(\PDOException $ex) {
    print($ex->getMessage());
  }
}

function searchResult($search) {
  try {
    $conn = DB::connect();

    $handle = $conn->prepare("SELECT * FROM Product WHERE ProductName LIKE '%{$search}%' OR ShortDescription LIKE '%{$search}%' OR LongDescription LIKE '%{$search}%'");
    $handle->execute();

    $result = $handle->fetchAll( \PDO::FETCH_OBJ );
    return $result;

    DB::close();
  }
  catch(\PDOException $ex) {
    print($ex->getMessage());
  }
}

function getProductDetails($itemNumber) {
  try {
    $conn = DB::connect();

    $handle = $conn->prepare("SELECT Product.*, ImgGallery.URL FROM Product INNER JOIN ProductImg ON ProductImg.ItemNumber = Product.ItemNumber INNER JOIN ImgGallery ON ImgGallery.ImgID = ProductImg.ImgID WHERE Product.ItemNumber = $itemNumber");
    $handle->execute();

    $result = $handle->fetchAll( \PDO::FETCH_OBJ );
    return $result;

    DB::close();
  }
  catch(\PDOException $ex) {
    print($ex->getMessage());
  }
}

function getCategories() {
  try {
    $conn = DB::connect();

    $handle = $conn->prepare("SELECT * FROM ProductCategory");
    $handle->execute();

    $result = $handle->fetchAll( \PDO::FETCH_OBJ );
    return $result;

    DB::close();
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

function uploadImages($img) {
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
  if ($img["fileToUpload"]["size"] > 500000) {
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
}
