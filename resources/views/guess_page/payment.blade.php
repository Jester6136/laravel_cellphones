@extends('_guess_layout')
@section('content')

<div class="shopping-cart" ng-controller="cartController">
    <div class="container-cart">
        <div class="cart-top">
            <a href="/voucher" class="buymore">
                Quay lại
            </a>
            <p>Thanh toán</p>
        </div>
        <div class="cart-content">
            <div id="content" style="padding: 10px;border-radius:12px;margin: 10px;box-shadow: 0 2px 3px 0 rgb(0 0 0 / 15%);">
                <h2>Thông tin đặt hàng</h2>
                <div class="order-info">
                    <h4><p>Mã đơn hàng:&nbsp;&nbsp;</p>FantomsX</h4>
                    <h4><p>Người nhận:&nbsp;&nbsp;</p>FantomsX</h4>
                    <h4><p>Số điện thoại:&nbsp;&nbsp;</p>FantomsX</h4>
                    <h4><p>Giao đến:&nbsp;&nbsp;</p>FantomsX</h4>
                    <h4><p>Tổng tiền:&nbsp;&nbsp;</p>FantomsX</h4>
                </div>
            </div>
            <div class="config2">
                <div class="box-option-config2">
                    <p class="memoname">Thanh toán khi nhận hàng</p>
                    <p class="special-price"><i class="fal fa-newspaper"></i></p>
                </div>
                <div class="box-option-config2">
                    <p class="memoname">Thanh toán khi nhận hàng</p>
                    <p class="special-price"><i class="fal fa-newspaper"></i></p>
                </div>
                <div class="box-option-config2">
                    <p class="memoname">Thanh toán khi nhận hàng</p>
                    <p class="special-price"><i class="fal fa-newspaper"></i></p>
                </div>
                <div class="box-option-config2">
                    <p class="memoname">Thanh toán khi nhận hàng</p>
                    <p class="special-price"><i class="fal fa-newspaper"></i></p>
                </div>
                <div class="box-option-config2">
                    <p class="memoname">Thanh toán khi nhận hàng</p>
                    <p class="special-price"><i class="fal fa-newspaper"></i></p>
                </div>
                <div class="box-option-config2">
                    <p class="memoname">Thanh toán khi nhận hàng</p>
                    <p class="special-price"><i class="fal fa-newspaper"></i></p>
                </div>
            </div>
            <input name="agree-method" type="checkbox" id="agree" checked="checked" style="margin-left:20px">
                <label for="agree"><a href="">Bằng cách đặt hàng, bạn đồng ý với điều khoản sử dụng của CellphoneS.</a></label>

            <div class="buy-detail">
                <div class="order-online" style="padding-bottom: 10px;">
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