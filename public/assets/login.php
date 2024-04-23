<?php
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
    $username = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier l'authenticité de l'utilisateur
    // Note : Ceci est un exemple très basique et ne doit pas être utilisé en production
    $requete = "SELECT id, entreprise_id FROM utilisateurs WHERE email = '$username' AND mot_de_passe = '$password'";
    $resultat = $connexion->query($requete);

    if ($resultat->num_rows > 0) {
        // Connexion réussie, enregistrer l'identifiant de l'utilisateur et l'ID de l'entreprise dans la session
        $row = $resultat->fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['entreprise_id'] = $row['entreprise_id'];
        echo "Connexion réussie ! Bienvenue, $username.";

        // Rediriger vers une page sécurisée par exemple
        header("Location: /index.php");
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }

    // Fermer la connexion à la base de données
    $connexion->close();

} else {
    // Afficher un message personnalisé si la session est active
    header('Location: /index.php');
    exit();
}
?>
