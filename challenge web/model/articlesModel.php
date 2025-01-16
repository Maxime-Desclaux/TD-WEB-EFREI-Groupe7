<?php
include_once 'bdd.php';

class ArticlesModel
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = Bdd::connexion();
    }

    public function getArticles()
    {
        return $this->bdd->query("SELECT * FROM articles")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticlesByCategorie($id){
        return $this->bdd->query("SELECT * FROM articles WHERE id_categorie=$id")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticleById($id)
    {
        return $this->bdd->query("SELECT articles.*, categories.nom as cat, users.nom as nom FROM articles INNER JOIN categories ON categories.id_categorie=articles.id_categorie INNER JOIN users ON users.id_user=articles.id_user WHERE articles.id_article=$id")->fetch(PDO::FETCH_ASSOC);
    }
}

// test
/*
$articles = new ArticlesModel;
var_dump($articles->getArticles());
*/

?>


