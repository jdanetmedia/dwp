<?php require_once('../includes/header.php');
 require_once ('../model/contactDAO.php');
 $pageInfo = getPageInfo();
?>
<div class="container" style="filter: blur(0px);">
    <div class="row">
        <div class="col s12 m6">
            <h4>About us</h4>
            <p class="col s12 m12"><?php echo $pageInfo["AboutUsText"]; ?></p>
        </div>
        <form class="col s12 m6" name="contact" method="post" action="../model/contactDAO.php">
            <div class="row">
                <h4>Quack at us</h4>
                <div class="input-field col s12 m12">
                    <input id="name" type="text" name="name" class="validate">
                    <label for="name">Name</label>
                </div>
                <div class="input-field col s12 m12">
                    <input id="email" type="email" name="email" class="validate">
                    <label for="email" data-error="wrong" data-success="right">Email</label>
                </div>
                <div class="input-field col s12">
                    <textarea id="textarea" class="materialize-textarea" name="message"></textarea>
                    <label for="textarea">Message</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Send</button>
        </form>
    </div>
    <div class="row">
        <iframe style="width:100%;height:350px;" frameborder="0" style="border:0"
        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA414Nqm3BnCRdpETHYt6ySV3DRjvEQ1ec&q=<?php echo $pageInfo["Street"]; ?>+<?php echo $pageInfo["HouseNumber"]; ?>,<?php echo $pageInfo["ZipCode"]; ?>" allowfullscreen>
      </iframe>
    </div>
</div>

<?php require_once('../includes/footer.php') ?>
