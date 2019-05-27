<?php
/**
 * Created by PhpStorm.
 * Author: 			Pascal.BENZONANA 
 * Date: 			28.11.2016
 * Last Update:		Nicolas.GLASSEY
 *                  31.01.2019 - html5 integration (div vs table, specific users's inputs)
 *                             - login process simplification(type of user is not more asked)
 *                  11.03.2019 - docs rewrote in english
 *					Jonas.HAUTIER
 *					27.05.2019 - Uniformisation des entetes
 *							   - Mise à jour du titre
 */

$title ='Rent A Snow - Login';
 
ob_start();
?>
<h2>Se connecter</h2>
<?php if (@$_GET['loginError'] == true) :?>
    <h5><span style="color:red">Login refusé</span></h5>
<?php endif ?>
<article>
      <form class='form' method='POST' action="index.php?action=login">
          <div class="container">
              <label for="userEmail"><b>Username</b></label>
              <input type="email" placeholder="Enter your email address" name="inputUserEmailAddress" required>

              <label for="userPsw"><b>Password</b></label>
              <input type="password" placeholder="Enter your password" name="inputUserPsw" required>
          </div>
          <div class="container">
              <button type="submit" class="btn btn-default">Login</button>
              <button type="reset" class="btn btn-default">Reset</button>
              <span class="psw"><a href="">Mot de passe oublié ?</a></span>
          </div>
      </form>
    <div class="container signin">
        <p>Besoin d'un compte <a href="index.php?action=register">Register</a>.</p>
    </div>
</article>
<?php 
  $content = ob_get_clean();
  require 'gabarit.php';
?>