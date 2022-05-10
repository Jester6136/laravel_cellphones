@extends('_guess_layout')
@section('content')

<div class="shopping-cart" ng-controller="cartController">
    <div class="container-cart">
        <div class="cart-top">
            <a href="/" class="buymore">
                Đóng
            </a>
            <p>Hoàn tất</p>
        </div>
        <div class="cart-content">
            <div style="padding: 10px;border-radius:12px;margin: 10px;box-shadow: 0 2px 3px 0 rgb(0 0 0 / 15%);">
                <h2>ĐẶT HÀNG THÀNH CÔNG</h2>
                <div class="order-info">
                    <h4><p>Mã đơn hàng:&nbsp;&nbsp;</p>FantomsX</h4>
                    <h4><p>Người nhận:&nbsp;&nbsp;</p>FantomsX</h4>
                    <h4><p>Số điện thoại:&nbsp;&nbsp;</p>FantomsX</h4>
                    <h4><p>Giao đến:&nbsp;&nbsp;</p>FantomsX</h4>
                    <h4><p>Hình thức thanh toán:&nbsp;&nbsp;</p>FantomsX</h4>
                    <h4><p>Trạng thái thanh toán:&nbsp;&nbsp;</p>FantomsX</h4>
                    <h4><p>Tổng tiền:&nbsp;&nbsp;</p>FantomsX</h4>
                </div>
            </div>
            <div id="content" style="padding: 10px;">
                <div class="product-in-cart" ng-repeat="cart in Cart">
                    <img src="/assets/images/@{{cart.color.ColorImage}}" alt="">
                    <div class="imfor">
                        <h4 class="product-name" style="font-size: 16px;">@{{cart.color.memory.product.ProductName}} | @{{cart.color.memory.MemoryName}}</h4>
                        <div style="display: -webkit-inline-box;"><p>Giá:&nbsp;&nbsp;</p><p class="Price-now">@{{cart.new_price}} <p class="Price-old">@{{cart.old_prices}}</div>
                        <p>Màu: <span>@{{cart.color.ColorName}}</span></p>
                        <p>Số lượng: <span>@{{cart.Quantity}}</span></p>
                        <div style="display: -webkit-inline-box;"><p>Tổng tiền:&nbsp;&nbsp;</p><p class="Price-now">@{{cart.new_price}}</p> </div>
                        
                    </div>
                    <div class="box-price">
                    </div>
                    <div id="line"></div>
                </div>
            </div>
            <div class="buy-detail">
                <div class="order-online" style="padding-bottom: 10px;">
                    <button>
                        <h4>Kiểm tra đơn hàng</h4>
                    </button>
                </div>

                <div class="order-more">
                    <button>
                        <h4>Tiếp tục mua hàng</h4>
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