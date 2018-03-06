<?php require_once("../admin/includes/header.php"); ?>
  <div class="container">
    <div class="row">
      <a class="waves-effect waves-light btn grey darken-4 right new-prod-btn"><i class="material-icons left">save</i>Save</a>
      <a class="waves-effect waves-light btn grey darken-1 right new-prod-btn"><i class="material-icons left">delete</i>Delete</a>
    </div>
    <div class="row">
      <ul class="collapsible" data-collapsible="accordion">
        <li>
          <div class="collapsible-header active"><i class="material-icons">assignment</i>General</div>
          <div class="collapsible-body">
            <div class="row">
              <form class="col s12">
                <div class="row">
                  <div class="input-field col s12">
                    <input id="productName" type="text" class="validate">
                    <label for="productName">Product Name</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s6">
                    <input id="itemNumber" type="text" class="validate">
                    <label for="itemNumber">Item number</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <textarea id="shortDescription" class="materialize-textarea" data-length="150"></textarea>
                    <label for="shortDescription">Short description (max. 150 characters)</label>
                  </div>
                  <div class="input-field col s12">
                    <textarea id="longDescription" class="materialize-textarea"></textarea>
                    <label for="longDescription">Long description</label>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">attach_money</i>Numbers & Prices</div>
          <div class="collapsible-body">
            <div class="row">
              <div class="input-field col s12 m4">
                <input id="price" type="number" class="validate">
                <label for="price">Price</label>
              </div>
              <div class="input-field col s12 m4">
                <input id="offerPrice" type="number" class="validate">
                <label for="offerPrice">Discount Price</label>
              </div>
              <div class="input-field col s12 m4">
                <input id="stock" type="number" class="validate">
                <label for="stock">Stock status</label>
              </div>
            </div>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">collections</i>Images</div>
          <div class="collapsible-body">
            <div class="row">
              <div class="col s6 m3">
                <img class="materialboxed responsive-img" width="650" src="http://lorempixel.com/800/800/sports/">
                <a href="#">Remove</a>
              </div>
              <div class="col s6 m3">
                <img class="materialboxed responsive-img" width="650" src="http://lorempixel.com/800/800/animals/">
                <a href="#">Remove</a>
              </div>
              <div class="col s6 m3">
                <img class="materialboxed responsive-img" width="650" src="http://lorempixel.com/800/800/city/">
                <a href="#">Remove</a>
              </div>
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
                <input id="seoTitle" type="text" class="validate" data-length="68">
                <label for="seoTitle">Page title (Max 68 characters)</label>
              </div>
              <div class="input-field col s12">
                <textarea id="metaDescription" class="materialize-textarea" data-length="160"></textarea>
                <label for="metaDescription">Meta Description (Max 160 characters)</label>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
<?php require_once("../admin/includes/footer.php"); ?>
