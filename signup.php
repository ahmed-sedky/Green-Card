<?php 
ob_start();
include 'init.php' ;
$pageTitle= "Sign Up";
if($_SERVER['REQUEST_METHOD'] =='POST'){
    $username   = $_POST['username'];
    $pass1      = $_POST['password'];
    $pass2      = $_POST['re-password'];
    $hashpass   = sha1($_POST['password']);
    $email      = $_POST['email'];
    $fullname   = $_POST['fullname'];

    //upload variables
    $avatar     = $_FILES['avatar'];
    $avatarName = $avatar['name'];
    $avatarSize = $avatar['size'];
    $avatarTmp  = $avatar['tmp_name'];
    $avatarType = $avatar['type'];

    $allowedExtensions = array("jpeg" ,"jpg","png" ,"gif");
    $getExtensions = explode(".",$avatarName);
    $gExtensions = strToLower(end($getExtensions));

    $formErrors = array();
    if(isset($username)){
        $filteredUser = filter_var($username,FILTER_SANITIZE_STRING);
    }
    if(strlen($filteredUser) <4) {
    $formErrors[] = "UserName Can't Be Less Than 4 Charcters";
    }
    if(isset($pass1) && isset($pass2)){
        if(empty( $pass1)){
            $formErrors[] = "The Password Can't Be Empty"; 
        }else{
            if(strlen($pass1) < 6) {
                $formErrors[] = "Password Can't Be Less Than 4 Charcters";
                }
            if(sha1($pass1) !== sha1($pass2)){
                $formErrors[] = "Password Doesn't Match";
            }
        }
    }
    if(isset($email)){
        $filteredEmail = filter_var($email,FILTER_SANITIZE_EMAIL);
        if(filter_var($filteredEmail,FILTER_VALIDATE_EMAIL) !=TRUE){
            $formErrors[] = "This Email Is Not Valid";
        }
    }
    if(! empty($avatarName) && ! in_array($gExtensions ,$allowedExtensions)){
        $form_errors[] = "<span class='alert alert-danger'>This Extension Is Not Allowed</span>";
    }
    if(empty($avatarName)){
        $form_errors[] = "<span class='alert alert-danger'>Image Is required</span>";
    }
    if( $avatarSize > 4194304){
        $form_errors[] = "<span class='alert alert-danger'>Image Can't Be More Than 4MB</span>";
    }
    if(empty($form_errors)){
        // check if the UserNme is Unique
        $check1 = checkItem('UserName','user',$filteredUser);
        if( $check1 == 1){
            $formErrors[] = "Sorry , This User Is Exist ";
        }else{
            $image = rand(0 ,1000000) . "_" .$avatarName;
            move_uploaded_file($avatarTmp , "controls\Uploads\Avatar\\".$image);
            $stmt =$db->prepare("INSERT INTO user(UserName ,password ,Email ,Fullname,RegStatus ,RegDate ,Image) 
                                    VALUES (:zuser , :zpass , :zmail , :zname , 0 ,now() ,:zimage) /*regstatus 1 laen el admin hwa ellly daifh*/
                                    ");
            $stmt->execute(array(
                'zuser' => $filteredUser,
                'zpass' => $hashpass,
                'zmail' => $filteredEmail,
                'zname' => $fullname,
                'zimage'=> $image
            ));
            //success message
            $successMsg = "Congrats You Have Just Registered";
            header("refresh:5;url=login.php");
        }
    }
}


?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="login signup" enctype="multipart/form-data">
    <h3 class="text-center">Create Account</h3>
    <div class="form-group ">
                    <label class="col-sm-8 col-form-label">UserName</label>
                    <div class="col-sm-12 ">
                        <input type="text" pattern=".{4,}" title= "UserName Must Be More Than 4 Characters" name="username"  class="form-control "  autocomplete="off" required>
                    </div>
    </div>
    <div class="form-group ">
                    <label class="col-sm-8 col-form-label">Password</label>
                    <div class="col-sm-12 ">
                        <input minlength="6" type="password" name="password"  class="form-control "  autocomplete="new-password" required>
                    </div>
    </div>
    <div class="form-group ">
                    <label class="col-sm-8 col-form-label">Re-Enter Password</label>
                    <div class="col-sm-12 ">
                        <input minlength="" type="password" name="re-password"  class="form-control "  autocomplete="new-password" required >
                    </div>
    </div>
    <div class="form-group ">
                    <label class="col-sm-8 col-form-label">Email</label>
                    <div class="col-sm-12 ">
                        <input type="text" name="email"  class="form-control "  placeholder="type a valid email" required>
                    </div>
    </div>
    <div class="form-group ">
                    <label class="col-sm-8 col-form-label">Full Name</label>
                    <div class="col-sm-12 ">
                        <input type="text" name="fullname"  class="form-control "  autocomplete="off" >
                    </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Image</label>
        <div class="col-sm-10">
            <input type="file"  name="avatar"  class="form-control-file editInput" autocomplete="off"  id="" >
        </div>
    </div>
    
    
    <input type="submit" value="Create New Account" class="btn btn-warning ">
</form>
        <img src="<?php echo $img;?>big-eclipse.svg" alt="" class="big-circle">
        <img src="<?php echo $img;?>mid-eclipse.svg" alt="" class="mid-circle">
        <img src="<?php echo $img;?>small-eclipse.svg" alt="" class="small-circle">
        <div class="the-errors text-center">
            <?php 
            if(! empty($formErrors)){
                foreach($formErrors as $error){
                    echo "<div class='alert alert-danger'>" . $error ."</div>";
                }
            }
            if (isset($successMsg)){
                echo "<div class='alert alert-success'>" . $successMsg ."</div>";
            }
            ?>
        </div>
<?php include $tbl. 'footer.php';
ob_end_flush();
?>