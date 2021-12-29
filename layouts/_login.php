<?php
//This module sets session variables so that a user is able to be considered logged in
    if($errRaised === false && !isset($_SESSION['userId']) && isset($_POST['login'])){
        if(isset($_POST['l_username']) && isset($_POST['l_password'])){
            do{
                //Get the user's data from database
                $query = "SELECT * FROM users WHERE userName = ?";
                $stmt = $db->prepare($query);
                if($stmt == false){
                    $errRaised = "Error while checking data in database";
                    break;
                }
                $bindResult = $stmt->bind_param("s", $_POST['l_username']);
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
                    $warningRaised['userNotFound'] = "User not found!";
                    break;
                } else if($stmt->num_rows > 1) {
                    $warningRaised['unknownWarn'] = "Unknown error, contact administrator!";
                    break;
                }
                $stmt->close();


                //Compare the password entered by user with the password from db
                $enteredPassword = md5(md5(trim($_POST['l_password'])));
                if($enteredPassword != $userPassword){
                    $warningRaised['wrongPassword'] = "You entered wrong password!";
                    break;
                }

                //If everything successful set session variables
                $_SESSION['userId'] = $userId;
                $_SESSION['userName'] = $userName;
                $_SESSION['userEmail'] = $userEmail;
                $_SESSION['userPassword'] = $userPassword;
                header("Location: index.php");
                exit;
            }while(0);
        }
    }
?>