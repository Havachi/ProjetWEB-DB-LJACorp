<?php
/**
 * Author   : nicolas.glassey@cpnv.ch
 * Project  : Projet Web + BDD
 * Created  : 09.04.2019 - 13:45
 *
 * Last update :    [03.05.2019 louis.richard@cpnv.ch]
 *                  [add function register]
 * Git source  :    [link]
 */

/**
 * This function is designed to redirect the user to the home page (depending on the action received by the index)
 */
function home(){
    $_GET['action'] = "home";
    require "view/home.php";
}

//region users management
/**
 * This fonction is designed to check if the register form has been completed correctly before registering the user
 * @param $registerRequest - Content of the register form
 */
function register($registerRequest)
{
    //variable set
    if (isset($registerRequest['inputUserEmailAddress']) && isset($registerRequest['inputUserPsw']) && isset($registerRequest['inputUserPswRepeat'])) {

        //extract register parameters
        $userEmailAddress = $registerRequest['inputUserEmailAddress'];
        $userPsw = $registerRequest['inputUserPsw'];
        $userPswRepeat = $registerRequest['inputUserPswRepeat'];
        $userPseudo = $registerRequest['inputPseudo'];

        //If both passwords are the same
        if ($userPsw == $userPswRepeat) {
            require_once "model/usersManager.php";
            if (registerNewAccount($userEmailAddress, $userPsw, $userPseudo)) {
                createSession($userEmailAddress);
                $_GET['registerError'] = false;
                $_GET['action'] = "home";
                require "view/home.php";
            }
        } else {
            //If the two passwords aren't the same
            $_GET['registerError'] = true;
            $_GET['action'] = "register";
            require "view/register.php";
        }
    //If the register form has not been completed
    } else {
        $_GET['action'] = "register";
        require "view/register.php";
    }
}

/**
 * This function is designed to create a new user session
 * @param $userEmailAddress : user unique id from email address
 */
function createSession($userEmailAddress){
    $_SESSION['userEmailAddress'] = $userEmailAddress;

/*
    //set user type in Session
    $userType = getUserType($userEmailAddress);
    $_SESSION['userType'] = $userType;
*/
}
//endregion

//region courses management
//endregion