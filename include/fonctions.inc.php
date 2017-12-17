<?php

//Fonction de cryptage

function cryptPassword($mdp){ 
    $mdp_crypt = sha1($mdp); //demande d'hacher le mot de passe dans une chaine de caratère.
    return $mdp_crypt;
}

//Fonction sid
function sid($email){
    $sid = md5($email . time());
    return $sid;
}

//Fonction de pagination + nombre d'article par page

function pagination($page_courante,$nb_articles_par_page){
    $index = ($page_courante-1)*$nb_articles_par_page;
    return $index;
    
}

function nb_total_article_publie($bdd){
    /* @var $bdd PDO */
    
    $sql=" SELECT COUNT(*) as nb_total_article_publie "
                . "FROM articles "
                . "WHERE publie = 1;";
    
    $sth = $bdd->prepare($sql);
    $sth->execute();
    $tab_result = $sth->fetch(PDO::FETCH_ASSOC);
    
    return $tab_result['nb_total_article_publie'];
}

function nb_total_article_recherche($bdd,$recherche){
    /* @var $bdd PDO */
    
    $sql=" SELECT COUNT(*) as nb_total_article_recherche "
                . "FROM articles "
                . "WHERE (titre LIKE :recherche OR texte LIKE :recherche) "
                . "AND publie = 1;";
    
    
    $sth = $bdd->prepare($sql);
    $sth->bindValue(':recherche', '%'.$recherche.'%', PDO::PARAM_STR);
    $sth->execute();
    $tab_result = $sth->fetch(PDO::FETCH_ASSOC);
    
    return $tab_result['nb_total_article_recherche'];
}

?>