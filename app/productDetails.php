<?php
// afficher le produit en détails
require_once (__DIR__ . '/../include/header.php');
require_once (__DIR__ . '/../include/vote.php');
ob_start();

$vote = false;
if(isset($_SESSION['auth']->id)){
    $req = $pdo->prepare('SELECT * FROM votes WHERE ref = :ref AND product_id = :product_id AND client_id = :client_id');
    $req->execute([
        ':ref' => 'product',
        ':product_id' => $productId,
        ':client_id' => $_SESSION['auth']->id
    ]);
    $vote = $req->fetch();

}

$products = $DB->query('SELECT p.id as p_id, p.name, p.price, p.description, p.ref, pimg.path, p.like_count, p.dislike_count 
                        FROM product AS p LEFT JOIN product_image AS pimg ON p.id = pimg.product_id AND pimg.is_main = 1 
                        WHERE p.id=:id', ['id' => $productId]);
if (count($products) === 0) {
    pageNotFound('Produit introuvable');
    exit();
}
?>
<section class="section-pagetop bg">
    <div class="container">
        <?php foreach ($products as $product) : ?>
        <h2 class="title-page">Produit <?= $product->name; ?></h2>
        <?php endforeach; ?>
    </div>

</section>

<?php foreach ($products as $product) : ?>

<div class="container">
    <div class="col-md-3">
        <a href="/" class="btn btn-block btn-primary">Retour</a>
    </div>
    </figcaption>
    <br>
    <br>
    <br>
    <br>
    <br>
    <article class="card card-product-list">
        <div class="row no-gutters">
            <aside class="col-md-3">
                <?php $productImage = $product->path ?? 'images/shop/default.jpg'; ?>

                <a href="#" class="img-wrap"><img src="../<?= $productImage; ?>"></a>
            </aside>
            <div class="col-md-6">
                <div class="info-main">
                    <a href="#" class="h5 title"> <?= $product->name; ?></a>

                    <span class="badge badge-secondary"><?= $product->ref; ?></span>

                    <p> <?= $product->description; ?></p>
                </div>

            </div>

            <aside class="col-sm-3">
                <div class="info-aside">
                    <div class="price-wrap">
                        <span class="price h5"><?= $product->price; ?> €</span>
                    </div>
                    <p class="text-success">Prix avec TVA : <?= number_format($product->price * 1.2, 2, ',', ' ') ?>€
                    </p>
                    <br>
                    <p>
                        <a href="../app/panier/add.php?id=<?= $product->p_id; ?>" class="btn btn-primary btn-block">
                            Ajouter au panier </a>

                        <div class="vote <?= Vote::getClass($vote); ?>" id="vote" data-id="<?= $product->p_id; ?>"
                            data_ref="product" data-ref_id="<?= $product->p_id; ?>"
                            data-user_id="<?= $_SESSION['auth']->id; ?>">
                            <div class="vote_bar">
                                <div class="vote_progress"
                                    style="width: <?= ($product->like_count + $product->dislike_count) == 0 ? 100 : round(100 * ($product->like_count / ($product->like_count + $product->dislike_count) )) ?>%">

                                </div>
                            </div>
                            <div class="vote_btns">
                                <button class="vote_btn vote_like">
                                    <i class="fa fa-thumbs-up"></i>
                                    <?= $product->like_count; ?>
                                </button>
                                <button class="vote_btn vote_dislike">
                                    <i class="fa fa-thumbs-down"></i>
                                    <?= $product->dislike_count; ?>
                                </button>
                            </div>
                        </div>
                    </p>
                </div>
            </aside>
        </div>
    </article>
    <?php endforeach; ?>
</div>
</section>

<style>
    [class*='card-product'] .badge {
        top: 10px;
        left: 10px;
        position: relative;
    }
</style>
<?php 
include_once __DIR__ . '/../include/footer.php';
?>