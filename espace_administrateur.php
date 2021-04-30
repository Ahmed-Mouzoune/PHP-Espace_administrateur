<?php
session_start();
include("./includes/function.php");

// Contrôle

if (!isset($_SESSION["login"]))
{
	header("location:connexion.php?acces=interdit");
}
$titre = "Espace_administrateur";
include(PATH_COMPONENT."header.php");
?>
<div class="columns is-multiline">
    <!-- Header -->
    <?php include(PATH_COMPONENT."entete.php"); ?>
    <!-- Aside -->
    <?php include(PATH_COMPONENT."aside.php"); ?>
	<!-- Tableau -->
	<div class="column colormain">
		<div class="container">
			<table class="table">
				<tbody>
					<?php
						$bdd = traitement_bdd();
						foreach ($bdd as $item) {
							echo ("<tr>\n");
								echo ("<td is-vcentered>");
									echo "<img src=\"./images/" . $item[5] ."\" alt=\"Photo de ".$item[2]." ".$item[1]."\"  class=\"image is-64x64\" >\n";
								echo ("</td>\n");
								echo ("<td class = \"is-vcentered\">\n");
									echo $item[1] . " " . $item[2] ; 
								echo ("</td>\n");
								if($_SESSION["login"] == "admin@eemi.com") {
									echo ("<td class=\"is-vcentered\">\n");
										// echo "<div class=\"button is-danger\">\n";												
										// 	echo "<button class=\"delete is-large\">\n";
										echo "<span class=\"file-icon has-text-danger\">\n";
										echo "<a href=\"delete.php?mail=".urlencode($item[3])."\" class=\"button test is-danger\"><i class=\"fa fa-trash iconTrash\"></i></a>\n";
										echo "</span>\n";														
										// 	// echo "</button>\n";
										// echo "</div>\n";
									echo ("</td>\n");
								}                                                   
							echo ("</tr>\n");
						}                                                
					?>
				</tbody>
			</table>
		</div>
	</div>    
</div>
<?php include(PATH_COMPONENT."footer.php") ?>
