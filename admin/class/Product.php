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

  function saveProduct($itemNumber) {
    try {
      $conn = connectToDB();

      $itemNumber = $_POST["ItemNumber"];
      $productName = $_POST["ProductName"];
      $productCategoryID = $_POST["ProductCategoryID"];
      $productStatus = $_POST["ProductStatus"];
      $shortDescription = $_POST["ShortDescription"];
      $longDescription = $_POST["LongDescription"];
      $price = $_POST["Price"];
      $offerPrice = $_POST["OfferPrice"];
      $stockStatus = $_POST["StockStatus"];
      $seoTitle = $_POST["SeoTitle"];
      $metaDescription = $_POST["MetaDescription"];
      $creationDate = date('m/d/Y', time());
      $userEmail = "rasmus.andreas96@gmail.com";

      $query = "INSERT INTO Product (ItemNumber, ProductName, ProductCategoryID, ProductStatus, ShortDescription, LongDescription, Price, OfferPrice, StockStatus, SeoTitle, MetaDescription, CreationDate, UserEmail)
                VALUES ('{$itemNumber}', '{$productName}', '{$productCategoryID}', '{$productStatus}', '{$shortDescription}','{$longDescription}', '{$price}', '{$offerPrice}', '{$stockStatus}', '{$seoTitle}', '{$metaDescription}', '{$creationDate}', '{$userEmail}')";

      $handle = $conn->prepare($query);
      $handle->execute();
    }
    catch(\PDOExeption $ex) {
      print($ex->getMessage());
    }
  }

  function updateProduct($itemNumber) {
      try {
        $conn = connectToDB();

        $productName = $_POST["ProductName"];
        $productCategoryID = $_POST["ProductCategoryID"];
        $productStatus = $_POST["ProductStatus"];
        $shortDescription = $_POST["ShortDescription"];
        $longDescription = $_POST["LongDescription"];
        $price = $_POST["Price"];
        $offerPrice = $_POST["OfferPrice"];
        $stockStatus = $_POST["StockStatus"];
        $seoTitle = $_POST["SeoTitle"];
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
          SeoTitle = '{$seoTitle}',
          MetaDescription = '{$metaDescription}'
          WHERE ItemNumber = '{$itemNumber}'";

        $handle = $conn->prepare($query);
        $handle->execute();
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
        $json_temp_array['SeoTitle'] = $row['SeoTitle'];
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
      $stmt = $conn->prepare('INSERT INTO Product (ItemNumber, ProductName, StockStatus, ShortDescription, LongDescription, Price, OfferPrice, SeoTitle, MetaDescription, ProductStatus, CreationDate, UserEmail, ProductCategoryID) VALUES (:ItemNumber, :ProductName, :StockStatus, :ShortDescription, :LongDescription, :Price, :OfferPrice, :SeoTitle, :MetaDescription, :ProductStatus, :CreationDate, :UserEmail, :ProductCategoryID)');
      foreach ($data as $row) //iterate through each row/object in the json file
      {
        $stmt->bindParam(':ItemNumber', $row['ItemNumber']);
        $stmt->bindParam(':ProductName', $row['ProductName']);
        $stmt->bindParam(':StockStatus', $row['StockStatus']);
        $stmt->bindParam(':ShortDescription', $row['ShortDescription']);
        $stmt->bindParam(':LongDescription', $row['LongDescription']);
        $stmt->bindParam(':Price', $row['Price']);
        $stmt->bindParam(':OfferPrice', $row['OfferPrice']);
        $stmt->bindParam(':SeoTitle', $row['SeoTitle']);
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
