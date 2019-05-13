<?php
/**
 * Author   : nicolas.glassey@cpnv.ch
 * Project  : 151_2019_code
 * Created  : 04.04.2019 - 18:48
 *
 * Last update :    [01.12.2018 Alessandro Rossi]
 *
 * Git source  :    [link]
 */

/**
 * This function add a new item in the cart
 * @param $currentCartArray : The full cart array before adding the new leasing
 * @param $snowCodeToAdd : The unique code of the snow to add
 * @param $qtyOfSnowsToAdd : The quantity of snow that the customer choose
 * @param $howManyLeasingDays : The number of day of leasing that the customer choose
 * @return array : The full cart after adding the new leasing
 */

function updateCart($currentCartArray, $snowCodeToAdd, $qtyOfSnowsToAdd, $howManyLeasingDays)
{
    //Doesn't let the user user value under 1
    if ($qtyOfSnowsToAdd > 0 and $howManyLeasingDays > 0) {
        $alreadyExist = false;
        $cartUpdated = array();
        if ($currentCartArray != null) {
            $cartUpdated = $currentCartArray;
        }
        //Verification if the code and leasing days are the some on one of every item in cart
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
        echo "Quantité trop élevée ou inférieure à 1, Vérifiez la disponibilité du stock";
        return false;
    }
}

//in_array https://www.php.net/manual/en/function.in-array.php
//array_push() https://www.php.net/manual/en/function.array-push.php
//array_search
//unset

