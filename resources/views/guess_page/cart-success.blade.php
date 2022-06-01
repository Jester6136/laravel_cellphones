@extends('_guess_layout')
@section('content')

<div class="shopping-cart" ng-controller="cartsuccessController">
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
                    <h4><p>Mã đơn hàng:&nbsp;&nbsp;</p>@{{order.id}}</h4>
                    <h4><p>Người nhận:&nbsp;&nbsp;</p>@{{order.customer.CustomerName}}</h4>
                    <h4><p>Số điện thoại:&nbsp;&nbsp;</p>@{{order.Phone}}</h4>
                    <h4><p>Giao đến:&nbsp;&nbsp;</p>@{{order.DeliveryAddress}}</h4>
                    <h4><p>Hình thức thanh toán:&nbsp;&nbsp;</p>@{{order.Type}}</h4>
                    <h4><p>Trạng thái đơn hàng:&nbsp;&nbsp;</p>@{{order.Status}}</h4>
                    <h4><p>Mô tả thêm:&nbsp;&nbsp;</p>@{{order.Description}}</h4>
                    <h4><p>Tổng tiền:&nbsp;&nbsp;</p><b style="font-weight:700;">@{{order.Amount}}</b></h4>
                </div>
            </div>

            <div id="content">
                <div class="product-in-cart" style="justify-content: space-around !important;" ng-repeat="orderdetail in order.orderdetails">
                    <img src="/assets/images/@{{orderdetail.color.ColorImage}}" alt="">
                    <div class="imfor">
                        <h4 class="product-name">@{{orderdetail.color.memory.product.ProductName}} | @{{orderdetail.color.memory.MemoryName}}</h4>
                        <p>Màu: <span>@{{orderdetail.color.ColorName}}</span></p>
                        <div style="display:flex;"> 
                            <p>Giá thành: <span style="color:red;font-weight: 700;">@{{orderdetail.single_price}}</span></p>
                            <p class="Price-old">@{{orderdetail.color.old_prices.Price}}</p>
                        </div>
                        <p>Số lượng: <span>@{{orderdetail.Quantity}}</span></p>
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
    <script src="/assets_guess/js_controller/CartSuccess.js"></script>
@stop