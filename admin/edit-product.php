<?php
require_once("../admin/includes/header.php");
require_once("../admin/includes/productDAO.php");

if(isset($_POST["submit"])) {
  if($_FILES['fileToUpload']['size'] > 0) {
    updateProduct($_GET["item"]);
    uploadImages($_FILES);
  } else {
    echo "Else is triggered";
    updateProduct($_GET["item"]);
  }
}

$product = getProductDetails($_GET["item"]);
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
            <div class="collapsible-header active"><i class="material-icons">assignment</i>General</div>
            <div class="collapsible-body">
              <div class="row">
                <div class="col s12">
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="productName" type="text" class="validate" name="ProductName" value="<?php echo $product[0]->ProductName; ?>">
                      <label for="productName">Product Name</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12 m4">
                      <select name="ProductCategoryID">
                        <?php
                          $cats = getCategories();
                          foreach ($cats as $cat) {
                            if($product[0]->ProductCategoryID == $cat->ProductCategoryID) {
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
                          $status = $product[0]->ProductStatus;
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
                      <input id="itemNumber" type="text" disabled class="validate" value="<?php echo $product[0]->ItemNumber; ?>">
                      <label for="itemNumber">Item number</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <textarea id="shortDescription" class="materialize-textarea" name="ShortDescription" data-length="150"><?php
                        if(isset($product[0]->ShortDescription)) {
                          echo $product[0]->ShortDescription;
                        }
                      ?></textarea>
                      <label for="shortDescription">Short description (max. 150 characters)</label>
                    </div>
                    <div class="input-field col s12">
                      <p>Long description</p>
                      <textarea id="longDescription" class="content" name="LongDescription"><?php
                        if(isset($product[0]->LongDescription)) {
                          echo $product[0]->LongDescription;
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
                  <input id="price" type="number" class="validate" name="Price" value="<?php echo $product[0]->Price; ?>">
                  <label for="price">Price</label>
                </div>
                <div class="input-field col s12 m4">
                  <?php
                    if(isset($product[0]->OfferPrice) || $product[0]->Offerprice != "") {
                      $discount = $product[0]->OfferPrice;
                    }
                  ?>
                  <input id="offerPrice" type="number" name="OfferPrice" <?php if(isset($discount)) { echo "value='" . $discount . "'"; } ?> class="validate">
                  <label for="offerPrice">Discount Price</label>
                </div>
                <div class="input-field col s12 m4">
                  <?php
                    if(isset($product[0]->StockStatus)) {
                      $stock = $product[0]->StockStatus;
                    }
                  ?>
                  <input id="stock" type="number" class="validate" name="StockStatus" value="<?php if(isset($stock)) { echo $stock; } ?>">
                  <label for="stock">Stock status</label>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="collapsible-header"><i class="material-icons">collections</i>Images</div>
            <div class="collapsible-body">
                <div class="row">
                <?php foreach ($product as $img): ?>
                  <div class="col s6 m3">
                    <img class="materialboxed responsive-img" width="650" src="<?php echo $img->URL; ?>">
                    <a href="#">Remove</a>
                  </div>
                <?php  endforeach; ?>
                </div>
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <!--<div class="file-field input-field">
                  <div class="btn">
                    <span>File</span>
                    <input type="file" name="newImage" multiple>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Images should be between 800x800 - 1200 x 1200 pixels">
                  </div>
                </div>-->
            </div>
          </li>
          <li>
            <div class="collapsible-header"><i class="material-icons">trending_up</i>SEO</div>
            <div class="collapsible-body">
              <div class="row">
                <div class="input-field col s12">
                  <?php
                    if(isset($product[0]->SeoTitel)) {
                      $titleTag = $product->SeoTitel;
                    } else {
                      $titleTag = "";
                    }
                  ?>
                  <input id="seoTitle" type="text" class="validate" name="SeoTitel" data-length="68" value="<?php echo $titleTag; ?>">
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
<?php require_once("../admin/includes/footer.php"); ?>