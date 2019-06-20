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
 * This function is designed to redirect the user to his/her snows locations.
 * if the user is a custommer, he will see his locations
 * If the user is a seller //TODO
 */
function myLocation(){
    //if userType is set. else, we redirect the user to the login page
    if (isset($_SESSION['userType'])) {
        switch ($_SESSION['userType']) {
            case 1://this is a customer
                if(!isset($_SESSION['userID'])){
                    require_once "model/usersManager.php";
                    $_SESSION['userID'] = getUserID($_SESSION['userEmailAddress']);
                }
                require_once "model/locationManager.php";
                try {
                    $leasing = LeasingRecover($_SESSION['userID']); //TODO tester cette fonction
                }catch(SiteUnderMaintenanceExeption $errormsg){
                    require "view/home.php";
                    die();
                }
                require "view/leasing.php";
                break;
            case 2://this a seller
                require "view/leasingSeller.php";
                break;
            default:
                //if user id is unknown, we get it
                if(!isset($_SESSION['userID'])){
                    require_once "model/usersManager.php";
                    $_SESSION['userID'] = getUserID($_SESSION['userEmailAddress']);
                }
                //get user locations
                require_once "model/locationManager.php";
                try {
                    $leasing = LeasingRecover($_SESSION['userID']); //TODO tester cette fonction
                }catch(SiteUnderMaintenanceExeption $errormsg){
                    require "view/home.php";
                    die();
                }
                //refirect to leasing page
                require "view/leasing.php";
                break;
        }
    }else{
        //redirect to login page with an error
        $_GET['notlog'] = TRUE;
        require "view/login.php";
    }
}
//TODO
function displayALeasing(){
    $idLoc = $_GET["code"];
}

function test(){
    $leasing = array(
        [
            'IDLoc' => 'b122',
            'snowCode' => 'b122',
            "snowBrand" => 'hector',
            "snowModel" => "Hozor",
            "dailyPrice" => 2,
            "qtyLoc" => 12,
            "dateLoc" => date("d/m/Y")
        ],
        [
            'IDLoc' => 'b122',
            'snowCode' => 'b122',
            "snowBrand" => 'hector',
            "snowModel" => "Hozor",
            "dailyPrice" => 2,
            "qtyLoc" => 12,
            "dateLoc" => date("d/m/Y")
        ]
    );


    require  "view/leasing.php";
}
