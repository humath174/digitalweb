<?php
// Démarrer la session
session_start();

if (!isset($_SESSION['username'])) {
    // Paramètres de connexion à la base de données
    include('component/database.php');

    // Créer une connexion à la base de données
    $connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

    // Vérifier la connexion
    if ($connexion->connect_error) {
        die("La connexion à la base de données a échoué : " . $connexion->connect_error);
    }

    // Récupérer les données du formulaire
    $username = $_POST['email'];
    $password = $_POST['password'];

    // Préparer la requête pour éviter les injections SQL
    $requete = $connexion->prepare("SELECT * FROM users WHERE email = ? AND mdp = ?");
    $requete->bind_param("ss", $username, $password);
    $requete->execute();
    $resultat = $requete->get_result();

    if ($resultat->num_rows > 0) {
        // Connexion réussie, récupérer les informations de l'utilisateur
        $utilisateur = $resultat->fetch_assoc();

        // Enregistrer l'identifiant de l'utilisateur et l'ID de l'entreprise dans la session
        $_SESSION['nom'] = $utilisateur['nom'];
        $_SESSION['entreprise_id'] = $utilisateur['entreprise_id '];

        echo "Connexion réussie ! Bienvenue, $username.";

        // Rediriger vers une page sécurisée par exemple
        header("Location: index.php");
        exit();
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }

    // Fermer la connexion à la base de données
    $requete->close();
    $connexion->close();
} else {
    // Afficher un message personnalisé si la session est active
    echo "<a href='index.php'>Tableaux de bord</a>";
}
?>
