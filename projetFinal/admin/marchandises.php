

<div class="container   text-white  " style="margin-top:5%" >

<form  enctype="multipart/form-data" class="col-12 h-100" method="post">
    <div class="row">
    <h2 id="t">Gestion des Marchandises</h2>
        
    </div>
    <div class="form-row">

  <div class="form-group ">
    <label for="exampleInputEmail1">Nom</label>
    <input type="text" class="form-control "  name="nom"  placeholder="Nom" required>
  </div>
  <div class="form-group ml-5 ">
    <label for="exampleInputEmail1">Quantite</label>
    <input type="number" class="form-control "   name="quantite"  placeholder="Quantite" required>
  </div>
  <div class="form-group ml-5 ">
    <label for="exampleInputEmail1">Prix</label>
    <input type="number" class="form-control "   name="prix"  placeholder="Prix" required>
  </div>
  </div>

  <div class="form-row">
  <div class="form-group">
    <label for="exampleFormControlFile1"> Photo</label>
    <input type="file" id="Photo" name="uploaded_file" class="form-control-file">
  </div>
  </div>

  <button type="submit" name="inscrire" class="btn btn-primary mb-5">Enregistrer</button>
</form>
<?php
if(isset($_POST["inscrire"]))
{
  //connexion a la BD
  include("../connexion.php");
  
  $nom=trim($_POST["nom"]);
  $quantite=trim($_POST["quantite"]);
  $prix=trim($_POST["prix"]);
  $photo="../uploads/".$_FILES['uploaded_file']['name'];
  if(!empty($_FILES['uploaded_file']))
            {
                $reqinsert=mysqli_query($connect,"insert into marchandises(nom,quantite,prix,photo) values('$nom','$quantite','$prix','$photo');") 
                or die("<h5 class='text-danger mt-5'>un probleme est survenu !</h5>");                $path = "../uploads/";
                $path = $path . basename( $_FILES['uploaded_file']['name']);
                if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) 
                {
                    echo "The file ".  basename( $_FILES['uploaded_file']['name']). " has been uploaded";
                } 
                else
                {
                    echo "There was an error uploading the file, please try again!";
                }
            }
  
       $nbre = mysqli_affected_rows($connect);
       if ($nbre == 1) {
        echo "<h5 class='text-success mt-5' >Inscription Reussi</h5>";
       } else {
        echo "<h5 class='text-danger mt-5'>Probleme</h5>";
       }
  }
  ?>
  <?php
  include("../connexion.php");


//***********  AVANCE ET RECUL **************//
if(isset($_GET["flech"]))
{
	$flech=$_GET["flech"];
	$avancerecul=$_GET["avancerecul"];
	$nbreliste=$_GET["nbreliste"];
	switch($flech)
	{
		case"avant":
			if($avancerecul >=0 and($avancerecul<($nbreliste -3)))
			{
				$avancerecul=$avancerecul+3;
			}
			elseif($avancerecul<($nbreliste -3))
			{
				$avancerecul=$nbreliste;
			}
		break;
		
		case"recul":
			if($avancerecul<=2)
			{
				$avancerecul=0;
			}
			else
			{
				$avancerecul=$avancerecul-3;
			}
		break;
	}
}
else
{
	$avancerecul=0;
}

/******************************************/
/*Debut::: Affichage liste recettes 
/******************************************/
$reqlisterecette=mysqli_query($connect,"select * from marchandises  limit $avancerecul,3") or die("Erreur de requete!");
$reqlisterecette2=mysqli_query($connect,"select * from marchandises  ") or die("Erreur de requete!");
$nbreliste=mysqli_num_rows($reqlisterecette2);


echo "<h3> Update & Delete (cochez une case pour manipuler) </h3>";
echo"<form method='post'> <input type='submit' name='recette' value='Update' class='btn btn-warning'>
<input type='submit' name='recette' value='Delete'  class='btn btn-danger'>";
echo "<table border='1' class='table table-striped table-dark mt-3'> <th>check</th><th>#ID</th><th>Nom </th><th>Quantite </th>
<th>Prix </th><th>Photo </th></th>";
while($reqresultat=mysqli_fetch_row($reqlisterecette))
{
	$listeid=trim($reqresultat[0]);
	$listenom=trim($reqresultat[1]);
	$listeqte=trim($reqresultat[2]);
	$listeprix=trim($reqresultat[3]);
	$listephoto=trim($reqresultat[4]);

	echo"<tr><td><input type='checkbox' name='check[]' value='$listeid'></td>
	<td><input type='text' disabled='disabled' name='idrecette[]' value='$listeid'> 
	<input type='hidden' name='idrecettehidden[]' value='$listeid'> </td>
	<td><input type='text' name='nom2[]' value='$listenom'> </td>
	<td><input type='text' name='qte2[]' value='$listeqte'> </td>
	<td><input type='text' name='prix2[]' value='$listeprix'> </td>
    <td>
    <img src='$listephoto' style='width:50px;height:50px'>
	</tr>";
		
}
echo "<tr  ><td colspan='4' ><a style='color:blue'  href='index.php?lien=marchandises&avancerecul=$avancerecul&nbreliste=$nbreliste&flech=recul'> Previous</a> </td>
<td colspan='5'style='text-align:right;'> <a style='color:blue' href='index.php?lien=marchandises&avancerecul=$avancerecul&nbreliste=$nbreliste&flech=avant'>  Next</a> </td>";
echo "</table></form>";
/********************************/
/*FIN::: Affichage liste recettes 
/********************************/
/*  
Debut:::Mise a jour et Suppression MULTIPLE
*/

    include("../connexion.php");
    if(isset($_POST['recette']))
    {
        $check=$_POST['check'];
        $idrecettehidden=$_POST['idrecettehidden'];
        $nbrerowid=count($idrecettehidden);
        $nbrecheck=count($check);
        $nom2=$_POST['nom2'];
        $qte2=$_POST['qte2'];
        $prix2=$_POST['prix2'];
        
        //Le bouton de mise a jour et de suppression
        $recette=$_POST['recette'];
        switch($recette)
        { 
            case"Update";
                if(!empty($check))
                {
                    for($j=0;$j<$nbrerowid;$j++)
                    {
                        for($i=0;$i<$nbrecheck;$i++)
                        {
                            if($check[$i]==$idrecettehidden[$j])
                            {
                                
                                $reqmiseajour="update marchandises set nom='$nom2[$j]',
                                quantite='$qte2[$j]',
                                prix='$prix2[$j]'
                                  where code='$check[$i]'";
							$miseajour=mysqli_query($connect,$reqmiseajour) or die("Erreur de requete Update!");
						}
					}
				}
				$nbremaj=mysqli_affected_rows($connect);
				if($nbremaj >0)
				{ 
                    echo"
                    <script>location.reload(); </script>
                    <h5 class='text-success mt-5' >Mise a Jour Reussi !</h5>";
                    
                }
			}
			else
			{
				echo"<h5 class='text-danger mt-5' >Cochez au moins une case !</h5>";
            }
		
		break;
		case"Delete";
			if(!empty($check))
			{
				for($j=0;$j<$nbrerowid;$j++)
				{
					for($i=0;$i<$nbrecheck;$i++)
					{
						if($check[$i]==$idrecettehidden[$j])
						{
							$requetes="delete from marchandises where code='$check[$i]'";
							$suppression=mysqli_query($connect,$requetes) or die("Erreur de requete Delete!");
						}
					}
				}
				$nbresup=mysqli_affected_rows($connect);
				if($nbresup >0)
				{ 
                    echo"<h5 class='text-success mt-5' >Suppression reussi !</h5>
                    <script>location.reload(); </script>
                    
                    ";
				}
			}
			else
			{
				echo"<h5 class='text-danger mt-5' >Cochez au moins une case !</h5>";
			}
		
		break;
	}
}
?>
</div>
