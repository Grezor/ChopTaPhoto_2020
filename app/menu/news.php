<?php require_once(__DIR__ . '/../../include/header.php');?>
<style>
    .image_about {
        background-size: cover;
        width: 150px;
    }

    .img-big-wrap {
        background-size: cover;
    }
</style>

<div class="card mt-5">
    <div class="row no-gutters">
        <div class="container">
            <h1>Nouveauté </h1>
        </div>
        <div class="container">


            <?php
            $products = $DB->query('SELECT p.id as p_id, p.name, p.description, p.created_at, pimg.path, p.created_at
                                FROM product AS p 
                                LEFT JOIN product_image AS pimg ON p.id = pimg.product_id AND pimg.is_main = 1 
                                WHERE DATE_SUB(now(), INTERVAL 7 DAY ) < p.created_at');
            foreach ($products as $product) :
                $loop = true;
                ?>
            <div class="col-md-4">
                <figure class="card card-product-grid">
                    <div class="img-wrap">
                        <span class="badge badge-danger"> NEW </span>
                        <?php $productImage = $product->path ?? 'images/shop/default.jpg'; ?>
                        <img src="../<?= $productImage; ?>">
                        <a class="btn-overlay" href="/produit/<?= $product->p_id; ?>"><i class="fa fa-search-plus"></i>
                            Plus d'infos</a>
                    </div>
                    <figcaption class="info-wrap">
                        <div class="fix-height">
                            <a href="/produit/<?= $product->p_id; ?>" class="title"><?= $product->name; ?></a>
                            <div class="price-wrap mt-2">

                                <span class=""><?= $product->description; ?></span>
                            </div>
                        </div>

                    </figcaption>
                </figure>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . '/../../include/footer.php';
?>