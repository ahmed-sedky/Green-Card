<?php
/* You Can | edit | delete |approve  comments from here */
ob_start();
session_start();
if(isset($_SESSION['username'])){
    $pageTitle = "Comments";
    include "init.php";
    $do=isset($_GET['do']) ? $_GET['do']: 'Manage';
    if ($do == 'Manage'){
        ?>
        <h1 class="text-center"><?php echo lang('MANAGE COMMENTS'); ?></h1>
        <div class="container">
            <table class="table table-light table-bordered table-responsive-sm table-hover text-center ">
                <?php
                    //get all the members in database except the admins
                    $stmt= $db->prepare("SELECT 
                                                comments.*, items.Name AS Item_Name , user.UserName AS Member_Name
                                        FROM 
                                                comments 
                                        INNER JOIN 
                                                items
                                        ON  
                                                items.Items_Id = comments.Item_Id
                                        INNER JOIN 
                                                user
                                        ON  
                                                user.UserId = comments.Member_Id
                                        ORDER BY C_Id DESC
                                        ");
                    // execute the statement
                    $stmt->execute();
                    //assign to a variable
                    $rows = $stmt->fetchAll();
                ?>
                <thead>
                    <tr>
                        <th scope="col"><?php echo lang('ID') ; ?></th>
                        <th scope="col"><?php echo lang('COMMENT') ; ?></th>
                        <th scope="col"><?php echo lang('ITEM NAME') ; ?></th>
                        <th scope="col"><?php echo lang('USER NAME') ; ?></th>
                        <th scope="col"> <?php echo lang('ADDED DATE') ; ?></th>
                        <th scope="col"><?php echo lang('CONTROL') ; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($rows as $row){
                        echo "<tr>";
                        echo "<td>" . $row['C_Id'] . "</td>";
                        echo "<td>" .$row['Comment']. "</td>";
                        echo "<td>" .$row['Item_Name']. "</td>";
                        echo "<td>" .$row['Member_Name']. "</td>";
                        echo "<td>" .$row['C_date']. "</td>";
                    ?>
                        <td>
                                <a href="?do=Edit&commentid=<?php echo $row['C_Id']; ?>" class="btn btn-success bmanage"> <i class="fas fa-edit"></i> <?php echo lang('EDIT'); ?></a>
                                <a href="?do=Delete&commentid=<?php echo $row['C_Id']; ?>" class="btn btn-danger bmanage confirm"> <i class="fas fa-user-minus"></i> <?php echo lang('DELETE'); ?></a>
                                <?php 
                                if($row['C_Status'] == 0){?>
                                    <a href="?do=Approve&commentid=<?php echo $row['C_Id']; ?>" class="btn btn-warning bmanage "> <i class="fab fa-angellist"></i> <?php echo lang('ACTIVE'); ?></a>
                                    <?php
                                }?>
                        </td>
                    <?php
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?PHP
    }elseif( $do == 'Manage2'){
        $itemId= isset($_GET['itemid'])&& is_numeric($_GET['itemid'])?intval($_GET['itemid']):0; //new if [condition?true:false]
        $stmt = $db->prepare(" SELECT * from items WHERE Items_Id=? "); 
        $stmt->execute(array($itemId));
        $row =$stmt->fetch(); //hyrg3le el data elly na gebtha bel select 3la hiaet array
        $count = $stmt->rowCount();
        if($count > 0){
            ?>
            <h1 class="text-center"><?php echo lang('MANAGE COMMENTS'); ?></h1>
            <div class="container">
                <table class="table table-light table-bordered table-responsive-sm table-hover text-center ">
                    <?php
                        //get all the members in database except the admins
                        $stmt= $db->prepare("SELECT 
                                                    comments.* , user.UserName AS Member_Name
                                            FROM 
                                                    comments 
                                            INNER JOIN 
                                                    user
                                            ON  
                                                    user.UserId = comments.Member_Id
                                            WHERE 
                                                    Item_Id =?
                                            ORDER BY C_Id DESC
                                            ");
                        // execute the statement
                        $stmt->execute(array($itemId));
                        //assign to a variable
                        $rows = $stmt->fetchAll();
                        if (! empty($rows)){
                            ?>
                            <thead>
                                <tr>
                                    <th scope="col"><?php echo lang('COMMENT') ; ?></th>
                                    <th scope="col"><?php echo lang('USER NAME') ; ?></th>
                                    <th scope="col"> <?php echo lang('ADDED DATE') ; ?></th>
                                    <th scope="col"><?php echo lang('CONTROL') ; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($rows as $row){
                                    echo "<tr>";
                                    echo "<td>" .$row['Comment']. "</td>";
                                    echo "<td>" .$row['Member_Name']. "</td>";
                                    echo "<td>" .$row['C_date']. "</td>";
                        ?>
                            <td>
                                    <a href="?do=Edit&commentid=<?php echo $row['C_Id']; ?>" class="btn btn-success bmanage"> <i class="fas fa-edit"></i> <?php echo lang('EDIT'); ?></a>
                                    <a href="?do=Delete&commentid=<?php echo $row['C_Id']; ?>" class="btn btn-danger bmanage confirm"> <i class="fas fa-user-minus"></i> <?php echo lang('DELETE'); ?></a>
                                    <?php 
                                    if($row['C_Status'] == 0){?>
                                        <a href="?do=Approve&commentid=<?php echo $row['C_Id']; ?>" class="btn btn-warning bmanage "> <i class="fab fa-angellist"></i> <?php echo lang('ACTIVE'); ?></a>
                                        <?php
                                    }?>
                            </td>
                        <?php
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
                        }else{
                            echo "<div class= 'container'>";
                            $errorMsg = "<div class= 'alert alert-info' >There Is No  Comments</div>";
                            echo "</div>";
                            Home_Redirect($errorMsg,'back'); 
                        }           
        }else{
            echo "<div class= 'container'>";
            $errorMsg = "<div class= 'alert alert-danger' >There Is No Such ID</div>";
            echo "</div>";
            Home_Redirect($errorMsg);
        }
    }
    elseif( $do == 'Manage3'){
        $userId= isset($_GET['userid'])&& is_numeric($_GET['userid'])?intval($_GET['userid']):0; //new if [condition?true:false]
        $stmt = $db->prepare(" SELECT * from user WHERE UserId=? "); 
        $stmt->execute(array($userId));
        $row =$stmt->fetch(); //hyrg3le el data elly na gebtha bel select 3la hiaet array
        $count = $stmt->rowCount();
        if($count > 0){
            ?>
            <h1 class="text-center"><?php echo lang('MANAGE COMMENTS'); ?></h1>
            <div class="container">
                <table class="table table-light table-bordered table-responsive-sm table-hover text-center ">
                    <?php
                        //get all the members in database except the admins
                        $stmt= $db->prepare("SELECT 
                                                    comments.* , items.Name AS Item_Name
                                            FROM 
                                                    comments 
                                            INNER JOIN 
                                                    items
                                            ON  
                                                    items.Items_Id = comments.Item_Id
                                            WHERE
                                                    comments.Member_Id=?
                                            ORDER BY C_Id DESC
                                            ");
                        // execute the statement
                        $stmt->execute(array($userId));
                        //assign to a variable
                        $rows = $stmt->fetchAll();
                        if (! empty($rows)){
                            ?>
                            <thead>
                                <tr>
                                    <th scope="col"><?php echo lang('COMMENT') ; ?></th>
                                    <th scope="col"><?php echo lang('ITEM NAME') ; ?></th>
                                    <th scope="col"> <?php echo lang('ADDED DATE') ; ?></th>
                                    <th scope="col"><?php echo lang('CONTROL') ; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($rows as $row){
                                    echo "<tr>";
                                    echo "<td>" .$row['Comment']. "</td>";
                                    echo "<td>" .$row['Item_Name']. "</td>";
                                    echo "<td>" .$row['C_date']. "</td>";
                        ?>
                            <td>
                                    <a href="?do=Edit&commentid=<?php echo $row['C_Id']; ?>" class="btn btn-success bmanage"> <i class="fas fa-edit"></i> <?php echo lang('EDIT'); ?></a>
                                    <a href="?do=Delete&commentid=<?php echo $row['C_Id']; ?>" class="btn btn-danger bmanage confirm"> <i class="fas fa-user-minus"></i> <?php echo lang('DELETE'); ?></a>
                                    <?php 
                                    if($row['C_Status'] == 0){?>
                                        <a href="?do=Approve&commentid=<?php echo $row['C_Id']; ?>" class="btn btn-warning bmanage "> <i class="fab fa-angellist"></i> <?php echo lang('ACTIVE'); ?></a>
                                        <?php
                                    }?>
                            </td>
                        <?php
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
                        }else{
                            echo "<div class= 'container'>";
                            $errorMsg = "<div class= 'alert alert-info' >There Is No  Comments</div>";
                            echo "</div>";
                            Home_Redirect($errorMsg,'back'); 
                        }           
        }else{
            echo "<div class= 'container'>";
            $errorMsg = "<div class= 'alert alert-danger' >There Is No Such ID</div>";
            echo "</div>";
            Home_Redirect($errorMsg);
        }
    }elseif($do == 'Edit'){
        $commnet_Id= isset($_GET['commentid'])&& is_numeric($_GET['commentid'])?intval($_GET['commentid']):0; //new if [condition?true:false]
        $stmt = $db->prepare(" SELECT * from comments WHERE C_Id=? "); 
        $stmt->execute(array($commnet_Id));
        $row =$stmt->fetch(); //hyrg3le el data elly na gebtha bel select 3la hiaet array
        $count = $stmt->rowCount();
        if($count > 0){?>
            <h2 class="text-center hedit"><?php echo lang('EDIT COMMENT'); ?></h2>
            <div class="container">
            <form class="edit" action="?do=update" method="POST">
                <input type="hidden" name="cid" value="<?php echo $comment_Id; ?>">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo lang('COMMENT'); ?></label>
                    <div class="col-sm-10 ">
                        <textarea class="form-control" name="comment"  value="<?php echo $row['Comment'];?>"></textarea>
                    </div>
                </div>
                </div>
                <input type="submit" class="btn btn-primary mx-auto becom " value="<?php echo lang('SAVE'); ?>">
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
        if($_SERVER['REQUEST_METHOD'] == 'POST'){?>
            <h2 class='text-center hedit'><?php echo lang('UPDATE COMMENT') ;?></h2>
            <?php
            //GET THE VARIABLES
            $id            = $_POST['cid'];
            $comment       = $_POST['comment'];

            echo "<div class='container errorsMember' >";
            
            // UPDATE THE DATA WITH THIS INFO
            //check if there is no error
            $stmt= $db->prepare('UPDATE comments SET comment = ?  WHERE C_Id = ?');
            $stmt->execute(array($comment,$id));
            //success message
            if($stmt->rowCount() == 0){
                $theMsg1 =  "<div class='container alert alert-danger'>". $stmt->rowCount() ." Record Updated </div>";
                Home_Redirect($theMsg1,'back');    
            }else{
                $theMsg2 = "<div class='container alert alert-success'>". $stmt->rowCount() ." Record Updated </div>";
                Home_Redirect($theMsg2,'back');        
            }
        }else{
            $errorMsg = "<div class='alert alert-danger'>Sorry,This page Isn't Allowed directly</div>";
            Home_Redirect($errorMsg);
        }
        echo "</div>";
    }elseif($do == 'Delete'){
        //Delete Page
        ?>
        <h1 class="text-center"><?php echo lang('DELETE COMMENT'); ?></h1>
        <div class="container">
        <?php
            $comid= isset($_GET['commentid'])&& is_numeric($_GET['commentid'])?intval($_GET['commentid']):0; //new if [condition?true:false]
            $stmt = $db->prepare(" SELECT * from comments WHERE C_Id=?"); 
            $stmt->execute(array($comid));
            $count = $stmt->rowCount();
            if($count > 0){
                $stmt = $db->prepare('DELETE FROM comments WHERE C_Id = :zid '); //method 3 for selection
                $stmt->bindParam(":zid" ,$comid );
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
    elseif($do == 'Approve'){
        //Delete Page
        ?>
        <h1 class="text-center"><?php echo lang('APPROVE COMMENT'); ?></h1>
        <div class="container">
        <?php
            $comid= isset($_GET['commentid'])&& is_numeric($_GET['commentid'])?intval($_GET['commentid']):0; //new if [condition?true:false]
            $stmt = $db->prepare(" SELECT * from comments WHERE C_Id=? "); 
            $stmt->execute(array($comid));
            $count = $stmt->rowCount();
            if($count > 0){
                $stmt = $db->prepare(" UPDATE comments SET C_Status = 1 WHERE C_Id =?"); 
                $stmt->execute(array($comid));
                $theMsg = "<div class='container alert alert-success'>". $stmt->rowCount() ." Record Approved </div>"; 
                Home_Redirect($theMsg, 'Custom4');   
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