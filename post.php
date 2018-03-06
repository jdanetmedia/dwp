<?php require_once('includes/header.php') ?>
  <div class="container post-container">
      <nav class="breadcrumb-nav">
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="#!" class="breadcrumb">Bluck</a>
            <a href="#!" class="breadcrumb">Some category</a>
            <a href="#!" class="breadcrumb">Post title</a>
          </div>
        </div>
      </nav>
      <div class="row">
        <div class="col s12">
          <div class="card">
            <div class="card-image">
              <img src="http://via.placeholder.com/1920x1080">
              <span class="card-title">Post title</span>
            </div>
            <div class="card-content">
              <i>Posted on <b>18/2 2018</b> by <b>Jesper</b> in <b>Some category</b></i>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. lorem</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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
