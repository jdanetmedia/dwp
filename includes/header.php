<?php
if (!file_exists('../includes/constants.php')) {
  header('Location: ../install/install.php');
}
// DB connection
require_once("../includes/connection.php");

// Customer login functions and session
require_once("../includes/loginCustomer/session.php");
require_once("../includes/loginCustomer/functions.php");
require_once("../model/customerDAO.php");

// Getting basic page info from DB
require_once("../model/contactDAO.php");
$pageInfo = getPageInfo();
?>
<!DOCTYPE html>
  <html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <?php require_once("../includes/seo.php"); ?>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="../css/custom/custom.css" />
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    </head>
    <body>
      <nav class="teal">
        <div class="nav-wrapper">
          <a href="../index.php" class="brand-logo"><img class="responsive-img" style="max-height: 64px!important; padding: 4px 0!important;" src="../<?php echo $pageInfo["LogoURL"]; ?>"></a>
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
          <!-- Dropdown Structure -->
          <ul id="dropdown1" class="dropdown-content">
            <li><a href="orders.php">Orders</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li class="divider"></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
          <!-- Normal menu -->
          <ul class="right hide-on-med-and-down">
            <li><a href="../index.php">Home</a></li>
            <li><a href="products.php">Producks</a></li>
            <li><a href="contact.php">Quack at us</a></li>
            <li><a href="blog.php">Bluck</a></li>
            <?php
              if (logged_in() == true) {
            ?>
            <li><a class="dropdown-button" href="" data-activates="dropdown1"><?php echo $_SESSION["FirstName"]; ?><i class="material-icons right">arrow_drop_down</i></a></li>
            <?php
              } else {
            ?>
            <li><a href="login.php">Login</a></li>
            <?php
              }
            ?>
            <li><a href="cart.php">Ducking cart<i class="material-icons right">shopping_cart</i></a></li>
            <?php
              if(isset($_SESSION["cart"])) {
                $amountInCart = count($_SESSION["cart"]);
                if ($amountInCart > 0) {
                ?>
                  <li class="cartamount"><a class="cartamount"><?php echo $amountInCart; ?></a></li>
                <?php
                } else {
                  ?>
                    <li class="cartamount"><a class="cartamount" style="color: transparent;">0</a></li>
                  <?php
                }
              } else {
                ?>
                  <li class="cartamount"><a class="cartamount" style="color: transparent;">0</a></li>
                <?php
              }
            ?>
          </ul>
          <!-- Dropdown Structure -->
          <ul id="dropdown2" class="dropdown-content">
            <li><a href="orders.php">Orders</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li class="divider"></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
          <!-- Mobile menu-->
          <ul class="side-nav" id="mobile-demo">
              <li><a href="../index.php">Home</a></li>
              <li><a href="products.php">Producks</a></li>
              <li><a href="contact.php">Quack at us</a></li>
              <li><a href="blog.php">Bluck</a></li>
              <?php
                if (logged_in() == true) {
              ?>
              <li><a class="dropdown-button" href="" data-activates="dropdown2"><?php echo $_SESSION["FirstName"]; ?><i class="material-icons right">arrow_drop_down</i></a></li>
              <?php
                } else {
              ?>
              <li><a href="login.php">Login</a></li>
              <?php
                }
              ?>
              <li><a href="cart.php">Ducking cart<i class="material-icons right">shopping_cart</i></a></li>
              <?php
                $amountInCart = count($_SESSION["cart"]);
                if ($amountInCart > 0) {
              ?>
                <li class="cartamount"><a class="cartamount"><?php echo $amountInCart; ?></a></li>
              <?php
                }
              ?>
          </ul>
        </div>
      </nav>
