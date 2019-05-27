<?php
/**
 *|File Info|
 *~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-\
 * Author   : nicolas.glassey@cpnv.ch                                                 |
 * Project  : ProjetWEB+BD                                                            |
 * Created  : 04.04.2019 - 18:48                                                      |
 *                                                                                    |
 * Last update :    [15.05.2019 Alessandro Rossi]                                     |
 *                                                                                    |
 * Git source  :    [link]                                                            |
 *~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-/
 */



/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This code return the Quantity of a snow in the cart
 * @param $currentCartArray
 * @param $snowCode
 * @return int: if the $snowCode is valid and is present in the cart, return the quantity of snow
 * @return 0  : return 0 if the snow isn't in the cart of the snow code isn't valid.
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function getSnowQtyInCart($currentCartArray, $snowCode)
{
    foreach ($currentCartArray as $key => $cart) {
        if ($snowCode == $cart['code']) {
            $snowQty = $cart['Qty'];
        } else {
            $snowQty = 0;
        }
    }
    return $snowQty;
}




//in_array https://www.php.net/manual/en/function.in-array.php
//array_push() https://www.php.net/manual/en/function.array-push.php
//array_search
//unset
