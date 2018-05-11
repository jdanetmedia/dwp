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
$blogPosts = new BlogPosts();
if(isset($_POST["saveBlogPost"])) {
    $blogPosts->saveBlogPost();
    ?>
    <script type="text/javascript">location.href = 'manage-blog.php';</script>
    <?php
} elseif (isset($_POST["toGallery"])) {
    $blogPosts->saveBlogPost();
    ?>
    <script type="text/javascript">location.href = 'gallery.php?item=<?php echo $_POST["ID"]; ?>';</script>
    <?php
}
if (isset($_POST["saveBlogPostCategory"])) {
    $category->saveBlogPostCategory();
}
?>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <input class="waves-effect waves-light btn grey darken-4 right new-prod-btn" type="submit" name="saveBlogPost" value="Save">
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
                                        <input id="blogPostTitle" name="blogPostTitle" type="text" class="validate">
                                        <label for="blogPostTitle">Blog Post Title</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s4">
                                        <select name="categoryID">
                                            <?php
                                            $allCategories = $blogPosts->getAllCategories();
                                            foreach($allCategories as $aCategory) {
                                                if (isset($_POST["saveBlogPostCategory"])) {
                                                    ?>
                                                    <option value="<?php echo $aCategory->BlogCategoryID; ?>"
                                                            selected><?php echo
                                                        $aCategory->CategoryName; ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo $aCategory->BlogCategoryID; ?>"><?php echo
                                                        $aCategory->CategoryName; ?></option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <label>Category</label>
                                    </div>
                                    <a class="waves-effect waves-light btn grey darken-4 new-prod-btn modal-trigger" href="#modal1">Add new
                                        Category</a>
                                    <div id="modal1" class="modal">
                                        <div class="modal-content">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <h4 class="left">New Blog Post Category</h4>
                                                <div class="row">
                                                    <input class="waves-effect waves-light btn grey darken-4 right new-prod-btn"
                                                           type="submit"
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
                                                            <div class="collapsible-header"><i
                                                                        class="material-icons">trending_up</i>SEO</div>
                                                            <div class="collapsible-body">
                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <input id="seoTitleCategory" name="seoTitleCategory" type="text"
                                                                               class="validate"
                                                                               data-length="68">
                                                                        <label for="seoTitle">Page title (Max 68 characters)</label>
                                                                    </div>
                                                                    <div class="input-field col s12">
                                                        <textarea id="metaDescriptionCategory" name="metaDescriptionCategory"
                                                                  class="materialize-textarea"
                                                                  data-length="160"></textarea>
                                                                        <label for="metaDescription">Meta Description (Max 160 characters)
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <p>Blog Post Content</p>
                                        <textarea id="blogPostContent" class="content" name="blogPostContent"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">collections</i>Images</div>
                    <div class="collapsible-body">
                        <input class="waves-effect waves-light btn grey darken-4" type="submit" name="toGallery" value="Add image">
                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">trending_up</i>SEO</div>
                    <div class="collapsible-body">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="seoTitle" name="seoTitle" type="text" class="validate" data-length="68">
                                <label for="seoTitle">Page title (Max 68 characters)</label>
                            </div>
                            <div class="input-field col s12">
                                <textarea id="metaDescription" name="metaDescription" class="materialize-textarea"
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
<?php require_once("../admin/includes/footer.php"); ?>
