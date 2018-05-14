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
              <div class="determinate install3" style="width: 66%"></div>
            </div>
            <div class="card medium">
              <div class="card-content">
                <?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
                <h5>Done!</h5>
                <p>What do you want to do now?</p>
                <div class="card-action">
                  <a class="btn waves-effect waves-light left" href="../admin/index.php">Go to admin area</a>
                  <a class="btn waves-effect waves-light right" href="../index.php">Visit frontpage</a>
                </div>
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
