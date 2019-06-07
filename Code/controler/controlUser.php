<?php
/**
 * This php file is designed to manage all operation regarding users management
 * Author   : louis.richard@cpnv.ch
 * Project  : Projet WEB + BDD
 * Created  : 24.05.2019 - 09:00
 *
 * Last update :    03.06.2019 Louis Richard
 *                  Modified some comments
 * Source       :   https://github.com/Havachi/ProjetWEB-DB-LJACorp
 */

/**
 * This function is designed to manage login request
 * @param $loginRequest containing login fields required to authenticate the user
 */
function login($loginRequest){
    //if a login request was submitted
    if (isset($loginRequest['inputUserEmailAddress']) && isset($loginRequest['inputUserPsw'])) {
        //extract login parameters
        $userEmailAddress = $loginRequest['inputUserEmailAddress'];
        $userPsw = $loginRequest['inputUserPsw'];

        //try to check if user/psw are matching with the database
        require_once "model/usersManager.php";
        try {
            $corr = isLoginCorrect($userEmailAddress, $userPsw);
        }catch (SiteUnderMaintenanceExeption $errormsg){
            require "view/home.php";
            die;
        }
        if ($corr) {
            createSession($userEmailAddress);
            $_GET['loginError'] = false;
            $_GET['action'] = "home";
            require "view/home.php";
        } else { //if the user/psw does not match, login form appears again
            $_GET['loginError'] = true;
            $_GET['action'] = "login";
            require "view/login.php";
        }
    }else{ //the user does not yet fill the form
        $_GET['action'] = "login";
        require "view/login.php";
    }
}

/**
 * This function is designed to redirect the user to the register form if no registerRequest is empty
 * If register request is not null, it will test the values, extract them and register the user
 * If the values aren't good to register the user, the user will be redirected to the register form with an error
 * @param $registerRequest containing result from a register request
 */
function register($registerRequest){
    //variable set
    if (isset($registerRequest['inputUserEmailAddress']) && isset($registerRequest['inputUserPsw']) && isset($registerRequest['inputUserPswRepeat'])) {

        //extract register parameters
        $userEmailAddress = $registerRequest['inputUserEmailAddress'];
        $userPsw = $registerRequest['inputUserPsw'];
        $userPswRepeat = $registerRequest['inputUserPswRepeat'];

        if ($userPsw == $userPswRepeat){
            require_once "model/usersManager.php";
            try {
                $corr = registerNewAccount($userEmailAddress, $userPsw);
            }catch (SiteUnderMaintenanceExeption $errormsg){
                require "view/home.php";
                die;
            }
            if ($corr){
                createSession($userEmailAddress);
                $_GET['registerError'] = false;
                $_GET['action'] = "home";
                require "view/home.php";
            }
        }else{
            $_GET['registerError'] = true;
            $_GET['action'] = "register";
            require "view/register.php";
        }
    }else{
        $_GET['action'] = "register";
        require "view/register.php";
    }
}

/**
 * This function is designed to create a new user session
 * @param $userEmailAddress : user unique id
 */
function createSession($userEmailAddress){
    $_SESSION['userEmailAddress'] = $userEmailAddress;
    //set user type in Session
    try {
        $userType = getUserType($userEmailAddress);
    }catch (SiteUnderMaintenanceExeption $errormsg){
        require "view/home.php";
        die;
    }

    $_SESSION['userType'] = $userType;
}

/**
 * This function is designed to manage logout request
 * @param -
 */
function logout(){
    $_SESSION = array();
    session_destroy();
    $_GET['action'] = "home";
    require "view/home.php";
}