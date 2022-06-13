<?php 
include_once('db_conn.php');
$product = mysqli_query($conn, "SELECT *FROM products");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="admin_style.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
  
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <img src="" style="height:70px"></div>
    </div>
</nav>
  
<div class="container-fluid text-left">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
        <ul class ="nav nav-pills nav-stacked " style="padding-left:20px">
            <p><a href = "http://localhost/xampp/new/admin_home.php"><i class = "glyphicon glyphicon-list-alt"></i>Quản lý mặt hàng</a></p>
            <p><a href = "http://localhost/xampp/new/admin_add.php"><i class = "glyphicon glyphicon-plus"></i>Thêm sản phẩm</a></p>
            <p><a href = "#"><i class = "glyphicon glyphicon-comment"></i>Chat</a></p>
            <p><a href = "http://localhost/xampp/new/webBook-main/"><i class = "glyphicon glyphicon-log-out"></i>Đăng xuất</a></p>
        </ul>
    </div>
    <div class="col-sm-10 text-left"> 
        <h3><strong style="margin-left:450px;">Quản lý mặt hàng</strong></h3>

    <table class="table table-borderd" id ="my-table">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <!-- <th>Mã sản phẩm</th> -->
                                    <th>Giá(VND)</th>
                                    <!-- <th>Giá khuyến mãi</th> -->
                                    <th>Số lượng</th>
                                    <th>Nhà cung cấp</th>
                                    <th>Trạng thái</th>   
                                </tr>
                            </thead>
                        <tbody>
                        <?php foreach ($product as $key => $value){ ?>
                            <tr>
                                <td><?php echo $value['NameProduct'] ?></td>
                                <!-- <td><?php echo $value['Code'] ?></td> -->
                                <td><?php echo $value['Price'] ?></td>
                                <!-- <td><?php echo $value['Price1'] ?></td> -->
                                <td><?php echo $value['Amount'] ?></td>
                                <td><?php echo $value['Type'] ?></td>
                                <td> &nbsp;<a href="read_product.php?ID=<?php echo $value['ID']; ?>"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;
                                 
                                 <a href="delete_product.php?ID=<?php echo $value['ID']; ?>"><span class="glyphicon glyphicon-trash"></span></td>
                                <!-- <td><img src="uploads/<?php echo $value['image'] ?>" alt="" width="100"></td> -->
                            </tr>
                        <?php } ?>
                        </tbody>
                        </table>
                        <script>
                                                    $(document).ready( function () {
    $('#my-table').DataTable();
} );
                            </script>

    </div>

  </div>
</div>

<!-- Chân trang -->
<hr>
<footer class="container-fluid ">
<div class="row">
        <div class = "col-sm-2">
            <img src="im1.PNG" style="height:70px;width:150px; margin-left:40px">
        </div>
    <div class = "col-sm-5 bg-white">
        <strong>CÔNG TY CỔ PHẦN THƯƠNG MẠI DỊCH VỤ MÊ KÔNG COM</strong><br>
        <p>Địa chỉ: 52/2 Thoại Ngọc Hầu, Phường Hòa Thạnh, Quận Tân Phú, Hồ Chí Minh<br>
        MST: 0303615027 do Sở Kế Hoạch Và Đầu Tư Tp.HCM cấp ngày 10/03/2011<br>
        Tel: 028.73008182 - Fax: 028.39733234 - Email: hotro@vinabook.com</p>
    </div>
    <div class="col-sm-2 " style="margin-top:0px">
        <table cellpadding="2" cellspacing="5">
            <tbody>
                <tr>
                    <td colspan ="2"><strong>Chấp nhận thanh toán</td><strong></tr>
                    <tr><td><img src ="payoo.jpg" style = "width:60px;height:40px; padding-top:10px"></td>
                    <td><img src ="visa.png" style = "width:50px;height:30px;padding-top:10px"></td> </tr>
            </tbody>
        </table>
    </div>
    <div class = "col-sm-3 bg-white margin-right" >
        <table >
            <tbody>
                <tr>
                    <td colspan ="2"><strong>Đối tác bán hàng</td><strong></tr>
                    <tr><td><img src ="lazada.jpg" style = "width:60px;height:40px; padding-top:10px; "></td>
                    <td><img src ="amazon.png" style = "width:70px;height:40px; padding-top:10px; padding-left:10px"></td>
                    <td><img src ="shopee.png" style = "width:70px;height:50px;padding-top:10px;padding-left:10px; margin-right:10px"></td> </tr>
            </tbody>
        </table>
    </div>
    </div>
  
</footer>

</body>
</html>
