<?php
require_once ('config/init.conf.php'); // permet d'appeler qu'une fois le fichier 
require_once ('config/bdd.conf.php');             // si appeler 2 fois conflit donc impossible de les récupérer
require_once ('include/fonctions.inc.php');
include('config/connexion.inc.php');
include('include/header.inc.php');// recupére le header (=évite de répliquer le code sur chacune des pages html/php)

$sql = "SELECT "
    . "id,"
    . "texte, "
    . "titre, "
    . "DATE_FORMAT(date, '%d/%m/%Y') as date_fr "
    . "FROM articles "
    . "WHERE (titre LIKE :recherche OR texte LIKE :recherche) "
    . "AND publie=1 "
    . "ORDER BY date DESC "
    . "LIMIT :debut, :index, :nb_articles_par_page";
    
$recherche = isset($_GET['recherche']) ? $_GET['recherche'] : 0;
        $sth = $bdd->prepare($sql);
        $sth->bindValue(':recherche', '%', $recherche . '%', PDO::PARAM_STR);
?>

<!-- Page Content -->

<form class="navbar-form navbar-right inline-form">
            <div class="form-group">
              <input type="search" class="input-sm form-control" placeholder="Recherche">
              <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-eye-open"></span> Chercher</button>
            </div>
          </form> 
       

<!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
     <script src="js/dist/jquery.validate.min.js"></script>


<?php
include 'include/footer.inc.php';                       // recupére le footer (=évite de répliquer le code sur chacune des pages html/php)
?>