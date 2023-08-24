<?php
function add(array &$cart,int $id,int $qty,$con){
    if($qty == 0 || $id == 0){
        return;
    }
    if(isset($cart['products'][$id])){
        $cart['products'][$id]['qty'] += $qty;
        $cart['total'] += $qty *  $cart['products'][$id]['price'];
        return;
    }
    $product = $con->query('Select * from inventeries where id='.$id)->fetch_assoc();
    if(empty($product)){
        return;
    }
    $cart['products'][$id] = [
        'id' => $id,
        'qty' => $qty,
        'price' => $product['price'],
        'medicine_name' => $product['medicine_name']
    ];
    $cart['total'] += $qty * $cart['products'][$id]['price'];
}


function removeFromCart(array &$cart,int $id){
    if(!isset($cart['products'][$id])){
        return;
    }   
    unset($cart['products'][$id]);
}
function resetCart(array &$cart){
    $cart = [
        'products' => [],
        'total' => 0,
        'count' => 0
    ]; 
}
function checkout(array &$cart,$con){
    $productsIds = array_keys($cart['products']);
    $totalItems = 0;
    foreach ($productsIds as $pId) {
        $con->query("UPDATE inventeries set quantity = quantity-{$cart['products'][$pId]['qty']} where id={$pId}");
        $totalItems += $cart['products'][$pId]['qty'];
    }
    $con->query("INSERT INTO sold(item,amount,userId,date) values ({$totalItems},{$cart['total']},{$_SESSION['userId']},now())");
    resetCart($cart);

}


function initCart(array &$session){
    $session['cart'] = [
        'products' => [],
        'total' => 0,
        'count' => 0
    ];    
}
function checkCart(array &$session){
    return isset($session['cart']);
}
function updateQuantity(array &$cart,int $id,int $qty){
    if(!isset($cart['products'][$id])){
        return;
    }
    $cart['total'] -= $cart['products'][$id]['qty'] * $cart['products'][$id]['price'];
    $cart['products'][$id]['qty'] = $qty;
    $cart['total'] = $qty * $cart['products'][$id]['price'];
}