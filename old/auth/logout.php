<?php

require_once __DIR__ . '/../../database/functions.php';
sessionStart();

unset($_SESSION['auth']);
$_SESSION['flash']['success'] = "Vous etes maintenant deconnecter";
header('Location: /login');
