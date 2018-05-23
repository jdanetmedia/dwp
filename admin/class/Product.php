<?php

class Product {
  private $itemNumber;

  function getAllProducts() {
    try {
      $conn = DB::connect();

      $handle = $conn->prepare("SELECT * FROM Product");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      $conn = DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function searchResult($search) {
    try {
      $conn = DB::connect();

      $secSearch = Security::secureString($search);

      $handle = $conn->prepare("SELECT * FROM Product WHERE ProductName LIKE :search OR ShortDescription LIKE :search OR LongDescription LIKE :search OR ItemNumber LIKE :search");
      $newSearch = "%$secSearch%";
      $handle->bindParam(":search", $newSearch);
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      $conn = DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function getProductDetails($itemNumber) {
    try {
      $conn = DB::connect();

      $secItem = Security::secureString($itemNumber);

      $handle = $conn->prepare("SELECT Product.*, ImgGallery.ImgID, ImgGallery.URL, ProductImg.IsPrimary FROM Product LEFT JOIN ProductImg ON ProductImg.ItemNumber = Product.ItemNumber LEFT JOIN ImgGallery ON ImgGallery.ImgID = ProductImg.ImgID WHERE Product.ItemNumber = :item ORDER BY ProductImg.IsPrimary DESC, ProductImg.ImgID ASC");
      $handle->bindParam(":item", $secItem);
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      return $result;

      $conn = DB::close();
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

      $conn = DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function saveProduct($itemNumber) {
    try {
      $conn = DB::connect();

      $itemNumber = Security::secureString($_POST["ItemNumber"]);
      $productName = Security::secureString($_POST["ProductName"]);
      $productCategoryID = Security::secureString($_POST["ProductCategoryID"]);
      $productStatus = Security::secureString($_POST["ProductStatus"]);
      $shortDescription = Security::secureString($_POST["ShortDescription"]);
      $longDescription = Security::secureString($_POST["LongDescription"]);
      $price = Security::secureString($_POST["Price"]);
      $offerPrice = Security::secureString($_POST["OfferPrice"]);
      $stockStatus = Security::secureString($_POST["StockStatus"]);
      $seoTitle = Security::secureString($_POST["SeoTitle"]);
      $metaDescription = Security::secureString($_POST["MetaDescription"]);
      $creationDate = Security::secureString(date('Y/m/d H:i:s', time()));
      $userEmail = Security::secureString($_SESSION["UserEmail"]);

      $query = "INSERT INTO Product (ItemNumber, ProductName, ProductCategoryID, ProductStatus, ShortDescription, LongDescription, Price, OfferPrice, StockStatus, SeoTitle, MetaDescription, CreationDate, UserEmail)
                VALUES (:itemNumber, :productName, :productCategoryID, :productStatus, :shortDescription, :longDescription, :price, :offerPrice, :stockStatus, :seoTitle, :metaDescription, :creationDate, :userEmail)";

      $handle = $conn->prepare($query);
      $handle->bindParam(":itemNumber", $itemNumber);
      $handle->bindParam(":productName", $productName);
      $handle->bindParam(":productCategoryID", $productCategoryID);
      $handle->bindParam(":productStatus", $productStatus);
      $handle->bindParam(":shortDescription", $shortDescription);
      $handle->bindParam(":longDescription", $longDescription);
      $handle->bindParam(":price", $price);
      $handle->bindParam(":offerPrice", $offerPrice);
      $handle->bindParam(":stockStatus", $stockStatus);
      $handle->bindParam(":seoTitle", $seoTitle);
      $handle->bindParam(":metaDescription", $metaDescription);
      $handle->bindParam(":creationDate", $creationDate);
      $handle->bindParam(":userEmail", $userEmail);
      $handle->execute();

      $conn = DB::close();
    }
    catch(\PDOExeption $ex) {
      print($ex->getMessage());
    }
  }

  function updateProduct($itemNumber) {
      try {
        $conn = DB::connect();

        $itemNumber = Security::secureString($itemNumber);
        $productName = Security::secureString($_POST["ProductName"]);
        $productCategoryID = Security::secureString($_POST["ProductCategoryID"]);
        $productStatus = Security::secureString($_POST["ProductStatus"]);
        $shortDescription = Security::secureString($_POST["ShortDescription"]);
        $longDescription = Security::secureString($_POST["LongDescription"]);
        $price = Security::secureString($_POST["Price"]);
        $offerPrice = Security::secureString($_POST["OfferPrice"]);
        $stockStatus = Security::secureString($_POST["StockStatus"]);
        $seoTitle = Security::secureString($_POST["SeoTitle"]);
        $metaDescription = Security::secureString($_POST["MetaDescription"]);

        $query = "
          UPDATE Product
          SET ProductName = :productName,
          ProductCategoryID = :productCategoryID,
          ProductStatus = :productStatus,
          ShortDescription = :shortDescription,
          LongDescription = :longDescription,
          Price = :price,
          OfferPrice = :offerPrice,
          StockStatus = :stockStatus,
          SeoTitle = :seoTitle,
          MetaDescription = :metaDescription
          WHERE ItemNumber = :itemNumber";

        $handle = $conn->prepare($query);
        $handle->bindParam(":itemNumber", $itemNumber);
        $handle->bindParam(":productName", $productName);
        $handle->bindParam(":productCategoryID", $productCategoryID);
        $handle->bindParam(":productStatus", $productStatus);
        $handle->bindParam(":shortDescription", $shortDescription);
        $handle->bindParam(":longDescription", $longDescription);
        $handle->bindParam(":price", $price);
        $handle->bindParam(":offerPrice", $offerPrice);
        $handle->bindParam(":stockStatus", $stockStatus);
        $handle->bindParam(":seoTitle", $seoTitle);
        $handle->bindParam(":metaDescription", $metaDescription);
        $handle->execute();

        $conn = DB::close();
      }
      catch(\PDOException $ex) {
        print($ex->getMessage());
      }
  }

  function updatePrimary($item, $id) {
	  $conn = DB::connect();

    $secItem = Security::secureString($item);
    $secId = Security::secureString($id);

	  $handle = $conn->prepare("
	  	UPDATE ProductImg SET IsPrimary = false WHERE ItemNumber = :item;
      UPDATE ProductImg SET IsPrimary = true WHERE ImgID = :id;
	  ");
    $handle->bindParam(":item", $secItem);
    $handle->bindParam(":id", $secId);
    $handle->execute();
    $conn = DB::close();
  }

  function removeImg($id) {
    $conn = DB::connect();

    $secId = Security::secureString($id);

    $handle = $conn->prepare("DELETE FROM ProductImg WHERE ImgID = :id");
    $handle->bindParam(":id", $secId);
    $handle->execute();
    $conn = DB::close();
  }

  function exportJSON() {
    try {
      $conn = DB::connect();

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

      $conn = DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }
  function importJSON($file) {
    try {
      $conn = DB::connect();
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

      $conn = DB::close();
    }
    catch(\PDOException $ex)
    {
      print($ex->getMessage());
    }
  }
}
