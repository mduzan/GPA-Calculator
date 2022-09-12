<?php
$mySQL_Host="////////";
$mySQL_User="////////";
$mySQL_Pass="////////";
$linkid = mysqli_connect("$mySQL_Host", "$mySQL_User","$mySQL_Pass", $mySQL_User);


if ($linkid === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
