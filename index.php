<?php
//ini_set('display_errors', 1);
session_start();
//If errRaised variable is set to false then no errors occured 
$errRaised = false;
//Display review success message
if(isset($_SESSION['revSuccess']) && $_SESSION['revSuccess'] == true){
    $messageRaised['reviewSuccess'] = "Your review was added!";
    unset($_SESSION['revSuccess']);
}
//Require all modules
require_once ("./layouts/_database.php");  // php soubory, ktere budeme pouzivat pro funkcnost web-stranky
require_once ("./layouts/_checkSession.php");
require_once ("./layouts/_signout.php");
require_once ("./layouts/_submitReview.php");
require_once ("./layouts/_reviews.php");
?>

<!DOCTYPE html>
<html lang="en">           <!-- main web-stranka shai abai-->
    <head>
        <title>Abai Tea</title>
        <meta charset="UTF-8">
	    <link rel="shortcut icon" href="./pics/icon.png" type="image/x-icon">
	    <link href="main-tea.css" rel = "stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">    <!-- link pro typ pisma Rubik, Nunito, Orbitron-->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.7.1.min.js" ></script>

        <script> var warnRaised = <?= isset($warningRaised) ? "true" : "false" ?>; </script>

        <script src="main-tea.js"></script>
    </head>
    <body>
        <header class="header">   <!-- header stranky  #1-->
            <div class="header_inner">
                <div class="logo">sa</div>
                    <div class="nav">
                        <nav>
                            <a class="nav_link" href="#reviewsid">REVIEWS</a>
                            <a class="nav_link" href="#contactsid">CONTACTS</a>
                            <?php if($logged){ ?>      <!--bude se menit pri stavu je-li uzivatel v db i udelal-li sign in-->
                            <a class="nav_link" href="index.php?signout">SIGN OUT</a>
                            <?php }else{ ?>
                            <a class="nav_link" href="signup.php">SIGN UP</a>
                            <?php }?>
                        </nav>
                </div>
            </div>

        </header>
        
        <div class="intro">                 <!-- content stranky #1-->
            <div class="container">
                <div class="intro_inner">   <!-- zmnena button sign in na sign out-->
                    <?php //Display warnings or messages if any are raised
                        $warn = "userNotFound";
                        include ("./layouts/_warning.php");
                        $warn = "unknownWarn";
                        include ("./layouts/_warning.php");
                        $msg = "passChanged";
                        include ("./layouts/_warning.php");
                    ?>
                    <h2 class="intro_suptitle"> Our tea the best tea.</h2>
                    <h1 class="intro_title">SHAI ABAI</h1>
                    <a class="btn" href="#about_usid">learn more</a>
                </div>
            </div>

        </div>
        <?php //If no errors was raised, display the web page 
        if($errRaised === false){ ?>
        <div class="about_us" id="about_usid">        <!--header about us stranka #2-->
            <div class="about_us_header">
                <h1>About us</h1>
                <hr class="hr1">
            </div>
            <div class="container_about_us">
                <div class="about_us_page">
                    Shai Abai is a tea that is collected with love, care and<br>               <!-- maincontent about us stranka #2-->
                    professionalism. Our company grows only the best varieties of black<br>
                    tea in Kazakhstan. Its beneficial properties are innumerable, you will<br>
                    be forever young, vigorous, and your body will undergo a complete<br> 
                    cleansing of harmful bacteria with the help of linden extract, which<br>
                    we add to our tea.<br>
                    <?php //If user is not authorized, display block 
                    if(!$logged){ ?>
                    Become a member of our family, the Chai Abai family!
                    <div class="button">
                        <a class="sign_up_button" href="signup.php">Sign Up</a>         <!-- jestli uzivatel bude prihlasen, nadpis + odkaz "sign in" zmizi-->
                    </div>
                    <?php } ?>
                    <div class="footer_about_us">
                        Pre-order is already available throughout Asia and will be<br>       
                        shipping across Europe soon.
                    </div>
                </div>

            </div>
            
            

        </div>

        <div class="reviews_page" id="reviewsid">     <!-- header reviews stranka #3-->
            <div class="reviews_header">
                <h1>What people say</h1>
                <hr class="hr2">
            </div>
            <div class="container_reviews">         <!--maincontent reviews stranka #3-->
                <div class="reviews">                                   <!-- nejdulezitejsi cast web-stranky celkove, tento cast ma zodpovednost pred pridanim novych reviews prihlasenych uzivatelu(POZOR! Jen prihlasenych!!!)-->
                    <div id="listReviews">
                        <?php
                            if(isset($_GET['page'])){
                                $pageFirstRev = $_GET['page'] * 2 - 2;
                            } else {
                                $pageFirstRev = 0;
                            }
                        ?>
                        <h1 class="login"><?=$reviews[$pageFirstRev]['username']?></h1>  <!-- pouzivame username uzivatele, ktery se prihlasil-->
                        <?=$reviews[$pageFirstRev]['text']?>
                        <hr class="hr3">
                        <h1 class="login"><?=$reviews[$pageFirstRev+1]['username']?></h1>  <!-- pouzivame username uzivatele, ktery se prihlasil-->
                        <?=$reviews[$pageFirstRev+1]['text']?>                             <!-- pouzivame review uzivatele s username-->
                        <hr class="hr3">                                     <!-- celkove mate moznost pridani jen 2 review na 1 stranku, dal budou se menit vespolek, ostatni predchozi budou se nachazet v database MySQL na serveru-->
                    </div>
		            <div id="pageButtons">
                        <form action="#reviewsid" method="get">
                        <?php
                            for($ctr = 0; $ctr<count($reviews)/2; $ctr++){
                                $noButton = $ctr+1;
                                echo "<button type=\"submit\" name='page' value='$noButton'>$noButton</button>";
                            }
                        ?>
                        </form>
                    </div>

                    <!--<script>
                        var noPages = <?=$noRevPages?>;
                        var reviews = <?= json_encode($reviews) ?>;
                        var buttonsContainer = "";
                        var reviewsContainers = [];
                        for(ctr=0;ctr<noPages;ctr++){
                            let currentPage = ctr + 1;
                            buttonsContainer += "<button onclick='changeRevContent("+ctr+")'>"+currentPage+"</button>\n";
                            reviewsContainers[ctr] = `<h1 class="login">${reviews[ctr*2].username}</h1>
                                                     ${reviews[ctr*2].text}
                                                     <hr class="hr3">`;
                            if(typeof(reviews[ctr*2+1]) != "undefined" && reviews[ctr*2+1] !== null){
                                reviewsContainers[ctr]+= `<h1 class="login">${reviews[ctr*2+1].username}</h1>
                                                         ${reviews[ctr*2+1].text}
                                                         <hr class="hr3">`;
                            }
                        }
                        $("#pageButtons").html(buttonsContainer);

                        function changeRevContent(page){
                            $("#listReviews").html(reviewsContainers[page]);
                        }
                    </script>-->

		            <?php //Display warnings or messages if any are raised
                        $warn = "reviewSubmit";
                        include ("./layouts/_warning.php");
                        $msg = "reviewSuccess";
                        include ("./layouts/_message.php");
                    ?>
		   
                    <div class="reviews_textarea">
                        <form action="#reviewsid" method="post">
                            <textarea required id="review_area" class="textarea1" name="review" maxlength ="400" placeholder="Write your review here..." onkeyup="saveValue(this)"></textarea> <!-- textarea pro pridani review, aby odeslat review potrebujete stisknout "ENTER" a review se odesle, pokud nenastane zadna chyba-->
                            <!-- <h1 class="warning_textarea">Warning!! You have only 400 charactres to write!</h1> -->
							<noscript><button type="submit">Send</button></noscript>
                            <?php //If user is not authorized, display button 
                            if(!$logged){ ?>
                            <div class="sign_up_line"><a class="sign_up" href="signup.php">Sign up</a> to leave a review</div>      <!-- jestli uzivatel bude prihlasen, nadpis + odkaz "sign in" zmizi-->
                            <?php } ?>
                        </form>
                    </div>    
                </div>
            </div>

        </div>

        <div class="contacts" id="contactsid">   <!-- header contacts stranka #4-->
            <div class="contacts_header">
                <h1>Our contacts</h1>
                <hr class="hr3">
            </div>
            <div class="container_contacts">     <!-- maincontent contacts stranka #4-->
                <div class="contacts_blocks">
                    <div class="line1_1">
                        <h1 class="contacts_name_of_contact">Alexander Nevskiy</h1>
                        Alexander is one of our first-class employees. 
                        Thanks to him we have an extensive tea supply chain around the world.
                        Phone number:
                        <?php if($logged){ ?>    <!-- jestli uzivatel bude prihlasen, bude videt telefonni cisla misto hvezdicek-->
                        +7(707)-770-77-70
                        <?php }else{ ?>
                        * - *** - *** - ** - **
                        <?php } ?>
                    </div>
                    <div class="line1_2">
                        <h1 class="contacts_name_of_contact">Walter White</h1>
                        Walter is our main tea maker. 
			            Every day he personally collects tea leaves and dries them for you.
                        Phone number:
                        <?php if($logged){ ?>    <!-- jestli uzivatel bude prihlasen, bude videt telefonni cisla misto hvezdicek-->
                        +7(707)-770-77-71
                        <?php }else{ ?>
                        * - *** - *** - ** - **
                        <?php } ?>
                    </div>
                    <div class="line2_1">
                        <h1 class="contacts_name_of_contact">Andrey Shevtsov</h1>
                        Andrey is our theoretical physicist. 
			            He personally tastes the tea so that you enjoy only the finest product.
                        Phone number:
                        <?php if($logged){ ?>    <!-- jestli uzivatel bude prihlasen, bude videt telefonni cisla misto hvezdicek-->
                        +7(707)-771-77-72
                        <?php }else{ ?>
                        * - *** - *** - ** - **
                        <?php } ?>
                    </div>
                    <div class="line2_2">
                        <h1 class="contacts_name_of_contact">Vladimir Zelensky</h1>
                        Vladimir is our advertising face. 
			            He, as the President of Ukraine, decided to start promoting our products to the masses himself.
                        Phone number:
                        <?php if($logged){ ?> 
                        +7(707)-772-77-73    <!-- jestli uzivatel bude prihlasen, bude videt telefonni cisla misto hvezdicek-->
                        <?php }else{ ?>
                        * - *** - *** - ** - **
                        <?php } ?>
                    </div>
                </div>
                
            </div>

            <?php //If user is not authorized, display button 
            if(!$logged){ ?>
            <div class="sign_up_line" id="sign_up_contacts"><a class="sign_up" href="signup.php">Sign up</a> to reveal phone numbers</div>      <!-- jestli uzivatel bude prihlasen, nadpis + odkaz "sign in" zmizi-->
            <?php } ?>
            <div class="footer">
                <footer>2020&copy;ShevRuzz Corp.</footer>  <!-- footer web-stranky shai abai-->
            </div>    
        </div>

        <?php }
        // Display an error, if one is raised
        else {
            require ("./layouts/_error.php");
        }?>

    </body>

</html>