<?php require_once("../includes/header.php");
if (!empty($message)) {echo "<p>" . $message . "</p>";}
?>
<div class="container">
  <div class="row">
    <div class="col s12 m10 push-m1">
      <div class="card large">
        <div class="card-content">
          <span class="card-title">Create Customer</span>
          <form class="col s12 m12" action="" method="post">
            <div class="row">
              <div class="input-field col s6">
                <input id="first_name" name="firstName" type="text" class="validate" value="<?php if(isset($_POST['firstName'])) { echo $_POST['firstName']; } ?>">
                <label for="first_name">First Name</label>
              </div>
              <div class="input-field col s6">
                <input id="last_name" name="lastName" type="text" class="validate" value="<?php if(isset($_POST['firstName'])) { echo $_POST['lastName']; } ?>">
                <label for="last_name">Last Name</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="email" type="email" name="CustomerEmail" maxlength="100" class="validate" value="<?php if(isset($_POST['firstName'])) { echo $_POST['CustomerEmail']; } ?>">
                <label for="first_name">Email</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6">
                <input id="password" type="password" name="pass" maxlength="30" class="validate">
                <label for="password">Password</label>
              </div>
              <div class="input-field col s12 m6">
                <input id="password2" type="password" name="passvali" class="validate">
                <label for="password">Repeat password</label>
              </div>
            </div>
            <input class="waves-effect waves-light btn" type="submit" name="submitcreateuser" value="Create">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($connection)){mysqli_close($connection);}
?>
<?php require_once("../includes/footer.php");
