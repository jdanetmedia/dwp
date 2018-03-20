<?php require_once ('contactDAO.php');
$pageInfo = getPageInfo();

?>

<footer class="page-footer teal">
      <div class="container">
        <div class="row">
          <div class="col s12 m4">
            <h5 class="white-text"><?php echo $pageInfo["ShopName"];?> </h5>
            <p class="grey-text text-lighten-4">
                <?php echo $pageInfo["Street"] . " " . $pageInfo["HouseNumber"] . ", " . $pageInfo["ZipCode"] . " " . $pageInfo["City"]; ?>
            </p>
              <p><?php echo $pageInfo["Phone"] ?></p>
              <p><?php echo $pageInfo["Email"] ?></p>
          </div>
          <div class="col s12 m3 offset-m2">
            <h5 class="white-text">Links</h5>
            <ul>
              <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
              <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
              <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
              <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
            </ul>
          </div>
          <div class="col s12 m3">
            <h5 class="white-text">Links</h5>
            <ul>
              <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
              <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
              <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
              <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container">
          <p class="center">&copy; 2018 Copyright Text</p>
        </div>
      </div>
    </footer>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
  </body>
</html>
