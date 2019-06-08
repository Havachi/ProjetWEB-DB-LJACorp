<?php
/**
 * Created with Atom.
 * Author:			Jonas.HAUTIER
 * Date:			07.06.2019
 * Last Update :	Jonas.HAUTIER
 *					07.06.2019 - creation de l'entete et du fichier
 *					08.06.2019 - creation la structure du fichier (zones)
 */

$title = 'Rent A Snow - Gestion des retours';

ob_start();
?>
	<!-- title -->
	<h2>Gestion des retours</h2>
	<article>

		<!-- summary -->
        <form>
            //location
            //email
            //prise
            //retour
            //statut

		    <!-- table -->
			<table class="table">
			    <tr>
          			<th>Code</th>
          			<th>Quantité</th>
          			<th>Date retour</th>
          			<th>Status</th>
				</tr>
				<tr>
					<?php
					foreach	($snow as $tabRow) : ?>
						<td><?= $tabRow['']; ?></td> //code
						<td><?= $tabRow['']; ?></td> //quantite
						<td><?= $tabRow['']; ?></td> //date retour
						<td><?= $tabRow['']; ?></td> //statut + dropdown list
					<?php endforeach; ?>
				</tr>
			</table>

            <!-- buttons -->
            //vue d ensemble
            //save modifs
		</form>
	</article>

<?php
$content = ob_get_clean();
require 'gabarit.php';
?>
