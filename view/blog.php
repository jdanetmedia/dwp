<?php
require_once("../includes/sessionstart.php");
require_once('../includes/header.php');
require_once("../model/blogDAO.php");
?>
<script type="text/javascript">
  if(window.location.href.indexOf("?") > -1) {
  } else {
  window.location.search += '?';
  }
</script>
  <div class="container">
    <div class="row">
      <h1 class="left">Latest Quackposts</h1>
      <div class="input-field col s12 m3 right">
        <select onchange="val()" id="select_id">
          <option value="0" selected>All Categories</option>
          <?php
          $categories = getBlogCategories();
          while ($row = mysqli_fetch_array($categories)) {
            if ($_GET["cat"] == $row["BlogCategoryID"]) {
              ?>
              <option selected value='<?php echo $row["BlogCategoryID"] ?>'><?php echo $row["CategoryName"]; ?></option>
              <?php
            } else {
          ?>
          <option value='<?php echo $row["BlogCategoryID"] ?>'><?php echo $row["CategoryName"]; ?></option>
          <?php
            }
          }
          ?>
        </select>
        <script>
          function val() {
            var selected = document.getElementById("select_id").value;
            href = window.location.href;
            if(!~href.indexOf('cat'))
                window.location.href = href + 'cat=' + selected;
            else
                // Regular expression searches for cat=, one or more numbers, and one character
                window.location.href = href.replace(/(cat=)\d+/, '$1' + selected);
          }
        </script>
      </div>
    </div>
    <div class="row">
      <?php
      $blogResult = getAllPosts();
      while($row = mysqli_fetch_array($blogResult)) {
        ?>
        <div class="col s12 m6">
          <div class="card">
            <div class="card-image">
              <img src="http://via.placeholder.com/1920x1080">
              <span class="card-title"><?php echo $row["Title"]; ?></span>
            </div>
            <div class="card-content">
              <p><?php if (strlen($row["BlogContent"]) > 160) {
                      echo preg_replace('/\s+?(\S+)?$/', '', substr
                          ($row["BlogContent"], 0, 160)) . " ...";
                  } else echo $row["BlogContent"]; ?></p>
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
    <?php
    if(isset($catResult)) {
      while ($row = mysqli_fetch_array($catResult)) {
    ?>
    <div class="row">
      <div class="col s12 m12">
        <h3><?php echo $row["CategoryName"]; ?></h3>
        <p><?php echo $row["Description"]; ?></p>
      </div>
    </div>
    <?php
      }
    }
    ?>
  </div>
<?php require_once('../includes/footer.php') ?>
