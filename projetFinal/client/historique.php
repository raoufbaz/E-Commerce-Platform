
<?php
//revenir a la page d'accueil si la session est fermé (empecher de faire precedent et revenir a la page si deconnexion)
if (!$_SESSION["login"] and !$_SESSION["password"]) {
    //rediriger vers la page d'accueil
    echo "<script>window.location.href='../index.php';</script>";
    
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"> </script> 
<script type="text/javascript">
function imprimer(page) {
	window.open(page,"Impression","menubar=no, status=no, scrollbars=no, menubar=no, width=900, height=900");
}
</script>
<div class="container   text-white  " style="margin-top:5%" >

<form class=" h-100" id="formsearch">
<h2>Historique d'achats</h2>
<div class="row mt-4">
    
</div>
 
<div id="contenu" class="row mt-5">
<?php
//2) connexion a la BD
	include("../connexion.php");
//3) requete de recherche
$id =$_SESSION['idmembre'];
$reqsearch=mysqli_query($connect,"select ventes.*,marchandises.prix,marchandises.nom from ventes,marchandises where ventes.code=marchandises.code  and noclient='$id' order by ventes.datevente asc;") or die("erreur de requete SQL");
//4) Analyse et affichage des resultats
	$nbre=mysqli_num_rows($reqsearch);
	if($nbre >0)
	{
		echo"<table class='table table-striped table-dark'>
		<thead>	
			<tr>
				
                  <th scope='col'>#Vente</th>
	  			<th scope='col'>Date de Vente</th>
      			<th scope='col'>#Produit</th>
      			<th scope='col'>Nom </th>
	  			<th scope='col'>Quantite</th>
	  			<th scope='col'>Prix</th>
	  			<th scope='col'>Sous-Total</th>
	  			<th scope='col'>TPS</th>
	  			<th scope='col'>TVQ</th>
	  			<th scope='col'>Total</th>
	  		</tr>
		  </thead>
		   <tbody>
		  ";
		while($reqresult=mysqli_fetch_row($reqsearch))
		{
			$tps=$reqresult[6]*$reqresult[5]*0.05;
			$tvq=$reqresult[6]*$reqresult[5]*0.10;
			$soustotal=$reqresult[5]*$reqresult[6];
			echo "<tr>
			<td>$reqresult[0] </td> 
			<td>$reqresult[3] </td>
            <td>$reqresult[2] </td>
            <td>$reqresult[7] </td>
			<td>$reqresult[5]  </td>
			<td>$reqresult[6] $ </td>
			<td>$soustotal $ </td>
			<td>$tps $ </td>
			<td>$tvq $ </td>
			<td>$reqresult[4] $ </td>
			<td><a href=\"javascript:imprimer('imprimerecherche.php?search=$reqresult[0]')\"> <u>Imprimer</u> </a> </td>
		
			</tr>";
		}
		echo"</tbody></table>";
	}
	else
	{
		echo "Aucun resultat pour la recherche";
	}
?>


</div> 


</div>
