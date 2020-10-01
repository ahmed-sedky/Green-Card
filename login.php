<?php 
ob_start();
session_start();
if(isset($_SESSION['user'])){
    header('Location:index.php');
}
$pageTitle= "Login";
include 'init.php' ;
// check if the user coming from http post request
if($_SERVER['REQUEST_METHOD'] =='POST'){
    $user =$_POST['user'];
    $pass =$_POST['password'];
    $hash_pass = sha1($pass);
    // check if the user is existed in database
    $stmt = $db->prepare(" SELECT UserId, UserName , password from user WHERE UserName = ? AND password =? Limit 1"); // stmt => stamtement ||prepare 34an t3ml kol 7esbatk 2bl matd5ol 3la el database
    $stmt->execute(array($user,$hash_pass));
    $get = $stmt->fetch();
    $count = $stmt->rowCount(); //by2ole l2a km sf fe el data base motabek ll username w el password dol
    // if count > 0 this mean the database contains record about this username
    if($count > 0){
        $_SESSION['user'] = $user; //register session name
        $_SESSION['uid']  = $get['UserId'];
        header('Location:index.php'); //redirect to dahsbard.php
        exit(); //34an mykml4 t43'el el script w 34an mygble4 output error
    }
}


?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="login">
    <h3 class="text-center">Login</h3>
    <input class="form-control" type="text" name="user" placeholder="UserName" autocomplete="off">
    <input class="form-control" type="password" name="password" placeholder="Password" autocomplete="new-password">
    <!--
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck1">
        <label class="form-check-label" for="gridCheck1">
        Remeber Me
        </label>
    </div>
    -->
    <input type="submit" value="Login" class="btn btn-primary btn-block ">
</form>
        <img src="<?php echo $img;?>big-eclipse.svg" alt="" class="big-circle">
        <img src="<?php echo $img;?>mid-eclipse.svg" alt="" class="mid-circle">
        <img src="<?php echo $img;?>small-eclipse.svg" alt="" class="small-circle">
        <span class="text-muted new-customer"> New Costomer?</span>
        <span><a href="signup.php" class="btn btn-warning create-account">Create A new Account</a></span>
<?php 
include $tbl. 'footer.php' ;
ob_end_flush();
?>