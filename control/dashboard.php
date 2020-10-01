<?php
session_start();
if(isset($_SESSION['username'])){
    $pageTitle = "Dashboard";
    include "init.php";
    // start dashboard
    /*
    $statement2 = $db->prepare("SELECT count(UserId) FROM user where GroupId != 1");
    $statement2->execute();
    echo $statement2->fetchColumn(); //by3mle glb ll column dh
    */
    /*
    $statement2 = $db->prepare("SELECT UserId FROM user where UserId != 1 ");
    $statement2->execute();
    $count2 = $statement2->rowCount();
    echo $count2;
    */ // anither method
    ?>
        <h1 class="text-center"><?php echo lang('DASHBOARD'); ?></h1>
        <div class="container home-stats text-center">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat members">
                        <?php echo lang('TOTAL MEMBERS'); ?>
                        <span><a href="members.php"><?php echo Calculate_Items('UserId', 'user', 'GroupId');?></a></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat pending">
                        <?php echo lang('PENDING MEMBERS'); ?>
                        <span><a href="members.php?page=Pending"> <?php echo Calculate_Items('UserId', 'user', 'Pending');?> </a></span> <!--mmkn a3melha b el check items-->
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat items">
                        <?php echo lang('TOTAL ITEMS'); ?>
                        <span><a href="items.php"> <?php echo Calculate_Items2('Items_Id', 'items');?> </a></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat comments">
                    <?php echo lang('TOTAL COMMENTS'); ?>
                    <span><a href="items.php"> <?php echo Calculate_Items2('C_Id', 'comments');?> </a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container latest">
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>
                                <i class="fa fa-users"></i> <?php echo lang('LATEST REGISTERED USERS'); ?>
                            </h4>
                            <span class="right toggle-info">
                                <i class="fas fa-minus"></i>
                            </span>
                        </div>
                        <div class="panel-body ">
                            <?php
                                $latest = Get_Latest("*" ,"user" , "UserId");
                                echo"<ul class='list-unstyled latest'>";
                                foreach($latest as $user){?>
                                    <li><?php echo $user['UserName'];?> <a href="members.php?do=Edit&userid=<?php echo $user['UserId']; ?>" class="btn btn-success bmanage right"> <i class="fas fa-edit"></i> <?php echo lang('EDIT'); ?></a>
                                    <?php 
                                        if($user['RegStatus'] == 0){?>
                                        <a href="members.php?do=Activate&userid=<?php echo $user['UserId']; ?>" class="btn btn-warning bmanage right2 "> <i class="fab fa-angellist"></i> <?php echo lang('ACTIVE'); ?></a>
                                        <?php
                                }?>
                                </li>
                                    <?php
                                }
                                echo "</ul>";
                            ?>
                        </div> 
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>
                                <i class="fa fa-tag"></i> <?php echo lang('LATEST ITEMS'); ?>
                            </h4>
                            <span class="right toggle-info">
                                <i class="fas fa-minus"></i>
                            </span>
                        </div>
                        <div class="panel-body">
                        <?php
                        $latest2 =Get_Latest("*","items","Items_Id");
                        echo"<ul class='list-unstyled latest'>";
                            foreach($latest2 as $item){?>
                                <li><?php echo $item['Name'];?> <a href="items.php?do=Edit&itemid=<?php echo $item['Items_Id']; ?>" class="btn btn-success bmanage right"> <i class="fas fa-edit"></i> <?php echo lang('EDIT'); ?></a>
                                <?php 
                                    if($item['Approve'] == 0){?>
                                    <a href="items.php?do=Approve&itemid=<?php echo $item['Items_Id']; ?>" class="btn btn-warning bmanage right2 "> <i class="fas fa-check"></i> <?php echo lang('APPROVE'); ?></a>
                                    <?php
                            }?>
                            </li>
                                <?php
                            }
                            echo "</ul>";
                        ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>
                                <i class="fa fa-tag"></i> <?php echo lang('LATEST COMMENTS'); ?>
                            </h4>
                            <span class="right toggle-info">
                                <i class="fas fa-minus"></i>
                            </span>
                        </div>
                        <div class="panel-body">
                        <?php
                        $latest3 =Get_Latest("*","comments","C_Id");
                        echo"<ul class='list-unstyled latest'>";
                            foreach($latest3 as $comment){?>
                                <li><?php echo $comment['Comment'];?> <a href="comments.php?do=Edit&commentid=<?php echo $comment['C_Id']; ?>" class="btn btn-success bmanage right"> <i class="fas fa-edit"></i> <?php echo lang('EDIT'); ?></a>
                                <?php 
                                    if($item['Approve'] == 0){?>
                                    <a href="comments.php?do=Approve&commentid=<?php echo $item['C_Id']; ?>" class="btn btn-warning bmanage right2 "> <i class="fas fa-check"></i> <?php echo lang('APPROVE'); ?></a>
                                    <?php
                            }?>
                            </li>
                                <?php
                            }
                            echo "</ul>";
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    //end dashboard
    include $tbl."footer.php";
}else{
    //echo "You Are Not Authorized To View This Page";
    header('Location:index.php');
    exit();
}