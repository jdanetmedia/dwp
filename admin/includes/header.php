<?php
require_once("../includes/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Duckshop admin area</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import FontAwesome Icons for editor-->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    <!--Import Editor styling-->
    <link rel="stylesheet" href="richtext/richtext.min.css">
    <!--Import custom styling-->
    <link type="text/css" rel="stylesheet" href="../css/custom/custom.css" />
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body class="admin-area">
    <nav class="grey darken-4 admin-topnav">
      <div class="nav-wrapper">
        <a href="index.php" class="brand-logo">Admin area</a>
        <ul class="right hide-on-med-and-down">
          <li class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Dahsboard"><a href="index.php"><i class="material-icons">home</i></a></li>
          <li class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Manage orders"><a href="manage-orders.php"><i class="material-icons">shopping_cart</i></a></li>
          <li class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Manage products"><a href="manage-products.php"><i class="material-icons">view_list</i></a></li>
          <li class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Manage blog"><a href="manage-blog.php"><i class="material-icons">subject</i></a></li>
          <li class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Shop settings"><a href="manage-settings.php"><i class="material-icons">settings</i></a></li>
          <li class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Manage user"><a href="manage-user.php"><i class="material-icons">person</i></a></li>
        </ul>
      </div>
    </nav>
