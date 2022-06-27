<?php
require_once('./../dao/dbhelper.php');
require_once('./../shared/config.php');

session_start();

$account_id = $_SESSION[S_ACCOUNT_ID];


?>

<head>
  <link rel="stylesheet" href="./payment.css">
  <link rel="stylesheet" href="./finished.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<div class="container">
<div class="row">

  <div class="col-sm-10  arrow-steps clearfix">
    <div class="step done"> <span> <a href="payment.php">Thanh toán</a></span> </div>
    <div class="step done "> <span><a href="delivering.php">Đang giao</a></span> </div>
    <div class="step current"> <span><a href="finished.php">Đã hoàn thành</a><span> </div>
  </div>

  <div class="col-sm-2" >
  <button class="btn btn-primary" onclick="location.href='/webBook/index.php'">Trang chủ</button>
  </div>

</div>
  <div class="mt-3"></div>

  <h3 style="text-align: center ; padding: 25px;">Lịch sử đơn hàng</h3>

  <div class="mt-3"></div>
  <?php
  foreach (get_order_finished($account_id) as $order) {
    $order_id = $order['id'];
    $paid = $order['paid'];
    $total = $order['total'];
  ?>
    <div class="row">
      <div class="col-sm-6 p-2 mb-5 bg-light ">
        <style type="text/css">
          table,
          th {
            /* border-collapse: separate;
            border: 1px solid #999; */
            padding: 10px;

          }

          td {
            /* border-collapse: separate;
            border: 1px solid #999; */
            padding: 10px;
          }
        </style>

        <table>
          <?php
          foreach (get_lineItem_finish($account_id, $order_id) as $lineItem) {
            $ten_san_pham = $lineItem['name'];
            $hinh_anh = $lineItem['image'];
            $so_luong = $lineItem['quantity'];
          ?>


            <tr>
              <td><img src="<?php echo $hinh_anh ?>" width="80px" />
                x<?php echo $so_luong ?>
                <br>
                <b><?php echo $ten_san_pham ?></b>
              </td>
            </tr>

          <?php
          }
          ?>
        </table>
      </div>

      <div class="col-sm-6">
        <table>
        <tr>
            <button class="btn btn-danger" type="submit">Liên hệ</button>
          </tr>
          <tr>  
<th>Đơn hàng số</th>
          </tr>
          <tr>
            <th>Tổng số tiền</th>
            <td><?php echo  number_format($total, 0, ',', '.')  . ' vnđ'  ?></td>
          </tr>
         
        </table>
      </div>
    </div>
  <?php
  }
  ?>







  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="../js/slide_pay.js"></script>