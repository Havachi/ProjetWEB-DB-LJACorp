<?php
/**
 * This php file is designed to manage all operation regarding snow's management
 * Author   : pascal.benzonana@cpnv.ch
 * Project  : 151
 * Created  : 18.02.2019 - 21:40
 *
 * Last update :    19.02.2019 PBA
 *                  update fields in query
 * Source       :   https://bitbucket.org/pba_cpnv/151-2019_pba
 */

/**
 * This function is designed to get all active snows
 * @return array : containing all information about snows. Array can be empty.
 */
function getSnows(){
    $snowsQuery = 'SELECT code, brand, model, snowLength, dailyPrice, qtyAvailable, photo, active FROM snows';

    require_once 'model/dbConnector.php';
    $snowResults = executeQuerySelect($snowsQuery);

    return $snowResults;
}

/**
 * This function is designed to get only one snow
 * @param $snow_code : snow code to display (selected by the user)
 * @return array|null : snow to display. Can be empty.
 */
function getASnow($snow_code){
    $strgSeparator = '\'';

    // Query to get the selected snow. The active code must be set to 1 to display only snows to display. It avoids possibilty to user selecting a wrong code (get paramater in url)
    $snowQuery = 'SELECT code, brand, model, snowLength, dailyPrice, qtyAvailable, description, photo FROM snows WHERE code='.$strgSeparator.$snow_code.$strgSeparator.'AND active=1';

    require_once 'model/dbConnector.php';
    $snowResults = executeQuerySelect($snowQuery);

    return $snowResults;
}

/**
 * This function recover the quantity of snow in stock from the database.
 * @param $snowCode : The unique code of the snow
 * @return array : if the snow exist
 */
function getSnowQty($snowCode){
    $strSep = '\'';
    $snowQty = 0;
    $query = "SELECT qtyAvailable FROM snows WHERE code=".$strSep.$snowCode.$strSep;
    require_once 'model/dbConnector.php';
    $snowQty =executeQuerySelect($query);
    return $snowQty;
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