<?php
require_once("../includes/sessionstart.php");
require_once('../includes/header.php');
require_once('../model/cartDAO.php');
?>
<div class="container">
  <div class="row">
    <form class="col s12 m12" action="">
      <h5>Payment</h5>
      <!-- stripe payment script -->
      <div class="clear"></div>
      <input class="waves-effect waves-light btn" type="submit" name="create" value="Pay!">
    </form>
  </div>
</div>
<?php require_once('../includes/footer.php'); ?>
