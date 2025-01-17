<?php
// Inclure le fichier de connexion à la base de données
require_once 'model/bdd.php';

$bdd = Bdd::connexion();
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Récupération des données du formulaire
        $ville = $_POST['ville'];
        $_SESSION['ville']=$ville;
        $url = $_POST['url'];
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $users_id = $_SESSION['user_id'];


        // Préparer et exécuter la requête d'insertion dans la table commentaires
        $sql = "INSERT INTO commentaires (users_id, titre, image, description) VALUES (:users_id, :titre, :image, :description)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            ':users_id' => $users_id,
            ':titre' => $titre,
            ':image' => $url,
            ':description' => $description,
        ]);

        // Récupérer l'ID du dernier commentaire inséré
        $commentaires_id = $bdd->lastInsertId();

        // Associer le commentaire à la ville choisie dans la table villes
        $sql_ville = "INSERT INTO villes (nom, users_id, commentaires_id) VALUES (:ville, :users_id, :commentaires_id)";
        $stmt_ville = $bdd->prepare($sql_ville);
        $stmt_ville->execute([
            ':ville' => $ville,
            ':users_id' => $users_id,
            ':commentaires_id' => $commentaires_id,
        ]);

        // Redirection après succès
        header("Location: index.php?page=accueil2");
        exit;
    } catch (PDOException $e) {
        // Afficher une erreur en cas de problème
        echo "Erreur lors de l'insertion : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poster un commentaire</title>
    <link rel="stylesheet" href="view/css/poster.css">
    
</head>
<body>
<main>
    <h1>Poster un commentaire</h1>
    <form method="POST">
        <!-- Ville -->
        <select name="ville" required>
            <option value="">Sélectionnez une ville</option>
            <option value="Paris">Paris</option>
            <option value="Rome">Rome</option>
            <option value="Londres">Londres</option>
        </select>

        <!-- URL de l'image -->
        <input type="url" name="url" placeholder="URL de l'image" required>

        <!-- Titre -->
        <input type="text" name="titre" placeholder="Titre" required>

        <!-- Description -->
        <textarea name="description" rows="5" placeholder="Description" required></textarea>

        <!-- Bouton Valider -->
        <button type="submit">Valider</button>
    </form>
</main>
</body>
</html>
