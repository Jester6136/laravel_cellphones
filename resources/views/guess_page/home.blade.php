@extends('_guess_layout')
@section('content')
<div class="box-slide">
    <div class="container">
        <div class="toggle-content col-3 col-m-5">
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
        <!--Slide-->


        <div class="slide col-12 col-m-15 col-s-20">
            <div class="slides">
                <ul>
                    <a href="">
                    <li class="active">
                        <img src="/assets/images/slide1.png" alt="">
                    </li></a>
                    <a href="">
                    <li>
                        <img src="/assets/images/slide2.png" alt="">
                    </li></a>
                    <a href="">
                    <li>
                        <img src="/assets/images/slide3.png" alt="">
                    </li></a>
                    <a href="">
                    <li>
                        <img src="/assets/images/slide4.png" alt="">
                    </li></a>
                    <a href="">
                    <li>
                        <img src="/assets/images/slide2.png" alt="">
                    </li></a>
                </ul>
            </div>
            <div class="buttons">
                <b class="left"><i class="fas fa-chevron-left"></i></b>
                <b class="right"><i class="fas fa-chevron-right"></i></b>
            </div>
        </div>
        <!--End Slide -->



        <div class="advertisement col-5">
            <div class="banner">
                <img src="/assets/images/banner1.png" alt="">
            </div>
            <div class="banner">
                <img src="/assets/images/banner2.png" alt="">
            </div>
            <div class="banner">
                <img src="/assets/images/banner3.png" alt="">
            </div>
        </div>
        <div class="big-banner col-20 col-m-20">
            <img src="/assets/images/big-banner.png" alt="">
        </div>
    </div>
</div>
<div class="list-brand">
    <div class="container">
        <ul>
            <li class="col-5 col-m-5 col-s-10">
                <a href="">
                    <img src="/assets/images/applelogo.png" alt="">
                </a>
            </li>

            <li class="col-5 col-m-5 col-s-10">
                <a href="">
                    <img id="samsung" src="/assets/images/samsunglogo.png" alt="">
                </a>
            </li>

            <li class="col-5 col-m-5 col-s-10">
                <a href="">
                    <img id="asus" src="/assets/images/asuslogo.png" alt="">
                </a>
            </li>

            <li class="col-5 col-m-5 col-s-10">
                <a href="">
                    <img src="/assets/images/xiaomilogo.png" alt="">
                </a>
            </li>
        </ul>
    </div>
</div>
<div style="clear: both;"></div>
<div class="boxListItem" ng-controller="homeController">
    <div class="container">
        <div class="tittle-box">
            <h3>Điện thoại mới</h3>
        </div>
        <div class="list-product">
            <div class="shadow"></div>
            <div class="product col-4 col-m-5 col-s-10" ng-repeat="Product in Products">    
                <div class="product-img">
                    <img src="/assets/images/@{{Product.image_product}}" alt="">
                </div>
                <div class="product-info">
                    <h4 class="product-name">@{{Product.ProductName}}</h4>
                    <div class="price">
                        <p class="special-price">@{{Product.min_price}}</p>
                        <p class="old-price">@{{Product.old_price}}</p>
                    </div>
                    <div class="offers">
                        <p>@{{Product.PromotionName}}</p>
                    </div>
                    <div class="product-btn">
                        <a href=""><button class="buy-btn" ng-click="getProduct(Product)">Mua ngay</button></a>
                        <a href=""><button class="compare">So sánh</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div style="clear: both; margin-top: 20px;margin-bottom: 50px;"></div>
        <div class="tittle-box">
            <h3>Máy tính mới</h3>
        </div>
        <div class="list-product">
            <div class="shadow"></div>
            <div class="product col-4 col-m-5 col-s-10" ng-repeat="Product in Computer_Products">    
                <div class="product-img">
                    <img src="/assets/images/@{{Product.image_product}}" alt="">
                </div>
                <div class="product-info">
                    <h4 class="product-name">@{{Product.ProductName}}</h4>
                    <div class="price">
                        <p class="special-price">@{{Product.min_price}}</p>
                        <p class="old-price">@{{Product.old_price}}</p>
                    </div>
                    <div class="offers">
                        <p>@{{Product.PromotionName}}</p>
                    </div>
                    <div class="product-btn">
                        <a href=""><button class="buy-btn" ng-click="getProduct(Product)">Mua ngay</button></a>
                        <a href=""><button class="compare">So sánh</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div style="clear: both; margin-top: 20px;margin-bottom: 50px;"></div>
    </div>
</div>
@stop

@section('js')
    <script src="/assets_guess/js_controller/HomeController.js"></script>
@stop
