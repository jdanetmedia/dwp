<?php
class Admin {

  function __construct($connection)
  {
    // START FORM PROCESSING ON LOGIN CUSTOMER
  	if (isset($_POST['submitadminlogin'])) { // Form has been submitted.
  		$email = trim(mysqli_real_escape_string($connection, $_POST['email']));
  		$password = trim(mysqli_real_escape_string($connection,$_POST['pass']));

  		$query = "SELECT UserEmail, Password, FirstName FROM User WHERE UserEmail = '{$email}' LIMIT 1";
  		$result = mysqli_query($connection, $query);

  			if (mysqli_num_rows($result) == 1) {
  				// username/password authenticated
  				// and only 1 match
  				$found_user = mysqli_fetch_array($result);
                  if(password_verify($password, $found_user['Password'])){
  				    $_SESSION['UserEmail'] = $found_user['UserEmail'];
  				    $_SESSION['AdminFirstName'] = $found_user['FirstName'];
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
  }
}
?>
