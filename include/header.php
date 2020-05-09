<?php
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0", false);
// header("Pragma: no-cache");

require_once  __DIR__ . '/db.php';
require_once  __DIR__ . '/panier.class.php';
require_once  __DIR__ . '/vote.php';
require_once  __DIR__ . '/functions.php';

$DB = new DB();
$panier = new Panier($DB);
header('Content-type: text/html; charset=UTF-8');
?>
<!DOCTYPE HTML>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache" />
    <!-- <meta http-equiv="cache-control" content="max-age=604800" /> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>ChopTaphoto </title>
    <!-- jQuery -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../../public/images/home/logo2.png" rel="shortcut icon" type="image/x-icon">
    <!-- <script src="../../public/css/bootstrap.css/js/jquery-2.0.0.min.js" type="text/javascript"></script> -->
    <!-- <script src="../../public/js/bootstrap.bundle.min.js" type="text/javascript"></script> -->
    <link href="../../public/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../../public/fonts/all.min.css" type="text/css" rel="stylesheet">
    <!-- custom style -->
    <link href="../../public/css/ui.css" rel="stylesheet" type="text/css" />
    <link href="../../public/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />

    <!-- custom javascript -->

</head>

<body>
    <section>
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom header-main">
            <div class="container">
                <a href="/" class="brand-wrap">
                    <img class="logo" src="/images/home/logo1.png">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/about">Propos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/newproduct">nouveauté</a>
                        </li>
                    </ul>
                </div>

                <style>

                </style>
                <ul class="navbar-nav">
                    <div class="widget-header  mr-3">
                        <a href="app/panier/manage.php" class="icon icon-sm rounded-circle border">
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                        <span class="badge badge-pill badge-danger notify"><?= $panier->countPanier(); ?></span>
                    </div>
                    <?php
                    if (isset($_SESSION['auth'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Se deconnecter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/account">Mon compte</a>
                    </li>
                    <div class="my-2 my-lg-0">

                        <?php if (isAdmin($_SESSION['auth'])) : ?>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action page
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/authbooking">reservation</a>
                                <a class="dropdown-item" href="/achatClient">Achats Clients</a>
                                <a class="dropdown-item" href="/addCoupon">Création coupon</a>
                                <a class="dropdown-item" href="/addProduct">Création produit</a>
                                <a class="dropdown-item" href="/addCategory">Création categorie</a>
                                <a class="dropdown-item" href="/allUsers">Liste utilisateurs</a>
                                <a class="dropdown-item" href="/allCoupon">Liste coupons</a>
                                <a class="dropdown-item" href="/allProduct">Liste produits</a>
                                <a class="dropdown-item" href="/allProduct">Liste catégorie</a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php else : ?>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/login">Connexion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/register">Inscription</a>
                            </li>
                        </ul>

                        <?php endif; ?>
                    </div>
        </nav>

        </div>
    </section>


<!-- 
    <style>
        .navbar-light .nav-link {
            color: rgba(0, 0, 0, 0.5);
            font-weight: 700;
        }

        .header-main {
            position: relative;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
    </style> -->