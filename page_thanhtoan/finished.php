<?php
require_once('../dbhelper.php');
$ten_khach_hang = $ten_san_pham = $gia = $ngay_nhan = "";
$list = getList_payment();
?>
<head>
    <link rel="stylesheet" href="./payment.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<div class="container">
 
  <div class="arrow-steps clearfix">
    <div class="step done"> <span> <a href="payment.php" >Thanh toán</a></span> </div>
    <div class="step done "> <span><a href="delivering.php" >Đang giao</a></span> </div>
    <div class="step current"> <span><a href="finished.php" >Đã hoàn thành</a><span> </div>
  </div>
  <h3>Lịch sử đơn hàng</h3>

  <table style="width: 100%; text-align: center; border-collapse: collapse;">
          <tr>
            <th>Tên người nhận</th>
            <th>Tên sản phẩm</th>
            <th>Giá sản phẩm</th>
            <th>Ngày nhận</th>
          </tr>

          <tr>
           
            <td><?php echo $ten_khach_hang  ?></td>
            <td><?php echo $ten_san_pham ?></td>
            <td><?php echo  number_format($gia,0,',','.')  .' vnđ' ?></td>
            <td><?php echo $ngay_nhan ?></td>          
            
          </tr>
        
           


        </table>


</div>



<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="../js/slide_pay.js"></script>
