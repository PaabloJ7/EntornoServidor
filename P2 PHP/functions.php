<?php

function Calculate_Total_Product_Price($quantity, $price, &$total) {
    $total = $quantity * $price;
}

function Calculate_Total_Purchase_Price($purchases) {
    $totalPurchase = 0;
    foreach ($purchases as $item) {
        $totalPurchase += $item['quantity'] * $item['price'];
    }
    return $totalPurchase;
}


?>
