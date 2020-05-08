<?php
require __DIR__ . '/../../include/db.php' ;

// recuperation de l'id selectionner
$sql = 'SELECT * FROM coupon WHERE id=:id';
$statement = $pdo->prepare($sql);
$statement->execute([':id' => $productId ]);
$coupon = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['product_id'])  && isset($_POST['code']) && isset($_POST['price_reduc']) 
&& isset($_POST['started_at']) &&  isset($_POST['finished_at']) && isset($_POST['max_use'])) {

  $product_id = $_POST['product_id'];
  $code = $_POST['code'];
  $price_reduc = $_POST['price_reduc'];
  $started_at = $_POST['started_at'];
  $finished_at = $_POST['finished_at'];
  $max_use = $_POST['max_use'];

  $sql = 'UPDATE coupon SET product_id=:product_id, code=:code, price_reduc=:price_reduc, updated_at = NOW(), started_at = :started_at, finished_at = :finished_at, finished_at = :finished_at, max_use = :max_use WHERE id=:id';
  $statement = $pdo->prepare($sql);
  if ($statement->execute([
      ':product_id' => $product_id,
      ':code' => $code,
      ':price_reduc'=> $price_reduc,
      ':started_at' => $started_at,
      ':finished_at' => $finished_at,
      ':max_use' => $max_use,
      ':id' => $productId
    ])) {
    $_SESSION['flash']['success'] = "Vous avez mis a jour";
    header("Location: /addCoupon");
  }
}
require_once (__DIR__ .'/../../include/header.php');
?>

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update produit </h2>
    </div>
    <div class="card-body">
    <?php 
		if(isset($_SESSION['flash'])): ?>

		<?php foreach ($_SESSION['flash'] as $type=> $message): ?>
			<div class="alert alert-<?= $type; ?>">
		        <?= $message; ?>
			</div>
		<?php endforeach; ?>
		<?php unset($_SESSION['flash']); ?>

		<?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input value="<?= $coupon->product_id; ?>" type="text" name="product_id" id="product_id" class="form-control">
        </div>
        <div class="form-group">
          <label for="description">description</label>
          <input type="text" value="<?= $coupon->code; ?>" name="code" id="code" class="form-control">
        </div>

        <div class="form-group">
          <label for="description">price reduct</label>
          <input type="text" value="<?= $coupon->price_reduc; ?>" name="price_reduc" id="price_reduc" class="form-control">
        </div>

        <div class="form-group">
          <label for="ref">Creation le</label>
          <input type="text" value="<?= $coupon->created_at; ?>" name="created_at" id="created_at" class="form-control">
        </div>

        <div class="form-group">
          <label for="ref">Commence</label>
          <input type="datetime" value="<?= $coupon->started_at; ?>" name="started_at" id="started_at" class="form-control">
        </div>

        <div class="form-group">
          <label for="ref">fin</label>
          <input type="datetime" value="<?= $coupon->finished_at; ?>" name="finished_at" id="finished_at" class="form-control">
        </div>

        <div class="form-group">
          <label for="ref">max coupon</label>
          <input type="text" value="<?= $coupon->max_use; ?>" name="max_use" id="max_coupon" class="form-control">
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-info">Mis a jour du produit</button>
        </div>

      </form>
    </div>
  </div>
</div>

<?php 
include_once __DIR__ . '/../../include/footer.php';
?>