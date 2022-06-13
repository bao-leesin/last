<?php
require_once ('./../dao/dbhelper.php');

$s_username = $s_password = $s_email = $s_phone = $s_address = '';

if (!empty($_POST)) {
	$s_id = '';

	if (isset($_POST['username'])) {
		$s_username = $_POST['username'];
	}

	if (isset($_POST['email'])) {
		$s_email = $_POST['email'];
	}

	if (isset($_POST['password'])) {
		$s_password = $_POST['password'];
	}

	if (isset($_POST['number'])) {
		$s_phone = $_POST['number'];
	}

	if (isset($_POST['address'])) {
		$s_address = $_POST['address'];
	}

	$s_username = str_replace('\'', '\\\'', $s_username);
	$s_password      = str_replace('\'', '\\\'', $s_password);
	$s_email = str_replace('\'', '\\\'', $s_email);
	$s_phone = str_replace('\'', '\\\'', $s_phone);
	$s_address  = str_replace('\'', '\\\'', $s_address);

	if(register($s_username,$s_password,$s_email,$s_phone,$s_address)) {
		header('Location: login.php');
	}
	else {
		echo "Failed";
	}
	die();
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Tạo tài khoản</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center"> Form đăng ký </h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
					  <label for="fullname">Tên đăng nhập:</label>
					  <input required="true" type="text" class="form-control" id="username" name="username" >
					</div>

					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" class="form-control" name="email" id="email" >
					</div>

					<div class="form-group">
					  <label for="password">Mật khẩu:</label>
					  <input type="password" class="form-control" name="password" id="password">
					</div>

					<div class="form-group">
					  <label for="number">Số điện thoại:</label>
					  <input type="number" class="form-control" id="number" name="number" >
					</div>
					
					<div class="form-group">
					  <label for="address">Địa chỉ:</label>
					  <input type="text" class="form-control" id="address" name="address">
					</div>
					<input class="btn btn-success" type="submit"></input>
					<a href="login.php"> <button class="btn btn-danger" type="button"> Back </button> </a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>