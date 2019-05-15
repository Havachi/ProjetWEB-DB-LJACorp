<?php
require "cartManager.php";

$snowCode = "B101";
echo getSnowQtyInCart($_SESSION['cart'],$snowCode);