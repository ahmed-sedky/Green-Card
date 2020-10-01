<?php
ob_start();
session_start();
$pageTitle ="Show Items";
include "init.php";
$itemId = isset($_GET['itemid']) && is_numeric($_GET['itemid'])?intval($_GET['itemid']):0;
global $db ;
$stmt2 =$db->prepare("SELECT
                            items.* ,categories.Name AS Cat_Name ,user.UserName AS username
                    FROM 
                            items
                    INNER JOIN
                            categories
                    ON
                            categories.Id =items.Cat_Id 
                    INNER JOIN
                            user
                    ON
                            user.UserId = items.Member_id
                    WHERE
                            Items_Id=?
                    AND
                            Approve = 1");
$stmt2->execute(array($itemId));
$items = $stmt2->fetch();
$count =$stmt2->rowCount();
if($count > 0){
    echo "<h1 class='text-center'>";
    echo $items['Name']."</h1>";
    ?>
    <div class="container">
        <form action="items_compare.php?itemid=<?php echo $_GET['itemid'];?>" method ='POST'>
            <div class="form-group row">
                <label class="col-md-2 col-form-label" > Compare With Item</label>
                <div class="col-md-3">
                    <select class="form-control" name='compare-items'>
                        <option value="0">...</option>
                        <?php
                            $stmt3 =$db->prepare("SELECT * from categories where Id=? ");
                            $stmt3->execute(array($items['Cat_Id']));
                            $cat2 = $stmt3->fetch();

                            $tot_items = getAll("*","items","WHERE Cat_id ={$cat2['Id']}" , "Items_id");
                            foreach($tot_items as $item2){
                                echo "<option value='" .$item2['Items_Id'] . "'>" .$item2['Name'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <input class="col-md-2 btn bcompare" type="submit" value="Compare">
            </div>
        </form>
        
        <div class="item-show">
            <div class="row">

                <div class="col-md-4">
                    <?php
                    if(! empty($items['Image'])){?>
                        <img class='img-thumbnail rounded iimage' src="<?php echo "control/Uploads/Avatar/" . $items['Image'];?>"><?php
                    }else{?>
                        <img class='img-thumbnail rounded ' src="<?php echo "layout/images/avatar-1024x1024.jpg";?>"><?php
                    }?>                
                </div>
                <div class="col-md-8">
                        <h4>Info:</h4>
                        <p class='desc'><?php echo $items['Description'];?></p>
                        <div class='country-tag '> <?php echo "Country:  ". "<span>"  . $items['Country_Made'];?></span> </div>
                        <div class='status-tag '> <?php echo "Status: ";
                        if($items['Status'] == 0){
                            echo "<span> Not Mentioned </span>";
                        }elseif($items['Status'] == 1){
                            echo "<span> New</span>";
                        }
                        elseif($items['Status'] == 2){
                            echo "<span> Like New</span>";
                        }else{
                            echo "<span> Old</span>";
                        }
                        ?> </div>
                        <div class='category-tag '> <?php echo "Category: " . "<span><a href='categories.php?catid=". $items['Cat_Id'] ."&pagename="   . $items['Cat_Name'] ."'>" . $items['Cat_Name'];?></span> </div>
                        <div class='member-tag text-muted'> <?php echo "Added By:" . "<span> <a class='text-muted' href='profile.php?id=". $items['Member_id'] ."'>"  . $items['username'];?></a></span>  </div>
                        <span class='price-tag price-item btn btn-success'><?php echo "$ " . $items['Price'] ;?> </span>                       
                        <span class='date-tag text-muted'><?php echo getTime(date('Y-m-d H:i:s'), $items['Add_Date']) ; ?></span>
                        <div class="row">
                            <span class='tag-tag col-md-9 '>
                                <?php 
                                $allTags = explode(",",$items['Tags']);
                                ?>
                                    <div class="row">
                                        <?php
                                        echo "<span class= 'col-md-2'> Tags: </span>";
                                            echo "<span class= 'col-md-12'>";
                                            foreach( $allTags as $tag){
                                                if(! empty($tag)){
                                                    $tag = str_replace(" " ,"",$tag);
                                                    echo  "<a class='btn btag' href='tags.php?name=" . strToLower($tag) ."'>$tag</a>";
                                                }
                                            }
                                            echo "</span>";
                                        ?>
                                    </div>
                                
                            </span>
                        </div>
                        
                        <div class="add-cart btn"><i class="fas fa-shopping-cart"></i> Add to Cart</div>
                </div>
            </div>
            <hr>
            <div class="item-comment">
                <?php 
                    if (isset($_SESSION['user'])){?>
                        <div class="row">
                            <div class="offset-4">
                                <h5>Add Your Comment</h5>
                                <form action="<?php $_SERVER['PHP_SELF'];?>" method="Post">
                                <textarea class="col-md-8" required name="comment" id="" ></textarea>
                                <input type="submit" value="Add comment" class="btn bitem-comment">
                                </form>
                                <?php 
                                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                    $comment = filter_var($_POST['comment'],FILTER_SANITIZE_STRING);
                                    $memberId  = $items['Member_id'];
                                    $item_Id  = $items['Items_Id'];
                                    if( ! empty($comment)){
                                        global $db;
                                        $stmt4 = $db->prepare("INSERT INTO comments(Comment ,Item_Id , Member_Id , C_status ,C_date)
                                                                        VALUES (:zcomment , :zitem , :zmember , 0 ,NOW() )");
                                        $stmt4->execute(array(
                                            'zcomment'   => $comment,
                                            'zitem'      => $item_Id,
                                            'zmember'    => $memberId
                                        ));
                                        if($stmt4->rowCount() > 0 ){
                                            echo "<div class='container'>";
                                                echo "<span class='alert alert-success successMSg'> Your Comment Has Been Added";
                                            echo "</div>";
                                        }
                                    }else{
                                        echo "<div class='container'>";
                                                echo "<span class='alert alert-danger successMSg'> The Comment Field Is Empty";
                                        echo "</div>";
                                    }
                                }?>
                            </div>
                        </div>
                        <?php
                    } else{
                        echo "<span class='alert alert-info d-block'> Login Or Register To Add Comment</span>";
                    }?>
            </div>
            <hr>
            <?php
                    $stmt= $db->prepare("SELECT 
                                                comments.*, user.UserName AS Member_Name ,user.Image AS 2Image
                                        FROM 
                                                comments 
                                        INNER JOIN 
                                                user
                                        ON  
                                                user.UserId = comments.Member_Id
                                        WHERE 
                                                Item_Id =?
                                        AND     
                                                C_Status = 1
                                        ORDER BY C_Id DESC
                                        ");
                    $stmt->execute(array($items['Items_Id']));
                    $rows = $stmt->fetchAll();
                    if($stmt->rowCount() > 0){      
                        ?>
                        <?php
                        foreach($rows as $comment){
                            echo "<div class='com'>";
                                echo "<div class='row'>";
                                    echo "<div class='col-sm-6 col-md-5 col-lg-4 col-xl-3'>" ; 
                                        if (! empty($comment['2Image'])){
                                            echo "<img class='img-thumbnail rounded cimage'" . "src='" ."control/Uploads/Avatar/" .$comment['2Image'] ."'".">";
                                        }else{
                                            echo "<img class='img-thumbnail rounded cimage'" . "src='" ."layout/images/avatar-1024x1024.jpg" ."'".">";
                                        }
                                        echo "<span class='com-name'>" .$comment['Member_Name']."</span>";
                                    echo "</div>";
                                    echo "<div class = 'total_comment col-sm-6 col-md-7 col-lg-8 col-xl-9'>";
                                        echo "<div >" . $comment['Comment']. "</div>";
                                        
                                        echo "<div class='com-date col-md-4 text-muted'>" ;
                                            echo  getTime(date('Y-m-d H:i:s'), $comment['C_date']) ;
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                            echo "<hr>";
                            }
                    }else{
                        echo "<span class='alert alert-info d-block'> There is No Comments On This Item To Show</span>";
                    }
        }else{
            echo "<div class='container'>";
                echo "<span class='alert alert-info d-block'> There is No Such Item To Show Or Items Waits For Approval</span>";
            echo "</div>";
        }
        ?>
        </div>
    </div>
    
    <?php

?>


<?php
include $tbl."footer.php";
ob_end_flush();
?>