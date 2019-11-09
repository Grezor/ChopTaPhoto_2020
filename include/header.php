<?php 
require_once 'include/db.php';
 require_once 'include/panier.class.php';
$DB = new DB();
$panier = new Panier($DB);
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="max-age=604800" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>ChopTaPhoto</title>

    <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">

    <!-- jQuery -->
    <script src="js/jquery-2.0.0.min.js" type="text/javascript"></script>

    <!-- Bootstrap4 files-->
    <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- Font awesome 5 -->
    <link rel="stylesheet" href="css/font-awesome.min.css"> 

    <!-- plugin: fancybox  -->
    <script src="plugins/fancybox/fancybox.min.js" type="text/javascript"></script>
    <link href="plugins/fancybox/fancybox.min.css" type="text/css" rel="stylesheet">

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
                            <img class="logo" src="images/home/home.png">
                        </a>
                        <!-- brand-wrap.// -->
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <form action="#" class="search">
                            <div class="input-group w-100">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
			        <i class="fa fa-search"></i>
			      </button>
                                </div>
                            </div>
                        </form>
                        <!-- search-wrap .end// -->
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
                                        <a href="#">Connexion</a> |
                                        <a href="#">Inscription</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- widgets-wrap.// -->
                    </div>
                    <!-- col.// -->
                </div>
                <!-- row.// -->
            </div>
            <!-- container.// -->
        </section>
        <!-- header-main .// -->
    </header>
    <!-- section-header.// -->