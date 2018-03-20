<?php
	session_start();

	function logged_in() {
		return isset($_SESSION['CustomerEmail']);
	}

	function confirm_logged_in() {
		if (!logged_in()) {
			redirect_to("login.php");
		}
	}
?>
