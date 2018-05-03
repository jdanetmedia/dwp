<?php require_once("../admin/includes/header.php");
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
$allBlogPosts = $blogPosts->getAllBlogPosts();
$allCategories = $blogPosts->getAllCategories();
?>
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">All Blog Posts<a class="waves-effect waves-light btn grey darken-4 new-prod-btn" href="new-blogpost.php">Add new</a></span>
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
                                        echo preg_replace('/\s+?(\S+)?$/', '', substr
                                            ($aBlogPost->BlogContent, 0, 100)) . " ...";
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
