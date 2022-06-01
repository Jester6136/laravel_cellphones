<div class="menu">
    <div class="container">
        <div class="nav-bar">
            <div class="box-menu-logo">
                <div class="toggle">
                    <i class="fas fa-bars"></i>
                    <div class="toggle-top">
                        <div class="row">
                            <ul>
                                <li ng-repeat="item in categories">
                                    <a href="" ng-click="PushCategory(brand.CategoryID)" value="@{{item.id}}">
                                        <i class="@{{item.Icon}}"></i>
                                        @{{item.CategoryName}}
                                        <i class="fas fa-angle-right"></i>  
                                    </a>
                                    <ul>
                                        <a href="/brand/@{{brand.id}}" ng-click="PushBrand(brand.CategoryID,brand.BrandID)" style="width: 100%;" 
                                        ng-repeat="brand in item.brands" value="@{{brand.id}}">
                                            <li style="width:100%;">@{{brand.BrandName}}</li></a>
                                    </ul>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fal fa-newspaper"></i>
                                        Tin công nghệ
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fal fa-tag"></i>
                                        Khuyến mãi
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="logo">
                    <a href="/">
                        <img src="/assets/images/logo.PNG" alt="">
                    </a>
                </div>
            </div>
            <div class="box-local">
                <p>Xem giá, tồn kho tại:</p>
                <p class="my-local">Hà Nội &emsp;<i class="fa fa-angle-down"></i></p>
            </div>
            <div class="box-search">
                <input type="text" placeholder="Bạn cần tìm gì? ">
                <button onclick="findProduct()"><i class="fas fa-search"></i></button>
            </div>
            <div class="box-about" ng-controller="loginController">
                <a href="/ordercheck">
                    <div class="box-about-1">
                        <div class="box-about-icon">
                        <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="box-about-context">
                            <p>Kiểm tra</p>
                            <p>Đơn hàng</p>
                        </div>
                    </div>
                </a>
                <a class="cart" href="/cart">
                    <div class="box-about-3">
                        <div class="box-about-icon">
                            <i class="fas fa-shopping-bag"></i>
                            <span id="cart-quantity">(@{{CartQuantity}})</span>
                        </div>
                        <div class="box-about-context">
                            <p>Giỏ hàng</p>
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="box-about-2" id="login">
                        <div class="box-about-icon">
                            <i class="fad fa-user-circle"></i>
                        </div>
                        <div class="box-about-context">
                            <p>@{{Status}}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

