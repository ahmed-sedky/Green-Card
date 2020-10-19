<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo $css;?>bootstrap.min.css">
    <link rel="stylesheet" href= "<?php echo $css;?>fontawesome.min.css">
    <link rel="stylesheet" href= "<?php echo $css;?>jquery.selectBoxIt.css">
    <link rel="stylesheet" href= "<?php echo $css;?>jquery.selectBoxIt.sass">
    <link rel="stylesheet" href= "<?php echo $css;?>all.min.css">
    <link rel="stylesheet" href= "<?php echo $css;?>frontend.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Lobster&family=Permanent+Marker&display=swap" rel="stylesheet">
    <title><?php getTitle() ?></title>
</head>
<body>

<?php
if (isset($_GET['lang'])){
    if($_GET['lang'] == "En"){?>
        <nav class="navbar navbar-expand-md navbar2 navbar-dark bg-dark ">
            <div class="container">
                <a class="navbar-brand" href="index.php?lang=En"><span>Green </span>Card</a>
                <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="container">
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item ">
                            <a class="nav-link" href="index.php?lang=En"> <?php echo lang("HOMEPAGE");?> <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <form action="tags.php?name=<?php echo strToLower(filter_var($_GET['name']),FILTER_SANITIZE_STRING);?>" method="GET" class="form-inline my-2 my-lg-0">
                        <div class="row">
                            <input class="form-control mr-sm-2" type="search" placeholder="<?php echo lang("SEARCH");?>" name='name' aria-label="Search">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit"><?php echo lang("SEARCH");?></button>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <?php
                            $cats =getAll("*" ,"categories", "WHERE Parent = 0","Id","ASC");
                            foreach( $cats as $cat ){
                                $subCats = getAll("*" , "categories" , "WHERE Parent = {$cat['Id']}" ,"Id");
                                if (! empty($subCats)){?>
                                <li class="nav-item dropdown">
                                    <?php
                                        echo "<a class='nav-link dropdown-toggle' href='categories.php?lang=En&catid=" .$cat['Id'] ."&pagename=" .str_replace(" ","-",$cat['Name']) ."'id='navbarDropdown3' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" . $cat['Name'] ."</a>";
                                        ?>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                                        <?php
                                            foreach( $subCats as $c ){
                                        ?>
                                                
                                                    <?php
                                                        echo "<a class='dropdown-item' href='categories.php?lang=En&catid=" .$c['Id'] ."&pagename=" .str_replace(" ","-",$c['Name']) ."'>" . $c['Name'] ."</a>";
                                                    ?>
                                        <?php
                                            }
                                            ?>
                                        </div>
                                    </li>

                                            <?php
                                }else{
                                    echo "<li class='nav-item'><a class='nav-link' href='categories.php?lang=En&catid=" .$cat['Id'] ."&pagename=" .str_replace(" ","-",$cat['Name']) ."'>" . $cat['Name'] ."</a></li>";
                                }
                                
                            }
                        ?>
                    </ul>
                </div>
                </div>
                
            </div>
            
        </nav>
        <div class="container">
                <?php
                if(isset($_SESSION['user'])){
                    global $db;
                    $stmt5 = $db->prepare("SELECT * FROM user WHERE UserName=?");
                    $stmt5->execute(array($_SESSION['user']));
                    $users = $stmt5->fetch();
                    ?>
                    <nav class="navbar navbar-expand-lg  nav-date ">
                    <span><?php echo date("Y-m-d h:i:sa");?></span>
                    <?php
                        if(isset($_GET['lang'])){
                            if($_GET['lang'] == "Ar"){
                                echo "<a class='lang' href='?lang=En'>English</a>";
                            }else{
                                echo "<a class='lang' href='?lang=Ar'>العربية</a>";
                            }
                        }
                    ?>
                        <button class="navbar-toggler btn-btn-primary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse " id="navbarSupportedContent2">
                            <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle border-primary " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php
                                    if(! empty($users['Image'])){?>
                                        <img class='profile-img' src="<?php echo "control/Uploads/Avatar/" . $users['Image'];?>" alt="profile_img" >
                                        <?php
                                    }else{
                                        ?>
                                        <img class='profile-img' src="layout/images/avatar-1024x1024.jpg" alt="profile_img" >
                                        <?php
                                    }?>
                                <?php echo $_SESSION['user'];
                                ?>
                                </a>
                                <div class="dropdown-menu important2" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="profile.php?lang=En"><?php echo lang("MYPROFILE");?></a>
                                    <a class="dropdown-item" href="newad.php?lang=En"><?php echo lang("NEWAD");?></a>
                                    <a class="dropdown-item" href="profile.php?lang=En#my_ads"><?php echo lang("MYITEMS");?></a>
                                    <a class="dropdown-item" href="favourites.php?lang=En"><?php echo lang("WISHLIST");?></a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php?"><?php echo lang("LOGOUT");?> </a>
                                </div>
                            </li>
                        </div>
                        <?php
                        $userStatus = checkUSerStatus($_SESSION['user']);
                        if ($userStatus == 1){
                            echo "Your Membership Is Needed To Be Activated by Admin";
                        }
                        }else{?>
                            <a href="login.php?lang=En">
                            <span class="right btn btn-primary"><?php echo lang("LOGIN/SIGNUP");?></span>
                            </a>
                            <?php
                            if(isset($_GET['lang'])){
                                if($_GET['lang'] == "Ar"){
                                    echo "<a class='lang' href='?lang=En'>English</a>";
                                }else{
                                    echo "<a class='lang' href='?lang=Ar'>العربية</a>";
                                }
                            }
                            ?>
                        <?php
                        }
                    ?>
                        </nav>
                    
        </div><?php
    }else{?>
        <nav class="navbar navbar-expand-md navbar2 navbar-dark bg-dark ">
            <div class="container">
                <a class="navbar-brand" href="index.php?lang=Ar"><span>Green </span>Card</a>
                <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="container">
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item ">
                            <a class="nav-link" href="index.php?lang=Ar"> <?php echo lang("HOMEPAGE");?> <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <form action="tags.php?name=<?php echo strToLower(filter_var($_GET['name']),FILTER_SANITIZE_STRING);?>" method="GET" class="form-inline my-2 my-lg-0">
                        <div class="row">
                            <input class="form-control mr-sm-2" type="search" placeholder="<?php echo lang("SEARCH");?>" name='name' aria-label="Search">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit"><?php echo lang("SEARCH");?></button>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <?php
                            $cats =getAll("*" ,"categories", "WHERE Parent = 0","Id","ASC");
                            foreach( $cats as $cat ){
                                $subCats = getAll("*" , "categories" , "WHERE Parent = {$cat['Id']}" ,"Id");
                                if (! empty($subCats)){?>
                                <li class="nav-item dropdown">
                                    <?php
                                        echo "<a class='nav-link dropdown-toggle' href='categories.php?lang=Ar&catid=" .$cat['Id'] ."&pagename=" .str_replace(" ","-",$cat['Name']) ."'id='navbarDropdown3' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" . $cat['Name'] ."</a>";
                                        ?>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                                        <?php
                                            foreach( $subCats as $c ){
                                        ?>
                                                
                                                    <?php
                                                        echo "<a class='dropdown-item' href='categories.php?lang=Ar&catid=" .$c['Id'] ."&pagename=" .str_replace(" ","-",$c['Name']) ."'>" . $c['Name'] ."</a>";
                                                    ?>
                                        <?php
                                            }
                                            ?>
                                        </div>
                                    </li>

                                            <?php
                                }else{
                                    echo "<li class='nav-item'><a class='nav-link' href='categories.php?lang=Ar&catid=" .$cat['Id'] ."&pagename=" .str_replace(" ","-",$cat['Name']) ."'>" . $cat['Name'] ."</a></li>";
                                }
                                
                            }
                        ?>
                    </ul>
                </div>
                </div>
                
            </div>
            
        </nav>
        <div class="container">
                <?php
                if(isset($_SESSION['user'])){
                    global $db;
                    $stmt5 = $db->prepare("SELECT * FROM user WHERE UserName=?");
                    $stmt5->execute(array($_SESSION['user']));
                    $users = $stmt5->fetch();
                    ?>
                    <nav class="navbar navbar-expand-lg  nav-date ">
                    <span><?php echo date("Y-m-d h:i:sa");?></span>
                    <?php
                        if(isset($_GET['lang'])){
                            if($_GET['lang'] == "Ar"){
                                echo "<a class='lang' href='?lang=En'>English</a>";
                            }else{
                                echo "<a class='lang' href='?lang=Ar'>العربية</a>";
                            }
                        }
                    ?>
                        <button class="navbar-toggler btn-btn-primary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse " id="navbarSupportedContent2">
                            <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle border-primary " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php
                                    if(! empty($users['Image'])){?>
                                        <img class='profile-img' src="<?php echo "control/Uploads/Avatar/" . $users['Image'];?>" alt="profile_img" >
                                        <?php
                                    }else{
                                        ?>
                                        <img class='profile-img' src="layout/images/avatar-1024x1024.jpg" alt="profile_img" >
                                        <?php
                                    }?>
                                <?php echo $_SESSION['user'];
                                ?>
                                </a>
                                <div class="dropdown-menu important2" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="profile.php?lang=Ar"><?php echo lang("MYPROFILE");?></a>
                                    <a class="dropdown-item" href="newad.php?lang=Ar"><?php echo lang("NEWAD");?></a>
                                    <a class="dropdown-item" href="profile.php#my_ads?lang=Ar"><?php echo lang("MYITEMS");?></a>
                                    <a class="dropdown-item" href="#"><?php echo lang("WISHLIST");?></a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php?"><?php echo lang("LOGOUT");?> </a>
                                </div>
                            </li>
                        </div>
                        <?php
                        $userStatus = checkUSerStatus($_SESSION['user']);
                        if ($userStatus == 1){
                            echo "Your Membership Is Needed To Be Activated by Admin";
                        }
                        }else{?>
                            <a href="login.php?lang=Ar">
                            <span class="right btn btn-primary"><?php echo lang("LOGIN/SIGNUP");?></span>
                            </a>
                            <?php
                                if(isset($_GET['lang'])){
                                    if($_GET['lang'] == "Ar"){
                                        echo "<a class='lang' href='?lang=En'>English</a>";
                                    }else{
                                        echo "<a class='lang' href='?lang=Ar'>العربية</a>";
                                    }
                                }
                            ?>
                        <?php
                        }
                    ?>
                        </nav>
                    
        </div>
        <?php
    }
}else{?>
<nav class="navbar navbar-expand-md navbar2 navbar-dark bg-dark ">
            <div class="container">
                <a class="navbar-brand" href="index.php?lang=En"><span>Green </span>Card</a>
                <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="container">
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item ">
                            <a class="nav-link" href="index.php?lang=En"> <?php echo lang("HOMEPAGE");?> <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <form action="tags.php?name=<?php echo strToLower(filter_var($_GET['name']),FILTER_SANITIZE_STRING);?>" method="GET" class="form-inline my-2 my-lg-0">
                        <div class="row">
                            <input class="form-control mr-sm-2" type="search" placeholder="<?php echo lang("SEARCH");?>" name='name' aria-label="Search">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit"><?php echo lang("SEARCH");?></button>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <?php
                            $cats =getAll("*" ,"categories", "WHERE Parent = 0","Id","ASC");
                            foreach( $cats as $cat ){
                                $subCats = getAll("*" , "categories" , "WHERE Parent = {$cat['Id']}" ,"Id");
                                if (! empty($subCats)){?>
                                <li class="nav-item dropdown">
                                    <?php
                                        echo "<a class='nav-link dropdown-toggle' href='categories.php?lang=En&catid=" .$cat['Id'] ."&pagename=" .str_replace(" ","-",$cat['Name']) ."'id='navbarDropdown3' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" . $cat['Name'] ."</a>";
                                        ?>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                                        <?php
                                            foreach( $subCats as $c ){
                                        ?>
                                                
                                                    <?php
                                                        echo "<a class='dropdown-item' href='categories.php?lang=En&catid=" .$c['Id'] ."&pagename=" .str_replace(" ","-",$c['Name']) ."'>" . $c['Name'] ."</a>";
                                                    ?>
                                        <?php
                                            }
                                            ?>
                                        </div>
                                    </li>

                                            <?php
                                }else{
                                    echo "<li class='nav-item'><a class='nav-link' href='categories.php?lang=En&catid=" .$cat['Id'] ."&pagename=" .str_replace(" ","-",$cat['Name']) ."'>" . $cat['Name'] ."</a></li>";
                                }
                                
                            }
                        ?>
                    </ul>
                </div>
                </div>
                
            </div>
            
        </nav>
        <div class="container">
                <?php
                echo "<a class='lang' href='?lang=Ar'>العربية</a>";
                if(isset($_SESSION['user'])){
                    global $db;
                    $stmt5 = $db->prepare("SELECT * FROM user WHERE UserName=?");
                    $stmt5->execute(array($_SESSION['user']));
                    $users = $stmt5->fetch();
                    ?>
                    <nav class="navbar navbar-expand-lg  nav-date ">
                    <span><?php echo date("Y-m-d h:i:sa");?></span>
                    
                        <button class="navbar-toggler btn-btn-primary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse " id="navbarSupportedContent2">
                            <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle border-primary " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php
                                    if(! empty($users['Image'])){?>
                                        <img class='profile-img' src="<?php echo "control/Uploads/Avatar/" . $users['Image'];?>" alt="profile_img" >
                                        <?php
                                    }else{
                                        ?>
                                        <img class='profile-img' src="layout/images/avatar-1024x1024.jpg" alt="profile_img" >
                                        <?php
                                    }?>
                                <?php echo $_SESSION['user'];
                                ?>
                                </a>
                                <div class="dropdown-menu important2" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="profile.php?lang=En"><?php echo lang("MYPROFILE");?></a>
                                    <a class="dropdown-item" href="newad.php?lang=En"><?php echo lang("NEWAD");?></a>
                                    <a class="dropdown-item" href="profile.php#my_ads?lang=En"><?php echo lang("MYITEMS");?></a>
                                    <a class="dropdown-item" href="#"><?php echo lang("WISHLIST");?></a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php?"><?php echo lang("LOGOUT");?> </a>
                                </div>
                            </li>
                        </div>
                        <?php
                        $userStatus = checkUSerStatus($_SESSION['user']);
                        if ($userStatus == 1){
                            echo "Your Membership Is Needed To Be Activated by Admin";
                        }
                        }else{?>
                            <a href="login.php?lang=En">
                            <span class="right btn btn-primary"><?php echo lang("LOGIN/SIGNUP");?></span>
                            </a>
                            <?php
                                if(isset($_GET['lang'])){
                                    if($_GET['lang'] == "Ar"){
                                        echo "<a class='lang' href='?lang=En'>English</a>";
                                    }else{
                                        echo "<a class='lang' href='?lang=Ar'>العربية</a>";
                                    }
                                }
                            ?>
                        <?php
                        }
                    ?>
                        </nav>
                    
        </div>
<?php
}
?>

