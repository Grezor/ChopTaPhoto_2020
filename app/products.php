<?php
include_once __DIR__ . '/../include/header.php';
require_once __DIR__ . '/../include/db.php';
require_once __DIR__ . '/../include/functions.php';

$panier = new Panier($DB);
$categoryId = intval($_GET['category'] ?? 0);

if (isset($_SESSION['flash'])) : ?>
    <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
        <div class="alert alert-<?= $type; ?>">
            <?= $message ?>
        </div>
    <?php endforeach ?>
<?php unset($_SESSION['flash']);
endif ?>
<section class="section-pagetop bg">
    <div class="container">
        <h2 class="title-page">Produits</h2>
    </div>

</section>

<section class="section-content padding-y">
    <div class="container">

        <div class="row">
            <aside class="col-md-3">

                <div class="card">
                    <article class="filter-group">
                        <header class="card-header">
                            <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="">
                                <i class="icon-control fa fa-chevron-down"></i>
                                <h6 class="title">Catégorie</span></h6>
                            </a>
                        </header>
                        <div class="filter-content collapse show" id="collapse_1">
                            <div class="card-body">
                                <?php $category = $DB->query('SELECT id, name FROM category');
                                    foreach ($category as $categorie) :
                                ?>
                                    <ul class="list-menu">
                                        <li><a href='/?category=<?= $categorie->id ?>'><?= $categorie->name; ?></a></li>
                                    </ul>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </article>


                </div>
            </aside>   

            <main class="col-md-9">
                <div class="row">

                    <?php
                    // Affichage de la listes des produits
                    $where = '';
                    if (!empty($categoryId)) {
                        $where = 'WHERE category_id = '.$DB->getDB()->quote($categoryId);
                    }
                    $loop = false;

                    $products = $DB->query('SELECT p.id as p_id, p.name, p.price, p.description,p.is_location,p.quantity,
                        p.created_at, (DATE_SUB(now(), INTERVAL 1 HOUR) < p.created_at) AS is_new, pimg.path
                        FROM product AS p LEFT JOIN product_image AS pimg ON p.id = pimg.product_id AND pimg.is_main = 1 '.$where.' ORDER BY p.created_at');
                    foreach ($products as $product) :
                        $loop = true;
                    ?>
                        <div class="col-md-4">
                            <figure class="card card-product-grid">
                                <div class="img-wrap">
                                
                                    <?php if ((int) $product->is_new) : ?>
                                        <span class="badge badge-danger"> NEW </span>
                                    <?php endif; ?>
                                   
                                    <?php $productImage = $product->path ?? 'images/shop/default.jpg'; ?>
                                    <img src="../<?= $productImage; ?>">
                                    <a class="btn-overlay" href="/produit/<?= $product->p_id; ?>"><i class="fa fa-search-plus"></i> Plus d'infos</a>
                                </div>
                                <figcaption class="info-wrap">
                                    <div class="fix-height">
                                        <a href="/produit/<?= $product->p_id; ?>" class="title"><?= $product->name; ?></a>
                                        <div class="price-wrap ">
                                        Quantité : <span class=""> <?= $product->quantity ?></span>  <br>
                                        <span class="price"><?= $product->price; ?> €</span>
                                            <div class="card-body">
                                                <span class=""><?= $product->description; ?></span>
                                            </div>                                          
                                        </div>
                                        <div>
                                        
                                        </div>
                                    </div>
                                    <style>
                                        .badge-quantity{
                                            margin-bottom: 10px;
                                            padding-bottom: 10px;
                                        }

                                       
                                    </style>
                                    <a href="../app/panier/add.php?id=<?= $product->p_id; ?>" class="btn btn-block btn-primary mt-3">Ajouter au Panier </a>
                                    <?php if($product->is_location === '1'){ ?>
                                        <!-- <a href="/login" class="btn btn-block btn-secondary">Réservation</a> -->
                                        <a href="../app/booking/reservations.php?id=<?= $product->p_id; ?>" class="btn btn-block btn-secondary">Reservation</a>
                                    <?php  }?>
                                </figcaption>
                            </figure>
                        </div>

                    <?php endforeach; ?>
                    <?php if ($loop === false): ?>
                        <div class="container">
                            <div class="col-md-12">
                                Aucun élément à afficher (vérifier la catégorie)
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>
</section>
<section>
<?php 
include_once __DIR__ . '/../include/footer.php';
?>
</section>




