<?php
/**
 *|File Info|
 *
 *  *~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-*
 *  |                                                                                               |
 *  | Author   : pascal.benzonana@cpnv.ch                                                           |
 *  | Project  : ProjetWEB-DB-LJACorp                                                               |
 *  | Created  : 18.02.2019 - 21:40                                                                 |
 *  | Description : This php file is designed to manage all operation regarding snow's management   |                                                                                   |
 *  |                                                                                               |
 *  |                                                                                               |
 *  | Git source  :    [https://github.com/Havachi/ProjetWEB-DB-LJACorp]                            |
 *  *~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-*
 */
include "exceptions/SiteUnderMaintenanceExeption.php";

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function is designed to get all active snows
 * @return array : containing all information about snows. Array can be empty.
 * @throws SiteUnderMaintenanceExeption : in case the query can't be achieved
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function getSnows()
{

    $snowsQuery = 'SELECT code, brand, model, snowLength, dailyPrice, qtyAvailable, photo, active FROM snows';

    require_once 'model/dbConnector.php';
    $snowResults = executeQuerySelect($snowsQuery);
    if ($snowResults === null) {
        throw new SiteUnderMaintenanceExeption;
    }


    return $snowResults;
}

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function is designed to get only one snow
 * @param $snow_code : snow code to display (selected by the user)
 * @return array|null : snow to display. Can be empty.
 * @throws SiteUnderMaintenanceExeption : in case the query can't be achieved
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function getASnow($snow_code)
{
    $strgSeparator = '\'';

    // Query to get the selected snow. The active code must be set to 1 to display only snows to display. It avoids possibilty to user selecting a wrong code (get paramater in url)
    $snowQuery = 'SELECT code, brand, model, snowLength, dailyPrice, qtyAvailable, description, photo FROM snows WHERE code=' . $strgSeparator . $snow_code . $strgSeparator . 'AND active=1';

    require_once 'model/dbConnector.php';
    $snowResults = executeQuerySelect($snowQuery);
    if ($snowResults === null) {
        throw new SiteUnderMaintenanceExeption;
    }

    return $snowResults;
}


/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function recover the quantity of snow in stock from the database.
 * @param $snowCode : The unique code of the snow
 * @return array : if the snow exist
 * @throws SiteUnderMaintenanceExeption : in case the query can't be achieved
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function getSnowQty($snowCode)
{
    $strSep = '\'';
    $snowQty = 0;
    $query = "SELECT qtyAvailable FROM snows WHERE code=" . $strSep . $snowCode . $strSep;
    require_once 'model/dbConnector.php';
    $snowQty = executeQuerySelect($query);
    if ($snowQty === null) {
        throw new SiteUnderMaintenanceExeption;
    }
    return $snowQty[0]['qtyAvailable'];
}

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function get the IDSnow in database from the snow code
 * @param $snowCode : The snow code
 * @return array
 * @throws SiteUnderMaintenanceExeption : in case the query can't be achieved
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function getSnowID($snowCode)
{
    $strSep = '\'';
    $IDSnow = 0;
    $query = 'SELECT IDSnow FROM snows WHERE code=' . $strSep . $snowCode . $strSep;
    require_once 'model/dbConnector.php';
    $IDSnow = executeQuerySelect($query);
    if ($IDSnow === null) {
        throw new SiteUnderMaintenanceExeption;
    }
    return $IDSnow[0]['IDSnow'];
}

//<editor-fold desc="Temporarly Unused Function">
/* Unused function
function addSnowInDB($snowValues){
    $strSep = '\'';

    $code=$snowValues['snowCode'];
    $brand=$snowValues['snowBrand'];
    $model=$snowValues['snowModel'];
    $snowLength=$snowValues['snowSnowLength'];
    $qtyAvailable=$snowValues['snowQtyAvailable'];
    $dailyPrice=$snowValues['snowDailyPrice'];
    $photo = "view/content/images/".$code."_small.jpg";


    $query = "INSERT INTO snows (code,brand,model,snowLength,qtyAvailable,dailyPrice, photo) VALUES(".$strSep.$code.$strSep.",".$strSep.$brand.$strSep.",".$strSep.$model.$strSep.",".$strSep.$snowLength.$strSep.",".$strSep.$qtyAvailable.$strSep.",".$strSep.$dailyPrice.$strSep.",".$strSep.$photo.$strSep.")";
    executeQueryInsert($query);

}
*/
//</editor-fold>