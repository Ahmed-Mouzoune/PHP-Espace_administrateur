<?php
session_start();
include("./includes/function.php");

if (!isset($_SESSION["login"]))
{
	header("location:connexion.php?acces=interdit");
}

// Traitement
if (!empty($_POST)) {
    foreach ($_POST as $cle => $valeur)
	{
        $$cle = $valeur;
    }
    // Correspond à
	
	/*
	$date = $_POST["date"];
	$nom = $_POST["nom"];
	$prenom = $_POST["prenom"];
	$mail = $_POST["mail"];
	$ville = $_POST["ville"];
	$newsletter = $_POST["newsletter"];
	$presentation = $_POST["presentation"];
	$cv = $_POST["cv"];
	$module = $_POST["module"];
	$loisir = $_POST["loisir"];
	$site = $_POST["site"];
	*/

        // civilite;nom;prenom;mail;mot de passe;photo
    if ($civilite == "") {
        $erreur = "Civilité obligatoire !";
    }

    if (verif_nom($nom) !== true) {
        $erreur = verif_nom($nom);
    }
    elseif (verif_prenom($prenom) !== true) {
        $erreur = verif_prenom($prenom);
    }

    elseif (verif_mail($mail) !== true) {
        $erreur = verif_mail($mail);
    }
    elseif (verif_password($password) !== true) {
        $erreur = verif_password($password);
    }
    elseif (verif_photo($nom) !== true) {
        $erreur = verif_photo($nom);
    }
    // elseif (verif_user($mail) !== true) {
    //     $erreur = verif_user($mail);
    //     echo"verif_user";
    // }

    else{
        echo "lastelse";
        $_SESSION["mail"] = $mail;

        $personne = "\n".$civilite.";".$nom.";".$prenom.";".$mail.";".$password.";photo-".$nom.".jpg";

        
        bddadd($personne); 
            // header("location:confirm_inscription.php");

    }
}
$titre = "CréaHtml";
$sizeform = "is-normal";
include(PATH_COMPONENT."header.php");
?>
<div class="columns is-multiline">
    <!-- Header -->
    <?php include(PATH_COMPONENT."entete.php"); ?>
    <!-- Aside -->
    <?php include(PATH_COMPONENT."aside.php"); ?>
    <!-- Formulaire -->
    <div class="column colormain">
        <div class="container">
            <form method="post" action="?" enctype="multipart/form-data">
                <!-- Nom -->
                <div class="field">
                    <label class="label <?php echo($sizeform) ?>">Nom</label>
                    <div class="control has-icons-left has-icons-right">
                        <?php
                            if(!empty($_POST)) {
                                if (verif_nom($nom) !== true) {
                                    $inputnom = "input is-danger";
                                }
                            }
                        ?>
                        <input class="input <?php echo($sizeform) ?> <?php echo($inputnom) ?>" type="text" name="nom" id="lastname"
                            placeholder="Votre nom">
                        <span class="icon is-small is-left">
                            <i class="fa fa-user"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fa fa-check"></i>
                        </span>
                    </div>
                    <?php
                        if(!empty($_POST)) {
                            if (verif_nom($nom) !== true) {
                                echo("<p class=\"help is-danger\">");
                                    echo(verif_nom($nom));
                                echo("</p>");
                            }
                        }
                    ?>
                </div>
                <!-- Prénom -->
                <div class="field">
                    <label class="label <?php echo($sizeform) ?>">Prénom</label>
                    <div class="control has-icons-left has-icons-right">
                        <?php
                            if(!empty($_POST)) {
                                if (verif_prenom($prenom) !== true) {
                                    $inputprenom = "input is-danger";
                                }
                            }
                        ?>
                        <input class="input <?php echo($sizeform) ?> <?php echo($inputprenom) ?>" type="text" name="prenom"
                            id="firstname" placeholder="Votre prénom">
                        <span class="icon is-small is-left">
                            <i class="fa fa-user"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fa fa-check"></i>
                        </span>
                    </div>
                    <?php
                        if(!empty($_POST)) {
                            if (verif_prenom($prenom) !== true) {
                                echo("<p class=\"help is-danger\">");
                                    echo(verif_prenom($prenom));
                                echo("</p>");
                            }
                        }
                    ?>
                </div>
                <!-- Adresse mail -->
                <div class="field">
                    <label class="label <?php echo($sizeform) ?>">E-mail</label>
                    <div class="control has-icons-left has-icons-right">
                        <?php
                            if(!empty($_POST)) {
                                if (verif_mail($mail) !== true) {
                                    $inputmail = "input is-danger";
                                }
                            }
                        ?>
                        <input class="input <?php echo($sizeform) ?> <?php echo($inputmail) ?>" type="email" name="mail" id="mail"
                            placeholder="exemple@gmail.com">
                        <span class="icon is-small is-left">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fa fa-check"></i>
                        </span>
                    </div>
                    <?php
                        if(!empty($_POST)) {
                            if (verif_mail($mail) !== true) {
                                echo("<p class=\"help is-danger\">");
                                    echo(verif_mail($mail));
                                echo("</p>");
                            }
                        }                           
                    ?>
                </div>
                <!-- Mot de passe -->
                <div class="field">
                    <label class="label <?php echo($sizeform) ?>">Mot de passe</label>
                    <div class="control has-icons-left has-icons-right">
                        <?php
                            if(!empty($_POST)) {
                                if (verif_password($password) !== true) {
                                    $inputpassword = "input is-danger";
                                }
                            }                                
                        ?>
                        <input class="input <?php echo($sizeform) ?> <?php echo($inputpassword)?>" type="password" name="password"
                            id="mot_de_passe" placeholder="Mot de passe contenant 8 caractères">
                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fa fa-check"></i>
                        </span>
                    </div>
                    <?php
                        if(!empty($_POST)) {
                            if (verif_password($password) !== true) {
                                echo("<p class=\"help is-danger\">");
                                    echo(verif_password($password));
                                echo("</p>");
                            }
                        }                       
                    ?>
                </div>
                <!-- Confirm mot de passe -->
                <div class="field">
                    <label class="label <?php echo($sizeform) ?>">Confirmer votre mot de passe</label>
                    <div class="control has-icons-left has-icons-right">
                        <?php
                            if(!empty($_POST)) {
                                if ($confirmpassword !== $password) {
                                    $inputconfirmpassword = "input is-danger";
                                }
                            }                                
                        ?>
                        <input class="input <?php echo($sizeform) ?> <?php echo($inputconfirmpassword)?>" type="password" name="confirmpassword"
                            id="confirm_mot_de_passe" placeholder="Mot de passe contenant 8 caractères">
                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fa fa-check"></i>
                        </span>
                    </div>
                    <?php
                        if(!empty($_POST)) {
                            if ($confirmpassword !== $password) {
                                echo("<p class=\"help is-danger\">");
                                    echo("Les deux mot de passe ne correspondent pas");
                                echo("</p>");
                            }
                        }                       
                    ?>
                </div>
                <!-- Civilité(Homme/Femme)  -->
                <div class="field">
                <label class="label <?php echo($sizeform) ?>">Civilité</label>
                    <div class="control">
                        <label class="radio">
                            <input type="radio" name="civilite" id="Homme" value="2" checked>
                            Homme
                        </label>
                        <label class="radio">
                            <input type="radio" name="civilite" id="Femme" value="1">
                            Femme
                        </label>
                    </div>
                </div>
                <!-- Photo (à télécharger)  -->
                <div class="field">
                    <div class="file is-boxed is-centered is-light">
                        <label class="file-label">
                            <?php
                                if(!empty($_POST)) {
                                    if (verif_photo($nom) !== true) {
                                        $inputphoto= "input is-danger";
                                    }
                                }                                
                            ?>
                            <input class="file-input <?php echo($sizeform) ?>" type="file" name="photo" id="photo">
                            <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fa fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    Votre photo
                                </span>
                            </span>
                        </label>
                    </div>
                    <?php
                        if(!empty($_POST)) {
                            if (verif_photo($nom) !== true) {
                                echo("<p class=\"help is-danger\" style=\"text-align: center;\">");
                                    echo(verif_photo($nom));
                                echo("</p>");
                            }
                        }                       
                    ?>
                </div>
                <!-- Bouton valider -->
                <div class="field">
                    <div class="buttons is-centered">
                        <input class="button is-success" type="submit" value="S'inscrire" >
                    </div>
                </div>
            </form>
        </div>
    </div> 
</div>

<?php include(PATH_COMPONENT."footer.php"); ?>