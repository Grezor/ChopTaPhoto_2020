<?php
require_once __DIR__ . '/../../include/functions.php';

if (!empty($_POST)) {
    $errors = [];
    require_once __DIR__ . '/../../include/db.php';

    if (empty($_POST['nameCoupon']) || !preg_match('/^[a-zA-Z0-9_+$]/', $_POST['nameCoupon'])) {
        $errors['nameCoupon'] = "Votre nom n'est pas valide";
    } else {
        //si il existe deja
        $req = $pdo->prepare('SELECT id FROM coupon WHERE nameCoupon = ?');
        $req->execute([$_POST['nameCoupon']]);
        $coupon = $req->fetch();
        if ($coupon) {
            $errors['nameCoupon'] = 'Ce nom est déja utilisée';
        }
    }
    if (empty($_POST['code']) || !preg_match('/^[a-zA-Z0-9_+$]/', $_POST['code'])) {
        $errors['code'] = "Votre code n'est pas valide";
    }

    if (empty($_POST['price_reduc']) || !preg_match('/^[a-zA-Z0-9_+$]/', $_POST['price_reduc'])) {
        $errors['price_reduc'] = "Votre price_reduc n'est pas valide";
    }

    if (empty($_POST['started_at'])) {
        $errors['started_at'] = "Votre started_at n'est pas valide";
    }

    if (empty($_POST['finished_at'])) {
        $errors['finished_at'] = "Votre started_at n'est pas valide";
    }

    if (empty($_POST['max_use'])) {
        $errors['max_use'] = "Votre started_at n'est pas valide";
    }

    // Pour envoyer les données a la base de données
    if (empty($errors)) {
        $req = $pdo->prepare("INSERT INTO coupon (
                                nameCoupon, code, product_id, price_reduc, created_at, started_at, finished_at, max_use)
                            VALUES(:nameCoupon, :code, :productId, :priceReduc, now(), :startedAt, :finishedAt, :maxUse)
                            ");

        $req->execute([
            ':nameCoupon' => $_POST['nameCoupon'],
            ':code' => $_POST['code'],
            ':productId' => $_POST['product_id'],
            ':priceReduc' => $_POST['price_reduc'],
            ':startedAt' => $_POST['started_at'],
            ':finishedAt' => $_POST['finished_at'],
            ':maxUse' => $_POST['max_use']
        ]);

        $last_id = $pdo->lastInsertId();
    // On envoit l'email de confirmation
    // mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien
    // \n\nhttp://localhost/Ecommerce_Bootstrap/auth/confirm.php?id=$user_id&token=$token");
    // On redirige l'utilisateur vers la page de login avec un message flash
        $_SESSION['flash']['success'] = 'coupon cree';
        header("Location: /addCoupon");
        exit();
    }
}

require_once(__DIR__ . '/../../include/header.php');

?>
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">

<!-- ============================ COMPONENT REGISTER   ================================= -->
    <div class="card mx-auto" style="max-width:520px; margin-top:40px;">
      <article class="card-body">
        <header class="mb-4"><h4 class="card-title">creation d'un coupon</h4></header>

        <?php
        if (isset($_SESSION['flash'])) : ?>
            <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div class="alert alert-<?= $type; ?>">
                <?= $message; ?>
            </div>

            <?php endforeach; ?>
            <?php unset($_SESSION['flash']); ?>

        <?php endif; ?>

        <form action="" method="POST">
                <div class="form-row">
                    <div class="col form-group">
                        <label>Nom</label>
                        <input type="text" name="nameCoupon" class="form-control" placeholder="">
                    </div> 
                    <div class="col form-group">
                        <label>code</label>
                        <input type="text" name="code" class="form-control" placeholder="">
                    </div> 
                </div> 
            
                
                
                <div class="form-row">
                    <div class="col form-group">
                        <label>price reduct</label>
                        <input type="text" name="price_reduc" class="form-control" placeholder="">
                    </div> 

                    <!-- boucle foreach sur la liste des produits -->

                    <?php
                            $sql = "SELECT id, name FROM product ";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                    ?>
                            <div class="form-group col-md-12">
                              <select name="product_id" class="form-control">
                                <?php foreach ($stmt as $row) { ?>
                                  <option value="<?php echo $row->id; ?>"><?php echo $row->id; ?> - 
                                    <?php echo $row->name; ?></option>
                                <?php } ?>
                              </select>
                              </div> 

                    <div class="form-group col-md-12">
                        <label>start_promo</label>
                        <input type="date" name="started_at" class="form-control" placeholder="">
                    </div> 

                    <div class="form-group col-md-12">
                        <label>fin start_promo</label>
                        <input type="date" name="finished_at" class="form-control" placeholder="">
                    </div> 

                    <div class="form-group col-md-12">
                        <label>max coupon</label>
                        <input type="text" name="max_use" class="form-control" placeholder="">
                    </div> 
                    
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Ajouter le coupon  </button>
                </div>     
                  
            </form>
        </article>
    </div> 



</section>

<section>
<div class="card mx-auto" style="margin-top:40px;">
            <article class="card-body">
                <header class="mb-4">
                    <h4 class="card-title">listes des coupons</h4>
                </header>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Nom du produit</th>
                            <th scope="col">code</th>
                            <th scope="col">nom du coupon</th>
                            <th scope="col">prix reduction</th>
                            <th scope="col">creation</th>
                            <th scope="col">mis a jour le </th>
                            <th scope="col">commence</th>
                            <th scope="col">fin</th>
                            <th scope="col">nombre coupon</th>
                            <th scope="col">Action</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $requeteSelect = "SELECT c.id, prd.name, prd.name, c.code, c.nameCoupon, c.updated_at, 
                                c.price_reduc, c.created_at, c.started_at, c.finished_at, c.max_use FROM coupon AS c
											LEFT JOIN product AS prd ON c.product_id = prd.id";
                        $selectproduct = $pdo->prepare($requeteSelect);
                        $selectproduct->execute();

                        ?>
                        <?php foreach ($selectproduct as $resultProduct) { ?>
                            <tr>
                                <th  scope="row"><?= $resultProduct->id; ?></th>
                                <th><?= $resultProduct->name; ?></th>
                                <th class="code"><?= $resultProduct->code; ?></th>
                                <th><?= $resultProduct->nameCoupon; ?></th>
                                <th><?= $resultProduct->price_reduc; ?></th>
                                <th><?= $resultProduct->created_at; ?></th>
                                <?php if ($resultProduct->updated_at === null) { ?>
                                <th class="update_coupon"> </th>
                                <?php } else { ?>
                                    <th class="update_coupon">
                                        <?= strftime('%d/%m/%Y', strtotime($resultProduct->updated_at)); ?>
                                    </th>
                                <?php } ?>
                                <th><?= $resultProduct->started_at; ?></th>
                                <th><?= $resultProduct->finished_at; ?></th>
                                <th><?= $resultProduct->max_use; ?></th>
                                <th>
                                    <a href="/admin/editCoupon/<?= $resultProduct->id; ?>" class="btn btn-success">
                                        Edit
                                    </a>
                                </th>
                                <th>
                                    <a href="/admin/deleteCoupon/<?= $resultProduct->id; ?>" class="btn btn-danger">
                                        Delete
                                    </a>
                                </th>
                            </tr>
                        <?php } ?>
                <style>
                    .update_coupon{
                        color: #3498db;
                    }

                    .code{
                        color: #e74c3c;
                    }
                </style>
                </table>
            </article>
        </div>

        </tbody>

</section>
<?php
include_once __DIR__ . '/../../include/footer.php';
?>