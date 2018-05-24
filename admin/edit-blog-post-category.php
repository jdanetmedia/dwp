<?php
require_once("../includes/sessionstart.php");
require_once("../admin/includes/header.php");

if (!logged_in()) {
    ?>
    <script type="text/javascript">
        window.location.href = 'login.php';
    </script>
    <?php
    //redirect_to("login.php");
}

$category = new Categories();
$aCategory = $category->getBlogPostCategoryDetails($_GET["ID"]);
    if(isset($_POST["submit"])) {
    $category->updateBlogPostCategory($_GET["ID"]);
    ?>
    <script type="text/javascript">location.href = 'manage-categories.php?select=blogPost';</script>
<?php
} elseif (isset($_POST["submit2"])) {
$category->deleteBlogPostCategory($_GET["ID"]);
?>
    <script type="text/javascript">location.href = 'manage-categories.php?select=blogPost';</script>
<?php
}
?>

<div class="container">
    <form action="edit-blog-post-category.php?ID=<?php echo $_GET["ID"]; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <input class="waves-effect waves-light btn grey darken-4 right new-prod-btn" type="submit" name="submit" value="Save">
            <button class="waves-effect waves-light btn grey darken-4 right new-prod-btn" type="submit2" name="submit2"
                    value="Delete">Delete</button>
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
                                        <input id="categoryName" type="text" class="validate" name="categoryName"
                                               value="<?php echo $aCategory[0]["CategoryName"]; ?>" required="" aria-required="true">
                                        <label for="categoryName">Category Name</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <p>Category Description</p>
                                        <textarea id="description" class="content" name="description"><?php
                                            if(isset($aCategory[0]["Description"])) {
                                            echo $aCategory[0]["Description"];
                                            }
                                            ?></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">trending_up</i>SEO</div>
                    <div class="collapsible-body">
                        <div class="row">
                            <div class="input-field col s12">
                                <?php
                                if(isset($aCategory[0]["SeoTitle"])) {
                                $titleTag = $aCategory[0]["SeoTitle"];
                                } else {
                                $titleTag = "";
                                }
                                ?>
                                <input id="seoTitle" name="seoTitle" type="text" class="validate" data-length="68" value="<?php echo
                                $titleTag; ?>">
                                <label for="seoTitle">Page title (Max 68 characters)</label>
                            </div>
                            <div class="input-field col s12">
                                <?php
                                if(isset($aCategory[0]["MetaDescription"])) {
                                $metaDesc = $aCategory[0]["MetaDescription"];
                                } else {
                                $metaDesc = "";
                                }
                                ?>
                                <textarea id="metaDescription" name="metaDescription" class="materialize-textarea"
                                          data-length="160"><?php echo $metaDesc; ?></textarea>
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
