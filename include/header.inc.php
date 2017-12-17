<?php 

error_reporting(E_ALL);
ini_set("display_errors", 1);
?>



<!DOCTYPE html>
<html lang="fr">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bare - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
      body {
        padding-top: 54px;
      }
      @media (min-width: 992px) {
        body {
          padding-top: 56px;
        }
      }

    </style>

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Mon Blog
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="articles.php">Ajoutez un article</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="inscription.php">Inscription</a>
            </li>
            <li class="nav-item">
			<?php 
			if ($is_connect == FALSE){
			?>
			<li class="nav-item">
              <a class="nav-link" href="connexion.php">Connexion</a>
			   </li>
			<?php
			} else {
			?>
			<li class="nav-item">
			<a class="nav-link" href="deconnexion.php">Déconnexion</a>
			 </li>
			<?php
			}
			?>  
                         <li class="nav-item">
			<a class="nav-link" href="recherche.php">recherche</a>
			 </li>
            </li>
          </ul>
           <nav class="navbar navbar-light bg-light">
  <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="recherche" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">recherche</button>
  </form>
</nav>
        </div>
      </div>
    </nav>
