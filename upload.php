<?php
// Connexion à la base de données
include('database.php');

$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

// Vérifie si un fichier a été téléchargé
if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Lit le contenu du fichier
    $imageData = file_get_contents($_FILES['image']['tmp_name']);
    // Échappe les caractères spéciaux pour éviter les injections SQL
    $imageData = $connexion->real_escape_string($imageData);
    // Obtient le nom du fichier
    $imageName = $connexion->real_escape_string($_FILES['image']['name']);

    // Insère les données dans la base de données
    $insertQuery = "INSERT INTO photos (image_name, image_data) VALUES ('$imageName', '$imageData')";
    $result = $connexion->query($insertQuery);

    if ($result) {
        echo "L'image a été téléchargée avec succès.
        <a href='img-chr.php'>Retourner a l'upload d'image</a>";
    } else {
        echo "Une erreur est survenue lors du téléchargement de l'image : " . $connexion->error;
    }
} else {
    echo "Veuillez sélectionner une image à télécharger.";
}

// Ferme la connexion à la base de données
$connexion->close();
?>
