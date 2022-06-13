<?php 
require_once("./../dao/dbhelper.php");
require_once("./../shared/config.php");
session_start();

if (!empty($_GET)) {
    if(isset($_GET[PARA_PRODUCT_ID]) && isset($_GET[PARA_PRICE])) {
        $productId = $_GET[PARA_PRODUCT_ID];
        $price = $_GET[PARA_PRICE];

        $loginId = $_SESSION[S_USERNAME];
        $accountId = $_SESSION[S_ACCOUNT_ID];
        if(isset($loginId) && isset($accountId)) {
            if(addProductToCart($loginId, $accountId, $productId, $price)) {
                header('Location: ./cart.php');
            }
            else {
    
            }
        }
        else {
            header('Location: ./../page_authentication/login.php');
            exit();
        }
    }
}
?>