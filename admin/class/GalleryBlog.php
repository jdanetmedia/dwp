<?php

class GalleryBlog {
    function getAllImages() {
        try {
            $conn = DB::connect();

            $handle = $conn->prepare("SELECT * FROM ImgGallery");
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_OBJ );
            DB::close();
            return $result;
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    function attachImage($blogPostID, $imgID) {
        try {
            $conn = DB::connect();

            // Secure input
            $secPostId = Security::secureString($blogPostID);
            $secImgId = Security::secureString($imgID);

            $countRows = $conn->prepare("SELECT * FROM BlogImg WHERE BlogPostID = :BlogPostID");
            $countRows->bindParam(":BlogPostID", $secPostId);
            $countRows->execute();
            $rows = $countRows->fetchAll( \PDO::FETCH_OBJ );
            $numberOfRows = count($rows);

            if($numberOfRows > 0) {
                $handle = $conn->prepare("UPDATE BlogImg SET ImgID = :ImgID WHERE BlogPostID = :BlogPostID");
                $handle->bindParam(":ImgID", $secImgId);
                $handle->bindParam(":BlogPostID", $secPostId);
                $handle->execute();
            } else {
                $handle = $conn->prepare("INSERT INTO BlogImg (BlogPostID, ImgID) VALUES (:BlogPostID, :ImgID)");
                $handle->bindParam(":ImgID", $secImgId);
                $handle->bindParam(":BlogPostID", $secPostId);
                $handle->execute();
            }

            DB::close();
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    function uploadImages($img) {
        $target_dir = "blogimgs/";
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
            $conn = DB::connect();
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
            $handle->bindParam(":filepath", $secFilepath);
            if($uploadOk != 0) {
                $handle->execute();
            }

            DB::close();
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
    }
}
