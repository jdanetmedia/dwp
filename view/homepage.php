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
<div class="outer">
  <div class="container">
    <div class="carousel">
      <h4>Recommended</h4>
        <?php
        //Gets highest rated products
        $highestRatedProducts = getHighestRatedProducts();
        while($row = mysqli_fetch_array($highestRatedProducts)) {
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
                        <div class='stars right rated'>
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
</div>
<div class="outer gray">
	<div class="container">
		<div class="carousel product-slider">
			<h4>New producks!</h4>
            <?php
            //Gets recently added products
            $newestProducts = getNewestProducts();
            while($row = mysqli_fetch_array($newestProducts)) {
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
                            <div class='stars right rated'>
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
</div>

<?php require_once('../includes/footer.php') ?>
