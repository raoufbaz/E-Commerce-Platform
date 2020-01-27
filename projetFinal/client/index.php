<?php
//demarrage de la session
if (!isset($_SESSION)) {
    session_start();
}
//revenir a la page d'accueil si la session est fermé (empecher de faire precedent et revenir a la page si deconnexion)
if (!$_SESSION["login"] and !$_SESSION["password"]) {
    //rediriger vers la page d'accueil
    echo "<script>window.location.href='../index.php';</script>";
    
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
    <style>
    body{ background-image: url('../bg.jpg');
    }
        </style>
</head>
  <body>
  <nav class="navbar fixed-top  navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php?lien=accueil">E-Commerce</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <a class="nav-item nav-link text-white " href="index.php?lien=accueil">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link text-white" href="index.php?lien=recherche">Recherche</a>
      <a class="nav-item nav-link text-white" href="index.php?lien=historique">Historique</a>
      <a class="nav-item nav-link text-white" href="index.php?lien=deconnexion">Deconnexion</a>
    </div>
  </div>
</nav>
    



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
    
  </body>
</html>


<!--details -->
<?php
if(isset($_REQUEST["lien"])){
    $lien=$_REQUEST["lien"];
    switch($lien){
        case"accueil":
            include("accueil.php");
        break;
        case"historique":
            include("historique.php");
        break;
        case"recherche":
          include("recherche.php");
      break;
        case"deconnexion":
          include("../deconnexion.php");
      break;
      
    }
}
else{
    include("accueil.php");
}
?>
</div>

</center>