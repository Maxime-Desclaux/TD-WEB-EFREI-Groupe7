<h1>Nos articles</h1>

<?php foreach ($articles as $article) { ?>
    <div>
    <h2><a href="?page=article&id=<?= $article['id_article'] ?>"><?= $article['titre'] ?></a>  </h2>
        <img src="<?= $article['image'] ?>" alt="">
        <p>
            <?= $article['contenu'] ?>
        </p>

        <small><?= $article['dateCreation'] ?></small>
        <br>

    </div>

<?php } ?>