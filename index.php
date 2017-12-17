
<?php

session_start();

require_once 'config/init.conf.php'; // permet d'appeler qu'une fois le fichier 
require_once 'config/bdd.conf.php'; // si appeler 2 fois conflit donc impossible de les récupérer
require_once 'include/fonctions.inc.php';
include 'config/connexion.inc.php';
include 'include/header.php'; // recupére le header (=évite de répliquer le code sur chacune des pages html/php)
require_once 'config/bdd.conf.php';

//Classe Smarty
require_once'libs/Smarty.class.php';

        $nb_articles_par_page = 3; // Limitation du nombre d'article par page
        
        // Récupération du numéro de page dans l'url.
        $page_courante = isset($_GET['page']) ? $_GET['page'] : 1;
        
        $index = pagination($page_courante, $nb_articles_par_page);        
        
            // Barre de recherche :
			
             $recherche = isset($_GET['recherche']) ? $_GET['recherche'] : "";


             if($recherche != ""){
    
                  $nb_total_article_recherche =  nb_total_article_recherche($bdd,$recherche);

        $nb_pages = ceil($nb_total_article_recherche / $nb_articles_par_page);
        
        
       
         $sql = "SELECT "
               ."id, "
               ."texte,"
               ."titre, "
               ."DATE_FORMAT(date, '%d/%m/%Y') as date_fr "
               ."FROM articles "
               ."WHERE (titre LIKE :recherche OR texte LIKE :recherche) "
               ."AND publie=1 "
               ."ORDER BY date DESC "
                 ."LIMIT :index, :nb_articles_par_page;";
  //        ."LIMITE :debut, :message_par_page";

  $sth = $bdd->prepare($sql);
  $sth->bindValue(':recherche', '%'.$recherche.'%', PDO::PARAM_STR);
  $sth->bindValue(':index', $index, PDO::PARAM_INT);
  $sth->bindValue(':nb_articles_par_page', $nb_articles_par_page, PDO::PARAM_INT);

  if($sth->execute() == TRUE){
      $tab_articles = $sth->fetchAll(PDO::FETCH_ASSOC);
   // print_r($tab_articles); // Afficher le contenu du tableau

    //  echo $tab_articles[0]['titre'];
  }else{
      echo ' attention une erreur est survenue...';
  };  
}else{
    
        $nb_total_article_publie =  nb_total_article_publie($bdd);

        //nombre de pagesS à créer
        $nb_pages = ceil($nb_total_article_publie / $nb_articles_par_page);


        $select = "SELECT id, "
            . "titre, "
            . "texte, "
            . "DATE_FORMAT(date, '%d/%m/%Y') as date_fr "
            . "FROM articles "
            . "WHERE publie = :publie "
            . "LIMIT :index, :nb_articles_par_page;";

        //echo $select;
        /* @var $bdd PDO */
        $sth = $bdd->prepare($select);
        $sth->bindValue(':publie', 1, PDO::PARAM_BOOL);
        $sth->bindValue(':index', $index, PDO::PARAM_INT);
        $sth->bindValue(':nb_articles_par_page', $nb_articles_par_page, PDO::PARAM_INT);
        if($sth->execute() == TRUE){
            $tab_articles = $sth->fetchAll(PDO::FETCH_ASSOC);
          //  print_r($tab_articles);  Afficher le contenu du tableau

          //  echo $tab_articles[0]['titre'];
        }else{
            echo 'attention une erreur est survenue...';
        };
}


// Créer l'objet smarty en fin de page pour le chargement


//Objet pour lequel on utilise des fonctions
$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
//$smarty->setConfigDir('/web/www.example.com/guestbook/configs/');//accès à la bibliothèque smarty
//$smarty->setCacheDir('/web/www.example.com/guestbook/cache/');

//permet d'envoyer une variable php à smarty

$smarty->assign('recherche',$recherche);
$smarty->assign('tab_articles',$tab_articles);
$smarty->assign('nb_pages',$nb_pages);
$smarty->assign('page_courante',$page_courante);

/*
if($is_connect == TURE){
  $smarty->assign('nom',);
$smarty->assign('prenom',);
} 

$smarty->assign('',);
$smarty->assign('',);
$smarty->assign('',);
$smarty->assign('',);
$smarty->assign('',);
$smarty->assign('',);
$smarty->assign('',);
*/


//On regarde si l'utilisateur est connecté pour afficher le bouton "modifier" de l'article ou non.
//is_connect se trouve dans le fichier connexion.inc.php
if(isset($is_connect) AND $is_connect == TRUE){
    $smarty->assign('is_connect',$is_connect);
}else{
    $is_connect = FALSE;
    $smarty->assign('is_connect',$is_connect);
}





       if(isset($_SESSION['notification'])){
              $notification_result = $_SESSION['notification_color'] == TRUE ? 'alert-success' : 'alert-danger';
              $notification= $_SESSION['notification'] != "" ? $_SESSION['notification'] : "";
            
         $smarty->assign('notification_result',$notification_result);
          $smarty->assign('notification',$notification);
         
         
         
         
              unset($_SESSION['notification']);
              unset($_SESSION['notification_color']);
          }else{
              $notification_result ="";
              $notification ="";
          $smarty->assign('notification_result',$notification_result);
          $smarty->assign('notification',$notification);
          }

//** un-comment the following line to show the debug console
//$smarty->debugging = true;
include 'include/header.php';
$smarty->display('index.tpl');
include 'include/footer.inc.php';

