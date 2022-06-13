<?php 
require_once ('dbhelper.php');
require_once ('config.php');
session_start();

if(!isset($_SESSION[S_USERNAME])) {
    header('Location: login.php');
}
else {
    $username = $_SESSION[S_USERNAME];
}
?>

<!-- HTML CONTENT -->
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <link href="css/navbar.css" rel="stylesheet" >
    </head>
    <body>
    <header class="section-header">
        <nav class="navbar navbar-dark navbar-expand p-0 bg-dark">
        <div class="container-fluid">
        <ul class="navbar-nav d-none d-md-flex mr-auto">
            <li class="nav-item"><a class="nav-link" href="#" data-abc="true">Cash On Delivery</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-abc="true">Free Delivery</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-abc="true">Cash Backs</a></li>
        </ul>
        <ul class="navbar-nav d-flex align-items-center">
            <li class="nav-item">
                <div class="d-flex flex-row">
                    <img src="https://i.imgur.com/EYFtR83.jpg" class="rounded-circle" width="30">
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link d-flex align-items-center" data-abc="true"><span><?php echo $username ?></span><i class='bx bxs-chevron-down'></i></a>
            </li>
            
        </ul> <!-- list-inline //  -->
    </div> <!-- navbar-collapse .// -->
    <!-- container //  -->
    </nav> <!-- header-top-light.// -->

    <section class="header-main border-bottom bg-white">
        <div class="container-fluid">
        <div class="row p-2 pt-3 pb-3 d-flex align-items-center">
            <div class="col-md-2">
                <img  class="d-none d-md-flex" src="https://i.imgur.com/R8QhGhk.png" width="100">
            </div>
            <div class="col-md-8">
            <div class="d-flex form-inputs">
            <input class="form-control" type="text" placeholder="Search any product...">
            <i class="bx bx-search"></i>
            </div>
            </div>
            
            <div class="col-md-2">
                <div class="d-flex d-none d-md-flex flex-row align-items-center">
                    <span class="shop-bag"><i class='bx bxs-shopping-bag'></i></span>
                    <div class="d-flex flex-column ms-2">
                        <span class="qty">0 Product</span>
                        <span class="fw-bold">$0</span>
                    </div>    
                </div>           
            </div>
        </div>
        </div> 
    </section>
    </header>                
    <div class="container py-5">
    <div class="row text-center text-white mb-5">
        <div class="col-lg-7 mx-auto">
            <h1 class="display-4">Product List</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- List group-->
            <ul class="list-group shadow">
            <?php foreach(getAllProducts() as $product) {?>
                <!-- list group item-->
                <li class="list-group-item">
                    <!-- Custom content-->
                    <div class="media align-items-lg-center flex-column flex-lg-row p-3" onclick="location.href='<?php echo PRODUCT_DETAIL.$product['id']?>';" style="cursor: pointer;">
                        <div class="media-body order-2 order-lg-1">
                            <h5 class="mt-0 font-weight-bold mb-2"><?php echo $product['name']?></h5>
                            <p class="font-italic text-muted mb-0 small"></p>
                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <h6 class="font-weight-bold my-2"><?php echo $product['price']." VND"?></h6>
                                <ul class="list-inline small">
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star-o text-gray"></i></li>
                                </ul>
                            </div>
                        </div><img src="<?php echo $product['image']?>" width="200" class="ml-lg-5 order-1 order-lg-2">
                    </div> <!-- End -->
                </li> <!-- End -->
            <?php } ?>
            </ul> <!-- End -->
        </div>
    </div>
</div>
    </body>
</html>