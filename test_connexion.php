<?php
$serveur = "192.168.30.14";
$utilisateur = "dashboard";
$motDePasse = "sitedashboard";
$baseDeDonnees = "dashboard_site";

// Créer une connexion
$conn = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
echo "Connexion réussie à la base de données";
?>


