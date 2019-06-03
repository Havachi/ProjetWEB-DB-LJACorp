<?php
/**
 *|File Info|
 *
 *  *~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*
 *  | Author   : Alessandro Rossi                                                        |
 *  | Project  : ProjetWEB-DB-LJACorp                                                    |
 *  | Created  : 04.04.2019 - 18:48                                                      |
 *  |                                                                                    |
 *  | Last update :    [27.05.2019 Louis Richard]                                        |
 *  |                                                                                    |
 *  | Git source  :    [https://github.com/Havachi/ProjetWEB-DB-LJACorp]                 |
 *  *~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*
 */


/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This code return the Quantity of a snow in the cart
 * @param $currentCartArray
 * @param $snowCode
 * @return int
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function getSnowQtyInCart($currentCartArray, $snowCode)
{
    foreach ($currentCartArray as $key => $cart) {
        if ($snowCode == $cart['code']) {
            $snowQty = $cart['qty'];
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
