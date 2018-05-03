<?php
require_once("../admin/includes/header.php");

if (!logged_in()) {
?>
<script type="text/javascript">
	window.location.href = 'login.php';
</script>
<?php
	//redirect_to("login.php");
}

$products = new Product();
if(isset($_POST["submit"])) {
  $products->updateProduct($_GET["item"]);
  if(isset($_POST["changeImg"]) || $_POST["changeImg"] != "") {
    $item = $_GET["item"];
    $id = $_POST["changeImg"];
    $products->updatePrimary($item, $id);
  }
  if(isset($_POST["deleteImg"])) {
    $products->removeImg($_POST["deleteImg"]);
  }
}
elseif (isset($_POST["toGallery"])) {
  $products->updateProduct($_GET["item"]);
  ?>
    <script type="text/javascript">location.href = 'gallery.php?item=<?php echo $_GET["item"]; ?>';</script>
  <?php
}
$product = $products->getProductDetails($_GET["item"]);
//
?>
  <div class="container">
    <form action="edit-product.php?item=<?php echo $_GET["item"]; ?>" method="post" enctype="multipart/form-data">
      <div class="row">
        <input class="waves-effect waves-light btn grey darken-4 right new-prod-btn" type="submit" name="submit" value="Save">
        <a class="waves-effect waves-light btn grey darken-1 right new-prod-btn">Delete</a>
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
                      <input id="productName" type="text" class="validate" name="ProductName" value="<?php echo $product[0]["ProductName"]; ?>">
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
                      <input id="itemNumber" type="text" disabled class="validate" value="<?php echo $product[0]["ItemNumber"]; ?>">
                      <label for="itemNumber">Item number</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <textarea id="shortDescription" class="materialize-textarea" name="ShortDescription" data-length="150"><?php
                        if(isset($product[0]["ShortDescription"])) {
                          echo $product[0]["ShortDescription"];
                        }
                      ?></textarea>
                      <label for="shortDescription">Short description (max. 150 characters)</label>
                    </div>
                    <div class="input-field col s12">
                      <p>Long description</p>
                      <textarea id="longDescription" class="content" name="LongDescription"><?php
                        if(isset($product[0]["LongDescription"])) {
                          echo $product[0]["LongDescription"];
                        }
                      ?></textarea>
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
                  <input id="price" type="number" class="validate" name="Price" value="<?php echo $product[0]["Price"]; ?>">
                  <label for="price">Price</label>
                </div>
                <div class="input-field col s12 m4">
                  <?php
                    if(isset($product[0]["OfferPrice"])) {
                      $discount = $product[0]["OfferPrice"];
                    }
                  ?>
                  <input id="offerPrice" type="number" name="OfferPrice" <?php if(isset($discount)) { echo "value='" . $discount . "'"; } ?> class="validate">
                  <label for="offerPrice">Discount Price</label>
                </div>
                <div class="input-field col s12 m4">
                  <?php
                    if(isset($product[0]["StockStatus"])) {
                      $stock = $product[0]["StockStatus"];
                    }
                  ?>
                  <input id="stock" type="number" class="validate" name="StockStatus" value="<?php if(isset($stock)) { echo $stock; } ?>">
                  <label for="stock">Stock status</label>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="collapsible-header <?php if(isset($_GET["select"]) && $_GET["select"] == "images") { echo "active"; } ?>"><i class="material-icons">collections</i>Images</div>
            <div class="collapsible-body">
                <div class="save-message">
                  <p>Product must be saved for changes to take effect!</p>
                </div>
                <div class="row">
                <?php
                  $imgcount = 1;
                ?>
                <?php foreach ($product as $img): ?>
                  <div class="col s6 m3 admin-product-img">
                    <div class="save-delete">
                      Save product to remove image
                    </div>
                    <img class="materialboxed responsive-img" width="650" src="<?php echo $img["URL"]; ?>">
                    <?php
                      if($img["IsPrimary"] == true) {
                        echo '<a class="primary-label is-primary" href="#">Primary</a>';
                      } else {
                        echo '<a class="primary-label" href="#">Secondary</a>';
                      }
                    ?>
                    <a id="<?php echo $img["ImgID"]; ?>" class="make-primary" href="#">Make primary</a>
                    <div class="clear"></div>
                    <a id="<?php echo $img["ImgID"]; ?>" class="remove-img" href="#">Remove</a>
                  </div>
                  <?php $imgcount++; ?>
                <?php  endforeach; ?>
                <?php
                  foreach($product as $img) {
                    if($img["IsPrimary"] == true) {
                      $primaryImg = $img["ImgID"];
                    }
                  }
                ?>
                <input class="change-img" type="hidden" name="changeImg" value="<?php if(isset($primaryImg)) { echo $primaryImg; } ?>">
                <input class="delete-image" type="hidden" name="deleteImg">
                </div>
                <input class="waves-effect waves-light btn grey darken-4" type="submit" name="toGallery" value="Add image">
            </div>
          </li>
          <li>
            <div class="collapsible-header"><i class="material-icons">trending_up</i>SEO</div>
            <div class="collapsible-body">
              <div class="row">
                <div class="input-field col s12">
                  <?php
                    if(isset($product[0]->SeoTitle)) {
                      $titleTag = $product->SeoTitle;
                    } else {
                      $titleTag = "";
                    }
                  ?>
                  <input id="seoTitle" type="text" class="validate" name="SeoTitle" data-length="68" value="<?php echo $titleTag; ?>">
                  <label for="seoTitle">Page title (Max 68 characters)</label>
                </div>
                <div class="input-field col s12">
                  <?php
                    if(isset($product[0]->MetaDescription)) {
                      $metaDesc = $product[0]->MetaDescription;
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
<?php require_once("includes/footer.php"); ?>
