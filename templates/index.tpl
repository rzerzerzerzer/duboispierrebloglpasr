<div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="mt-5">Articles publiés</h1>
          <ul class="list-unstyled">
            <li>du plus récent au plus ancien</li>
          </ul>
        </div>
      </div>
	            {if $notification != ""}
				            <div class="alert {$notification_result} alert-dismissible fade show" role="alert">
             			 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             			 <span aria-hidden="true">&times;</span>
             </button>
			              {$notification}              
           </div>
           {/if}
    <br/>
    <div class="row justify-content-center"> {foreach from=$tab_articles item=value}
        <div class="card col-md-4">
  <img class="card-img-top" src="img/{$value.id}.jpg" alt="{$value.titre}" style="width: 20rem;">
  <div class="card-body">
    <h4 class="card-title">
            
          {$value.titre} <br/>
         
        </h4>
    <p class="card-text">{$value.texte}</p>
    <a href="#" class="btn btn-primary">Crée le {$value.date_fr}</a>
    
    {if $is_connect == "TRUE"}
    <a href="article.php?action=modifier&id_article={$value.id}" class="btn btn-warning">Modifier</a>
    {/if}
  </div>
      </div>  
       {/foreach}
    </div>
			        <!-- Pagination -->
					
			        <br/>
					        <div class="row justify-content-center">
							        <nav aria-label="Page navigation example">
									           <ul class="pagination">
											    {if $recherche == ""}
											    {for $i=1 to $nb_pages}
			     				                <li class="page-item {if $page_courante == $i}active{/if}">
                                                <a class="page-link" href="?page={$i}">{$i}</a>
                                                </li>
                                                {/for}
												
                {else}
				
                  {for $i=1 to $nb_pages}
				         <li class="page-item {if $page_courante == $i}active{/if}">
                         <a class="page-link" href="?page={$i}&recherche={$recherche}">{$i}</a>
                </li>
                {/for}                           
                {/if}
            </ul>
        </nav>
        </div> 
    </div>
   

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
