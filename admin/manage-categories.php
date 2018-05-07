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
                <li class="tab"><a href="#productCategories">Manage product categories</a></li>
                <li class="tab"><a href="#blogPostCategories">Manage blog post categories</a></li>
            </ul>
        </div>
        <div class="card-content">
            <div class="row" id="productCategories">
                <div class="col s12">
                            <span class="card-title">Product Categories<a class="waves-effect waves-light btn grey darken-4
                            new-prod-btn" href="new-blogpost.php">Add new</a></span>
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
                            new-prod-btn" href="new-blogpost.php">Add new</a></span>
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