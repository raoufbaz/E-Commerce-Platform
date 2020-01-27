
<div class="container   text-white  " style="margin-top:5%" >
<form class="col-12 h-100" method="post">
    <div class="row">
    <h2 id="t">Inscription</h2>
        
    </div>
  <div class="form-group ">
    <label for="exampleInputEmail1">Nom</label>
    <input type="text" class="form-control w-50"  name="nom"  placeholder="Nom" required>
  </div>
  <div class="form-group ">
    <label for="exampleInputEmail1">Prenom</label>
    <input type="text" class="form-control w-50"   name="prenom"  placeholder="Prenom" required>
  </div>
  <div class="form-group ">
    <label for="exampleInputEmail1">Telephone</label>
    <input type="tel" class="form-control w-50"   name="tel" placeholder="Tel" required>
  </div>
  <div class="form-group ">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control w-50"   name="username" placeholder="Username" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1 ">Password</label>
    <input type="password" class="form-control w-50"   name="password" placeholder="Password" required>
  </div>
  <div class="form-group form-check">
  </div>
  <button type="submit" name="inscrire" class="btn btn-primary">Sign Up</button>
</form>
<?php
if(isset($_POST["inscrire"]))
{
  //connexion a la BD
  include("connexion.php");
  
  $nom=trim($_POST["nom"]);
  $prenom=trim($_POST["prenom"]);
  $tel=trim($_POST["tel"]);
  $code=substr($nom,0,3).substr($prenom,0,2).substr($tel,6,4);
  $login=trim($_POST["username"]);
  $password=trim($_POST["password"]);
    $reqinsert=mysqli_query($connect,"insert into clients values('$code','$nom','$prenom','$tel','$login','$password');") 
       or die("Erreur de requete SQL!");
       $nbre = mysqli_affected_rows($connect);
       if ($nbre == 1) {
        echo "<h5 class='text-success mt-5' >Inscription Reussi</h5>";
       } else {
        echo "<h5 class='text-danger mt-5'>Probleme</h5>";
       }
  }
  ?>
</div>
