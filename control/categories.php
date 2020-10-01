<?php
ob_start();
session_start();
if(isset($_SESSION['username'])){
    $pageTitle = "Categories";
    include "init.php";
    $do=isset($_GET['do'])?$_GET['do']:'Manage';
    if ($do == 'Manage'){
        $sort = "ASC";
        $sort_array = array("ASC" , "DESC");
        if(isset($_GET['sort']) && in_array($_GET['sort'],$sort_array)){
            $sort =$_GET['sort'];
        }
        $stmt2 =$db->prepare("SELECT * FROM categories where Parent = 0 ORDER BY ordering $sort");
        $stmt2->execute();
        $cats =$stmt2->fetchAll();
        ?>
            <h1 class="text-center hedit"><?php echo lang('MANAGE CATEGORIES'); ?></h1>
            <div class="container latest">
                <div class="panel panel-default">
                    <div class="panel-heading phead_cat">
                        <div class="row">
                            <div class="col-sm-3 ">
                                <h4 class="hcat">
                                <?php echo lang('MANAGE CATEGORIES'); ?> 
                                </h4>
                            </div>
                            <div class="col-sm-4  ">
                                <a class="btn btn-sm btn-primary float-right" href="?do=Add"><i class="fa fa-plus"></i><?php echo lang('ADD NEW CATEGORY'); ?></a>
                            </div>
                            <div class="ordering offset-2 col-sm-3  ">
                                <i class="fa fa-sort"></i><span> <?php echo lang('ORDERING');?>  </span>  
                                <a class="btn btn-sm btn-success" href="?sort=ASC"><?php echo lang('ASC');?></a>
                                <a class="btn btn-sm btn-warning"  href="?sort=DESC"><?php echo lang('DESC');?></a>
                            </div>
                        </div>
                        <div class="panel-body categories">
                            <?php
                                foreach($cats as $cat){
                                    echo "<div class='cat'>";
                                        echo "<div class='hidden-btn'>";
                                            echo "<a href='categories.php?do=Edit&catid=" . $cat['Id'] . "' class='btn btn-outline-primary btn-sm '><i class='fas fa-edit'></i>". lang('EDIT') . "</a>";
                                            echo "<a href='categories.php?do=Delete&catid=" . $cat['Id'] . "' class='btn btn-outline-danger btn-sm'><i class='fas fa-trash'></i>" . lang('DELETE') . "</a>";
                                        echo "</div>";
                                        echo "<h3>". $cat['Name'] ."</h3>";
                                        echo "<p>" ; if(empty($cat['Description'])){ echo "This Category Has No Description";}else{echo $cat['Description'] ;};echo "</p>";
                                        $subCats = getAll("*" , "categories" , "WHERE Parent = {$cat['Id']}" ,"Id");
                                        if (! empty($subCats)){?>
                                            <h4 class='h-child-cats'>Child Categories: </h4>
                                            <?php
                                            foreach($subCats as $c){?>
                                                <?php
                                                echo "<div class='subcats'>";
                                                    echo "<span class='child-cats'>" . $c['Name'] . "</span>";
                                                    echo "<div class='h-btn'>";
                                                        echo "<a href='categories.php?do=Edit&catid=" . $c['Id'] . "' class='btn btn-outline-primary btn-sm '><i class='fas fa-edit'></i>". lang('EDIT') . "</a>";
                                                        echo "<a href='categories.php?do=Delete&catid=" . $c['Id'] . "' class='btn btn-outline-danger btn-sm'><i class='fas fa-trash'></i>" . lang('DELETE') . "</a>";
                                                    echo "</div>";
                                                echo "</div>";
                                            }?>
                                            
                                        <?php   
                                        }
                                        if($cat['Visibility'] == 1){ echo "<span class='btn btn-success'>" . "<i class='fas fa-eye'></i>" . lang('VISIBLE'). "</span>";}
                                        else{echo "<span class='btn btn-secondary'>" . "<i class='fas fa-eye-slash'></i>" .lang('HIDDEN') . "</span>";};
                                        if($cat['Allow_Comments'] == 1){ echo "<span class='btn btn-primary'>" . "<i class='fas fa-comments'></i>" . lang('ALLOW COMMENTS'). "</span>";}
                                        else{echo "<span class='btn btn-danger'>" . "<i class='fas fa-comment-slash'></i>" . lang('DISALLOW COMMENTS') . "</span>";};
                                        if($cat['Allow_Comments'] == 1){ echo "<span class='btn btn-warning'>" . "<i class='fas fa-ad'></i>" . lang('ALLOW ADS'). "</span>";}
                                        else{echo "<span class='btn btn-dark'>" .  lang('DISALLOW ADS') ."</span>";};
                                        echo "</div>";
                                    echo "<hr>";
                                    
                                }
                            ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        <?php
    }elseif ($do =='Add'){?>
    <h2 class="hedit text-center"><?php echo lang('ADD NEW CATEGORY'); ?></h2>
    <div class="container">
        <form class="edit" action="?do=Insert" method="POST">
            <div class="form-group row">
                <label class="col-md-2 col-form-label" > <?php echo lang('NAME'); ?></label>
                <div class="col-md-10">
                    <input class="form-control editInput" type="text" name="name" required = "required" autocomplete="off"  placeholder="<?php echo lang('PLACEHOLDER6'); ?> ">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label" > <?php echo lang('DESCRIPTION'); ?></label>
                <div class="col-md-10">
                    <input class=" form-control editInput" type="text" name="describtion" autocomplete="off" placeholder="<?php echo lang('PLACEHOLDER7'); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label" > <?php echo lang('ORDERING'); ?></label>
                <div class="col-md-10">
                    <input class=" form-control editInput" type="text" name="ordering"  placeholder="<?php echo lang('PLACEHOLDER8'); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label" > <?php echo lang('PARENT'); ?></label>
                <div class="col-md-10 ">
                    <select class="form-control"  name="parent" id="">
                        <?php
                            $allCats = getAll( "*" ,"categories","WHERE Parent = 0" ,"Id" );
                        ?>
                        <option value ="0"> None</option>
                        <?php
                        foreach( $allCats as $cat){?>
                        <option value="<?php echo $cat['Id'];?>"><?php echo $cat['Name'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label" > <?php echo lang('VISIBILITY'); ?></label>
                <div class="form-check  ">
                    <input class="form-check-input " type="radio" name="visibililty" id="vis-yes" value="1" checked>
                    <label class="form-check-label" for="vis-yes"><?php echo lang('YES'); ?></label>
                </div>
                <div class="form-check ">
                    <input class="form-check-input " type="radio" name="visibililty" id="vis-No" value="0" >
                    <label class="form-check-label" for="vis-No"><?php echo lang('NO'); ?></label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4" > <?php echo lang('ALLOW COMMENTS'); ?></label>
                <div class="form-check  ">
                    <input class="form-check-input " type="radio" name="allow-comments" id="com-yes" value="1" checked>
                    <label class="form-check-label" for="com-yes"><?php echo lang('YES'); ?></label>
                </div>
                <div class="form-check ">
                    <input class="form-check-input " type="radio" name="allow-comments" id="com-no" value="0" >
                    <label class="form-check-label" for="com-no"><?php echo lang('NO'); ?></label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4" > <?php echo lang('ALLOW ADS'); ?></label>
                <div class="form-check  ">
                    <input class="form-check-input " type="radio" name="ads" id="ads-yes" value="1" checked>
                    <label class="form-check-label" for="ads-yes"><?php echo lang('YES'); ?></label>
                </div>
                <div class="form-check ">
                    <input class="form-check-input " type="radio" name="ads" id="ads-no" value="0" >
                    <label class="form-check-label" for="ads-no"><?php echo lang('NO'); ?></label>
                </div>
            </div>
            <input type="submit" class="btn btn-primary mx-auto bedit " value="<?php echo lang('ADD CATEGORY'); ?>">
        </form>
    </div>
    <?php
    }elseif ($do =='Insert'){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //GET THE VARIABLES
            ?>
            <div class="container">
                <h2 class='text-center hedit'><?php echo lang('INSERT CATEGORY') ;?></h2>
                <?php
                $name           = $_POST['name'];
                if(empty($_POST['describtion'])){
                    $describtion =null;
                }else{
                    $describtion       = $_POST['describtion'];
                }
                if(empty($_POST['ordering'])){
                    $ordering =null;
                }else{
                    $ordering       = $_POST['ordering'];
                }
                $parent         = $_POST ['parent'];
                $visibility     = $_POST['visibililty'];
                $comments       = $_POST['allow-comments'];
                $ads            = $_POST['ads'];

                echo "<div class='container errorsMember' >";
                if(empty($name)){
                    $error10 = lang('error8');
                }
                // validate the form

                // UPDATE THE DATA WITH THIS INFO
                //check if there is no error
                // check if the UserNme is Unique
                if(empty($error10)){
                    $check1 = checkItem('Name','categories',$name);
                    if( $check1 == 1){
                        $theMsg1 = "<div class='container alert alert-danger'>". lang('CHECK3') ."</div> ";
                        Home_Redirect($theMsg1,'back',100);
                    }else{
                        $stmt =$db->prepare("INSERT INTO categories(Name ,Description ,Parent ,Ordering ,Visibility,Allow_Comments ,Allow_Ads) 
                                                VALUES (:zname , :zdesc , :zparent , :zorder , :zvisible , :zcomments , :zads )/*regstatus 1 laen el admin hwa ellly daifh*/
                                                ");
                        $stmt->execute(array(
                            'zname'     => $name,
                            'zdesc'     => $describtion,
                            'zparent'   => $parent,
                            'zorder'    => $ordering,
                            'zvisible'  => $visibility,
                            'zcomments' => $comments,
                            'zads'      => $ads,
                        ));
                        //success message
                        if($stmt->rowCount() == 0){
                            $theMsg1 = "<div class='container alert alert-danger'>". $stmt->rowCount() ." Record Inseted </div>";
                            Home_Redirect($theMsg1,'back');    
                        }else{
                            $theMsg2 = "<div class='container alert alert-success'>". $stmt->rowCount() ." Record Inserted </div>"; 
                            Home_Redirect($theMsg2,'Custom2'); 
                        }      
                    }
                }else{
                            Home_Redirect($error10,'back'); 
                }?>
                </div>
                <?php
        }else{
            ?>
            <div class="container">
            <?php
            $theMsg = "<div class='alert alert-danger'>Sorry,This page Isn't Allowed directly </div>";
            Home_Redirect($theMsg,'back'); //m4 htnf3 hena 34an mfe4 back aslan
            ?>
            </div>
            <?php
        }

    }elseif ($do == 'Edit'){
        $catid= isset($_GET['catid'])&& is_numeric($_GET['catid'])?intval($_GET['catid']):0; //new if [condition?true:false]
        $stmt = $db->prepare(" SELECT * from categories WHERE Id=? Limit 1"); 
        $stmt->execute(array($catid));
        $cat =$stmt->fetch(); //hyrg3le el data elly na gebtha bel select 3la hiaet array
        $count = $stmt->rowCount();
        if($count > 0){?>
            <h2 class="hedit text-center"><?php echo lang('EDIT CATEGORY'); ?></h2>
            <div class="container">
                <form class="edit" action="?do=Update" method="POST">
                    <div class="form-group row">
                        <input type="hidden" name="catid" value="<?php echo $catid; ?>">
                        <label class="col-md-2 col-form-label" > <?php echo lang('NAME'); ?></label>
                        <div class="col-md-10">
                            <input class="form-control editInput" type="text" name="name" value="<?php echo $cat['Name'];?>" required='required' placeholder="<?php echo lang('PLACEHOLDER6'); ?> ">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" > <?php echo lang('DESCRIPTION'); ?></label>
                        <div class="col-md-10">
                            <input class=" form-control editInput" type="text" name="describtion" value="<?php echo $cat['Description'];?>" placeholder="<?php echo lang('PLACEHOLDER7'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" > <?php echo lang('ORDERING'); ?></label>
                        <div class="col-md-10">
                            <input class=" form-control editInput" type="text" name="ordering" value="<?php echo $cat['Ordering'];?>"  placeholder="<?php echo lang('PLACEHOLDER8'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                <label class="col-md-2 col-form-label" > <?php echo lang('PARENT'); ?></label>
                <div class="col-md-10 ">
                    <select class="form-control"  name="parent" id="">
                        <?php
                            $allCats = getAll( "*" ,"categories","WHERE Parent = 0" ,"Id" );
                        ?>
                        <option value ="0"> None</option>
                        <?php
                        foreach( $allCats as $c){?>
                        <option value="<?php echo $c['Id'];?>"
                        <?php
                        if ($cat['Parent'] == $c["Id"]){
                            echo "selected";
                        }?>
                        ><?php echo $c['Name'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label" > <?php echo lang('VISIBILITY'); ?></label>
                        <div class="form-check  ">
                            <input class="form-check-input " type="radio" name="visibililty" id="vis-yes" value="1" <?php if($cat['Visibility'] == 1){echo "checked";}?>>
                            <label class="form-check-label" for="vis-yes"><?php echo lang('YES'); ?></label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input " type="radio" name="visibililty" id="vis-No" value="0" <?php if($cat['Visibility'] == 0){echo "checked";}?> >
                            <label class="form-check-label" for="vis-No"><?php echo lang('NO'); ?></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4" > <?php echo lang('ALLOW COMMENTS'); ?></label>
                        <div class="form-check  ">
                            <input class="form-check-input " type="radio" name="allow-comments" id="com-yes" value="1" <?php if($cat['Allow_Comments'] == 1){echo "checked";}?>>
                            <label class="form-check-label" for="com-yes"><?php echo lang('YES'); ?></label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input " type="radio" name="allow-comments" id="com-no" value="0" <?php if($cat['Allow_Comments'] == 0){echo "checked";}?> >
                            <label class="form-check-label" for="com-no"><?php echo lang('NO'); ?></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4" > <?php echo lang('ALLOW ADS'); ?></label>
                        <div class="form-check  ">
                            <input class="form-check-input " type="radio" name="ads" id="ads-yes" value="1" <?php if($cat['Allow_Ads'] == 1){echo "checked";}?>>
                            <label class="form-check-label" for="ads-yes"><?php echo lang('YES'); ?></label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input " type="radio" name="ads" id="ads-no" value="0" <?php if($cat['Allow_Ads'] == 0){echo "checked";}?>>
                            <label class="form-check-label" for="ads-no"><?php echo lang('NO'); ?></label>
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
    }elseif ($do == 'Update'){
        if($_SERVER['REQUEST_METHOD']== 'POST'){?>
            <h2 class='text-center hedit'><?php echo lang('UPDATE CATEGORY') ;?></h2>
            <?php
            $id         = $_POST['catid'];
            $name       = $_POST['name'];
            $desc       = $_POST['describtion'];
            $parent     = $_POST['parent'];
            $vis        = $_POST['visibililty'];
            $comments   = $_POST['allow-comments'];
            $ads        = $_POST['ads'];
            if(empty($_POST['name'])){
                $error = lang('error7');
            }
            if(empty($error)){
                $stmt2 =$db->prepare("UPDATE categories SET Name = ? , Description = ? , Parent = ? ,Visibility = ?, Allow_Comments = ?,Allow_Ads = ? WHERE Id = ?");
                $stmt2->execute(array($name,$desc ,$parent ,$vis,$comments,$ads,$id));
                //success message
                ?>
                <div class="container">
                <?php
                if($stmt2->rowCount() == 0){
                    $theMsg1 =  "<div class=' alert alert-danger'>". $stmt2->rowCount() ." Record Updated </div>";
                    Home_Redirect($theMsg1,'back');    
                }else{
                    $theMsg2 = "<div class=' alert alert-success'>". $stmt2->rowCount() ." Record Updated </div>";
                    Home_Redirect($theMsg2,'back');        
                }
            }
        }else{
            $errorMsg = "<div class='alert alert-danger'>Sorry,This page Isn't Allowed directly</div>";
            Home_Redirect($errorMsg);
        }?>
            </div>
        <?php
    }elseif ($do == 'Delete'){
        ?>
            <h1 class="text-center"><?php echo lang('DELETE CATEGORY'); ?></h1>
            <div class="container">
        <?php
        $id = isset($_GET['catid']) && is_numeric($_GET['catid'])? intval($_GET['catid']):0 ;
        $stmt2 = $db->prepare("SELECT * FROM categories where Id=?");
        $stmt2->execute(array($id));
        if($stmt2->rowCount() > 0){
            $stmt2 = $db->prepare("DELETE FROM categories where Id=?");
            $stmt2->execute(array($id));
            $theMsg1 =  "<div class='container alert alert-success'>". $stmt2->rowCount() ." Record Updated </div>";
            Home_Redirect($theMsg1,'back');    
        }else{
            $theMsg2 = "<div class='container alert alert-danger'>". $stmt2->rowCount() ." Record Updated </div>";
            Home_Redirect($theMsg2,'back');        
        }
        
    }
    /*
        elseif($do == 'Delete'){
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
    */
    include $tbl . 'footer.php';
}else{
    header('Location:index.php');
    exit();
}
ob_end_flush();