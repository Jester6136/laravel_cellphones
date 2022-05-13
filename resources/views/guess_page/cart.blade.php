@extends('_guess_layout')
@section('content')

<div class="shopping-cart" ng-controller="cartController">
    <div class="container-cart">
        <div class="cart-top">
            <a href="/" class="buymore">
                Mua thêm sản phẩm khác
            </a>
            <p>Giỏ hàng của bạn</p>
        </div>
        <div class="cart-content">
            <div id="content">
                <div class="product-in-cart" ng-repeat="cart in Cart">
                    <i class="fas fa-times delele-product" ng-click="delete(cart)"></i>
                    <img src="/assets/images/@{{cart.color.ColorImage}}" alt="">
                    <div class="imfor">
                        <h4 class="product-name">@{{cart.color.memory.product.ProductName}} | @{{cart.color.memory.MemoryName}}</h4>
                        <p>Màu: <span>@{{cart.color.ColorName}}</span></p>
                    </div>
                    <div class="box-price">
                        <p class="Price-now">@{{cart.new_price}}</p>
                        <p class="Price-old">@{{cart.old_price}}</p>
                        <div class="Quantity">
                            <button class="btn-left l" ng-click="sub(cart)">-</button>
                            <input type="text" class="val q" value="@{{cart.Quantity}}" readonly>
                            <button class="btn-right r" ng-click="add(cart)">+</button>
                        </div>
                    </div>
                    <div id="line"></div>
                </div>
            </div>
            <div class="sum-price">
                <div id="sum-price">
                    <p>- Tổng tiền tạm tính: <span>@{{sumPriceShow}}</span></p>
                </div>
                <div id="line"></div>
            </div>
            
            <div class="buy-detail">
                <div class="order-online" ng-click=go_payment_info(Cart)>
                    <button>
                        <h4>Tiến hành đặt hàng</h4>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
    <script src="/assets_guess/js_controller/CartController.js"></script>
@stop