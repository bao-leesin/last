<?php
require_once ('./../dao/dbhelper.php');
$s_username = $s_password = '';

if (!empty($_GET)) {
	$s_id = '';

	if (isset($_GET['username'])) {
		$s_username = $_GET['username'];
	}

	if (isset($_GET['password'])) {
		$s_password = $_GET['password'];
	}

    $s_username = str_replace('\'', '\\\'', $s_username);
	$s_password      = str_replace('\'', '\\\'', $s_password);
    $sql="SELECT * FROM user WHERE fullname = '".$s_username."' OR email = '".$s_username."' AND password = '".$s_password."'";
    $data = executeResult($sql);
    $sql1="SELECT *FROM admin";
    $data1 = executeResult($sql1);
    if($data != null ){
        header('Location: \admin\admin_home.php');
    }
    else if($data1 != null){
        header('Location: admin_home.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../css/reset.css">
    <link rel="stylesheet" href="./../css/login.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Bookbook</title>
</head>
<body>
    <div id="wrapper">
        <form method="get"  id="form-login">
            <h1 class="form-heading">Form đăng nhập</h1>
            <div class="form-group">
                <i class="far fa-user"></i>
                <input type="text" class="form-input" id="username" name="username" placeholder="Tên đăng nhập">
            </div>
            <div class="form-group">
                <i class="fas fa-key"></i>
                <input type="password" class="form-input" id="password" name="password" placeholder="Mật khẩu">
                <div id="eye">
                    <i class="far fa-eye"></i>
                </div>
            </div>
            <a href="home.php"><input type="submit" value="Đăng nhập" class="form-submit"></a>
         

			<a href="register.php"><button class="btn btn-warning" type="button">Đăng ký</button></a>
            <a href="forgotpwd.php"><button class="btn btn-danger" type="button">Quên mật khẩu?</button></a>
		
        </form>
        
    </div>
   
    
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="js/app.js"></script>
</html>
