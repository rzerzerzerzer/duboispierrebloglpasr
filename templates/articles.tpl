mettre les required comme dans la page conexion.tpl 
et copier le code suivant dans la page articles.php
  <script>
$( document ).ready(function() {
    $( "#form_utilisateurs" ).validate();
});
</script>
<!-- affiche en couleur rouge lorsqu'il y a une erreur sur l'adresse mail ou mot de passe -->
<style>
    .error{
     color: red;   
    }
    </style>