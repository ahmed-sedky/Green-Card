<?php
// bn7tag mlf el init dh 34an mslan lw 3awez a3'ir folder el templates dh w a5leh temps h3dl esmh fe el file dh bs || w byt7t feh functions w lo3'at y3ne byt7t feh kol el includes
//Routes
include 'connect.php';
$tbl = "includes/templates/"; //template directory 
$language = "includes/languages/"; //language directory
$func = "includes/functions/"; //functions directory
$css = "layout/css/"; //css directory
$js = "layout/js/"; //js directory
$img = "layout/images/"; //images dorectory

// include the important files
include $func."functions.php";
include $language."english.php";
include $tbl."header.php";
// check if there is no_navbar variable in the page
if(!isset($no_navbar)){include $tbl."navbar.php";}

