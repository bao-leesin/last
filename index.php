<?php 
require_once ('./dao/dbhelper.php');
require_once ('./shared/config.php');
session_start();

$isLogin = false;

if(isset($_SESSION[S_USERNAME])) {
    $isLogin = true;
}
else {
    $isLogin = false;
}

if($isLogin) {
    $loginLogoutStyle = "display: none";
    $logoutStyle = "display: block";
}
else {
    $loginLogoutStyle = "display: block";
    $logoutStyle = "display: none";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/modal.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

</head>
<body>
    <!-- header -->
    <div id="header">
        <div id="search">
            <div class="input-group" style="position: relative;">
                <div id="icon_search"></div>
                <input type="text" id="search" placeholder="Tìm kiếm tựa sách, tác giả ">
                <button title="Tìm sách" class="search-magnifier btn" type="submit">Tìm sách</button>
            </div>
                    </div>
        <div id="icon_cart" onclick="location.href='./page_giohang/cart.php'">
        </div>
        <div id="login_logout" style="<?php echo $loginLogoutStyle?>">
            <a onclick="openModal()" href="#">Đăng nhập</a>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="no-background">
                            <p>Đăng nhập</p>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body-email no-background">
                            <p>Email</p>
                        </div>
                        <div class="modal-body-password no-background">
                            <p>Mật khẩu</p>
                        </div>
                        <div class="modal-body-email-input no-background">
                            <input type="email" class="form-control" name="email" id="email" >
                        </div>
                        <div class="modal-body-password-input no-background">
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div>
                            <div class="modal-body-remember-checkbox no-background">
                                
                            </div>
                            <div class="modal-body-remember-title no-background">
                                Ghi nhớ thông tin
                            </div>
                            <div class="modal-body-forget-password no-background">
                                Quên mật khẩu?
                            </div>                            
                        </div>
                        <div class="modal-body-login-button no-background">
                            <button onclick="login()">Đăng nhập</button>
                        </div>
                        <div class="modal-body-register-message no-background">
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="modal-footer-loginas-msg">
                            <p>Hoặc đăng nhập bằng</p>
                        </div>
                        <div class="modal-footer-loginas-facebook">
                            <div class="loginas-facebook-icon"></div>
                            <p>Facebook</p>
                        </div>
                        <div class="modal-footer-loginas-google">
                            <div class="loginas-google-icon"></div>
                            <p>Google</p>
                        </div>
                    </div>
                    <div class="modal-icon-close" onclick="closeModal()" style="cursor: pointer;"></div>
                </div>
            </div>
            <a href="./page_authentication/register.php">Đăng ký</a>
        </div>
        <div id="logout" style="<?php echo $logoutStyle?>">
            <a href="#">Logout</a>
        </div>
        <script>
            var email = document.getElementById('email');
            var password = document.getElementById('password');
            
            function login() {
                if(email != null && password != null) {
                    // //ajax
                    // const xhttp = new XMLHttpRequest();
                    // xhttp.onload = function() {
                        
                    // }
                    // xhttp.open("POST", "./page_authentication/login_action.php?username="+email.value+"&password="+password.value, true);
                    // xhttp.send();
                    $.ajax({
                        type: "POST",
                        url: './page_authentication/login_action.php',
                        data: jQuery.param({ username: email.value, password : password.value}),
                        success: function(response)
                        {
                            console.log(response);
                            if(response == "Success") {
                                document.getElementById("login_logout").style.display = 'none';
                                window.location.reload();
                            }
                            else {

                            }
                        }
                });                                        
                }
            }

        </script>
    </div>
<!-- MENU -->
    <div id="menu">
        <span>
            <div id="icon_menu"></div>
        </span>
        <span id="menu_categories">Danh Mục Sách</span>
    </div>

<!-- Container -->
    <div id="container">
    <!-- Content -->
    <div id="content">
        <div class="categories_item">
            <ul>
                <!-- fetch data -->
                <?php foreach(getAllCategories() as $key => $category) {?>
                <?php 
                    $categoryTop = 42*$key;
                    $dividerTop = 41*($key+1);

                    $dividerStyle = "position: absolute; width: 377px; height: 0px; top: ".$dividerTop."px; opacity: 0.3; border: 1px solid #000000;";
                    $categoryNameStyle = "position: absolute; width: 374px; height: 42px; top: ".$categoryTop."px";   
                ?>    
                <li onclick="location.href='<?php echo PRODUCTS.$category['id']?>';" style="<?php echo $categoryNameStyle?>">
                    <p><?php echo $category['name']?></p>
                    <i class="fa-solid fa-angle-right link1"></i>
                </li>
                <div class="categorie_items_divider" style="<?php echo $dividerStyle?>"></div>
                <?php }?>
            </ul>
        </div>
        <div id="image1">
            <img src="./images/Capture.PNG">
        </div>
        <div id="image2">
            <div>
                <img src="./images/anh2.png">
                <img src="./images/anh3.png">
            </div>                       
        </div>
    </div>
    <!-- Content -->
    <div id="new_book">
        <div class="new_book_title1">Sách mới hay</div>
        <!-- <div class="new_book_title2">Sách bán chạy trong tuần</div> -->
    </div>

    <!-- introduce -->
    <div id="intro_book">
        <div id="popular">
            <div class="intro"> 
                <div class="image">
                    <img src="./images/anh4.png">
                </div>           
                <div class="info">
                    <div class="title">
                        <p>Tạp chí Pi tập 5</p>
                        <div class="title_divider"></div>
                    </div>    
                    <p class="content">
                    Tạp chí Pi do Hội Toán Học Việt Nam biên soạn và phát hành với sự tham gia của Giáo sư Ngô Bảo Châu.
                    </p>
                    <div class="divider"></div>
                    <div class="price"><p>30000 VNĐ<p></div>
                </div>
                
            </div>     
        </div>
    
    
    </div>
    </div>    
<!-- footer -->
    <div id="footer">
        <div id="logo">
            <img src="./images/bocongthuong.png">
        </div>
        <div id="address">
            <h4>CÔNG TY CỔ PHẦN THƯƠNG MẠI DỊCH VỤ MÊ CÔNG COM</h4>
            <span>Địa chỉ: 52/2 Thoại ngọc Hầu, Phường Hòa Thạnh, Quận Tân Phú, Hồ Chí Minh</span><br>
            <span>MST: 0303615027 do Sở Kế Hoạch Và Đầu Tư Tp.HCM cấp ngày 10/3/2011</span><br>
            <span>Tel: 028.73008182 - Fax: 028.39733234 - Email: hotro@vinabook.com</span>
        </div>
        <div id="pay">
            <h4>Chấp nhận thanh toán</h4>
            <div id="pay_image">
                <img src="./images/logo2.png">
                <img src="./images/logo1.png">
            </div>
            
        </div>
        <div id="partners">
            <h4>Đối tác bán hàng</h4>
            <div id="partners_image">
                <img src="./images/lazada.png">
                <img src="./images/shopee.webp">
                <img src="./images/amazon.jpg">
            </div>
            
        </div>
    </div>
</body>
<script src="./js/modal.js"></script>

</html>