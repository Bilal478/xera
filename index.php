<?php
//Initialize all variables
$firstvar = "";
$secondvar = "";
$thirdvar = "";
$fourthvar = "";
$fifthvar = "";
$sixthvar = "";

$address_path = "http://localhost/xeralite/";

//Prune link against malicious injections
if(isset($_GET['firstvar'])){ $firstvar = htmlspecialchars(stripslashes(strip_tags(trim($_GET['firstvar'])))); }
if(isset($_GET['secondvar'])){ $secondvar = htmlspecialchars(stripslashes(strip_tags(trim($_GET['secondvar'])))); }
if(isset($_GET['thirdvar'])){ $thirdvar = htmlspecialchars(stripslashes(strip_tags(trim($_GET['thirdvar'])))); }
if(isset($_GET['fourthvar'])){ $fourthvar = htmlspecialchars(stripslashes(strip_tags(trim($_GET['fourthvar'])))); }
if(isset($_GET['fifthvar'])){ $fifthvar = htmlspecialchars(stripslashes(strip_tags(trim($_GET['fifthvar'])))); }
if(isset($_GET['sixthvar'])){ $sixthvar = htmlspecialchars(stripslashes(strip_tags(trim($_GET['sixthvar'])))); }
if(isset($_GET['seventhvar'])){ $seventhvar = htmlspecialchars(stripslashes(strip_tags(trim($_GET['seventhvar'])))); }

//Include functions
include_once("./functions/connection_functions.php");
include_once("./functions/main_functions.php");
include_once("./functions/validation_functions.php");
include_once("./functions/user_functions.php");
include_once("./functions/post_functions.php");
connect_to_maindb();

//Load pages
if(isLogedIn()){
    //Session pages
    $user_id = isLogedIn();
    include_once("./modules/home/user_home.php");

}else{
    //Public pages
    //Auth pages
    if($firstvar == 'login'){
        include_once("./modules/auth/login.php");
    }
    elseif($firstvar == 'signup'){
        include_once("./modules/auth/signup.php");
    }
    else{
        include_once("./modules/auth/login.php");
    }
}
