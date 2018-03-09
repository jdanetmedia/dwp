<?php require_once('includes/header.php');
require_once("includes/blogDAO.php");
?>
  <div class="container">
    <div class="row">
      <h1>Latest Quackposts</h1>
      <?php
      $blogResult = getPosts();
      while($row = mysqli_fetch_array($blogResult)) {
        ?>
        <div class="col s12 m6">
          <div class="card">
            <div class="card-image">
              <img src="http://via.placeholder.com/1920x1080">
              <span class="card-title"><?php echo $row["Titel"]; ?></span>
            </div>
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="post.php?post=<?php echo $row["BlogPostID"] ?>">Read more</a>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
<?php require_once('includes/footer.php') ?>
