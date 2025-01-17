<?php
include_once 'model/bdd.php'; // Inclusion de la connexion à la base de données

$bdd = Bdd::connexion();
try {
    // Requête pour récupérer les noms des villes
    $query = $bdd->prepare("SELECT DISTINCT nom FROM villes");
    $query->execute();
    $villes = $query->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erreur de requête : " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Villes</title>
    <link rel="stylesheet" href="view/css/villes.css">

</head>
<body>
    <h1>Liste des Villes</h1>
    <?php if (!empty($villes)): ?>
        
        <form action="index.php?page=VilleCommentaire" method="POST">
        <?php foreach ($villes as $ville): ?>
                <button type="submit" name="nom" value="<?php echo $ville['nom']; ?>">
                    <?php echo htmlspecialchars($ville['nom']); ?>
                </button>
            <?php endforeach; ?>
            </form>
        
    <?php else: ?>
        <p>Aucune ville n'a été trouvée.</p>
    <?php endif; ?>
</body>
</html>