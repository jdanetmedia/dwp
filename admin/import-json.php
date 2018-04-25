<?php
require_once("../includes/connection.php");
spl_autoload_register(function($class) {
  include "class/" . $class . ".php";
});
$products = new Product();
$final_json = $products->importJSON("products.json");
echo "<h1>Import complete</h1>";
