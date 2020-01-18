
<?php
require_once __DIR__ . '/../../include/functions.php';
sessionStart();


require_once (__DIR__ .'/../../include/header.php');?>



<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">nom</th>
      <th scope="col">prenom</th>
      <th scope="col">email</th>
      <th scope="col">adresse</th>
      <th scope="col">postal</th>
      <th scope="col">debut</th>
      <th scope="col">fin</th>
    </tr>
  </thead>
  <tbody>
    

  <?php
  // pour dire quel utilisateurs viens de s'inscrire et changer de icon
  


	
	$sql = "SELECT id, nom, prenom, email, adresse, ville, debut, fin FROM booking ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	

	?>
		<?php foreach ($stmt as $row) { ?>
	<tr>
      <th scope="row"><?= $row->id; ?></th>
      <td><?= $row->nom; ?></td>
      <td><?= $row->prenom; ?></td>
      <td><?= $row->email; ?></td>
      <td><?= $row->adresse; ?></td>
      <td><?= $row->ville; ?></td>
      <td><?= strftime('%d/%m/%Y',strtotime($row->debut)); ?></td>
      <td><?= strftime('%d/%m/%Y',strtotime($row->fin)); ?></td>

         

      </td>
    </tr>

	<?php } ?>	
    