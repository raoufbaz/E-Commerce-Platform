
<?php
//revenir a la page d'accueil si la session est fermé (empecher de faire precedent et revenir a la page si deconnexion)
if (!$_SESSION["login"] and !$_SESSION["password"]) {
    //rediriger vers la page d'accueil
    echo "<script>window.location.href='../index.php';</script>";
    
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"> </script> 
<div class="container   text-white  " style="margin-top:5%" >

<form class=" h-100" id="formsearch">
<h2>Recherche</h2>
<div class="row mt-4">
    <form class="">
    <input class="form-control w-50 " id="search" type="search" name="search" placeholder="Search" aria-label="Search">
  </form> 
</div>
 
<div id="contenu" class="row mt-5">

</div> 


</div>
<script type="text/javascript" >
	
	$("#search").keyup(function(){
		//Serialize le formulaire de recherche
		var formsearch = $("#formsearch").serialize();
		//vider le contenu
		$("#contenu").html("");
		//Charger le fichier de recherche
		$("#contenu").load("functrecherche.php?" + formsearch);
	})
	$("#search").click(
		function()
		{
			$("#search").val("");
		}
	)
	
</script>