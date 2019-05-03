<?php
/**
 * Author   : louis.richard@cpnv.ch
 * Project  : ProjetWEBDB
 * Created  : 09.04.2019 - 13:46
 *
 * Last update :    [03.05.2019 author]
 *
 * Git source  :    [https://github.com/Havachi/ProjetWEB-DB-LJACorp]
 */

session_start();
require "controler/controler.php";

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'home' :
            home();
            break;
        default :
            home();
    }
}
else {
    home();
}