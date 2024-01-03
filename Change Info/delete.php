<?php
// Démarrage de la session
session_start();
require "../cnx.php";
$con = cnx_pdo();
$delete = $con->prepare("DELETE FROM users WHERE id = ".$_SESSION['id']."");
$delete->execute();
// Destruction de toutes les variables de session
session_unset();

// Destruction de la session
session_destroy();

// Redirection vers la page de connexion ou d'accueil
header('Location: ../LogIn/index.php'); // Remplacez par l'URL de votre page de connexion ou d'accueil
exit();

?>