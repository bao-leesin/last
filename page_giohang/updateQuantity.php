<?php 
require_once("./../dao/dbhelper.php");
require_once("./../shared/config.php");

if (!empty($_GET)) {
    if(isset($_GET[PARA_INCREMENT]) && isset($_GET[PARA_LINE_ITEM_ID])) {
        $increment = $_GET[PARA_INCREMENT]; // 1 - tăng, -1 - giảm
        $lineItemId = $_GET[PARA_LINE_ITEM_ID];
        if($increment == 1) {
            increaseQuantity($lineItemId);
            header('Location: ./cart.php');
        }
        else {
            decreaseQuantity($lineItemId);
            header('Location: ./cart.php');
        }   
    }
}
?>