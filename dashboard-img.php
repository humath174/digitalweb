<?php
// Démarrez la session
session_start();

// Vérifiez si la variable de session 'username' existe
if (isset($_SESSION['username'])) {
    // L'utilisateur a une session ouverte
    echo "Bienvenue, " . $_SESSION['username'] . "!";
} else {
    // Redirigez l'utilisateur vers la page de connexion
    header("Location: connexion.php");
    exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
}
?>
<?php
// Connexion à la base de données
include('database.php');

$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

// Récupère les données des images depuis la base de données
$selectQuery = "SELECT * FROM photos";
$result = $connexion->query($selectQuery);

// Traitement de la suppression d'image
if (isset($_POST['delete'])) {
    $imageIdToDelete = $_POST['image_id'];

    // Supprime l'image de la base de données
    $deleteQuery = "DELETE FROM photos WHERE id = $imageIdToDelete";
    $deleteResult = $connexion->query($deleteQuery);

    if ($deleteResult) {
        echo "L'image a été supprimée avec succès.";
    } else {
        echo "Une erreur est survenue lors de la suppression de l'image : " . $connexion->error;
    }
}

// Ferme la connexion à la base de données
$connexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style-nav.css">
    <script type="text/javascript" src="/js/annim.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <title>Dashboard</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        img {
            max-width: 100px;
            max-height: 100px;
            height: auto;
        }
    </style>
</head>
<body>
<?php
include('navbar.php');
?>

<h1>Dashboard</h1>

<table>
    <tr>
        <th>Image</th>
        <th>Action</th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        // Affiche l'aperçu de l'image dans une cellule du tableau
        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['image_data']) . "' alt='" . $row['image_name'] . "'></td>";

        // Affiche le bouton de suppression dans une cellule du tableau
        echo "<td>
                <form method='post' action='dashboard-img.php'>
                    <input type='hidden' name='image_id' value='" . $row['id'] . "'>
                    <input type='submit' name='delete' value='Supprimer'>
                </form>
              </td>";

        echo "</tr>";
    }
    ?>
</table>

</body>
</html>