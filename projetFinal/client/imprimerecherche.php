
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"> </script> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
<script>
	window.print();
</script>

<?php

$search=$_GET["search"];
$stotal=0;
	$tps=0;
	$tvq=0;
	$total=0;
echo "<h3> Facture #$search</h3>";
//2)connexion a la BD
include("../connexion.php");
//3) Requete de selection de livre
$reqrecherche=mysqli_query($connect,"select ventes.*,marchandises.prix,marchandises.nom from ventes,marchandises where ventes.code=marchandises.code  and novente='$search' order by ventes.datevente asc;") or die("erreur de requete SQL");
//3) Affichage des livres
while($reqresult=mysqli_fetch_row($reqrecherche))
		{
           
			echo "<table class='table table-striped table-dark'>
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
         <tbody>";
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
         </tr>";
       }
       echo"</tbody></table>";
		//Calcul des taxes et du total
	
		
	
?>