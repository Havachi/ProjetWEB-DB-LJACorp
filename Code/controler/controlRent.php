<?php
/**
 * This php file is designed to manage all operation regarding rent management
 * Author   : louis.richard@cpnv.ch
 * Project  : Projet WEB + BDD
 * Created  : 24.05.2019 - 09:00
 *
 * Last update :    07.06.2019 Louis Richard
 *                  Implemented Try Catch in function locationRequest
 * Source       :   https://github.com/Havachi/ProjetWEB-DB-LJACorp
 */


/**
 *This function is designed to get all snows that are currently in the user's cart to ask for it
 * @param -
 */
function locationRequest(){
    if(isset($_SESSION['cart'])){
        if(isset($_SESSION['userType'])){
            require_once "model/locationManager.php";
            try {
                createLeasing($_SESSION['cart'], $_SESSION['userEmailAddress']);
                $_SESSION['cart'] = array();
                $_GET['action'] = "myLocation";
                require "view/location.php";
            }
            catch(SiteUnderMaintenanceExeption $errormsg){
                require "view/home.php";
                die;
            }
        }
        $_GET["notlog"] = true;
        require "view/login.php";
    }
    $_GET["cartEmpty"] = true;
    require "view/home.php";
}

/**
 * This function is designed to redirect the user to his/her snows locations
 * @param -
 */
function myLocation(){
    require "view/leasing.php";
}

function test(){
    $leasing = array(['IDLoc' => 'b122',
                    'snowCode' => 'b122',
                    "snowBrand" => 'hector',
                    "snowModel" => "Hozor",
                    "dailyPrice" => 2,
                    "qtyLoc" => 12,
                    "dateLoc" => date("D-M-Y")]);
    require  "view/leasing.php";
}