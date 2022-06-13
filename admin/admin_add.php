<?php
include_once('db_conn.php');	
if(isset($_POST["saveproduct"])){
  $NameProduct = $_POST['NameProduct'];
  $Type = $_POST['Type'];
  $Code = $_POST['Code'];
  $Tag = $_POST['Tag'];
  $Price = $_POST['Price'];
  $Price1 = $_POST['Price1'];
  $Amount = $_POST['Amount'];
  $Description = $_POST['Description'];
  if(isset($_FILES['image'])){
    $file = $_FILES['image'];
    $file_name = $file['name'];
    move_uploaded_file($file['tmp_name'],'uploads/'.$file_name);
  }
 $sql = "INSERT INTO products(NameProduct, Code, Price, Price1, Amount, Description,Type,Tag,image) VALUES('$NameProduct', '$Code','$Price', '$Price1','$Amount','$Description','$Type','$Tag','$file_name')";
 $query = mysqli_query($conn,$sql);
 if(query){
   header('location: admin_home.php');
 }
 else{echo"Errrors";}
}

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
            <p><a href = "http://localhost/xampp/new/admin_home.php""><i class = "glyphicon glyphicon-list-alt"></i>Quản lý mặt hàng</a></p>
            <p><a href = "http://localhost/xampp/new/admin_add.php"><i class = "glyphicon glyphicon-plus"></i>Thêm sản phẩm</a></p>
            <p><a href = "#"><i class = "glyphicon glyphicon-comment"></i>Chat</a></p>
            <p><a href = "http://localhost/xampp/new/webBook-main/"><i class = "glyphicon glyphicon-log-out"></i>Đăng xuất</a></p>
        </ul>
    </div>
    
    <div class="col-sm-10 "> 
    <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <h3><strong style="margin-left:450px;">Thêm sản phẩm</strong></h3>
              <br>
              <label class="control-label col-sm-2" for="email" style="text-align:left">Tên sản phẩm</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" name="NameProduct" id="NameProduct" placeholder="Nhập tên sản phẩm">
                </div>
    
              <label class="control-label col-sm-2" for="pl" style="text-align:left">Nhà cung cấp</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" name="Type" id="Type" placeholder="Nhập nhà cung cấp">
                </div>
    
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="msp" style="text-align:left">Mã sản phẩm</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="Code" id="Code" placeholder="Nhập mã sản phẩm">
                  </div>
                <!-- <label class="control-label col-sm-2" for="nhan" style="text-align:left">Nhãn của sản phẩm</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="Tag" id="Tag" placeholder="Nhãn của sản phẩm">
                  </div> -->
                  <label class="control-label col-sm-2" for="mt" style="text-align:left">Mô tả:</label>
                <div class="col-sm-3">
                  <textarea class="form-control" rows="1" name="Description" id="Description" placeholder="Mô tả sản phẩm"></textarea>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="gia" style="text-align:left">Giá bán</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control" name="Price" id="Price" placeholder="Nhập giá bán">
                </div>
                <label class="control-label col-sm-2" for="" style="text-align:left"></label>
                <div class="col-sm-3">
                  <button class="btn btn-danger" id="huy" >Hủy</button>
                  <button class="btn btn-success" name="saveproduct" style="margin-left:139px">Lưu</button>
                </div>
                
            </div>
            <div class="form-group">
              <!-- <label class="control-label col-sm-2" for="giakm" style="text-align:left">Giá khuyến mãi</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control" name="Price1" id="Price1" placeholder="Nhập giá khuyễn mãi">
                </div> -->
              
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="sl" style="text-align:left">Số lượng</label>
                <div class="col-sm-3">
                  <input type="sl" class="form-control" name="Amount" id="Amount" placeholder="Nhập số lượng">
                </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="anh" style="text-align:left">Ảnh sản phẩm</label>
                <div class="col-sm-3">
                  <input type="file" accept="image/png, image/jpg,image/jpeg" name="image" id="image" class ="box">
                </div>
              
            </div>
          </form>
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
