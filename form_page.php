<?php
session_start();
include("./includes/function.php");

if (!isset($_SESSION["login"]))
{
	header("location:connexion.php?acces=interdit");
}

if (!empty($_POST)) {
    foreach ($_POST as $cle => $valeur)
	{
        $$cle = $valeur;
    }
    $erreur = "";
    if (verif_nomfichier($nomfichier) !== true) {
        $erreur = verif_nomfichier($nomfichier);
    }
    if (verif_nomfichier($titrefichier) !== true) {
        $erreur = verif_nomfichier($nomfichier);
    }
    if ($description == ""){
        $erreur = "Saisissez une description";
    }
    if ($html == "") {
        $erreur = "Saisissez du ";
    }

    if ($erreur === "") {
        $contenu = "<!DOCTYPE html>\n";
        $contenu .= "<html>\n";
        $contenu .= "<head>\n";
        $contenu .= "<title>".$nomfichier."</title>\n";
        $contenu .= "<meta name=\"description\" content=\"".$description."\"  />\n";
        $contenu .= "<meta charset=\"utf-8\" />\n";
        $contenu .= "</head>\n";
        $contenu .= "<body>\n";
        $contenu .= "<h1>".$h1."</h1>\n";
        $contenu .= "<main>\n";
        $contenu .= $html;
        $contenu .= "</main>\n";
        $contenu .= "</body>\n";
        $contenu .= "</html>";
        creer_fichier("./page/". $titrefichier.".html",$contenu);
        header("location:./page/".$titrefichier.".html"); // TODO : &&
    }
}
$titre = "CréaHtml";
include(PATH_COMPONENT."header.php");
?>

<div class="columns is-multiline">
    <!-- Header -->
    <?php include(PATH_COMPONENT."entete.php"); ?>
    <!-- Aside -->
    <?php include(PATH_COMPONENT."aside.php"); ?>
    <!-- Formulaire -->
    <div class="column colormain">
        <form method="POST" action="?">
            <!-- nom du fichier -->
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label for="nom" class="label">Nom du fichier</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <?php
                                if(!empty($_POST)) {
                                    if (verif_nom($nomfichier) !== true) {
                                        $inputnomfichier = "input is-danger";
                                    }
                                }
                            ?>
                            <input class="input <?php echo($inputnomfichier) ?>" type="text" name="nomfichier" id="nomfichier" placeholder="exemple : index.html (le nom qui se trouve dans l'onglet)">
                        </div>
                    </div>
                </div>
            </div>
            <!-- msg erreur fichier -->
            <?php
                if(!empty($_POST)) {
                    if (verif_nom($nomfichier) !== true) {
                        echo("<p class=\"help is-danger has-text-centered\">");
                            echo(verif_nom($nomfichier));
                        echo("</p>");
                    }
                }
            ?>
            <!-- titre du fichier -->
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label for="titre" class="label">Titre du fichier</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <?php
                                if(!empty($_POST)) {
                                    if ($titrefichier === "") {
                                        $inputtitrefichier = "input is-danger";
                                    }
                                }
                            ?>
                            <input class="input <?php echo($inputtitrefichier) ?>" type="text" name="titrefichier" id="titrefichier" placeholder="Votre titre (nom qui sera sauvegardé)">
                        </div>
                    </div>
                </div>
            </div>
            <!-- msg erreur titrefichier -->
            <?php
                if(!empty($_POST)) {
                    if ($titrefichier === "") {
                        echo("<p class=\"help is-danger has-text-centered\">");
                            echo("Saisissez un titre");
                        echo("</p>");
                    }
                }
            ?>
            <!-- description -->
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label for="description" class="label">Description</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <?php
                                if(!empty($_POST)) {
                                    if ($description === "") {
                                        $inputdescription = "input is-danger";
                                    }
                                }
                            ?>
                            <input class="input <?php echo($inputdescription) ?>" type="text" name="description" id="description" placeholder="Votre description">
                        </div>
                    </div>
                </div>
            </div>
            <!-- msg erreur description -->
            <?php
                if(!empty($_POST)) {
                    if ($description === "") {
                        echo("<p class=\"help is-danger has-text-centered\">");
                            echo("Saisissez une description");
                        echo("</p>");
                    }
                }
            ?>
            <!-- h1 -->
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label for="titre" class="label">Titre</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <?php
                                if(!empty($_POST)) {
                                    if ($h1 === "") {
                                        $inputh1 = "input is-danger";
                                    }
                                }
                            ?>
                            <input class="input <?php echo($inputh1) ?>" type="text" name="h1" id="h1" placeholder="Votre titre h1">
                        </div>
                    </div>
                </div>
            </div>
            <!-- msg erreur h1 -->
            <?php
                if(!empty($_POST)) {
                    if ($h1 === "") {
                        echo("<p class=\"help is-danger has-text-centered\">");
                            echo("Saisissez un titre");
                        echo("</p>");
                    }
                }
            ?>
            <!-- Main -->
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label for="titre" class="label">Main</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <textarea class="textarea" name="html" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- msg erreur main -->
            <?php
                if(!empty($_POST)) {
                    if ($html === "") {
                        echo("<p class=\"help is-danger has-text-centered\">");
                            echo("Votre main est vide");
                        echo("</p>");
                    }
                }
            ?>
            <!-- Bouton valider -->
            <div class="field">
                <div class="buttons is-centered">
                    <input class="button is-success" type="submit" value="Générez la page !" name="generer">
                </div>
            </div>
        </form>
    </div>
</div>
<?php include(PATH_COMPONENT."footer.php") ?>