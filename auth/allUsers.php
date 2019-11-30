<?php 

require_once '../include/functions.php';
sessionStart();



require_once '../include/header.php'; ?>
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">

<!-- ============================ COMPONENT REGISTER   ================================= -->
	<div class="card mx-auto" style="margin-top:40px;">
      <article class="card-body">
      <?php 
    $sql = "SELECT count(name) FROM client ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();

?>
        <header class="mb-4"><h4 class="card-title">liste des utilisateurs </h4>
 
    
    </header>


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
    

  <?php




	
	$sql = "SELECT id, name, firstname, email, email_token, register_at, role FROM client ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	

	?>
		<?php foreach ($stmt as $row) { ?>
	<tr>
      <th scope="row"><?php echo $row->id; ?></th>
      <td><?php echo $row->name; ?></td>
      <td><?php echo $row->firstname; ?></td>
      <td><?php echo $row->email; ?></td>
     <td><?php 
      if($row->email_token === NULL){ ?>
        <span class="badge badge-success">Activé</span>
      <?php } else{?>
        <span class="badge badge-danger"> Non Activé</span>
      <?php }?>
      </td>
      <td><?= strftime('%d-%m-%Y',strtotime($row->register_at)); ?></td>
      <td><?php if ($row->role === '1') { ?><img src="../Ecommerce_Bootstrap/images/admin/king.png" alt="" class="king"></td><?php } ?>

    <?php
     if ($row->role === '0') { ?>
     <img src="../Ecommerce_Bootstrap/images/admin/role.png" alt="" class="king"></td>
    <?php } ?>
    </tr>

	<?php } ?>	
    
    
							
							 
							 
  </tbody>
</table>
		
		</article>
    </div> 

  


</section>