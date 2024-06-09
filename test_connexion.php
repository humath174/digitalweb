<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Inclure le fichier des paramètres de connexion à la base de données
include('database.php');

// Essayer de se connecter à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
} else {
    echo "Connexion à la base de données réussie !";
}

// Fermer la connexion à la base de données
$connexion->close();
?>
