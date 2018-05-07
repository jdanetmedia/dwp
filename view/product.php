<?php
require_once("../includes/header.php");
require_once("../model/productDAO.php");
require_once('../model/productsDAO.php');
require_once('../model/cartDAO.php');

// Store information on the current product item
$productImgs = getCurrentProduct($_GET["item"]);
$reviews = getReviews($_GET["item"]);
$currentItem = mysqli_fetch_assoc($productImgs);
$itemCheck = count($currentItem);

if($itemCheck == 0) {
  ?>
    <script type="text/javascript">
      window.location.href="404.php";
    </script>
  <?php
}

$related = getRelatedProducts($currentItem["ProductCategoryID"]);
$usercart = $_SESSION["cart"];
?>
  <div class="container product-container">
    <div class="row">
      <div class="col s12 m5 product-img">
        <div class="productimage-cnt">
            <?php foreach ($productImgs as $img) {
                if($img["IsPrimary"] == 1) { ?>
                    <img class="responsive-img materialboxed primary-img" src="<?php echo $img["URL"]; ?>" alt="<?php echo $currentItem["ProductName"]; ?>">
                <?php }
              } ?>
        </div>
        <div class="more-imgs">
            <?php foreach ($productImgs as $img) {
                if($img["IsPrimary"] != 1) { ?>
                  <div class="gallery-img">
                      <img class="responsive-img materialboxed" src="<?php echo $img["URL"]; ?>" alt="">
                  </div> <?php }
                } ?>
        </div>
      </div>
      <div class="col s12 m7">
        <h1 class="product-title"><?php echo $currentItem["ProductName"]; ?></h1>
        <div class="short-desc">
          <?php echo $currentItem["ShortDescription"]; ?>
        </div>
        <div class="row">
          <div class="col s6">
            <p>Price:</p>
          </div>
          <div class="col s6 right">
            <p><b>$<?php echo $currentItem["Price"]; ?></b></p>
          </div>
          <div class="col s12">
            <form class="" action="" method="post">
              <div class="input-field inline cart_quantity">
                <input name="amount" id="quantity" type="number" value="1">
                <label for="quantity">Quantity</label>
              </div>
              <a class="waves-effect waves-light btn cart-btt"><input class="presscart" type="submit" name="submitcart" value="Add to cart"><i class="material-icons right">add_shopping_cart</i></a>
            </form>
          </div>
          <div class="col s12 avr-review">
            <?php
              echo getReviewForProduct($_GET["item"]);
              //echo "<span class='review-text'>Based on " . $rated . " reviews: </span>";
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-tabs">
        <ul class="tabs">
          <li class="tab"><a href="#description">Description</a></li>
          <li class="tab"><a href="#reviews">Reviews</a></li>
        </ul>
      </div>
      <div class="card-content">
        <div id="description">
          <div class="row">
            <div class="col s12 m8">
              <?php echo $currentItem["LongDescription"]; ?>
            </div>
            <div class="col s12 m4">
              <p><b>Current stockstatus:</b><br>
              <?php echo $currentItem["StockStatus"]; ?>
              </p>
            </div>
          </div>
        </div>
        <div id="reviews">
          <div class="reviews-top">
            <div class="review-top-txt">
              <h3>Reviews of Rubber duck</h3>
              <p>Here you can read about other peoples opinion about this product. Contribute by writing your review.</p>
            </div>
            <!-- Modal Trigger -->
            <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Add review</a>
            <!-- Modal Structure -->
            <div id="modal1" class="modal">
              <div class="modal-content">
                <h4>Add your review</h4>
                <div class="row">
                  <form action="" method="post" class="col s12">
                    <div class="row">
                      <div class="input-field col s12 m6">
                        <input id="last_name" name="reviewTitle" type="text" class="validate">
                        <label for="last_name">Review title</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <textarea id="textarea1" name="reviewText" class="materialize-textarea"></textarea>
                        <label for="textarea1">Review text</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 m6">
                        <ul class="stars-list">
                          <li id="1" class="star star-1">
                            <i class="material-icons small star-icon">star_border</i>
                          </li>
                          <li id="2" class="star star-2">
                            <i class="material-icons small star-icon">star_border</i>
                          </li>
                          <li id="3" class="star star-3">
                            <i class="material-icons small star-icon">star_border</i>
                          </li>
                          <li id="4" class="star star-4">
                            <i class="material-icons small star-icon">star_border</i>
                          </li>
                          <li id="5" class="star star-5">
                            <i class="material-icons small star-icon">star_border</i>
                          </li>
                        </ul>
                        <input class="rating-input" type="hidden" name="rating">
                        <input class="waves-effect waves-green btn" type="submit" name="submitreview" value="Add review">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <?php while($row = mysqli_fetch_array($reviews)) {
              ?>
                <div class="col s12 m6">
                  <div class="card">
                    <div class="card-content">
                      <span class="card-title"><?php echo $row["ReviewTitle"]; ?></span>
                      <p><?php echo $row["ReviewContent"] ?></p>
                      <span class="review-meta"><?php echo "Posted by <b>" . $row["ReviewName"] . "</b> on <b>" . $row["ReviewDate"] . "</b>"; ?></span>
                    </div>
                    <div class="card-action">
                      <div class="stars">
                        <?php

                          $rating = $row["Rating"];
                          $items = 1;
                          $items2 = 1;
                          $notRated = 5 - $rating;
                          while($items <= $rating) {

                            ?>
                              <i class="material-icons small rated">star</i>
                            <?php
                            $items++;
                          }
                          while($items2 <= $notRated) {
                            ?>
                              <i class="material-icons small">star_border</i>
                            <?php
                            $items2++;
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
            } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="carousel product-slider">
			<h4>Related producks!</h4>
      <?php
        while($row = mysqli_fetch_array($related)) {
            $itemNumber = $row["ItemNumber"];
          ?>
            <a class='carousel-item' href='product.php?item=<?php echo $itemNumber; ?>'>
                <div class='card'>
                  <div class='card-image'>
                    <img src='http://via.placeholder.com/400x400'>
                    <span class='card-title'><?php echo $row["ProductName"]; ?></span>
                  </div>
                  <div class='card-action'>
                    <p class='price'>$<?php echo $row["Price"]; ?></p>
                    <div class='stars right'>
                        <?php
                        echo getReviewForProduct($itemNumber);
                        ?>
                    </div>
                  </div>
                </div>
            </a>
          <?php
        }
      ?>
    </div>
  </div>
<?php require_once("../includes/footer.php") ?>
