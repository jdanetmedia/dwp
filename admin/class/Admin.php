<?php
class Admin extends Security {

  function __construct()
  {
    // START FORM PROCESSING ON LOGIN CUSTOMER
  	if (isset($_POST['submitadminlogin'])) { // Form has been submitted.
      try {
          $conn = DB::connect();

          $email = $_POST['email'];
          $password = $_POST['pass'];

          $statement = "SELECT UserEmail, Password, FirstName, AccessLevel FROM User WHERE UserEmail = :email LIMIT 1";

          $handle = $conn->prepare($statement);
          $handle->bindParam(':email', $email);
          $handle->execute();
          $result = $handle->fetchAll( \PDO::FETCH_ASSOC );

          if (count($result) == 1) {
    				// username/password authenticated
    				// and only 1 match
    				$found_user = $result[0];
                    if(password_verify($password, $found_user['Password'])){
    				    $_SESSION['UserEmail'] = $found_user['UserEmail'];
    				    $_SESSION['AdminFirstName'] = $found_user['FirstName'];
                $_SESSION['AccessLevel'] = $found_user['AccessLevel'];
    				    redirect_to("index.php");
    			} else {
    				// username/password combo was not found in the database
    				$message = "Username/password combination incorrect.<br />
    					Please make sure your caps lock key is off and try again.";
    			}}

      }
      catch(\PDOException $ex) {
          print($ex->getMessage());
      }
  	} else { // Form has not been submitted.
  		if (isset($_GET['logout']) && $_GET['logout'] == 1) {
  			$message = "You are now logged out.";
  		}
  	}

    if (isset($_POST["submitadminforgot"])) {
      $this->sendemaillink($_POST["forgotemail"]);
    }

    if (isset($_POST["submitadminnewpass"])) {
      $this->newpass();
    }

    if (isset($_POST["submitupdateinfo"])) {
      $this->updateUserInfo($_SESSION["UserEmail"]);
    }

    if (isset($_POST["submitupdatepass"])) {
      $this->updateUserPass($_SESSION["UserEmail"]);
    }

    if (isset($_POST["submitnewuser"])) {
      $this->createNewUser();
    }

    if (isset($_POST["submitdeleteuser"])) {
      $this->deleteUser($_GET["remove"]);
    }
  }

  function sendemaillink($email) {
    $subject = "Email from online mail form";

    function error($error)
    {
        echo "Error processing your form input<br><br>";
        echo "<b>The errors are:</b><br> ";
        echo $error . "<br>";
        die();
    }

    //Validation of null fields
    if (!isset($_POST["forgotemail"])) {
        error("No input to validate!");
    }
    $email = $_POST["forgotemail"];
    $randomkey = substr(md5(rand()), 0, 20);

    try {
        $conn = DB::connect();

        // Secure inputs
        $secKey = Security::secureString($randomkey);
        $secEmail = Security::secureString($email);

        $statement = "UPDATE User SET ResetKey = :randomkey WHERE UserEmail = :email";

        $handle = $conn->prepare($statement);
        $handle->bindParam(':randomkey', $secKey);
        $handle->bindParam(':email', $secEmail);
        $handle->execute();
    }
    catch(\PDOException $ex) {
        print($ex->getMessage());
    }

    $domain = $_SERVER['HTTP_HOST'];
    $resetmessage = "Reset password: <$domain/admin/adminnewpass.php?admin=$email&key=$randomkey>";
    //echo $email;
    $error_message = "";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message .= "The email is not OK!<br>";
    }

    $email_message = "Reset password:\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Email: " . clean_string($email) . "\n\n";
    $email_message .= "Message: " . $resetmessage . "\n";

    $headers = "FROM: " . $email . "\r\n" . "Reply-To: " . $email . "\r\n" . "X-Mailer: PHP/" . phpversion();

    mail($email, $subject, $email_message, $headers);
  }

  function newpass() {
    if (isset($_GET["admin"]) && isset($_GET["key"])) {
      $errors = array();
      $message = "";
      $vali = true;

      if($_POST['pass'] == "") {
        $message .= "You need to enter a password. <br>";
        $vali = false;
      }
      if($_POST['pass2'] == "") {
        $message .= "You need to repeat your password. <br>";
        $vali = false;
      }

      // perform validations on the form data
      $password = trim($_POST['pass']);
      $password2 = trim($_POST['pass2']);
      if ($password == $password2 && $vali == true) {
        $iterations = ['cost' => 10];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);

        $email = $_GET["admin"];
        $reset = $_GET["key"];

        try {
            $conn = DB::connect();

            $statement = "UPDATE User SET Password = :password, ResetKey = NULL WHERE UserEmail = :email AND ResetKey = :resetkey";
            $handle = $conn->prepare($statement);
            $handle->bindParam(':password', $hashed_password);
            $handle->bindParam(':email', $email);
            $handle->bindParam(':resetkey', $reset);
            $handle->execute();
        }
        catch(\PDOException $ex) {
            print($ex->getMessage());
        }
      }
    }
  }

  function GetAllUsers() {
    try {
        $conn = DB::connect();

        $handle = $conn->prepare("SELECT * FROM User WHERE NOT AccessLevel = 1");
        $handle->execute();

        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
        DB::close();
        return $result;
    }
    catch(\PDOException $ex) {
        return print($ex->getMessage());
    }
  }

  function GetUserInfo($email) {
    try {
        $conn = DB::connect();

        $email = Security::secureString($email);

        $handle = $conn->prepare("SELECT * FROM User WHERE UserEmail = :UserEmail LIMIT 1");
        $handle->bindParam(':UserEmail', $email);
        $handle->execute();

        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
        DB::close();
        return $result;
    }
    catch(\PDOException $ex) {
        return print($ex->getMessage());
    }
  }

  function updateUserInfo($useremail) {
    echo "SOME FUCKING BULLS**T!";
    $firstname = Security::secureString($_POST["firstname"]);
    $lastname = Security::secureString($_POST["lastname"]);
    $newmail = Security::secureString($_POST["email"]);
    if (isset($_POST["firstname"])) {
      try {
          $conn = DB::connect();

          $handle = $conn->prepare("UPDATE User SET User.FirstName = :firstname, User.LastName = :lastname, User.UserEmail = :newmail WHERE User.UserEmail = :useremail");
          $handle->bindParam(':useremail', $useremail);
          $handle->bindParam(':firstname', $firstname);
          $handle->bindParam(':lastname', $lastname);
          $handle->bindParam(':newmail', $newmail);
          $handle->execute();
      }
      catch(\PDOException $ex) {
          return print($ex->getMessage());
      }
    }
  }

  function updateUserPass($useremail) {
    $message = "";
    $vali = true;
    if($_POST['newpass'] == "") {
      $message .= "You need to enter a password. <br>";
      $vali = false;
    }
    if($_POST['repeatnewpass'] == "") {
      $message .= "You need to repeat your password. <br>";
      $vali = false;
    }
    try {
      $conn = DB::connect();
      // perform validations on the form data
      $password = Security::secureString($_POST['newpass']);
      $password2 = Security::secureString($_POST['repeatnewpass']);
      $oldpassword = Security::secureString($_POST['oldpass']);
      $statement = "SELECT Password FROM User WHERE UserEmail = :email LIMIT 1";
  		$handle = $conn->prepare($statement);
  		$handle->bindParam(':email', $useremail);
  		$handle->execute();
  		$result = $handle->fetchAll( \PDO::FETCH_ASSOC );
  		if(password_verify($oldpassword, $result[0]["Password"])) {
        if ($password == $password2 && $vali == true) {
          $iterations = ['cost' => 10];
          $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);
          $statement1 = "UPDATE User SET User.Password = :password WHERE UserEmail = :email";
          $handle = $conn->prepare($statement1);
          $handle->bindParam(':password', $hashed_password);
          $handle->bindParam(':email', $useremail);
          $handle->execute();
        }
      }
    }
    catch(\PDOException $ex) {
        print($ex->getMessage());
    }
  }

  function createNewUser() {

    $message = "";
    $vali = true;
    if($_POST['newname'] == "") {
      $message .= "You need to enter a first name. <br>";
      $vali = false;
    }
    if($_POST['newlname'] == "") {
      $message .= "You need to enter a last name. <br>";
      $vali = false;
    }
    if($_POST['newmail'] == "") {
      $message .= "You need to enter an email. <br>";
      $vali = false;
    }
    if($_POST['newpass'] == "") {
      $message .= "You need to enter a password. <br>";
      $vali = false;
    }
    if($_POST['newrpass'] == "") {
      $message .= "You need to repeat your password. <br>";
      $vali = false;
    }

    $newname = Security::secureString($_POST["newname"]);
    $newlname = Security::secureString($_POST["newlname"]);
    $newmail = Security::secureString($_POST["newmail"]);
    $newpass = Security::secureString($_POST["newpass"]);
    $newrpass = Security::secureString($_POST["newrpass"]);

		// perform validations on the form data
		if ($newpass == $newrpass && $vali == true) {
	    $iterations = ['cost' => 10];
	    $hashed_password = password_hash($newpass, PASSWORD_BCRYPT, $iterations);
      try {
          $conn = DB::connect();

          $handle = $conn->prepare("INSERT INTO User (UserEmail, Password, FirstName, LastName, ResetKey, AccessLevel) VALUES (:mail, :password, :firstname, :lastname, NULL, 0)");
          $handle->bindParam(':mail', $newmail);
          $handle->bindParam(':password', $hashed_password);
          $handle->bindParam(':firstname', $newname);
          $handle->bindParam(':lastname', $newlname);
          $handle->execute();

          DB::close();
      }
      catch(\PDOException $ex) {
          return print($ex->getMessage());
      }
		} else {
			$message .= "The passwords has to be the same!";
		}
  }

  function deleteUser($useremail) {
    try {
        $conn = DB::connect();

        $handle = $conn->prepare("DELETE FROM User WHERE User.UserEmail = :mail");
        $handle->bindParam(':mail', $useremail);
        $handle->execute();

        DB::close();
    }
    catch(\PDOException $ex) {
        return print($ex->getMessage());
    }
  }
}
?>
