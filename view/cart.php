<?php
require_once("../includes/sessionstart.php");
require_once('../model/cartDAO.php');
require_once('../includes/header.php');
unset($_SESSION["total"]);
if (isset($_GET["remove"]) && $_GET["remove"] == "promocode") {
  unset($_SESSION["promocode"]);
  unset($_SESSION["DiscountAmount"]);
}
?>

<div class="container">
  <h1>Cart</h1>
  <?php
  if(isset($_SESSION["promocode"]) && $_SESSION["promocode"] != NULL) {
    echo "Active promocode: " . $_SESSION["promocode"];
    if (isset($_SESSION["DiscountAmount"])) {
      echo "<br>Discount: " . $_SESSION["DiscountAmount"] . "%";
    }
  }
  ?>
  <div class="row">
    <div class="col s12 m12">
      <form class="" action="" method="post">
      <?php
      $total = 0;
      if(isset($_SESSION["cart"])) {
        foreach($_SESSION["cart"] as $key => $value) {
          $product = getCartProduct($key);
          if ($product["OfferPrice"] != NULL && $product["OfferPrice"] != 0) {
            $total = $total + $product["OfferPrice"] * $value;
          } else {
            $total = $total + $product["Price"] * $value;
          }
      ?>
      <div class="card horizontal">
        <div class="card-image">
          <img class="cart-img" src="<?php echo $product["URL"]; ?>">
        </div>
        <div class="card-stacked">
          <div class="card-content">
            <div class="left">
              <h5><?php echo $product["ProductName"]; ?></h5>
              <p><?php echo $product["ShortDescription"]; ?></p>
            </div>
            <div class="right">
                <div class="input-field inline cart_quantity">
                  <input name="<?php echo $key; ?>" id="quantity" type="number" value="<?php echo $value; ?>">
                  <label for="quantity">Quantity</label>
                </div>
            </div>
          </div>
          <div class="card-action">
            <a href="cart.php?remove=<?php echo $key; ?>" class="remove_from_cart">Remove from cart</a>
            <?php
            if ($product["OfferPrice"] != NULL && $product["OfferPrice"] > 0) {
            ?>
            <p class="price right"><strike class="black-text">$<?php echo $product["Price"] * $value; ?></strike> $<?php echo $product["OfferPrice"] * $value; ?></p>
            <?php
            } else {
            ?>
            <p class="price right">$<?php echo $product["Price"] * $value; ?></p>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
      <?php
        }
      }
      ?>
      <a class="waves-effect waves-light btn cart-btt right"><input type="submit" name="updatecart" value="Update cart"></a>
      </form>
      <form class="" action="" method="post">
        <div class="input-field col s6 m3">
          <input id="promocode" type="text" name="promocode" class="validate">
          <label for="promocode">Promocode</label>
        </div>
        <a class="waves-effect waves-light btn cart-btt"><input type="submit" name="submitpromocode" value="Add promocode"></a>
      </form>
    </div>
  </div>
  <div class="row">
    <?php
      if (isset($_SESSION["DiscountAmount"])) {
        $discounttotal = ($total / 100) * $_SESSION["DiscountAmount"];
        ?>
        <a class="waves-effect waves-light btn" href="cart.php?remove=promocode">Remove promocode</a>
        <div class="row">
          <h5 class="left"><strike>Total price: $<?php echo $total;?></strike></h5>
        </div>
        <div class="row">
          <h5 class="left">After discount: $<?php echo $discounttotal;?></h5>
        </div>
        <?php
      } else {
        ?>
        <div class="row">
          <h5 class="left">Total price: $<?php echo $total;?></h5>
        </div>
        <?php
      }
    ?>
    <a class="waves-effect waves-light btn right" href="shipping.php">Go to Duckout</a>
  </div>
</div>

<?php
$_SESSION["total"] = $total;
require_once('../includes/footer.php'); ?>
