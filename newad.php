<?php
ob_start();
session_start();
$pageTitle ="Ads Page";
include "init.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $form_errors = array();

    $name       = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $desc       = filter_var($_POST['description'],FILTER_SANITIZE_STRING);
    $tags       = filter_var($_POST['tags'],FILTER_SANITIZE_STRING);
    $price      = filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_INT);
    $country    = filter_var($_POST['country'],FILTER_SANITIZE_STRING);
    $status     = filter_var($_POST['status'],FILTER_SANITIZE_NUMBER_INT);
    $category   = filter_var($_POST['categories'],FILTER_SANITIZE_NUMBER_INT);

    $avatar     = $_FILES['hossam'];
    $avatarName = $avatar['name'];
    $avatarSize = $avatar['size'];
    $avatarTmp  = $avatar['tmp_name'];
    $avatarType = $avatar['type'];

    $allowedExtensions = array("jpeg" ,"jpg","png" ,"gif");
    $getExtensions = explode(".",$avatarName);
    $gExtensions = strToLower(end($getExtensions));

    if(strlen($name)<3){
        $form_errors[] = "The Item Name Can't Be Less Than 3 Charcters";
    }
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
    if ($cat == 0){
        $form_errors[] = lang('error14');
    }
    if(! empty($avatarName) && ! in_array($gExtensions ,$allowedExtensions)){
        $form_errors[] = "<span class='alert alert-danger'>This Extension Is Not Allowed</span>";
    }
    if(empty($avatarName)){
        $form_errors[] = "<span class='alert alert-danger'>Image Is required</span>";
    }
    if( $avatarSize > 10485760){
        $form_errors[] = "<span class='alert alert-danger'>Image Can't Be More Than 4MB</span>";
    }
    
    // UPDATE THE DATA WITH THIS INFO
    //check if there is no error
    if(empty($form_errors)){
        $image = rand(0 ,1000000) . "_" .$avatarName;
        move_uploaded_file($avatarTmp , "control/Uploads\Avatar\\".$image);
        $stmt =$db->prepare("INSERT INTO items(Name ,Description , Tags ,Price ,Country_Made, Status ,Cat_Id ,Member_Id ,Add_Date ,Image ) 
                                VALUES (:zname , :zdesc , :ztags , :zprice , :zcountry , :zstatus , :zcat , :zmem ,now() ,:zimage) /*regstatus 1 laen el admin hwa ellly daifh*/
                                ");
        $stmt->execute(array(
            'zname'     => $name,
            'zdesc'     => $desc,
            'ztags'     => $tags,
            'zprice'    => $price,
            'zcountry'  => $country,
            'zstatus'   => $status,
            'zcat'      => $category,
            'zmem'      => $_SESSION['uid'],
            'zimage'    => $image
        ));
        if($stmt->rowCount() > 0){
            $successMsg2 = "Coungrats Your AD Has Been Puplished"; 
            header("refresh:2;url=profile.php");
        }
    }
}
?>
<?php
if(isset($_SESSION['user'])){
    echo "<h1 class='text-center'>New Advertisment</h1>";
    ?>
    <div class="profile newad">
        <div class="information">
            <div class="container">
                <div class="panel panel-priamry panel-ad">
                    <div class="panel-heading">
                        <h3>New AD</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-7">
                            <form class="eitem" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" > <?php echo lang('NAME'); ?></label>
                                    <div class="col-md-9">
                                        <input pattern=".{3,}" title="This Field Requires At Least 3 Charcters" class="form-control editInput live-name" type="text" name="name"  placeholder="<?php echo lang('PLACEHOLDER9'); ?>" required >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" > <?php echo lang('DESCRIPTION'); ?></label>
                                    <div class="col-md-9">
                                        <input class=" form-control editInput live-desc" type="text" name="description" placeholder="<?php echo lang('PLACEHOLDER10'); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-md-3 col-form-label" > Tags</label>
                                <div class="col-md-9">
                                    <input class=" form-control editInput" type="text" name="tags" placeholder="Split Tags With Comma (,)" >
                                </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" > <?php echo lang('PRICE'); ?></label>
                                    <div class="col-md-9">
                                        <input class=" form-control editInput live-price" type="text" name="price" placeholder="<?php echo lang('PLACEHOLDER11'); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" > <?php echo lang('COUNTRY'); ?></label>
                                    <div class="col-md-9">
                                        <input class=" form-control editInput live-country" type="text" name="country" placeholder="<?php echo lang('PLACEHOLDER12'); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Image></label>
                                    <div class="col-md-9">
                                        <input type="file"  name="hossam" required  class="form-control-file editInput" autocomplete="off"  id="" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" > <?php echo lang('STATUS'); ?></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name='status'>
                                            <option value="0">...</option>
                                            <option value="1"><?php echo lang('NEW'); ?></option>
                                            <option value="2"><?php echo lang('LIKE NEW'); ?></option>
                                            <option value="3"><?php echo lang('USED'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" > <?php echo lang('categories'); ?></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name='categories'>
                                            <option value="0">...</option>
                                            <?php
                                                $cats = getAll("*","categories", "","Id");
                                                foreach($cats as $cat){
                                                    echo "<option value='" .$cat['Id'] . "'>" .$cat['Name'] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary mx-auto bedit bnewad " value="<?php echo lang('ADD ITEMS'); ?>">
                            </form>
                            </div>
                            <div class=" col-md-4">
                                <div class='thumbnail rounded item-box live-ad'>
                                    <span class='price-tag '> $
                                        <span class="price_tag">0</span>
                                    </span>
                                    <img class='img-thumbnail rounded' src='<?php echo $img ."avatar-1024x1024.jpg'";?>>
                                    <div class='caption'>
                                        <h5  class='text-center'>Name</h5>
                                        <p>Description</p>
                                        <div class='country-tag '>Country_Made </div>
                                        <span class='date-tag text-muted'> <?php echo date("Y-m-d h:i:s");?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        if(! empty($form_errors)){
                            echo "<div class='container'>";
                                foreach($form_errors as $error){
                                    echo "<div class='alert alert-danger'>" .$error ."</div>";
                                }
                            echo "</div>";                        
                        }else{
                            if(isset($successMsg2)){
                                echo "<div class='container'>";
                                echo "<div class='alert alert-success'>" .$successMsg2 ."</div>";
                            echo "</div>"; 
                            }    
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}else{
    header("Location:login.php");
    exit();
}
?>


<?php
include $tbl."footer.php";
ob_end_flush();
?>