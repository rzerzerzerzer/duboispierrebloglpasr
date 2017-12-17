

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <h1 class="mt-5">{if $action=="modifier"}
		  
           Modifier un article
		   
           {else}
		   
           Ajouter un article
		   
           {/if}</h1>
               <br/>
          {if $notification != ""}
            <div class="alert {$notification_result} alert-dismissible fade show" role="alert">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
             {$notification}              
           </div>
           {/if}
          
            <form action="article.php" method="post" enctype="multipart/form-data" id="form-article">
                
                <!--On stocke l'id article récupéré par l'article à modifier  -->
                <input type="hidden" name="store_id_article" id="store_id_article" value="{$id_article}" />
                
              <div class="form-group">
                <label for="titre">Titre</label>
                <input  type="texte" class="form-control" name="titre" id="titre" value="{$titre}" placeholder="Veuillez choisir un titre" required>
              </div>
              <div class="form-group">
                <label for="texte">Insérer le texte de votre article</label>
                <textarea  class="form-control" id="texte" name="texte" rows="3" required>{$texte}</textarea>
              </div>
                  <div class="form-group">
                <label for="image">Insérer une image</label>
                {if $action == "modifier" && $id_article != ""}
                    <img  src=img\\{$id_article}.jpg style="width: 20rem;"> 
                    <input type="file" name="image" class="form-control-file" id="image">
                {else}
                    <input type="file" name="image" class="form-control-file" id="image" required>          
                {/if}
              </div>
                  <div class="form-group">
                <div class="form-check">
                  <label class="form-check-label" for="publie">
                    {if $action=="modifier" AND $publie==1}
                    <input class="form-check-input" id="publie" value=1 name="publie" checked type="checkbox"> Publier?
                    {else}
		    <input class="form-check-input" id="publie" value=1 name="publie" type="checkbox"> Publier?	
		    {/if}	
                  </label>
                </div>
              </div>
              <button type="submit" name="submit" value="{$action}" class="btn btn-primary">{if $action == "modifier"}
             
			 Modifier
			 
              {else}
			  
              Ajouter
			  
              {/if}
              </button>
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
    $("#form-article").validate();
    

}); 


</script>

<!-- CHoix de la couleur d'erreur jquery validation -->
<style>
.error {
    color: red; // couleur choisi rouge
} 

   
</style>
  