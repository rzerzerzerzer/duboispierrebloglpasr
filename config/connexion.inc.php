<?php
$is_connect = false;
$message_con = "";

// utilisation des cookies 

if (isset($_COOKIE['sid'])){

    $sid = $_COOKIE['sid'];
if(!empty($sid)){
    
$selectsid = "SELECT sid, nom, prenom "
                      . "FROM utilisateurs "
                      . "WHERE sid = :sid ";
                                       
  //verification de l'état de connexion
  
  
                   $sth = $bdd->prepare($selectsid);
                   $sth->bindValue(':sid', $sid, PDO::PARAM_STR);
                   if($sth->execute() == TRUE){
                            $count = $sth->rowCount();
                            
                            if($count > 0){
                                $is_connect = true;
                                $tab_user = $sth->fetchAll(PDO::FETCH_ASSOC);
                                
                                foreach ($tab_user as $value){
                                     $user_nom = $value['nom'];
                                     $user_prenom = $value['prenom'];
                                }
                                
                                $message_con = "Connecté en tant que ".$user_prenom." ".$user_nom;
                                
                                ?>
                        <row class="col-lg-5  alert alert-info alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        <?=$message_con?>
                        </row> <?php 
                                
                                
                                unset($_SESSION['prenom_user']);
                                unset($_SESSION['nom_user']);
                                $is_connect = true;
                 
                            }
                   }else{

                            
                            echo $is_connect;
                   }    

      
}else{
    echo $is_connect;
}

}else{
     echo $is_connect;
}
       
                                              
?>
