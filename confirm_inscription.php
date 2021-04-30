<?php
session_start();

$titre = "Confirmation d'inscription";

include(PATH_COMPONENT."header.php");

echo("<h1>Merci ".$_SESSION["prenom"].", votre inscription a bien été prise en compte et vous recevrez un mail d'ici quelques minutes à l'adresse ".$_SESSION["mail"]."</h1>");

include(PATH_COMPONENT."footer.php") ?>