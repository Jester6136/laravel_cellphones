<!DOCTYPE html>
<html lang="en" ng-app="MyApp">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>CellphoneS - Điện thoại, Laptop, iPad, phụ kiện chính hãng, giá tốt nhất</title>
    <link rel="icon" href="https://cdn.cellphones.com.vn/media/favicon/default/logo-cps.png">
    <link rel="stylesheet" href="/assets_guess/fasm/css/all.css">
    <link rel="stylesheet" href="/assets_guess/css/style.css" type="text/css">
    <link rel="stylesheet" href="/assets/vendor/toast/toastr.min.css" />
    @yield('css')
</head>
<body>
    <div class="wrapper" ng-controller="menuController">
        <div class="overlay"></div>
        @include("_menu_guess_layout")
        <div>
            <div class="behind"></div>
            @yield('content');
        </div>
        <div class="mainn">
            <i class="fas fa-times" id="c" style="position: relative; font-size: 30px; float: right; padding: 10px 18px;cursor:pointer;"></i>
            <input type="checkbox" checked id="chk" aria-hidden="true">

            <div class="signup">
                <form action="" class="ip">
                    <label for="chk" aria-hidden="true">Sign up</label>
                    <input type="text" name="txt" placeholder="User name" required="">
                    <input type="email" name="email" placeholder="Email" required="">
                    <input type="password" name="pswd" placeholder="Password" required="">
                    <button id="signup">Sign up</button>
                </form>
            </div>

            <div class="login">
                <form action="" class="ip">
                    <label for="chk" aria-hidden="true">Login</label>
                    <input type="email" name="email" placeholder="Email" id="mail" ng-model="mail" required="">
                    <input type="password" name="pswd" placeholder="Password" id="pass" ng-model="pass" required="">
                    <!-- <span><input type="checkbox" ng-model="remember" class="input form-control" id="check_remember" /> <p> Remember me</p></span> -->
                    <button id="login1" ng-click="Login(mail,pass,remember)">Login</button>
                </form>
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
    <div class="footer">
        <div>
            <div style="clear: both;"></div>
            <div class="container">
                <div class="col-5 col-m-10 col-s-10" style="min-height: 166px">
                    <h4>Tìm cửa hàng</h4>
                    <p>Tìm cửa hàng gần nhất</p>
                    <p>Mua hàng từ xa</p>
                    <h4>Phương thức thanh toán</h4>
                </div>
                <div class="col-5 col-m-10 col-s-10" style="min-height: 166px">
                    <p>Gọi mua hàng: <span>1800.2097</span> (8h00 - 22h00)</p>
                    <p>Gọi khiếu nại: <span>1800.2063</span> (8h00 - 22h30)</p>
                    <p>Gọi bảo hành: <span>1800.2064</span> (8h00 - 22h00)</p>
                    <h4>Đối tác dịch vụ bảo hành</h4>
                    <p>Điện thoại - Máy tính</p>
                    <img src="images/dtv_logo.PNG" alt="" style="width: 50%;max-height: 50px;">
                </div>
                <div class="col-5 col-m-10 col-s-10" style="min-height: 166px">
                    <p>Mua hàng và thanh toán Online</p>
                    <p>Mua hàng trả góp Online</p>
                    <p>Tra thông tin đơn hàng</p>
                    <p>Tra điểm Smember</p>
                    <p>Tra thông tin bảo hành</p>
                    <p>Trung tâm bảo hành chính hãng</p>
                    <p>Quy định về việc sao lưu dữ liệu</p>
                    <p>Dịch vụ bảo hành điện thoại</p>
                </div>
                <div class="col-5 col-m-10 col-s-10" style="min-height: 166px">
                    <p>Quy chế hoạt động</p>
                    <p>Chính sách Bảo hành</p>
                    <p>Liên hệ hợp tác kinh doanh</p>
                    <p>Đơn Doanh nghiệp</p>
                    <p>Ưu đãi từ đối tác</p>
                    <p>Tuyển dụng</p>
                </div>
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
    <div class="footer-info">
        <div class="container">
            <p>Công ty TNHH Thương mại và dịch vụ kỹ thuật DIỆU PHÚC - GPĐKKD: 0316172372 do sở KH & ĐT TP. HCM cấp ngày 02/03/2020. Địa chỉ: 350-352 Võ Văn Kiệt, Phường Cô Giang, Quận 1, Thành phố Hồ Chí Minh, Việt Nam. Điện thoại: 028.7108.9666.</p>
        </div>
    </div>
    <script src="/assets/vendor/jquery/jquery.js"></script>
    <script src="/assets/js_controller/angular_path/angular.js"></script>   
    <script src="/assets/js_controller/angular_path/dirPagination.js"></script>
    <script>
        var myapp = angular.module('MyApp', ['angularUtils.directives.dirPagination']);//khai baso module
    </script>
    <script src="/assets/vendor/toast/toastr.min.js"></script>
    <script src="/assets_guess/Javascript/main.js"></script>
    <script src="/assets_guess/Javascript/find.js"></script>
    <script src="/assets_guess/js_controller/MenuController.js"></script>
    
    @yield('js')
</body>
</html>