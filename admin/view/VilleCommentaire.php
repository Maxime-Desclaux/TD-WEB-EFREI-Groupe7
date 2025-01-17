<?php
// Inclure le fichier de connexion à la base de données
require_once 'model/bdd.php';

// Se connecter à la base de données
$bdd = Bdd::connexion();

if (isset($_POST['nom'])) {
    $_SESSION['ville'] = $_POST['nom'];
} else {
    echo "Aucune ville sélectionnée.";
    exit;
}

$nom = $_SESSION['ville'];

// Récupérer les commentaires associés à la ville depuis la base de données
$stmt = $bdd->prepare('SELECT u.nom AS utilisateur, u.prenom AS prenom_utilisateur, c.titre, c.image, c.description, c.date,
c.commentaires_id

                       FROM commentaires c
                       JOIN villes v ON c.commentaires_id = v.commentaires_id
                       JOIN users u ON c.users_id = u.user_id
                       WHERE v.nom = :nom');
$stmt->execute(['nom' => $nom]);
$commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ville Commentaire</title>
    <link rel="stylesheet" href="view/css/Villecommentaire.css">

</head>
<body>
<main>
    <h1><?php echo htmlspecialchars(strtoupper($nom)); ?></h1>

    <div>
        <?php if (count($commentaires) > 0): ?>
            <?php foreach ($commentaires as $commentaire): ?>
                <div>
                    <img src="<?php echo htmlspecialchars($commentaire['image']); ?>" alt="Image" width="100">
                    <div>
                        <h2><?php echo htmlspecialchars($commentaire['titre']); ?></h2>
                        <p>Auteur: <?php echo htmlspecialchars($commentaire['utilisateur'] . ' ' . $commentaire['prenom_utilisateur']); ?></p>
                        <p>Date: <?php echo htmlspecialchars($commentaire['date']); ?></p>
                        <p>Commentaire: <?php echo htmlspecialchars($commentaire['description']); ?></p>
                    </div>
                    <form method="POST" action="model/deleteModel.php">
                        <input type="hidden" name="comment_id" value="<?php echo htmlspecialchars($commentaire['commentaires_id']); ?>">
                        <input type="hidden" name="nom" value="<?php echo htmlspecialchars($nom); ?>">
                        

                        <button type="submit">Supprimer</button>
                    </form>
                </div>
                <hr>
            <?php endforeach; ?>

        <?php else: ?>
            <p>Aucun commentaire disponible pour cette ville.</p>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
