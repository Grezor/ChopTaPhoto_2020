<?php
require_once __DIR__ . '/../../include/functions.php';
sessionStart();
require_once(__DIR__ . '/../../include/header.php');
?>
<section class="section-content padding-y">
  <div class="card mx-auto" style="margin-top:40px;">
    <article class="card-body">
      <?php
        $sql = "SELECT count(name) FROM client ";
          $stmt = $pdo->prepare($sql);
          $stmt->execute();
        ?>
      <header class="mb-4">
        <h4 class="card-title">liste des utilisateurs </h4>
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
            <th scope="col">update Mdp</th>
            <th scope="col">supprimer</th>
          </tr>
        </thead>
        <tbody>

          <?php
          // pour dire quel utilisateurs viens de s'inscrire et changer de icon
            $sql = "SELECT id, name, firstname, email, email_token, register_at, reset_at, role, 
                    (DATE_SUB( now(), INTERVAL 1 HOUR) < register_at) AS is_new 
                    FROM client";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            ?>
          <?php foreach ($stmt as $row) { ?>
          <tr>
            <th scope="row"><?= $row->id; ?></th>
            <td><?= $row->name; ?></td>
            <td><?= $row->firstname; ?></td>
            <td><?= $row->email; ?></td>
            <td><?php if ($row->email_token === null) { ?>
              <span class="badge badge-success">Activé</span>
                <?php } else {?>
              <span class="badge badge-danger"> Non Activé</span>
                <?php }?>
            </td>
            <style>
              .king {
                width: 24px;
                height: 24px;
              }

              .visit {
                width: 24px;
                height: 24px;
              }

              .king1,
              .card_admin {
                width: 50px;
                height: 50px;

              }

              .classVisiteur {
                background-color: #e67e22 !important;
              }
            </style>
            <td><?= strftime('%d.%m.%Y', strtotime($row->register_at)); ?></td>
            <td><?php if ($row->role === '1') { ?>
              <span class="badge badge-success">Administrateur</span>
                <?php } else {?>
              <span class="badge badge-danger classVisiteur">Visiteur</span>
                <?php }?>
            </td>

            <td><?= $row->reset_at; ?></td>
            <td><a href="/admin/deleteUsers/<?= $row->id; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
              <a href="/admin/editClient/<?= $row->id; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
            </td>
          </tr>

          <?php } ?>
      </table>
    </article>
  </div>
  </tbody>
</section>

<?php
include_once __DIR__ . '/../../include/footer.php';
?>
