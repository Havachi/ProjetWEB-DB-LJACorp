<?php
/**
 * Created by PhpStorm.
 * User: Pascal.BENZONANA
 * Date: 08.05.2017
 * Time: 08:54
 * Update : 31-JAN-2019 - nicolas.glassey
 *          Simplify index. Remove all pages references.
 */

session_start();
//require "controler/controler.php";

if (isset($_GET['action'])) {
  $action = $_GET['action'];
  switch ($action) {
      case 'home' :
          require "view/home.php";
          break;
      case 'login' :
          require_once "controler/controlUser.php";
          login($_POST);
          break;
      case 'logout' :
          require_once "controler/controlUser.php";
          logout();
          break;
      case 'register' :
          require_once "controler/controlUser.php";
          register($_POST);
          break;
      case 'displaySnows' :
          require_once "controler/controlSnows.php";
          displaySnows();
          break;
      case 'displayASnow' :
          require_once "controler/controlSnows.php";
          displayASnow($_GET['code']);
          break;
      case 'snowLeasingRequest':
          require_once "controler/controlCart.php";
          snowLeasingRequest($_GET['code']);
          break;
      case 'updateCartRequest':
          require_once "controler/controlCart.php";
           updateCartRequest($_GET['code'], $_POST);
          break;
      case 'displayCart':
          require_once "controler/controlCart.php";
          displayCart();
          break;
      case 'deleteCartRequest':
          require_once "controler/controlCart.php";
          deleteCartRequest($_GET['line']);
          break;
      case 'emptyCart':
          require_once "controler/controlCart.php";
          emptyCart();
          break;
      case 'locationRequest':
          require_once "controler/controlRent.php";
          locationRequest();
          break;
      case 'myLocation':
          require_once "controler/controlRent.php";
          mylocation();
          break;
      case 'test':
          require_once "controler/controlRent.php";
          test();

      default :
          require "view/home.php";
  }
}
else {
    require "view/home.php";
}