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



<?php
$content = ob_get_clean();
require 'gabarit.php';
?>