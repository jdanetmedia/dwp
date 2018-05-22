<?php
	// START FORM PROCESSING ON LOGIN CUSTOMER
	if (isset($_POST['submitlogin'])) { // Form has been submitted.
		$email = Security::secureString($_POST['email']);
		$password = Security::secureString($_POST['pass']);
		try {
				$conn = DB::connect();

				$cat = Security::secureString($_GET["cat"]);

				$query = "SELECT CustomerEmail, Password, FirstName FROM Customer WHERE CustomerEmail = :email LIMIT 1";

				$handle = $conn->prepare($query);
				$handle->bindParam(':email', $email);
				$handle->execute();

				$result = $handle->fetchAll( \PDO::FETCH_ASSOC );
				$conn = DB::close();
				return $result;

		}
		catch(\PDOException $ex) {
				return print($ex->getMessage());
		}

			if (count($result) == 1) {
				// username/password authenticated
				// and only 1 match
				$found_user = $result[0];
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
		$password = Security::secureString($_POST['pass']);
		$passwordvali = Security::secureString($_POST['passvali']);
		if ($password == $passwordvali && $vali == true) {
			$firstName = Security::secureString($_POST['firstName']);
			$lastName = Security::secureString($_POST['lastName']);
			$email = Security::secureString($_POST['CustomerEmail']);
	    $iterations = ['cost' => 10];
	    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);
			try {
	        $conn = DB::connect();

	        $cat = Security::secureString($_GET["cat"]);

	        $query = "INSERT INTO `Customer` (CustomerEmail, Password, Street, HouseNumber, Phone, FirstName, LastName, ZipCode, ResetKey) VALUES (:email, :hashed_password, NULL, NULL, NULL, :firstName, :lastName, NULL, NULL)";

	        $handle = $conn->prepare($query);
	        $handle->bindParam(':email', $email);
	        $handle->bindParam(':hashed_password', $hashed_password);
	        $handle->bindParam(':firstName', $firstName);
	        $handle->bindParam(':lastName', $lastName);
	        $handle->execute();

	        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
	        $conn = DB::close();
	        return $result;

	    }
	    catch(\PDOException $ex) {
	        return print($ex->getMessage());
	    }
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

	if (isset($_POST['submitforgot'])) {
        $subject = "Email from online mail form";

        function error($error)
        {
            echo "Error processing your form input<br><br>";
            echo "<b>The errors are:</b><br> ";
            echo $error . "<br>";
            die();
        }

        //Validation of null fields
        if (!isset($_POST["emailforgot"])) {
            error("No input to validate!");
        }
				$email = Security::secureString($_POST["emailforgot"]);
				$randomkey = substr(md5(rand()), 0, 20);

				try {
			      $conn = connectToDB();

			      $statement = "UPDATE Customer SET ResetKey = :randomkey WHERE CustomerEmail = :email";

			      $handle = $conn->prepare($statement);
			      $handle->bindParam(':randomkey', $randomkey);
						$handle->bindParam(':email', $email);
			      $handle->execute();

						$statement2 = "INSERT INTO Customer (ResetKey) VALUES (:randomkey) WHERE CustomerEmail = :email";

			      $handle = $conn->prepare($statement2);
			      $handle->bindParam(':randomkey', $randomkey);
						$handle->bindParam(':email', $email);
			      $handle->execute();

						$conn = DB::close();
			  }
			  catch(\PDOException $ex) {
			      print($ex->getMessage());
			  }

				$domain = $_SERVER['HTTP_HOST'];
				$resetmessage = "Reset password: <$domain/view/newpass.php?email=$email&key=$randomkey>";
        echo $email;
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

	if (isset($_POST["submitnewpass"])) {
		if (isset($_GET["email"]) && isset($_GET["key"])) {
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
			$password = Security::secureString($_POST['pass']);
			$password2 = Security::secureString($_POST['pass2']);
			if ($password == $password2 && $vali == true) {
		    $iterations = ['cost' => 10];
		    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);

				$email = $_GET["email"];
				$reset = $_GET["key"];

				try {
			      $conn = connectToDB();

			      $statement = "UPDATE Customer SET Password = :password, ResetKey = NULL WHERE CustomerEmail = '{$email}' AND ResetKey = '{$reset}'";
			      $handle = $conn->prepare($statement);
			      $handle->bindParam(':password', $hashed_password);
			      $handle->execute();
						$conn = DB::close();
			  }
			  catch(\PDOException $ex) {
			      print($ex->getMessage());
			  }
		}
	}
}

function getCustomerInfo($email) {
	try {
		$conn = connectToDB();

		$handle = $conn->prepare("SELECT * FROM Customer WHERE CustomerEmail = '{$email}'");
		$handle->execute();

		$result = $handle->fetchAll( \PDO::FETCH_ASSOC );
		return $result;
		$conn = DB::close();
	}
	catch(\PDOException $ex) {
		print($ex->getMessage());
	}
}

if (isset($_POST["updateprofile"])) {
	try {
		$conn = connectToDB();

		$vali = true;

		if (!isset($_POST["street"]) || $_POST["street"] == "") {
			$street = NULL;
		} else {
			$street = $_POST["street"];
		}

		if (!isset($_POST["housenumber"]) || $_POST["housenumber"] == "") {
			$housenumber = NULL;
		} else {
			$housenumber = $_POST["housenumber"];
		}

		if (!isset($_POST["phone"]) || $_POST["phone"] == "") {
			$phone = NULL;
		} else {
			$phone = $_POST["phone"];
		}

		if (!isset($_POST["zipcode"]) || $_POST["zipcode"] == "") {
			$zipcode = NULL;
		} else {
			$zipcode = $_POST["zipcode"];
		}

		if (!isset($_POST["firstname"]) || $_POST["firstname"] == "") {
			$firstname = NULL;
			$vali = false;
			echo "You need a first name!";
		} else {
			$firstname = $_POST["firstname"];
		}

		if (!isset($_POST["lastname"]) || $_POST["lastname"] == "") {
			$lastname = NULL;
			$vali = false;
			echo "You need a last name!";
		} else {
			$lastname = $_POST["lastname"];
		}

		$email = $_SESSION["CustomerEmail"];

		if ($vali == true) {
			$statement = "UPDATE Customer SET Street = :street,
			HouseNumber = :housenumber,
			Phone = :phone,
			FirstName = :firstname,
			LastName = :lastname,
			ZipCode = :zipcode
			WHERE CustomerEmail = :email";

			$handle = $conn->prepare($statement);
			$handle->bindParam(':street', $street);
			$handle->bindParam(':housenumber', $housenumber);
			$handle->bindParam(':phone', $phone);
			$handle->bindParam(':firstname', $firstname);
			$handle->bindParam(':lastname', $lastname);
			$handle->bindParam(':zipcode', $zipcode);
			$handle->bindParam(':email', $email);
			$handle->execute();
			$_SESSION["FirstName"] = $_POST["firstname"];
		}
		$conn = DB::close();
	}
	catch(\PDOException $ex) {
		print($ex->getMessage());
	}
}

if (isset($_POST["updatepassword"])) {
	$password = $_POST['new'];
	$password2 = $_POST['repeatnew'];
	$oldpassword = $_POST['old'];

	try {
		$conn = connectToDB();
		$email = $_SESSION["CustomerEmail"];
		$statement = "SELECT Password FROM Customer WHERE CustomerEmail = :email LIMIT 1";
		$handle = $conn->prepare($statement);
		$handle->bindParam(':email', $email);
		$handle->execute();
		$result = $handle->fetchAll( \PDO::FETCH_ASSOC );
		if(password_verify($oldpassword, $result[0]["Password"])){
			if ($password == $password2) {
				$iterations = ['cost' => 10];
				$hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);
				try {
			      $conn = connectToDB();

			      $statement1 = "UPDATE Customer SET Password = :password WHERE CustomerEmail = :email";
			      $handle = $conn->prepare($statement1);
			      $handle->bindParam(':password', $hashed_password);
						$handle->bindParam(':email', $email);
			      $handle->execute();
			  }
			  catch(\PDOException $ex) {
			      print($ex->getMessage());
			  }
			}
		}
		$conn = DB::close();
	}
	catch(\PDOException $ex) {
		print($ex->getMessage());
	}
}

?>
