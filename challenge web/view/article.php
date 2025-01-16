<h1><?= $articles['titre'] ?></h1>
 
 
<div>
    <img src="<?= $articles['image'] ?>" alt="">
    <p>
        <?= $articles['contenu'] ?>
    </p>
 
    <small>Date : <?= $articles['dateCreation'] ?></small>
    <small>Autheur : <?= $articles['nom'] ?></small>
    <small>Categorie : <?= $articles['cat'] ?></small>
 
    <br>
 
</div>