<?php
//1) session permet de passer les informations dune page .php a une autre page .php
//Demarrage de la session si elle n'est pas initialiser
if (!isset($_SESSION)) {
    session_start();
}
?>
<div class="container   text-white  " style="margin-top:5%" >
<form class="col-12 h-100" method="post">
    <div class="row">
    <h2>Login</h2>
        
    </div>
  <div class="form-group ">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control w-50" name="username"   placeholder="Username" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1 ">Password</label>
    <input type="password" class="form-control w-50" name="password"  placeholder="Password" required>
  </div>
  <div class="form-group form-check">
  </div>
  <button type="submit" name="entrer" class="btn btn-primary">Submit</button>
</form>
<?php
//section PHP
//1- connexion
//$connect = mysqli_connect('localhost', 'root', '', 'a2019gr441442') or die("erreur de connexion");
include("connexion.php");
//2-recuperation des donnes
if (isset($_POST["entrer"])) {
    $login = $_POST["username"];
    $password = $_POST["password"];
    //3 requete de selection
    $selection = mysqli_query($connect, "select * from clients where username='$login' and password='$password'");
    $selection2 = mysqli_query($connect, "select * from admin where idadmin='$login' and password='$password'");
    //4 analyse et affichage des resultats de la requete
    $nbre = mysqli_num_rows($selection);
    $nbre2 = mysqli_num_rows($selection2);
    //verifier si login et passwordd corrects
    //pour rediriger vers la page indexadmin.php
    if ($nbre == 1) {
        while ($resultats = mysqli_fetch_row($selection)) {
            //Recuperation des donnees dans une $_SESSION[]
            $_SESSION["idmembre"] = $resultats[0];
            $_SESSION["nom"] = $resultats[1];
            $_SESSION["prenom"] = $resultats[2];
            $_SESSION["tel"] = $resultats[3];
            $_SESSION["login"] = $resultats[4];
            $_SESSION["password"] = $resultats[5];
			echo '<script>window.location.href="client/index.php"; </script>';
		}
        }
     elseif($nbre2 == 1){
      while ($resultats = mysqli_fetch_row($selection2)) {
        $_SESSION["idadmin"] = $resultats[0];
        $_SESSION["password"] = $resultats[1];
        echo '<script>window.location.href="admin/index.php"; </script>';
     }
    }
		else {
			echo "<h5 class='text-danger mt-5'>username et/ou password incorrecte</h5>";
        }
    } 
	
?>
</div>
