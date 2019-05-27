<?php
/**
 *|File Info|
 *
 *  *~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*
 *  | Author   : Alessandro Rossi                                                        |
 *  | Project  : ProjetWEB-DB-LJACorp                                                    |
 *  | Created  : 04.04.2019 - 8:40                                                       |
 *  |                                                                                    |
 *  | Last update :    27.05.2019                                                        |
 *  |                                                                                    |
 *  | Git source  :    [https://github.com/Havachi/ProjetWEB-DB-LJACorp]                 |
 *  *~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*
 */


/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function add a new item in the cart
 * @param $currentCartArray : The full cart array before adding the new leasing
 * @param $snowCodeToAdd : The unique code of the snow to add
 * @param $qtyOfSnowsToAdd : The quantity of snow that the customer choose
 * @param $howManyLeasingDays : The number of day of leasing that the customer choose
 * @return array : The full cart after adding the new leasing
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function updateCart($currentCartArray, $snowCodeToAdd, $qtyOfSnowsToAdd, $howManyLeasingDays)
{
    require_once "model/snowsManager.php";
    $stockQty = getSnowQty($snowCodeToAdd);
    $inCartQty = getSnowQtyInCart($currentCartArray,$snowCodeToAdd);

    if ($inCartQty + $qtyOfSnowsToAdd < $stockQty) {
        //Doesn't let the user user value under 1
        if ($qtyOfSnowsToAdd > 0) {
            if ($howManyLeasingDays > 0) {
                if ($stockQty > $qtyOfSnowsToAdd) {
                    $alreadyExist = false;
                    $cartUpdated = array();
                    if ($currentCartArray != null) {
                        $cartUpdated = $currentCartArray;
                    }//Verification if the code and leasing days are the some on one of every item in cart
                    foreach ($currentCartArray as $key => &$cart) {
                        if ($snowCodeToAdd == $cart['code']) {
                            if ($howManyLeasingDays == $cart['nbD']) {
                                $tempqty = $cart['qty'];
                                $cart['qty'] = $tempqty + $qtyOfSnowsToAdd;
                                $alreadyExist = true;

                            }
                        }
                    }
                    if (!$alreadyExist) {
                        $newSnowLeasing = array('code' => $snowCodeToAdd, 'dateD' => Date("d-m-y"), 'qty' => $qtyOfSnowsToAdd, 'nbD' => $howManyLeasingDays);
                        array_push($cartUpdated, $newSnowLeasing);
                    } else {
                        $cartUpdated = $currentCartArray;
                    }
                    return $cartUpdated;
                } else {
                    //error message
                    $error = "E110";
                    return $error;
                }
            } else {
                //error message
                $error = "E111";
                return $error;
            }
        } else {
            //error message
            $error = "E112";
            return $error;
        }
    } else {
        //error message
        $error = "E113";
        return $error;
    }
}

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
