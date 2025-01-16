// model/VilleModel.php
<?php
include_once 'bdd.php'; 

class VilleModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getAllVilles() {
        $query = $this->db->prepare("SELECT nom FROM villes");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        echo "Nombre de villes récupérées : " . count($result);
        return $result;
    }
    
}
?>
