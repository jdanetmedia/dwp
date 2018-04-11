<?php
require_once('../includes/connection.php');

function getSlides() {
  global $connection;

  $query = "SELECT * FROM FrontSlider";

  $slideResult = mysqli_query($connection, $query);
  return $slideResult;
}
?>
