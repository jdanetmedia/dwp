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
        <title><?php echo $productInfo["ProuctName"]; ?></title>
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

  // Products page
  if($basename == "product" && !isset($_GET["item"]) && !isset($_GET["cat"]) || isset($_GET["cat"]) && $_GET["cat"] == 0) {
    print_r($basename);
  }
?>
