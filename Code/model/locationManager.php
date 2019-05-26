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
 *  qtyloc  = How much Snow
 *  nbdLoc  = How much Days
 *  flag    = Multi-purpose Flag(Not Necessary)
 * */


//isn't it so empty?

//TODOLIST
//TODO Task #54 Traitement de la demande de location
//TODO Séparation des carts
//TODO envoye individuel des Carts vers la fonction D'insert
//TODO Task #57 Create Insert Query
//-----------------------------------------------------------


/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function get Location Datas and transfer individual cart to the next function
 * @param $actualCart The cart of the user, can't be null (at least shouldn't be null)
 * @param $userEmail The user Email Address
 * @return IDK
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function createLocation($actualCart, $userEmail){
    foreach ($actualCart as $cart){



    }


}


/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function add a new item in the cart
 * @param
 * @return array : The full cart after adding the new leasing
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function locationQuery($completeLocationArray){


    if(isset($completeLocationArray)){
        $flag = $completeLocationArray['flag'];

        $userID  = $completeLocationArray['userID'];
        $snowID  = $completeLocationArray['snowID'];
        $dateLoc = $completeLocationArray['dateLoc'];
        $qtyloc  = $completeLocationArray['qtyloc'];
        $nbdLoc  = $completeLocationArray['nbdLoc'];

        $result = false;
        $strSeparator = '\'';
        $locationInserQuery = 'INSERT INTO locations (FKUser, FKSnow, DateLoc, QtyLoc, NbDLoc) VALUES (' .$strSeparator.$userID.$strSeparator.$snowID.$strSeparator.$dateLoc.$strSeparator.$qtyloc.$strSeparator.$nbdLoc.$strSeparator.')';
        require_once 'model/dbConnector.php';
        $queryResult = executeQueryInsert($locationInserQuery);
        if($queryResult){
            $result = $queryResult;
        }else{
            $error = "E121";
            return $error;
        }
        return $result;

    }





}