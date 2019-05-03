<?php
/**
 * Author   : nicolas.glassey@cpnv.ch
 * Project  : Epreuve_151
 * Created  : 09.04.2019 - 18:26
 *
 * Last update :    [01.12.2018 author]
 *                  [add $logName in function setFullPath]
 * Git source  :    [link]
 */

$title="Nos cours";

ob_start();
?>
    <article>
            <h2> Nos Cours</h2>
            <div class="table-responsive">
                <table class="table textcolor">
                    <tr>
                        <th>Module</th><th>Description</th><th>Animateur</th><th>Début</th><th>Fin</th>
                    </tr>
                    <?php
                    foreach ($coursesResults as $result) : ?>
                        <tr>
                            <td><?= $result['shortName']; ?></td>
                            <td><?= $result['description']; ?></td>
                            <td><?= $result['teacher']; ?></td>
                            <td><?= $result['startDate']; ?></td>
                            <td><?= $result['endDate']; ?></td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
    </article>
    <hr/>
<?php
$content = ob_get_clean();
require 'gabarit.php';
?>