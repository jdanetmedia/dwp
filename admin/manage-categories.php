<?php
require_once("../includes/sessionstart.php");
require_once("../admin/includes/header.php");
spl_autoload_register(function($class) {
    include "class/".$class.".php";
});

if (!logged_in()) {
    ?>
    <script type="text/javascript">
        window.location.href = 'login.php';
    </script>
    <?php
    //redirect_to("login.php");
}
$category = new Categories();
$productCategories = $category->getAllProductCategories();
$blogPostCategories = $category->getAllBlogPostCategories();
if(isset($_POST["saveProductCategory"])) {
    $category->saveProductCategory();
    ?>
    <script type="text/javascript">location.href = 'manage-categories.php?select=product';</script>
    <?php
}
else if (isset($_POST["saveBlogPostCategory"])) {
    $category->saveBlogPostCategory();
    ?>
    <script type="text/javascript">location.href = 'manage-categories.php?select=blogPost';</script>
    <?php
}
?>
<div class="container">
    <div class="row">
    <div class="col s12">
    <div class="card">
        <div class="card-content">
            <span class="card-title">Categories</span>
        </div>
        <div class="card-tabs">
            <ul class="tabs tabs-fixed-width">
                <li class="tab"><a class="<?php if(isset($_GET["select"]) && $_GET["select"] == "product") { echo "active"; } ?>"
                                   href="#productCategories">Manage product categories</a></li>
                <li class="tab"><a class="<?php if(isset($_GET["select"]) && $_GET["select"] == "blogPost") { echo "active"; } ?>"
                                   href="#blogPostCategories">Manage blog post categories</a></li>
            </ul>
        </div>
        <div class="card-content">
            <div class="row" id="productCategories">
                <div class="col s12">
                            <span class="card-title">Product Categories<a class="waves-effect waves-light btn grey darken-4
                            new-prod-btn btn modal-trigger" href="#modal1">Add new</a></span>
                    <!-- Modal Structure -->
                    <div id="modal1" class="modal">
                        <div class="modal-content">
                            <form action="" method="post" enctype="multipart/form-data">
                                <h4 class="left">New Product Category</h4>
                                <div class="row">
                                    <input class="waves-effect waves-light btn grey darken-4 right new-prod-btn" type="submit"
                                           name="saveProductCategory" value="Save">
                                </div>
                                <div class="row">
                                    <ul class="collapsible" data-collapsible="accordion">
                                        <li>
                                            <div class="collapsible-header active"><i
                                                        class="material-icons">assignment</i>General</div>
                                            <div class="collapsible-body">
                                                <div class="row">
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <input id="categoryName" type="text" class="validate"
                                                                       name="categoryName">
                                                                <label for="categoryName">Category Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <p>Category Description</p>
                                                                <textarea id="description" class="content"
                                                                          name="description"></textarea>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="collapsible-header"><i class="material-icons">trending_up</i>SEO</div>
                                            <div class="collapsible-body">
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input id="seoTitleProduct" name="seoTitleProduct" type="text" class="validate"
                                                               data-length="68">
                                                        <label for="seoTitle">Page title (Max 68 characters)</label>
                                                    </div>
                                                    <div class="input-field col s12">
                                                        <textarea id="metaDescriptionProduct" name="metaDescriptionProduct"
                                                                  class="materialize-textarea"
                                                                  data-length="160"></textarea>
                                                        <label for="metaDescription">Meta Description (Max 160 characters)</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                            <table class="responsive-table striped">
                                <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th>Seo Title</th>
                                    <th>Meta Description</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <?php // TODO: Ændre farve på select felter ?>
                                <tbody>
                                <?php
                                foreach ($productCategories as $aProductCategory) {
                                    ?>
                                    <tr>
                                        <td><?php echo $aProductCategory->CategoryName; ?></td>
                                        <td><?php if (strlen($aProductCategory->Description) > 100) {
                                                echo preg_replace('/\s+?(\S+)?$/', '', substr
                                                    ($aProductCategory->Description, 0, 100)) . " ...";
                                            } else echo $aProductCategory->Description; ?></td>
                                        <td><?php echo $aProductCategory->SeoTitle; ?></td>
                                        <td><?php echo $aProductCategory->MetaDescription; ?></td>
                                        <td><a href="edit-product-category.php?ID=<?php echo $aProductCategory->ProductCategoryID;
                                        ?>">Edit</a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
            </div>
            <div class="row" id="blogPostCategories">
                <div class="col s12">
                            <span class="card-title">Blog Post Categories<a class="waves-effect waves-light btn grey darken-4
                            new-prod-btn btn modal-trigger" href="#modal2">Add new</a></span>
                    <div id="modal2" class="modal">
                        <div class="modal-content">
                            <form action="" method="post" enctype="multipart/form-data">
                                <h4 class="left">New Blog Post Category</h4>
                                <div class="row">
                                    <input class="waves-effect waves-light btn grey darken-4 right new-prod-btn" type="submit"
                                           name="saveBlogPostCategory" value="Save">
                                </div>
                                <div class="row">
                                    <ul class="collapsible" data-collapsible="accordion">
                                        <li>
                                            <div class="collapsible-header active"><i
                                                        class="material-icons">assignment</i>General</div>
                                            <div class="collapsible-body">
                                                <div class="row">
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <input id="categoryName" type="text" class="validate"
                                                                       name="categoryName">
                                                                <label for="categoryName">Category Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <p>Category Description</p>
                                                                <textarea id="description" class="content1"
                                                                          name="description"></textarea>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="collapsible-header"><i class="material-icons">trending_up</i>SEO</div>
                                            <div class="collapsible-body">
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input id="seoTitleCategory" name="seoTitleCategory" type="text" class="validate"
                                                               data-length="68">
                                                        <label for="seoTitle">Page title (Max 68 characters)</label>
                                                    </div>
                                                    <div class="input-field col s12">
                                                        <textarea id="metaDescriptionCategory" name="metaDescriptionCategory"
                                                                  class="materialize-textarea"
                                                                  data-length="160"></textarea>
                                                        <label for="metaDescription">Meta Description (Max 160 characters)</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                            <table class="responsive-table striped">
                                <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th>Seo Title</th>
                                    <th>Meta Description</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <?php // TODO: Ændre farve på select felter ?>
                                <tbody>
                                <?php
                                foreach ($blogPostCategories as $aBlogPostCategory) {
                                    ?>
                                    <tr>
                                        <td><?php echo $aBlogPostCategory->CategoryName; ?></td>
                                        <td><?php if (strlen($aBlogPostCategory->Description) > 100) {
                                                echo preg_replace('/\s+?(\S+)?$/', '', substr
                                                    ($aBlogPostCategory->Description, 0, 100)) . " ...";
                                            } else echo $aBlogPostCategory->Description; ?></td>
                                        <td><?php echo $aBlogPostCategory->SeoTitle; ?></td>
                                        <td><?php echo $aBlogPostCategory->MetaDescription; ?></td>
                                        <td><a href="edit-blog-post-category.php?ID=<?php echo $aBlogPostCategory->BlogCategoryID;
                                        ?>">Edit</a></td>
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
    </div>
</div>

<?php require_once("../admin/includes/footer.php"); ?>