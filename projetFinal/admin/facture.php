<script type="text/javascript">
function imprimer(page) {
	window.open(page,"Impression","menubar=no, status=no, scrollbars=no, menubar=no, width=900, height=900");
}
</script>
<?php
//1) connexion a la base de donnee
include("../connexion.php");

?>
<div class="container   text-white  " style="margin-top:5%" >

<form class="col-12 h-100" method="post">
    <div class="row">
    <h2 id="t">Gestion des Ventes</h2>
        
    </div>
    <div class="form-row">

  <div class="form-group ">
    <label for="exampleInputEmail1">#Client</label>
    <select name="choixclient">
                                    <?php
                                    //1)connexion deja faite avec include
                                    //2)requete sql de idclient

                                    $listeIdclient = mysqli_query($connect, "select noclient from clients");
                                    while ($reqIdclient = mysqli_fetch_row($listeIdclient)) {
                                        if ($choixidclient == $reqIdclient[0]) {
                                            echo "<option value='$reqIdclient[0]' selected >$reqIdclient[0] </option>";
                                        } else {
                                            echo " <option value='$reqIdclient[0]'>$reqIdclient[0] </option>";
                                        }
                                    }
                                    ?>
                                </select>
  </div>
  <div class="form-group ml-5 ">
    <label for="exampleInputEmail1">#Produit</label>
    <select name="choixcode">
                                    <?php
                                    //1)connexion deja faite avec include
                                    //2)requete sql de idclient

                                    $listeIdclient = mysqli_query($connect, "select code from marchandises");
                                    while ($reqIdclient = mysqli_fetch_row($listeIdclient)) {
                                        if ($choixidclient == $reqIdclient[0]) {
                                            echo "<option value='$reqIdclient[0]' selected >$reqIdclient[0] </option>";
                                        } else {
                                            echo " <option value='$reqIdclient[0]'>$reqIdclient[0] </option>";
                                        }
                                    }
                                    ?>
                                </select>
  </div>
  </div>

  
  <div class="form-row">
  <div class="form-group ">
    <label for="exampleInputEmail1">Prix de Vente</label>
    <input type="number" class="form-control "   name="prix" placeholder="prix" required>
  </div>
  <div class="form-group ml-5">
    <label for="exampleInputPassword1 ">Quantite</label>
    <input type="number" class="form-control "   name="quantite" placeholder="quantite" required>
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
  
  $client=trim($_POST["choixclient"]);
  $code=trim($_POST["choixcode"]);
  $quantite=($_POST["quantite"]);
  $prix=($_POST["prix"]);
  $total=$quantite*$prix*1.15;
    $reqinsert=mysqli_query($connect,"insert into ventes(noclient,code,prixvente,quantite) values('$client','$code','$total','$quantite');") 
    or die("<h5 class='text-danger mt-5'>un probleme est survenu !</h5>");
    $reqselect=mysqli_query($connect,"select novente from ventes where noclient='$client' and code='$code' and prixvente='$total' ;") 
    or die("<h5 class='text-danger mt-5'>un probleme est survenu !</h5>");
    while ($reqIdclient = mysqli_fetch_row($reqselect)) {
            $novente=$reqIdclient[0];
    }
    $nbre = mysqli_affected_rows($connect);
       if ($nbre == 1) {
        echo "<h5 class='text-success mt-5' >Insertion Reussi</h5>
        <a href=\"javascript:imprimer('imprimerecherche.php?search=$novente')\"> <u>Imprimer Facture</u> </a> 
        ";
       } else {
        echo "<h5 class='text-danger mt-5'>Probleme</h5>";
       }
  }
  ?>