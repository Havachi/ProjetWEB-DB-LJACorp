<?php
/**
 * This php file is designed to manage all operation regarding rent management
 * Author   : louis.richard@cpnv.ch
 * Project  : Projet WEB + BDD
 * Created  : 24.05.2019 - 09:00
 *
 * Last update :    24.05.2019 LRD
 *                  ---
 * Source       :   https://github.com/Havachi/ProjetWEB-DB-LJACorp
 */


/**
 *This function is designed to get all snows that are currently in the user's cart to ask for it
 * @param -
 */
function locationRequest(){
    if(isset($_SESSION['cart'])){
        if(isset($_SESSION['userType'])){
            require_once "model/cartManager.php";
            createLocation($_SESSION['cart'], $_SESSION['userEmailAddress']);

            require "view/location.php";
        }
        $_GET["notlog"] = true;
        require "view/login.php";
    }
    $_GET["cartEmpty"] = true;
}

/**
 * This function is designed to redirect the user to his/her snows locations
 * @param -
 */
function myLocation(){
    require "view/location.php";
}
