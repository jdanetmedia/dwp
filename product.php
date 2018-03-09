<?php
require_once("includes/header.php");
require_once("includes/productDAO.php");
require_once('includes/productsDAO.php');

// Store information on the current product item
$currentItem = getCurrentProduct($_GET["item"]);
$reviews = getReviews($_GET["item"]);
?>
  <div class="container product-container">
    <div class="row">
      <div class="col s12 m5 product-img">
        <div class="productimage-cnt">
          <img class="responsive-img" src="https://pull01.munchkin.com/media/catalog/product/3/1/31001_1_1.jpg" alt="">
          <div class="productimage-overlay">
            <i class="material-icons medium zoom-icon">zoom_in</i>
          </div>
        </div>
      </div>
      <div class="col s12 m7">
        <h1 class="product-title"><?php echo $currentItem->ProductName; ?></h1>
        <div class="short-desc">
          <?php echo $currentItem->ShortDescription; ?>
        </div>
        <div class="row">
          <div class="col s6">
            <p>Your price:</p>
          </div>
          <div class="col s6 right">
            <p><b>99.00</b></p>
          </div>
          <div class="col s12">
            <div class="input-field inline cart_quantity">
              <input id="quantity" type="number" value="1">
              <label for="quantity">Quantity</label>
            </div>
            <a class="waves-effect waves-light btn cart-btt"><i class="material-icons right">add_shopping_cart</i>Add to cart</a>
          </div>
          <div class="col s12">
            <?php
              $rated = getReviewForProduct($_GET["item"]);
              $i = 1;
              while ($i <= $rated[0]) {
                ?>
                <i class="material-icons tiny rated">star</i>
                <?php
                $i++;
              }
              echo $rated[1] . " Reviews";
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
              <?php echo $currentItem->LongDescription; ?>
            </div>
            <div class="col s12 m4">
              <p><b>Shipping:</b><br>
              49 kr</p>
              <p><b>Some other fact:</b><br>
              Duuuuck</p>
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
                  <form class="col s12">
                    <div class="row">
                      <div class="input-field col s12 m6">
                        <input id="last_name" type="text" class="validate">
                        <label for="last_name">Review title</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <textarea id="textarea1" class="materialize-textarea"></textarea>
                        <label for="textarea1">Review text</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 m6">
                        <form class="rating">
                          <label>
                            <input type="radio" name="stars" value="1" />
                            <i class="material-icons small rated">star</i>
                          </label>
                          <label>
                            <input type="radio" name="stars" value="2" />
                            <i class="material-icons small rated">star</i>
                            <i class="material-icons small rated">star</i>
                          </label>
                          <label>
                            <input type="radio" name="stars" value="3" />
                            <i class="material-icons small rated">star</i>
                            <i class="material-icons small rated">star</i>
                            <i class="material-icons small rated">star</i>
                          </label>
                          <label>
                            <input type="radio" name="stars" value="4" />
                            <i class="material-icons small rated">star</i>
                            <i class="material-icons small rated">star</i>
                            <i class="material-icons small rated">star</i>
                            <i class="material-icons small rated">star</i>
                          </label>
                          <label>
                            <input type="radio" name="stars" value="5" />
                            <i class="material-icons small rated">star</i>
                            <i class="material-icons small rated">star</i>
                            <i class="material-icons small rated">star</i>
                            <i class="material-icons small rated">star</i>
                            <i class="material-icons small rated">star</i>
                          </label>
                        </form>
                      </div>
                    </div>
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn">Add review</a>
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
                      <span class="card-title"><?php echo $row["ReviewName"]; ?></span>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                    <div class="card-action">
                      <div class="stars">
                        <?php

                          $rating = $row["Rating"];
                          $i = 0;

                          while($i <= $rating) {

                            ?>
                              <i class="material-icons small rated">star</i>
                            <?php
                            $i++;
                          }
                          
                        ?>
                        <i class="material-icons small">star_border</i>
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
			function output() {
			echo "
			<a class='carousel-item' href='product.php'>
			    <div class='card'>
			      <div class='card-image'>
			        <img src='http://via.placeholder.com/400x400'>
			        <span class='card-title'>Card Title</span>
			      </div>
			      <div class='card-action'>
			        <p class='price'>$99.95</p>
			        <div class='stars right'>
			          <i class='material-icons tiny rated'>star</i>
			          <i class='material-icons tiny rated'>star</i>
			          <i class='material-icons tiny rated'>star</i>
			          <i class='material-icons tiny rated'>star</i>
			          <i class='material-icons tiny'>star_border</i>
			        </div>
			      </div>
			    </div>
			</a>
			";
			}

			$i = 1;
			while ($i <= 7) {
			output();
			$i++;
			}
			?>
    </div>
  </div>
  <div class="overlay">
    <div class="close-btn">
      <div class="line1 line"></div>
      <div class="close-txt">
        Close
      </div>
      <div class="line2 line"></div>
    </div>
  </div>
<?php require_once("includes/footer.php") ?>
