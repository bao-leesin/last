<?php 
require_once ('./../dao/dbhelper.php');
require_once ('./../shared/config.php');
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

if(isset($_GET[PARA_PRODUCT_ID])) {
    $productId = $_GET[PARA_PRODUCT_ID];
    $productDetail = getProductDetail($productId);
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
    <link rel="stylesheet" href="./../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./../css/modal.css">
    <link rel="stylesheet" href="./products.css">
    <link rel="stylesheet" href="./productDetails.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
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
        <div id="icon_cart" onclick="location.href='./../page_giohang/cart.php'">
        </div>
        <div id="login_logout" style="<?php echo $loginLogoutStyle;?>">
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
                            
                        </div>
                        <div class="modal-body-password-input no-background">
                            
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
                            <button>Đăng nhập</button>
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
            
            <a href="#">Đăng ký</a>
        </div>
        <div id="logout" style="<?php echo $logoutStyle?>">
            <a href="#">Logout</a>
        </div>
    </div>
<!-- MENU -->
    <div id="menu">
        <span>
            <div id="icon_menu"></div>
        </span>
        <span id="menu_categories">Danh Mục Sách</span>
    </div>

<!-- Container -->
    <div id="container" style="height: 100%">
        <!-- Content -->
        <div id="content">
            <div class="row">
                <div class="divider"></div> 
                <div class="product-row">
                    <div class="product-image">
                        <img src="<?php echo $productDetail['image']?>"/>
                    </div>
                    <div class="product-info">
                        <div class="product-name"><?php echo $productDetail['name']?></div>
                        <div class="product-description"><?php echo $productDetail['description']?></div>
                    </div>
                    <div class="product-payment-info">
                        <div class="title">
                            Thông tin thanh toán
                        </div>
                        <div class="divider" style="width: 265.03px; left: 30px; top:43px ">
                        </div>
                        <div class="price-title">
                            Giá bán
                        </div>
                        <div class="price"><?php echo $productDetail['price']?></div>
                         
                        <div class="divider" style="width: 265.03px; left: 30px; top:133px ">
                        </div>
                        <button class="add_to_cart" onclick="location.href='<?php echo ADD_TO_CART.'?'.PARA_PRODUCT_ID.'='.$productId.'&'.PARA_PRICE.'='.$productDetail['price']; ?>'">
                            <img src="./../images/icons/icon_add_shopping_cart.png"/>
                            <div class="title">
                                <div> MUA NGAY</div>
                            </div>
                        </button>
                    </div>
                </div>         
            </div>
        </div>
    </div>    
<!-- footer -->
    <div id="footer">
        <div id="logo">
            <img src="./../images/bocongthuong.png">
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