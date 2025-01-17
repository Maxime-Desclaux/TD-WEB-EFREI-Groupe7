<?php
include_once 'model/usersModel.php'; 

class UsersController
{
    private $model; 

    public function __construct()
    {
        $this->model= new UsersModel; 
    }

    public function getFormIscription()
    {
        include 'view/inscription.php';

    }

    public function inscription()
    {
        if(isset($_POST['email']))
        {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $tel = $_POST['tel'];
            $email = $_POST['email'];
            $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT);

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
        $showError = false;
        if (isset($_POST['email']) && isset($_POST['mdp'])) {
            $email = htmlspecialchars($_POST['email']);
            $mdp = $_POST['mdp'];

            if ($this->model->isEmailBlacklisted($email)) {
                echo "Cet email est bloqué.";
                
            } 

            elseif ($this->model->verifierUtilisateur($email, $mdp)) {
                $_SESSION['user'] = $email;
                header("Location:index.php?page=accueil2");
                exit;
            } else {
                $showError = true;
                
            }
        }
        $this->getFormConnexion($showError);
        
    }

    public function getFormConnexion($showError = false)
    {
        include 'view/connexion.php';
    }

}