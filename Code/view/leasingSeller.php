<?php
/**
 * Created with Notepad++.
 * Author: 			Jonas.HAUTIER
 * Date: 			03.06.2019
 * Last Update :    Jonas.HAUTIER
 *					03.06.2019 - creation du fichier et de l'entete
 *          		07.06.2019 - creation de l'IHM
 *					08.06.2019 - ajout de l'action //TODO
 *					14.06.2019 - ajout de l action DisplayALeasing avec le code de la location, a tester
 */

$title = 'Rent A Snow - Locations en cours';

ob_start();
?>
	<!-- title -->
	<h2>Locations en cours</h2>
	<article>

		<!-- leasing table -->
		<form>
			<table class="table">
				<tr>
          			<th>Location</th> <!-- id de la location + redirect to details -->
					<th>Client</th> <!-- email client -->
					<th>Début de location</th> <!-- date xx/xx/xxxx -->
					<th>Fin de location</th> <!-- date xx/xx/xxxx -->
					<th>Statut</th> <!-- En cours/Rendu partiel/Rendu -->
				</tr>
				<tr>
					<?php
					foreach	($leasing as $leasRow) : ?>
						<!-- TODO: check IDLoc is working -->
					    <td><a href="index.php?action='DisplayALeasing'&&code="<?=.$leasRow['IDLoc']?>"><?= $leasRow['IDLoc']; ?></a></td>
						<td><?= $leasRow['userEmail']; ?></td>
						<td><?= $leasRow['dateLoc']; ?></td>
						<td><?= $leasRow['dateEndLoc']; ?></td>
						<td><?= $leasRow['statusLoc']; ?></td>
					<?php endforeach; ?>
				</tr>
			</table>
		</form>
	</article>

<?php
$content = ob_get_clean();
require 'gabarit.php';
?>
