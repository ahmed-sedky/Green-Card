<?php
ob_start();
session_start();
$pageTitle ="Compare Items";
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
                            Items_Id=?");
$stmt2->execute(array($itemId));
$items1 = $stmt2->fetch();
$count =$stmt2->rowCount();

$stmt3 =$db->prepare("SELECT
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
                            Items_Id=?");
$stmt3->execute(array($_POST['compare-items']));
$items2 = $stmt3->fetch();
$count2 =$stmt3->rowCount();

/*
$stmt3 =$db->prepare("SELECT * FROM items WHERE Items_Id=? ");
$stmt3->execute(array($_POST['compare-items']));
$items2 = $stmt3->fetch();
$count2 =$stmt3->rowCount();
*/
if($count > 0){
    ?>
    <div class="row">
        <div class="col-md-6">
            <div class="item-show item-compare">
                <div class="row">

                    <div class="col-md-4"><?php
                        if(! empty($items1['Image'])){?>
                            <img class='img-thumbnail rounded ' src="<?php echo "control/Uploads/Avatar/" . $items1['Image'];?>"><?php
                        }else{?>
                            <img class='img-thumbnail rounded ' src="<?php echo "layout/images/avatar-1024x1024.jpg";?>"><?php
                        }?>
                    </div>
                    <div class="col-md-8">
                            <h4>Info:</h4>
                            <p class='desc'><?php echo $items1['Description'];?></p>
                            <div class='country-tag '> <?php echo "Country:  ". "<span>"  . $items1['Country_Made'];?></span> </div>
                            <div class='status-tag '> <?php echo "Status: ";
                            if($items1['Status'] == 0){
                                echo "<span> Not Mentioned </span>";
                            }elseif($items1['Status'] == 1){
                                echo "<span> New</span>";
                            }
                            elseif($items1['Status'] == 2){
                                echo "<span> Like New</span>";
                            }else{
                                echo "<span> Old</span>";
                            }
                            ?> </div>
                            <div class='category-tag '> <?php echo "Category: " . "<span><a href='categories.php?catid=". $items1['Cat_Id'] ."&pagename="   . $items1['Cat_Name'] ."'>" . $items1['Cat_Name'];?></span> </div>
                            <div class='member-tag text-muted'> <?php echo "Added By:" . "<span> <a class='text-muted' href='profile.php?id=". $items1['Member_id'] ."'>"  . $items1['username'];?></a></span>  </div>
                            <span class='price-tag price-item btn btn-success'><?php echo "$ " . $items1['Price'] ;?> </span>
                            <span class='date-tag text-muted'><?php echo getTime(date('Y-m-d H:i:s'), $items1['Add_Date']) ; ?></span>
                            <div class="add-cart btn"><i class="fas fa-shopping-cart"></i> Add to Cart</div>
                    </div>
                </div>
                <?php
            }else{
                echo "<span class='alert alert-info d-block'> There is No Such Item To Show</span>";
            }
            ?>
            </div>
        </div><?php
    if($count2 > 0){
        ?>
        <div class=" col-md-6">
            <div class="item-show item-compare">
                <div class="row">

                    <div class="col-md-4"><?php
                    if(!empty($items2['Image'])){?>
                        <img class='img-thumbnail rounded ' src="<?php echo "control/Uploads/Avatar/" . $items2['Image'];?>"><?php
                    }else{?>
                        <img class='img-thumbnail rounded ' src="<?php echo "layout/images/avatar-1024x1024.jpg";?>"><?php
                    }?>
                    </div>
                    <div class="col-md-8">
                            <h4>Info:</h4>
                            <p class='desc'><?php echo $items2['Description'];?></p>
                            <div class='country-tag '> <?php echo "Country:  ". "<span>"  . $items2['Country_Made'];?></span> </div>
                            <div class='status-tag '> <?php echo "Status: ";
                            if($items2['Status'] == 0){
                                echo "<span> Not Mentioned </span>";
                            }elseif($items2['Status'] == 1){
                                echo "<span> New</span>";
                            }
                            elseif($items2['Status'] == 2){
                                echo "<span> Like New</span>";
                            }else{
                                echo "<span> Old</span>";
                            }
                            ?> </div>
                            <div class='category-tag '> <?php echo "Category: " . "<span><a href='categories.php?catid=". $items2['Cat_Id'] ."&pagename="   . $items2['Cat_Name'] ."'>" . $items2['Cat_Name'];?></span> </div>
                            <div class='member-tag text-muted'> <?php echo "Added By:" . "<span> <a class='text-muted' href='profile.php?id=". $items2['Member_id'] ."'>"  . $items2['username'];?></a></span>  </div>
                            <span class='price-tag price-item btn btn-success'><?php echo "$ " . $items2['Price'] ;?> </span>
                            <span class='date-tag text-muted'><?php echo getTime(date('Y-m-d H:i:s'), $items2['Add_Date']) ; ?></span>
                            <div class="add-cart btn"><i class="fas fa-shopping-cart"></i> Add to Cart</div>
                    </div>
                </div>
        </div>
    
            <?php
        }else{
            echo "<span class='alert alert-info d-block'> There is No Such Item To Show</span>";
        }
        ?>
        </div>
    </div>

<?php
include $tbl."footer.php";
ob_end_flush();
?>