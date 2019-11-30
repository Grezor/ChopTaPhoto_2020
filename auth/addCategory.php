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

	// Pour envoyer les données a la base de données
	if (empty($errors)) {
		$req = $pdo->prepare("INSERT INTO category (name)
			VALUES(:name)");
		
		$req->execute([
			':name' => $_POST['name'],
			
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
		<header class="mb-4"><h4 class="card-title">creation d'une categorie</h4></header>

		<?php 
if(isset($_SESSION['flash'])): ?>

<?php foreach ($_SESSION['flash'] as $type=> $message): ?>
    <div class="alert alert-<?= $type; ?>">
<?= $message; ?>
    </div>

<?php endforeach; ?>
<?php unset($_SESSION['flash']); ?>

<?php endif; ?>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      
    </tr>
  </thead>
  <tbody>
  <?php
	
	$sql = "SELECT id, name FROM category ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	
	?>
		<?php foreach ($stmt as $row) { ?>
	<tr>
      <th scope="row"><?php echo $row->id; ?></th>
      <td><?php echo $row->name; ?></td>
	</tr>
	<?php } ?>	
    
    
							
							 
							 
  </tbody>
</table>
		<form action="" method="POST">
				<div class="form-row">
					<div class="col form-group">
						<label>Nom</label>
					  	<input type="text" name="name" class="form-control" placeholder="">
					</div>
					
				</div> 
				
			    <div class="form-group">
			        <button type="submit" class="btn btn-primary btn-block">Ajouter la category </button>
			    </div>   
			              
			</form>
		</article>
    </div>

    <br><br>


</section>