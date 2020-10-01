<?php
ob_start();
session_start();
include "init.php";?>
<div class="container">
    <?php
    if(isset($_GET['pagename'])){?>
        <h1 class='text-center'><?php echo str_replace("-", " ",$_GET['pagename']); ?></h1>
        <div class="row">
            <?php      
            if (isset($_GET['catid'])){
                $items = getAll("*", "items" ,"WHERE Cat_Id = {$_GET['catid']} AND Approve = 1 ", "Items_Id" );
                foreach($items as $item){
                    echo "<div class='col-sm-6 col-md-4 col-lg-3 '>";
                        echo "<div class='thumbnail rounded item-box'>";
                            echo "<span class='price-tag '>" . "$" .$item['Price'] . "</span>";
                            if (! empty($item['Image'])){
                                echo "<img class='img-thumbnail rounded'" . "src='" ."control/Uploads/Avatar/" .$item['Image'] ."'".">";
                            }else{
                                echo "<img class='img-thumbnail rounded'" . "src='" ."layout/images/avatar-1024x1024.jpg" ."'".">";
                            }                            echo "<div class='caption'>";
                                //echo "<span class='user-tag text-muted'>" .$item['Member_id'] . "</span>";

                                echo "<h5  class='text-center item-head'>";
                                    echo "<a href='items.php?itemid=". $item['Items_Id'] ."'" .">" . $item['Name'] ."</a>";
                                echo "</h5>";
                                echo "<p>".$item['Description'] ."</p>";
                                echo "<div class='country-tag '>" .$item['Country_Made'] . "</div>";
                                echo "<span class='date-tag text-muted'>" ;
                                    echo getTime(date('Y-m-d H:i:s'), $item['Add_Date']) ; 
                                echo "</span>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
            }else{
                echo "<Span class= 'alert alert-danger'>". " You Didn't Specify An Exist Id" ."</span>";
            }
        }
    
        
        ?>
    </div>
        
</div>
    
<?php include $tbl."footer.php";
ob_end_flush();
?>