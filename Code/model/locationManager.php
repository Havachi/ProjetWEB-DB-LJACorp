<?php
/**
 *|File Info|
 *
 *   /-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-\
 *  | Author   : Alessandro Rossi                                                                        |
 *  | Project  : ProjetWEB-DB-LJACorp                                                    |
 *  | Created  : 24.05.2019 - 8:30                                                         |
 *  |                                                                                    |
 *  | Last update :    24.05.2019                                                            |
 *  |                                                                                    |
 *  | Git source  :    [https://github.com/Havachi/ProjetWEB-DB-LJACorp]                 |
 *   \-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-/
 */

/*  $completeLocationArray excepted values
 *  userID  = The User id
 *  snowID  = The Snow id
 *  dateLoc = When the Location was made
 *  qtyLoc  = How much Snow
 *  nbdLoc  = How much Days
 *  flag    = Used to differentiate multiple cart
 * */

//TODOLIST
//-----------------------------------------------------------
//TODO Task #54 Traitement de la demande de location
//TODO Test the query
//-
//TODO Séparation des carts
//TODO envoye individuel des Carts vers la fonction D'insert
//TODO Check for malformed cart
//-----------------------------------------------------------


/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function get Location Datas and transfer individual cart to the next function
 * @param $actualCart The cart of the user, can't be null (at least shouldn't be null)
 * @param $userEmail The user Email Address
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function createLocation($actualCart, $userEmail){
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
            $tempLocation = array();
            $flag++;
        }
        locationQuery($completeLocationArray);
}





/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function insert Loaction in DB
 * @param $completeLocationArray The complete loaction datas
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function locationQuery($completeLocationArray){


    if(isset($completeLocationArray)){
        $flag = $completeLocationArray['flag'];

        foreach ($completeLocationArray as $location){
            $userID  = $location['userID'];
            $snowID  = $location['snowID'];
            $dateLoc = $location['dateLoc'];
            $qtyloc  = $location['qtyLoc'];
            $nbdLoc  = $location['nbdLoc'];
            $strSeparator = '\'';
            $locationInserQuery = 'INSERT INTO locations (FKUser, FKSnow, DateLoc, QtyLoc, NbDLoc) VALUES (' .$strSeparator.$userID.$strSeparator.$snowID.$strSeparator.$dateLoc.$strSeparator.$qtyloc.$strSeparator.$nbdLoc.$strSeparator.')';
            require_once 'model/dbConnector.php';
            executeQueryInsert($locationInserQuery);
        }
    }
}