<?php
class Admin extends Security {

  function __construct($connection)
  {
    // START FORM PROCESSING ON LOGIN CUSTOMER
  	if (isset($_POST['submitadminlogin'])) { // Form has been submitted.
  		$email = trim(mysqli_real_escape_string($connection, $_POST['email']));
  		$password = trim(mysqli_real_escape_string($connection,$_POST['pass']));

  		$query = "SELECT UserEmail, Password, FirstName, AccessLevel FROM User WHERE UserEmail = '{$email}' LIMIT 1";
  		$result = mysqli_query($connection, $query);

  			if (mysqli_num_rows($result) == 1) {
  				// username/password authenticated
  				// and only 1 match
  				$found_user = mysqli_fetch_array($result);
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

    if (isset($_GET["update"])) {
      $this->updateUserInfo($_GET["update"]);
    }

    if (isset($_GET["updatepass"])) {
      $this->updateUserPass($_GET["updatepass"]);
    }

    if (isset($_GET["newuser"])) {
      $this->createNewUser();
    }

    if (isset($_GET["remove"])) {
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
        $conn = connectToDB();

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
            $conn = connectToDB();

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
        $conn = connectToDB();

        $handle = $conn->prepare("SELECT * FROM User WHERE NOT AccessLevel = 1");
        $handle->execute();

        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
        $conn = null;
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
        $conn = null;
        return $result;
    }
    catch(\PDOException $ex) {
        return print($ex->getMessage());
    }
  }

  function updateUserInfo($useremail) {
    $firstname = Security::secureString($_POST["firstname"]);
    $lastname = Security::secureString($_POST["lastname"]);
    $newmail = Security::secureString($_POST["email"]);
    if (isset($_POST["firstname"])) {
      try {
          $conn = DB::connect();

          $handle = $conn->prepare("UPDATE User SET FirstName = :firstname, LastName = :lastname, UserEmail = :newmail WHERE UserEmail = :useremail");
          $handle->bindParam(':useremail', $useremail);
          $handle->bindParam(':firstname', $firstname);
          $handle->bindParam(':lastname', $lastname);
          $handle->bindParam(':newmail', $newmail);
          $handle->execute();

          $conn = null;
      }
      catch(\PDOException $ex) {
          return print($ex->getMessage());
      }
    }
  }

  function updateUserPass($useremail) {
    echo "Update user password";
  }

  function createNewUser() {
    echo "Create a new user";
  }

  function deleteUser($useremail) {
    echo "Delete this one: " . $useremail;
  }
}
?>
