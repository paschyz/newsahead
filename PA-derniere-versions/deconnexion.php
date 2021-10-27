<<?php
session_start();
session_destroy();
header('location:connexion.php?message=Vous avez été déconnecté.');
?>
