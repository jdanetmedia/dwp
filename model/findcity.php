<?php
$q = intval($_GET['q']);

$con = mysqli_connect('mysql5.unoeuro.com','rasmusandre_dk','rasm8468','rasmusandreas_dk_db3');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql = "SELECT * FROM ZipCode WHERE ZipCode = '{$q}'";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result)) {
    echo $row['City'];
}
?>
