<?php

session_start();// permet d'initialiser une session


require_once 'config/init.conf.php';                    // permet d'appeler qu'une fois le fichier 
require_once 'config/bdd.conf.php';                     // si appeler 2 fois conflit donc impossible de les récupérer
include 'include/header.inc.php';                       // recupére le header (=évite de répliquer le code sur chacune des pages html/php)
require_once 'include/fonctions.inc.php';                // appel de la fonction SID   
require_once'libs/Smarty.class.php';
require_once 'config/connexion.inc.php';

    
    if($is_connect == true){
        
    }else{
        header('Location: connexion.php');
        exit();
    }

//Fonction de cryptage

if(isset($_POST['submit'])){
  
    
    $notification = '<strong>Aucune notification a afficher</strong>';   
    
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    
    //Vérification des champs pour éviter qu'ils soient vides
    if(!empty($nom) AND !empty($prenom) AND !empty($email) AND !empty($mdp)){
        
        //Vérification de la taille des chaines fixé à 50 caractères.
        if(strlen($nom)>50){
            $notification = '<strong>Le nom ne peut pas dépasser 50 caractères</strong>';
            $_SESSION['notification_color'] = FALSE;           
        }else{
            if(strlen($prenom)>50){
                $notification = '<strong>Le prénom ne peut pas dépasser 50 caractères</strong>';
            $_SESSION['notification_color'] = FALSE;
            }else{
                if(strlen($email)>150){
                    $notification = '<strong>L\'email  ne peut pas dépasser 150 caractères</strong>';
            $_SESSION['notification_color'] = FALSE;
                }else{
                    if(strlen($mdp)>150){
                        $notification = '<strong>Le mot de passe ne peut pas dépasser 150 caractères</strong>';
            $_SESSION['notification_color'] = FALSE;
           
		   
		   }else{
                   
	 // Requête insert
           $insert = "INSERT INTO utilisateurs (nom, prenom, email, mdp)"
            ."VALUES (:nom, :prenom, :email, :mdp)";
                     
                            $sth = $bdd->prepare($insert); //prépa de la requête insert
                            $sth->bindValue(':nom', $nom,  PDO::PARAM_STR);
                            $sth->bindValue(':prenom', $prenom, PDO::PARAM_STR);
                            $sth->bindValue(':email', $email, PDO::PARAM_STR);
                            $sth->bindValue(':mdp',cryptPassword($_POST['mdp']), PDO::PARAM_STR);
                                if($sth->execute() == TRUE){
									
                                    //Création du compte réussi
                                      $notification = '<strong>Félicitation, votre compte a été créé...</strong>';
                                      $_SESSION['notification_color'] = TRUE;
                                }else{
                                      $notification = '<strong>Une erreur est survenue lors de l\'inscription dans la BDD...</strong>';
                                      $_SESSION['notification_color'] = FALSE;                                    
                                }
                    }
                        
                }
            }
        }
        
    }else{
           $notification = '<strong>Veuillez renseigner les champs obligatoires...</strong>';
           $_SESSION['notification_color'] = FALSE;
        
    }
  
    $_SESSION['notification'] = $notification; //renvoyer la notification vers une autre page
  
    header('Location: inscription.php');
    exit();//arreter le script après le header
}else {
    
}

//Objet pour lequel on utilise des fonctions
$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
//$smarty->setConfigDir('/web/www.example.com/guestbook/configs/');
//$smarty->setCacheDir('/web/www.example.com/guestbook/cache/');




//Notification vers smarty
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
*/

//** un-comment the following line to show the debug console
//$smarty->debugging = true;
include 'includes/header.php';
$smarty->display('inscription.tpl');
include 'includes/footer.inc.php';

?>
