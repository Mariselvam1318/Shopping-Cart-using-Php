<?php
$connection = mysqli_connect("localhost","root","","shop_db",3308);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>