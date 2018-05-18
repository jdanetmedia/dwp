<?php require_once ('../model/contactDAO.php');
$pageInfo = getPageInfo();
$hours = getHours();
?>

<footer class="page-footer teal">
      <div class="container">
        <div class="row">
          <div class="col s12 m4">
            <h5 class="white-text"><?php echo $pageInfo["ShopName"];?> </h5>
            <p class="grey-text text-lighten-4">
                <?php echo $pageInfo["Street"] . " " . $pageInfo["HouseNumber"] . ", " . $pageInfo["ZipCode"] . " " . $pageInfo["City"]; ?>
            </p>
              <p>
                Phone: <?php echo $pageInfo["Phone"] ?>
                <br>
                <?php echo $pageInfo["Email"] ?>
                <br>
                CVR: <?php echo $pageInfo["Phone"] ?></p>
          </div>
          <div class="col s12 m3 offset-m2">
            <h5 class="white-text">Hours</h5>
            <ul>
              <?php
              while ($row = mysqli_fetch_array($hours)) {
              ?>
              <li><?php echo $row["Day"] . "<br>" . $row["Open"] . "-" . $row["Close"]; ?></li>
              <?php
              }
              ?>
            </ul>
          </div>
          <div class="col s12 m3">
            <img class="responsive-img" src="../<?php echo $pageInfo["LogoURL"]; ?>">
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
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/custom.js"></script>
  </body>
</html>
