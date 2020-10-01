<?php
/*
categories = [manage, edit ,update ,Add ,insert ,delete ,statistics] 
*/
$do = "";
if(isset($_GET['do'])){
    $do = $_GET['do'];
}else{
    $do = 'Manage'; //elly hya el sf7a el raesya
}
 //check if it's the main page
if($do == 'Manage'){
    echo "welcome in the main page <br>";
    echo "<a href='?do=Add'>Add New categori +</a>";
}elseif($do == 'Add'){
    echo "welcome in the Add page";
}elseif($do == 'Insert'){
    echo "welcome in the insert page";
}else{
    echo "error_404 / there is no page with this name";
}