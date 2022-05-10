@extends('_guess_layout')
@section('content')

<div class="shopping-cart" ng-controller="cartController">
    <div class="container-cart">
        <div class="cart-top">
            <a href="/payment-info" class="buymore">
                Quay lại
            </a>
            <p>Phiếu giảm giá</p>
        </div>
        <div class="cart-content">
            <div class="discount">
                <p>- Nhập mã giảm giá:&nbsp;</p><input type="text"><button>Áp dụng</button>
                <div id="line"></div>
            </div>
            <div id="content" style="padding: 10px;border-radius:12px;margin: 10px;box-shadow: 0 2px 3px 0 rgb(0 0 0 / 15%);">
                <h2>Thông tin đặt hàng</h2>
                <div class="order-info">
                    <h4><p>Người nhận:&nbsp;&nbsp;</p>FantomsX</h4>
                    <h4><p>Số điện thoại:&nbsp;&nbsp;</p>FantomsX</h4>
                    <h4><p>Giao đến:&nbsp;&nbsp;</p>FantomsX</h4>
                    <h4><p>Tổng tiền:&nbsp;&nbsp;</p>FantomsX</h4>
                </div>
            </div>
            
            <div class="buy-detail">
                <div class="order-online" style="padding-bottom: 10px;">
                    <button>
                        <h4>Tiến hành đặt hàng</h4>
                    </button>
                </div>

                <div class="order-more">
                    <button>
                        <h4>Chọn thêm sản phẩm khác</h4>
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