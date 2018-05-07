<?php
Class Categories extends DBConnect {

    function getAllProductCategories() {
        try {
            $conn = connectToDB();

            $handle = $conn->prepare("SELECT * FROM ProductCategory");
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_OBJ );
            return $result;

            $conn = null;
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    function getAllBlogPostCategories() {
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

    function updateCategory ($categoryID) {

    }

    function deleteCategory ($categoryID) {

    }

    function getProductCategoryDetails($categoryID) {
        try {
            $conn = connectToDB();

            $handle = $conn->prepare("SELECT * FROM ProductCategory WHERE ProductCategoryID = $categoryID");
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
            return $result;

            // $conn = null;
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    function getBlogPostCategoryDetails($categoryID) {
        try {
            $conn = connectToDB();

            $handle = $conn->prepare("SELECT * FROM BlogCategory WHERE BlogCategoryID = $categoryID");
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