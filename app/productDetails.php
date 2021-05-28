<?php
// afficher le produit en détails
require_once(__DIR__ . '/../include/header.php');
require_once(__DIR__ . '/../include/vote.php');
ob_start();

$vote = false;
if (isset($_SESSION['auth']->id)) {
    $req = $pdo->prepare('SELECT * FROM votes WHERE ref = :ref AND product_id = :product_id AND client_id = :client_id');
    $req->execute([
        ':ref' => 'product',
        ':product_id' => $productId,
        ':client_id' => $_SESSION['auth']->id
    ]);
    $vote = $req->fetch();
}

$products = $DB->query('SELECT p.id as p_id, p.name, p.price, p.quantity, p.description, p.descriptionDetails, p.color,
                            p.ref, pimg.path, p.like_count, p.dislike_count 
                        FROM product AS p 
                            LEFT JOIN product_image AS pimg ON p.id = pimg.product_id 
                        AND pimg.is_main = 1 
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
    <div class="col-md-3 mb-3">
        <a href="/" class="btn btn-block btn-primary">Retour</a>
    </div>



    <output class="mt-3">
        <div class="card">
            <div class="row no-gutters">
                <aside class="col-md-6">
                    <article class="gallery-wrap">
                        <div class="img-big-wrap">
                            <?php $productImage = $product->path ?? 'images/shop/default.jpg'; ?>
                            <div><a href="#" class="img-wrap"><img src="../<?= $productImage; ?>"></a></div>
                        </div>
                    </article>
                </aside>
                <main class="col-md-6 border-left">
                    <article class="content-body">

                        <h2 class="title"><?= $product->name; ?></h2>
                        <h5>
                            <small class="text-uppercase">Quantité </small>
                            <span class="badge badge-danger"><?= $product->quantity; ?></span>
                        </h5>

                        <div class="rating-wrap my-3">
                            <ul class="rating-stars">
                                <li style="width:80%" class="stars-active">
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </li>
                            </ul>

                            <div class="vote <?= Vote::getClass($vote); ?>" id="vote" data-id="<?= $product->p_id; ?>"
                                data_ref="product" data-ref_id="<?= $product->p_id; ?>"
                                data-user_id="<?= $_SESSION['auth']->id; ?>">
                                <div class="vote_bar">
                                    <?php $total = $product->like_count + $product->dislike_count; ?>
                                    <div class="vote_progress"
                                        style="width: <?= ($total) == 0 ? 100 :
                                        round(100 * ($product->like_count / ($total) )) ?>%">
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

                            <small class="label-rating text-muted">132 reviews</small>
                            <small class="label-rating text-success"> <i class="fa fa-clipboard-check"></i> 154 orders
                            </small>
                        </div>

                        <div class="mb-3">
                            <var class="price h4"><?= $product->price; ?> €</var>
                            <span class="text-muted">
                                <p class="text-success">Prix avec TVA :
                                    <?= number_format($product->price * 1.2, 2, ',', ' ') ?>€
                                </p>
                            </span>
                        </div>

                        <p><?= $product->description; ?></p>

                        <dl class="row">
                            <dt class="col-sm-3">reference :</dt>
                            <dd class="col-sm-9"><?= $product->ref; ?></dd>

                            <dt class="col-sm-3">Color</dt>
                            <dd class="col-sm-9"><?= $product->color; ?></dd>

                            <dt class="col-sm-3">Delivery</dt>
                            <dd class="col-sm-9">Russia, USA, and Europe </dd>
                        </dl>

                        <hr>

                        <a href="../app/panier/add.php?id=<?= $product->p_id; ?>" class="btn btn-primary btn-block">
                            Ajouter au panier </a>

                    </article>
                </main>
            </div>
        </div>
    </output>
<?php endforeach; ?>
</div>
<br>
<br>
<br>
<br>
<?php
include_once __DIR__ . '/../include/footer.php';
?>