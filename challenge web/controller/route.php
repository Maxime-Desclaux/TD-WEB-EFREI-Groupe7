<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';



/*
if(isset($_GET['page']))
{
    $page=$_GET['page'];
}
else
{
    $page='accueil';
}
*/

switch($page)
{
    case 'accueil':
        include_once 'view/page_login.php';
        break;

    case 'accueil2':
        include_once 'view/accueil.php';
        break;

    case 'ville':
        include_once 'view/villes.php';
        break;

    case 'categorie':
        include_once 'controller/articlesController.php';
        $articles = new ArticlesController;
        $articles->getArticlesByCategorie();
        break;
    case 'article':
        include_once 'controller/articlesController.php';
        $articles = new ArticlesController;
        $articles->getArticleById();
        break;
    case 'inscription':
        include_once 'controller/usersController.php';
        $users = new UsersController;
        $users->inscription();
        break;
    case 'connexion':
        include_once 'controller/usersController.php';
        $users = new UsersController;
        $users->connexion();
        break;
    case 'deconnexion':
        $_SESSION = array();
        header("Location: index.php");
        break;
    default:
        include 'view/404.php';
}
