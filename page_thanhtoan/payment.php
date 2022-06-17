<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

$odered= date('d/m/Y');
echo $odered;

require_once('../dao/dbhelper.php');
require_once('../shared/config.php');
session_start();

$account_id = $_SESSION[S_ACCOUNT_ID];
$loginId = $_SESSION[S_USERNAME];

if(isset($loginId) && isset($account_id)) {
  $cartRow = getCart($loginId, $account_id);
  $cartId = $cartRow[0]['id'];
 
}

if (isset($_POST['thanhtoan'])) {
  
  $fullname = $_POST['fullname'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $note = $_POST['note'];

  insert_shippingTable($fullname,$phone,$address,$note,$account_id,$tong_tien,$odered);


}


?>

<head>
  <link rel="stylesheet" href="./payment.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<div class="container">

  <div class="arrow-steps clearfix">
    <div class="step current"> <span> <a href="payment.php">Thanh toán</a></span> </div>
    <div class="step"> <span><a href="delivering.php">Đang giao</a></span> </div>
    <div class="step"> <span><a href="finished.php">Đã hoàn thành</a><span> </div>
  </div>

  <div class="mt-3"></div>

  <form action="delivering.php" method="POST">
    <div class="row">
      <div class="col-md-6">
<!-- 
Nhập thông tin đơn hàng -->
      
        <h4>Thông tin đơn hàng</h4>

        <div class="form-group">
          <label for="fullname"> Họ và tên </label>
          <input required="true" type="text" class="form-control" id="fullname" name="fullname">
        </div>
        <div class="form-group">
          <label for="phone"> Số điện thoại </label>
          <input required="true" type="text" class="form-control" id="phone" name="phone">
        </div>
        <div class="form-group">
          <label for="address"> Địa chỉ </label>
          <input required="true" type="text" class="form-control" id="address" name="address">
        </div>
        <div class="form-group">
          <label for="note"> Ghi chú </label>
          <input type="text" class="form-control" id="note" name="note">
        </div>

        <div class="mt-3"></div>

        <style type="text/css">
          .thanhtoan .form-check {
            margin: 11px;
          }
        </style>

        <div class="thanhtoan">

<!-- Click nút thanh toán để hoàn thành -->
        
          <h4>Phương thức thanh toán</h4>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="cash" value="   mat" checked>
            <img src="./../images/cash.png" height="32" width="32">
            <label class="form-check-label" for="cash">
              Tiền mặt
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="bank" value="chuyen khoan">
            <img src="./../images/bank.png" height="32" width="32">
            <label class="form-check-label" for="bank">
              Chuyển khoản
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="momo" value="momo">
            <img src="./../images/Momo.png " height="32" width="32">
            <label class="form-check-label" for="momo">
              Ví Momo
            </label>
          </div>

          <input type="submit" name="thanhtoan" value="Thanh toán" class="btn btn-danger">

          <button onclick="location.href='/webBook/index.php'">QUAY LẠI</button>

        </div>
      </div>
      <div class="col-md-1"></div>

<!-- Hiện thông tin các quyển sách sẽ mua và tổng tiền -->

      <div class="col-md-5 ">
        <h4>Sản phẩm</h4>
        <div class="mt-3"></div>
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

          foreach(getLineItemsInCart($cartId) as $lineItem) {    

             $ten_san_pham = $lineItem['name'];
             $hinh_anh = $lineItem['image'];
             $so_luong = $lineItem['quantity'];
             $gia = $lineItem['price'];
             $thanh_tien = $gia * $so_luong;
             $tong_tien += $thanh_tien; 

             ?>

          <tr>
            
            <td><?php echo $ten_san_pham  ?></td>
            <td><img src= "<?php echo $hinh_anh  ?>" width="100px" /> </td>
            <td><?php echo number_format($so_luong,0,',','.')  ?></td>
            <td><?php echo  number_format($gia,0,',','.')  .' vnđ' ?></td>          
            <td><?php echo  number_format($thanh_tien,0,',','.')  .' vnđ'  ?></td>

          </tr>
          <?php }?>

          <td>Tổng tiền thanh toán</td>
          <td colspan="4"><?php echo  number_format($tong_tien,0,',','.')  .' vnđ' ?></td>

          
        </table>
      </div>

    </div>
  </form>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="../js/slide_pay.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>