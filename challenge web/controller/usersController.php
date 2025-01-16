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

            if($this->model->inscription($nom,$prenom,$tel,$email,$mdp))
            {
                header("Location:index.php?page=accueil2");
                $_SESSION['user'] = $email;
            
            }
            else
            {
                echo "Erreur d'inscription";
                $this->getFormIscription();

            }

        }
        else{
            $this->getFormIscription();
        }
    }



    
    public function connexion()
    {
        if (isset($_POST['email']) && isset($_POST['mdp'])) {
            $email = htmlspecialchars($_POST['email']);
            $mdp = $_POST['mdp'];

            if ($this->model->verifierUtilisateur($email, $mdp)) {
                $_SESSION['user'] = $email;
                header("Location:index.php?page=accueil2");
                exit;
            } else {
                echo "Erreur de connexion";
                $this->getFormConnexion();
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