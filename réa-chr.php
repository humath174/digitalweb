
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

// Traitement de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $titre = $connexion->real_escape_string($_POST['titre']);
    $description = $connexion->real_escape_string($_POST['description']);

    // Vérifie si un fichier a été téléchargé
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Lit le contenu du fichier
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
        // Échappe les caractères spéciaux pour éviter les injections SQL
        $imageData = $connexion->real_escape_string($imageData);

        // Insère les données dans la base de données
        $insertQuery = "INSERT INTO realisation (titre, description, image_data) VALUES ('$titre', '$description', '$imageData')";
        $result = $connexion->query($insertQuery);

        if ($result) {
            echo "L'image a été téléchargée avec succès. <a href='dashboard-réal.php'>Retourner sur le dashboard</a>";
        } else {
            echo "Une erreur est survenue lors du téléchargement de l'image : " . $connexion->error;
        }
    } else {
        echo "Veuillez sélectionner une image à télécharger.";
    }
}

// Ferme la connexion à la base de données
$connexion->close();
?>

<head>
    <meta name="msvalidate.01" content="97522F7AC2412B9FEB60193A02ED6806" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bruno Broyer Reflets Amenagements</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Bruno Broyer Reflets Amenagements" />
    <meta name="keywords" content="pisciniste, bruno broyer reflets amenagements, bruno broyer, amenagements, piscine chatillon sur chalaronne, chatillon sur chalaronne, ain, rhone, auvergne rhone-alpes" />
    <meta name="author" content="DigitalGroup" />
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS externe -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5TXPSHGCFL"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-5TXPSHGCFL');
    </script>
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-5TXPSHGCFL"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-5TXPSHGCFL');
</script>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Administration</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-dark" aria-current="page" href="welcome.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="devis-rec.php">Devis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark"  href="contact-rec.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark"  href="img-chr.php">Charger une Image</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="/site/index.html">Retourner sur le site</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<h1>Ajouter une réalisation</h1>

<form action="réa-chr.php" method="post" enctype="multipart/form-data">
    <label for="titre">Titre :</label>
    <input type="text" name="titre" required><br>

    <label for="description">Description :</label>
    <textarea name="description" required></textarea><br>

    <label for="image">Sélectionnez une image :</label>
    <input type="file" name="image" required><br>

    <input type="submit" value="Envoyer">
</form>

</body>
</html>
