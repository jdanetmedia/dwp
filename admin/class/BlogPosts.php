<?php
class BlogPosts extends DBConnect {

    function getAllBlogPosts() {
        try {
            $conn = connectToDB();

            $handle = $conn->prepare("SELECT BlogPost.*, BlogCategory.CategoryName FROM `BlogPost` INNER JOIN BlogCategory ON BlogPost.BlogCategoryID =  BlogCategory.BlogCategoryID ORDER BY BlogPost.BlogDate DESC");
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_OBJ );
            return $result;

            $conn = null;
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    function getAllCategories() {
        try {
            $conn = connectToDB();

            $handle = $conn->prepare("SELECT * FROM `BlogCategory`");
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_OBJ );
            return $result;

            $conn = null;
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    function getBlogPostDetails($blogPostID) {
        try {
            $conn = connectToDB();

            $statement = "SELECT BlogPost.*, ImgGallery.ImgID, ImgGallery.URL, BlogImg.IsPrimary FROM BlogPost LEFT JOIN BlogImg ON BlogImg.BlogPostID = BlogPost.BlogPostID LEFT JOIN ImgGallery ON ImgGallery.ImgID = BlogImg.ImgID WHERE BlogPost.BlogPostID = :BlogPostID ORDER BY BlogImg.IsPrimary DESC, BlogImg.ImgID ASC";

            $handle = $conn->prepare($statement);
            $handle->bindParam(':BlogPostID',$blogPostID);
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
            return $result;

            $conn = null;
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    function saveBlogPost() {
        try {
            $conn = connectToDB();

            $statement = "INSERT INTO BlogPost (Title, BlogCategoryID, BlogContent, SeoTitle, MetaDescription, BlogDate, UserEmail) 
                          VALUES (:BlogPostTitle, :BlogCategoryID, :BlogContent, :SeoTitle, :MetaDescription, :BlogDate, :UserEmail)";

            $handle = $conn->prepare($statement);

            $handle->bindParam(':BlogPostTitle',$_POST["blogPostTitle"]);
            $handle->bindParam(':BlogCategoryID',$_POST["categoryID"]);
            $handle->bindParam(':BlogContent',$_POST["blogPostContent"]);
            $handle->bindParam(':SeoTitle',$_POST["seoTitle"]);
            $handle->bindParam(':MetaDescription',$_POST["metaDescription"]);
            $handle->bindParam(':BlogDate',date('Y/m/d H:i:s', time()));
            $handle->bindParam(':UserEmail',$_SESSION["UserEmail"]);
            $handle->execute();
            $conn = null; //CLOSE THE CONNECTION BRUH ?!
        }
        catch(\PDOExeption $ex) {
            print($ex->getMessage());
        }
    }

    function updateBlogPost($blogPostID) {
        try {
            $conn = connectToDB();

            $statement = "UPDATE BlogPost
                          SET Title = :BlogPostTitle,
                          BlogCategoryID = :BlogCategoryID,
                          BlogContent = :BlogContent,
                          BlogDate = BlogDate,
                          SeoTitle = :SeoTitle,
                          MetaDescription = :MetaDescription
                          WHERE BlogPostID = :BlogPostID";

            $handle = $conn->prepare($statement);

            $handle->bindParam(':BlogPostTitle',$_POST["blogPostTitle"]);
            $handle->bindParam(':BlogCategoryID',$_POST["categoryID"]);
            $handle->bindParam(':BlogContent',$_POST["blogPostContent"]);
            $handle->bindParam(':SeoTitle',$_POST["seoTitle"]);
            $handle->bindParam(':MetaDescription',$_POST["metaDescription"]);
            $handle->bindParam(':BlogPostID',$blogPostID);
            $handle->execute();
            $conn = null; //CLOSE THE CONNECTION BRUH ?!
        }
        catch(\PDOExeption $ex) {
            print($ex->getMessage());
        }
    }

    function deleteBlogPost($blogPostID) {
        try {
            $conn = connectToDB();

            $statement = "DELETE FROM BlogPost WHERE BlogPostID = :BlogPostID";

            $handle = $conn->prepare($statement);

            $handle->bindParam(':BlogPostID',$blogPostID);

            $handle->execute();
            $conn = null; //CLOSE THE CONNECTION BRUH ?!
        }
        catch(\PDOExeption $ex) {
            print($ex->getMessage());
        }
    }

}