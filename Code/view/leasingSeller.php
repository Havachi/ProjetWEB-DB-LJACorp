<?php
/**
 * Created with Notepad++.
 * Author: 			Jonas.HAUTIER
 * Date: 			03.06.2019
 * Last Update :    Jonas.HAUTIER
 *					27.05.2019 - creation du fichier et de l'entete
 */

$title = 'Rent A Snow - Vos locations (vendeur)';

ob_start();
?>
	<!-- title -->
	<h2>Locations en cours</h2>
	<article>
		<!-- leasing table -->
		<form>
			<table class="table">
				<tr>
          <th>Location</th> <!-- id du snow + redirect to details -->
					<th>Client</th> <!-- email client -->
					<th>Début de location</th> <!-- date -->
					<th>Fin de location</th> <!-- date -->
					<th>Statut</th> <!-- En cours/Rendu partiel/Rendu -->
				</tr>
				<tr>
					<?php
					foreach	($leasing as $leasRow) : ?>
							<td><?= $leasRow['IDLoc']; ?></td>
							<td><?= $leasRow['']; ?></td>
							<td><?= $leasRow['']; ?></td>
							<td><?= $leasRow['']; ?></td>
							<td><?= $leasRow['dateLoc']; ?></td>
					<?php endforeach; ?>
				</tr>
			</table>
		</form>
	</article>

<?php
$content = ob_get_clean();
require 'gabarit.php';
?>
