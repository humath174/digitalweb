<?php
// Démarrez la session
session_start();

// Vérifiez si la variable de session 'username' existe
if (isset($_SESSION['username'])) {
    // L'utilisateur a une session ouverte
} else {
    // Redirigez l'utilisateur vers la page de connexion
    header("Location: connexion.php");
    exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>
<body class="bg-content">
<main class="dashboard d-flex">
    <!-- start sidebar -->

    <?php
    include "component/sidebar.php";
    include 'pages/conixion.php';
    $nbr_students = $con->query("SELECT * FROM contact");
    $nbr_students = $nbr_students->rowCount();

    $nbr_cours = $con->query("SELECT * FROM devis");
    $nbr_cours = $nbr_cours->rowCount();

    $nbr_client = $con->query("SELECT * FROM client");
    $nbr_client = $nbr_client->rowCount();

    $nbr_img = $con->query("SELECT * FROM photos");
    $nbr_img = $nbr_img->rowCount();

    ?>
    <!-- end sidebar -->

    <!-- start content page -->
    <div class="container-fluid px">
        <?php
        include "component/header.php";
        ?>
        <div class="cards row gap-3 justify-content-center mt-5">
            <div class=" card__items card__items--blue col-md-3 position-relative">
                <div class="card__students d-flex flex-column gap-2 mt-3">
                    <i class="far fa-graduation-cap h3"></i>
                    <span>Contact</span>
                </div>
                <div class="card__nbr-students">
                    <span class="h5 fw-bold nbr"><?php echo $nbr_students; ?></span>
                </div>
            </div>

            <div class=" card__items card__items--rose col-md-3 position-relative">
                <div class="card__Course d-flex flex-column gap-2 mt-3">
                    <i class="fal fa-bookmark h3"></i>
                    <span>Devis</span>
                </div>
                <div class="card__nbr-course">
                    <span class="h5 fw-bold nbr"><?php echo $nbr_cours; ?></span>
                </div>
            </div>

            <div class=" card__items card__items--yellow col-md-3 position-relative">
                <div class="card__payments d-flex flex-column gap-2 mt-3">
                    <i class="fal fa-usd-square h3"></i>
                    <span>Image</span>
                </div>
                <div class="card__payments">
                    <span class="h5 fw-bold nbr"><?php echo $nbr_img; ?></span>
                </div>
            </div>

            <div class="card__items card__items--gradient col-md-3 position-relative">
                <div class="card__users d-flex flex-column gap-2 mt-3">
                    <i class="fal fa-user h3"></i>
                    <span>Fichier client</span>
                </div>
                <span class="h5 fw-bold nbr"><?php echo $nbr_client; ?></span>
            </div>
        </div>

    </div>
</main>
<script src="js/script.js"></script>
<script src="js/bootstrap.bundle.js"></script>
</body>

</html>