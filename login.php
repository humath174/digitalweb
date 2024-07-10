<?php
// Démarrer la session
session_start();

if (!isset($_SESSION['username'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        $requete = $connexion->prepare("SELECT id, nom, entreprise_id, mdp, role FROM users WHERE email = ?");
        $requete->bind_param("s", $username);
        $requete->execute();
        $resultat = $requete->get_result();

        if ($resultat->num_rows > 0) {
            // Utilisateur trouvé, vérifier le mot de passe
            $utilisateur = $resultat->fetch_assoc();

            // Vérifier le mot de passe avec password_verify
            if (password_verify($password, $utilisateur['mdp'])) {
                // Mot de passe correct, enregistrer les informations dans la session
                $_SESSION['nom'] = $utilisateur['nom'];
                $_SESSION['entreprise_id'] = $utilisateur['entreprise_id'];
                $_SESSION['role'] = $utilisateur['role']; // Stocker le rôle de l'utilisateur dans la session


                echo "Connexion réussie ! Bienvenue, " . $_SESSION['nom'] . ".";

                // Rediriger vers une page sécurisée par exemple
                header("Location: index.php");
                exit();
            } else {
                echo "Nom d'utilisateur ou mot de passe incorrect.";
            }
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }

        // Fermer la connexion à la base de données
        $requete->close();
        $connexion->close();
    }
} else {
    // Afficher un message personnalisé si la session est active
    echo "Bienvenue, " . $_SESSION['nom'] . ". <a href='index.php'>Tableaux de bord</a>";
}
?>
