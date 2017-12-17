<?php

session_start();//Sert à initialiser les sessions et d'utiliser les informations donnée par la page.


require_once'libs/Smarty.class.php'; // fait appel à la Bibliothèque smarty.
require_once 'config/init.conf.php'; // faitt appel à l'init.conf.php
require_once 'config/bdd.conf.php';
include 'config/connexion.inc.php';
include('include/header.inc.php');


// Pour modifier ou ajouter un article il faut récuperer ses paramètres dans l'url.
$action = isset($_GET['action']) ? $_GET['action'] : "ajouter";
$id_article = isset($_GET['id_article']) ? $_GET['id_article'] : "";



    // Pour modifier ou ajouter un article il faut être connecté.
    if($is_connect == true){
        
    }else{
        header('Location: connexion.php');
        exit();
    }
    
      //On met par défaut les valeurs récupéré par vide, pour éviter d'avoir des variables non définies.
     $titre="";
     $texte="";
     $publie="";

 if($action == "modifier"){
     
     $image = $id_article+".jpg";
     
     
     //Requête pour obtenir les valeurs de l'article à modifier
            $select = "SELECT id, "
                . "titre, "
                . "texte, "
                . "publie "
                . "FROM articles "
                . "WHERE id = :id_article;";
            
            $sth = $bdd->prepare($select);
            $sth->bindValue(':id_article', $id_article,  PDO::PARAM_INT);
  
            
         if($sth->execute() == TRUE){
            
        $tab_articles = $sth->fetchAll(PDO::FETCH_ASSOC);
        
        //Récupération des valeur à modifier dans l'article
      
        foreach ($tab_articles as $value){
            $titre=$value['titre'];
            $texte=$value['texte'];
            $publie=$value['publie'];
        }  
        }else{
            echo "Une erreur est survenue lors de l'affichage des données de l'article.";
            exit();
        }            
 }   
    
   
if(isset($_POST['submit'])){
    //print_r($_POST);

    
    // attribue la valeur publie si elle est postée ?-> si    :-> sinon   
	$publie = isset($_POST['publie']) ? $_POST['publie'] : 0;
          
 
    $notification = '<strong>Aucune notification à afficher</strong>';
    
    $date_du_jour = date("Y-m-d");
    
    if(!empty($_POST['titre']) AND !empty($_POST['texte'])){
		
		if($_POST['submit'] == "ajouter"){
        if(($_FILES) AND $_FILES['image']['error'] == 0){        
        
        
  /*      if(isset($_POST['publie'])){
            $publie = $_POST['publie'];
        }else{
            $publie = 0;
        }*/
             
        
        //requête insérer l'article
    $insert = "INSERT INTO articles (titre, texte, date, publie)"//requête d'insertion
            ."VALUES (:titre, :texte, :date, :publie)";
     
    $sth = $bdd->prepare($insert);
	  $sth->bindValue(':titre', $_POST['titre'],  PDO::PARAM_STR);
      $sth->bindValue(':texte', $_POST['texte'], PDO::PARAM_STR);
     $sth->bindValue(':date', $date_du_jour, PDO::PARAM_STR);
    $sth->bindValue(':publie', $publie, PDO::PARAM_BOOL);
   
        if($sth->execute() == TRUE){ //execute la requête si c'est bon
            
            $id_article = $bdd->lastInsertId(); //Renseignerécupération de l'id de l'article pour associer l'image au bonne article.
            
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION); //Récupérayion de l'image.
            echo $extension;
            
            $tab_extensions = array( //Tableau d'extension autorisé.
                'jpg'
  //              'png',
   //             'jpeg'
            );
           
            $result_extension_image = in_array($extension, $tab_extensions); //On vérifie si l'extension est présente dans le tableau
            
            move_uploaded_file($_FILES['image']['tmp_name'],'img/' . $id_article . '.' . $extension); //on upload l'image vers le dossier img avec comme format id.extension
            
        $notification = '<strong>Félicitation, l\'article est inséré...</strong>';
        $_SESSION['notification_color'] = TRUE;
        
        
    }else{
        $notification = '<strong>Une erreur est survenue lors de l\'insertion de 
            l\'article dans la base de données...</strong>';
        $_SESSION['notification_color'] = FALSE;
    }
    }else{
        $notification = '<strong>Une erreur est survenue lors du traitement
            de l\'image</strong>';
        $_SESSION['notification_color'] = FALSE;
    }
	
	}else{
		if($_POST['submit'] == "modifier"){
                    
                        echo "tt";
			echo $_POST['store_id_article'];
			$publie = isset($_POST['publie']) ? $_POST['publie'] : 0;

			    $update = "UPDATE articles "
                                    . "SET titre = :titre, "
                                    . "texte = :texte, "
                                    . "publie = :publie "
                                    . "WHERE id  = :id_article;";
                            
           
     
			$sthh = $bdd->prepare($update);
			$sthh->bindValue(':titre', $_POST['titre'],  PDO::PARAM_STR);
			$sthh->bindValue(':texte', $_POST['texte'], PDO::PARAM_STR);
			$sthh->bindValue(':publie', $publie, PDO::PARAM_BOOL);
			$sthh->bindValue(':id_article', $_POST['store_id_article'], PDO::PARAM_INT);
			
			
			 if($sthh->execute() == TRUE){
				 
				 
			if(($_FILES) AND $_FILES['image']['error'] == 0){
				
		    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION); //On récupère l'extension de l'image
            
            
            $tab_extensions = array( //restriction d'extension dans un tableau
                'jpg'
  //              'png',
   //             'jpeg'
            );
           
            $result_extension_image = in_array($extension, $tab_extensions); //On vérifie si l'extension est présente dans le tableau
            
            move_uploaded_file($_FILES['image']['tmp_name'],'img/' . $_POST['store_id_article'] . '.' . $extension); //on upload l'image vers le dossier img avec comme format id.extension
     
				
			}else{
	
                                echo 'erreur image';
					
			}				 
				 
			$notification = '<strong>Félicitation, l\'article a été modifié...</strong>';
			$_SESSION['notification_color'] = TRUE;

        				 
			 }else{
				 			$notification = '<strong>Une erreur est survenue lors du traitement de l\'image...</strong>';
							$_SESSION['notification_color'] = FALSE;

			 }
			
		}else{
           $notification = '<strong>Une erreur est survenue lors de l \'insertioon de l\'article</strong>';
           $_SESSION['notification_color'] = FALSE;			
		}
	}
    }else{
        
           $notification = '<strong>Veuillez renseigner les champs obligatoires</strong>';
           $_SESSION['notification_color'] = FALSE;
    }
    $_SESSION['notification'] = $notification; //renvoie la notification vers une autre page.
  
    header('Location: article.php');
    exit();//arrete le script
}else {
    

    }

//Objet pour lequel on utilise des fonctions
$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
//$smarty->setConfigDir('/web/www.example.com/guestbook/configs/');
//$smarty->setCacheDir('/web/www.example.com/guestbook/cache/');

//permet d'envoyer une variable php à smarty

$smarty->assign('action',$action);
$smarty->assign('publie',$publie);
$smarty->assign('id_article',$id_article);
$smarty->assign('texte',$texte);
$smarty->assign('titre',$titre);

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


include 'include/header.php';
$smarty->display('article.tpl');
include 'include/footer.inc.php'; ?>
