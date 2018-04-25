<?php require_once("../admin/includes/header.php");
spl_autoload_register(function($class) {
    include "class/".$class.".php";
});
$blogPosts = new BlogPosts();
$blogPost = $blogPosts->getBlogPostDetails($_GET["ID"]);
?>

<div class="container">
    <form action="edit-blog-post.php?ID=<?php echo $_GET["ID"]; ?>" method="post" enctype="multipart/form-data">
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
                                        <input id="blogPostTitle" type="text" class="validate" name="blogPostTitle" value="<?php echo $blogPost[0]["Title"]; ?>">
                                        <label for="blogPostTitle">Blog Post Title</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s4">
                                        <select>
                                            <option value="0" selected>Category</option>
                                            <?php
                                            $cats = $blogPosts->getAllCategories();
                                            foreach ($cats as $cat) {
                                                if($blogPost[0]["BlogCategoryID"] == $cat->BlogCategoryID) {
                                                    ?>
                                                    <option value="<?php echo $cat->BlogCategoryID; ?>" selected><?php echo $cat->CategoryName; ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo $cat->BlogCategoryID; ?>"><?php echo $cat->CategoryName; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <a class="waves-effect waves-light btn grey darken-4 new-prod-btn" href="#">Add new Category</a>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <p>Blog Post Content</p>
                                        <textarea id="blogPostContent" class="content" name="blogPostContent"><?php
                                            if(isset($blogPost[0]["BlogContent"])) {
                                                echo $blogPost[0]["BlogContent"];
                                            }
                                            ?></textarea>
                                    </div>
                                </div>
                            </form>
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
                                <?php
                                if(isset($blogPost[0]["SeoTitle"])) {
                                    $titleTag = $blogPost[0]["SeoTitle"];
                                } else {
                                    $titleTag = "";
                                }
                                ?>
                                <input id="seoTitle" type="text" class="validate" data-length="68" value="<?php echo $titleTag; ?>">
                                <label for="seoTitle">Page title (Max 68 characters)</label>
                            </div>
                            <div class="input-field col s12">
                                <?php
                                if(isset($blogPost[0]["MetaDescription"])) {
                                    $metaDesc = $blogPost[0]["MetaDescription"];
                                } else {
                                    $metaDesc = "";
                                }
                                ?>
                                <textarea id="metaDescription" class="materialize-textarea" data-length="160"><?php echo $metaDesc; ?></textarea>
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