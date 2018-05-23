<?php
Class Categories {

    function getAllProductCategories() {
        try {
            $conn = DB::connect();

            $handle = $conn->prepare("SELECT * FROM ProductCategory");
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_OBJ );
            return $result;

            DB::close();
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    function getAllBlogPostCategories() {
        try {
            $conn = DB::connect();

            $handle = $conn->prepare("SELECT * FROM `BlogCategory`");
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_OBJ );
            return $result;

            DB::close();
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    function saveProductCategory() {
        try {
            $conn = DB::connect();

            // Secure inputs
            $categoryName = Security::secureString($_POST["categoryName"]);
            $description = $_POST["description"];
            $seoTitle = Security::secureString($_POST["seoTitleProduct"]);
            $metaDescription = Security::secureString($_POST["metaDescriptionProduct"]);

            $statement = "INSERT INTO ProductCategory (CategoryName, Description, SeoTitle, MetaDescription) VALUES (:CategoryName, :Description, :SeoTitle, :MetaDescription)";

            $handle = $conn->prepare($statement);

            $handle->bindParam(':CategoryName', $categoryName);
            $handle->bindParam(':Description', $description);
            $handle->bindParam(':SeoTitle', $seoTitle);
            $handle->bindParam(':MetaDescription', $metaDescription);
            $handle->execute();
            DB::close(); //CLOSE THE CONNECTION BRUH ?!
        }
        catch(\PDOExeption $ex) {
            print($ex->getMessage());
        }
    }

    function saveBlogPostCategory() {
        try {
            $conn = DB::connect();

            // Secure inputs
            $categoryName = Security::secureString($_POST["categoryName"]);
            $description = $_POST["description"];
            $seoTitle = Security::secureString($_POST["seoTitleCategory"]);
            $metaDescription = Security::secureString($_POST["metaDescriptionCategory"]);

            $statement = "INSERT INTO BlogCategory (CategoryName, Description, SeoTitle, MetaDescription) VALUES (:CategoryName, :Description, :SeoTitle, :MetaDescription)";

            $handle = $conn->prepare($statement);

            $handle->bindParam(':CategoryName', $categoryName);
            $handle->bindParam(':Description', $description);
            $handle->bindParam(':SeoTitle', $seoTitle);
            $handle->bindParam(':MetaDescription', $metaDescription);
            $handle->execute();
            DB::close(); //CLOSE THE CONNECTION BRUH ?!
        }
        catch(\PDOExeption $ex) {
            print($ex->getMessage());
        }
    }

    function updateProductCategory ($categoryID) {
        try {
            $conn = DB::connect();

            // Secure inputs
            $categoryName = Security::secureString($_POST["categoryName"]);
            $description = $_POST["description"];
            $seoTitle = Security::secureString($_POST["seoTitle"]);
            $metaDescription = Security::secureString($_POST["metaDescription"]);
            $catID = Security::secureString($categoryID);

            $statement = "UPDATE ProductCategory
                          SET CategoryName = :CategoryName,
                          Description = :Description,
                          SeoTitle = :SeoTitle,
                          MetaDescription = :MetaDescription
                          WHERE ProductCategoryID = :ProductCategoryID";

            $handle = $conn->prepare($statement);

            $handle->bindParam(':CategoryName', $categoryName);
            $handle->bindParam(':Description', $description);
            $handle->bindParam(':SeoTitle', $seoTitle);
            $handle->bindParam(':MetaDescription', $metaDescription);
            $handle->bindParam(':ProductCategoryID', $catID);
            $handle->execute();
            DB::close(); //CLOSE THE CONNECTION BRUH ?!
        }
        catch(\PDOExeption $ex) {
            print($ex->getMessage());
        }
    }

    function updateBlogPostCategory ($categoryID) {
        try {
            $conn = DB::connect();

            // Secure inputs
            $categoryName = Security::secureString($_POST["categoryName"]);
            $description = $_POST["description"];
            $seoTitle = Security::secureString($_POST["seoTitle"]);
            $metaDescription = Security::secureString($_POST["metaDescription"]);
            $catID = Security::secureString($categoryID);

            $statement = "UPDATE BlogCategory
                          SET CategoryName = :CategoryName,
                          Description = :Description,
                          SeoTitle = :SeoTitle,
                          MetaDescription = :MetaDescription
                          WHERE BlogCategoryID = :BlogCategoryID";

            $handle = $conn->prepare($statement);

            $handle->bindParam(':CategoryName', $categoryName);
            $handle->bindParam(':Description', $description);
            $handle->bindParam(':SeoTitle', $seoTitle);
            $handle->bindParam(':MetaDescription', $metaDescription);
            $handle->bindParam(':BlogCategoryID', $catID);
            $handle->execute();
            DB::close(); //CLOSE THE CONNECTION BRUH ?!
        }
        catch(\PDOExeption $ex) {
            print($ex->getMessage());
        }
    }

    function deleteProductCategory ($categoryID) {
        try {
            $conn = DB::connect();

            // Secure input
            $catID = Security::secureString($categoryID);

            $statement = "DELETE FROM ProductCategory WHERE ProductCategoryID = :ProductCategoryID";

            $handle = $conn->prepare($statement);

            $handle->bindParam(':ProductCategoryID', $catID);
            $handle->execute();
            DB::close(); //CLOSE THE CONNECTION BRUH ?!
        }
        catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    function deleteBlogPostCategory ($categoryID) {
        try {
            $conn = DB::connect();

            // Secure input
            $catID = Security::secureString($categoryID);

            $statement = "DELETE FROM BlogCategory WHERE BlogCategoryID = :BlogCategoryID";

            $handle = $conn->prepare($statement);

            $handle->bindParam(':BlogCategoryID', $catID);
            $handle->execute();
            DB::close(); //CLOSE THE CONNECTION BRUH ?!
        }
        catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    function getProductCategoryDetails($categoryID) {
        try {
            $conn = DB::connect();

            $statement = "SELECT * FROM ProductCategory WHERE ProductCategoryID = :ProductCategoryID";

            $handle = $conn->prepare($statement);
            $handle->bindParam("ProductCategoryID", $catID);
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
            return $result;

            // DB::close();
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    function getBlogPostCategoryDetails($categoryID) {
        try {
            $conn = DB::connect();

            $statement = "SELECT * FROM BlogCategory WHERE BlogCategoryID = :BlogCategoryID";

            $handle = $conn->prepare($statement);
            $handle->bindParam(":BlogCategoryID",$categoryID);
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
            return $result;

            // DB::close();
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
    }

}
