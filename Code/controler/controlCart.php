<?php
/**
 * This php file is designed to manage all operation regarding cart management
 * Author   : louis.richard@cpnv.ch
 * Project  : Projet WEB + BDD
 * Created  : 24.05.2019 - 09:00
 *
 * Last update :    24.05.2019 LRD
 *                  ---
 * Source       :   https://github.com/Havachi/ProjetWEB-DB-LJACorp
 */

/**
 * This function is designed to redirect the user to his cart
 * @param -
 */
function displayCart(){
    $_GET['action'] = "cart";
    require "view/cart.php";
}

/**
 * This function designed to manage all request impacting the cart content
 * @param $snowCode
 * @param $snowLocationRequest
 */
function updateCartRequest($snowCode, $snowLocationRequest){
    $cartArrayTemp = array();
    if (($snowLocationRequest) AND ($snowCode)) {
        if (isset($_SESSION['cart'])) {
            $cartArrayTemp = $_SESSION['cart'];
        }
        require "model/cartManager.php";
        $cartArrayTemp = updateCart($cartArrayTemp, $snowCode, $snowLocationRequest['inputQuantity'], $snowLocationRequest['inputDays']);
        if($cartArrayTemp!= null || $cartArrayTemp != false){
            $_SESSION['cart'] = $cartArrayTemp;
            $_GET['action'] = 'displayCart';
            require "view/cart.php";
        }
        else {
            $_GET['code'] = $snowCode;
            $_GET['qty'] = true;
            require "view/snowLeasingRequest.php";
        }
    }
}
/**
 *This function is designed to delete the selected snow in the cart
 * @param $line - Which line of the user's cart the snow was in
 */
function deleteCartRequest($line){
    if (isset($line)){
        array_splice($_SESSION['cart'],$line,1);
        // Test if the cart is empty
        if (count($_SESSION['cart'])<1)
        {
            unset ($_SESSION['cart']); //Cancel cart
            require_once "model/snowsManager.php";
            $snowsResults=getSnows();
            $_GET['action'] = "displaySnows";
            require "view/snows.php";
        }
        else
        {
            $_GET['action'] = "cartManage";
            require "view/cart.php";
        }
    }
}
