<?php
// Détails de connexion à la base de données
include 'back/database.php';

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Requête pour récupérer les demandes de contact
$sql = "SELECT contact_id, nom, prenom, mail, tel, description, contact_time FROM Contacts ORDER BY contact_time DESC";

// Exécuter la requête
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Demandes de Contact</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Pour utiliser Bootstrap -->
</head>
<body>
<div class="container">
    <h1>Demandes de Contact</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Description</th>
                <th>Date de Création</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Vérifier s'il y a des résultats
            if ($result->num_rows > 0) {
                // Afficher chaque ligne
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nom"] . "</td>";
                    echo "<td>" . $row["prenom"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["telephone"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>" . $row["date_creation"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Aucune demande de contact trouvée.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?php
// Fermer la connexion
$conn->close();
?>