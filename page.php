<?php 

session_start();
include("./includes/function.php");

if (!isset($_SESSION["login"]))
{
	header("location:connexion.php?acces=interdit");
}
$titre = "page";
include(PATH_COMPONENT."header.php");

?>

<div class="columns is-multiline">
    <!-- Header -->
    <?php include(PATH_COMPONENT."entete.php"); ?>
    <!-- Aside -->
    <?php include(PATH_COMPONENT."aside.php"); ?>
    <div class="column colormain">
		<div class="container">
			<table class="table">
				<tbody>
					<?php
						$pages = "./page/";
						foreach ($pages as $page) {
							echo ("<tr>\n");
								echo ("<td is-vcentered>");
									echo "<a href=\"$page\">$titrefichier</a>\n";
								echo ("</td>\n");                            
							echo ("</tr>\n");
						}                                                
					?>
				</tbody>
			</table>
		</div>
	</div>    
</div>