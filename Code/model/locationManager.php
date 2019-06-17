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


/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function get Location Datas and transfer individual cart to the next function
 * @param $actualCart : The cart of the user, can't be null (at least shouldn't be null)
 * @param $userEmail : The user Email Address
 * @throws SiteUnderMaintenanceExeption : in case the quarry didn't pass so the database is unreachable
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function createLeasing($actualCart, $userEmail)
{
    $completeLocationArray = array();
    //UserID extraction
    require_once "model/usersManager.php";
    $DateLocStart = "0";


    foreach ($actualCart as $cart){


    }
    //TODO Create the arrays correclty

      /*$cart['code'];
        $cart['dateD'];
        $cart['qty'];
        $cart['nbD']; }*/
    //Location Data Grouping
    //convert userEmail to userID
    $userID = getUserID($userEmail);
    if ($userID === null) {
        throw new SiteUnderMaintenanceExeption;
    }


    $timeStamp=strtotime($DateLocStart);
    $timeStamp=$timeStamp+86400;
    $DateOrderEnd=date("d-m-y",$timeStamp);
    $LocStatus=0;

    //Array Creation for orderedSnow table
    $orderedSnowData = array(
        'IDLoc' => $IDLocation,
        'IdSnow' => $IDSnow,
        'DateOrderEnd' => $DateOrderEnd,
        'QtyOrder' => $QtyOrder,
        'NbDOrder' => $NbdOrder,
        'OrderStatus' => $OrderStatus
    );



    //Full Leasing Array Creation

    //Array Creation for locations table
    $locationData = array(
        'UserID' => $userID,
        'DateLocStart' => $DateLocStart,
        'DateLocEnd' => $DateLocEnd,
        'LocStatus' => $LocStatus
    );


    //Two Array Concatenation
    array_push($completeLocationArray, $locationData, $orderedSnowData);

    LeasingQuery($completeLocationArray);
}

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function insert Leasing data in DB
 * @param $completeLocationArray : The complete loaction datas
 * @throws SiteUnderMaintenanceExeption : in case the query can't be achieved
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function LeasingQuery($completeLocationArray)
{


    if (isset($completeLocationArray)) {
        foreach ($completeLocationArray as $location) {
            $userID = $location['userID'];
            $snowID = $location['snowID'];
            $dateLoc = $location['dateLoc'];
            $qtyloc = $location['qtyLoc'];
            $nbdLoc = $location['nbdLoc'];
            $strSeparator = '\'';
            $locationInserQuery = 'INSERT INTO locations (FK_IDUser, DateLocStart,DateLocEnd,LocStatus) VALUES ()';
            require_once 'model/dbConnector.php';
            $queryResult = executeQueryInsert($locationInserQuery);
            if ($queryResult === null) {
                throw new SiteUnderMaintenanceExeption;
            }
        }
    }
}

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function recover Leasing datas in DB
 * @param $userID : The User unique ID
 * @return array
 * @throws SiteUnderMaintenanceExeption : in case the query can't be achieved
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function LeasingRecover($userID)
{
    $strSep = '\'';
    $query = "SELECT * FROM locations WHERE FK_IDUser=" . $strSep . $userID . $strSep;
    require_once 'model/dbConnector.php';
    $completeLocationArray = executeQuerySelect($query);
    if ($completeLocationArray === null) {
        throw new SiteUnderMaintenanceExeption;
    }

    return $completeLocationArray;
}

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function will gather and recover all data needed in the locationseller view.
 * @param $IDLocation : the unique Location identifier
 * @return array : It return the full array with all needed data
 * @throws SiteUnderMaintenanceExeption : in case the database can't be reach or other bug,
 *                                        the function throw an Exception
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function displayLeasingFormatting($IDLocation)
{

    /*
     *   Location: id de la location --> IDLoc
     *   Client: email client --> userEmail
     *   Début de location: date xx/xx/xxxx --> dateLoc
     *   Fin de location: date xx/xx/xxxx --> dateEndLoc
     *   Statut: En cours/Rendu partiel/Rendu --> statusLoc
     *
     * */

    $strSep = '\'';
    $locID = $IDLocation;


    $query = "SELECT FK_IDUser,DateLocStart,DateLocEnd,LocStatus FROM locations WHERE IDLoc =" . $strSep . $locID . $strSep;
    require_once 'model/dbConnector.php';

    $queryResult = executeQuerySelect($query);
    if ($queryResult === null) {
        throw new SiteUnderMaintenanceExeption;
    } else {
        require_once 'model/usersManager.php';
        $userEmail = getUserEmail($queryResult[0]['FK_IDUser']);
        $locStart = $queryResult[0]['DateLocStart'];
        $locEnd = $queryResult[0]['DateLocEnd'];
        $locStatus = $queryResult[0]['LocStatus'];

        $leasing = array('locID' => $locID, 'userEmail' => $userEmail, 'locStart' => $locStart, 'locEnd' => $locEnd, 'locStatus' => $locStatus);
    }
    return $leasing;
}

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function is made to automatically update the Location status if needed after any
 * status change on the interface
 * @param $IDLocation : the unique Location identifier.
 * @throws SiteUnderMaintenanceExeption : If the database can't be reached
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function updateLocationStatus($IDLocation)
{

    $strSeparator = '\'';
    $locUpdatedStatus = 0;
    //count how much Order in that Location
    $queryCountLoc = 'SELECT COUNT(FK_IDLoc) FROM orderedsnow WHERE FK_IDLoc =' . $strSeparator . $IDLocation . $strSeparator;
    require_once 'model/dbConnector.php';
    $locTotalOrder = executeQuerySelect($queryCountLoc);
    if ($locTotalOrder === null) {
        throw new SiteUnderMaintenanceExeption;
    }
    //Count how much OrderStatus is at 1 in that location
    $queryCountOrder = 'SELECT COUNT(FK_IDLoc) FROM orderedsnow WHERE OrderStatus = 1 AND FK_IDLoc =' . $strSeparator . $IDLocation . $strSeparator;
    require_once 'model/dbConnector.php';
    $locRendu = executeQuerySelect($queryCountOrder);
    if ($locRendu === null) {
        throw new SiteUnderMaintenanceExeption;
    }
    //if the 2 number are equal set the Location to 2


    if ($locTotalOrder == $locRendu) {
        $locUpdatedStatus = 2;
    } elseif ($locRendu > 0 && $locRendu < $locTotalOrder) {
        $locUpdatedStatus = 1;
    }

    //replace actual locStatus if needed
    if ($locUpdatedStatus != 0) {
        $queryUpdate = 'UPDATE locations SET LocStatus=' . $strSeparator . $locUpdatedStatus . $strSeparator . ' WHERE IDLoc =' . $strSeparator . $IDLocation . $strSeparator;
        $queryResult = executeQueryUpdate($queryUpdate);
        if ($queryResult === null) {
            throw new SiteUnderMaintenanceExeption;
        }
    }
}

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function is made to update value in database when a status is changed on the
 * interface.
 * This function doesn't need any value to set the order to, because there is only one
 * thing to do, set it to "Rendu" or "1" in the database, any other move isn't relevant.
 * @param $IDLocation : the unique Location identifier.
 * @param $snowCode : The new status that will replace the old one.
 * @throws SiteUnderMaintenanceExeption : If the database can't be reached
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function changeOrderStatus($IDLocation, $snowCode)
{
    $strSeparator = '\'';
    $query = 'UPDATE orderedsnow SET OrderStatus = 1 WHERE FK_IDLoc =' . $strSeparator . $IDLocation . $strSeparator . ' AND FK_IDSnow=' . $strSeparator . $snowCode . $strSeparator;
    require "model/dbConnector.php";
    $queryResult = executeQueryUpdate($query);
    if ($queryResult === null) {
        throw new SiteUnderMaintenanceExeption;
    }
    updateLocationStatus($IDLocation);
}

function dateCalculator($Datestart, $nbDayToAdd){
    //TODO make this Function

    //Get the date in parameters
    //convert to Second AKA timestamp
    //add the equivalent of a day in second
    //convert back to date
    //return the result
}