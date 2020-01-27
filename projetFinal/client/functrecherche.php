<?php
//1)recuperation des donnees recherchees
	$search=$_REQUEST["search"];
//2) connexion a la BD
	include("../connexion.php");
//3) requete de recherche
	$reqsearch=mysqli_query($connect,"select * from marchandises where code  like '$search%' or nom like '$search%'");
//4) Analyse et affichage des resultats
	$nbre=mysqli_num_rows($reqsearch);
	if($nbre >0)
	{
		echo"<table class='table table-striped table-dark'>
		<thead>	
			<tr>
				
      			<th scope='col'>Code</th>
      			<th scope='col'>Nom</th>
	  			<th scope='col'>Quantite</th>
	  			<th scope='col'>Prix</th>
	  			<th scope='col'>Taxes</th>
	  			<th scope='col'>Photo</th>
	  		</tr>
		  </thead>
		   <tbody>
		  ";
		while($reqresult=mysqli_fetch_row($reqsearch))
		{
			$tax=$reqresult[3]*1.15;
			echo "<tr>
			<td>$reqresult[0] </td> 
			<td>$reqresult[1] </td>
			<td>$reqresult[2] </td>
			<td>$reqresult[3] </td>
			<td>$tax $ </td>
			<td>$reqresult[4] </td>
			</tr>";
		}
		echo"</tbody></table>";
	}
	else
	{
		echo "Aucun resultat pour la recherche";
	}
?>

