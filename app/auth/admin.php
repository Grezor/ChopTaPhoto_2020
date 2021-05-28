<?php
require_once(__DIR__ . '../../../include/header.php');
?>

<div class="container">
    <h1>Votre compte</h1>

    <h3>Bonjour <?= $_SESSION['auth']->name?></h3>

</div>
<div class="container">
    <pre><?php print_r($_SESSION); ?></pre>
</div>


<?php
require_once(__DIR__ . '../../../include/footer.php');