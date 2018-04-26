<?php
require_once("../admin/includes/header.php");
$products = new Product();
if(isset($_POST["submit"])) {
  $products->saveProduct($_POST["ItemNumber"]);
  ?>
    <script type="text/javascript">location.href = 'edit-product.php?item=<?php echo $_POST["ItemNumber"]; ?>';</script>
  <?php
}
elseif (isset($_POST["toGallery"])) {
  $products->saveProduct($_POST["ItemNumber"]);
  ?>
    <script type="text/javascript">location.href = 'gallery.php?item=<?php echo $_POST["ItemNumber"]; ?>';</script>
  <?php
}
//
?>
  <div class="container">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="row">
        <input class="waves-effect waves-light btn grey darken-4 right new-prod-btn" type="submit" name="submit" value="Save">
      </div>
      <div class="row">
        <ul class="collapsible" data-collapsible="accordion">
          <li>
            <div class="collapsible-header <?php if(!isset($_GET["select"])) { echo "active"; } ?>"><i class="material-icons">assignment</i>General</div>
            <div class="collapsible-body">
              <div class="row">
                <div class="col s12">
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="productName" type="text" class="validate" required="" aria-required="true" name="ProductName">
                      <label for="productName">Product Name</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12 m4">
                      <select name="ProductCategoryID">
                        <?php
                          $cats = $products->getCategories();
                          foreach ($cats as $cat) {
                            if($product[0]["ProductCategoryID"] == $cat->ProductCategoryID) {
                              ?>
                              <option value="<?php echo $cat->ProductCategoryID; ?>" selected><?php echo $cat->CategoryName; ?></option>
                              <?php
                            } else {
                              ?>
                              <option value="<?php echo $cat->ProductCategoryID; ?>"><?php echo $cat->CategoryName; ?></option>
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
                          $status = $product[0]["ProductStatus"];
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
                      <input id="itemNumber" type="text" name="ItemNumber" class="validate" required="" aria-required="true">
                      <label for="itemNumber">Item number</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <textarea id="shortDescription" class="materialize-textarea" name="ShortDescription" data-length="150"></textarea>
                      <label for="shortDescription">Short description (max. 150 characters)</label>
                    </div>
                    <div class="input-field col s12">
                      <p>Long description</p>
                      <textarea id="longDescription" class="content" name="LongDescription"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="collapsible-header <?php if(isset($_GET["select"]) && $_GET["select"] == "numbers") { echo "active"; } ?>"><i class="material-icons">attach_money</i>Numbers & Prices</div>
            <div class="collapsible-body">
              <div class="row">
                <div class="input-field col s12 m4">
                  <input id="price" type="number" class="validate" required="" aria-required="true" name="Price">
                  <label for="price">Price</label>
                </div>
                <div class="input-field col s12 m4">
                  <input id="offerPrice" type="number" name="OfferPrice" class="validate">
                  <label for="offerPrice">Discount Price</label>
                </div>
                <div class="input-field col s12 m4">
                  <input id="stock" type="number" class="validate" name="StockStatus">
                  <label for="stock">Stock status</label>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="collapsible-header <?php if(isset($_GET["select"]) && $_GET["select"] == "images") { echo "active"; } ?>"><i class="material-icons">collections</i>Images</div>
            <div class="collapsible-body">
                <input type="submit" name="toGallery" value="Add image">
            </div>
          </li>
          <li>
            <div class="collapsible-header"><i class="material-icons">trending_up</i>SEO</div>
            <div class="collapsible-body">
              <div class="row">
                <div class="input-field col s12">
                  <input id="seoTitle" type="text" class="validate" name="SeoTitle" data-length="68">
                  <label for="seoTitle">Page title (Max 68 characters)</label>
                </div>
                <div class="input-field col s12">
                  <textarea id="metaDescription" class="materialize-textarea" name="MetaDescription" data-length="160"></textarea>
                  <label for="metaDescription">Meta Description (Max 160 characters)</label>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </form>
  </div>
<?php require_once("includes/footer.php"); ?>
