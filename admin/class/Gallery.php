<?php

class Gallery {
  function getAllImages() {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT * FROM ImgGallery");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }
  function attachImage($item, $imgId) {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("INSERT INTO ProductImg (ItemNumber, ImgID, IsPrimary) VALUES ('$item', '$imgId', false)");
      $handle->execute();

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }
}
