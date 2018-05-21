<?php
header("Access-Control-Allow-Origin: *");
require_once("../includes/connection.php");
spl_autoload_register(function($class) {
  include "class/" . $class . ".php";
});
$products = new Product();
$final_json = $products->exportJSON();

echo $final_json;
