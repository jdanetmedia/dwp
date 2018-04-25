<?php
	function logged_in() {
		return isset($_SESSION['UserEmail']);
	}

	function confirm_logged_in() {
		if (!logged_in()) {
			redirect_to("login.php");
		}
	}
?>
