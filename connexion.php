
<?php

session_start();// permet d'initialiser une session

include 'config/connexion.inc.php';
require_once 'config/init.conf.php'; // permet d'appeler qu'une fois le fichier
require_once 'config/bdd.conf.php';  // si appeler 2 fois conflit donc impossible de les récupérer
require_once 'include/fonctions.inc.php';  // appel de la fonction SID  
require_once'libs/Smarty.class.php';




//Fonction de cryptage
if(isset($_POST['submit'])){

    
    $notification = '<strong>Aucune notification à afficher</strong>';   
    
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    
	//permet la vérification des champs.
   
    if(!empty($email) AND !empty($mdp)){ //permet de vérifier le mail et le mot de passe
                    
                          $mdp_hash = cryptPassword($mdp);//permet de crypter le MDP
                          $selectUser = "SELECT email, "// permet de consulter la partie utilisateur de notre BDD
                                  . "mdp " // consulte le mot de passe
                                  . "FROM utilisateurs "
                                  . "WHERE email = :email "
                                  . "AND mdp = :mdp";
                          
                       // Préparation de la requête select
                         $sth = $bdd->prepare($select_user);// prépare la requête utilisateur de la base de données
                         $sth->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
                         $sth->bindValue(':mdp', $mdp_hash, PDO::PARAM_STR); // mdp securisé
   
             
                                if($sth->execute() == TRUE){
                                    $count = $sth->rowCount();
                                  
                                    if($count > 0){
                                        
                                        $sid = sid($_POST['email']);
                               
                                    
                                                  
                                        // Requête de mise à jours
                                        $Update_sid = "UPDATE utilisateurs "
                                                . "SET sid = :sid "
                                                . "WHERE email = :email "; // evite de remettre a jours toutes les données 
                                        
                                      $sth_update = $bdd->prepare($Update_sid); //preparer la valeur
                                      $sth_update->bindValue(':sid',$sid, PDO::PARAM_STR); //securisé la valeur
                                      $sth_update->bindValue(':email',$email, PDO::PARAM_STR); //securisé la valeur
                           
                                      
                                            if($sth_update->execute() == TRUE){
                                                setcookie('sid', $sid, time() + 86400);
                                                
                                         //Connexion de l'utilisateur réussite
                                      $notification = '<strong>Félicitation, vous êtes connecté.</strong>';
                                      $_SESSION['notification_color'] = TRUE; 
                                      $_SESSION['notification'] = $notification; //renvoyer la notification vers une autre page
                                      header("Location: index.php"); //permet de rediriger sur la page connexion.php
                                      exit(); //arrêt du script après le header 

									  
									  
                                            }else{
												  $notification = '<strong>L\'email ou le mot de passe sont incorrects...</strong>';
                                      $_SESSION['notification_color'] = FALSE;                                          
                                    }


                                    }else{
                                      
                                                    $notification = '<strong>Une erreur technique est survenue...</strong>';
                                                    $_SESSION['notification_color'] = FALSE;   
                                            }
                                   
                                }else{
                                      $notification = '<strong>Une erreur technique est survenue...</strong>';
                                      $_SESSION['notification_color'] = FALSE;                 
                                }
        
    }else{
           $notification = '<strong>Veuillez renseigner les champs obligatoires...</strong>';
           $_SESSION['notification_color'] = FALSE;
        
    }
  
    $_SESSION['notification'] = $notification; //renvoyer la notification vers une autre page
  
    header('Location: connexion.php');
    exit();//arreter le script après le header
}else{


//Objets qui utilise des fonctions.
$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
//$smarty->setConfigDir('/web/www.example.com/guestbook/configs/');
//$smarty->setCacheDir('/web/www.example.com/guestbook/cache/');

//Envoie une variable php à smarty.

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

//** un-comment the following line to show the debug console
//$smarty->debugging = true;
include 'includes/header.php';
$smarty->display('connexion.tpl');
include 'includes/footer.inc.php'; // recupére le footer (=évite de répliquer le code sur chacune des pages html/php)

}

  ?>