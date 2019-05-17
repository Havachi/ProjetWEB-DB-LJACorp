<?php
/**
 * This php file is designed to allow users to ask for a snow's rent
 * Author   : pascal.benzonana@cpnv.ch
 * Project  : Code
 * Created  : 22.03.2019 - 18:40
 *
 * Last update :    [24.03.2019 PBA]
 *                  [add Code selected in Get]
 * Source       :   pascal.benzonana
 */


$title = 'Rent A Snow - Demande de location';

ob_start();
?>
    <h2>Demande de location</h2>
    <article>
        <?php if (isset($_GET["qty"])) {
            echo "<div class='alert-box error'><span>erreur: </span>Quantité trop élevée ou inférieure à 1, vérifiez la disponibilité du stock</div>";
        }
        ?>
        <h4>Votre choix</h4>
        <table class="table">
            <tr>
                <th>Code</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Longueur</th>
                <th>Prix</th>
                <th>En stock</th>
            </tr>
            <tr>
                <?php
                foreach ($snowsResults as $result) : ?>
                    <td><?= $result['code']; ?></td>
                    <td><?= $result['brand']; ?></td>
                    <td><?= $result['model']; ?></td>
                    <td><?= $result['snowLength']; ?> cm</td>
                    <td>CHF <?= $result['dailyPrice']; ?>.- par jour</td> <!-- Prices are not float -->
                    <td><?= $result['qtyAvailable']; ?></td>
                <?php endforeach; ?>
            </tr>
        </table>
        <br/>
        <h4>Votre demande</h4>
        <form class="form" method="POST" action="index.php?action=updateCartRequest&code=<?= $result['code']; ?>">

            <table class="table">
                <tr>
                    <td>Quantité :</td>
                    <td><input type="number" placeholder="Entrez la quantité" name="inputQuantity" required value=""
                               required>
                    <td>
                </tr>
                <tr>
                    <td>Nombre de jours :</td>
                    <td><input type="number" placeholder="Entrez le nombre de jours" name="inputDays" value=""
                               required/></td>
                </tr>
                <tr>
                    <td><input class="btn" type="submit" value="Mettre dans le panier"/></td>
                    <td><input type="reset" class="btn" value="Effacer"/>
                    </td>
                </tr>
            </table>
        </form>
    </article>
<?php
$content = ob_get_clean();
require 'gabarit.php';
?>