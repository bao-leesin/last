<?php

require_once('./../dao/dbhelper.php');
require_once('./../shared/config.php');

session_start();

$account_id = $_SESSION[S_ACCOUNT_ID];
$loginId = $_SESSION[S_USERNAME];

if (isset($loginId) && isset($account_id)) {
  $cartRow = getCart($loginId, $account_id);
  $cartId = $cartRow[0]['id'];
}
if (isset($_POST['check_coupon'])) {
  $ma_giam_gia = $_POST['coupon'];
}

$chosen = $_POST['chose'];

if ($chosen == "momo") {
  header("location: ./momo.php");
}
else{
  header("location:./delivering.php");
}




?>

<head>
  <link rel="stylesheet" href="./payment.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-latest.pack.js"></script>
  <script src="../js/slide_pay.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<script type="text/javascript">
  function check_coupon(total, coupon, ship) {
    $.get('check_coupon.php', {
        'total': total,
        'coupon': coupon,
        'ship': ship
      },
      function(data) {
        console.log(total);
      }
    );
  }
</script>


<div class="container">

  <div class="arrow-steps clearfix">
    <div class="step current"> <span> <a href="payment.php">Thanh toán</a></span> </div>
    <div class="step"> <span><a href="delivering.php">Đang giao</a></span> </div>
    <div class="step"> <span><a href="finished.php">Đã hoàn thành</a><span> </div>
  </div>

  <div class="mt-3"></div>

  <form action="" method="POST" enctype="application/x-www-form-urlencoded">
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



        <div class="mt-3">
          <input type="text" name="coupon" id="coupon" placeholder="Nhập mã giảm giá">

          <button class="btn btn-default" name="check_coupon" onclick="check_coupon($tong_tien,$van_chuyen,$ma_giam_gia)"> Áp dụng</button>
        </div>

        <style type="text/css">
          .thanhtoan .form-check {
            margin: 11px;
          }
        </style>





        <div class="thanhtoan">

          <h4>Phương thức thanh toán</h4>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="chose" id="cash" value="cash" checked>
            <img src="./../images/cash.png" height="32" width="32">
            <label class="form-check-label" for="cash">
              Tiền mặt
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="chose" id="bank" value="bank">
            <img src="./../images/bank.png" height="32" width="32">
            <label class="form-check-label" for="bank">
              Chuyển khoản
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="chose" id="momo" value="momo">
            <img src="./../images/Momo.png " height="32" width="32">
            <label class="form-check-label" for="momo">
              Ví Momo
            </label>
          </div>

          <input type="submit" name="thanhtoan" value="Thanh toán" class="btn btn-danger">

          <button class="btn btn-primary" onclick="location.href='/webBook/index.php'">QUAY LẠI</button>

        </div>
      </div>
      <div class="col-md-1"></div>

      <!-- Hiện thông tin các quyển sách sẽ mua và tổng tiền -->

      <div class="col-md-5 ">
        <h4>Thông tin đơn hàng</h4>
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

        <table style="width: 100% ; text-align: center;border-collapse: collapse;" cellpadding="10">
          <tr>

            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Thành tiền</th>

          </tr>

          <?php

          $tong_tien = 0;
          $van_chuyen = 30000;
          foreach (getLineItemsInCart($cartId) as $lineItem) {

            $ten_san_pham = $lineItem['name'];
            $hinh_anh = $lineItem['image'];
            $so_luong = $lineItem['quantity'];
            $gia = $lineItem['price'];
            $thanh_tien = $gia * $so_luong;
            $tong_tien += $thanh_tien;




          ?>

            <tr>
              <td><?php echo $ten_san_pham  ?></td>
              <td><img src="<?php echo $hinh_anh  ?>" width="100px" /> </td>
              <td><?php echo number_format($so_luong, 0, ',', '.')  ?></td>
              <td><?php echo  number_format($gia, 0, ',', '.')  . ' vnđ' ?></td>
              <td><?php echo  number_format($thanh_tien, 0, ',', '.')  . ' vnđ'  ?> </td>
            </tr>

          <?php
          }
          $total = $tong_tien + $van_chuyen;

          $_SESSION['total'] = $total;

          if (isset($_POST['thanhtoan'])) {

            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $note = $_POST['note'];
          
            insert_orders($fullname, $phone, $address, $note, $account_id, $cartId);
            insert_payment($account_id, $chosen, $total);

            
          }

          ?>

          <tr>
            <th>Chi phí vận chuyển</th>
            <td colspan="4"><?php echo  number_format($van_chuyen, 0, ',', '.')  . ' vnđ' ?></td>
          </tr>

          <tr>
            <th>Tổng tiền thanh toán</th>
            <td colspan="4"><?php echo  number_format($total, 0, ',', '.')  . ' vnđ' ?></td>
          </tr>



        </table>
      </div>

    </div>
  </form>
</div>
</div>

<?php


?>