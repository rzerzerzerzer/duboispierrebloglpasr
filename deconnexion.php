
<?php

setcookie ("sid","",(time() -1));//permet la déconnexion en mettant le temps de sauvegarde a 0
header("Location: index.php");//redirection sur la page index.php
exit();
?>

