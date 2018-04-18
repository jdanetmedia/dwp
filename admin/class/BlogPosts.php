<?php
class BlogPosts extends DBConnect {

    function getAllBlogPosts() {
        try {
            $conn = connectToDB();

            $handle = $conn->prepare("SELECT BlogPost.*, BlogCategory.CategoryName FROM `BlogPost` INNER JOIN BlogCategory ON BlogPost.BlogCategoryID =  BlogCategory.BlogCategoryID");
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_OBJ );
            return $result;

            $conn = null;
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
    }

}