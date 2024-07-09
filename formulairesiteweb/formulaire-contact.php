<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de Contact</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    
<?php

// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username']) || !isset($_SESSION['entreprise_id'])) {
    header("Location: login.php");
    exit();
}

include('component/database.php');

// Créer une connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

// Récupérer le site_id depuis la session
$site_id = $_SESSION['entreprise_id'];

// Préparer la requête pour récupérer les données filtrées par site_id et triées par contact_time
$requete = $connexion->prepare("SELECT nom, prenom, mail, tel, description, contact_time FROM Contacts WHERE site_id = ? ORDER BY contact_time DESC");

$requete->bind_param("i", $site_id);
$requete->execute();
$resultat = $requete->get_result();
include('component/navbar.php');
?>



<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Nom</th>
                <th scope="col" class="px-6 py-3">Prénom</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Téléphone</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">Contact Time</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultat->num_rows > 0) {
                // Sortir chaque ligne de la base de données
                while ($ligne = $resultat->fetch_assoc()) {
                    echo '<tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">';
                    echo '<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' . htmlspecialchars($ligne["snom"]) . '</th>';
                    echo '<td class="px-6 py-4">' . htmlspecialchars($ligne["prenom"]) . '</td>';
                    echo '<td class="px-6 py-4">' . htmlspecialchars($ligne["mail"]) . '</td>';
                    echo '<td class="px-6 py-4">' . htmlspecialchars($ligne["tel"]) . '</td>';
                    echo '<td class="px-6 py-4">' . htmlspecialchars($ligne["description"]) . '</td>';
                    echo '<td class="px-6 py-4">' . htmlspecialchars($ligne["contact_time"]) . '</td>';
                    echo '<td class="px-6 py-4"><a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a></td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="7" class="px-6 py-4 text-center">Aucun contact trouvé</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
// Fermer la connexion à la base de données
$requete->close();
$connexion->close();
?>

