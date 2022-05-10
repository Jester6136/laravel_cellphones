@extends('_guess_layout')
@section('content')


<div class="box-slide">

    <div class="container">
        <div class="toggle-content col-3 col-m-5">
            <div class="row">
                <ul>
                    <li ng-repeat="item in categories">
                        <a href="" ng-click="PushCategory(brand.CategoryID)" value="@{{item.categoryID}}">
                            <i class="@{{item.Icon}}"></i>
                            @{{item.CategoryName}}
                            <i class="fas fa-angle-right"></i>
                        </a>
                        <ul>
                            <a href="/Products/ProductsBrand" ng-click="PushBrand(brand.CategoryID,brand.BrandID)" style="width: 100%;" ng-repeat="brand in item.brands" value="@{{brand.BrandID}}">
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
            <h3>Điện thoại nổi bật nhất</h3>
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
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <p>1 đánh giá</p>
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
            <h3>Sản phẩm cũ</h3>
        </div>
        <div class="list-product">
            <div class="product col-4 col-m-5 col-s-10" ng-repeat="Product in OldProducts">
                <div class="product-img">
                    <img src="/assets/images/@{{Product.ImageName}}" alt="">
                </div>
                <div class="product-info">
                    <h4 class="product-name">@{{Product.ProductName}}</h4>
                    <div class="price">
                        <p class="special-price">@{{Product.NewPrice}}</p>
                        <p class="old-price">@{{Product.OldPrice}}</p>
                    </div>
                    <div class="offers">
                        <p>@{{Product.PromotionName}}</p>
                    </div>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <p>1 đánh giá</p>
                    </div>
                    <div class="product-btn">
                        <a href="/Products/ProductDetail"><button class="buy-btn" ng-click="getProduct(Product)">Mua ngay</button></a>
                        <a href=""><button class="compare">So sánh</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div style="clear: both; margin-top: 20px;margin-bottom: 50px;"></div>
        <div class="tittle-box">
            <h3>Danh mục phụ kiện</h3>
        </div>
        <div class="list-product">
            <div id="21" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc1.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Phụ kiện Apple
                    </div>
                </a>
            </div>
            <div id="22" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc2.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Pin dự phòng
                    </div>
                </a>
            </div>
            <div id="23" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc3.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Dán màn hình
                    </div>
                </a>
            </div>
            <div id="24" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc4.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Dây đồng hồ
                    </div>
                </a>
            </div>
            <div id="25" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc5.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Thẻ nhớ
                    </div>
                </a>
            </div>
            <div id="26" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc6.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Camera
                    </div>
                </a>
            </div>
            <div id="27" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc7.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Thiết bị mạng
                    </div>
                </a>
            </div>
            <div id="28" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc8.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Nhà thông minh
                    </div>
                </a>
            </div>
            <div id="29" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc9.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Cáp sạc
                    </div>
                </a>
            </div>
            <div id="30" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc10.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Ốp bao da
                    </div>
                </a>
            </div>
            <div id="31" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc11.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Ổ cứng
                    </div>
                </a>
            </div>
            <div id="32" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc12.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Chuột bàn phím
                    </div>
                </a>
            </div>
            <div id="33" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc22.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Gaming gear
                    </div>
                </a>
            </div>
            <div id="34" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc14.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Máy lọc không khí
                    </div>
                </a>
            </div>
            <div id="35" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc15.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Loa
                    </div>
                </a>
            </div>
            <div id="36" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc16.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Tai nghe
                    </div>
                </a>
            </div>
            <div id="37" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc17.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Quạt
                    </div>
                </a>
            </div>
            <div id="38" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc18.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Phụ kiện chụp
                    </div>
                </a>
            </div>
            <div id="39" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc23.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Phụ kiện Laptop
                    </div>
                </a>
            </div>
            <div id="40" class="cate-accessories col-2 col-m-5 col-s-5">
                <a href="">
                    <div class="cate-accessories-img">
                        <img src="/assets/images/acc25.png" alt="">
                    </div>
                    <div class="cate-accessories-name">
                        Xem thêm
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@stop


@section('js')
    <script src="/assets_guess/js_controller/HomeController.js"></script>
@stop
