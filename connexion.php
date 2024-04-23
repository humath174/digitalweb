<?php

if (!isset($_SESSION['username'])) {

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire de connexion en HTML & CSS - Frenchcoder</title>
    <link rel="stylesheet" href="css/style-connexion.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
</head>
<body>
<form action="login.php" method="post">

    <h1>Se connecter</h1>

    <p class="choose-email">ou utiliser mon adresse e-mail :</p>

    <div class="inputs">
        <label for="username"><b>Nom d'utilisateur :</b></label>
        <input type="email" placeholder="Email" name="username" />

        <label for="password"><b>Mot de passe :</b></label>
        <input type="password" placeholder="Mot de passe" name="password">
    </div>

    <div align="center">
        <button type="submit">Se connecter</button>
    </div>
</form>
</body>
</html>

<?php
} else {
// Afficher un message personnalisé si la session est active
echo "<a href='welcome.php'>Tableaux de bord</a>";
}
?>