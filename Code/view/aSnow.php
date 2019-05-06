<?php
/**
 * This php file is designed to show snow's details
 * Author : Pascal.BENZONANA
 * Project : ASnow
 * Created: 26.02.2019 - 8:04
 * Time: 15:00
 */

$title="";
// Tampon de flux stocké en mémoire
ob_start();
?>

<article>
    <header>
        <?php
        foreach ($snowsResults as $result) : ?>

            <h2><?= $result['code']; ?></h2>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#details" data-toggle="tab">Détails du snow</a></li>
                <li><a href="#photo" data-toggle="tab">Photo</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="details">
                    <div class="span12"><h4><strong><?= $result['brand']; ?> - <?= $result['model']; ?></strong></h4></div>
                    <div class="span3">Longueur : </div><div class="span6 text-info"><?= $result['snowLength']; ?> cm</div>
                    <div class="span3">Prix : </div><div class="span6 text-info"><strong>CHF <?= $result['dailyPrice']; ?> .-</strong></div>
                    <div class="span3">Disponibilité : </div><div class="span6"><?= $result['qtyAvailable']; ?></div>
                    <div class="span3">Description : </div><div class="span8"><?= $result['description']; ?></div>
                </div>
                <div class="tab-pane fade" id="photo">
                <div class="thumbnail"><p><img src='view/content/images/<?=$result['code']; ?>.jpg' style="width:50%"></p></div>
                </div>
            </div>
            <br>

        <?php endforeach ?>
    </header>
</article>
<hr/>

<?php
$content = ob_get_clean();
require 'gabarit.php';
?>

