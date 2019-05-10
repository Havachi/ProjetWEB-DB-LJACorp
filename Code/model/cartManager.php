<?php
/**
 * Author   : nicolas.glassey@cpnv.ch
 * Project  : 151_2019_code
 * Created  : 04.04.2019 - 18:48
 *
 * Last update :    [01.12.2018 author]
 *                  [add $logName in function setFullPath]
 * Git source  :    [link]
 */

/**
 * This function update the cart simply enough
 * @param $currentCartArray
 * @param $snowCodeToAdd
 * @param $qtyOfSnowsToAdd
 * @param $howManyLeasingDays
 * @return array
 */
function updateCart($currentCartArray, $snowCodeToAdd, $qtyOfSnowsToAdd, $howManyLeasingDays){
    $cartUpdated = array();
    if($currentCartArray != null){
        $cartUpdated = $currentCartArray;
    }
    foreach($cartUpdated as $cart){
        if($cart['code']==$snowCodeToAdd){
            if ($cart['nbD']){
                //unset($cart); not sure about dat
                $qtyOfSnowsToAdd = $qtyOfSnowsToAdd + $cart['qty'];
            }
        }
    }
    $newSnowLeasing = array('code' => $snowCodeToAdd, 'dateD' => Date("d-m-y"), 'nbD' => $howManyLeasingDays, 'qty' => $qtyOfSnowsToAdd);
    array_push($cartUpdated, $newSnowLeasing);
    return $cartUpdated;
}

//in_array https://www.php.net/manual/en/function.in-array.php
//array_push() https://www.php.net/manual/en/function.array-push.php
//array_search
//unset
