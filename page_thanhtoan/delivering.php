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

$sql = "SELECT * FROM shipping WHERE account_id = '$account_id'  ";
$data = executeResult($sql);

  $list = $data[0];

  $fullname = $list['fullname'];
  $phone = $list['phone'];
  $address = $list['address'];
  $note = $list['note'];


?>

<head>
    <link rel="stylesheet" href="./payment.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<div class="container">

  <div class="arrow-steps clearfix">
    <div class="step done"> <span> <a href="payment.php" >Thanh toán</a></span> </div>
    <div class="step current"> <span><a href="delivering.php" >Đang giao</a></span> </div>
    <div class="step"> <span><a href="finished.php" >Đã hoàn thành</a><span> </div>
  </div>

  <div class="mt-3"></div>
  
  <div class="row">
    <div class="col-md-12">

<!-- Hiện thông tin đơn hàng đã hoàn thành ở trang Thanh Toán -->

    <h4>Thông tin đơn hàng</h4>
    <ul>
        <li>Họ và tên người nhận : <b> <?php echo $fullname ?></b></li>
        <li>Số điện thoại : <b> <?php echo $phone ?> </b></li>
        <li>Địa chỉ : <b> <?php echo $address ?> </b> </li>
        <li>Ghi chú : <b> <?php echo $note ?></b></li>
      </ul>
      </div>
      
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

<!-- Lại hiện thông tin sản phẩm   -->

        <h4>Sản phẩm</h4>
        <table style="width: 100% ; text-align: center;border-collapse: collapse;" cellpadding = "10">
          <tr>
          
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Tổng tiền thanh toán</th>
          </tr>
      
          <?php 

          $tong_tien=0;
          foreach(getLineItemsInCart($cartId) as $lineItem) {           
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
        
          <?php }?>
        </table>

    </div>

  </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="../js/slide_pay.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>