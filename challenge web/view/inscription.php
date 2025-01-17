<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription</title>
    <link rel="stylesheet" href="view/css/inscription.css">

</head>
<body>
    
</body>
</html>

<h1>Inscription</h1>
<form action="" method="post">

Nom : <input type="text" name="nom"required> <br>
Prenom : <input type="text" name="prenom"required> <br>
Tel : <input type="text" name="tel" required> <br>
Email : <input type="email" name="email" required > <br>
Mot de passe  : <input type="password" 
               name="mdp" 
               required 
               pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$" 
               title="Le mot de passe doit contenir au moins 6 caractères, une lettre majuscule, une lettre minuscule, un chiffre, et un caractère spécial."> 
        <br>
<button>S'inscrire</button>

</form>