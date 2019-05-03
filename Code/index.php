<?php
/**
 * Author   : nicolas.glassey@cpnv.ch
 * Project  : ProjetWeb + BDD
 * Created  : 09.04.2019 - 13:46
 *
 * Last update :    [03.105.2019 louis.richard@cpnv.ch]
 *                  [Add case login]
 * Git source  :    [link]
 */

session_start();
require "controler/controler.php";

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'home' :
            home();
            break;
        case 'register' :
            register($_POST);
            break;
        case 'login' :
            login($_POST);
            break;
        default :
            home();
    }
}
else {
    home();
}