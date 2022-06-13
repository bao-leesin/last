<?php 
require_once("./../dao/dbhelper.php");
require_once("./../shared/config.php");

if (!empty($_GET)) {
    if(isset($_GET[PARA_LINE_ITEM_ID])) {
        $lineItemId = $_GET[PARA_LINE_ITEM_ID];
        deleteItemFromCart($lineItemId);
        header('Location: ./cart.php');
    }
}
?>