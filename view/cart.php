<?php
require_once("../includes/sessionstart.php");
require_once('../model/cartDAO.php');
require_once('../includes/header.php');
?>

<div class="container">
  <h1>Cart</h1>
  <div class="row">
    <div class="col s12 m12">
      <form class="" action="" method="post">
      <?php
      $total = 0;
      if(isset($_SESSION["cart"])) {
        foreach($_SESSION["cart"] as $key => $value) {
          $product = getCartProduct($key);
          $total = $total + $product["Price"] * $value;
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
            <p class="price right">$<?php echo $product["Price"] * $value; ?></p>
          </div>
        </div>
      </div>
      <?php
        }
      }
      ?>
      <a class="waves-effect waves-light btn cart-btt right"><input type="submit" name="updatecart" value="Update cart"></a>
      </form>
    </div>
  </div>
  <div class="row">
    <h5 class="left">Total price: $<?php echo $total;?></h5>
    <a class="waves-effect waves-light btn right" href="shipping.php">Go to Duckout</a>
  </div>
</div>

<?php
$_SESSION["total"] = $total;
require_once('../includes/footer.php'); ?>
