<?php
ob_start();
session_start();
$pageTitle ="Profile Page";
include "init.php";
?>
<?php
if(isset($_SESSION['user'])){
    echo "<h1 class='text-center'>";
    echo $sessionUser."'s" .  " Profile";?></h1>
    <div class="profile">
        <div class="information">
            <div class="container">
                <div class="panel panel-priamry">
                    <div class="panel-heading">
                        <h3>My Info</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $stmt =$db->prepare("SELECT * FROM user WHERE UserName = ?");
                        $stmt->execute(array($sessionUser));
                        $row = $stmt->fetch();
                        ?>
                        <div class="row">
                            <span class='col-sm-4'> <i class="fas fa-user-lock"></i>  UserName: </span> <span class='col-sm-8'> <?php echo $row['UserName'];?></span>
                        </div>
                        <div class="row">
                        <span class='col-sm-4'> <i class="fas fa-envelope"></i>  Email:</span> <span class='col-sm-8'><?php echo $row['Email'] ;?> </span>
                        </div>
                        <div class="row">
                        <span class='col-sm-4'><i class="fas fa-user"></i>  FullName:</span>  <span class='col-sm-8'> <?php echo $row['Fullname'] ;?> </span>
                        </div>
                        <div class="row">
                        <span class='col-sm-4'><i class="fas fa-calendar-alt"></i>  Register Date:</span>  <span class='col-sm-8'> <?php echo $row['RegDate'] ;?></span>
                        </div>
                        <div class="row">
                            <span class='col-sm-4'><i class="fas fa-user-plus"></i>  Status:</span>  <span class='col-sm-8'>Your Membership is <?php 
                            if($row['RegStatus'] == 0){
                                echo "Not Activated";
                            }else{ echo "Activated";}
                            ?>
                        </span>
                        </div>
                        <div class="row">
                        <span class='col-sm-4'><i class="fas fa-tag"></i>  Favourite Category: </span>  <span class='col-sm-8'></span>
                        </div>
                        <a href="editprofile" class="btn bprofile"> Edit Info</a>
                    </div>
                </div>
                <div class="panel panel-warning" id='my_ads'>
                    <div class="panel-heading">
                        <h3>My Ads</h3>
                    </div>
                    <div class="panel-body">
                    <div class="row">
                        <?php
                        $items = getAll("*" , "items" ,"WHERE Member_id = {$row['UserId']} ", "Items_Id");
                        if(! empty($items)){
                            foreach($items as $item){
                                echo "<div class='col-sm-6 col-md-4 col-lg-3'> ";
                                    echo "<div class='thumbnail rounded item-box'>";
                                        echo "<span class='price-tag btn btn-success'>" . "$" .$item['Price'] . "</span>";
                                        if (! empty($item['Image'])){
                                            echo "<img class='img-thumbnail rounded'" . "src='" ."control/Uploads/Avatar/" .$item['Image'] ."'".">";
                                        }else{
                                            echo "<img class='img-thumbnail rounded'" . "src='" ."layout/images/avatar-1024x1024.jpg" ."'".">";
                                        }
                                        echo "<div class='caption'>";
                                            //echo "<span class='user-tag text-muted'>" .$item['Member_id'] . "</span>";
    
                                            echo "<h5  class='text-center item-head'>";
                                                echo "<a href='items.php?itemid=". $item['Items_Id'] ."'" .">" . $item['Name'] ."</a>";
                                            echo "</h5>";
                                            echo "<p>".$item['Description'] ."</p>";
                                            echo "<div class='country-tag '>" .$item['Country_Made'] . "</div>";
                                            echo "<span class='date-tag text-muted'>" ;
                                                echo getTime(date('Y-m-d H:i:s'), $item['Add_Date']);
                                            echo "</span>";
                                            if($item['Approve'] == 0){
                                                echo "<div class='approve btn btn-danger '>Waiting Approval</div>";
                                            }
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                            }
                        }else{
                            echo "<div class=' alert alert-info'> There Is No Advertisments To Show, Create<a href='newad.php'> New AD</a></div>";
                        }
                        ?>
                    </div>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3>My Comments</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        global $db;
                            $comments = getAll("*" , "comments" ,"WHERE Member_Id = {$row['UserId']}" , "C_Id");
                            if(! empty($comments)){
                                foreach($comments as $comment){
                                    echo "<p class='pComment'>" . $comment['Comment']. "</p>";
                                }
                            }else{
                                echo "<span class=' alert alert-info'> There Is No Comment To Show";
                            }
                        ?>
                    </div>
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