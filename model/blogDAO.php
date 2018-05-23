<?php
if (isset($_GET["cat"])) {
  if ($_GET["cat"] != "0") {
    try {
        $conn = DB::connect();

        $cat = Security::secureString($_GET["cat"]);

        $query = "SELECT * FROM `BlogCategory` WHERE `BlogCategoryID` = :cat";

        $handle = $conn->prepare($query);
        $handle->bindParam(':cat', $cat);
        $handle->execute();

        $catResult = $handle->fetchAll( \PDO::FETCH_ASSOC );
        $conn = DB::close();
        return $catResult;

    }
    catch(\PDOException $ex) {
        return print($ex->getMessage());
    }
  }
}

function getAllPosts() {
  try {
      $conn = DB::connect();

      $query = "SELECT BlogPost.*, ImgGallery.* FROM `BlogPost` LEFT JOIN `BlogImg` ON BlogPost.BlogPostID = BlogImg.BlogPostID LEFT JOIN `ImgGallery` ON BlogImg.ImgID = ImgGallery.ImgID ORDER BY BlogPostID DESC";
      if (isset($_GET["cat"])) {
        if ($_GET["cat"] != "0") {
          $cat = $_GET["cat"];
          $cat = Security::secureString($cat);
          $query = "SELECT BlogPost.*, ImgGallery.* FROM `BlogPost` LEFT JOIN `BlogImg` ON BlogPost.BlogPostID = BlogImg.BlogPostID LEFT JOIN `ImgGallery` ON BlogImg.ImgID = ImgGallery.ImgID WHERE `BlogCategoryID` = :cat ORDER BY BlogPostID DESC";
          $catquery = "SELECT * FROM `ProductCategory` WHERE `ProductCategoryID` = :cat";
          $handle = $conn->prepare($catquery);
          $handle->bindParam(':cat', $cat);
          $handle->execute();
        }
      }

      $handle = $conn->prepare($query);
      $handle->bindParam(':cat', $cat);
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      $conn = DB::close();
      return $result;

  }
  catch(\PDOException $ex) {
      return print($ex->getMessage());
  }

}

function getAllRelatedPosts($categoryID, $postID) {
  try {
      $conn = DB::connect();

      $categoryID = Security::secureString($categoryID);
      $postID = Security::secureString($postID);

      $query = "SELECT BlogPost.*, ImgGallery.* FROM `BlogPost` LEFT JOIN `BlogImg` ON BlogPost.BlogPostID = BlogImg.BlogPostID LEFT JOIN `ImgGallery` ON BlogImg.ImgID = ImgGallery.ImgID WHERE `BlogCategoryID` = :catid AND NOT BlogPost.BlogPostID = :postid";

      $handle = $conn->prepare($query);
      $handle->bindParam(':catid', $categoryID);
      $handle->bindParam(':postid', $postID);
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      $conn = DB::close();
      return $result;

  }
  catch(\PDOException $ex) {
      return print($ex->getMessage());
  }
}

function getPost($blogID) {
  try {
      $conn = DB::connect();

      $blogID = Security::secureString($blogID);

      $query = "SELECT BlogPost.*, ImgGallery.ImgID, ImgGallery.URL FROM BlogPost LEFT JOIN BlogImg ON BlogImg.BlogPostID = BlogPost.BlogPostID LEFT JOIN ImgGallery ON ImgGallery.ImgID = BlogImg.ImgID WHERE BlogPost.BlogPostID = :blogid ORDER BY BlogImg.ImgID ASC";
      $handle = $conn->prepare($query);
      $handle->bindParam(':blogid', $blogID);
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      $conn = DB::close();
      return $result;

  }
  catch(\PDOException $ex) {
      return print($ex->getMessage());
  }
}

function getBlogCategories() {
  try {
      $conn = DB::connect();

      $query = "SELECT * FROM `BlogCategory`";
      $handle = $conn->prepare($query);
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      $conn = DB::close();
      return $result;

  }
  catch(\PDOException $ex) {
      return print($ex->getMessage());
  }
}

function getBlogCategory($id) {
  try {
      $conn = DB::connect();

      $id = Security::secureString($id);

      $query = "SELECT * FROM `BlogCategory` WHERE BlogCategoryID = :id";
      $handle = $conn->prepare($query);
      $handle->bindParam(':id', $id);
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      $conn = DB::close();
      return $result;

  }
  catch(\PDOException $ex) {
      return print($ex->getMessage());
  }
}

function getAuthor($authorEmail) {
  try {
      $conn = DB::connect();

      $authorEmail = Security::secureString($authorEmail);

      $query = "SELECT * FROM `User` WHERE UserEmail = :mail";
      $handle = $conn->prepare($query);
      $handle->bindParam(':mail', $authorEmail);
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      $conn = DB::close();
      return $result;

  }
  catch(\PDOException $ex) {
      return print($ex->getMessage());
  }
}
?>
