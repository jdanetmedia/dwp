<?php
require_once("../includes/connection.php");
// handle user creation
if (isset($_POST['submitusercreate'])) { // Form has been submitted.
  $errors = array();
  $message = "";
  $vali = true;
  if($_POST['firstName'] == "") {
    $message .= "You need to enter a first name. <br>";
    $vali = false;
  }
  if($_POST['lastName'] == "") {
    $message .= "You need to enter a last name. <br>";
    $vali = false;
  }
  if($_POST['adminemail'] == "") {
    $message .= "You need to enter an email. <br>";
    $vali = false;
  }
  if($_POST['password'] == "") {
    $message .= "You need to enter a password. <br>";
    $vali = false;
  }
  if($_POST['password2'] == "") {
    $message .= "You need to repeat your password. <br>";
    $vali = false;
  }

  // perform validations on the form data
  $password = trim(mysqli_real_escape_string($connection, $_POST['password']));
  $passwordvali = trim(mysqli_real_escape_string($connection, $_POST['password2']));
  if ($password == $passwordvali && $vali == true) {
    $firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($connection, $_POST['lastName']);
    $email = trim(mysqli_real_escape_string($connection, $_POST['adminemail']));
    $iterations = ['cost' => 10];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);

  $query = "INSERT INTO `User` (UserEmail, Password, FirstName, LastName) VALUES ('{$email}', '{$hashed_password}', '{$firstName}', '{$lastName}')";
  $result = mysqli_query($connection, $query);
    if ($result) {
      $message = "User Created.";
    } else {
      $message = "User could not be created.";
      //$message .= "<br />" . mysql_error();
    }
  } else {
    $message .= "The passwords has to be the same!";
  }
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
              <div class="determinate install2" style="width: 66%"></div>
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
