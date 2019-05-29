<?php
/**
 * Created by PhpStorm.
 * Author:			Nicolas.GLASSEY
 * Date:			12.03.2019
 * Last Update:		Nicolas.GLASSEY
 *					31.01.2019 - nicolas.glassey@cpnv.ch
 *					Jonas.HAUTIER
 *					27.05.2019 - Modification de l'entete et du title.
 */
 
$title ='Rent A Snow - Register';

ob_start();
?>
    <h1>S'inscrire</h1>
    <?php if (@$_GET['registerError'] == true) :?>
    <h5><span style="color:red">Inscription refusée</span></h5>
    <?php endif ?>
    <article>
        <form class='form' method='POST' action="index.php?action=register">

            <p>Pour vous inscrire chez Snows, nous vous prions de renseigner les champs suivants:</p>
            <div class="container">
                <label for="userEmail"><b>Username</b></label>
                <input type="email" placeholder="Enter your email address" name="inputUserEmailAddress" required>

                <label for="userPsw"><b>Password</b></label>
                <input type="password" placeholder="Enter your password" name="inputUserPsw" required>

                <label for="psw-repeat"><b>Repeat Password</b></label>
                <input type="password" placeholder="Repeat your password" name="inputUserPswRepeat" required>

                <p>En soumettant votre demande de compte, vous validez les conditions générales d'utilisation. <a href="https://termsfeed.com/blog/privacy-policies-vs-terms-conditions/">CGU et vie privée</a>.</p>
                <button type="submit" class="btn btn-default">Register</button>
            </div>
        </form>
        <div class="container signin">
            <p>Déjà membre ? <a href="index.php?action=login">Login</a>.</p>
        </div>
    </article>
<?php 
  $content = ob_get_clean();
  require 'gabarit.php';
?>