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
$allPromocodes = $promocodes->getAllPromocodes();
?>
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">All Promocodes<a class="waves-effect waves-light btn grey darken-4 new-prod-btn" href="new-promocode.php">Add new</a></span>
                    <table class="responsive-table striped">
                        <thead>
                        <tr>
                            <th>Promocode</th>
                            <th>Discount amount</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Number of uses</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <?php // TODO: Ændre farve på select felter ?>
                        <tbody>
                        <?php
                        foreach ($allPromocodes as $promocode) {
                            ?>
                            <tr>
                                <td><?php echo $promocode->PromoCode; ?></td>
                                <td><?php echo $promocode->DiscountAmount; ?>%</td>
                                <td><?php echo $promocode->StartDate; ?></td>
                                <td><?php echo $promocode->EndDate; ?></td>
                                <td><?php echo $promocode->NumberOfUses; ?></td>
                                <td><a href="edit-promocode.php?promocode=<?php echo $promocode->PromoCode; ?>">Edit</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once("../admin/includes/footer.php"); ?>
