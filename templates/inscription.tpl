
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <h1 class="mt-5">Création d'un compte utilisateur</h1>
          <br/>
          {if $notification != ""}
            <div class="alert {$notification_result} alert-dismissible fade show" role="alert">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
             {$notification}              
           </div>
           {/if}
            <form action="inscription.php" method="post" enctype="multipart/form-data" id="form-inscription">
              <div class="form-group">
                <label for="nom">Nom :</label>
                <input  type="texte" class="form-control" name="nom" id="nom" placeholder="Veuillez saisir votre nom" required>
              </div>
              <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input  type="texte" class="form-control" name="prenom" id="prenom" placeholder="Veuillez saisir votre prénom" required>
              </div>
              <div class="form-group">
                <label for="email">Adresse email :</label>
                <input  type="email" class="form-control" name="email" id="email" placeholder="Veuillez saisir votre email" required>
              </div>
              <div class="form-group">
                <label for="mdp">Mot de passe :</label>
                <input  type="password" class="form-control" name="mdp" id="mdp" placeholder="Veuillez saisir votre mot de passe" required>
              </div>                
              <button type="submit" name="submit" class="btn btn-primary">S'inscrire</button>
            </form>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/dist/jquery.validate.min.js"></script>
    <script src="js/dist/localization/messages_fr.min.js"></script>   
        
    
<script>
$(document).ready(function() {

//#identifiant  .classe
    $("#form-inscription").validate();
    

}); 


</script>

<!-- CHoix de la couleur d'erreur jquery validation -->
<style>
.error {
    color: red;// couleur choisi rouge
} 

   
   
</style>
