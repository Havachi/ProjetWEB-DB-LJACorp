<?php
include "exceptions/SiteUnderMaintenanceExeption.php";

/**
 *|File Info|
 *
 *  *~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-*
 *  | Author   : nicolas.glassey@cpnv.ch                                                                |
 *  | Project  : ProjetWEB-DB-LJACorp                                                                   |
 *  | Created  : 31.01.2019 - 18:40                                                                     |
 *  | Description :    This php file is designed to manage all operations regarding user's management   |                                                                                |
 *  | Last update :    27.05.2019                                                                       |
 *  | Git source  :    [https://github.com/Havachi/ProjetWEB-DB-LJACorp]                                |
 *  *~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-*
 */


/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function is designed to verify user's login
 * @param $userEmailAddress
 * @param $userPsw
 * @return bool : "true" only if the user and psw match the database. In all other cases will be "false".
 * @throws SiteUnderMaintenanceExeption : in case the query can't be achieved
 *~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*
 */
function isLoginCorrect($userEmailAddress, $userPsw)
{
    $result = false;

    $strSeparator = '\'';
    $loginQuery = 'SELECT userHashPsw FROM users WHERE userEmailAddress = ' . $strSeparator . $userEmailAddress . $strSeparator;

    require_once 'model/dbConnector.php';
    $queryResult = executeQuerySelect($loginQuery);
    if ($queryResult === null) {
        throw new SiteUnderMaintenanceExeption;
    } else {
        if (count($queryResult) == 1) {
            $userHashPsw = $queryResult[0]['userHashPsw'];
            $hashPasswordDebug = password_hash($userPsw, PASSWORD_DEFAULT);
            $result = password_verify($userPsw, $userHashPsw);
        }
        return $result;

    }


}

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function is designed to register a new account
 * @param $userEmailAddress
 * @param $userPsw
 * @return bool|null
 * @throws SiteUnderMaintenanceExeption : in case the query can't be achieved
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*
 */
function registerNewAccount($userEmailAddress, $userPsw)
{
    $result = false;

    $strSeparator = '\'';

    $userHashPsw = password_hash($userPsw, PASSWORD_DEFAULT);

    $registerQuery = 'INSERT INTO users (`userEmailAddress`, `userHashPsw`) VALUES (' . $strSeparator . $userEmailAddress . $strSeparator . ',' . $strSeparator . $userHashPsw . $strSeparator . ')';

    require_once 'model/dbConnector.php';
    $queryResult = executeQueryInsert($registerQuery);
    if ($queryResult === null) {
        throw new SiteUnderMaintenanceExeption;
    } else {
        if ($queryResult) {
            $result = $queryResult;
        }
        return $result;
    }

}

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function is designed to get the type of user
 * For the webapp, it will adapt the behavior of the GUI
 * @param $userEmailAddress
 * @return int (1 = customer ; 2 = seller)
 * @throws SiteUnderMaintenanceExeption : in case the query can't be achieved
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/

function getUserType($userEmailAddress)
{
    $result = 1;//we fix the result to 1 -> customer

    $strSeparator = '\'';

    $getUserTypeQuery = 'SELECT userType FROM users WHERE users.userEmailAddress =' . $strSeparator . $userEmailAddress . $strSeparator;

    require_once 'model/dbConnector.php';
    $queryResult = executeQuerySelect($getUserTypeQuery);
    if ($queryResult === null) {
        throw new SiteUnderMaintenanceExeption;
    } else {
        if (count($queryResult) == 1) {
            $result = $queryResult[0]['userType'];
        }
        return $result;
    }

}

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function get and return the UserID from the DB, multiple use
 * @param $userEmailAddress The users Email Address
 * @return The user ID
 * @throws SiteUnderMaintenanceExeption : in case the query can't be achieved
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function getUserID($userEmailAddress)
{
    $strSeparator = '\'';

    $getUserIdQuery = 'SELECT IDUser FROM users WHERE userEmailAddress =' . $strSeparator . $userEmailAddress . $strSeparator;

    require_once 'model/dbConnector.php';

    $queryResult = executeQuerySelect($getUserIdQuery);
    if (count($queryResult) == 1) {
        $result = $queryResult[0]['IDUser'];
        return $result;
    }
}