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
$newestBlog = $blogPosts->getRecentBlogPost();

if(isset($_POST["saveBlogPost"])) {
    $blogPosts->saveBlogPost();
    if(isset($_POST["deleteImg"])) {
        $blogPosts->removeImg($_POST["deleteImg"]);
    }
    ?>
    <script type="text/javascript">location.href = 'manage-blog.php';</script>
    <?php
} elseif (isset($_POST["toGallery"])) {
    $blogPosts->saveBlogPost();
    $newestBlog = $blogPosts->getRecentBlogPost();
    ?>
    <script type="text/javascript">location.href = 'galleryBlog.php?ID=<?php foreach ($newestBlog as $aBlogPost) {
            echo $aBlogPost->BlogPostID;
        } ?>';</script>
    <?php
}
if (isset($_POST["saveBlogPostCategory"])) {
    $category->saveBlogPostCategory();
    $blogPosts->saveBlogPost();
    $newestBlog = $blogPosts->getRecentBlogPost();
    ?>
    <script type="text/javascript">location.href = 'edit-blog-post.php?ID=<?php foreach ($newestBlog as $aBlogPost) {
            echo $aBlogPost->BlogPostID;
        } ?>';</script>
    <?php
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
                                        <input id="blogPostTitle" name="blogPostTitle" type="text" class="validate" required="" aria-required="true">
                                        <label for="blogPostTitle">Blog Post Title</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m3">
                                        <select name="categoryID">
                                            <?php
                                            $allCategories = $blogPosts->getAllCategories();
                                            foreach($allCategories as $aCategory) {
                                                    ?>
                                                    <option value="<?php echo $aCategory->BlogCategoryID; ?>"><?php echo
                                                        $aCategory->CategoryName; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <label>Category</label>
                                    </div>
                                    <div class="input-field col s12 m3">
                                    <a class="waves-effect waves-light btn grey darken-4 btn modal-trigger" href="#modal1">Add new
                                        Category</a>
                                    </div>
                                    <!-- Modal Structure -->
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
                                                                                   name="categoryName" required="" aria-required="true">
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
                                    <div class="input-field col s12 m3">
                                        <p>Choose related products</p>
                                    </div>
                                    <div class="input-field col s12 m3">
                                        <select name="relatedProducts">
                                            <option value="0">None</option>
                                            <?php
                                            $cats = $category->getAllProductCategories();
                                            foreach ($cats as $cat) {
                                                    ?>
                                                    <option value="<?php echo $cat->ProductCategoryID; ?>"><?php echo
                                                        $cat->CategoryName;?></option>
                                                    <?php
                                            }
                                            ?>
                                        </select>
                                        <label>Product Category</label>
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
                    <div class="collapsible-header <?php if(isset($_GET["select"]) && $_GET["select"] == "images") { echo "active"; } ?>"><i class="material-icons">collections</i>Images</div>
                    <div class="collapsible-body">
                        <?php
                        if($blogPost[0]["ImgID"]) { ?>
                            <div class="save-message">
                                <p>Blog post must be saved for changes to take effect!</p>
                            </div>
                            <div class="row">
                                <?php foreach ($blogPost as $img): ?>
                                    <div class="col s6 m3 admin-product-img">
                                        <div class="save-delete">
                                            Save blog post to remove image
                                        </div>
                                        <img class="materialboxed responsive-img" width="650" src="<?php echo $img["URL"]; ?>">
                                        <?php
                                        echo '<a class="primary-label is-primary" href="#">Header image</a>';
                                        ?>
                                        <a id="<?php echo $img["ImgID"]; ?>" class="remove-img" href="#">Remove</a>
                                    </div>
                                <?php  endforeach; ?>
                                <input class="delete-image" type="hidden" name="deleteImg">
                            </div>
                        <?php }

                        ?>
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
