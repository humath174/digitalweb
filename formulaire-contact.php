<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Demandes de Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body >
<?php

include('component/navbar.php');

?>

<div class="class="bg-gray-100 p-4">



<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
    <div class="py-4 px-6 bg-gray-200 border-b border-gray-300">
        <h2 class="text-xl font-semibold text-gray-800">Liste des Demandes de Contact</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-100 text-gray-800">
            <tr>
                <th class="py-2 px-4 border-b border-gray-300">ID</th>
                <th class="py-2 px-4 border-b border-gray-300">Nom</th>
                <th class="py-2 px-4 border-b border-gray-300">Email</th>
                <th class="py-2 px-4 border-b border-gray-300">Téléphone</th>
                <th class="py-2 px-4 border-b border-gray-300">Message</th>
                <th class="py-2 px-4 border-b border-gray-300">Date</th>
                <th class="py-2 px-4 border-b border-gray-300">Actions</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            <?php
            include('component/database.php');

            try {
                $pdo = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees;charset=utf8mb4", $utilisateur, $motDePasse);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Simulons une session ouverte avec un entreprise_id (remplacez par votre logique de session réelle)
                $entreprise_id_session = 1; // Exemple

                // Requête SQL pour récupérer les demandes de contact pour l'entreprise spécifique
                $stmt = $pdo->prepare("SELECT * FROM demande_contact WHERE entreprise_id = :entreprise_id");
                $stmt->bindParam(':entreprise_id', $entreprise_id_session);
                $stmt->execute();

                // Parcourir les résultats et afficher chaque ligne dans la table
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td class='py-2 px-4 border-b border-gray-300'>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td class='py-2 px-4 border-b border-gray-300'>" . htmlspecialchars($row['nom']) . "</td>";
                    echo "<td class='py-2 px-4 border-b border-gray-300'>" . htmlspecialchars($row['prenom']) . "</td>";
                    echo "<td class='py-2 px-4 border-b border-gray-300'>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td class='py-2 px-4 border-b border-gray-300'>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td class='py-2 px-4 border-b border-gray-300'>" . htmlspecialchars($row['date_creation']) . "</td>";
                    echo "<td class='py-2 px-4 border-b border-gray-300'>
                                   <form method='POST' action='suppresion_contact.php'>
                                        <input type='hidden' name='demande_id' value='" . htmlspecialchars($row['id']) . "'>
                                        <button type='submit' class='bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-md focus:outline-none'>Supprimer</button>
                                    </form>
                                  </td>";
                    echo "</tr>";
                }

            } catch(PDOException $e) {
                echo "Erreur de connexion à la base de données : " . $e->getMessage();
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

</div>

</body>
</html>
