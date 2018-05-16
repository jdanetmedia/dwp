<?php

?>

<ul class="collapsible">
  <li>
    <div class="collapsible-header"><i class="material-icons">home</i>Homepage SEO</div>
    <div class="collapsible-body">
      <div class="row">
        <div class="input-field col s12">
          <input id="HomeSeoTitle" type="text" class="validate" name="HomeSeoTitle" data-length="68" value="<?php echo $info["HomeSeoTitle"]; ?>">
          <label for="HomeSeoTitle">Page title (Max 68 characters)</label>
        </div>
        <div class="input-field col s12">
          <textarea id="HomeMetaDescription" class="materialize-textarea" name="HomeMetaDescription" data-length="160"><?php echo $info["HomeMetaDescription"]; ?></textarea>
          <label for="HomeMetaDescription">Meta Description (Max 160 characters)</label>
        </div>
      </div>
    </div>
  </li>
  <li>
    <div class="collapsible-header"><i class="material-icons">phone</i>Contactpage SEO</div>
    <div class="collapsible-body">
      <div class="row">
        <div class="input-field col s12">
          <input id="ContactSeoTitle" type="text" class="validate" name="ContactSeoTitle" data-length="68" value="<?php echo $info["ContactSeoTitle"]; ?>">
          <label for="ContactSeoTitle">Page title (Max 68 characters)</label>
        </div>
        <div class="input-field col s12">
          <textarea id="ContactMetaDescription" class="materialize-textarea" name="ContactMetaDescription" data-length="160"><?php echo $info["ContactMetaDescription"]; ?></textarea>
          <label for="ContactMetaDescription">Meta Description (Max 160 characters)</label>
        </div>
      </div>
    </div>
  </li>
  <li>
    <div class="collapsible-header"><i class="material-icons">shopping_cart</i>Productspage SEO</div>
    <div class="collapsible-body">
      <div class="row">
        <div class="input-field col s12">
          <input id="ProductsSeoTitle" type="text" class="validate" name="ProductsSeoTitle" data-length="68" value="<?php echo $info["ProductsSeoTitle"]; ?>">
          <label for="ProductsSeoTitle">Page title (Max 68 characters)</label>
        </div>
        <div class="input-field col s12">
          <textarea id="ProductsMetaDescription" class="materialize-textarea" name="ProductsMetaDescription" data-length="160"><?php echo $info["ProductsMetaDescription"]; ?></textarea>
          <label for="ProductsMetaDescription">Meta Description (Max 160 characters)</label>
        </div>
      </div>
    </div>
  </li>
  <li>
    <div class="collapsible-header"><i class="material-icons">library_books</i>Blogpage SEO</div>
    <div class="collapsible-body">
      <div class="row">
        <div class="input-field col s12">
          <input id="BlogSeoTitle" type="text" class="validate" name="BlogSeoTitle" data-length="68" value="<?php echo $info["BlogSeoTitle"]; ?>">
          <label for="BlogSeoTitle">Page title (Max 68 characters)</label>
        </div>
        <div class="input-field col s12">
          <textarea id="BlogMetaDescription" class="materialize-textarea" name="BlogMetaDescription" data-length="160"><?php echo $info["BlogMetaDescription"]; ?></textarea>
          <label for="BlogMetaDescription">Meta Description (Max 160 characters)</label>
        </div>
      </div>
    </div>
  </li>
</ul>
