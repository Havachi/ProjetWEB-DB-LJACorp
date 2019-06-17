<?php
/**
 *|File Info|
 *
 *  *~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*
 *  | Author   : Alessandro Rossi                                                        |
 *  | Project  : ProjetWEB-DB-LJACorp                                                    |
 *  | Created  : 27.05.2019 - 11:00                                                      |
 *  |                                                                                    |
 *  | Last update :    27.05.2019                                                        |
 *  |                                                                                    |
 *  | Git source  :    [https://github.com/Havachi/ProjetWEB-DB-LJACorp]                 |
 *  *~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*
 */


/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function remove n-item in stock, this append when a leasing is completed
 * @param $snowCode : The Snow Code in DB
 * @param $newStock : The New stock that will replace the old one
 * @return array
 * @throws SiteUnderMaintenanceExeption
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 */
function stockSet($snowCode,$newStock){
    $strSep = '\'';
    $query = "UPDATE snows SET qtyAvailable=".$strSep.$newStock.$strSep." WHERE code=".$strSep.$snowCode.$strSep.";";
    require_once 'model/dbConnector.php';
    $queryResult=executeQueryUpdate($query);
    if($queryResult===null){
        throw new SiteUnderMaintenanceExeption;
    }
    return $queryResult;
}
