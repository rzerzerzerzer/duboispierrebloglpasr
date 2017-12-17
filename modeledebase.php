<?php
require_once ('config/init.conf.php'); // permet d'appeler qu'une fois le fichier 
require_once ('config/bdd.conf.php');             // si appeler 2 fois conflit donc impossible de les récupérer
require_once ('include/fonctions.inc.php');
include('config/connexion.inc.php');
include('include/header.inc.php');// recupére le header (=évite de répliquer le code sur chacune des pages html/php)


        
?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">A Bootstrap 4 Starter Template</h1>
            <p class="lead">Complete with pre-defined file paths and responsive navigation!</p>
            <ul class="list-unstyled">
                <li>Bootstrap 4.0.0-beta</li>
                <li>jQuery 3.2.1</li>
            </ul>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
     <script src="js/dist/jquery.validate.min.js"></script>
 <script src="js/dist/localization/messages_fr.min.js"></script>

<?php
include 'include/footer.inc.php';                       // recupére le footer (=évite de répliquer le code sur chacune des pages html/php)
?>