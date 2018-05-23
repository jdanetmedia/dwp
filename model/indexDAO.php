<?php
function getSlides() {
    try {
        $conn = DB::connect();

        $handle = $conn->prepare("SELECT * FROM FrontSlider");
        $handle->execute();

        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
        $conn = DB::close();
        return $result;

    }
    catch(\PDOException $ex) {
        return print($ex->getMessage());
    }
}

function getNewestProducts() {
    try {
        $conn = DB::connect();

        $handle = $conn->prepare("SELECT * FROM Product WHERE Product.ProductStatus = 1 ORDER BY CreationDate DESC LIMIT 4");
        $handle->execute();

        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
        $conn = DB::close();
        return $result;

    }
    catch(\PDOException $ex) {
        return print($ex->getMessage());
    }
}

function getRecentBlogs() {
    try {
        $conn = DB::connect();

        $handle = $conn->prepare("SELECT BlogPost.*, ImgGallery.* FROM `BlogPost` LEFT JOIN `BlogImg` ON BlogPost.BlogPostID = BlogImg.BlogPostID LEFT JOIN `ImgGallery` ON BlogImg.ImgID = ImgGallery.ImgID ORDER BY BlogPost.BlogDate DESC LIMIT 2");
        $handle->execute();

        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
        $conn = DB::close();
        return $result;

    }
    catch(\PDOException $ex) {
        return print($ex->getMessage());
    }
}

function getProductsOnSale() {
    try {
        $conn = DB::connect();

        $handle = $conn->prepare("SELECT Product.*, ProductImg.ImgID, ProductImg.IsPrimary, ImgGallery.URL FROM Product LEFT JOIN ProductImg ON Product.ItemNumber = ProductImg.ItemNumber LEFT JOIN ImgGallery ON ProductImg.ImgID = ImgGallery.ImgID WHERE Product.ProductStatus = 1 AND ProductImg.IsPrimary = 1 AND NOT Product.OfferPrice = 0 LIMIT 4");
        $handle->execute();

        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
        $conn = DB::close();
        return $result;

    }
    catch(\PDOException $ex) {
        return print($ex->getMessage());
    }
}

function getHighestRatedProducts() {
    try {
        $conn = DB::connect();

        $handle = $conn->prepare("SELECT AVG(Rating), ImgGallery.*, ProductImg.IsPrimary, Product.* FROM Product INNER JOIN Review ON Review.ItemNumber = Product.ItemNumber LEFT JOIN ProductImg ON Product.ItemNumber = ProductImg.ItemNumber LEFT JOIN ImgGallery ON ProductImg.ImgID = ImgGallery.ImgID WHERE Product.ProductStatus = 1 AND ProductImg.IsPrimary = 1 GROUP BY ItemNumber ORDER BY AVG(Rating) DESC LIMIT 4");
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
