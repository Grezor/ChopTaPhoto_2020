<?php 

require_once '../include/functions.php';
sessionStart();

if (!empty($_POST)) {
	$errors = [];
	require_once '../include/db.php';

	if (empty($_POST['name']) || !preg_match('/^[a-zA-Z0-9_+$]/', $_POST['name'])) {
		$errors['name'] = "Votre nom n'est pas valide";
	}else{
		//si il existe deja
		$req = $pdo->prepare('SELECT id FROM product WHERE name = ?');
		$req->execute([$_POST['name']]);
		$name = $req->fetch();
		if ($name) {
			$errors['name'] = 'Ce nom est déja utilisée';
		}
	}
	if (empty($_POST['description'])) {
		$errors['description'] = "Votre description n'est pas valide";
	}

	if (empty($_POST['price'])) {
		$errors['price'] = "Votre price n'est pas valide";
	}

	if (empty($_POST['quantity'])) {
		$errors['quantity'] = "Votre quantité n'est pas valide";
	}

	if (empty($_POST['ref'])) {
		$errors['ref'] = "Votre ref n'est pas valide";
	}

	$location = (isset($_POST['is_location']));
	

	// Pour envoyer les données a la base de données
	if (empty($errors)) {
		$req = $pdo->prepare("INSERT INTO product (name, description, price, quantity, ref, is_location)
			VALUES(:name, :description, :price, :quantity, :ref, :is_location)");
		
		$req->execute([
			':name' => $_POST['name'],
			':description' => $_POST['description'],
			':price' => (int) $_POST['price'],
			':quantity' => $_POST['quantity'], 
			':ref' => $_POST['ref'], 
			':is_location' => (int) $location
		]);


        echo "<pre>".$req->debugDumpParams()."</pre>";

    // On envoit l'email de confirmation
    // mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/Ecommerce_Bootstrap/auth/confirm.php?id=$user_id&token=$token");
    // On redirige l'utilisateur vers la page de login avec un message flash
    $_SESSION['flash']['success'] = 'produit cree';
  
    exit();
	}
	
}
?>

<?php require_once '../include/header.php'; ?>
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">

<!-- ============================ COMPONENT REGISTER   ================================= -->
	<div class="card mx-auto" style="max-width:520px; margin-top:40px;">
      <article class="card-body">
		<header class="mb-4"><h4 class="card-title">creattion d'un produit</h4></header>

		<?php 
if(isset($_SESSION['flash'])): ?>

<?php foreach ($_SESSION['flash'] as $type=> $message): ?>
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
					  	<input type="text" name="name" class="form-control" placeholder="">
					</div> <!-- form-group end.// -->
					<div class="col form-group">
						<label>description</label>
					  	<input type="text" name="description" class="form-control" placeholder="">
					</div> <!-- form-group end.// -->
				</div> 
				
				<div class="form-row">
					<div class="col form-group">
						<label>price</label>
					  	<input type="text" name="price" class="form-control" placeholder="">
					</div> 

					<div class="form-group col-md-12">
						<label>quantité</label>
					  	<input type="text" name="quantity" class="form-control" placeholder="">
					</div> 

					<div class="form-group col-md-12">
						<label>reference</label>
					  	<input type="text" name="ref" class="form-control" placeholder="">
					</div> 

					<div class="form-group col-md-12">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" name="is_location" class="custom-control-input">
                            <div class="custom-control-label">Location ?</div>
                        </label>
					</div> 
					
				</div>
			    <div class="form-group">
			        <button type="submit" class="btn btn-primary btn-block">Ajouter le produit </button>
			    </div> <!-- form-group// -->      
			              
			</form>
		</article>
	</div> 
	
	<div class="container">
	<div class="card mx-auto" style="margin-top:40px;">
      <article class="card-body">
		<header class="mb-4"><h4 class="card-title">listes des produit</h4></header>

		<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">firstanme</th>
      <th scope="col">email</th>
      <th scope="col">email token</th>
      <th scope="col">register_at</th>
      <th scope="col">role</th>
    </tr>
  </thead>
  <tbody>

		
		</article>
	</div> 
	
	</div>
    <br><br>



</section>