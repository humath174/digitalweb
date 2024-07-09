<?php

session_start();

if (!isset($_SESSION['nom'])) {
    header("Location: connexion.php");
    exit();
}


// Vérification si l'ID de la demande de contact est envoyé en POST
if (isset($_POST['demande_id'])) {
    // Récupération de l'ID de la demande de contact à supprimer
    $demande_id = $_POST['demande_id'];

    // Connexion à la base de données
    include('component/database.php');

    try {
        $pdo = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees;charset=utf8mb4", $utilisateur, $motDePasse);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour supprimer la demande de contact
        $stmt = $pdo->prepare("DELETE FROM demande_contact WHERE id = :demande_id");
        $stmt->bindParam(':demande_id', $demande_id);
        $stmt->execute();

        echo "Demande de contact supprimée avec succès.";

        // Redirection vers la page principale après suppression
        header("Location: demande_contact.php");
        exit();

    } catch (PDOException $e)

        ?>


