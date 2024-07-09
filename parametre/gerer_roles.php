<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les Rôles des Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-4">
<div class="max-w-7xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
    <div class="py-4 px-6 bg-gray-200 border-b border-gray-300">
        <h2 class="text-xl font-semibold text-gray-800">Gérer les Rôles des Utilisateurs</h2>
    </div>
    <div class="p-6">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200">
            <tr>
                <th class="w-1/3 px-4 py-2">Nom</th>
                <th class="w-1/3 px-4 py-2">Email</th>
                <th class="w-1/3 px-4 py-2">Rôle</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            session_start();

            if (!isset($_SESSION['nom']) || $_SESSION['role'] != 'admin') {
                header("Location: login.php");
                exit();
            }

            include('component/database.php');

            try {
                $pdo = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees;charset=utf8mb4", $utilisateur, $motDePasse);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $pdo->query("SELECT id, nom, email, role FROM users");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td class='border px-4 py-2'>{$row['nom']}</td>";
                    echo "<td class='border px-4 py-2'>{$row['email']}</td>";
                    echo "<td class='border px-4 py-2'>
                                    <form action='update_role.php' method='post'>
                                        <input type='hidden' name='id' value='{$row['id']}'>
                                        <select name='role' class='shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline'>
                                            <option value='admin'" . ($row['role'] == 'admin' ? ' selected' : '') . ">Admin</option>
                                            <option value='utilisateur'" . ($row['role'] == 'utilisateur' ? ' selected' : '') . ">Utilisateur</option>
                                            <option value='moderateur'" . ($row['role'] == 'moderateur' ? ' selected' : '') . ">Modérateur</option>
                                        </select>
                                        <button type='submit' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded'>Mettre à jour</button>
                                    </form>
                                  </td>";
                    echo "<td class='border px-4 py-2'>
                                    <form action='delete_user.php' method='post'>
                                        <input type='hidden' name='id' value='{$row['id']}'>
                                        <button type='submit' class='bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded'>Supprimer</button>
                                    </form>
                                  </td>";
                    echo "</tr>";
                }
            } catch (PDOException $e) {
                echo "Erreur de connexion à la base de données : " . $e->getMessage();
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
