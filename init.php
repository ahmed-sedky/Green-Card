<?php
// bn7tag mlf el init dh 34an mslan lw 3awez a3'ir folder el templates dh w a5leh temps h3dl esmh fe el file dh bs || w byt7t feh functions w lo3'at y3ne byt7t feh kol el includes
//Routes
include 'control/connect.php';
$sessionUser="";
if(isset($_SESSION['user'])){
    $sessionUser =$_SESSION['user'];
}
$tbl = "includes/templates/"; //template directory 
$language = "includes/languages/"; //language directory
$func = "includes/functions/"; //functions directory
$css = "layout/css/"; //css directory
$js = "layout/js/"; //js directory
$img = "layout/images/"; //images dorectory

// include the important files
include $func."functions.php";
include "general_lang.php";
include $tbl."header.php";

