<?php
ob_start();
session_start();
$pageTitle ="Favourite Page";
include "init.php";
$favId = isset($_GET['delete'])&&is_numeric($_GET['delete'])?intval($_GET['delete']) : 0;

    if (isset($favId) && $favId !=0){
    
    global $db;
    //$stmt = $db->prepare('DELETE FROM user WHERE UserId = :zuser '); //method 3 for selection

    $stmt3 = $db->prepare("DELETE FROM favourites where Fav_Id = :zid");
    $stmt3->bindParam(":zid" ,$favId );
    $stmt3->execute();
    if($stmt3->rowCount()>0){
        $successMsg = "The item Has Been Deleted";
        }
}
    ?>
    <div class="container">
    <h2 class="text-center"><?php echo lang("WISHLIST");?></h2>
    <?php
    if(isset($successMsg)){
        echo "<div class='success alert-success'>".$successMsg . "</div>";
    }
    ?>
    <div class="row">
        <?php      
        global $db; 
        $stmt2 =$db->prepare("SELECT
        favourites.* , items.Price AS iPrice , items.Image AS iImage , items.Items_Id AS itemId , items.Name AS iName , items.Country_Made AS iCountry_Made , items.Add_Date AS iAdd_Date ,items.Description AS iDescription
        FROM 
                favourites
        INNER JOIN
                items
        ON
                items.Items_Id =favourites.Item_Id 
        
        WHERE
                Approve = 1");
        $stmt2->execute(array());
        $items = $stmt2->fetchAll();
        $count =$stmt2->rowCount();
        foreach($items as $item){
            echo "<div class='col-sm-6 col-md-4 col-lg-3'>";
                echo "<div class='thumbnail rounded item-box'>";
                    echo "<span class='price-tag '>" . "$" .$item['iPrice'] . "</span>";
                    echo "<div class='img imgWish'>";
                        if (! empty($item['iImage'])){
                            echo "<img class='img-thumbnail rounded'" . "src='" ."control/Uploads/Avatar/" .$item['iImage'] ."'".">";
                        }else{
                            echo "<img class='img-thumbnail rounded'" . "src='" ."layout/images/avatar-1024x1024.jpg" ."'".">";
                        }
                        echo "<div class='Msg2'>";
                                    echo "<a href='?delete=". $item['Fav_Id'] ."' class ='Delete'> Delete </a>";
                        echo "</div>";
                        echo "<a href='?itemid=". $item['itemId'] ."'" . "class='heart errorMsg'>
                        <i class='far fa-heart heart2'></i>
                            </a>";
                    echo "</div>";
                    
                    echo "<div class='caption'>";
                        //echo "<span class='user-tag text-muted'>" .$item['Member_id'] . "</span>";
                        echo "<h5  class='text-center item-head'>";
                            echo "<a href='items.php?itemid=". $item['itemId'] ."'" .">" . $item['iName'] ."</a>";
                        echo "</h5>";
                        echo "<p>".$item['iDescription'] ."</p>";
                        echo "<div class='country-tag '>" .$item['iCountry_Made'] . "</div>";
                        echo "<span class='date-tag text-muted'>" ;
                            echo getTime(date('Y-m-d H:i:s'), $item['iAdd_Date']) ; 
                        echo "</span>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
        
</div>
<?php
include $tbl."footer.php";
ob_end_flush();
?>