<?php
$dsn ='mysql:host=localhost;dbname=shop';
$user ="root";
$password = "";
$options =array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
);
try{
    $db =new PDO($dsn , $user , $password , $options);
    $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION); //34an e7na 43'alen b eltry w el catch
}
catch(PDOException $e){
    echo "you failed to connect " .$e->getMessage();
}