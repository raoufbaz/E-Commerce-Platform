<div class="container   text-white  " style="margin-top:5%" >

<form class="col-12 h-100" method="post">
    <div class="row">
    <h2 id="t">Gestion des Clients</h2>
        
    </div>
    <div class="form-row">

  <div class="form-group ">
    <label for="exampleInputEmail1">Nom</label>
    <input type="text" class="form-control "  name="nom"  placeholder="Nom" required>
  </div>
  <div class="form-group ml-5 ">
    <label for="exampleInputEmail1">Prenom</label>
    <input type="text" class="form-control "   name="prenom"  placeholder="Prenom" required>
  </div>
  </div>

  <div class="form-group ">
    <label for="exampleInputEmail1">Telephone</label>
    <input type="tel" class="form-control " style="width:42%"   name="tel" placeholder="Tel" required>
  </div>
  <div class="form-row">
  <div class="form-group ">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control "   name="username" placeholder="Username" required>
  </div>
  <div class="form-group ml-5">
    <label for="exampleInputPassword1 ">Password</label>
    <input type="password" class="form-control "   name="password" placeholder="Password" required>
  </div>
  <div class="form-group form-check">
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
  $prenom=trim($_POST["prenom"]);
  $tel=trim($_POST["tel"]);
  $code=substr($nom,0,3).substr($prenom,0,2).substr($tel,6,4);
  $login=trim($_POST["username"]);
  $password=trim($_POST["password"]);
    $reqinsert=mysqli_query($connect,"insert into clients values('$code','$nom','$prenom','$tel','$login','$password');") 
       or die("<h5 class='text-danger mt-5'>un probleme est survenu !</h5>");
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
$reqlisterecette=mysqli_query($connect,"select * from clients   limit $avancerecul,3") or die("Erreur de requete!");
$reqlisterecette2=mysqli_query($connect,"select * from clients  ") or die("Erreur de requete!");
$nbreliste=mysqli_num_rows($reqlisterecette2);


echo "<h3> Update & Delete (cochez une case pour manipuler) </h3>";
echo"<form method='post'> <input type='submit' name='recette' value='Update' class='btn btn-warning'>
<input type='submit' name='recette' value='Delete'  class='btn btn-danger'>";
echo "<table class='table table-striped table-dark mt-3' border='1'> <th>check</th><th>IDmembre</th><th>Nom </th><th>Prenom </th>
<th>Telephone </th><th>Username </th><th>Password </th></th>";
while($reqresultat=mysqli_fetch_row($reqlisterecette))
{
	$listeid=trim($reqresultat[0]);
	$listenom=trim($reqresultat[1]);
	$listeprenom=trim($reqresultat[2]);
	$listetelephone=trim($reqresultat[3]);
	$listeuser=trim($reqresultat[4]);
	$listepwd=trim($reqresultat[5]);

	echo"<tr><td><input type='checkbox' name='check[]' value='$listeid'></td>
	<td><input type='text' disabled='disabled' name='idrecette[]' value='$listeid'> 
	<input type='hidden' name='idrecettehidden[]' value='$listeid'> </td>
	<td><input type='text' name='nom2[]' value='$listenom'> </td>
	<td><input type='text' name='prenom2[]' value='$listeprenom'> </td>
	<td><input type='text' name='tel2[]' value='$listetelephone'> </td>
	<td><input type='text' name='user2[]' value='$listeuser'> </td>
	<td><input type='text' name='pwd2[]' value='$listepwd'> </td>
	</tr>";
		
}
echo "<tr  ><td colspan='4' ><a style='color:blue'  href='index.php?lien=clients&avancerecul=$avancerecul&nbreliste=$nbreliste&flech=recul'> Previous</a> </td>
<td colspan='5'style='text-align:right;'> <a style='color:blue' href='index.php?lien=clients&avancerecul=$avancerecul&nbreliste=$nbreliste&flech=avant'>  Next</a> </td>";
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
        $prenom2=$_POST['prenom2'];
        $tel2=$_POST['tel2'];
        $user2=$_POST['user2']; 
        $pwd2=$_POST['pwd2']; 
        
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
                                
                                $reqmiseajour="update clients set nom='$nom2[$j]',
                                prenom='$prenom2[$j]',
                                telephone='$tel2[$j]',
                                username='$user2[$j]',
                                 password='$pwd2[$j]'
                                  where noclient='$check[$i]'";
							$miseajour=mysqli_query($connect,$reqmiseajour) or die("Erreur de requete Update!");
						}
					}
				}
				$nbremaj=mysqli_affected_rows($connect);
				if($nbremaj >0)
				{ 
					echo"<h5 class='text-success mt-5' >Mise a Jour Reussi !</h5>";
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
							$requetes="delete from clients where noclient='$check[$i]'";
							$suppression=mysqli_query($connect,$requetes) or die("Erreur de requete Delete!");
						}
					}
				}
				$nbresup=mysqli_affected_rows($connect);
				if($nbresup >0)
				{ 
					echo"<h5 class='text-success mt-5' >Suppression reussi !</h5>";
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
