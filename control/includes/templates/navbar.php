<?php
if(isset($_GET['lang'])){
    if($_GET['lang'] == "En"){?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php"><span>Green</span>Card</a>
            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="container">
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="dashboard.php?lang=En"><?php echo lang('Admin_Home'); ?> <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categories.php?lang=En"><?php echo lang('categories'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="items.php?lang=En"><?php echo lang('ITEMS'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="comments.php?lang=En"><?php echo lang('COMMENTS'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="members.php?lang=En"><?php echo lang('Members'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><?php echo lang('STATISTICS'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><?php echo lang('LOGS'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href= "?lang=Ar">العربية</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo lang('username'); ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <!-- lazem el and el 1 "?" w el tanya &-->
                        <a class="dropdown-item" href="../index.php"> <?php echo lang('VISIT SHOP'); ?></a>
                        <a class="dropdown-item" href="members.php?lang=En&do=Edit&userid=<?php echo $_SESSION['id']?>"> <?php echo lang('edit-profile'); ?></a>
                        <a class="dropdown-item" href="#"><?php echo lang('settings'); ?></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php"><?php echo lang('log_out'); ?></a>
                        </div>
                </li>
                </ul>
            </div>
            </div>
            
        </div>
    
</nav><?php
    }else{?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php"><span>Green</span>Card</a>
        <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container">
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="dashboard.php?lang=Ar"><?php echo lang('Admin_Home'); ?> <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.php?lang=Ar"><?php echo lang('categories'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="items.php?lang=Ar"><?php echo lang('ITEMS'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="comments.php?lang=Ar"><?php echo lang('COMMENTS'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="members.php?lang=Ar"><?php echo lang('Members'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo lang('STATISTICS'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo lang('LOGS'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?lang=En">ENGLISH</a>
                </li>
                
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo lang('username'); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <!-- lazem el and el 1 "?" w el tanya &-->
                    <a class="dropdown-item" href="../index.php"> <?php echo lang('VISIT SHOP'); ?></a>
                    <a class="dropdown-item" href="members.php?lang=Ar&do=Edit&userid=<?php echo $_SESSION['id']?>"> <?php echo lang('edit-profile'); ?></a>
                    <a class="dropdown-item" href="#"><?php echo lang('settings'); ?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"><?php echo lang('log_out'); ?></a>
                    </div>
            </li>
            </ul>
        </div>
        </div>
        
    </div>
    
</nav>
<?php
    }
    ?>
    
<?php
}else{?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php"><span>Green</span>Card</a>
        <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container">
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="dashboard.php?lang=En"><?php echo lang('Admin_Home'); ?> <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.php?lang=En"><?php echo lang('categories'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="items.php?lang=En"><?php echo lang('ITEMS'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="comments.php?lang=En"><?php echo lang('COMMENTS'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="members.php?lang=En"><?php echo lang('Members'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo lang('STATISTICS'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo lang('LOGS'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href= "?lang=Ar">العربية</a>
                </li>
                
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo lang('username'); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <!-- lazem el and el 1 "?" w el tanya &-->
                    <a class="dropdown-item" href="../index.php"> <?php echo lang('VISIT SHOP'); ?></a>
                    <a class="dropdown-item" href="members.php?lang=En&do=Edit&userid=<?php echo $_SESSION['id']?>"> <?php echo lang('edit-profile'); ?></a>
                    <a class="dropdown-item" href="#"><?php echo lang('settings'); ?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"><?php echo lang('log_out'); ?></a>
                    </div>
            </li>
            </ul>
        </div>
        </div>
        
    </div>
    
</nav>
<?php
}
?>
