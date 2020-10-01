<?php
/* You Can | Add | edit dekte members from here */
ob_start();
session_start();
if(isset($_SESSION['username'])){
    $pageTitle = "Members";
    include "init.php";
    $do="";
    if(isset($_GET['do'])){
        $do =$_GET['do'];
    }else{
        $do = 'Manage';
    }
    if ($do == 'Manage'){
        //manage page
        /*
        $value = "Abdelrahman";
        $check = checkItem('UserName','user',$value);
        if($check == 1){
            echo "Cool";
        }
        */
        $query = "";
        if(isset($_GET['page'])&& $_GET['page'] == 'Pending'){
            $query = "WHERE RegStatus = 0";
        }
        ?>
        <h1 class="text-center"><?php echo lang('MANAGE MEMBER'); ?></h1>
        <div class="container">
            <table class="table table-light table-bordered table-responsive-sm table-hover text-center ">
                <?php
                    //get all the members in database except the admins
                    $stmt= $db->prepare("SELECT * FROM user  $query ORDER BY UserId DESC");
                    // execute the statement
                    $stmt->execute();
                    //assign to a variable
                    $rows = $stmt->fetchAll();
                ?>
                <thead>
                    <tr>
                        <th scope="col"><?php echo lang('ID') ; ?></th>
                        <th scope="col"><?php echo lang('USERNAME') ; ?></th>
                        <th scope="col"><?php echo lang('EMAIL') ; ?></th>
                        <th scope="col"><?php echo lang('FULLNAME') ; ?></th>
                        <th scope="col"> <?php echo lang('REGISTER DATE') ; ?></th>
                        <th scope="col"><?php echo lang('CONTROL') ; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($rows as $row){
                        echo "<tr>";
                        echo "<td>" . $row['UserId'] . "</td>";
                        echo "<td>" .$row['UserName']. "</td>";
                        echo "<td>" .$row['Email']. "</td>";
                        echo "<td>" .$row['Fullname']. "</td>";
                        echo "<td>" .$row['RegDate']. "</td>";
                    ?>
                        <td>
                                <a href="?do=Edit&userid=<?php echo $row['UserId']; ?>" class="btn btn-success bmanage"> <i class="fas fa-edit"></i> <?php echo lang('EDIT'); ?></a>
                                <a href="?do=Delete&userid=<?php echo $row['UserId']; ?>" class="btn btn-danger bmanage confirm"> <i class="fas fa-user-minus"></i> <?php echo lang('DELETE'); ?></a>
                                <a href="comments.php?do=Manage3&userid=<?php echo $row['UserId']; ?>" class="btn btn-info bmanage "> <i class="fas fa-eye"></i> <?php echo lang('SHOW COMMENTS'); ?></a>
                                <?php 
                                if($row['RegStatus'] == 0){?>
                                    <a href="?do=Activate&userid=<?php echo $row['UserId']; ?>" class="btn btn-warning bmanage "> <i class="fab fa-angellist"></i> <?php echo lang('ACTIVE'); ?></a>
                                    <?php
                                }?>
                        </td>
                    <?php
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <a href='?do=Add' class="btn btn-primary btn-md"> <i class="fas fa-user-plus"></i><?php echo " ". lang('ADD_MEMBER'); ?> </a>
        </div>
        <?PHP
    }elseif($do == 'Add'){
        //Add page
        ?>
        <h2 class="text-center hedit"><?php echo lang('ADD MEMBER'); ?></h2>
        <div class="container">
        <form class="edit" action="?do=Insert" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><?php echo lang('USERNAME'); ?></label>
                <div class="col-sm-10 ">
                    <input type="text" name="username"  class="form-control editInput"  autocomplete="off" required="required" placeholder="<?php echo lang('PLACEHOLDER2');?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><?php echo lang('PASSWORD'); ?></label>
                <div class="col-sm-10 ">
                    <input type="password" name="password" class="form-control editInput password" autocomplete="new-password" required=required
                    placeholder="<?php echo lang('PLACEHOLDER3');?>">
                    <i class="fas fa-eye show-pass"></i>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><?php echo lang('EMAIL'); ?></label>
                <div class="col-sm-10 ">
                    <input type="email" name="email"  class="form-control editInput" autocomplete="off" required="required" placeholder="<?php echo lang('PLACEHOLDER4');?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><?php echo lang('FULLNAME'); ?></label>
                <div class="col-sm-10">
                    <input type="text" name="fullname"  class="form-control editInput" autocomplete="off" required="required" placeholder="<?php echo lang('PLACEHOLDER5');?> ">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-sm-2 col-form-label"><?php echo lang('IMAGE'); ?></label><br>
                <div class="col-sm-10">
                    <input type="file"  name="avatar" required  class="form-control-file " autocomplete="off"  id="" >
                </div>
            </div>
            <input type="submit" class="btn btn-primary mx-auto bedit " value="<?php echo lang('ADD MEMBER'); ?>">
        </form>
        </div>
        <?php
    }elseif($do == "Insert"){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
            //GET THE VARIABLES
            ?><h2 class='text-center hedit'><?php echo lang('INSERT_MEMBER') ;?></h2>
            <?php
            $user       = $_POST['username'];
            $pass       =$_POST['password'];
            $email      = $_POST['email'];
            $name       = $_POST['fullname'];

            $hashpass  =sha1($pass); //el sha1 l empty string leha kema thabta
            // password trick
            //upload variables
            $avatar     = $_FILES['avatar'];
            $avatarName = $avatar['name'];
            $avatarSize = $avatar['size'];
            $avatarTmp  = $avatar['tmp_name'];
            $avatarType = $avatar['type'];

            $allowedExtensions = array("jpeg" ,"jpg","png" ,"gif");
            $getExtensions = explode(".",$avatarName);
            $gExtensions = strToLower(end($getExtensions));
            
            $form_errors = array();
            echo "<div class='container errorsMember' >";
            
            // validate the form
            if(strlen($user) < 4){
                $form_errors[] = lang('error1');
            }
            if(strlen($user) > 20){
                $form_errors[] = lang('error6');
            }
            if (empty($user)){
                $form_errors[] = lang('error2');
            }
            if (empty($pass)){
                $form_errors[] = lang('error7');
            }
            if (empty($email)){
                $form_errors[] = lang('error3');
            }
            if (empty($name)){
                $form_errors[] = lang('error4');
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
            foreach($form_errors as $error){
                echo $error ;
            }

            // UPDATE THE DATA WITH THIS INFO
            //check if there is no error
            if(empty($form_errors)){
                $image = rand(0 ,1000000) . "_" .$avatarName;
                move_uploaded_file($avatarTmp , "Uploads\Avatar\\".$image);
                // check if the UserNme is Unique
                $check1 = checkItem('UserName','user',$user);
                if( $check1 == 1){
                    $theMsg1 = "<div class='container alert alert-danger'>". lang('CHECK1') ."</div> ";
                    Home_Redirect($theMsg1,'back');
                }else{
                    $stmt =$db->prepare("INSERT INTO user(UserName ,password ,Email ,Fullname,RegStatus ,RegDate ,Image) 
                                            VALUES (:zuser , :zpass , :zmail , :zname , 1 ,now() , :zimage) /*regstatus 1 laen el admin hwa ellly daifh*/
                                            ");
                    $stmt->execute(array(
                        'zuser'     => $user,
                        'zpass'     => $hashpass,
                        'zmail'     => $email,
                        'zname'     => $name,
                        'zimage'    => $image
                    ));
                    //success message
                    if($stmt->rowCount() == 0){
                        $theMsg1 = "<div class='container alert alert-danger'>". $stmt->rowCount() ." Record Inseted </div>";
                        Home_Redirect($theMsg1 , 'back');    
                    }else{
                        $theMsg2 = "<div class='container alert alert-success'>". $stmt->rowCount() ." Record Inserted </div>"; 
                        Home_Redirect($theMsg2 , 'Custom');       
                    }
                }
            }
        }else{
            $theMsg = "<div class='alert alert-danger'>Sorry,This page Isn't Allowed directly </div>";
            Home_Redirect($theMsg); //m4 htnf3 hena 34an mfe4 back aslan
        }
        echo "</div>";
    }elseif($do == 'Edit'){
        $userid= isset($_GET['userid'])&& is_numeric($_GET['userid'])?intval($_GET['userid']):0; //new if [condition?true:false]
        $stmt = $db->prepare(" SELECT * from user WHERE UserId=? Limit 1"); 
        $stmt->execute(array($userid));
        $row =$stmt->fetch(); //hyrg3le el data elly na gebtha bel select 3la hiaet array
        $count = $stmt->rowCount();
        if($count > 0){?>
            <h2 class="text-center hedit"><?php echo lang('EDIT MEMBER'); ?></h2>
            <div class="container">
            <form class="edit" action="?do=update" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo lang('USERNAME'); ?></label>
                    <div class="col-sm-10 ">
                        <input type="text" name="username" value="<?php echo $row['UserName'];?>" class="form-control editInput"  autocomplete="off" required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo lang('PASSWORD'); ?></label>
                    <div class="col-sm-10 ">
                        <input type="hidden" name="oldpassword" value="<?php echo $row['password'];?>">
                        <input type="password" name="newpassword" class="form-control editInput" autocomplete="new-password" placeholder="<?php echo lang('PLACEHOLDER1')?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo lang('EMAIL'); ?></label>
                    <div class="col-sm-10 ">
                        <input type="email" name="email" value="<?php echo $row['Email'];?>" class="form-control editInput" autocomplete="off" required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo lang('FULLNAME'); ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="fullname" value="<?php echo $row['Fullname'];?>" class="form-control editInput" autocomplete="off" required="required" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo lang('IMAGE'); ?></label>
                    <div class="col-sm-10">
                        <input type="file"  name="hossam" required  class="form-control-file editInput" required >
                    </div>
                </div>
                <input type="submit" class="btn btn-primary mx-auto bedit " value="<?php echo lang('SAVE'); ?>">
            </form>
            </div>
        <?php
            }else{
                echo "<div class= 'container'>";
                $errorMsg = "<div class= 'alert alert-danger' >There Is No Such ID</div>";
                echo "</div>";
                Home_Redirect($errorMsg);
            }
    }elseif($do == 'update'){?>
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            ?>
            <h2 class='text-center hedit'><?php echo lang('UPDATE_MEMBER') ;?></h2>
            <?php
            //GET THE VARIABLES
            $id         = $_POST['userid'];
            $user       = $_POST['username'];
            $email      = $_POST['email'];
            $name       = $_POST['fullname'];

            $avatar     = $_FILES['hossam'];
            $avatarName = $avatar['name'];
            $avatarSize = $avatar['size'];
            $avatarTmp  = $avatar['tmp_name'];
            $avatarType = $avatar['type'];

            $allowedExtensions = array("jpeg" ,"jpg","png" ,"gif");
            $getExtensions = explode(".",$avatarName);
            $gExtensions = strToLower(end($getExtensions));
            // password trick
            //condition ? true : false
            $pass = "";
            $form_errors = array();
            echo "<div class='container errorsMember' >";

            if(empty($_POST['newpassword'])){
                $pass = $_POST['oldpassword'];
            }elseif (strlen($_POST['newpassword']) < 6){
                $form_errors[] = lang('error5');
            }else{
                $pass= sha1($_POST['newpassword']) ;
            }
            // validate the form
            if(strlen($user) < 4){
                $form_errors[] = lang('error1');
            }
            if(strlen($user) > 20){
                $form_errors[] = lang('error6');
            }
            if (empty($user)){
                $form_errors[] = lang('error2');;
            }
            if (empty($email)){
                $form_errors[] = lang('error3');;
            }
            if (empty($name)){
                $form_errors[] = lang('error4');;
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
            foreach($form_errors as $error){
                echo $error ;
            }

            // UPDATE THE DATA WITH THIS INFO
            //check if there is no error
            if(empty($form_errors)){
                $image = rand(0 ,1000000) . "_" .$avatarName;
                move_uploaded_file($avatarTmp , "Uploads\Avatar\\".$image);
                $stmt2 = $db-> prepare("SELECT * FROM user WHERE UserName=? AND UserId !=?");
                $stmt2->execute(array($user,$id));
                $count =$stmt2->rowCount();
                if($count > 0){
                    $theMsg1 =  "<div class='container alert alert-danger'> This Name Is Exist </div>";
                    Home_Redirect($theMsg1,'back');
                }else{

                    $stmt= $db->prepare('UPDATE user SET UserName = ? ,Email = ? ,Fullname = ? ,password = ? , Image =? WHERE UserId = ?');
                    $stmt->execute(array($user,$email,$name,$pass,$image,$id));
                    //success message
                    if($stmt->rowCount() == 0){
                        $theMsg1 =  "<div class='container alert alert-danger'>". $stmt->rowCount() ." Record Updated </div>";
                        Home_Redirect($theMsg1,'back');    
                    }else{
                        $theMsg2 = "<div class='container alert alert-success'>". $stmt->rowCount() ." Record Updated </div>";
                        Home_Redirect($theMsg2,'back');        
                    }
                }
            }
        }else{
            $errorMsg = "<div class='alert alert-danger'>Sorry,This page Isn't Allowed directly</div>";
            Home_Redirect($errorMsg);
        }
        echo "</div>";
    }elseif($do == 'Delete'){
        //Delete Page
        ?>
        <h1 class="text-center"><?php echo lang('DELETE MEMBER'); ?></h1>
        <div class="container">
        <?php
            $userid= isset($_GET['userid'])&& is_numeric($_GET['userid'])?intval($_GET['userid']):0; //new if [condition?true:false]
            $stmt = $db->prepare(" SELECT * from user WHERE UserId=? Limit 1"); 
            $stmt->execute(array($userid));
            $count = $stmt->rowCount();
            if($count > 0){
                $stmt = $db->prepare('DELETE FROM user WHERE UserId = :zuser '); //method 3 for selection
                $stmt->bindParam(":zuser" ,$userid );
                $stmt->execute();
                $theMsg = "<div class='container alert alert-success'>". $stmt->rowCount() ." Record Deleted </div>"; 
                Home_Redirect($theMsg, 'Custom');   
            }else{
                $theMsg2 = "<div class='container alert alert-danger'>This Id doesn't exist</div>";
                Home_Redirect($theMsg2);
            }
        ?>
        </div>
        <?php
    }
    elseif($do == 'Activate'){
        //Delete Page
        ?>
        <h1 class="text-center"><?php echo lang('ACTIVATE MEMBER'); ?></h1>
        <div class="container">
        <?php
            $userid= isset($_GET['userid'])&& is_numeric($_GET['userid'])?intval($_GET['userid']):0; //new if [condition?true:false]
            $stmt = $db->prepare(" SELECT * from user WHERE UserId=? Limit 1"); 
            $stmt->execute(array($userid));
            $count = $stmt->rowCount();
            if($count > 0){
                $stmt = $db->prepare(" UPDATE user SET RegStatus = 1 WHERE UserId =?"); 
                $stmt->execute(array($userid));
                $theMsg = "<div class='container alert alert-success'>". $stmt->rowCount() ." Record Activated </div>"; 
                Home_Redirect($theMsg, 'Custom');   
            }else{
                $theMsg2 = "<div class='container alert alert-danger'>This Id doesn't exist</div>";
                Home_Redirect($theMsg2);
            }
        ?>
        </div>
        <?php
    }
    include $tbl."footer.php";
}else{
    //echo "You Are Not Authorized To View This Page";
    header('Location:index.php');
    exit();
}
ob_end_flush();
/*
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
*/