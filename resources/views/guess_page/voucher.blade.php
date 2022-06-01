@extends('_guess_layout')
@section('content')

<div class="shopping-cart" ng-controller="VoucherController">
    <div class="container-cart">
        <div class="cart-top">
            <a href="/payment_info" class="buymore">
                Quay lại
            </a>
            <p>Phiếu giảm giá</p>
        </div>
        <div class="cart-content">
            <div class="discount" style="justify-content: space-between;">
                <div class="ip" style="display: flex;align-items: center;">
                    <p>- Nhập mã giảm giá:&nbsp;</p><input type="text" style="    width: 244px;">
                </div>
               <button ng-click="apply_voucher()">Áp dụng</button>
                <div id="line"></div>
            </div>
            <div id="content" style="padding: 10px;border-radius:12px;margin: 10px;box-shadow: 0 2px 3px 0 rgb(0 0 0 / 15%);">
                <h2>Thông tin đặt hàng</h2>
                <div class="order-info">
                    <h4><p>Người nhận:&nbsp;&nbsp;</p>@{{Order.CustomerName}}</h4>
                    <h4><p>Số điện thoại:&nbsp;&nbsp;</p>@{{Order.Phone}}</h4>
                    <h4><p>Giao đến:&nbsp;&nbsp;</p>@{{Order.Address}}</h4>
                    <h4><p>Tổng tiền:&nbsp;&nbsp;</p>@{{Order.sumPriceShow}}</h4>
                </div>
            </div>
            <div class="config2">
                <div class="box-option-config2">
                    <p class="memoname">Thanh toán khi nhận hàng</p>
                    <p class="special-price"><i class="fas fa-money-bill"></i></p>
                </div>
                <div class="box-option-config2">
                    <p class="memoname">Thanh toán online</p>
                    <p class="special-price"><i class="fal fa-credit-card"></i></p>
                </div>
            </div>
            <input name="agree-method" type="checkbox" id="agree" checked="checked" style="margin-left:20px">
                <label for="agree"><a href="">Bằng cách đặt hàng, bạn đồng ý với điều khoản sử dụng của CellphoneS.</a></label>

            <div class="buy-detail">
                <div class="order-online" style="padding-bottom: 10px;">
                    <button ng-click="order()">
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
    <script src="assets_guess/js_controller/VoucherController.js"></script>
@stop