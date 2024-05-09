<?php


// Démarrer la session
session_start();

if (!isset($_SESSION['username'])) {

// Paramètres de connexion à la base de données
include('database.php');

// Créer une connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

// Récupérer les données du formulaire
$username = $_POST['username'];
$password = $_POST['password'];

// Vérifier l'authenticité de l'utilisateur
// Note : Ceci est un exemple très basique et ne doit pas être utilisé en production
$requete = "SELECT * FROM users WHERE name = '$username' AND mdp = '$password'";
$resultat = $connexion->query($requete);

if ($resultat->num_rows > 0) {
    // Connexion réussie, enregistrer l'identifiant de l'utilisateur dans la session
    $_SESSION['username'] = $username;
    echo "Connexion réussie ! Bienvenue, $username.";

    // Rediriger vers une page sécurisée par exemple
    header("Location: welcome.php");
} else {
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}

// Fermer la connexion à la base de données
$connexion->close();

} else {
    // Afficher un message personnalisé si la session est active
    echo "<a href='welcome.php'>Tableaux de bord</a>";
}

?>