<?php
// Démarrez la session
session_start();

// Vérifiez si la variable de session 'username' existe
if (isset($_SESSION['username'])) {
    // L'utilisateur a une session ouverte
} else {
    // Redirigez l'utilisateur vers la page de connexion
    header("Location: ./connexion.php");
    exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
}
?>