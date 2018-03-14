<?php require_once('includes/header.php');
require_once("includes/blogDAO.php");
require_once("includes/productDAO.php");
$post = $_GET["post"];
$postData = getPost($post);
$related = getRelatedProducts($postData["RelatedProducts"]);
?>
  <div class="container post-container">
      <nav class="breadcrumb-nav">
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="#!" class="breadcrumb">Bluck</a>
            <a href="#!" class="breadcrumb">Some category</a>
            <a href="#!" class="breadcrumb"><?php echo $postData["Titel"]; ?></a>
          </div>
        </div>
      </nav>
      <div class="row">
        <div class="col s12">
          <div class="card">
            <div class="card-image">
              <img src="http://via.placeholder.com/1920x1080">
              <span class="card-title"><?php echo $postData["Titel"]; ?></span>
            </div>
            <div class="card-content">
              <i>Posted on <b><?php echo $postData["BlogDate"]; ?></b> by <b>Jesper</b> in <b>Some category</b></i>
              <p><?php echo $postData["BlogContent"]; ?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <?php if(isset($postData["RelatedProducts"])) { ?>
          <div class="carousel product-slider">
      			<h4>Related producks!</h4>
            <?php
              while($row = mysqli_fetch_array($related)) {
                ?>
                  <a class='carousel-item' href='product.php?item=<?php echo $row["ItemNumber"]; ?>'>
                      <div class='card'>
                        <div class='card-image'>
                          <img src='http://via.placeholder.com/400x400'>
                          <span class='card-title'><?php echo $row["ProductName"]; ?></span>
                        </div>
                        <div class='card-action'>
                          <p class='price'>$<?php echo $row["Price"]; ?></p>
                          <div class='stars right'>
                            <i class='material-icons tiny rated'>star</i>
                            <i class='material-icons tiny rated'>star</i>
                            <i class='material-icons tiny rated'>star</i>
                            <i class='material-icons tiny rated'>star</i>
                            <i class='material-icons tiny'>star_border</i>
                          </div>
                        </div>
                      </div>
                  </a>
                <?php
              }
            ?>
          </div>
        <?php } ?>
        <h4>Related Bluckposts!</h4>
        <?php
          $blogResult = getAllPosts();
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
