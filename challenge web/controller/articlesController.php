<?php
include_once 'model/articlesModel.php';

class ArticlesController
{
    private $model;

    public function __construct()
    {
        $this->model = new ArticlesModel;
    }

    public function getArticles()
    {
        $articles = $this->model->getArticles();
        include_once 'view/articles.php';
    }

    public function getArticlesByCategorie()
    {
        $articles = $this->model->getArticlesByCategorie($_GET['id']);
        include_once 'view/articles.php';
    }

    public function getArticleById()
    {
        $articles = $this->model->getArticleById($_GET['id']);
        include_once 'view/article.php';
    }
}


