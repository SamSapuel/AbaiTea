<?php
//This module gets 2 last reviews from db
do{
    if($errRaised === false){
        $reviews = [];
        //$allReviews = [];
	
        //Select 2 last reviews from db
        $query = "SELECT u.userName, r.revText FROM reviews r
                  INNER JOIN users u ON u.userId = r.revUserId
                  ORDER BY revId DESC";
	
        $stmt = $db->prepare($query);
        if($stmt == false){
            $errRaised = "Error while getting data from database";
            break;
        }
        $executeResult = $stmt->execute();
        if($executeResult == false){
            $errRaised = "Error while getting data from database";
            break;
        }
        $stmt->bind_result($username, $revText);
        //Add them to the variable
        for($ctr = 0; $stmt->fetch(); $ctr++){
            $reviews[$ctr]['username'] = $username;
            $review = htmlspecialchars($revText);
            $reviews[$ctr]['text'] = htmlspecialchars_decode($review);
            //$allReviews[$ctr]['username'] = $username;
            //$allReviews[$ctr]['text'] = $revText;
        }
        $noRevPages = round( count($reviews)/2 );
        $stmt->close();

        //$randIndexes = array_rand($allReviews, 2);
        //shuffle($randIndexes);
        //$reviews[0] = $allReviews[$randIndexes[0]];
        //$reviews[1] = $allReviews[$randIndexes[1]];
    }
}while(0);
?>