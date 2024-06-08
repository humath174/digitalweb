<?php


// Démarrer la session
session_start();

if (!isset($_SESSION['username'])) {

// Vérifier la connexion à la base de données
include('database.php');

// Créer une connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

// Récupérer les données du formulaire et échapper les caractères spéciaux pour éviter les injections SQL
$username = $connexion->real_escape_string($_POST['email']);
$password = $connexion->real_escape_string($_POST['password']);

// Utiliser les requêtes préparées pour éviter les injections SQL
$requete = $connexion->prepare("SELECT * FROM Users WHERE username = ? AND password_hash = ?");
$requete->bind_param("ss", $username, $password);
$requete->execute();
$resultat = $requete->get_result();

if ($resultat->num_rows > 0) {
    // Connexion réussie, enregistrer l'identifiant de l'utilisateur dans la session
    $_SESSION['username'] = $username;
    echo "Connexion réussie ! Bienvenue, $username.";

    // Rediriger vers une page sécurisée par exemple
    header("Location: welcome.php");
    exit();
} else {
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}

// Fermer la connexion à la base de données
$requete->close();
$connexion->close();

} else {
    // Afficher un message personnalisé si la session est active
    echo "<a href='welcome.php'>Tableaux de bord</a>";
}

?>