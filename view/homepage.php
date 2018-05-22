<?php
require_once("../includes/sessionstart.php");
require_once('../includes/header.php');
require_once("../model/indexDAO.php");

?>
<div class="container">
  <div class="carousel carousel-slider center" data-indicators="true">
    <?php
    $slideResult = getSlides();
    while ($row = mysqli_fetch_array($slideResult)) {
    ?>
    <div class="carousel-item white-text slider-image" style="background-image: URL('<?php echo $row["SliderImg"]; ?>');">
      <h2><?php echo $row["SliderHeader"]; ?></h2>
      <p class="white-text"><?php echo $row["SliderText"]; ?></p>
      <div class="carousel-fixed-item center">
        <a class="btn waves-effect white grey-text darken-text-2" href="<?php echo $row["CTAURL"]; ?>"><?php echo $row["CTAButtonText"]; ?></a>
      </div>
    </div>
    <?php
    }
    ?>
  </div>
</div>
<div class="outer row">
    <div class="container">
        <h4>Recommended Producks!</h4>
            <?php
            //Gets highest rated products
            $highestRatedProducts = getHighestRatedProducts();
            while($row = mysqli_fetch_array($highestRatedProducts)) {
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
                                <p class="price"><strike>$<?php echo $row["Price"]; ?></strike><b> $<?php echo $row["OfferPrice"];
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
<div class="outer gray row">
	<div class="container">
        <h4>Daily offers on producks!</h4>
        <?php
        //Gets products on sale
        $productsOnSale = getProductsOnSale();
        while($row = mysqli_fetch_array($productsOnSale)) {
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
                                <p class="price"><strike>$<?php echo $row["Price"]; ?></strike><b> $<?php echo $row["OfferPrice"];
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
<div class="outer">
    <div class="container">
        <h4>Recent Blucks!</h4>
        <div class="row">
            <?php
            $recentBlogs = getRecentBlogs();
            while($row = mysqli_fetch_array($recentBlogs)) {
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
                                    echo preg_replace('/\s+?(\S+)?$/', '', filter_var(substr($row["BlogContent"],
                                            0, 160), FILTER_SANITIZE_STRING)) . " ...";
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
</div>


<?php require_once('../includes/footer.php') ?>
