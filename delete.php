<?php 

session_start();
if($_SESSION["mail"] === "admin@eemi.com"){
    include("./includes/function.php");
    echo (delete(urldecode($_GET["mail"])));
    header("location:espace_administrateur.php");
}

?>