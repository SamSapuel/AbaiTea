<?php
/*This module unsets session variables if the "logout"
get request was sent*/
if($errRaised === false && isset($_GET['signout'])){
    session_unset();
    header("Location: index.php");
    exit;
}
?>