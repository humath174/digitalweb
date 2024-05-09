<?php

if (!isset($_SESSION['username'])) {

?>
<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            width: 300px;
            margin: 100px auto;
            padding: 16px;
            background-color: white;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Connexion</h2>
    <form action="login.php" method="post">
        <label for="username"><b>Nom d'utilisateur :</b></label>
        <input type="text" placeholder="Entrez votre nom d'utilisateur" name="username" required>

        <label for="password"><b>Mot de passe :</b></label>
        <input type="password" placeholder="Entrez votre mot de passe" name="password" required>

        <button type="submit">Se connecter</button>
    </form>
</div>

</body>
</html>

-->


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire de connexion en HTML & CSS - Frenchcoder</title>
    <link rel="stylesheet" href="/css/style-connexion.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
</head>
<body>
<form action="login.php" method="post">

    <h1>Se connecter</h1>

    <p class="choose-email">Utiliser mes codes donner par DigitalGrou :</p>

    <div class="inputs">
        <label for="username"><b>Nom d'utilisateur :</b></label>
        <input type="text" placeholder="Nom D'utilisateur" name="username" />

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