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
$promocodes = new Promocode($_GET["promocode"]);
$promocode = $promocodes->getPromocode($_GET["promocode"]);
?>

<div class="container">
    <form action="manage-promocodes.php?update=<?php echo $_GET["promocode"]; ?>" method="post">
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
                                    <div class="input-field col s12 m6">
                                      <input id="promocode" type="text" class="validate" name="promocode" value="<?php echo $promocode[0]["PromoCode"]; ?>" required="" aria-required="true">
                                      <label for="promocode">Promocode</label>
                                    </div>
                                    <div class="input-field col s12 m3">
                                      <input id="discount" type="number" name="discount" value="<?php echo $promocode[0]["DiscountAmount"]; ?>" required="" aria-required="true">
                                      <label for="discount">Discount in %</label>
                                    </div>
                                    <div class="input-field col s12 m3">
                                      <input id="uses" type="number" name="uses" value="<?php echo $promocode[0]["NumberOfUses"]; ?>">
                                      <label for="uses">Number of uses</label>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="input-field col s12 m6">
                                    <input id="startdate" type="text" class="datepicker" name="startdate" value="<?php echo $promocode[0]["StartDate"]; ?>">
                                    <label for="startdate">Startdate</label>
                                  </div>
                                  <div class="input-field col s12 m6">
                                    <input id="enddate" type="text" class="datepicker" name="enddate" value="<?php echo $promocode[0]["EndDate"]; ?>">
                                    <label for="enddate">Enddate</label>
                                  </div>
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
