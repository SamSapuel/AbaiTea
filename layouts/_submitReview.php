<?php
//This module adds a review to the database
if($errRaised === false && isset($_POST['review'])){
    if(isset($_SESSION['userId'])){
        do{
            //Makes the review string safe
            $review = htmlspecialchars($_POST['review']);
            //Try to insert the review into db
            $query = "INSERT INTO reviews (revUserId, revText)
                      VALUES (?, ?)";
            $stmt = $db->prepare($query);
            if($stmt == false){
                $errRaised = "Error while adding review to database";
                break;
            }
            $bindResult = $stmt->bind_param("is", $_SESSION['userId'], $review);
            if($bindResult == true)
                $executeResult = $stmt->execute();
            else{
                $errRaised = "Error while adding review to database";
                break;
            }
            if($executeResult == false){
                $errRaised = "Error while adding review to database";
                break;
            }
            $stmt->close();
            //Display the message if everything successful
            $_SESSION['revSuccess'] = true;
            header("Location: index.php");
            exit;
        }while(0);
    }
    else {
        $warningRaised['reviewSubmit'] = "You are not logged in!";
    }
}
?>