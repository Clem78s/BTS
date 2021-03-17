<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TP3 PPE2 Clément MARTIN</title>
    <script src="https://kit.fontawesome.com/955a9c0667.js" crossorigin ="anonymous"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/product/">

    <!-- Bootstrap core CSS -->
    <link href="TP3_PPE2.css" rel="stylesheet">
    <link href="product.css" rel="stylesheet">
    <!-- Favicons -->
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>
<body>

<header class="site-header sticky-top py-1">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="index.php" class="navbar-brand" style="color: white">Accueil <i class="fas fa-book"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-male"></i> Les Auteurs</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item text-dark" href="listeAuteur.php">Liste des auteurs</a>
                        <a class="dropdown-item text-dark" href="formModifAuteur.php?action=Ajouter".php">Ajouter un auteur</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-book-open"></i> Les genres</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item text-dark" href="listeGenres.php">Liste des genres</a>
                        <a class="dropdown-item text-dark" href="formModifGenre.php?action=Ajouter">Ajouter un genre</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-flag"></i> Les nationalités</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item text-dark" href="listeNations.php">Liste des natonalités</a>
                        <a class="dropdown-item text-dark" href="formModifNationalite.php?action=Ajouter">Ajouter une nationalité</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>