<?php

require __DIR__ . '/../../include/functions.php';

// recuperation de l'id selectionner
$sql = 'SELECT * FROM product WHERE id=:id';
$statement = $pdo->prepare($sql);
$statement->execute([':id' => $productId]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (
  isset($_POST['name'])  && isset($_POST['description']) && isset($_POST['price'])
  && isset($_POST['quantity']) &&  isset($_POST['ref']) && isset($_POST['category_id'])
  && isset($_FILES['files'])
) {

  $errors = [];

  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $ref = $_POST['ref'];
  $category_id = $_POST['category_id'];
  // on va chercher l'input file du formulaire
  $files = $_FILES['files'];
  $filesname = $files['name'];
  $filetmp = $files['tmp_name'];

  $fileext = explode('.', $filesname);
  $filecheck = strtolower(end($fileext));
  $fileextstored = ['png', 'jpeg', 'jpg'];

  if (!in_array($filecheck, $fileextstored)) {
    $errors['image__format'] = "Votre image n'est pas dans un format valide";
  }
  // vérification du format de l'image
  $mimeType = mime_content_type($filetmp);
  $mimeTypeSupported = ['image/jpeg', 'image/png'];
  if (!in_array($mimeType, $mimeTypeSupported)) {
    $errors['image__format'] = "Votre image n'est pas dans un format valide";
  }
  // si il y a pas d'erreur on selection le chemin de l'image au produit 
  if (empty($errors)) {
    $sqlImage = 'SELECT path FROM product_image WHERE product_id = :id';
    $statementImage = $pdo->prepare($sqlImage);
    $statementImage->execute([
      ':id' => $productId
    ]);
    // si il y a une image et une chemin de la bdd qui est différent
    // différent de l'image par défault, on supprime l'existante
    $image = $statementImage->fetch();
    $resourceFolder = realpath(__DIR__ . '/../../') . '/';
    if (
      $image && $image->path !== 'images/shop/default.jpg'
      && file_exists($resourceFolder . $image->path)
    ) {
      unlink($resourceFolder . $image->path);
    }
    // on génére un uuid a chaque image .l'extension
    $imageName = uuid() . "." . $filecheck;
    $path = 'images/shop/' . $imageName;
    move_uploaded_file($filetmp, $resourceFolder . $path);

    // update de l'image
    $sqlUpdateimage = 'UPDATE product_image SET path = :files WHERE product_id = :id';
    $statementUpdate = $pdo->prepare($sqlUpdateimage);
    $resultUpdate = $statementUpdate->execute([
      ':files' => $path,
      ':id' => $productId
    ]);
  }
  // on met a jour tout les champs du produit sans l'image
  $sql = 'UPDATE product SET name=:name, description=:description, price=:price, quantity = :quantity, category_id = :category_id, ref = :ref, updated = NOW() WHERE id=:id';
  $statement = $pdo->prepare($sql);
  $result = $statement->execute([
    ':name' => $name,
    ':description' => $description,
    ':price' => $price,
    ':quantity' => $quantity,
    ':ref' => $ref,
    ':category_id' => $category_id,
    ':id' => $productId
  ]);

  if ($result) {
    $_SESSION['flash']['success'] = "Vous avez mis a jour";
    header("Location: /addProduct");
  }
}
require_once(__DIR__ . '/../../include/header.php');
?>

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Mise a jour du produit <?= $person->name; ?></h2>
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
      <form method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="name">Name</label>
          <input value="<?= $person->name; ?>" type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="description">description</label>
          <input type="text" value="<?= $person->description; ?>" name="description" id="description" class="form-control">
        </div>

        <div class="form-group">
          <label for="description">Prix</label>
          <input type="text" value="<?= $person->price; ?>" name="price" id="price" class="form-control">
        </div>

        <div class="form-group">
          <label for="description">quantite</label>
          <input type="text" value="<?= $person->quantity; ?>" name="quantity" id="quantity" class="form-control">
        </div>

        <div class="form-group">
          <label for="ref">ref</label>
          <input type="text" value="<?= $person->ref; ?>" name="ref" id="ref" class="form-control">
        </div>

        <div class="form-group">
          <label for="ref">Image a la une </label>
          <input type="file" name="files" class="form-control" id="files">
        </div>

        <?php
        $sql = "SELECT id, name FROM category";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        ?>
        <div class="form-group">
          <select name="category_id" class="form-control">
            <?php foreach ($stmt as $row) {
              if ($row->id === $person->category_id) { ?>
                <option selected value="<?php echo $row->id; ?>"><?php echo $row->id; ?> - <?php echo $row->name; ?>
                </option>
              <?php } else { ?>
                <option value="<?php echo $row->id; ?>"><?php echo $row->id; ?> - <?php echo $row->name; ?></option>
            <?php }
            } ?>
          </select>
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