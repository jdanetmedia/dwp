<?php
header("Access-Control-Allow-Origin: *");

spl_autoload_register(function($class) {
  include "class/" . $class . ".php";
});
$products = new Product();
$final_json = $products->exportJSON();

echo $final_json;
