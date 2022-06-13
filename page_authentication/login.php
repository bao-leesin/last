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
    
    <title>Bookbook</title>
</head>
<body>
    <div id="wrapper">
        <form method="post" id="form-login" action="login_action.php">
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

        <div class="form-group">
        <a href="register.php"><button class="btn btn-warning" type="button">Đăng ký</button></a>
        </div>

        <div class="form-group">
        <a href="forgotpwd.php"><button class="btn btn-danger" type="button">Quên mật khẩu?</button></a>
        </div>
        </form>
     
    </div>
   
    
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/app.js"></script>
</html>
