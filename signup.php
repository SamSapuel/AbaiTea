<?php
//ini_set('display_errors', 1);
session_start();
/*If user is logged in, they do not need to visit this page
so they are redirected to the index page*/
if(isset($_SESSION['userId'])){     // pouzivame header configuration z index.php
    header("Location: index.php");
    exit;
}
$errRaised = false;
//Require modules
require_once ("./layouts/_database.php");
require_once ("./layouts/_registration.php");
require_once ("./layouts/_login.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>                            <!-- sign in, sign up stranka-->
        <title>Registration</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="./pics/icon.png" type="image/x-icon">
        <link href="main-tea.css"
        rel = "stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">     <!-- link pro typ pisma Rubik, Nunito, Orbitron-->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.7.1.min.js" ></script>

        <script> var warnRaised = <?= isset($warningRaised) ? "true" : "false" ?>; </script>
        
        <script src="main-tea.js"></script>
    </head>
    <body>
        <div class="maincontent">     <!-- header sign in, sign up stranky-->
            <header class="header">
                <div class="header_inner">
                    <div class="logo">sa</div>
                        <div class="nav">
                            <nav>
                                <a class="nav_link" href="index.php#reviewsid">REVIEWS</a>
                                <a class="nav_link" href="index.php#contactsid">CONTACTS</a>
                            </nav>
                    </div>
                </div>
            </header>
                <?php //If no errors was raised, display the web page 
                if($errRaised === false){ ?>       <!-- pokud nenastane zadna chyba-->
                <div class="blocks">   
                    <div class="container_reg">          <!-- forms pro registrace nebo logovani-->
                        <div class="leftside">
                            <form action="#" method="post" onsubmit="return validateForm()" class="form" name="contact_form">
                                <div class="sign_up_block_email">
                                    <h1 class="up_or_in">Sign up to get full access:</h1>
                                    <?php //Display warnings or messages if any are raised
                                        $warn = "existEmail";                           // musime zkontrolovat existuje-li stejny email v database =
                                        include ("./layouts/_warning.php");                                                                                 // = pokud ne, muzeme pridat uzivatele do database
                                        $warn = "existUsername";                        // musime zkontrolovat existuje-li stejny username v database =
                                        include ("./layouts/_warning.php");
                                        $msg = "regSuccess";                            // zprava pri uspesnem odeslani form: "~Success" nebo neco podobneho
                                        include ("./layouts/_message.php");
                                    ?>
                                        <label for="check1">Email:</label>
                                    <br><input required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="r_email" type="email" placeholder="Type your email..." class="input_sign_up_in" id="check1" onkeyup="saveValue(this)">  <!-- policko email(pouzivame HTML5 tegy pro validace)-->
                                    <span class="error"></span>
                                </div>
                                <div class="sing_up_block_username">
                                    <label for="check2">Username:</label>
                                    <br><input required pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" type="text" name="r_username" placeholder="Type your username..." class="input_sign_up_in" id="check2" onkeyup="saveValue(this)">     <!-- policko username(pouzivame HTML5 tegy pro validace)-->
                                        
                                </div>
                                <div class="sign_up_block_password">
                                    <label for="check3">Password:</label>
                                    <br><input pattern="^[a-zA-Z0-9]+$" required type="password" name="r_password" placeholder="Type your password..." class="input_sign_up_in" id="check3">                  <!-- policko password(pouzivame HTML5 tegy pro validace)-->


                                </div>
                                <div class="sign_up_block_confirm_password">
                                    <label for="check4">Confirm password:</label>
                                    <br><input pattern="^[a-zA-Z0-9]+$" required name="r_password_check" type="password" placeholder="Confirm your password..." class="input_sign_up_in" id="check4">         <!-- policko confirm password(pouzivame HTML5 tegy pro validace)-->

                                </div>
                                <div class="sign_up_button322">
                                    <input type="submit" name="reg" value="Sign up" class="registration_button">
                                </div>
                            </form>
                        </div>
                        <div class="rightside">   
                            <form action="#" method="post" class="form_login" onclick="return validateForm2()">
                            <div class="sign_in_block_username">
                                    <h1 class="up_or_in">If you already have an account:</h1>
                                    <?php //Display warnings or messages if any are raised
                                        $warn = "userNotFound";
                                        include ("./layouts/_warning.php");     // musime zkontrolovat existuje-li stejny username v database
                                        $warn = "unknownWarn";
                                        include ("./layouts/_warning.php");
                                        $warn = "wrongPassword";
                                        include ("./layouts/_warning.php");     // musime zkontrolovat spravne-li heslo pro username v database
                                    ?>
                                    <label for="check5">Username:</label>
                                    <br><input pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" required type="text" name="l_username" placeholder="Type your username..." class="input_sign_up_in" id="check5" onkeyup="saveValue(this)">    <!-- policko username(pouzivame HTML5 tegy pro validace) -->

                                </div>
                                
                                <div class="sign_in_block_password">
                                    <label for="check6">Password:</label>
                                    <br><input pattern="^[a-zA-Z0-9]+$" required type="password" name="l_password" placeholder="Type your password..." class="input_sign_up_in" id="check6">                 <!-- policko password(pouzivame HTML5 tegy pro validace)-->

                                </div>
                                <div class="sign_in_button322">
                                    <input type="submit" name="login" value="Sign in" onsubmit="return validateForm2()" class="sign_in_button">
                                </div>
                            </form>
                            <?php }
                            else {  // Display an error, if one is raised
                                require ("./layouts/_error.php");
                            }?>
                        </div>
                    </div> 
                </div> 
        </div>
            







    </body>






</html>