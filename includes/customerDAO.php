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

	// START FORM PROCESSING ON CREATE CUSTOMER

	// TODO: Validate more input, and insert all data to DB, and check if input fields are set.
	if (isset($_POST['submitcreateuser'])) { // Form has been submitted.
		$errors = array();

		// perform validations on the form data
		$email = trim(mysqli_real_escape_string($connection, $_POST['CustomerEmail']));
		$password = trim(mysqli_real_escape_string($connection, $_POST['pass']));
	    $iterations = ['cost' => 10];
	    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);

		$query = "INSERT INTO `Customer` (CustomerEmail, Password, Street, HouseNumber, Phone, FirstName, LastName, ZipCode) VALUES ('{$email}', '{$hashed_password}', 'SomeRandomStreet', '191', 11223344, 'Jesper', 'Dalsgaard', 6700)";
		$result = mysqli_query($connection, $query);
			if ($result) {
				$message = "User Created.";
				redirect_to("login.php");
			} else {
				$message = "User could not be created.";
				//$message .= "<br />" . mysql_error();
			}
	}

?>
