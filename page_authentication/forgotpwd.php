<?php
require_once('dbhelper.php');
$err="";
if (!empty($_POST)){
print_r($_POST);
$email = $_POST['email'];
$email = str_replace('\'', '\\\'', $email);
$sql = "SELECT * FROM user WHERE email = '".$email."' ;";
$data = executeResult($sql);
if($data == null){
$err="Tài khoản không tồn tại";
}
else{
echo $token =  substr( md5(rand(0,999)),0,5) ;
echo "<br/>";

$sql = "UPDATE user SET token = '".$token."' WHERE email = '".$email."' ";
execute($sql);

$kq= guiMail($email,$token);
if($kq == true){
    echo "<script> document.location = 'changedpwd.php' </script>";
}

}
}
?>

<?php
function guiMail($email,$token){
require "PHPMailer-master/src/PHPMailer.php"; 
require "PHPMailer-master/src/SMTP.php"; 
require 'PHPMailer-master/src/Exception.php'; 
$mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
try {
    $mail->SMTPDebug = 0; //0,1,2: chế độ debug
    $mail->isSMTP();  
    $mail->CharSet  = "utf-8";
    $mail->Host = 'smtp.gmail.com';  //SMTP servers
    $mail->SMTPAuth = true; // Enable authentication
    $mail->Username = 'haduytuanbao2@gmail.com'; // SMTP username
    $mail->Password = '01648549158';   // SMTP password
    $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
    $mail->Port = 465;  // port to connect to                
    $mail->setFrom('haduytuanbao2@gmail.com', 'Tên người gửi' ); 
    $mail->addAddress($email, 'TênNgườiNhận'); 
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = 'Tiêu đề thư';
    $noidung = "Mã {$token}";
    $mail->Body = $noidung;
    $mail->smtpConnect( array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    ));
    $mail->send();
    echo 'Đã gửi mail xong';
    return true;
} catch (Exception $e) {
    echo 'Error: ', $mail->ErrorInfo;
    return false;
}
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<form method="post" style = "width:600px;" class="border border-primary border-2 m-auto p-2">
<h4 class="mb-3 text-center" >
  
    QUÊN MẬT KHẨU
  
</h4>

  <?php if( $err != "") { ?>
  <div class="alert alert-danger">
    <?= $err?>
  </div>
  <?php } ?>

  <div class="mb-3">
    <label for="email" class="form-label">Nhập Email: </label>
    <input  type="email" value=" <?php if (isset($email) == true) echo $email ?>" class="form-control" id="email" name = "email">

    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  
 
  <button type="submit" name="guiyeucau" value="đã gửi" class="btn btn-primary">Gửi yêu cầu</button>
  <a href="login.php"> <button class="btn btn-danger" type="button"> Quay lại </button> </a>
</form>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>