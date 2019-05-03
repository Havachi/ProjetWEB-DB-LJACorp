<?php
/**
 * Author   : nicolas.glassey@cpnv.ch
 * Project  : Epreuve_151
 * Created  : 09.04.2019 - 13:45
 *
 * Last update :    [01.12.2018 author]
 *                  [add $logName in function setFullPath]
 * Git source  :    [link]
 */

ob_start();
$title="Accueil";
?>
    <div id="banner-wrapper">
        <div id="banner" class="container">
            <div class="boxA">
                <h3>Des cours privés</h3>
                <p>Besoin d'une aide à la maison personnalisée pour remonter mes notes (10.-/heure)</p>
            </div>
            <div class="boxB">
                <h3>Transmettre et aider</h3>
                <p>Aider un étudiant et gagner un peu d'argent. Niveau maturité 3<sup>ème</sup> année requis</p>
            </div>
            <div class="boxC">
                <h3>Troquer ses connaissances</h3>
                <p>Echanger des cours de maths contre des cours d'anglais sans débourser un centime</p>
            </div>
        </div>
    </div>
<?php
$content = ob_get_clean();
require "gabarit.php";