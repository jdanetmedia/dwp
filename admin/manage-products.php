<?php
require_once("../admin/includes/header.php");
require_once("includes/productDAO.php");
$allProducts = getAllProducts();
?>
<div class="container">
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <div class="input-field col s4 right">
            <i class="material-icons prefix">search</i>
            <input id="icon_telephone" type="tel" class="validate">
            <label for="icon_telephone">Search products</label>
          </div>
          <span class="card-title">Products<a class="waves-effect waves-light btn grey darken-4 new-prod-btn" href="new-product.php">Add new</a></span>
          <table class="responsive-table">
            <thead>
              <tr>
                  <th>Name</th>
                  <th>Itemnumber</th>
                  <th>Price</th>
                  <th>Sale price</th>
                  <th>Short Description</th>
                  <th>Status</th>
                  <th>Edit</th>
              </tr>
            </thead>
            <?php // TODO: Ændre farve på select felter ?>
            <tbody>
              <?php
                foreach ($allProducts as $product) {
                    ?>
                    <tr>
                      <td><?php echo $product["ProductName"]; ?></td>
                      <td><?php echo $product["ItemNumber"]; ?></td>
                      <td><?php echo $product["Price"]; ?> DKK</td>
                      <td>
                        <?php
                          if(isset($product["OfferPrice"])) {
                            echo $product("OfferPrice");
                          } else {
                            echo "-";
                          }
                        ?>
                      </td>
                      <td class="ShortDescription">
                        <?php
                          $text = $product["ShortDescription"];
                          if(strlen($text) >= 30) {
                            echo substr($text, 0, 30) . "...";
                          } else {
                            echo $text;
                          }

                          // if (isset($product["ShortDescription"])) {
                          //   $showText = strlen($product["ShortDescription"]) > 30 ? substr($product["ShortDescription"], 0, 30) . "..." : $product["ShortDescription"];
                          //   echo $showText;
                          // } else {
                          //   echo "-";
                          // }
                        ?>
                      </td>
                      <td>
                        <div class="input-field">
                          <select>
                            <?php
                              if($product["ProductStatus"] == true) {
                                  ?>
                                    <option value="1" selected>Active</option>
                                    <option value="2">Inactive</option>
                                  <?php
                              } else {
                                ?>
                                  <option value="1">Active</option>
                                  <option value="2" selected>Inactive</option>
                                <?php
                              }
                            ?>
                          </select>
                        </div>
                      </td>
                      <td><a href="edit-product.php?item=<?php echo $product["ItemNumber"]; ?>">Edit</a></td>
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
