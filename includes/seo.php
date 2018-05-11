<?php
  // Product
  if(isset($_GET["item"])) {
    include("../admin/class/Product.php");

    $product = new Product();
    $currentProduct = $product->getProductDetails($_GET["item"]);
    $productInfo = $currentProduct[0];
    // Title tag
    if(isset($productInfo["SeoTitle"]) && !empty($productInfo["SeoTitle"])) {
        ?>
          <title><?php echo $productInfo["SeoTitle"]; ?></title>
        <?php
    } else {
      ?>
        <title><?php echo $productInfo["ProductName"]; ?></title>
      <?php
    }
    // Meta description
    if(isset($productInfo["MetaDescription"]) && !empty($productInfo["MetaDescription"])) {
      ?>
    <meta name="description" content="<?php echo $productInfo["MetaDescription"]; ?>">
      <?php
    } else {
      ?>
    <meta name="description" content="<?php echo $productInfo["ShortDescription"]; ?>">
      <?php
    }
  }
  // End product

  $basename = substr(strtolower(basename($_SERVER['PHP_SELF'])),0,strlen(basename($_SERVER['PHP_SELF']))-4);

  // Products page and product categories
  if($basename == "products" && !isset($_GET["item"]) && !isset($_GET["cat"]) || $basename == "products" && $_GET["cat"] == 0) {
    ?>
      <title><?php echo $basename; ?></title>
    <?php
  } elseif($basename == "products" && !isset($_GET["item"]) && isset($_GET["cat"]) && $_GET["cat"] != 0) {
    include("../admin/class/DBConnect.php");
    include("../admin/class/Categories.php");
    $categories = new Categories();
    $currentCat = $categories->getProductCategoryDetails($_GET["cat"]);
    if(isset($currentCat[0]["SeoTitle"]) && !empty($currentCat[0]["SeoTitle"])) {
      ?>
        <title><?php echo $currentCat[0]["SeoTitle"]; ?></title>
      <?php
      ?>
        <meta name="description" content="<?php echo $currentCat[0]["MetaDescription"]; ?>">
      <?php
    } else {
      ?>
        <title><?php echo $currentCat[0]["CategoryName"]; ?></title>
      <?php
    }
  }

?>
