<?php

// TODO: Image Resize & crop https://gist.github.com/miguelxt/908143

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

      // Secure input
      $secItem = Security::secureString($item);
      $secImgId = Security::secureString($imgId);

      $countRows = $conn->prepare("SELECT * FROM ProductImg WHERE ItemNumber = :item");
      $countRows->bindParam(":item", $item);
      $countRows->execute();
      $rows = $countRows->fetchAll( \PDO::FETCH_OBJ );
      $numberOfRows = count($rows);

      if($numberOfRows > 0) {
        $handle = $conn->prepare("INSERT INTO ProductImg (ItemNumber, ImgID, IsPrimary) VALUES (:item, :imgID, false)");
        $handle->bindParam(":item", $secItem);
        $handle->bindParam(":imgID", $secImgId);
        $handle->execute();
      } else {
        $handle = $conn->prepare("INSERT INTO ProductImg (ItemNumber, ImgID, IsPrimary) VALUES (:item, :imgID, true)");
        $handle->bindParam(":item", $secItem);
        $handle->bindParam(":imgID", $secImgId);
        $handle->execute();
      }

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
      echo "Nothing selected";
    }
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

      // Check if the system is running on localhost
      $whitelist = array(
          '127.0.0.1',
          '::1'
      );
      if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
        $filepath = $cleanedPath . "/" . $target_file;
      } else {
        $filepath = $path . "/" . $target_file;
      }

      // Secure input
      $secFilepath = Security::secureString($filepath);

      // end check
      $handle = $conn->prepare("INSERT INTO ImgGallery (URL) VALUES (:filepath)");
      if($uploadOk != 0) {
        $handle->bindParam(":filepath", $secFilepath);
        $handle->execute();
      }

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }
}
