<?php


try {
    $conn = DB::connect();

    $statement = "SELECT UserEmail FROM User";

    $handle = $conn->prepare($statement);
    $handle->execute();

    $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
    if(count($result) > 1) {
      header('Location: ../index.php');
      die;
    }
}
catch(\PDOException $ex) {
    print($ex->getMessage());
}
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
              <div class="determinate install1" style="width: 0%"></div>
            </div>
            <div class="card medium">
              <div class="card-content">
                <h5>User information</h5>
                <form class="col s12" action="finishup.php" method="post">
                  <div class="row">
                    <div class="input-field col s6">
                      <input value="" name="firstName" id="server" type="text" class="validate">
                      <label for="server">First name</label>
                    </div>
                    <div class="input-field col s6">
                      <input value="" name="lastName" id="username" type="text" class="validate">
                      <label for="username">Last name</label>
                    </div>
                    <div class="input-field col s6">
                      <input value="" name="adminemail" id="server" type="text" class="validate">
                      <label for="server">Email</label>
                    </div>
                    <div class="input-field col s6">
                      <input value="" name="password" id="username" type="text" class="validate">
                      <label for="username">Password</label>
                    </div>
                    <div class="input-field col s6">
                      <input value="" name="password2" id="password" type="text" class="validate">
                      <label for="password">Repeat Password</label>
                    </div>
                    <div class="card-action">
                      <button class="btn waves-effect waves-light right" name="submitusercreate" type="submit" name="action">Next
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
