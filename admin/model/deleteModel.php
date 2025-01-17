<?php
// Inclure le fichier de connexion à la base de données
require_once 'bdd.php';

// // Vérifier si l'utilisateur est administrateur
// if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
//     echo "Accès refusé.";
//     exit;
// }

// Se connecter à la base de données
$bdd = Bdd::connexion();

if (isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];

    // Supprimer le commentaire
    $stmt = $bdd->prepare('DELETE FROM commentaires WHERE commentaires_id = :comment_id');
    $stmt->execute(['comment_id' => $comment_id]);

    if (isset($_POST['nom'])) {
        // Stocker le nom de la ville dans la session
        $_SESSION['ville'] = $_POST['nom'];}

    
        header("Location: ../index.php?page=ville");

} else {
    echo "ID du commentaire manquant.";
}
