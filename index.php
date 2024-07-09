<?php
session_start();

if (!isset($_SESSION['nom'])) {
    header("Location: connexion.php");
    exit();
}
?>

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
    echo "Erreur de connexion à la base de données 1: " . $e->getMessage();
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
    echo "Erreur de connexion à la base de données 2: " . $e->getMessage();
}

try {
    $pdo = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour compter le nombre d'employés avec entreprise_id correspondant à celui de la session
    $stmt = $pdo->prepare("SELECT COUNT(*) as total_rows FROM dossierclient WHERE entreprise_id = :entreprise_id");
    $stmt->bindParam(':entreprise_id', $entreprise_id_session);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_rows3 = $result['total_rows'];



} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données 3: " . $e->getMessage();
}


?>



?>

<!-- Main content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Card 1 -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Dossier Client</h2>
            <p class="text-3xl font-bold text-gray-900">
                <?php
                echo "$total_rows3";
                ?>
            </p>
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

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Activity</h2>
        <ul class="divide-y divide-gray-200">
            <?php
            // Connexion à la base de données
            $connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
            
            // Requête SQL pour récupérer les dernières activités
            $sql = "SELECT type_activite, date FROM activite ORDER BY timestamp DESC LIMIT 5"; // Limiter à 5 activités récentes

            $resultat = $connexion->query($sql);

            if ($resultat->num_rows > 0) {
                // Afficher les activités récentes
                while ($row = $resultat->fetch_assoc()) {
                    $description = htmlspecialchars($row['description']);
                    $timestamp = strtotime($row['timestamp']);
                    $temps_ecoule = time() - $timestamp;

                    echo '<li class="py-4">';
                    echo '<p class="text-sm text-gray-600">' . $description . '</p>';
                    echo '<p class="text-xs text-gray-400">' . time_ago($temps_ecoule) . '</p>';
                    echo '</li>';
                }
            } else {
                echo "Aucune activité récente.";
            }

            // Fonction pour afficher le temps écoulé sous forme de "il y a X temps"
            function time_ago($temps) {
                $temps_unites = array("seconde", "minute", "heure", "jour", "semaine", "mois", "an");
                $temps_diviseur = array(1, 60, 3600, 86400, 604800, 2630880, 31570560);

                for ($i = 0; $temps >= $temps_diviseur[$i]; $i++) {
                    $temps /= $temps_diviseur[$i];
                }

                $temps = round($temps);

                if ($temps != 1) {
                    $temps_unites[$i] .= "s";
                }

                return "$temps $temps_unites[$i] ago";
            }            ?>
        </ul>
    </div>


    <?php

    echo "$entreprise_id_session";
    ?>

</main>

<!-- Footer -->
<footer class="bg-gray-200 text-center py-4">
    <p class="text-gray-600">© 2024 DigitalWeb Dynamics. All rights reserved.</p>
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

