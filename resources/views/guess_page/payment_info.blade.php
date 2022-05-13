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
                    <div class="ip">
                        <input type="text"  ng-model="Order.CustomerName" placeholder="Họ và tên (Bắt buộc)" class="mb-2">
                    </div>
                    <div class="ip">
                        <input type="text"  ng-model="Order.Phone" placeholder="Số điện thoại đặt hàng (bắt buộc)" class="mb-2">
                    </div>
                    <div class="ip">  
                        <input type="text"  ng-model="Order.Email" placeholder="Email (Vui lòng điền email để nhận hóa đơn VAT)" class="mb-2">
                    </div>
                    <div style="clear: both;"></div>
                </div>
                
                <h4>Địa chỉ giao hàng</h4>
                <div class="tt" style="background: #cecece45;padding: 10px;border-radius: 10px;  margin-bottom: 0.5rem!important;">
                    <div style="display:flex;justify-content:space-between;">
                        <div class="select-dropdown" style="width: 32%; margin-bottom: 0.5rem!important;" ng-model='selected_city'>
                            <select  ng-model="city" ng-options="city.name for city in citis"  ng-change="city_change(city)">
                                <option value="" disabled selected>Tỉnh / Thành phố</option>
                            </select>
                        </div>
                        <div class="select-dropdown" style="width: 32%;">
                            <select ng-disabled="!city" ng-model="district" ng-options="district.name for district in districts_change" ng-change="district_change(district)">
                                <option value="" disabled selected>Quận / Huyện</option>
                            </select>
                        </div>
                        <div class="select-dropdown" style="width: 32%;">
                            <select ng-disabled="!district" ng-model="ward" ng-options="ward.name for ward in wards_change">
                                <option value="" disabled selected>Xã / Thôn</option>
                            </select>
                        </div>
                    </div>
                    <div class="ip">  
                        <input type="text"  ng-model="Address_detail" placeholder="Số nhà, tên đường" class="mb-2">
                    </div>
                    
                    <div style="clear: both;"></div>
                </div>

                <div class="ip">  
                    <input type="text"  ng-model="Order.More" placeholder="Yêu cầu khác" class="mb-2">
                </div>
                
                <div class="sum-price">
                    <div id="sum-price">
                        <p>- Tổng tiền tạm tính: <span>@{{sumPriceShow}}</span></p>
                    </div>
                    <div id="line"></div>
                </div>


                <div class="buy-detail">
                    <div class="order-online" ng-click="go_voucher()">
                        <button>
                            <h4>Tiếp tục</h4>
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