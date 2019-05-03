<?php
/**
 * Author   : alessandro.rossi@cpnv.ch
 * Project  : ProjetWEBDB
 * Created  : 03.05.2019 - 08:00
 *
 * Last update :    [03.05.2019 author]
 *
 * Git source  :    [https://github.com/Havachi/ProjetWEB-DB-LJACorp]
 */


require "model/dbConnector.php";

//<editor-fold desc="Login">
/**
 * [Login]
 * This function check if the login is correct (email-password check)
 * @param $userEmailAddress
 * @param $userPassword
 * @return bool
 */
function isLoginCorrect($userEmailAddress, $userPassword)
{
    $isLoginCorrect = false;
    $strSep = '\'';


    $loginQuery = "SELECT userEmailAddress FROM users WHERE userEmailAddress = " . $strSep . $userEmailAddress . $strSep;

    $queryResultEmail = executeQuery($loginQuery);
    //check if email exist
    if (count($queryResultEmail) == 1) {
        $loginQuery = "SELECT userHashPsw FROM users WHERE userEmailAddress = " . $strSep . $userEmailAddress . $strSep;
        $queryResult = executeQuery($loginQuery);
        $queryResultpsw = $queryResult[0]["userHashPsw"];
        if (password_verify($userPassword, $queryResultpsw) == true) {
            $isLoginCorrect = true;
        } else echo "Wrong password";

    }
    else
    {
        echo "Email does't exist in DB";
    }

    return $isLoginCorrect;
}
//</editor-fold>
//<editor-fold desc="Register">
/**
 * [Register]
 * This function check if the Email address is already in use
 * @param $userEmailAddress
 * @return bool
 */
function checkEmailDB($userEmailAddress){

    $isEmailUsed = true;
    $strSep = '\'';


    $emailQuery = "SELECT * FROM users WHERE userEmailAddress= ".$strSep.$userEmailAddress.$strSep." LIMIT 1";


    $queryResult = executeQuery($emailQuery);

    if(count($queryResult)== 0){
        $isEmailUsed = false;
        return $isEmailUsed;
    }
    else{
        return $isEmailUsed;
    }
}
/**
 * [Register]
 * This function register the email and password in DB
 * @param $userEmail
 * @param $userPsw
 */
function registerDB($userEmail, $userPsw){
    $strSep = '\'';
    $query = "INSERT INTO users (userEmailAddress, userHashPsw) VALUES(".$strSep.$userEmail.$strSep.",".$strSep.$userPsw.$strSep.")";
    executeQuery($query);
}
//</editor-fold>