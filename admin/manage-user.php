<?php require_once("../admin/includes/header.php");

if (!logged_in()) {
?>
<script type="text/javascript">
	window.location.href = 'login.php';
</script>
<?php
	//redirect_to("login.php");
}

?>
<h1>Manage user</h1>
<?php require_once("../admin/includes/footer.php"); ?>
