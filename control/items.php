<?php
ob_start();
session_start();
$pageTitle = "Items";
if(isset($_SESSION['username'])){
    include "init.php";
    $do=isset($_GET['do'])?$_GET['do']:'Manage';
    if ($do == 'Manage'){
        ?>
        <h1 class="text-center"><?php echo lang('MANAGE ITEMS'); ?></h1>
        <div class="container">
            <table class="table table-light table-bordered table-responsive-sm table-hover text-center ">
                <?php
                    //get all the members in database except the admins
                    $stmt= $db->prepare("SELECT
                                                items.* ,
                                                categories.Name AS Category_Name ,
                                                user.UserName As Client_Name 
                                        FROM 
                                                `items` 
                                        INNER JOIN 
                                                categories 
                                        ON  
                                                categories.Id = items.Cat_Id
                                        INNER JOIN 
                                                user
                                        ON 
                                                user.UserId = items.Member_id
                                        ORDER BY Items_Id DESC;
                     ");
                    // execute the statement
                    $stmt->execute();
                    //assign to a variable
                    $items = $stmt->fetchAll();
                ?>
                <thead>
                    <tr>
                        <th scope="col"><?php echo lang('ID') ; ?></th>
                        <th scope="col"><?php echo lang('NAME') ; ?></th>
                        <th scope="col"><?php echo lang('DESCRIPTION') ; ?></th>
                        <th scope="col"><?php echo lang('PRICE') ; ?></th>
                        <th scope="col"> <?php echo lang('ADDING DATE') ; ?></th>
                        <th scope="col"><?php echo lang('COUNTRY MADE') ; ?></th>
                        <th scope="col"><?php echo lang('STATUS') ; ?></th>
                        <th scope="col"><?php echo lang('RATING') ; ?></th>
                        <th scope="col"><?php echo lang('CATEGORY') ; ?></th>
                        <th scope="col"><?php echo lang('CLIENTNAME') ; ?></th>
                        <th scope="col"><?php echo lang('CONTROL') ; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($items as $item){
                        echo "<tr>";
                        echo "<td>" . $item['Items_Id'] . "</td>";
                        echo "<td>" .$item['Name']. "</td>";
                        echo "<td>" .$item['Description']. "</td>";
                        echo "<td>" .$item['Price']. "</td>";
                        echo "<td>" .$item['Add_Date']. "</td>";
                        echo "<td>" .$item['Country_Made']. "</td>";
                        echo "<td>" .$item['Status']. "</td>";
                        echo "<td>" .$item['Rating']. "</td>";
                        echo "<td>" .$item['Category_Name']. "</td>";
                        echo "<td>" .$item['Client_Name']. "</td>";
                    ?>
                        <td>
                                <a href="items.php?do=Edit&itemid=<?php echo $item['Items_Id']; ?>" class="btn btn-success bmanage"> <i class="fas fa-edit"></i> <?php echo lang('EDIT'); ?></a>
                                <a href="items.php?do=Delete&itemid=<?php echo $item['Items_Id']; ?>" class="btn btn-danger bmanage confirm"> <i class="fas fa-user-minus"></i> <?php echo lang('DELETE'); ?></a>
                                <a href="comments.php?do=Manage2&itemid=<?php echo $item['Items_Id']; ?>" class="btn btn-info bmanage "> <i class="fas fa-eye"></i> <?php echo lang('SHOW COMMENTS'); ?></a>

                                <?php 
                                
                                if($item['Approve'] == 0){?>
                                    <a href="?do=Approve&itemid=<?php echo $item['Items_Id']; ?>" class="btn btn-warning bmanage "> <i class="fas fa-check"></i> <?php echo lang('APPROVE'); ?></a>
                                    <?php
                                }
                                ?>
                        </td>
                    <?php
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <a href='?do=Add' class="btn btn-primary btn-md"> <i class="fas fa-plus"></i><?php echo " ". lang('ADD ITEM'); ?> </a>
        </div>
        <?PHP
    }elseif ($do =='Add'){
        ?>
        <h2 class="hedit text-center hitem"><?php echo lang('ADD NEW ITEMS'); ?></h2>
        <div class="container">
        <form class="eitem" action="?do=Insert" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-md-2 col-form-label" > <?php echo lang('NAME'); ?></label>
                <div class="col-md-10">
                    <input class="form-control editInput" type="text" name="name"  placeholder="<?php echo lang('PLACEHOLDER9'); ?>" required = "required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label" > <?php echo lang('DESCRIPTION'); ?></label>
                <div class="col-md-10">
                    <input class=" form-control editInput" type="text" name="description" placeholder="<?php echo lang('PLACEHOLDER10'); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label" > <?php echo lang('TAGS'); ?></label>
                <div class="col-md-10">
                    <input class=" form-control editInput" type="text" name="tags" placeholder="<?php echo lang('PLACEHOLDER20'); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label" > <?php echo lang('PRICE'); ?></label>
                <div class="col-md-10">
                    <input class=" form-control editInput" type="text" name="price" placeholder="<?php echo lang('PLACEHOLDER11'); ?>" required = "required" >
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label" > <?php echo lang('COUNTRY'); ?></label>
                <div class="col-md-10">
                    <input class=" form-control editInput" type="text" name="country" placeholder="<?php echo lang('PLACEHOLDER12'); ?>" required = "required">
                </div>
            </div>
            <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo lang('IMAGE'); ?></label>
                    <div class="col-sm-10">
                        <input type="file"  name="avatar" required  class="form-control-file editInput" autocomplete="off"  id="" >
                    </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label" > <?php echo lang('STATUS'); ?></label>
                <div class="col-md-10">
                    <select class="form-control" name='status'>
                        <option value="0">...</option>
                        <option value="1"><?php echo lang('NEW'); ?></option>
                        <option value="2"><?php echo lang('LIKE NEW'); ?></option>
                        <option value="3"><?php echo lang('USED'); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label" > <?php echo lang('MEMBERS'); ?></label>
                <div class="col-md-10">
                    <select class="form-control" name='members'>
                        <option value="0">...</option>
                        <?php
                            $allMembers = getAll("*" , "user" ,"WHERE RegStatus = 1" ,"UserId");
                            foreach($allMembers as $user){
                                echo "<option value='" .$user['UserId'] . "'>" .$user['UserName'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label" > <?php echo lang('categories'); ?></label>
                <div class="col-md-10">
                    <select class="form-control" name='categories'>
                        <option value="0">...</option>
                        <?php
                            $all_cats = getAll("*" , "categories" ,"WHERE Parent = 0" ,"Id");
                            foreach($all_cats as $cat){
                                echo "<option value='" .$cat['Id'] . "'>" .$cat['Name'] . "</option>";
                                $child_cats = getAll("*" , "categories" ,"WHERE Parent = {$cat['Id']}" ,"Id");
                                foreach ($child_cats as $child){
                                    echo "<option value='" .$child['Id'] . "'> ->>" .$child['Name'] . "</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>
            <input type="submit" class="btn btn-primary mx-auto bedit " value="<?php echo lang('ADD ITEMS'); ?>">
        </form>
    </div>
    <?php
    }elseif ($do =='Insert'){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //GET THE VARIABLES
            ?><h2 class='text-center hedit'><?php echo lang('INSERT ITEMS') ;?></h2>
            <?php
            $name       = $_POST['name'];
            $desc       = $_POST['description'];
            $tags       = $_POST['tags'];
            $price      = $_POST['price'];
            $country    = $_POST['country'];
            $status     = $_POST['status'];
            $members    = $_POST['members'];
            $cat        = $_POST['categories'];

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
            if (empty($name)){
                $form_errors[] = lang('error9');
            }
            if (empty($price)){
                $form_errors[] = lang('error10');
            }
            if (empty($country)){
                $form_errors[] = lang('error11');
            }
            if ($status == 0){
                $form_errors[] = lang('error12');
            }
            if ($members == 0){
                $form_errors[] = lang('error13');
            }
            if ($cat == 0){
                $form_errors[] = lang('error14');
            }
            if(strlen($name) <3){
                $form_errors[] = "The Item Name Can't Be Less Than 3 Charcters";
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
                $stmt =$db->prepare("INSERT INTO items(Name ,Description , Image ,Tags ,Price ,Country_Made, Status ,Cat_Id ,Member_Id ,Add_Date ,Approve) 
                                        VALUES (:zname , :zdesc , :zimage , :ztags , :zprice , :zcountry , :zstatus , :zcat , :zmem ,now() ,1) /*regstatus 1 laen el admin hwa ellly daifh*/
                                        ");
                $stmt->execute(array(
                    'zname'     => $name,
                    'zdesc'     => $desc,
                    'zimage'    => $image,
                    'ztags'     => $tags,
                    'zprice'    => $price,
                    'zcountry'  => $country,
                    'zstatus'   => $status,
                    'zcat'      => $cat,
                    'zmem'      => $members,
                ));
                //success message
                if($stmt->rowCount() == 0){
                    $theMsg1 = "<div class='container alert alert-danger'>". $stmt->rowCount() ." Record Inseted </div>";
                    Home_Redirect($theMsg1 , 'back');    
                }else{
                    $theMsg2 = "<div class='container alert alert-success'>". $stmt->rowCount() ." Record Inserted </div>"; 
                    Home_Redirect($theMsg2 , 'Custom3');       
                }
            }
        }else{
            $theMsg = "<div class='alert alert-danger'>Sorry,This page Isn't Allowed directly </div>";
            Home_Redirect($theMsg); //m4 htnf3 hena 34an mfe4 back aslan
        }
        echo "</div>";
    }elseif ($do == 'Edit'){
        $item_id = (isset($_GET['itemid'])&& is_numeric($_GET['itemid']))? intval($_GET['itemid']): 0;
        global $db;
        $stmt2 = $db->prepare("SELECT * FROM items where Items_id =?");
        $stmt2->execute(array($item_id));
        $item =$stmt2->fetch();
        $count2 = $stmt2->rowCount();
        if($count2 > 0){?>
            <h2 class="hedit text-center hitem"><?php echo lang('EDIT ITEM'); ?></h2>
            <div class="container">
            <form class="eitem" action="?do=Update" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="itemid" value="<?php echo $item_id; ?>">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" > <?php echo lang('NAME'); ?></label>
                    <div class="col-md-10">
                        <input class="form-control editInput" type="text" name="name" placeholder="<?php echo lang('PLACEHOLDER9'); ?>" required = "required" value="<?php echo $item['Name'];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" > <?php echo lang('DESCRIPTION'); ?></label>
                    <div class="col-md-10">
                        <input class=" form-control editInput" type="text" name="description" placeholder="<?php echo lang('PLACEHOLDER10'); ?>" value="<?php echo $item['Description'];?>">
                    </div>
                </div>
                <div class="form-group row">
                <label class="col-md-2 col-form-label" > <?php echo lang('TAGS'); ?></label>
                <div class="col-md-10">
                    <input class=" form-control editInput" type="text" name="tags" placeholder="<?php echo lang('PLACEHOLDER20'); ?>" value="<?php echo $item['Tags'];?>">
                </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" > <?php echo lang('PRICE'); ?></label>
                    <div class="col-md-10">
                        <input class=" form-control editInput" type="text" name="price" placeholder="<?php echo lang('PLACEHOLDER11'); ?>" required = "required" value="<?php echo $item['Price'];?>" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" > <?php echo lang('COUNTRY'); ?></label>
                    <div class="col-md-10">
                        <input class=" form-control editInput" type="text" name="country" placeholder="<?php echo lang('PLACEHOLDER12'); ?>" required = "required" value="<?php echo $item['Country_Made'];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo lang('IMAGE'); ?></label>
                    <div class="col-sm-10">
                        <input type="file"  name="avatar" required  class="form-control-file editInput" autocomplete="off"  id="" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" > <?php echo lang('STATUS'); ?></label>
                    <div class="col-md-10">
                        <select class="form-control" name='status'>
                            <option value="1" <?php if ($item['Status'] == 1){ echo "Selected";}?>><?php echo lang('NEW'); ?></option>
                            <option value="2" <?php if ($item['Status'] == 2){ echo "Selected";}?>><?php echo lang('LIKE NEW'); ?></option>
                            <option value="3" <?php if ($item['Status'] == 3){ echo "Selected";}?>><?php echo lang('USED'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" > <?php echo lang('MEMBERS'); ?></label>
                    <div class="col-md-10">
                        <select class="form-control" name='members'>
                            <?php
                                $stmt =$db->prepare("SELECT * FROM user");
                                $stmt->execute();
                                $users = $stmt->fetchAll();
                                foreach($users as $user){
                                    echo "<option value='" .$user['UserId'] ."'";
                                    if ($item['Member_id'] == $user['UserId']){ echo "selected";};
                                    echo ">" .$user['UserName'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" > <?php echo lang('categories'); ?></label>
                    <div class="col-md-10">
                        <select class="form-control" name='categories'>
                            <?php
                                $stmt2 =$db->prepare("SELECT * FROM categories");
                                $stmt2->execute();
                                $cats = $stmt2->fetchAll();
                                foreach($cats as $cat){
                                    echo "<option value='" .$cat['Id'] . "'";
                                    if ($item['Cat_Id'] == $cat['Id']){ echo "selected";};
                                    echo ">" . $cat['Name'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary mx-auto bedit " value="<?php echo lang('SAVE ITEM'); ?>">
            </form>
        </div> 
    <?php
        }else{
            echo "<div class= 'container'>";
            $errorMsg = "<div class= 'alert alert-danger' >There Is No Such ID</div>";
            echo "</div>";
            Home_Redirect($errorMsg);
        }

    }elseif ($do == 'Update'){
        ?><h2 class='text-center hedit'><?php echo lang('INSERT ITEMS') ;?></h2>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id         = $_POST['itemid'];
                $name       = $_POST['name'];
                $desc       = $_POST['description'];
                $tags       = $_POST['tags'];
                $price      = $_POST['price'];
                $country    = $_POST['country'];
                $status     = $_POST['status'];
                $members    = $_POST['members'];
                $cat        = $_POST['categories'];

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
            if (empty($name)){
                $form_errors[] = lang('error9');
            }
            if (empty($price)){
                $form_errors[] = lang('error10');
            }
            if (empty($country)){
                $form_errors[] = lang('error11');
            }
            if ($status == 0){
                $form_errors[] = lang('error12');
            }
            if ($members == 0){
                $form_errors[] = lang('error13');
            }
            if ($cat == 0){
                $form_errors[] = lang('error14');
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
                $stmt =$db->prepare("UPDATE items SET Name=? , Description =? , Image = ? , Tags = ? , Price =? , Country_Made =? , Status =? , Cat_ID =? , Member_id =? where Items_Id =? ");
                $stmt->execute(array($name , $desc , $image , $tags ,$price ,$country ,$status ,$cat ,$members ,$id));
                //success message
                if($stmt->rowCount() == 0){
                    $theMsg1 = "<div class='container alert alert-danger'>". $stmt->rowCount() ." Record Updated </div>";
                    Home_Redirect($theMsg1 , 'back');    
                }else{
                    $theMsg2 = "<div class='container alert alert-success'>". $stmt->rowCount() ." Record Updated </div>"; 
                    Home_Redirect($theMsg2 , 'back');       
                }
            }
            
        }else{
            $theMsg = "<div class='alert alert-danger'>Sorry,This page Isn't Allowed directly </div>";
            Home_Redirect($theMsg); //m4 htnf3 hena 34an mfe4 back aslan
        }
        echo "</div>";

    }elseif ($do == 'Delete'){
        ?>
        <h1 class="text-center"><?php echo lang('DELETE ITEM'); ?></h1>
        <div class="container">
        <?php
            $item_id= isset($_GET['itemid'])&& is_numeric($_GET['itemid'])?intval($_GET['itemid']):0; //new if [condition?true:false]
            $stmt = $db->prepare(" SELECT * from items WHERE Items_Id=?"); 
            $stmt->execute(array($item_id));
            $count = $stmt->rowCount();
            if($count > 0){
                $stmt = $db->prepare('DELETE FROM items WHERE Items_Id = :zitem '); //method 3 for selection
                $stmt->bindParam(":zitem" ,$item_id );
                $stmt->execute();
                $theMsg = "<div class='container alert alert-success'>". $stmt->rowCount() ." Record Deleted </div>"; 
                Home_Redirect($theMsg, 'Custom3');   
            }else{
                $theMsg2 = "<div class='container alert alert-danger'>This Id doesn't exist</div>";
                Home_Redirect($theMsg2);
            }
        ?>
        </div>
        <?php

    }elseif($do == 'Approve'){
        ?>
        <h1 class="text-center"><?php echo lang('APPROVE ITEM'); ?></h1>
        <div class="container">
        <?php
            $item_id= isset($_GET['itemid'])&& is_numeric($_GET['itemid'])?intval($_GET['itemid']):0; //new if [condition?true:false]
            $stmt = $db->prepare(" SELECT * from items WHERE Items_Id=? Limit 1"); 
            $stmt->execute(array($item_id));
            $count = $stmt->rowCount();
            if($count > 0){
                $stmt = $db->prepare(" UPDATE items SET Approve = 1 WHERE Items_Id =?"); 
                $stmt->execute(array($item_id));
                $theMsg = "<div class='container alert alert-success'>". $stmt->rowCount() ." Record Approved </div>"; 
                Home_Redirect($theMsg, 'Custom3');   
            }else{
                $theMsg2 = "<div class='container alert alert-danger'>This Id doesn't exist</div>";
                Home_Redirect($theMsg2);
            }
        ?>
        </div>
        <?php
    }
    include $tbl . 'footer.php';
}else{
    header('Location:index.php');
    exit();
}
ob_end_flush();

//TABLE EL ITEMS 34AN MKN4 MARBOT B7AGA FLAZEM TFDEH EL AWEL 2BL EL FOREIGN KEY