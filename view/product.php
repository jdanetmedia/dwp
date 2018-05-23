<?php
require_once("../includes/sessionstart.php");
require_once('../model/cartDAO.php');
require_once("../includes/header.php");
require_once("../model/productDAO.php");
require_once('../model/productsDAO.php');

// Store information on the current product item
$productImgs = getCurrentProduct($_GET["item"]);
$reviews = getReviews($_GET["item"]);
$currentItem = $productImgs[0];
$itemCheck = count($currentItem);

if($itemCheck == 0) {
  ?>
    <script type="text/javascript">
      window.location.href="404.php";
    </script>
  <?php
}

$related = getRelatedProducts($currentItem["ProductCategoryID"], $currentItem["ItemNumber"]);
if (isset($_SESSION["cart"])) {
  $usercart = $_SESSION["cart"];
}
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
            <?php
            if ($currentItem["OfferPrice"] != NULL && $currentItem["OfferPrice"] != 0) {
            ?>
            <p><strike>$<?php echo $currentItem["Price"]; ?></strike><b> $<?php echo $currentItem["OfferPrice"]; ?></b></p>
            <?php
            } else {
            ?>
            <p><b>$<?php echo $currentItem["Price"]; ?></b></p>
            <?php
            }
            ?>
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
              <p><b>Current stockstatus:</b></p>
              <?php
              if ($currentItem["StockStatus"] > 50) {
                // Green
                echo "<p class='green-text'>On stock</p>";
              } else if ($currentItem["StockStatus"] > 10) {
                // Yellow
                echo "<p class='yellow-text'>Low stock!</p>";
              } else {
                // Red
                echo "<p class='red-text'>Almost out of stock!</p>";
              }
              ?>
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
                        <div class="right">
                          <div class="g-recaptcha" data-sitekey="6LfRflkUAAAAAKNUJpg6Bfql_ok1VOkdh6-4U8sZ"></div>
                        </div>
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
            <?php foreach($reviews as $row) {
              if(isset($row["ReviewName"])) { $name = $row["ReviewName"]; } else { $name = "Anonymous"; }
              ?>
                <div class="col s12 m6">
                  <div class="card">
                    <div class="card-content">
                      <span class="card-title"><?php echo $row["ReviewTitle"]; ?></span>
                      <p><?php echo $row["ReviewContent"] ?></p>
                      <span class="review-meta"><?php echo "Posted by <b>" . $name . "</b> on <b>" . $row["ReviewDate"]
                              . "</b>"; ?></span>
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
                              <i class="material-icons small rated">star_border</i>
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
      <div class="outer row">
              <h4>Related Producks!</h4>
              <?php
              foreach($related as $row) {
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
                                      echo getReviewForProduct($itemNumber);
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
  </div>
<?php require_once("../includes/footer.php") ?>
