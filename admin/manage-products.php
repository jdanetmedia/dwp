<?php
require_once("../includes/sessionstart.php");
require_once("../admin/includes/header.php");
// require_once("includes/productDAO.php");

if (!logged_in()) {
?>
<script type="text/javascript">
	window.location.href = 'login.php';
</script>
<?php
	//redirect_to("login.php");
}

$products = new Product();
if(isset($_GET["search"])) {
    $allProducts = $products->searchResult($_GET["search"]);
    $searchString = $_GET["search"];
} else {
    $allProducts = $products->getAllProducts();
}
?>
<div class="container">
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <form class="" action="" method="get">
            <div class="input-field col s4 right">
              <input id="search" type="text" name="search" <?php if(isset($searchString)) { echo "value='" . $searchString . "'"; } ?>>
              <label for="search">Search products</label>
            </div>
            <div class="col s2 right">
              <input class="waves-effect waves-light btn grey darken-4 new-prod-btn" type="submit" name="submit" value="Search">
            </div>
          </form>
          <span class="card-title">Products<a class="waves-effect waves-light btn grey darken-4 new-prod-btn" href="new-product.php">Add new</a></span>
          <table class="responsive-table striped">
            <thead>
              <tr>
                  <th>Name</th>
                  <th>Itemnumber</th>
                  <th>Price</th>
                  <th>Sale price</th>
                  <th>Short Description</th>
                  <th>Created on:</th>
                  <th>Edit</th>
              </tr>
            </thead>
            <?php // TODO: Ændre farve på select felter ?>
            <tbody>
              <?php
                foreach ($allProducts as $product) {
                    ?>
                    <tr>
                      <td><?php echo $product->ProductName; ?></td>
                      <td><?php echo $product->ItemNumber; ?></td>
                      <td><?php echo $product->Price; ?></td>
                      <td>
                        <?php
                          if(isset($product->OfferPrice)) {
                            echo "$" . $product->OfferPrice;
                          } else {
                            echo "-";
                          }
                        ?>
                      </td>
                      <td class="ShortDescription">
                        <?php
                          $text = $product->ShortDescription;
                          if(strlen($text) >= 30) {
                            echo substr($text, 0, 30) . "...";
                          } else {
                            echo $text;
                          }
                        ?>
                      </td>
                      <td><?php echo $product->CreationDate; ?></td>
                      <td><a href="edit-product.php?item=<?php echo $product->ItemNumber; ?>">Edit</a></td>
                    </tr>
                    <?php
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once("../admin/includes/footer.php"); ?>
