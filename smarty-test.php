<?php

require_once ('config/bdd.conf.php');             // si appeler 2 fois conflit donc impossible de les récupérer
require_once ('include/fonctions.inc.php');
require_once('libs/Smarty.class.php');

$prenom = 'TOTO';

$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
//$smarty->setConfigDir('/web/www.example.com/guestbook/configs/');
//$smarty->setCacheDir('/web/www.example.com/guestbook/cache/');

//permet d'envoyer une variable PHP à smarty

$smarty->assign('name',$prenom);

//** un-comment the following line to show the debug console
//$smarty->debugging = true;
include('include/header.inc.php');// recupére le header (=évite de répliquer le code sur chacune des pages html/php)
$smarty->display('smarty-test.tpl'); // il va transmettre dans la page smarty-test.tpl
include 'include/footer.inc.php';
?>
