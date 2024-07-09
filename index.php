<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<?php

include('component/navbar.php');


// Simulons une session ouverte avec un entreprise_id (remplacez par votre logique de session réelle)
$entreprise_id_session = $_SESSION['entreprise_id'];

include('component/database.php');


try {
    $pdo = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour compter le nombre d'employés avec entreprise_id correspondant à celui de la session
    $stmt = $pdo->prepare("SELECT COUNT(*) as total_rows FROM demande_devis WHERE entreprise_id = :entreprise_id");
    $stmt->bindParam(':entreprise_id', $entreprise_id_session);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_rows = $result['total_rows'];



} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

try {
    $pdo = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour compter le nombre d'employés avec entreprise_id correspondant à celui de la session
    $stmt = $pdo->prepare("SELECT COUNT(*) as total_rows FROM demande_contact WHERE entreprise_id = :entreprise_id");
    $stmt->bindParam(':entreprise_id', $entreprise_id_session);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_rows2 = $result['total_rows'];



} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}



?>

<!-- Main content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Card 1 -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Dossier Client</h2>
            <p class="text-3xl font-bold text-gray-900">486</p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Sales</h2>
            <p class="text-3xl font-bold text-gray-900">$12,560</p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Contact</h2>
            <p class="text-3xl font-bold text-gray-900">
                <?php
                echo "$total_rows2";
                ?>
            </p>
        </div>

        <!-- Card 4 -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Devis</h2>
            <p class="text-3xl font-bold text-gray-900">
                <?php
                echo "$total_rows";
                ?>
            </p>
        </div>
    </div>

    <!-- Charts -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Sales Overview</h2>
        <div class="flex justify-center">
            <img src="chart.png" alt="Chart" class="w-full">
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Activity</h2>
        <ul class="divide-y divide-gray-200">
            <li class="py-4">
                <p class="text-sm text-gray-600">User John Doe logged in</p>
                <p class="text-xs text-gray-400">10 minutes ago</p>
            </li>
            <li class="py-4">
                <p class="text-sm text-gray-600">New order placed by Jane Smith</p>
                <p class="text-xs text-gray-400">1 hour ago</p>
            </li>
            <li class="py-4">
                <p class="text-sm text-gray-600">Monthly report generated</p>
                <p class="text-xs text-gray-400">2 hours ago</p>
            </li>
            <li class="py-4">
                <p class="text-sm text-gray-600">User Bob Johnson logged in</p>
                <p class="text-xs text-gray-400">3 hours ago</p>
            </li>
        </ul>
    </div>

    <?php

    echo "$entreprise_id_session";
    ?>

</main>

<!-- Footer -->
<footer class="bg-gray-200 text-center py-4">
    <p class="text-gray-600">© 2024 Your Company. All rights reserved.</p>
</footer>

<!-- Script pour le menu déroulant -->
<script>
    // Afficher/masquer le menu déroulant
    document.addEventListener('DOMContentLoaded', function() {
        var dropdownButtons = document.querySelectorAll('.relative');

        dropdownButtons.forEach(function(button) {
            var dropdownMenu = button.querySelector('.hidden');

            button.addEventListener('click', function(event) {
                event.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function(event) {
                dropdownMenu.classList.add('hidden');
            });
        });
    });
</script>

</body>
</html>
