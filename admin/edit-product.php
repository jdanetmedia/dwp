<?php
require_once("../admin/includes/header.php");
require_once("../admin/includes/productDAO.php");

if(isset($_POST["submit"])) {
  updateProduct($_GET["item"]);
}

$productImgs = getProductDetails($_GET["item"]);
$product = mysqli_fetch_assoc($productImgs);
?>
  <div class="container">
    <form action="edit-product.php?item=<?php echo $_GET["item"]; ?>" method="post">
      <div class="row">
        <input class="waves-effect waves-light btn grey darken-4 right new-prod-btn" type="submit" name="submit" value="Save">
        <a class="waves-effect waves-light btn grey darken-1 right new-prod-btn">Delete</a>
      </div>
      <div class="row">
        <ul class="collapsible" data-collapsible="accordion">
          <li>
            <div class="collapsible-header active"><i class="material-icons">assignment</i>General</div>
            <div class="collapsible-body">
              <div class="row">
                <div class="col s12">
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="productName" type="text" class="validate" name="ProductName" value="<?php echo $product["ProductName"]; ?>">
                      <label for="productName">Product Name</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12 m4">
                      <select name="ProductCategoryID">
                        <?php
                          $cats = getCategories();
                          foreach ($cats as $cat) {
                            if($product["ProductCategoryID"] == $cat["ProductCategoryID"]) {
                              ?>
                              <option value="<?php echo $cat["ProductCategoryID"] ?>" selected><?php echo $cat["CategoryName"]; ?></option>
                              <?php
                            } else {
                              ?>
                              <option value="<?php echo $cat["ProductCategoryID"] ?>"><?php echo $cat["CategoryName"]; ?></option>
                              <?php
                            }
                          }
                        ?>
                      </select>
                      <label>Category</label>
                    </div>
                    <div class="input-field col s12 m4">
                      <select name="ProductStatus">
                        <?php
                          $status = $product["ProductStatus"];
                          if($status == "1") {
                              ?>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                              <?php
                          } else {
                            ?>
                              <option value="1">Active</option>
                              <option value="0" selected>Inactive</option>
                            <?php
                          }
                        ?>
                      </select>
                      <label>Status</label>
                    </div>
                    <div class="input-field col s12 m4">
                      <input id="itemNumber" type="text" disabled class="validate" value="<?php echo $product["ItemNumber"]; ?>">
                      <label for="itemNumber">Item number</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <textarea id="shortDescription" class="materialize-textarea" name="ShortDescription" data-length="150"><?php
                        if(isset($product["ShortDescription"])) {
                          echo $product["ShortDescription"];
                        }
                      ?></textarea>
                      <label for="shortDescription">Short description (max. 150 characters)</label>
                    </div>
                    <div class="input-field col s12">
                      <p>Long description</p>
                      <textarea id="longDescription" class="content" name="LongDescription"><?php
                        if(isset($product["LongDescription"])) {
                          echo $product["LongDescription"];
                        }
                      ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="collapsible-header"><i class="material-icons">attach_money</i>Numbers & Prices</div>
            <div class="collapsible-body">
              <div class="row">
                <div class="input-field col s12 m4">
                  <input id="price" type="number" class="validate" name="Price" value="<?php echo $product["Price"]; ?>">
                  <label for="price">Price</label>
                </div>
                <div class="input-field col s12 m4">
                  <?php
                    if(isset($product["OfferPrice"]) || $product["Offerprice"] != "") {
                      $discount = $product["OfferPrice"];
                    }
                  ?>
                  <input id="offerPrice" type="number" name="OfferPrice" <?php if(isset($discount)) { echo "value='" . $discount . "'"; } ?> class="validate">
                  <label for="offerPrice">Discount Price</label>
                </div>
                <div class="input-field col s12 m4">
                  <?php
                    if(isset($product["StockStatus"])) {
                      $stock = $product["StockStatus"];
                    }
                  ?>
                  <input id="stock" type="number" class="validate" name="StockStatus" value="<?php echo $stock; ?>">
                  <label for="stock">Stock status</label>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="collapsible-header"><i class="material-icons">collections</i>Images</div>
            <div class="collapsible-body">
              <div class="row">
                <?php foreach ($productImgs as $img): ?>
                  <div class="col s6 m3">
                    <img class="materialboxed responsive-img" width="650" src="<?php echo $img["URL"]; ?>">
                    <a href="#">Remove</a>
                  </div>
                <?php  endforeach; ?>
              </div>
              <form action="#">
                <div class="file-field input-field">
                  <div class="btn">
                    <span>File</span>
                    <input type="file">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Images should be between 800x800 - 1200 x 1200 pixels">
                  </div>
                </div>
              </form>
            </div>
          </li>
          <li>
            <div class="collapsible-header"><i class="material-icons">trending_up</i>SEO</div>
            <div class="collapsible-body">
              <div class="row">
                <div class="input-field col s12">
                  <?php
                    if(isset($product["SeoTitel"])) {
                      $titleTag = $product["SeoTitel"];
                    } else {
                      $titleTag = "";
                    }
                  ?>
                  <input id="seoTitle" type="text" class="validate" name="SeoTitel" data-length="68" value="<?php echo $titleTag; ?>">
                  <label for="seoTitle">Page title (Max 68 characters)</label>
                </div>
                <div class="input-field col s12">
                  <?php
                    if(isset($product["MetaDescription"])) {
                      $metaDesc = $product["MetaDescription"];
                    } else {
                      $metaDesc = "";
                    }
                  ?>
                  <textarea id="metaDescription" class="materialize-textarea" name="MetaDescription" data-length="160"><?php echo $metaDesc; ?></textarea>
                  <label for="metaDescription">Meta Description (Max 160 characters)</label>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </form>
  </div>
<?php require_once("../admin/includes/footer.php"); ?>
