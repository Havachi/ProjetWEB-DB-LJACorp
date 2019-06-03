<?php
/**
 * Created with Notepad++.
 * Author: 			Jonas.HAUTIER
 * Date: 			27.05.2019
 * Last Update :    Jonas.HAUTIER
 *					27.05.2019 - creation du fichier et update de l'entete
 *					03.06.2019 - ajout du tableau de location
 */

$title = 'Rent A Snow - Vos locations';

ob_start();
?>
	<h2>Vos Locations</h2>
	<article>
		<!-- intro text -->
		<div>
			<p>Votre demande de location a été enregistrée.</p></br>
			<p>Si vous souhaitez visualiser votre commande, cliquez sur le logo <a href="">PDF</a></p>
		</div>
		
		<!-- leasing table -->
		<form method="POST" action="">
			<table class="table">
			
			</table>
		</form>
	</article>
	
<?php
$content = ob_get_clean();
require 'gabarit.php';
?>