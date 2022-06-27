<?php
require_once('./../dao/dbhelper.php');
require_once('./../shared/config.php');

if(isset($_GET[['total']])) {

$tong_tien = $_GET['total']; 
$ma_giam_gia = $_GET['coupon'];
$van_chuyen = $_GET['ship'];

$sql = "SELECT SALE FROM coupon WHERE coupon code = '$ma_giam_gia' ";
$data= executeResult($sql);
$list = $data[0];

if($ma_giam_gia == "freeship"){
$van_chuyen = 0;
}

$tong_tien -= $tong_tien*$list;

}