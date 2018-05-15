<?php
require_once("../includes/sessionstart.php");
require_once("../admin/includes/header.php");
spl_autoload_register(function($class) {
    include "class/".$class.".php";
});

if (!logged_in()) {
?>
<script type="text/javascript">
	window.location.href = 'login.php';
</script>
<?php
	//redirect_to("login.php");
}

$promocodes = new Promocode();
$promocode = $promocodes->getPromocode($_GET["promocode"]);
var_dump($promocode);
echo $promocode[0]["PromoCode"];
?>

<div class="container">
    <form action="edit-promocode.php?promocode=<?php echo $_GET["promocode"]; ?>" method="post">
        <div class="row">
            <input class="waves-effect waves-light btn grey darken-4 right new-prod-btn" type="submit" name="submitupdatepromo" value="Save">
            <button class="waves-effect waves-light btn grey darken-4 right new-prod-btn" type="submit" name="submitdeletepromo" value="Delete">Delete</button>
        </div>
        <div class="row">
            <ul class="collapsible" data-collapsible="accordion">
                <li>
                    <div class="collapsible-header active"><i class="material-icons">assignment</i>General</div>
                    <div class="collapsible-body">
                        <div class="row">
                            <form class="col s12">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="promocode" type="text" class="validate" name="promocode"
                                               value="<?php echo $promocode[0]["PromoCode"]; ?>">
                                        <label for="promocode">Promocode</label>
                                    </div>
                                </div>
                                <div class="row">
                                  <input type="text" class="datepicker">
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </form>
</div>
<?php require_once("../admin/includes/footer.php"); ?>
