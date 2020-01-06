<?php 
require_once '../../include/functions.php';
sessionStart();

unset($_SESSION['auth']);
$_SESSION['flash']['success'] = "Vous etes maintenant deconnecter";
header('Location: login.php');