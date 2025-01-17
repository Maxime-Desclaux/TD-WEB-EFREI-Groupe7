<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tripcomment</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/pulse/bootstrap.css">

</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand">Tripcomments</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <?php if(isset($_SESSION['user'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="?page=accueil2">accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=ville">ville</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=poster">poster</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=ListeNoir">Liste noir</a>
          </li>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php if(isset($_SESSION['user'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="?page=deconnexion">Deconnexion</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

</nav>
