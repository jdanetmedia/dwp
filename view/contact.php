<?php require_once('../includes/header.php');
 require_once ('../model/contactDAO.php');
 $pageInfo = getPageInfo();
?>
<div class="container">
    <div class="row">
        <div class="col s12 m6">
            <h4>About us</h4>
            <p class="col s12 m12"><?php echo $pageInfo["AboutUsText"]; ?></p>
        </div>
        <form class="col s12 m6" name="contact" method="post" action="includes/contactDAO.php">
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
        <div class="col s12 m12" id="googleMap" style="width:100%;height:350px;"></div>
    </div>

</div>

    <script>
        function myMap() {
            var mapProp= {
                center:new google.maps.LatLng(55.4878244,8.446970499999999),
                zoom:15,
            };
            var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsBQrVNZcWuvUcNlOkr2IqYPLqDwtGtgs&callback=myMap"></script>
<?php require_once('../includes/footer.php') ?>
