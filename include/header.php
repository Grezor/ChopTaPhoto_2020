<?php 

require_once  __DIR__ . '/db.php';
require_once  __DIR__ . '/panier.class.php';
require_once  __DIR__ . '/functions.php';

$DB = new DB();
$panier = new Panier($DB);

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <base href="http://localhost/Ecommerce_Bootstrap/">
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="max-age=604800" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>ChopTaPhoto</title>

    <link href="images/home/logo2.png" rel="shortcut icon" type="image/x-icon">

    <!-- jQuery -->
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

    <!-- Bootstrap4 files-->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/basic.css" rel="stylesheet" type="text/css" />


    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Font awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"> 

    <!-- plugin: fancybox  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js" type="text/javascript"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" type="text/css" rel="stylesheet">

    <!-- custom style -->
    <link href="css/ui.css" rel="stylesheet" type="text/css" />
    <link href="css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />

    <!-- custom javascript -->
    <script src="js/script.js" type="text/javascript"></script>

    

</head>

<body>

    <header class="section-header">

        <section class="header-main border-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-4">
                        <a href="index.php" class="brand-wrap">
                            <img class="logo" src="images/home/logo1.png">
                        </a>
                        <!-- brand-wrap.// -->
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <!-- <form action="#" class="search">
                            <div class="input-group w-100">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
			        <i class="fa fa-search"></i>
			                        </button>
                                </div>
                            </div>
                        </form> -->
                     
                    </div>
                    
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="widgets-wrap float-md-right">
                            <div class="widget-header  mr-3">
                                <a href="../Ecommerce_Bootstrap/panier/manage.php" class="icon icon-sm rounded-circle border"><i class="fa fa-shopping-cart"></i></a>
                                <span class="badge badge-pill badge-danger notify"><?= $panier->countPanier(); ?></span>
                            </div>
                            <div class="widget-header icontext">
                                <a href="#" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
                                <div class="text">
                                    <span class="text-muted">Bienvenue!</span>
                                    <div>

                
                <?php
            //    var_dump($_SESSION['auth']);
               if(isset($_SESSION['auth'])): ?>
                <a href="auth/logout.php">Se deconnecter</a>
                <a href="auth/account.php">Mon compte</a>
                <?php if (isAdmin($_SESSION['auth'])): ?>
                   <a href="auth/roles.php">roles</a>
                   <a href="auth/dashboard.php">dashboard</a>
                   <a href="auth/addCoupon.php">Crée coupon</a>
                   <a href="auth/addProduct.php">Crée produit</a>
                   <a href="auth/addCategory.php">Crée Category</a>
                   <a href="auth/allUsers.php">Liste utilisateurs</a>
                   <?php endif; ?>
                <?php else: ?>
                    <a href="auth/login.php">Connexion</a> |
                                        <a href="auth/register.php">Inscription</a>
                
            <?php endif; ?>
            
            



                                    </div>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                    
                </div>
        
            </div>
          
        </section>
      
    </header>
