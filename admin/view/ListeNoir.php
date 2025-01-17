<?php

require_once 'model/bdd.php';

$bdd = Bdd::connexion();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Validation de l'email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Préparation de la requête
        $stmt = $bdd->prepare("INSERT INTO blacklist (email) VALUES (:email)");
        $stmt->bindParam(':email', $email);

        // Exécution et retour
        if ($stmt->execute()) {
            echo "L'email a été ajouté à la liste noire avec succès.";
        } else {
            echo "Erreur lors de l'ajout de l'email à la liste noire.";
        }
    } else {
        echo "Email non valide.";
    }
}

// Préparation de la requête pour sélectionner toutes les entrées des table 
$stmtUsers = $bdd->prepare("SELECT * FROM users");
$stmtBlacklist = $bdd->prepare("SELECT * FROM blacklist");
// Exécution de la requête
$stmtUsers->execute();
$stmtBlacklist->execute();
// Récupération des résultats
$users = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);
$blacklist = $stmtBlacklist->fetchAll(PDO::FETCH_ASSOC);





?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un email à la liste noire</title>
    <link rel="stylesheet" href="view/css/ListeNoir.css">
</head>
<body>
    <form method="post" action="">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Ajouter</button>
    </form>
    <h1>Liste des Utilisateurs</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Email</th>
            <th>Date de Création</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['user_id']); ?></td>
                <td><?= htmlspecialchars($user['nom']); ?></td>
                <td><?= htmlspecialchars($user['prenom']); ?></td>
                <td><?= htmlspecialchars($user['email']); ?></td>
                <td><?= htmlspecialchars($user['created_at']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h1>Liste des Emails en Liste Noire</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Date d'Ajout</th>
        </tr>
        <?php foreach ($blacklist as $blacklistItem): ?>
            <tr>
                <td><?= htmlspecialchars($blacklistItem['blacklist_id']); ?></td>
                <td><?= htmlspecialchars($blacklistItem['email']); ?></td>
                <td><?= htmlspecialchars($blacklistItem['date_added']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>