<?php
define("PATH_COMPONENT", "./includes/component/");
// Variables CSS

// Fonction pour verif le prenom
function verif_prenom($prenom) {
	$test_special = 0;
	$test_nbr = 0;
	$tab_special = array("*","/","?","!","@","#","%");
	$tab_nbr = array("0","1","2","3","4","5","6","7","8","9");
	for ($i = 0; $i < count($tab_special); $i++){
		if (strpos($prenom, $tab_special[$i]) !== false){
			$test_special = 1;
		}
	}
	for ($i = 0; $i < count($tab_nbr); $i++){
		if (strpos($prenom, $tab_nbr[$i]) !== false){
			$test_nbr = 1;
		}
    }
	if ($prenom == "") {
		return("Saisissez un prénom");
	}
    elseif ($test_nbr != 0) {
        return("Le prenom n'est pas correct il contient un nombre");
    }
    elseif($test_special != 0) {
        return("Votre prenom ne doit pas contenir de caractère spéciaux");
	}
    else {
        return (true);
    }
}
// Fonction pour verif le nom
function verif_nom($nom) {
	$test_special = 0;
	$test_nbr = 0;
	$tab_special = array("*","/","?","!","@","#","%");
	$tab_nbr = array("0","1","2","3","4","5","6","7","8","9");
	for ($i = 0; $i < count($tab_special); $i++){
		if (strpos($nom, $tab_special[$i]) !== false){
			$test_special = 1;
		}
	}
	for ($i = 0; $i < count($tab_nbr); $i++){
		if (strpos($nom, $tab_nbr[$i]) !== false){
			$test_nbr = 1;
		}
    }
	if ($nom == "") {
		return("Saisissez un nom");
	}
    elseif ($test_nbr != 0) {
        return("Le nom n'est pas correct il contient un nombre");
    }
    elseif($test_special != 0) {
        return("Votre nom ne doit pas contenir de caractère spéciaux");
	}
    else {
        return (true);
    }
}
// Fonction pour verif l'adresse mail
function verif_mail($mail) {

	if ($mail == "") {
		return("Saisissez une adresse mail");
	}
    elseif (!filter_var($mail,FILTER_VALIDATE_EMAIL)) {
        return("L'adresse mail n'est pas correcte");
	}
    else {
        return (true);
    }
}

function traitement_bdd() {
	$bdd_mail = array();
	$file = fopen("BDD.csv", "r");
	while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
		$bdd_mail[$data[3]] = $data;
	}
	fclose($file);
	return ($bdd_mail);
}
// Function pour verif le fichier photo
function delete($mail){
	$bdd = traitement_bdd();
	unset($bdd[$mail]);
	$fp = fopen("BDD.csv","w");
	foreach($bdd as $newbdd){
		fwrite($fp,implode(";",$newbdd).PHP_EOL);
	}
}

function bddadd($personne) {
	if (!$file = fopen("BDD.csv","a+"))
	{
		die("Problème d'ouverture du fichier");
	}

	if (!fwrite($file,$personne))
	{
		die("Le fichier n'a pas été ouvert avec les droits d'écriture");
	}

	fclose($file) or die("Erreur fclose");
}

function recup_csv() {
	if (!$file = fopen("BDD.csv","a+"))
	{
		return(false);
	}
	$contents = fread($file, filesize("BDD.csv"));
	fclose($file);
	return ($contents);
}

function verif_user($mail){
	$bdd = traitement_bdd();
		if (array_key_exists($mail, $bdd)) {
			return 'Ce mail est déjà utilisé';
		}
		return true;
}

function verif_password($mdp) {
	$test_special = 0;
	$tab_special = array("*","/","?","!");
	for ($i = 0; $i < count($tab_special); $i++){
		if (strpos($mdp, $tab_special[$i]) !== false){
			$test_special = 1;
		}
	}
	if ($mdp == "") {
		return("Saisissez un mot de passe");
	}
	elseif(strlen($mdp) < 8){
		return("Mot de passe trop court");
	}
	elseif(ctype_alpha($mdp)){
		return("Votre mot de passe doit contenir au moins un chiffre");
	}
	elseif(ctype_digit($mdp)){
		return("Votre mot de passe doit contenir au moins une lettre");
	}
	elseif($test_special == 0){
		return("Votre mot de passe doit contenir au moins un des caractères suivant *, /, ?, !");
	}
	elseif(strtolower($mdp) == $mdp){
		return("Votre mot de passe doit contenir au moins une majuscule");
	}
	elseif(strtoupper($mdp) == $mdp){
		return("Votre mot de passe doit contenir au moins une minuscules");
	} else {
		return true;
	}
}

function verif_photo($nom) {
	if ($_FILES["photo"] != "" && isset($nom)) {
		$content_dir = 'images/'; // dossier où sera déplacé le fichier image

		$tmp_file = $_FILES['photo']['tmp_name'];//*tmp_file est un fichier qui contient la photo qui sera utiliser pour déplacer l'image//

		if ($_FILES['photo']['error'] == 1) {
		   return("Le fichier est trop lourd");
		}

		if( !is_uploaded_file($tmp_file) )
		{
		   return("Le fichier est introuvable");
		}

		// on vérifie maintenant l'extension
		$extensionfichier = $_FILES['photo']['type'];
    	$extensionjpg = substr($extensionfichier,-4);
		$extensionjpeg = substr($extensionfichier,-5);

		if($extensionjpg != "/jpg" && $extensionjpeg != "/jpeg"){
			return("L'image doit être au format jpg");
		}
		// if( !strstr($type_file, 'jpg') &&  !strstr($type_file, 'jpeg') ) // verifier que la photo est .jpg
		// {
		//    return("Le fichier n'est pas un .jpg");
		// }

		// on copie le fichier dans le dossier de destination
		$image = "photo-".strtolower($nom).".jpg";//nom du fichier//

		if( !move_uploaded_file($tmp_file, $content_dir . $image) ) //move_upload_file deplace le fichier temporaire dans notre dossier upload(fichier qui heberge les images)//
		{
			return("Impossible de copier le dossier dans ".$content_dir);
		}
		else {
			move_uploaded_file($tmp_file, $content_dir . $image);
			return (true);
		}
	}
}

function verif_nomfichier($fichier) {
	$test_special = 0;
	$tab_special = array("*","/","?","!","@","#","%",".");
	for ($i = 0; $i < count($tab_special); $i++){
		if (strpos($fichier, $tab_special[$i]) !== false){
			$test_special = 1;
		}
	}

	$fichier = str_replace('ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy', $fichier);
	if ($fichier == "") {
		return("Saisissez un nom de fichier");
	}
	elseif(file_exists("./page/".$fichier)) {
        return("Un fichier avec ce nom existe déjà");
	}
    elseif($test_special != 0) {
        return("Votre nom de fichier ne doit pas contenir de caractères spéciaux");
	}
	elseif(strpos(" ", $fichier) === true) {
        return("Votre nom de fichier ne doit pas contenir d'espace");
	}
    else {
        return (true);
    }
}

function creer_fichier($fichier, $contenu) {
	if (!$file = fopen($fichier,"w")) {
		echo("Problème d'ouverture du fichier");
	}

	if (!fwrite($file,$contenu)) {
		die("Le fichier n'a pas été ouvert avec les droits d'écriture");
	}

	fclose($file) or die("Erreur fclose");
}