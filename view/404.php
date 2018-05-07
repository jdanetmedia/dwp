<?php require_once('../includes/header.php');
require_once("../includes/sessionstart.php");
 require_once ('../model/contactDAO.php');
 $pageInfo = getPageInfo();
?>
<div class="container" style="filter: blur(0px);">
    <div class="row center">
      <h2>Sorry, the page you are looking for does not exist</h2>
      <div class="row">
        <img class="responsive-img" src="https://cdn-images-1.medium.com/max/1600/1*qdFdhbR00beEaIKDI_WDCw.gif" alt="404" style="border-radius: 50%;">
      </div>
      <p><a href="products.php">Browse our products</a></p>
    </div>
</div>

<?php require_once('../includes/footer.php') ?>
