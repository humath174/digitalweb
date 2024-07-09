<?php
session_start();

if (!isset($_SESSION['nom'])) {
    header("Location: connexion.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body >

<?php

include('component/navbar.php');

?>


<div class="bg-gray-100 p-4">
<div class="max-w-7xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
    <div class="py-4 px-6 bg-gray-200 border-b border-gray-300">
        <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
    </div>
    <div class="p-6 grid grid-cols-3 gap-4">
        <!-- Card pour ajouter un utilisateur -->
        <a href="parametre/add_user.php" class="block p-6 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-700">
            <h3 class="text-lg font-semibold">Ajouter un utilisateur</h3>
            <p>Ajouter un nouvel utilisateur à la base de données.</p>
        </a>
        <!-- Card pour gérer les utilisateurs -->
        <a href="parametre/gerer_roles.php" class="block p-6 bg-green-500 text-white rounded-lg shadow-md hover:bg-green-700">
            <h3 class="text-lg font-semibold">Gérer les utilisateurs</h3>
            <p>Voir et modifier les informations des utilisateurs existants.</p>
        </a>
        <!-- Ajouter d'autres cards si nécessaire -->
        <a href="#" class="block p-6 bg-yellow-500 text-white rounded-lg shadow-md hover:bg-yellow-700">
            <h3 class="text-lg font-semibold">Autre fonctionnalité</h3>
            <p>Ajouter une autre fonctionnalité ici.</p>
        </a>
    </div>
</div>
</div>
</body>
</html>
