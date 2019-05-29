<?php
/**
 * Created by PhpStorm.
 * Author:			Pascal.BENZONANA
 * Date:			04.03.2019
 * Last Update :    Pascal.BENZONANA
 *					18.02.2019 - modele.php splitted
 *					Jonas.HAUTIER
 *					27.05.2019 - Modification de l'entete et du title.
 */
 
$title="Rent A Snow - Nos snows";

ob_start();
$rows=0; // Column count
?>

<article>
    <header>
        <h2> Nos snows</h2>
        <div class="yox-view">

            <?php foreach ($snowsResults as $result) : ?>
                <?php $rows++; ?>
                <?php if ($rows%4) : // tests to have 4 items / line ?>
                    <div class="row-fluid">
                    <ul class="thumbnails">
                    <?php $rows=0;?>
                <?php endif ?>

                <li class="span3">
                    <div class="thumbnail">
                    <a href="view/content/images/<?= $result['code']; ?>.jpg" target="blank"><img src="<?= $result['photo']; ?>" alt="<?= $result['code']; ?>" ></a>
                        <div class="caption">
                            <h3><a href="index.php?action=displayASnow&code=<?= $result['code']; ?>"><?= $result['code']; ?></a></h3>
                            <p><strong>Marque : </strong><?= $result['brand']; ?></p>
                            <p><strong>Modèle : </strong><?= $result['model']; ?></p>
                            <p><strong>Longueur : </strong><?= $result['snowLength']; ?> cm</p>
                            <p><strong>Prix :</strong> CHF <?= $result['dailyPrice']; ?>.- / jour</p>
                            <p><strong>Disponibilité : </strong><?= $result['qtyAvailable']; ?></p>
                            <?php if ($result['active']) :?>
                                <p><a href="index.php?action=snowLeasingRequest&code=<?= $result['code']; ?>" class="btn btn-primary">Louer ce snow</a></p>
                            <?php else : ?>
                                <p><a class="btn btn-danger" disabled="disabled">Plus en location</a></p>
                            <?php endif ?>
                        </div>
                    </div>
                </li>

                <?php if ($rows%4) :?>
                    </ul>
                    </div>
                <?php endif ?>
            <?php endforeach ?>

        </div>
    </header>
</article>
<hr/>

<?php
$content = ob_get_clean();
require 'gabarit.php';
?>