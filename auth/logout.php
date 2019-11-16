<?php 

session_destroy();
unset($_SESSION['auth']);
$_SESSION['flash']['success'] = "Vous etes maintenant deconnecter";
header('Location: login.php');