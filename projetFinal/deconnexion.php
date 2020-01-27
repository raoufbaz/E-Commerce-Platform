<?php
//1)fermeture de la session
session_destroy();
//2)vider les variables $_SESSION
session_unset();
//3)fermeture de la connexion avec mysql
mysqli_close($connect);
//4)rediriger vers la page d'accueil
echo "<script>window.location.href='../index.php?lien=accueil';</script>";
