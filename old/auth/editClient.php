<?php
require __DIR__ . '/../../database/db.php';

// recuperation de l'id selectionner
$sql = 'SELECT * FROM client WHERE id=:id';
$statement = $pdo->prepare($sql);
$statement->execute([':id' => $productId ]);
$client = $statement->fetch(PDO::FETCH_OBJ);
if (isset($_POST['product_id']) && isset($_POST['name'])  && isset($_POST['firstname']) && isset($_POST['email'])) {
    $productId = $_POST['name'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = 'UPDATE client SET name =:name, firstname=:firstname, email=:email, role = :role WHERE id=:id';
    $statement = $pdo->prepare($sql);
    if (
        $statement->execute([
        ':name' => $productId,
        ':firstname' => $firstname,
        ':email' => $email,
        ':role' => $role,
        ])
    ) {
        $_SESSION['flash']['success'] = "Vous avez mis a jour";
        header("Location: /allUsers");
    }
}
require_once(__DIR__ . '/../../database/header.php');
?>

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update Client </h2>
    </div>
    <div class="card-body">
    <?php
    if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div class="alert alert-<?= $type; ?>">
                <?= $message; ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>

    <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input value="<?= $client->name; ?>" type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="description">firstname</label>
          <input type="text" value="<?= $client->firstname; ?>" name="firstname" id="firstname" class="form-control">
        </div>

        <div class="form-group">
          <label for="description">email</label>
          <input type="text" value="<?= $client->email; ?>" name="email" id="email" class="form-control">
        </div>

        <div class="form-group">
          <label for="ref">role (admin:1 / visiteur: 2)</label>
     
        </div>

       

        <div class="form-group">
          <button type="submit" class="btn btn-info">Mis a jour du produit</button>
        </div>

      </form>
    </div>
  </div>
</div>

<?php
include_once __DIR__ . '/../../database/footer.php';
?>