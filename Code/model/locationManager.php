<?php

/**
 *|File Info|
 *
 *  *~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*
 *  | Author   : Alessandro Rossi                                                        |
 *  | Project  : ProjetWEB-DB-LJACorp                                                    |
 *  | Created  : 24.05.2019 - 8:30                                                       |
 *  |                                                                                    |
 *  | Last update :    24.05.2019                                                        |
 *  |                                                                                    |
 *  | Git source  :    [https://github.com/Havachi/ProjetWEB-DB-LJACorp]                 |
 *  *~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*
 */

/*  $completeLocationArray excepted values
 *  userID  = The User id
 *  snowID  = The Snow id
 *  dateLoc = When the Location was made
 *  qtyLoc  = How much Snow
 *  nbdLoc  = How much Days
 *  flag    = Used to differentiate multiple cart
 * */



/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function get Location Datas and transfer individual cart to the next function
 * @param $actualCart The cart of the user, can't be null (at least shouldn't be null)
 * @param $userEmail The user Email Address
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function createLeasing($actualCart, $userEmail){
    $completeLocationArray = array();
    //UserID extraction
    require_once "model/usersManager.php";

    $userID = getUserID($userEmail);
    $flag = 0;
   //Verifiacation that the cart isn't empty
        //Single cart extraction
        foreach ($actualCart as $cart){

            $snowCode = $cart['code'];
            require_once "model/snowsManager.php";
            $snowID = getSnowID($snowCode);
            $dateLoc = $cart['dateD'];
            $qtyLoc = $cart['qty'];
            $nbdLoc = $cart['nbD'];

            //Cart concatenation
            $tempLocation = array(
                "userID" => $userID,
                "snowID" => $snowID,
                "dateLoc" => $dateLoc,
                "qtyLoc" => $qtyLoc,
                "nbdLoc" => $nbdLoc,
                "flag" => $flag
            );
            array_push($completeLocationArray, $tempLocation);

            $flag++;
        }
        locationQuery($completeLocationArray);
}
/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function insert Loaction in DB
 * @param $completeLocationArray The complete loaction datas
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function LeasingQuery($completeLocationArray){


    if(isset($completeLocationArray)){


        foreach ($completeLocationArray as $location){
            $userID  = $location['userID'];
            $snowID  = $location['snowID'];
            $dateLoc = $location['dateLoc'];
            $qtyloc  = $location['qtyLoc'];
            $nbdLoc  = $location['nbdLoc'];
            $strSeparator = '\'';
            $locationInserQuery = 'INSERT INTO locations (FKUser, FKSnow, DateLoc, QtyLoc, NbDLoc) VALUES ('.$strSeparator.$userID.$strSeparator.','.$strSeparator.$snowID.$strSeparator.','.$strSeparator.$dateLoc.$strSeparator.','.$strSeparator.$qtyloc.$strSeparator.','.$strSeparator.$nbdLoc.$strSeparator.')';
            require_once 'model/dbConnector.php';
            executeQueryInsert($locationInserQuery);
        }
    }
}

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function recover Loction datas in DB
 * @param $IDloc The location unique ID
 * @return array
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function LeasingRecover($IDloc){
    $strSep = '\'';
    $completeLocationArray = array();
    $query = "SELECT * FROM locations WHERE IDLoc=" . $strSep . $IDloc . $strSep;
    require_once 'model/dbConnector.php';
    $completeLocationArray = executeQuerySelect($query);

    return $completeLocationArray;
}

