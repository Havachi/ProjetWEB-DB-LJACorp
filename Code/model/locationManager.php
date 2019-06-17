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
 * @param $actualCart : The cart of the user, can't be null (at least shouldn't be null)
 * @param $userEmail : The user Email Address
 * @throws SiteUnderMaintenanceExeption : in case the quarry didn't pass so the database is unreachable
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function createLeasing($actualCart, $userEmail){
    $completeLocationArray = array();
    //UserID extraction
    require_once "model/usersManager.php";

    $userID = getUserID($userEmail);
    if ($userID === null){
            throw new SiteUnderMaintenanceExeption;
    }




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
        LeasingQuery($completeLocationArray);
}
/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function insert Leasing in DB
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
 * This function recover Leasing datas in DB
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

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function will gather and recover all data needed in the locationseller view.
 * @param $IDLocation : the unique Location identifier
 * @return array : It return the full array with all needed data
 * @throws SiteUnderMaintenanceExeption : in case the database can't be reach or other bug,
 *                                        the function throw an Exception
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function displayleasingFormating($IDLocation){

    /*
     *   Location: id de la location --> IDLoc
     *   Client: email client --> userEmail
     *   Début de location: date xx/xx/xxxx --> dateLoc
     *   Fin de location: date xx/xx/xxxx --> dateEndLoc
     *   Statut: En cours/Rendu partiel/Rendu --> statusLoc
     *
     * */

    $strSep= '\'';
    $locID=$IDLocation;
    $userEmail="";
    $locStart="";
    $locEnd="";
    $locStatus="";
    $leasing=array();

    $query= "SELECT FK_IDUser,DateLocStart,DateLocEnd,LocStatus FROM locations WHERE IDLoc =". $strSep . $locID . $strSep;
    require_once 'model/dbConnector.php';

    $queryResult = executeQuerySelect($query);
    if($queryResult===null or $queryResult===false){
        throw new SiteUnderMaintenanceExeption;
    }else{
        require_once 'model/usersManager.php';
        $userEmail=getUserEmail($queryResult[0]['FK_IDUser']);
        if($userEmail===null or $userEmail === false or $userEmail == ""){
            throw new SiteUnderMaintenanceExeption;
        }else{
            $locStart=$queryResult[0]['DateLocStart'];
            $locEnd=$queryResult[0]['DateLocEnd'];
            $locStatus=$queryResult[0]['LocStatus'];

            $leasing = array('locID' => $locID,'userEmail' => $userEmail ,'locStart' => $locStart ,'locEnd' => $locEnd ,'locStatus' => $locStatus);

        }
    }
    return $leasing;
}

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function is made to automatically update the Location status if needed after any
 * status change on the interface
 * @param $IDLocation : the unique Location identifier.
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function updateLocationStatus($IDLocation){

    $strSeparator = '\'';
    $locUpdatedStatus=0;
    //count how much Order in that Location
    $queryCountLoc = 'SELECT COUNT(FK_IDLoc) FROM orderedsnow WHERE FK_IDLoc ='.$strSeparator.$IDLocation.$strSeparator;
    require_once 'model/dbConnector.php';
    $locTotalOrder=executeQuerySelect($queryCountLoc);

    //Count how much OrderStatus is at 1 in that location
    $queryCountOrder = 'SELECT COUNT(FK_IDLoc) FROM orderedsnow WHERE OrderStatus = 1 AND FK_IDLoc ='.$strSeparator.$IDLocation.$strSeparator;
    require_once 'model/dbConnector.php';
    $locRendu=executeQuerySelect($queryCountOrder);
    //if the 2 number are equal set the Location to 2



    if($locTotalOrder == $locRendu){
        $locUpdatedStatus= 2;
    }elseif ($locRendu > 0 && $locRendu < $locTotalOrder){
        $locUpdatedStatus = 1;
    }

    //replace actual locStatus if needed
    if($locUpdatedStatus != 0){
        $queryUpdate= 'UPDATE locations SET LocStatus='.$strSeparator.$locUpdatedStatus.$strSeparator.'WHERE IDLoc ='.$strSeparator.$IDLocation.$strSeparator;
        executeQueryUpdate($queryUpdate);
    }
}

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function is made to update value in database when a status is changed on the
 * interface.
 * This function doesn't need any value to set the order to, because there is only one
 * thing to do, set it to "Rendu" or "1" in the database, any other move isn't relevant.
 * @param $IDLocation : the unique Location identifier.
 * @param $snowCode : The new status that will replace the old one.
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function changeOrderStatus($IDLocation, $snowCode){
    $strSeparator = '\'';
    $query='UPDATE orderedsnow SET OrderStatus = 1 WHERE FK_IDLoc ='. $strSeparator.$IDLocation.$strSeparator.' AND FK_IDSnow='.$strSeparator.$snowCode.$strSeparator;
    require "model/dbConnector.php";
    executeQueryUpdate($query);

    updateLocationStatus($IDLocation);
}