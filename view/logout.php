<?php require_once("../includes/loginCustomer/functions.php"); ?>
<?php
		// Four steps to closing a session
		// (i.e. logging out)

		// 1. Find the session
		session_start();

		// 2. Unset all the session variables
		$_SESSION = array();

		// 3. Destroy the session cookie
		if(isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-42000, '/');
		}

		// 4. Destroy the session
		unset($_SESSION["CustomerEmail"]);
		unset($_SESSION["FirstName"]);
		//session_destroy();

		redirect_to("login.php?logout=1");
?>
