<?php
function getAll( $field ,$table,$where = NULL ,$orderfield , $ordering = "DESC" ){
    global $db;
    $stmt2 =$db->prepare("SELECT $field FROM $table $where ORDER BY $orderfield $ordering");
    $stmt2->execute();
    $get = $stmt2->fetchAll();
    return $get;
}
/*
** getTitle function v1.0
** function to get title to any page
** has na params
*/
function getTitle(){
    global $pageTitle; //34an ykon accesable mn ay mkan
    if(isset($pageTitle)){
        echo $pageTitle;
    }else{
        echo "Admin";
    }
}

/*
** hOmE Redirect function v2.0
** function accept parameters
** $theMsg [error , warning ,success]
** URL = the link you want to redirect to
** $seconds //how many seconds the msg will stay before redirect it
*/
function Home_Redirect($theMsg , $url = null ,$seconds = 3){
    if($url === null){
        $url = "index.php";
        $link = "HomePage";
    }elseif($url == 'Custom'){
        $url = "members.php";
        $link ="member page";
    }
    elseif($url == 'Custom2'){
        $url = "categories.php";
        $link ="category page";
    }
    elseif($url == 'Custom3'){
        $url = "items.php";
        $link ="items page";
    }
    elseif($url == 'Custom4'){
        $url = "comments.php";
        $link ="comments page";
    }else{
        $url = isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== "" ? $_SERVER['HTTP_REFERER'] : $url ="index.php";
        $link = "Previous Page";
    }
    echo $theMsg ;
    echo "<div class='alert alert-info'> you 'll be redirect to " . $link ." after " .$seconds ." seconds </div>";
    header("refresh:$seconds;url=$url");
    exit();
}
/*
** check item function v1.0
** the function accept params
** $select = the item to select [Ex: user ,item ,categori]
** $from = from the table [ex:user ,items ,categories]
** value = the value of select [ex: osama , chair ,furniture]
*/
function checkItem($select, $from, $value){
    global $db;
    $statement = $db->prepare("SELECT $select FROM $from WHERE $select = ?");
    $statement->execute(array($value));
    $count = $statement->rowCount();
    return $count;
}
/*
** function Calculate_Items v2.0
** function has parameters
** select = to select the item to count from database
** $from =to select which table from data base
** $where = for specific select
*/
function Calculate_Items($select,$from,$where){ //where mn 3nde
    global $db;
    if($where == "GroupId"){
        $where = "GroupId != 1";
    }elseif($where == "Pending"){
        $where =" RegStatus != 1";
    }
    $statement =$db->prepare("SELECT count($select) FROM $from WHERE  $where");
    $statement->execute();
    return $statement->fetchColumn();
}
/*
** function Calculate_Items without where v1.0
** function has parameters
** select = to select the item to count from database
** $from =to select which table from data base
*/
function Calculate_Items2($select,$from){ 
    global $db;
    $statement =$db->prepare("SELECT count($select) FROM $from");
    $statement->execute();
    return $statement->fetchColumn();
}
/*
** Get Latest Record Fuction
** function to get the latest items [users ,items ,categories]
** $select = to select the column from database 
** $table = to choose the table from database
** $order = to choose the data detched asc or descending
** $limit = to declare the number of fetched data
*/
function Get_Latest($select,$table, $order ,$limit=5){
    global $db;
    $stmt3 = $db->prepare("SELECT $select FROM $table ORDER BY  $order DESC LIMIT $limit");
    $stmt3->execute();
    return $stmt3->fetchAll();
}