<?php

session_start(); //le démarrage de session
$Titre='Déconnexion';
session_unset(); // Unset the data
session_destroy(); //Détruire la session
header('Location: index.php');
exit();






?>