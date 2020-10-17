<?php
ob_start();
session_start();
$pageTitle ="Home Page";
include "init.php";
$itemId = isset($_GET['itemid']) && is_numeric($_GET['itemid'])?intval($_GET['itemid']):0;
if(isset($itemId)&&$itemId != 0){
    global $db;
    $stmt = $db->prepare("INSERT INTO favourites(Registeration_Date , Item_Id ,Member_id) VALUES(now() ,:zitem ,:zmem  )");
    $stmt->execute(array(
        'zitem' =>$itemId ,
        'zmem'  => $_SESSION['uid']
    ));
}
    ?>
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="layout/images/L_1601567912_GW-MB-footwear-en.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="layout//images/L_1601916661_GW-MB-Samsung-en.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="layout//images/L_1602409609_GW-MB-Below100-en.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item ">
                <img src="layout/images/L_1602409609_GW-MB-BestDeals-en.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="layout/images/L_1602409609_GW-MB-Bundles-en.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="layout/images/L_1602678907_GW-MB-AYHN-teaser-en.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    <div class="row">
        <?php        
    $items = getAll("*","items" , "WHERE Approve = 1" ,"Items_Id" );
    foreach($items as $item){
            echo "<div class='col-sm-6 col-md-4 col-lg-3'>";
                echo "<div class='thumbnail rounded item-box'>";
                    echo "<span class='price-tag '>" . "$" .$item['Price'] . "</span>";
                    echo "<div class='img'>";
                    if (! empty($item['Image'])){
                        echo "<img class='img-thumbnail rounded'" . "src='" ."control/Uploads/Avatar/" .$item['Image'] ."'".">";
                    }else{
                        echo "<img class='img-thumbnail rounded'" . "src='" ."layout/images/avatar-1024x1024.jpg" ."'".">";
                    }
                    echo "<a href='?itemid=". $item['Items_Id'] ."'" . "class='heart'>
                    <i class='far fa-heart heart2'></i>
                        </a>";
                    echo "</div>";
                    
                    echo "<div class='caption'>";
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
        ?>
    </div>
        
</div>
<?php
include $tbl."footer.php";
ob_end_flush();
?>