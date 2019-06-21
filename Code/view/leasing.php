<?php
/**
 * Created with Notepad++.
 * Author: 			Jonas.HAUTIER
 * Date: 			27.05.2019
 * Last Update :    Jonas.HAUTIER
 *					27.05.2019 - creation du fichier et update de l'entete
 *					03.06.2019 - ajout du tableau de location
 *					04.06.2019 - fini... a verifier sur l instance
 *					07.06.2019 - corrections d'indentation
 *							   - correction d un bug d affichage
 */

$title = 'Rent A Snow - Vos locations';

ob_start();
?>
	<!-- title -->
	<h2>Vos Locations</h2>
	<article>

		<!-- intro text -->
		<div>
			<p>Votre demande de location a été enregistrée.</p></br>
			<p>Si vous souhaitez visualiser votre commande, cliquez sur le logo <a href="">PDF</a></p>
		</div>

		<!-- leasing table -->
		<form>
			<table class="table">
				<tr>
        	<th>N° de location</th>
					<th>Code</th>
					<th>Marque</th>
					<th>Modèle</th>
					<th>Prix</th>
					<th>Quantité</th>
					<th>Date début de location</th>
				</tr>
				<?php foreach	($leasing as $leasRow) : ?>
					<tr>
						<td><?= $leasRow['IDLoc']; ?></td>
						<td><?= $leasRow['snowCode']; ?></td>
						<td><?= $leasRow['snowBrand']; ?></td>
						<td><?= $leasRow['snowModel']; ?></td>
						<td><?= $leasRow['dailyPrice']; ?></td>
						<td><?= $leasRow['qtyLoc']; ?></td>
						<td><?= $leasRow['dateLoc']; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</form>
	</article>

<?php
$content = ob_get_clean();
require 'gabarit.php';
?>
