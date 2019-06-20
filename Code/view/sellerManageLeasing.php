<?php
/**
 * Created with Atom.
 * Author:			Jonas.HAUTIER
 * Date:			07.06.2019
 * Last Update :	Jonas.HAUTIER
 *					07.06.2019 - creation de l'entete et du fichier
 *					08.06.2019 - creation la structure du fichier (zones)
 *					14.06.2019 - ajout des boutons de retour et d'envoi des modifications
 *					17.06.2019 - ajout de l action pour d'une action pour le formulaire
 *							   - bouton retour mis en place
 */

$title = 'Rent A Snow - Gestion des retours';

ob_start();
?>
	<!-- title -->
	<h2>Gestion des retours</h2>
	<article>

		<!-- summary -->
        <form class="form" method="post" action="index.php?action=//TODO">
			<p>Location : <?= $leasRow['IDLoc']?>&emsp;&emsp;Email : <?= $leasRow['userEmail']?></p>
			<p>Prise : <?= $leasRow['dateLoc']?>&emsp;&emsp;Retour : <?= $leasRow['dateEndLoc']?></p>
			<p>Status : <?= $leasRow['statusLoc']?></p>

		    <!-- table -->
			<table class="table">
			    <tr>
					<!-- headers -->
          			<th>Code</th>
          			<th>Quantité</th>
          			<th>Date retour</th>
          			<th>Status</th>
				</tr>
				<!-- datas -->
				<?php
				foreach	($snowLoc as $LocRow) : ?>
				<tr>
					<td><?= $locRow['']; ?></td> //code
					<td><?= $locRow['']; ?></td> //quantite
					<td><?= $locRow['']; ?></td> //date retour
					<td>
						<?= $locRow['']; ?> //status dropdown list
						<select>
							<!-- case "rendu" -->
							<?php if(($locRow['OrderStatus']) == 0) :?>
								<option default value="Rendu">Rendu</option>
								<option value="En cours">En cours</option>
							<!-- case "en cours" -->
                            <?php else :?>
								<option value="Rendu">Rendu</option>
								<option default value="En cours">En cours</option>
                            <?php endif; ?>
						</select>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>

            <!-- button return -->
        	<a href="action=index.php?action=myLocation">
				<button type="button" class="btn btn-default">Retour à la vue d'ensemble</button>
			</a>
			<!-- button save modif -->
        	<button type="submit" class="btn btn-default">Enregistrer les modifications</button>
		</form>
	</article>

<?php
$content = ob_get_clean();
require 'gabarit.php';
?>
