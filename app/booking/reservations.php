<?php

require_once __DIR__ . '/../../include/functions.php';
sessionStart();

if (empty($_GET['id'])) {
	$_SESSION['flash']['danger'] = 'Id manquant';

	header('Location: /', true, 301);
	exit();
}

if (!empty($_POST)) {
	$errors = [];
	require_once (__DIR__ .'/../../include/db.php');

	if (empty($_POST['nom']) || !preg_match('/^[a-zA-Z0-9_+$]/', $_POST['nom'])) {
		$errors['nom'] = "Votre nom n'est pas valide";
	}
	if (empty($_POST['prenom']) || !preg_match('/^[a-zA-Z0-9_+$]/', $_POST['prenom'])) {
		$errors['prenom'] = "Votre prenom n'est pas valide";
	}

	if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = "Votre email n'est pas valide";
	}

	if (empty($_POST['adresse']) || !preg_match('/^[a-zA-Z0-9_+$]/', $_POST['adresse'])) {
		$errors['adresse'] = "Votre prenom n'est pas valide";
	}

	if (empty($_POST['postal']) || !preg_match('/^[a-zA-Z0-9_+$]/', $_POST['postal'])) {
		$errors['postal'] = "Votre prenom n'est pas valide";
	}

	if (empty($_POST['ville']) || !preg_match('/^[a-zA-Z0-9_+$]/', $_POST['ville'])) {
		$errors['ville'] = "Votre prenom n'est pas valide";
	}

	$product_id = $_GET['id'];

	if (empty($errors)) {
		//$req = $pdo->prepare("INSERT INTO client (name, firstname, password, email, e) VALUES(:name, :firstname, :password, :email )");
		$req = $pdo->prepare("INSERT INTO booking (nom, prenom, email, adresse, postal, ville, debut, fin, created_at, product_id)
			VALUES(:nom, :prenom, :email, :adresse, :postal, :ville, :debut, :fin, now(), :productId)");

		
		$req->execute([
			':nom' =>$_POST['nom'],
			':prenom' =>$_POST['prenom'],
			':email' =>$_POST['email'],
			':adresse' =>$_POST['adresse'],
			':postal' =>$_POST['postal'],
			':ville' =>$_POST['ville'],
			':debut' =>$_POST['debut'],
			':fin' =>$_POST['fin'],
			':productId' => $product_id
			
		]);
		$user_id = $pdo->lastInsertId();
    // On envoit l'email de confirmation
   // mail($_POST['email'], 'Confirmation de votre compte', "Nous avons bien recu votre commande, votre compte merci");
    // On redirige l'utilisateur vers la page de login avec un message flash
    $_SESSION['flash']['success'] = "Le produit {$product_id} a bien été reservé";
    header('Location: /booking');
    exit();
	}

}

?>

<!-- update -->
<?php 



?>
<?php require_once (__DIR__ .'/../../include/header.php');?>
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">

	<!-- ============================ COMPONENT REGISTER   ================================= -->
	<div class="card mx-auto" style="max-width:520px; margin-top:40px;">
		<article class="card-body">
			<header class="mb-4">
				<h4 class="card-title">Reservations</h4>
			</header>

			<?php
			if (isset($_SESSION['flash'])) : ?>

				<?php foreach ($_SESSION['flash'] as $type => $message) : ?>
					<div class="alert alert-<?= $type; ?>">
						<?= $message; ?>
					</div>

				<?php endforeach; ?>
				<?php unset($_SESSION['flash']); ?>

			<?php endif; ?>

			<form action="" method="POST" enctype="multipart/form-data">
			
				<div class="form-row">
					<div class="col form-group">
						<label>Nom</label>
						<input type="text" name="nom" class="form-control" placeholder="" >
					</div> <!-- form-group end.// -->
					<div class="col form-group">
						<label>prenom</label>
						<input type="text" name="prenom" class="form-control" placeholder="">
					</div> 

				
				</div>

				<div class="form-row">

				<div class="col form-group col-md-12">
						<label>email</label>
						<input type="text" name="email" class="form-control" placeholder="">
					</div> 

					<div class="col form-group col-md-12">
						<label>adresse de livraison</label>
						<input type="text" name="adresse" class="form-control" placeholder="">
					</div>

					<div class="form-group col-md-12">
						<label>code postal</label>
						<input type="text" name="postal" class="form-control" placeholder="" >
					</div>

					<div class="form-group col-md-12">
						<label>Ville</label>
						<input type="text" name="ville" class="form-control" placeholder="">
					</div>

					<div class="form-group col-md-12">
						<label>start</label>
						<input type="date" name="debut" class="form-control">
					</div>
					<div class="form-group col-md-12">
						<label>end</label>
						<input type="date" name="fin" class="form-control">
					</div>
					
				</div>

				
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block">Ajouter le produit </button>
				</div> <!-- form-group// -->

			</form>

		</article>
	</div>

	
	







</section>