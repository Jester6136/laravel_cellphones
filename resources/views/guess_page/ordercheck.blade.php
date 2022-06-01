@extends('_guess_layout')
@section('css')
    <style>
        .input-group {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -webkit-box-align: stretch;
            -ms-flex-align: stretch;
            align-items: stretch;
            width: 100%;
        }
        .mb-3, .my-3 {
            margin-bottom: 1rem!important;
        }
        .input-group>.custom-select:not(:last-child), .input-group>.form-control:not(:last-child) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.input-group>.form-control {
    position: relative;
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    width: 1%;
    margin-bottom: 0;
}
.form-control {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.form-control input {
    overflow: visible;
}
.input-group-append {
    margin-left: -1px;
}
.input-group-append, .input-group-prepend {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}
.input-group>.input-group-append>.btn, .input-group>.input-group-append>.input-group-text, .input-group>.input-group-prepend:first-child>.btn:not(:first-child), .input-group>.input-group-prepend:first-child>.input-group-text:not(:first-child), .input-group>.input-group-prepend:not(:first-child)>.btn, .input-group>.input-group-prepend:not(:first-child)>.input-group-text {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}
    </style>
@stop

@section('content')

<div class="shopping-cart" ng-controller="ordercheckController">
    <div style="display:flex;justify-content:center;">
        <div class="input-group mb-3" style="width: 20%;padding-right:20px;">
            <input type="text" class="form-control" placeholder="Số điện thoại" ng-model="phone">
        </div>
        <div class="input-group mb-3" style="width: 20%;">
            <input type="text" class="form-control" placeholder="Mã đơn hàng" ng-model="orderid">
            <div class="input-group-append">
                <button class="btn" style="border: 1px solid #ced4da;cursor:pointer;
    background: white;
    border-radius: 0px 5px 5px 0px;" type="button" ng-click="checkorder(phone,orderid)">Kiểm tra</button>
            </div>
        </div>
    </div>
    
    <div class="container-cart" ng-if="!status">
            <div class="cart-content" style="height:500px;text-align:center;">
                <h3>KIỂM TRA THÔNG TIN ĐƠN HÀNG & TÌNH TRẠNG VẬN CHUYỂN</h3>
            </div>
    </div>
    <div class="container-cart" ng-if="status">
            <div class="cart-content">
                <div style="padding: 10px;border-radius:12px;margin: 10px;box-shadow: 0 2px 3px 0 rgb(0 0 0 / 15%);">
                    <h2>THÔNG TIN ĐƠN HÀNG</h2>
                    <div class="order-info">
                        <h4><p>Mã đơn hàng:&nbsp;&nbsp;</p>@{{order.id}}</h4>
                        <h4><p>Người nhận:&nbsp;&nbsp;</p>@{{order.customer.CustomerName}}</h4>
                        <h4><p>Số điện thoại:&nbsp;&nbsp;</p>@{{order.Phone}}</h4>
                        <h4><p>Giao đến:&nbsp;&nbsp;</p>@{{order.DeliveryAddress}}</h4>
                        <h4><p>Hình thức thanh toán:&nbsp;&nbsp;</p>@{{order.Type}}</h4>
                        <h4><p>Trạng thái đơn hàng:&nbsp;&nbsp;</p>@{{order.Status}}</h4>
                        <h4><p>Mô tả thêm:</p>&nbsp;&nbsp;</p>@{{order.Description}}</h4>
                        <h4><p>Tổng tiền:&nbsp;&nbsp;</p>@{{order.Amount}}</h4>
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
                    <div class="order-more">
                        <button ng-click="cancelOrder()">
                            <h4>Hủy đơn hàng</h4>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/assets_guess/js_controller/Ordercheckcontroller.js"></script>
@stop