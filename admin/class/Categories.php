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

    function updateProductCategory ($categoryID) {
        try {
            $conn = connectToDB();

            $statement = "UPDATE ProductCategory
                          SET CategoryName = :CategoryName,
                          Description = :Description,
                          SeoTitle = :SeoTitle,
                          MetaDescription = :MetaDescription
                          WHERE ProductCategoryID = :ProductCategoryID";

            $handle = $conn->prepare($statement);

            $handle->bindParam(':CategoryName',$_POST["categoryName"]);
            $handle->bindParam(':Description',$_POST["description"]);
            $handle->bindParam(':SeoTitle',$_POST["seoTitle"]);
            $handle->bindParam(':MetaDescription',$_POST["metaDescription"]);
            $handle->bindParam(':ProductCategoryID',$categoryID);
            $handle->execute();
            $conn = null; //CLOSE THE CONNECTION BRUH ?!
        }
        catch(\PDOExeption $ex) {
            print($ex->getMessage());
        }
    }

    function updateBlogPostCategory ($categoryID) {
        try {
            $conn = connectToDB();

            $statement = "UPDATE BlogCategory
                          SET CategoryName = :CategoryName,
                          Description = :Description,
                          SeoTitle = :SeoTitle,
                          MetaDescription = :MetaDescription
                          WHERE BlogCategoryID = :BlogCategoryID";

            $handle = $conn->prepare($statement);

            $handle->bindParam(':CategoryName',$_POST["categoryName"]);
            $handle->bindParam(':Description',$_POST["description"]);
            $handle->bindParam(':SeoTitle',$_POST["seoTitle"]);
            $handle->bindParam(':MetaDescription',$_POST["metaDescription"]);
            $handle->bindParam(':BlogCategoryID',$categoryID);
            $handle->execute();
            $conn = null; //CLOSE THE CONNECTION BRUH ?!
        }
        catch(\PDOExeption $ex) {
            print($ex->getMessage());
        }
    }

    function deleteProductCategory ($categoryID) {
        try {
            $conn = connectToDB();

            $statement = "DELETE FROM ProductCategory WHERE ProductCategoryID = :ProductCategoryID";

            $handle = $conn->prepare($statement);
            $handle->bindParam(':ProductCategoryID',$categoryID);
        }
        catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    function deleteBlogPostCategory ($categoryID) {
        try {
            $conn = connectToDB();

            $statement = "DELETE FROM BlogCategory WHERE BlogCategoryID = :BlogCategoryID";

            $handle = $conn->prepare($statement);
            $handle->bindParam(':BlogCategoryID',$categoryID);
        }
        catch (\PDOException $ex) {
            print($ex->getMessage());
        }
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