<?php
require_once("../includes/connection.php");

function getAllProducts() {
  global $connection;

  $query = "SELECT * FROM Product";
  $result = mysqli_query($connection, $query);
  return $result;
}

function searchResult($search) {
  global $connection;

  $query = "SELECT * FROM Product WHERE ProductName LIKE '%{$search}%' OR ShortDescription LIKE '%{$search}%' OR LongDescription LIKE '%{$search}%'";
  $result = mysqli_query($connection, $query);
  return $result;
}

function getProductDetails($itemNumber) {
  global $connection;

  //$query = "SELECT * FROM Product INNER JOIN ProductImg ON ProductImg.ItemNumber = Product.ItemNumber INNER JOIN ImgGallery ON ProductImg.ImgID =  ImgGallery.ImgID WHERE Product.ItemNumber = $itemNumber";
  $query = "SELECT Product.*, ImgGallery.URL FROM Product INNER JOIN ProductImg ON ProductImg.ItemNumber = Product.ItemNumber INNER JOIN ImgGallery ON ImgGallery.ImgID = ProductImg.ImgID WHERE Product.ItemNumber = $itemNumber";
  $result = mysqli_query($connection, $query);
  return $result;
}

function getCategories() {
  global $connection;

  $query = "SELECT * FROM ProductCategory";
  $result = mysqli_query($connection, $query);
  return $result;
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
