<?php
/**
 * Created by PhpStorm.
 * Author:			Pascal.BENZONANA 
 * Date: 			23.03.2019
 * Last Update :    Jonas.HAUTIER
 *					27.05.2019 - Modification de l'entete et du title.
 */
 
$title = 'Rent A Snow - Panier';

ob_start();
?>
    <h2>Votre panier</h2>
    <article>
        <form method="POST" action="index.php?action=displaySnows">
            <table class="table">
                <tr>
                    <th>Code</th><th>Date</th><th>Quantité</th><th>Nombre de jours</th><th>Retirer</th>
                </tr>
                <?php
                // Displays cart session's content
                for ($i=0; $i < count($_SESSION['cart']); $i++)
                {
                    echo "<tr>";
                    echo "<td>".$_SESSION['cart'][$i]['code']."</td>";
                    echo "<td>".$_SESSION['cart'][$i]['dateD']."</td>";

                    if ((isset($_SESSION['line'])) &&(@$_SESSION['line']==$i))
                    {
                        echo "<form method='POST' action='index.php?action=updCart'>";
                        echo "<td><input type='number' name='uQty' value='".$_SESSION['cart'][$i]['qty']."'></td>";
                        echo "<td><input type='number' name='uNbD' value='".$_SESSION['cart'][$i]['nbD']."'></td>";
                    }
                    else
                    {
                        echo "<td>".$_SESSION['cart'][$i]['qty']."</td>";
                        echo "<td>".$_SESSION['cart'][$i]['nbD']."</td>";
                    }

                    echo "<td><a href='index.php?action=deleteCartRequest&line=".$i."'><img src='view/content/images/delete2.png'></a>";
                    if ((isset($_SESSION['line'])) &&(@$_SESSION['line']==$i))
                        echo "<input type='submit' src='view/content/images/edit2.png'></td>";
                    else
                        echo "<a href='index.php?action=updateCartRequest&line=".$i."'><img src='view/content/images/edit2.png'></td>";
                    echo "</form></tr>";
                }
                ?>
            </table>
            <input type="submit" value="Louer encore" class="btn btn-success" name="backToCatalog">
            <input type="submit" value="Vider le panier" class="btn btn-cancel" name="resetCart">
        </form>
    </article>
<?php
$content = ob_get_clean();
require 'gabarit.php';
?>