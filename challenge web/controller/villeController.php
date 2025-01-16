// controller/VilleController.php
<?php
include_once 'model/bdd.php';
include_once 'model/villeModel.php';

class VilleController {
    private $model;

    public function __construct() {
        $db = Bdd::connexion();  // Utilise la méthode de la classe Bdd pour obtenir la connexion
        $this->model = new VilleModel($db);
    }

    public function afficherVilles() {
        $villes = $this->model->getAllVilles();
        var_dump($villes); // Ajouté pour le debug
        include 'view/villeView.php';
    }
    
}

// Initialisation du contrôleur
$controller = new VilleController();
$controller->afficherVilles();
?>

