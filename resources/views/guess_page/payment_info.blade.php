@extends('_guess_layout')
@section('content')

<div class="shopping-cart" ng-controller="cartController">
    <div class="container-cart">
        <div class="cart-top">
            <a href="/cart" class="buymore">
                Quay lại
            </a>
            <p>Thông tin đặt hàng</p>
        </div>
        <div class="cart-content">
            <div class="buy-detail">
                <h4>Thông tin khách hàng</h4>
                <div class="tt">
                    <div class="name">
                        <p>Họ và tên (Bắt buộc)</p>
                        <input type="text"  ng-model="Order.CustomerName">
                    </div>
                    <div class="phone">
                        <p>Số điện thoại đặt hàng (bắt buộc)</p>
                        <input type="text"  ng-model="Order.Phone">
                    </div>
                    <div class="name">  
                        <p>Email (Vui lòng điền email để nhận hóa đơn VAT)</p>
                        <input type="text"  ng-model="Order.Email">
                    </div>
                    <div style="clear: both;"></div>
                </div>
                
                <h4>Địa chỉ giao hàng</h4>
                <div class="tt">
                    <div class="name">
                        <p>Họ và tên (Bắt buộc)</p>
                        <input type="text"  ng-model="Order.CustomerName">
                    </div>
                    <div class="phone">
                        <p>Số điện thoại đặt hàng (bắt buộc)</p>
                        <input type="text"  ng-model="Order.Phone">
                    </div>
                    <div class="email">
                        <p>Email (Vui lòng điền email để nhận hóa đơn VAT)</p>
                        <input type="text"  ng-model="Order.Email">
                    </div>
                    <div style="clear: both;"></div>
                </div>

                <div class="buy-detail">
                    <div class="order-online">
                        <button>
                            <h4>Tiến hành đặt hàng</h4>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
    <script src="/assets_guess/js_controller/CartController.js"></script>
@stop