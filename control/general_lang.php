<?php
if(isset($_GET['lang'])){
    if($_GET['lang'] == "Ar"){
        include $language. "arabic.php";
    }else{
        include $language. "english.php";
    }
}
else{
    include $language. "english.php";
}
