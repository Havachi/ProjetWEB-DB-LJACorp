<?php
/**
 * This php file is designed to manage all operation regarding cart management
 * Author   : louis.richard@cpnv.ch
 * Project  : Projet WEB + BDD
 * Created  : 24.05.2019 - 09:00
 *
 * Last update :    24.05.2019 Louis Richard
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
    if(isset($_SESSION['cart'])) {
        $cartArrayTemp = $_SESSION['cart'];
        if($cartArrayTemp!=null || $cartArrayTemp!=array()){
            require_once "model/snowsManager.php";
            $stockQty = getSnowQty($snowCode);
            require_once "model/cartManager.php";
            $inCartQty = getSnowQtyInCart($cartArrayTemp, $snowCode);
        }

    }
    if(($snowLocationRequest) AND ($snowCode)){
        if($inCartQty + $snowLocationRequest['inputQuantity'] <= $stockQty){
            if($snowLocationRequest['inputQuantity'] > 0){
                if($snowLocationRequest['inputDays'] > 0){
                    if($snowLocationRequest['inputQuantity'] < $stockQty){
                        if(isset($cartArrayTemp) && $cartArrayTemp != NULL){
                            if(isset($_SESSION['cart'])) {
                                foreach ($cartArrayTemp as $key => &$cart) {
                                    if ($snowCode == $cart['code']) {
                                        if ($snowLocationRequest['inputDays'] == $cart['nbD']) {
                                            $tempqty = $cart['qty'];
                                            $cart['qty'] = $tempqty + $snowLocationRequest['inputQuantity'];
                                        }
                                    }
                                } #End foreach
                            }
                        } else { //current cart is empty
                            $cartArrayTemp = array(
                                'code' => $snowCode,
                                'dateD' => Date("d-m-y"),
                                'qty' => $snowLocationRequest['inputQuantity'],
                                'nbD' => $snowLocationRequest['inputDays']
                            );
                            $_SESSION['cart'] = array();
                            array_push($_SESSION['cart'], $cartArrayTemp);
                            require "view/cart.php";
                        }
                    } else { //Qty too high
                        $_GET['code'] = $snowCode;
                        $_GET['qty'] = true;
                        require "view/snowLeasingRequest.php";
                    }
                } else { //nbDays too low
                    $_GET['code'] = $snowCode;
                    $_GET['days'] = true;
                    require "view/snowLeasingRequest.php";
                }
            } else { //Qty too low
                $_GET['code'] = $snowCode;
                $_GET['qty'] = true;
                require "view/snowLeasingRequest.php";
            }
        } else { //Qty too high
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