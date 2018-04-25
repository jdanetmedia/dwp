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

            $handle = $conn->prepare("SELECT BlogPost.*, ImgGallery.ImgID, ImgGallery.URL, BlogImg.IsPrimary FROM BlogPost INNER JOIN BlogImg ON BlogImg.BlogPostID = BlogPost.BlogPostID INNER JOIN ImgGallery ON ImgGallery.ImgID = BlogImg.ImgID WHERE BlogPost.BlogPostID = $blogPostID ORDER BY BlogImg.IsPrimary DESC, BlogImg.ImgID ASC");
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
            return $result;

            // $conn = null;
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
    }

}