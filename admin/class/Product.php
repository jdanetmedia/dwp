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

      $handle = $conn->prepare("SELECT Product.*, ImgGallery.ImgID, ImgGallery.URL, ProductImg.IsPrimary FROM Product LEFT JOIN ProductImg ON ProductImg.ItemNumber = Product.ItemNumber LEFT JOIN ImgGallery ON ImgGallery.ImgID = ProductImg.ImgID WHERE Product.ItemNumber = $itemNumber ORDER BY ProductImg.IsPrimary DESC, ProductImg.ImgID ASC");
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
      $handle = $conn->prepare("INSERT INTO ImgGallery (URL) VALUES ('$filepath'); SET @last_id = LAST_INSERT_ID(); INSERT INTO ProductImg (ItemNumber, ImgID, IsPrimary) VALUES ('$item', @last_id, false)");
      $handle->execute();

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }
  function updatePrimary($item, $id) {
	  $conn = connectToDB();

	  $handle = $conn->prepare("
	  	UPDATE ProductImg SET IsPrimary = false WHERE ItemNumber = '{$item}';
      UPDATE ProductImg SET IsPrimary = true WHERE ImgID = '{$id}';
	  ");
    $handle->execute();

    $conn = null;
  }

  function removeImg($id) {
    $conn = connectToDB();

    $handle = $conn->prepare("DELETE FROM ProductImg WHERE ImgID = '{$id}'");
    $handle->execute();
  }

  function exportJSON() {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT * FROM Product");
      $handle->execute();
      $json_final_data = array();

      foreach ($handle as $row) {
        $json_temp_array['ItemNumber'] = $row['ItemNumber'];
        $json_temp_array['ProductName'] = $row['ProductName'];
        $json_temp_array['StockStatus'] = $row['StockStatus'];
        $json_temp_array['ShortDescription'] = $row['ShortDescription'];
        $json_temp_array['LongDescription'] = $row['LongDescription'];
        $json_temp_array['ProductName'] = $row['ProductName'];
        $json_temp_array['Price'] = $row['Price'];
        $json_temp_array['OfferPrice'] = $row['OfferPrice'];
        $json_temp_array['SeoTitel'] = $row['SeoTitel'];
        $json_temp_array['MetaDescription'] = $row['MetaDescription'];
        $json_temp_array['ProductStatus'] = $row['ProductStatus'];
        $json_temp_array['CreationDate'] = $row['CreationDate'];
        $json_temp_array['UserEmail'] = $row['UserEmail'];
        $json_temp_array['ProductCategoryID'] = $row['ProductCategoryID'];
        array_push($json_final_data, $json_temp_array); //add this row ($json_temp_array) to the end of the array
      }
      return json_encode($json_final_data);
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }
  function importJSON($file) {
    try {
      $conn = connectToDB();
      $json_data = file_get_contents($file);
      $data = json_decode($json_data,true); //decode the json file and return as array
      $stmt = $conn->prepare('INSERT INTO Product (ItemNumber, ProductName, StockStatus, ShortDescription, LongDescription, Price, OfferPrice, SeoTitel, MetaDescription, ProductStatus, CreationDate, UserEmail, ProductCategoryID) VALUES (:ItemNumber, :ProductName, :StockStatus, :ShortDescription, :LongDescription, :Price, :OfferPrice, :SeoTitel, :MetaDescription, :ProductStatus, :CreationDate, :UserEmail, :ProductCategoryID)');
      foreach ($data as $row) //iterate through each row/object in the json file
      {
        $stmt->bindParam(':ItemNumber', $row['ItemNumber']);
        $stmt->bindParam(':ProductName', $row['ProductName']);
        $stmt->bindParam(':StockStatus', $row['StockStatus']);
        $stmt->bindParam(':ShortDescription', $row['ShortDescription']);
        $stmt->bindParam(':LongDescription', $row['LongDescription']);
        $stmt->bindParam(':Price', $row['Price']);
        $stmt->bindParam(':OfferPrice', $row['OfferPrice']);
        $stmt->bindParam(':SeoTitel', $row['SeoTitel']);
        $stmt->bindParam(':MetaDescription', $row['MetaDescription']);
        $stmt->bindParam(':ProductStatus', $row['ProductStatus']);
        $stmt->bindParam(':CreationDate', $row['CreationDate']);
        $stmt->bindParam(':UserEmail', $row['UserEmail']);
        $stmt->bindParam(':ProductCategoryID', $row['ProductCategoryID']);
        $stmt->execute();
      }
    }
    catch(\PDOException $ex)
    {
      print($ex->getMessage());
    }
  }
}
