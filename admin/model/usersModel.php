<?php
include_once 'bdd.php'; 

class UsersModel
{
    private $bdd;
    public function __construct()
    {
        $this->bdd = Bdd::connexion();
    }

    public function inscription($nom, $prenom, $tel, $email, $mdp)
{
    $user = $this->bdd->prepare("INSERT INTO users(nom,prenom,tel,email,mdp) VALUES(?,?,?,?,?)");
    $result = $user->execute([$nom, $prenom, $tel, $email, $mdp]);

    if ($result) {
        // Récupérer l'ID de l'utilisateur récemment inscrit
        $user_id = $this->bdd->lastInsertId();
        $_SESSION['user_id'] = $user_id;  // Stocker l'ID de l'utilisateur dans la session
    }

    return $result;
}
    public function getUserByEmail($email)
    {
        return $this->bdd->query("SELECT * FROM users WHERE email='$email'")->fetch(PDO::FETCH_ASSOC);
    }

    public function isEmailBlacklisted($email)
    {
        $stmt = $this->bdd->prepare("SELECT 1 FROM blacklist WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch() !== false;
    }

    /*
    connexion
    */
    public function verifierUtilisateur($email, $mdp)
    {
        $stmt = $this->bdd->prepare("SELECT user_id,email, user_role, mdp FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification du mot de passe
        if ($user && password_verify($mdp, $user['mdp'])) {
            $_SESSION['user_id'] = $user['user_id'];
            return $user;  // Retourne les informations de l'utilisateur (incluant user_role)
        }

        return false;
    }
}
