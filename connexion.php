<?php
session_start();
include("./includes/function.php");

if (!empty($_POST)) {
    // Récupération des valeurs
    
    $mail = $_POST["mail"];
    $password = $_POST["motdepasse"];

    // if ($mail == "" || $password == "") {
    //     $erreur = "Veuillez entrer votre mail et mot de passe";
    // }
    $success = false ;
    $bdd = traitement_bdd();
    if (array_key_exists($mail, $bdd)) {
        if($bdd[$mail][4] == $password) {
            $success = true;
            $_SESSION["login"] = $mail;
            header("location:espace_administrateur.php");
        }
    }    
    //     else {
    //         $erreur_mdp = "Mot de passe incorrect";
    //     }
    // }
    // else {
    //     $erreur = "Mail inexistant";
    // }
    // // Pour que le tableau session puissent exister
}
$titre = "Connexion";

?>
<?php include(PATH_COMPONENT."header.php"); ?>
<div class="bodylogin">
    <?php
            if (isset($_GET["acces"])) {

                echo("<div class=\"notification is-centered is-danger\"><h1 class=\"title has-text-centered\">Merci de vous connecter pour accéder à cette page !</h1></div>");

            }
            elseif (isset($_GET["deconnexion"])) {
                session_destroy();
                session_start();
                echo("<div class=\"notification is-centered is-success\"><h1 class=\"title has-text-centered\">Déconnexion réussie !</h1></div>");

            }
        ?>


    <div class="container">
            <!-- Formulaire -->
        <section class="hero is-fullheight">
            <div class="hero-body has-text-centered">
                <div class="login">
                    <img src="./images/logo.png" alt="logoLogin" id="logoLogin"  />
                    <form method="post" action="?">
                        <!-- Adresse mail -->
                        <div class="field">
                            <div class="control has-icons-left">
                            <?php
                                
                                if(!empty($_POST)) {
                                    if (verif_mail($mail) !== true) {
                                        $inputmail = "input is-danger";
                                    }
                                }
                            ?>
                                <input class="input connexion is-medium is-rounded <?php echo($inputmail) ?>" type="email" name="mail" id="mail" placeholder="exemple@gmail.com" autocomplete="username" required />
                                <span class="icon is-small is-left">
                                    <i class="fa fa-envelope"></i>
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
                            <div class="control has-icons-left">
                                <?php
                                    if(!empty($_POST)) {
                                        if (verif_password($password) !== true) {
                                            $inputpassword = "input is-danger";
                                        }
                                    }
                                ?>
                                <input class="input connexion is-medium is-rounded <?php echo($inputmail) ?>" type="password" name="motdepasse" id="password" placeholder="********" required />
                                <span class="icon is-small is-left">
                                    <i class="fa fa-lock"></i>
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
                        <br />
                        <button class="button is-block is-fullwidth is-primary is-medium is-rounded" type="submit">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <?php include(PATH_COMPONENT."footer.php"); ?>
</div>