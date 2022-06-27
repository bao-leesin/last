<?php
require_once('./../dao/dbhelper.php');
require_once('./../shared/config.php');

session_start();
$account_id = $fullname = $phone = $address = $note = "";
$account_id = $_SESSION[S_ACCOUNT_ID];
$loginId = $_SESSION[S_USERNAME];

if(isset($loginId) && isset($account_id)) {
  $cartRow = getCart($loginId, $account_id);
  $cartId = $cartRow[0]['id'];
 
}


?>

<head>
    <link rel="stylesheet" href="./payment.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<div class="container">
<div class="row">
  <div class="col-sm-10 arrow-steps clearfix">
    <div class="step done"> <span> <a href="payment.php" >Thanh toán</a></span> </div>
    <div class="step current"> <span><a href="delivering.php" >Đang giao</a></span> </div>
    <div class="step"> <span><a href="finished.php" >Đã hoàn thành</a><span> </div>
  </div>

  <div class="col-sm-2" >
  <button class="btn btn-primary" onclick="location.href='/webBook/index.php'">Trang chủ</button>
  </div>

  </div>

  <div class="mt-3"></div>

<div>

    

    <?php
  foreach (get_order_delivering($account_id) as $order) {
    $order_id = $order['id'];
    $detail  = $order['details'];
    $total = $order['total'];
    $fullname = $order['fullname'];
    $phone = $order['phone'];
    $address = $order['address'];
    $note = $order['note'];
  ?>
  <div style="padding: 20px;">
<h4>Thông tin đơn số <?php echo $order_id ?></h4>
    <ul>
        <li>Họ và tên người nhận : <b> <?php echo $fullname ?></b></li>
        <li>Số điện thoại : <b> <?php echo $phone ?> </b></li>
        <li>Địa chỉ : <b> <?php echo $address ?> </b> </li>
        <li>Ghi chú : <b> <?php echo $note ?></b></li>
      </ul>
     
      
      <style type="text/css">
          table,
          th {
            border-collapse: separate;
            border: 1px solid #999;
          }
          td {
            border-collapse: separate;
            border: 1px solid #999;
          }
        </style>

       
          
        
        <table style="width: 100% ; text-align: center;border-collapse: collapse;" cellpadding = "10">
       
          <tr>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Thành tiền</th>
            
          </tr>
      
          <?php 

          $tong_tien=0;
          foreach(get_lineItem_delivering($cartId,$order_id) as $lineItem) {

             $ten_san_pham = $lineItem['name'];
             $hinh_anh = $lineItem['image'];
             $so_luong = $lineItem['quantity'];
             $gia = $lineItem['price'];
             $thanh_tien = $gia * $so_luong;
          
             ?>
          <tr>
            
            <td><?php echo $ten_san_pham  ?></td>
            <td><img src= "<?php echo $hinh_anh  ?>" width="100px" /> </td>
            <td><?php echo number_format($so_luong,0,',','.')  ?></td>
            <td><?php echo  number_format($gia,0,',','.')  .' vnđ' ?></td>          
            <td><?php echo  number_format($thanh_tien,0,',','.')  .' vnđ'  ?></td>
          </tr>
        
          <?php 
          }
          ?>

          <tr> 
          <th>Phương thức thanh toán</th> 
          <td colspan="4">
          <?php
          if($detail == "momo"){
            echo $thanh_toan = "Ví momo";
          }
          elseif($detail == "bank"){
            echo $thanh_toan = "Chuyển khoản ngân hàng";
          }
          else{
            echo $thanh_toan = "Tiền mặt";
          }
          ?>
          </td>
          </tr>

          <tr><th>Tổng tiền</th> 
           <th colspan="4">
            <?php 
           echo number_format($total,0,',','.')  .' vnđ'
           ?>
           </th>
        </tr>
          
        </table>
        </div>
          <?php
  }
          ?>
  
  </div>


<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="../js/slide_pay.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>