<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/styles.css">
    <title>Bienvenue sur Guestbook</title>
</head>
<body>
    <div class="container">
        <h1>Bienvenue sur Guestbook</h1>
        <p>Que souhaitez-vous faire ?</p>

        <nav>
            <a href="?page=connexion">Connexion</a>
            <a href="?page=inscription">Inscription</a>
        </nav>
    </div>
    <footer>
        <p>&copy; <?= date('Y'); ?> Guestbook. Créé par Maxime Desclaux en PHP.</p>
    </footer>
</body>