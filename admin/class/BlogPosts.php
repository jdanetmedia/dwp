<?php
class BlogPosts {

    function getAllBlogPosts() {
        try {
            $conn = DB::connect();

            $handle = $conn->prepare("SELECT BlogPost.*, BlogCategory.CategoryName FROM `BlogPost` INNER JOIN BlogCategory ON BlogPost.BlogCategoryID =  BlogCategory.BlogCategoryID ORDER BY BlogPost.BlogDate DESC");
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_OBJ );
            DB::close();
            return $result;
        }
        catch(\PDOException $ex) {
            return print($ex->getMessage());
        }
    }

    function getAllCategories() {
        try {
            $conn = DB::connect();

            $handle = $conn->prepare("SELECT * FROM `BlogCategory`");
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_OBJ );
            DB::close();
            return $result;
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    function getBlogPostDetails($blogPostID) {
        try {
            // Secure input
            $postID = Security::secureString($blogPostID);

            $conn = DB::connect();

            $statement = "SELECT BlogPost.*, ImgGallery.ImgID, ImgGallery.URL FROM BlogPost LEFT JOIN BlogImg ON BlogImg.BlogPostID = BlogPost.BlogPostID LEFT JOIN ImgGallery ON ImgGallery.ImgID = BlogImg.ImgID WHERE BlogPost.BlogPostID = :BlogPostID ORDER BY BlogImg.ImgID ASC";

            $handle = $conn->prepare($statement);
            $handle->bindParam(':BlogPostID', $postID);
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
            DB::close();
            return $result;
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    function saveBlogPost() {
        try {
            $conn = DB::connect();

            if ($_POST["relatedProducts"] == 0) {
                $related = NULL;
            } else {
                $related = $_POST["relatedProducts"];
            }

            $statement = "INSERT INTO BlogPost (Title, BlogCategoryID, RelatedProducts, BlogContent, SeoTitle, MetaDescription, BlogDate, UserEmail) VALUES (:BlogPostTitle, :BlogCategoryID, :RelatedProducts, :BlogContent, :SeoTitle, :MetaDescription, :BlogDate, :UserEmail)";


            $date = date('Y/m/d H:i:s', time());
            $handle = $conn->prepare($statement);

            $handle->bindParam(':BlogPostTitle',$_POST["blogPostTitle"]);
            $handle->bindParam(':BlogCategoryID',$_POST["categoryID"]);
            $handle->bindParam(':RelatedProducts',$related);
            $handle->bindParam(':BlogContent',$_POST["blogPostContent"]);
            $handle->bindParam(':SeoTitle',$_POST["seoTitle"]);
            $handle->bindParam(':MetaDescription',$_POST["metaDescription"]);
            $handle->bindParam(':BlogDate',$date);
            $handle->bindParam(':UserEmail',$_SESSION["UserEmail"]);
            $handle->execute();
            DB::close(); //CLOSE THE CONNECTION BRUH ?!
        }
        catch(\PDOExeption $ex) {
            print($ex->getMessage());
        }
    }

    function updateBlogPost($blogPostID) {
        try {
            $conn = DB::connect();

            if ($_POST["relatedProducts"] == 0) {
                $related = NULL;
            } else {
                $related = $_POST["relatedProducts"];
            }
            $statement = "UPDATE BlogPost
                          SET Title = :BlogPostTitle,
                          BlogCategoryID = :BlogCategoryID,
                          RelatedProducts = :RelatedProducts,
                          BlogContent = :BlogContent,
                          BlogDate = BlogDate,
                          SeoTitle = :SeoTitle,
                          MetaDescription = :MetaDescription
                          WHERE BlogPostID = :BlogPostID";

            $handle = $conn->prepare($statement);

            $handle->bindParam(':BlogPostTitle',$_POST["blogPostTitle"]);
            $handle->bindParam(':BlogCategoryID',$_POST["categoryID"]);
            $handle->bindParam(':RelatedProducts',$related);
            $handle->bindParam(':BlogContent',$_POST["blogPostContent"]);
            $handle->bindParam(':SeoTitle',$_POST["seoTitle"]);
            $handle->bindParam(':MetaDescription',$_POST["metaDescription"]);
            $handle->bindParam(':BlogPostID',$blogPostID);
            $handle->execute();
            DB::close(); //CLOSE THE CONNECTION BRUH ?!
        }
        catch(\PDOExeption $ex) {
            print($ex->getMessage());
        }
    }

    function getRecentBlogPost() {
        try {
            $conn = DB::connect();

            $handle = $conn->prepare("SELECT * FROM `BlogPost` ORDER BY BlogDate DESC LIMIT 1");
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_OBJ );
            DB::close();
            return $result;
        }
        catch(\PDOException $ex) {
            return print($ex->getMessage());
        }
    }

    function deleteBlogPost($blogPostID) {
        try {
            $conn = DB::connect();

            $statement2 = "DELETE FROM BlogImg WHERE BlogPostID = :BlogPostID";
            $handle2 = $conn->prepare($statement2);
            $handle2->bindParam(':BlogPostID',$blogPostID);
            $handle2->execute();

            $statement = "DELETE FROM BlogPost WHERE BlogPostID = :BlogPostID";
            $handle = $conn->prepare($statement);
            $handle->bindParam(':BlogPostID',$blogPostID);
            $handle->execute();


            DB::close(); //CLOSE THE CONNECTION BRUH ?!
        }
        catch(\PDOExeption $ex) {
            print($ex->getMessage());
        }
    }

    function searchBlogPost($search) {
        try {
            $newSearch = "%$search%";
            $conn = DB::connect();

            $statement = "SELECT BlogPost.*, BlogCategory.CategoryName FROM `BlogPost` INNER JOIN BlogCategory ON BlogPost.BlogCategoryID =  BlogCategory.BlogCategoryID WHERE Title LIKE :Search OR BlogContent LIKE :Search OR UserEmail LIKE :Search OR BlogCategory.CategoryName LIKE :Search ORDER BY BlogPost.BlogDate DESC";

            $handle = $conn->prepare($statement);
            $handle->bindParam(':Search',$newSearch);

            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_OBJ );
            return $result;

            DB::close();
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    function removeImg($id) {
        try {
            $conn = DB::connect();

            $statement = "DELETE FROM BlogImg WHERE ImgID = :ImgID";
            $handle = $conn->prepare($statement);
            $handle->bindParam(":ImgID", $id);
            $handle->execute();

            DB::close();
        }
        catch(\PDOExeption $ex) {
            print($ex->getMessage());
        }
    }
}
