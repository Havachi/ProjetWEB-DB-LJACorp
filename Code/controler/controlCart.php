<?php
/**
 * This php file is designed to manage all operation regarding cart management
 * Author   : louis.richard@cpnv.ch
 * Project  : Projet WEB + BDD
 * Created  : 24.05.2019 - 09:00
 *
 * Last update :    03.06.2019 Louis Richard
 *                  Moved function snowLeasingRequest from controlSnow
 *                  Modified some comments
 * Source       :   https://github.com/Havachi/ProjetWEB-DB-LJACorp
 */

/**
 * This function is designed to redirect the user to his/her cart
 * @param -
 */
function displayCart(){
    $_GET['action'] = "cart";
    require "view/cart.php";
}

/**
 * This function designed to manage all request impacting the cart content
 * Test done :
 *  Does the user already haves a cart ?
 *  Is the current cart null ?
 *  Has the form been sent with corrects informations ?
 *  Isn't the quantity too high (cart + asked qty) ?
 *  Is the inserted qty > 0 ?
 *  is the inserted amount of days > 0 ?
 *  is the requested qty < qty in stock ?
 * @param $snowCode - Snow id
 * @param $snowLocationRequest - Result from the request form
 */
function updateCartRequest($snowCode, $snowLocationRequest){
    require_once "model/snowsManager.php";
    $stockQty = getSnowQty($snowCode);

    //Does the user already has a cart ?
    if(isset($_SESSION['cart'])) {
        $cartArrayTemp = $_SESSION['cart'];
        //is said cart not null ?
        if($cartArrayTemp!=null || $cartArrayTemp!=array()){
            require_once "model/cartManager.php";
            $inCartQty = getSnowQtyInCart($cartArrayTemp, $snowCode);
        } else {
            $inCartQty = 0;
        }
    } else {
        $inCartQty = 0;
    }
    //If the form isn't empty
    if(($snowLocationRequest) AND ($snowCode)){
        //If qty of snows asked + qty already in cart isn't to high
        if($inCartQty + $snowLocationRequest['inputQuantity'] <= $stockQty){
            //If number of snows isn't too low
            if($snowLocationRequest['inputQuantity'] > 0){
               //If number of days isn't too low
                if($snowLocationRequest['inputDays'] > 0){
                    //If asked quantity isn't more than stock
                    if($snowLocationRequest['inputQuantity'] <= $stockQty){
                        //If cart isn't empty
                        if(isset($cartArrayTemp) && $cartArrayTemp != NULL){
                            //If cart exist
                            if(isset($_SESSION['cart'])) {
                                $i = 0;
                                foreach ($cartArrayTemp as $key => &$cart) {
                                    if ($snowCode == $cart['code']) {
                                        if ($snowLocationRequest['inputDays'] == $cart['nbD']) {
                                            $tempqty = $cart['qty'];
                                            //Update qty
                                            $_SESSION['cart'][$i]['qty'] = $tempqty + $snowLocationRequest['inputQuantity'];
                                            $added = true;
                                        }//End Foreach-If-If
                                    }//End Foreach-If
                                    $i++;
                                }//End foreach
                                if(!isset($added)){
                                    //if the qty hasn't been updated
                                    $cartArrayTemp = array(
                                        'code' => $snowCode,
                                        'dateD' => Date("d/m/Y"),
                                        'qty' => $snowLocationRequest['inputQuantity'],
                                        'nbD' => $snowLocationRequest['inputDays']
                                    );
                                    array_push($_SESSION['cart'], $cartArrayTemp);
                                }
                                //redirect to your cart
                                require "view/cart.php";
                            } 
                        } else { //current cart is empty
                            $cartArrayTemp = array(
                                'code' => $snowCode,
                                'dateD' => Date("d/m/Y"),
                                'qty' => $snowLocationRequest['inputQuantity'],
                                'nbD' => $snowLocationRequest['inputDays']
                            );
                            $_SESSION['cart'] = array();
                            array_push($_SESSION['cart'], $cartArrayTemp);
                            $_GET['action'] = "displayCart";
                            require "view/cart.php";
                        }//End else
                    } else { //Qty too high
                        $snowsResults = getASnow($snowCode);
                        $_GET['action'] = 'snowLeasingRequest';
                        $_GET['code'] = $snowCode;
                        $_GET['qty'] = true;
                        require "view/snowLeasingRequest.php";
                    }
                } else { //nbDays too low
                    $snowsResults = getASnow($snowCode);
                    $_GET['action'] = 'snowLeasingRequest';
                    $_GET['code'] = $snowCode;
                    $_GET['days'] = true;
                    require "view/snowLeasingRequest.php";
                }
            } else { //Qty too low
                $snowsResults = getASnow($snowCode);
                $_GET['action'] = 'snowLeasingRequest';
                $_GET['code'] = $snowCode;
                $_GET['qty'] = true;
                require "view/snowLeasingRequest.php";
            }
        } else { //Qty too high in cart + in request
            $snowsResults = getASnow($snowCode);
            $_GET['action'] = 'snowLeasingRequest';
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

/**
 * This function is designed to redirect the user to the leasing request form
 * @param $snowCode - Snow ID
 */
function snowLeasingRequest($snowCode){
    if(isset($_SESSION['userEmailAddress'])){
        require "model/snowsManager.php";
        $snowsResults = getASnow($snowCode);
        $_GET['action'] = "snowLeasingRequest";
        require "view/snowLeasingRequest.php";
    } else {
        $_GET['action'] = "login";
        $_GET['notlog'] = TRUE;
        require "view/login.php";
    }
}

/**
 * This function is designed to empty the user cart
 * @param -
 */
function emptyCart(){
    $_SESSION['cart'] = array();
    require "view/snows.php";
}
