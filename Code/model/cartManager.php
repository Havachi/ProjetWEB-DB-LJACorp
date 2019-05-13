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
 * This function add a new item in the cart
 * @param $currentCartArray
 * @param $snowCodeToAdd
 * @param $qtyOfSnowsToAdd
 * @param $howManyLeasingDays
 * @return array
 */

function updateCart($currentCartArray, $snowCodeToAdd, $qtyOfSnowsToAdd, $howManyLeasingDays){
    //reset the Updated Cart
    $alreadyExist=false;
    $cartUpdated = array();
    if($currentCartArray != null){
        $cartUpdated = $currentCartArray;
    }
    foreach ($currentCartArray as $key => &$cart){
        if($snowCodeToAdd == $cart['code']){
            if ($howManyLeasingDays == $cart['nbD']){
                $tempqty = $cart['qty'];
                $cart['qty'] = $tempqty + $qtyOfSnowsToAdd;
                $alreadyExist=true;

            }
        }
    }
    if(!$alreadyExist){
        $newSnowLeasing = array('code' => $snowCodeToAdd, 'dateD' => Date("d-m-y"), 'qty' => $qtyOfSnowsToAdd, 'nbD' => $howManyLeasingDays);
        array_push($cartUpdated, $newSnowLeasing);
    }else{
        $cartUpdated = $currentCartArray;
    }
    return $cartUpdated;
}

//in_array https://www.php.net/manual/en/function.in-array.php
//array_push() https://www.php.net/manual/en/function.array-push.php
//array_search
//unset

