<?php
//This module checks the relevance of db data and session data of a user

//Initially, user in not logged in
$logged = false;
//If no errors occured and if the user is logged in, then...
if($errRaised === false && isset($_SESSION['userId'])){
    do{
        //Select the user data from db and raise errors if selection is not successful
        $query = "SELECT * FROM users WHERE userId = ?";
        $stmt = $db->prepare($query);
        if($stmt == false){
            $errRaised = "Error while checking data in database";
            break;
        }
        $bindResult = $stmt->bind_param("i", $_SESSION['userId']);
        if($bindResult == true)
            $executeResult = $stmt->execute();
        else{
            $errRaised = "Error while checking data in database";
            break;
        }
        if($executeResult == false){
            $errRaised = "Error while checking data in database";
            break;
        }
        $stmt->bind_result($userId, $userEmail, $userName, $userPassword);
        while($stmt->fetch());
        //Display warnings if something is wrong
        if($stmt->num_rows == 0){
            $warningRaised['userNotFound'] = "User does not exist anymore, you have been logged out!";
            session_unset();
            break;
        } else if($stmt->num_rows > 1) {
            $warningRaised['unknownWarn'] = "Unknown error, you have been logged out!";
            session_unset();
            break;
        } else if($userPassword != $_SESSION['userPassword']){
            $warningRaised['passChanged'] = "The password is outdated, you have been logged out!";
            session_unset();
            break;
        }
        $stmt->close();
        //If no errors or warnings were raised then a user is considered to be successfully logged in
        $logged = true;
    }while(0);
}
?>