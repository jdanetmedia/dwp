<?php
require_once("../includes/loginCustomer/functions.php"); ?>
<?php
		// Four steps to closing a session
		// (i.e. logging out)

		// 1. Find the session
		session_start();


		// 2. Unset the session
		unset($_SESSION["CustomerEmail"]);
		unset($_SESSION["FirstName"]);

		redirect_to("login.php?logout=1");
?>
