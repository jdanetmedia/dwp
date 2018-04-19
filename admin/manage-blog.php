<?php require_once("../admin/includes/header.php");
spl_autoload_register(function($class) {
    include "class/".$class.".php";
});
$blogPosts = new BlogPosts();
$allBlogPosts = $blogPosts->getAllBlogPosts();
?>
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">All Blog Posts</span>
                    <table class="responsive-table">
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
                                <td><?php echo $aBlogPost->Titel; ?></td>
                                <td><?php echo $aBlogPost->BlogContent; ?></td>
                                <td><?php echo $aBlogPost->CategoryName; ?></td>
                                <td><?php echo $aBlogPost->UserEmail; ?></td>
                                <td><a href="#">Edit</a></td>
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
