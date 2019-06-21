<?php

/**
 * This php file is designed to manage all operation regarding snow's management
 * Author   : louis.richard@cpnv.ch
 * Project  : Projet WEB + BDD
 * Created  : 24.05.2019 - 09:00
 *
 * Last update :    03.06.2019 Louis Richard
 *                  Moved function snowLeasingRequest to controlCart
 *                  Modified some comments
 * Source       :   https://github.com/Havachi/ProjetWEB-DB-LJACorp
 */

/**
 * This function is designed to display all the snows in the databse
 * This function redirect the user to a different view if the user in a seller
 * @param -
 */
function displaySnows(){
    if (isset($_POST['resetCart'])) {
        unset($_SESSION['cart']);
    }

    require_once "model/snowsManager.php";
    try{
        $snowsResults = getSnows();
    }catch (SiteUnderMaintenanceExeption $errormsg) {
        require "view/home.php";
        die;
    }


    $_GET['action'] = "displaySnows";
    if (isset($_SESSION['userType']))
    {
        switch ($_SESSION['userType']) {
            case 1://this is a customer
                require "view/snows.php";
                break;
            case 2://this a seller
                require "view/snowsSeller.php";
                break;
            default:
                require "view/snows.php";
                break;
        }
    }else{
        require "view/snows.php";
    }
}

/**
 * This function is designed to get only one snow results (for aSnow view)
 * @param $snow_code - Snow ID
 */
function displayASnow($snow_code){
    require_once "model/snowsManager.php";
    try {
        $snowsResults = getASnow($snow_code);
    }catch(SiteUnderMaintenanceExeption $errormsg) {
        require "view/home.php";
        die;
    }
    require "view/aSnow.php";
}