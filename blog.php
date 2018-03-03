<?php require_once('includes/header.php') ?>
  <div class="container">
    <div class="row">
      <h1>Latest posts</h1>
      <?php $i = 1; ?>

      <?php while($i <= 12) { ?>
        <div class="col s12 m6">
          <div class="card">
            <div class="card-image">
              <img src="http://via.placeholder.com/1920x1080">
              <span class="card-title">Card Title</span>
            </div>
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="post.php">Read more</a>
            </div>
          </div>
        </div>
      <?php $i++; } ?>
    </div>
  </div>
<?php require_once('includes/footer.php') ?>
