<?php
//This module adds a new user to database
    if($errRaised === false && !isset($_SESSION['userId']) && isset($_POST['reg'])){
        if(isset($_POST['r_email']) && isset($_POST['r_username']) && isset($_POST['r_password'])){
            do{
                //Check if the email or username are already taken
                $query = "SELECT userId, userEmail, userName FROM users WHERE userEmail = ? OR userName = ?";
                $stmt = $db->prepare($query);
                if($stmt == false){
                    $errRaised = "Error while checking data in database";
                    break;
                }
                $bindResult = $stmt->bind_param("ss", $_POST['r_email'], $_POST['r_username']);
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
                $stmt->bind_result($userId, $userEmail, $userName);
                while($stmt->fetch());
                //If taken display a warning
                if($stmt->num_rows != 0){
                    if($userEmail == $_POST['r_email']){
                        $warningRaised['existEmail'] = "This email already registered!";
                    }
                    if($userName == $_POST['r_username']){
                        $warningRaised['existUsername'] = "This username already registered!";
                    }
                    break;
                }
                $stmt->close();


                //Insert a new user to database
                $password = md5(md5(trim($_POST['r_password'])));
                $query = "INSERT INTO users (userEmail, userName, userPass)
                          VALUES (?, ?, ?)";
                $stmt = $db->prepare($query);
                if($stmt == false){
                    $errRaised = "Error while adding user to database";
                    break;
                }
                $bindResult = $stmt->bind_param("sss", $_POST['r_email'],
                              $_POST['r_username'], $password);
                if($bindResult == true)
                    $executeResult = $stmt->execute();
                else{
                    $errRaised = "Error while adding user to database";
                    break;
                }
                if($executeResult == false){
                    $errRaised = "Error while adding user to database";
                    break;
                }
                $stmt->close();
                //Display the message if everything successful
                $messageRaised['regSuccess'] = "Registered successfully!";
            }while(0);
        }
    }
?>