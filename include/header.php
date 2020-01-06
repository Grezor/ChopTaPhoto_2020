<?php

require_once  __DIR__ . '/db.php';
require_once  __DIR__ . '/panier.class.php';
require_once  __DIR__ . '/functions.php';

$DB = new DB();
$panier = new Panier($DB);
?>
<!DOCTYPE HTML>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="max-age=604800" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>ChopTaphoto </title>
    <!-- jQuery -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../../public/images/home/logo2.png" rel="shortcut icon" type="image/x-icon">

    <!-- jQuery -->
    <script src="../../public/css/bootstrap.css/js/jquery-2.0.0.min.js" type="text/javascript"></script>

    <!-- Bootstrap4 files-->
    <script src="../../public/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <link href="../../public/css/bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- Font awesome 5 -->
    <link href="../../public/fonts/fontawesome/css/all.min.css" type="text/css" rel="stylesheet">

    <!-- plugin: fancybox  -->
    <script src="../../public/plugins/fancybox/fancybox.min.js" type="text/javascript"></script>
    <link href="../../public/plugins/fancybox/fancybox.min.css" type="text/css" rel="stylesheet">

    <!-- custom style -->
    <link href="../../public/css/ui.css" rel="stylesheet" type="text/css" />
    <link href="../../public/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />

    <!-- custom javascript -->
    <script src="../../public/js/script.js" type="text/javascript"></script>

</head>

<body>

    <header class="section-header">

        <section class="header-main border-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-4">
                        <a href="../index.php" class="brand-wrap">
                            <img class="logo" src="../images/home/logo1.png">
                        </a>
                        <!-- brand-wrap.// -->
                    </div>
                    <div class="col-lg-6 col-sm-12">


                    </div>

                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="widgets-wrap float-md-right">
                            <div class="widget-header  mr-3">
                                <a href="../panier/manage.php" class="icon icon-sm rounded-circle border"><i class="fa fa-shopping-cart"></i></a>
                                <span class="badge badge-pill badge-danger notify"><?= $panier->countPanier(); ?></span>
                            </div>
                            <div class="widget-header icontext">
                                <a href="#" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
                                <div class="text">
                                    <span class="text-muted">Bienvenue!</span>
                                    <div>


                                        <?php
                                        //    var_dump($_SESSION['auth']);
                                        if (isset($_SESSION['auth'])) : ?>
                                            <a href="../auth/logout.php">Se deconnecter</a>
                                            <a href="../auth/account.php">Mon compte</a>
                                            <?php if (isAdmin($_SESSION['auth'])) : ?>
                                                <a href="../auth/roles.php">roles</a>
                                                <a href="../auth/dashboard.php">dashboard</a>
                                                <a href="../auth/addCoupon.php">Crée coupon</a>
                                                <a href="../auth/addProduct.php">Crée produit</a>
                                                <a href="../auth/addCategory.php">Crée Category</a>
                                                <a href="../auth/allUsers.php">Liste utilisateurs</a>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <a href="./app/auth/login.php">Connexion</a> |
                                            <a href="./app/auth/register.php">Inscription</a>

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