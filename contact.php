<?php require_once('includes/header.php');
 require_once ('includes/contactDAO.php');
?>
<div class="container">
    <div class="row">
        <div class="col s12 m6">
            <h4>About us</h4>
            <p class="col s12 m12">The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ in their grammar, their pronunciation and their most common words. Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words.If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages.The new common language will be more simple and regular than the existing European languages. It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is.</p>
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
<?php require_once('includes/footer.php') ?>