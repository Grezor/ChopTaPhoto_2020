<?php

use App\Class\Session;

if (Session::getInstance()->hasFlashes()) : ?>
    <?php foreach (Session::getInstance()->getFlashes() as $type => $message) : ?>
        <div class="alert alert-<?= $type; ?>">
                <?= $message; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<div>
    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi ad asperiores fugiat, soluta unde rem itaque
    veritatis minima illum fugit adipisci quaerat nobis quam voluptate quas quo ratione dolor! Qui?
</div>