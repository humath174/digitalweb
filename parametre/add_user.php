<?php



// Récupérer l'ID de l'entreprise de l'utilisateur connecté
$entreprise_id = $_SESSION['entreprise_id'];


include('component/database.php');
// Récupérer la liste des rôles depuis la base de données
try {
    $pdo = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees;charset=utf8mb4", $utilisateur, $motDePasse);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt_roles = $pdo->query("SELECT id, roles FROM role ORDER BY roles");
    $roles = $stmt_roles->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données 1 : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-4">
<div class="max-w-md mx-auto bg-white shadow-md rounded-lg overflow-hidden">
    <div class="py-4 px-6 bg-gray-200 border-b border-gray-300">
        <h2 class="text-xl font-semibold text-gray-800">Ajouter un Utilisateur</h2>
    </div>
    <div class="p-6">
        <form action="add_user.php" method="post">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="nom">Nom</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="nom" name="nom" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="email">Email</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" id="email" name="email" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="mot_de_passe">Mot de passe</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" id="mot_de_passe" name="mot_de_passe" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="role">Rôle</label>
                <select name="role" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['id'] ?>"><?= $role['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="hidden" name="entreprise_id" value="<?= $entreprise_id ?>">
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Ajouter
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees;charset=utf8mb4", $utilisateur, $motDePasse);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
        $role_id = $_POST['role'];
        $entreprise_id = $_POST['entreprise_id'];

        $stmt = $pdo->prepare("INSERT INTO users (nom, email, mdp, role, entreprise_id) VALUES (:nom, :email, :mot_de_passe, :role_id, :entreprise_id)");
        $stmt->execute([':nom' => $nom, ':email' => $email, ':mot_de_passe' => $mot_de_passe, ':role_id' => $role_id, ':entreprise_id' => $entreprise_id]);

        echo '<script>alert("Utilisateur ajouté avec succès !");</script>';

    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données 2 : " . $e->getMessage();
    }
}
?>
