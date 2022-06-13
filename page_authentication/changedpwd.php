<?php
require_once('dbhelper.php');
$token = $password = $err = "";
if($_POST != null){

if(isset($_POST['token'])){
  $token = $_POST['token'];
}

if(isset($_POST['password'])){
  $password = $_POST['password'];
}

$password = str_replace('\'', '\\\'', $password);
$token     = str_replace('\'', '\\\'', $token);

$sql = "SELECT * FROM user WHERE token = '".$token."' ; ";
$data = executeResult($sql);

if($data != null){

  $sql = "UPDATE user SET `password` = '".$password."' WHERE token = '".$token."' ";
  
  echo "<script> document.location = 'home.php' </script>";
}

else{
  $err = "Mã không chính xác";
}

}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<form action="" method="post">
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Mã kích hoạt</label>
  <input type="text" class="form-control" id="token" name = "token" placeholder="Nhập mã được gửi về email">
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Mật khẩu mới</label>
  <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">

  
</div>

<?php if( $err != "") { ?>
  <div class="alert alert-danger">
    <?= $err?>
  </div>
  <?php } ?>

    <button type="submit" name="send" class="btn btn-primary">
        Đổi mật khẩu
    </button>
</div>
</form>
