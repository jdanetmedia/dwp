<?php
Class Categories {

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

    function saveProductCategory() {
        try {
            $conn = connectToDB();

            // Secure inputs
            $categoryName = Security::secureString($_POST["categoryName"]);
            $description = Security::secureString($_POST["description"]);
            $seoTitle = Security::secureString($_POST["seoTitleProduct"]);
            $metaDescription = Security::secureString($_POST["metaDescriptionProduct"]);

            $statement = "INSERT INTO ProductCategory (CategoryName, Description, SeoTitle, MetaDescription) VALUES (:CategoryName, :Description, :SeoTitle, :MetaDescription)";

            $handle = $conn->prepare($statement);

            $handle->bindParam(':CategoryName', $categoryName);
            $handle->bindParam(':Description', $description);
            $handle->bindParam(':SeoTitle', $seoTitle);
            $handle->bindParam(':MetaDescription', $metaDescription);
            $handle->execute();
            $conn = null; //CLOSE THE CONNECTION BRUH ?!
        }
        catch(\PDOExeption $ex) {
            print($ex->getMessage());
        }
    }

    function saveBlogPostCategory() {
        try {
            $conn = connectToDB();

            $statement = "INSERT INTO BlogCategory (CategoryName, Description, SeoTitle, MetaDescription) VALUES (:CategoryName, :Description, :SeoTitle, :MetaDescription)";

            $handle = $conn->prepare($statement);

            $handle->bindParam(':CategoryName', $_POST["categoryName"]);
            $handle->bindParam(':Description', $_POST["description"]);
            $handle->bindParam(':SeoTitle', $_POST["seoTitleCategory"]);
            $handle->bindParam(':MetaDescription', $_POST["metaDescriptionCategory"]);
            $handle->execute();
            $conn = null; //CLOSE THE CONNECTION BRUH ?!
        }
        catch(\PDOExeption $ex) {
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
            $handle->bindParam(':SeoTitle',$_POST["seoTitleProduct"]);
            $handle->bindParam(':MetaDescription',$_POST["metaDescriptionProduct"]);
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
            $handle->bindParam(':SeoTitle',$_POST["seoTitleCategory"]);
            $handle->bindParam(':MetaDescription',$_POST["metaDescriptionCategory"]);
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
            $handle->execute();
            $conn = null; //CLOSE THE CONNECTION BRUH ?!
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
            $handle->execute();
            $conn = null; //CLOSE THE CONNECTION BRUH ?!
        }
        catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    function getProductCategoryDetails($categoryID) {
        try {
            $conn = connectToDB();

            $statement = "SELECT * FROM ProductCategory WHERE ProductCategoryID = :ProductCategoryID";

            $handle = $conn->prepare($statement);
            $handle->bindParam("ProductCategoryID",$categoryID);
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

            $statement = "SELECT * FROM BlogCategory WHERE BlogCategoryID = :BlogCategoryID";

            $handle = $conn->prepare($statement);
            $handle->bindParam(":BlogCategoryID",$categoryID);
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
