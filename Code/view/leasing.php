<?php
/**
 * Created with Notepad++.
 * Author: 			Jonas.HAUTIER
 * Date: 			27.05.2019
 * Last Update :    Jonas.HAUTIER
 *					27.05.2019 - creation du fichier et update de l'entete
 */

$title = 'Rent A Snow - Vos locations';

ob_start();
?>
	<h2>Vos Locations</h2>
	
	
<?php
$content = ob_get_clean();
require 'gabarit.php';
?>