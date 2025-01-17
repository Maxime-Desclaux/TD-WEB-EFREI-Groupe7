<?php
include_once 'model/usersModel.php'; 

class UsersController
{
    private $model; 

    public function __construct()
    {
        $this->model = new UsersModel(); 
    }

    public function getFormIscription()
    {
        include 'view/inscription.php';
    }

    public function inscription()
    {
        if (isset($_POST['email'])) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $tel = $_POST['tel'];
            $email = $_POST['email'];
            $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

            // Vérifier si l'email est dans la liste noire
            if ($this->model->isEmailBlacklisted($email)) {
                echo "Cet email est bloqué.";
                $this->getFormIscription();
            } else {
                if ($this->model->inscription($nom, $prenom, $tel, $email, $mdp)) {
                    $_SESSION['user'] = $email;
                    header("Location:index.php?page=accueil2");
                    exit;
                } else {
                    echo "Erreur d'inscription";
                    $this->getFormIscription();
                }
            }
        } else {
            $this->getFormIscription();
        }
    }

    public function connexion()
    {
        if (isset($_POST['email']) && isset($_POST['mdp'])) {
            $email = htmlspecialchars($_POST['email']);
            $mdp = $_POST['mdp'];

            // Vérifier si l'email est dans la liste noire
            if ($this->model->isEmailBlacklisted($email)) {
                echo "Cet email est bloqué.";
                $this->getFormConnexion();
            } else {
                $user = $this->model->verifierUtilisateur($email, $mdp);
                if ($this->model->verifierUtilisateur($email, $mdp)) {
                    if ($user['user_role'] === 'admin') {
                        $_SESSION['user'] = $email;
                        $_SESSION['role'] = 'admin';
                        header("Location:index.php?page=accueil2");
                    }
                } else {
                    echo "Erreur de connexion";
                    $this->getFormConnexion();
                }
            }
        } else {
            $this->getFormConnexion();
        }
    }

    public function getFormConnexion()
    {
        include 'view/connexion.php';
    }
    
}
