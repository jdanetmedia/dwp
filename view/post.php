<?php
require_once("../includes/sessionstart.php");
require_once('../includes/header.php');
require_once("../model/blogDAO.php");
require_once("../model/productDAO.php");
require_once('../model/productsDAO.php');
$post = $_GET["post"];
$postData = getPost($post);
$related = getRelatedProductsForBlog($postData["RelatedProducts"]);
$breadcrumbCat = getBlogCategory($postData["BlogCategoryID"]);
$author = getAuthor($postData["UserEmail"]);
?>
  <div class="container post-container">
      <nav class="breadcrumb-nav">
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="blog.php" class="breadcrumb">Bluck</a>
            <a href="blog.php?cat=<?php echo $postData["BlogCategoryID"]; ?>" class="breadcrumb"><?php echo $breadcrumbCat["CategoryName"]; ?></a>
            <a href="#!" class="breadcrumb"><?php echo $postData["Title"]; ?></a>
          </div>
        </div>
      </nav>
      <div class="row">
        <div class="col s12">
          <div class="card">
            <div class="card-image">
                <img src="<?php if($postData["URL"] != "") {
                    echo $postData["URL"];
                } else echo "http://via.placeholder.com/1920x1080"; ?>">
              <span class="card-title"><?php echo $postData["Title"]; ?></span>
            </div>
            <div class="card-content">
              <i>Posted on <b><?php echo $postData["BlogDate"]; ?></b> by <b><?php echo $author["FirstName"]; ?></b> in <b><?php echo $breadcrumbCat["CategoryName"]; ?></b></i>
              <p><?php echo $postData["BlogContent"]; ?></p>
            </div>
          </div>
        </div>
      </div>
        <?php if(isset($postData["RelatedProducts"])) { ?>
      <div class="outer row">
          <h4>Related Producks!</h4>
          <?php
          while($row = mysqli_fetch_array($related)) {
              $itemNumber = $row["ItemNumber"];
              ?>
              <a href="product.php?item=<?php echo $itemNumber; ?>">
                  <div class="col m3 s12">
                      <div class="card">
                          <div class="card-image">
                              <img src="<?php echo $row["URL"]; ?>">
                              <span class="card-title"><?php echo $row["ProductName"]; ?></span>
                          </div>
                          <div class="card-action">
                              <?php if ($row["OfferPrice"] != NULL && $row["OfferPrice"] != 0) {
                                  ?>
                                  <p class="price"><strike>$<?php echo $row["Price"]; ?></strike><b> $<?php echo
                                          $row["OfferPrice"];
                                          ?></b></p>
                                  <?php
                              } else {
                                  ?>
                                  <p class="price">$<?php echo $row["Price"]; ?></p>
                                  <?php
                              }
                              ?>
                              <div class="stars right">
                                  <?php
                                  //echo getReviewForProduct($itemNumber);
                                  ?>
                              </div>
                          </div>
                      </div>
                  </div>
              </a>
              <?php
          }
          ?>
      </div>
      <?php } ?>
      <div class="outer row">
        <h4>Related Bluckposts!</h4>
        <?php
          $blogResult = getAllRelatedPosts($postData["BlogCategoryID"], $post);
          while($row = mysqli_fetch_array($blogResult)) {
            ?>
              <div class="col s12 m6">
                  <div class="card">
                      <div class="card-image">
                          <img src="<?php if($row["URL"] != "") {
                              echo $row["URL"];
                          } else echo "http://via.placeholder.com/1920x1080"; ?>">
                          <span class="card-title"><?php echo $row["Title"]; ?></span>
                      </div>
                      <div class="card-content">
                          <p><?php if (strlen($row["BlogContent"]) > 160) {
                                  echo preg_replace('/\s+?(\S+)?$/', '', filter_var(substr($row["BlogContent"], 0, 160), FILTER_SANITIZE_STRING)) . " ...";
                              } else echo $row["BlogContent"]; ?></p>
                      </div>
                      <div class="card-action">
                          <a href="post.php?post=<?php echo $row["BlogPostID"]; ?>">Read more</a>
                      </div>
                  </div>
              </div>
          <?php
          }
        ?>
      </div>
  </div>
<?php require_once('../includes/footer.php') ?>
