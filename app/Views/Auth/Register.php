<div>
    <h1>Inscription</h1>
</div>
<?php

use App\Class\Session;

if (Session::getInstance()->hasFlashes()) : ?>
        <?php foreach (Session::getInstance()->getFlashes() as $type => $message) : ?>
            <div class="alert alert-<?= $type; ?>">
                    <?= $message; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <div class="container">

    
<div class="row">
    <form action="/register" method="post">

        <div class="form-group">
            <label for="name">Votre pseudo :</label>
            <input type="text" class="form-control input-sm" name="name" placeholder="Votre pseudo ..." value="">
        </div>

        <div class="form-group">
            <label for="name">Votre firstname :</label>
            <input type="text" class="form-control input-sm" name="firstname" placeholder="Votre pseudo ..." value="">
        </div>

        <!-- L'adresse mail -->
        <div class="form-group">
            <label for="email">Votre adresse mail :</label>
            <input type="email" class="form-control input-sm" name="email" placeholder="Votre@mail.tld ..." value="">
        </div>

        <!-- Le mot de passe -->
        <div class="form-group">
            <label for="pass">Votre mot de passe :</label>
            <input type="password" class="form-control input-sm" name="password" placeholder="Entrez votre mot de passe ...">
        </div>

        <!-- Le mot de passe de confirmation -->
        <div class="form-group">
            <label for="pass_confirm">Confirmez votre mot de passe :</label>
            <input type="password" class="form-control input-sm" name="password_confirm" placeholder="Confirmation du mot de passe ...">
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            S'inscrire
        </button>
    </form>
</div>

</div>