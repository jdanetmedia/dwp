<?php
require_once("includes/connection.php");
?>
<!DOCTYPE html>
  <html>
    <html lang="da-DK">
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="css/custom/custom.css" />
      <!--Import noUIslider-->
      <link type="text/css" rel="stylesheet" href="nouislider/nouislider.css" />
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
      <nav class="teal">
        <div class="nav-wrapper">
          <a href="index.php" class="brand-logo">RUBBER DUCK SHOP</a>
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="products.php">Producks</a></li>
            <li><a href="product.php">Jespers Duck</a></li>
            <li><a href="contact.php">Quack at us</a></li>
            <li><a href="blog.php">Bluck</a></li>
            <li><a href="cart.php">Ducking cart<i class="material-icons right">shopping_cart</i></a></li>
          </ul>
          <ul class="side-nav" id="mobile-demo">
              <li><a href="products.php">Producks</a></li>
              <li><a href="product.php">Jespers Duck</a></li>
              <li><a href="contact.php">Quack at us</a></li>
              <li><a href="blog.php">Bluck</a></li>
              <li><a href="cart.php">Ducking cart<i class="material-icons right">shopping_cart</i></a></li>
          </ul>
        </div>
      </nav>
