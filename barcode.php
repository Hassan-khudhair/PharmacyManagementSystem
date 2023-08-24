<?php
session_start();

include "./assets/db.php";
include "cart.php";
if(!checkCart($_SESSION)){
    initCart($_SESSION);
}
if(isset($_POST['input'])){
$input=$_POST['input'];
$product = $con->query('Select * from inventeries where barcode='.$input)->fetch_assoc();
if(empty($product)){
    exit("Not found");
}
    add($_SESSION['cart'],$product['id'],1,$con);
}
if(isset($_POST['Qty']) && isset($_POST['p_id'])){
    updateQuantity($_SESSION['cart'],$_POST['p_id'],$_POST['Qty']);
}