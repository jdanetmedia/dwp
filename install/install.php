<?php
if (!file_exists('../includes/constants.php')) {
  ?>
<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="../css/custom/custom.css" />
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
      <div class="container">
        <div class="row">
          <div class="col s12 m6 push-m3">
            <div class="progress">
              <div class="determinate" style="width: 0%"></div>
            </div>
            <div class="card medium">
              <div class="card-content">
                <h5>Database information</h5>
                <form class="col s12" action="dbcreation.php" method="post">
                  <div class="row">
                    <div class="input-field col s6">
                      <input value="mysql5.unoeuro.com" name="server" id="server" type="text" class="validate">
                      <label for="server">SERVER</label>
                    </div>
                    <div class="input-field col s6">
                      <input value="rasmusandre_dk" name="username" id="username" type="text" class="validate">
                      <label for="username">Username</label>
                    </div>
                    <div class="input-field col s6">
                      <input name="password" id="password" type="text" class="validate">
                      <label for="password">Password</label>
                    </div>
                    <div class="input-field col s6">
                      <input value="rasmusandreas_dk_db3" name="dbname" id="dbname" type="text" class="validate">
                      <label for="dbname">Database name</label>
                    </div>
                    <div class="card-action">
                      <button class="btn waves-effect waves-light right" name="submitdbinfo" type="submit" name="action">Next
                        <i class="material-icons right">send</i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript" src="../js/custom.js"></script>
    </body>
  </html>
  <?php
} else {
  echo "File exists!";
}
?>
