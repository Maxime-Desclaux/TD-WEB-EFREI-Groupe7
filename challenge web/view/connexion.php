<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="view/css/connexion.css">
</head>
<body>
    <!-- Alpine.js pour gérer l'affichage de la popup -->
    <div x-data="{ showError: <?php echo $showError ? 'true' : 'false'; ?> }" class="container">
        <form action="" method="post" class="form-connexion">
            <h1>Connexion</h1>
            <label>Email :</label>
            <input type="email" name="email" required>
            <label>Mot de passe :</label>
            <input type="password" name="mdp" required>
            <button type="submit">Se connecter</button>
        </form>

        <!-- Popup d'erreur affichée en cas d'erreur de connexion -->
        <div x-show="showError" 
             x-transition
             style="display: none;" 
             class="popup-error">
            <p>Erreur de connexion : Vérifiez vos informations.</p>
            <button @click="showError = false">Fermer</button>
        </div>
    </div>
</body>
</html>