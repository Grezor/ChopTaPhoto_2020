<?php 



require_once '../include/header.php';
if (empty($_POST) && empty($_POST['username']) && !empty($_POST['password'])) {
   require '../include/db.php';
   require_once '../include/functions.php';
   $req = $pdo->prepare('SELECT * FROM client WHERE name = :name or email = :email');
   $req->execute(['name' => $_POST['name']]);
   $user = $req->fetch();
   var_dump($_POST['password']);
   var_dump($user->password);
   die();
   
}
?>




<section class="section-conten padding-y" style="min-height:84vh">
<?php 
if(isset($_SESSION['flash'])): ?>

<?php foreach ($_SESSION['flash'] as $type=> $message): ?>
    <div class="alert alert-<?= $type; ?>">
<?= $message; ?>
    </div>

<?php endforeach; ?>
<?php unset($_SESSION['flash']); ?>

<?php endif; ?>
<!-- ============================ COMPONENT LOGIN   ================================= -->
	<div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
      <div class="card-body">
      <h4 class="card-title mb-4">Connexion </h4>
      <form action="" method="POST">
      	  
          <div class="form-group">
          <label>Nom ou email</label>
			 <input name="name" class="form-control" placeholder="Username" type="text">
          </div> <!-- form-group// -->
          <div class="form-group">
          <label>Mot de passe</label>
			<input name="password" class="form-control" placeholder="Password" type="password">
          </div> <!-- form-group// -->
          
          <div class="form-group">
          	<a href="#" class="float-right">Forgot password?</a> 
            <label class="float-left custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input" checked=""> <div class="custom-control-label"> Remember </div> </label>
          </div> <!-- form-group form-check .// -->
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block"> Se connecter  </button>
          </div> <!-- form-group// -->    
      </form>
      </div> <!-- card-body.// -->
    </div> <!-- card .// -->

     <p class="text-center mt-4">Pas de compte ? <a href="Auth/register.php">Inscription</a></p>
     <br><br>
<!-- ============================ COMPONENT LOGIN  END.// ================================= -->


</section>