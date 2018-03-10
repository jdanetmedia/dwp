<?php require_once('includes/header.php');
require_once("includes/blogDAO.php");
$post = $_GET["post"];
$postData = getPost($post);
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
      <div class="carousel product-slider">
  			<h4>Related producks!</h4>
  			<?php
  			function output() {
  			echo "
  			<a class='carousel-item' href='product.php'>
  			    <div class='card'>
  			      <div class='card-image'>
  			        <img src='http://via.placeholder.com/400x400'>
  			        <span class='card-title'>Card Title</span>
  			      </div>
  			      <div class='card-action'>
  			        <p class='price'>$99.95</p>
  			      </div>
  			    </div>
  			</a>
  			";
  			}

  			$i = 1;
  			while ($i <= 7) {
  			output();
  			$i++;
  			}
  			?>
      </div>
  </div>
<?php require_once('includes/footer.php') ?>
