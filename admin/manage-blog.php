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

$blogPosts = new BlogPosts();
$allCategories = $blogPosts->getAllCategories();
if(isset($_GET["search"])) {
    $allBlogPosts = $blogPosts->searchBlogPost($_GET["search"]);
    $searchString = $_GET["search"];
} else {
    $allBlogPosts = $blogPosts->getAllBlogPosts();
}
?>
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <form class="" action="" method="get">
                        <div class="input-field col s4 right">
                            <input id="search" type="text" name="search" <?php if(isset($searchString)) { echo "value='" . $searchString . "'"; }
                            ?>>
                            <label for="search">Search products</label>
                        </div>
                        <div class="col s2 right">
                            <input class="waves-effect waves-light btn grey darken-4 new-prod-btn" type="submit" name="submit" value="Search">
                        </div>
                    </form>
                    <span class="card-title">All Blog Posts<a class="waves-effect waves-light btn grey darken-4 new-prod-btn" href="new-blog-post.php">Add new</a></span>
                    <table class="responsive-table striped">
                        <thead>
                        <tr>
                            <th>Post date</th>
                            <th>Title</th>
                            <th>Blog content</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <?php // TODO: Ændre farve på select felter ?>
                        <tbody>
                        <?php
                        foreach ($allBlogPosts as $aBlogPost) {
                            ?>
                            <tr>
                                <td><?php echo $aBlogPost->BlogDate; ?></td>
                                <td><?php echo $aBlogPost->Title; ?></td>
                                <td><?php if (strlen($aBlogPost->BlogContent) > 100) {
                                        echo preg_replace('/\s+?(\S+)?$/', '', filter_var(substr
                                            ($aBlogPost->BlogContent, 0, 100), FILTER_SANITIZE_STRING)) . " ...";
                                    } else echo $aBlogPost->BlogContent; ?></td>
                                <td><?php echo $aBlogPost->CategoryName; ?></td>
                                <td><?php echo $aBlogPost->UserEmail; ?></td>
                                <td><a href="edit-blog-post.php?ID=<?php echo $aBlogPost->BlogPostID; ?>">Edit</a></td>
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
<?php require_once("../admin/includes/footer.php"); ?>
