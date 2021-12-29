<?php

//Try to connect to the mysql database by creating a mysqli object
$db = new mysqli("localhost", "shevcdmi", "webove aplikace", "shevcdmi", 3306);
//Raise an error if connection fails
if ($db->connect_errno != 0) {
    $errRaised = "Error while connecting to database";
}

?>