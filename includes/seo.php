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
      <title><?php echo ucfirst($basename); ?></title>
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

  // Blogpost
  if(isset($_GET["post"])) {
    include("../admin/class/DBConnect.php");
    include("../admin/class/BlogPosts.php");

    $blogpost = new BlogPosts();
    $currentPost = $blogpost->getBlogPostDetails($_GET["post"]);
    $postInfo = $currentPost[0];
    // Title tag
    if(isset($postInfo["SeoTitle"]) && !empty($postInfo["SeoTitle"])) {
        ?>
          <title><?php echo $postInfo["SeoTitle"]; ?></title>
        <?php
    } else {
      ?>
        <title><?php echo $postInfo["Title"]; ?></title>
      <?php
    }
    // Meta description
    if(isset($postInfo["MetaDescription"]) && !empty($postInfo["MetaDescription"])) {
      ?>
    <meta name="description" content="<?php echo $postInfo["MetaDescription"]; ?>">
      <?php
    }
  }
  // End post

  if($basename == "blog" && !isset($_GET["post"]) && !isset($_GET["cat"]) || $basename == "blog" && $_GET["cat"] == 0) {
    ?>
      <title><?php echo $basename; ?></title>
    <?php
  } elseif($basename == "blog" && !isset($_GET["post"]) && isset($_GET["cat"]) && $_GET["cat"] != 0) {
    include("../admin/class/DBConnect.php");
    include("../admin/class/Categories.php");
    $categories = new Categories();
    $currentCat = $categories->getBlogPostCategoryDetails($_GET["cat"]);
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

  if($basename != "blog" && $basename != "products" &&  $basename != "product" && $basename != "post" && $basename != "contact" && $basename != "homepage") {
    ?>
    <title><?php echo ucfirst($basename); ?></title>
    <?php
  }
?>
