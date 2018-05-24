<?php

// TODO: Image Resize & crop https://gist.github.com/miguelxt/908143

class Gallery {
  function getAllImages($item = NULL) {
    try {
      $conn = DB::connect();

      if(isset($item)) {
        // Secure input
        $item = Security::secureString($item);

        $handle = $conn->prepare("SELECT * FROM ImgGallery WHERE ImgID NOT IN (SELECT ImgID FROM ProductImg WHERE ItemNumber = :item)");
        $handle->bindParam(":item", $item);
      } else {
        $handle = $conn->prepare("SELECT * FROM ImgGallery WHERE URL NOT IN (SELECT LogoURL FROM BasicPageInfo)");
        $handle->bindParam(":item", $item);
      }
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      $conn = DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }
  function attachImage($item, $imgId, $type) {
    try {
      $conn = DB::connect();

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

      $conn = DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
      echo "Nothing selected";
    }
  }

  function addLogo($id) {
    try {
      $conn = DB::connect();

      // Secure input
      $id = Security::secureString($id);

      $getLogoUrl = $conn->prepare("SELECT URL FROM ImgGallery WHERE ImgID = :id");
      $getLogoUrl->bindParam(":id", $id);
      $getLogoUrl->execute();

      $logo = $getLogoUrl->fetchAll( \PDO::FETCH_ASSOC );
      $logoURL = $logo[0]["URL"];

      $query = "UPDATE BasicPageInfo SET LogoURL = :logoURL";
      $handle = $conn->prepare($query);
      $handle->bindParam(":logoURL", $logoURL);
      $handle->execute();

      $conn = DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function addSlideImg($imgID, $slideID) {
    try {
      $conn = DB::connect();

      $imgID = Security::secureString($imgID);
      $slideID = Security::secureString($slideID);

      $getSlideImg = $conn->prepare("SELECT URL FROM ImgGallery WHERE ImgID = :imgID");
      $getSlideImg->bindParam(":imgID", $imgID);
      $getSlideImg->execute();

      $slideImg = $getSlideImg->fetchAll( \PDO::FETCH_ASSOC );
      $slideImgUrl = $slideImg[0]["URL"];

      $query = "UPDATE FrontSlider SET SliderImg = :SliderImg WHERE SlideID = :slideID";
      $handle = $conn->prepare($query);
      $handle->bindParam(":SliderImg", $slideImgUrl);
      $handle->bindParam(":slideID", $slideID);
      $handle->execute();

      $conn = DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function uploadImage($img, $type) {
    $target_dir = "img/";
    $target_file = $target_dir . basename(strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/','', $img["fileToUpload"]["name"])));
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

    $image = new SimpleImage($target_file);
    if($type == "logo") {
      // Resize image to 312 x 135 px and fill with green
      $image->resizeToWidth(312);
      $image->maxareafill(312,135,21,149,135);
    } elseif($type == "slide") {
      // Rezise and crop to 1170 x 400 px
      $image->resizeToWidth(1170);
      $image->cutFromCenter(1170,400);
    } else {
      // Resize and crop image to 800 x 800 px
      $image->resizeToWidth(800);
      $image->square(800);
    }
    $image->save($target_file);

    // Save to database
    try {
      $conn = DB::connect();

      // Check if the system is running on localhost
      $whitelist = array(
          '127.0.0.1',
          '::1'
      );

      if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
        $filepath = (isset($_SERVER["HTTPS"]) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . "/" . "dwp" . "/" . "admin" . "/" . $target_file;
      } else {
        $filepath = (isset($_SERVER["HTTPS"]) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . "/" . "admin" . "/" . $target_file;
      }

      // Secure input
      $secFilepath = Security::secureString($filepath);

      // end check
      $handle = $conn->prepare("INSERT INTO ImgGallery (URL) VALUES (:filepath)");
      if($uploadOk != 0) {
        $handle->bindParam(":filepath", $secFilepath);
        $handle->execute();
      }

      $conn = DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }
}
