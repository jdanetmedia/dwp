<?php
	// START FORM PROCESSING ON LOGIN CUSTOMER
	if (isset($_POST['submitlogin'])) { // Form has been submitted.
		$email = trim(mysqli_real_escape_string($connection, $_POST['email']));
		$password = trim(mysqli_real_escape_string($connection,$_POST['pass']));

		$query = "SELECT CustomerEmail, Password, FirstName FROM Customer WHERE CustomerEmail = '{$email}' LIMIT 1";
		$result = mysqli_query($connection, $query);

			if (mysqli_num_rows($result) == 1) {
				// username/password authenticated
				// and only 1 match
				$found_user = mysqli_fetch_array($result);
                if(password_verify($password, $found_user['Password'])){
				    $_SESSION['CustomerEmail'] = $found_user['CustomerEmail'];
				    $_SESSION['FirstName'] = $found_user['FirstName'];
				    redirect_to("../index.php");
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

	// START FORM PROCESSING ON CREATE CUSTOMER

	// TODO: Validate more input, and insert all data to DB, and check if input fields are set.
	if (isset($_POST['submitcreateuser'])) { // Form has been submitted.
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
		if($_POST['CustomerEmail'] == "") {
			$message .= "You need to enter an email. <br>";
			$vali = false;
		}
		if($_POST['pass'] == "") {
			$message .= "You need to enter a password. <br>";
			$vali = false;
		}
		if($_POST['passvali'] == "") {
			$message .= "You need to repeat your password. <br>";
			$vali = false;
		}

		// perform validations on the form data
		$password = trim(mysqli_real_escape_string($connection, $_POST['pass']));
		$passwordvali = trim(mysqli_real_escape_string($connection, $_POST['passvali']));
		if ($password == $passwordvali && $vali == true) {
			$firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
			$lastName = mysqli_real_escape_string($connection, $_POST['lastName']);
			$email = trim(mysqli_real_escape_string($connection, $_POST['CustomerEmail']));
	    $iterations = ['cost' => 10];
	    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);

		$query = "INSERT INTO `Customer` (CustomerEmail, Password, Street, HouseNumber, Phone, FirstName, LastName, ZipCode) VALUES ('{$email}', '{$hashed_password}', NULL, NULL, NULL, '{$firstName}', '{$lastName}', NULL)";
		$result = mysqli_query($connection, $query);
			if ($result) {
				$message = "User Created.";
				redirect_to("login.php");
			} else {
				$message = "User could not be created.";
				//$message .= "<br />" . mysql_error();
			}
		} else {
			$message .= "The passwords has to be the same!";
		}
	}

?>
