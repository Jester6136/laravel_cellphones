﻿const cartController = "cart/";
myapp.controller('cartController', function ($http, $scope, $rootScope) {

    var connect_api = function (method,url,callback,status='Thao tác thành công!') { 
        $http({
          method: method,
          url: url,
        }).then(
          function (response) {
            callback(response);
            if(status!=""){
                toastr.success(status);
            }
          },
          (error) => {console.log(error);toastr.error('Lỗi rồi!');}
        );
    }
    var connect_api_data = function (method,url,data,callback) { 
        $http({
          method: method,
          url: url,
          data: data,
          'content-Type': 'application/json',
        }).then(
          function (response) {
            callback(response);
          },
          (error) => {console.log(error);toastr.error('Loi');}
        );
       }

    if (localStorage.getItem("cartQuantity") === null) {
        $rootScope.CartQuantity = 0
    }
    else {
        $rootScope.CartQuantity = parseInt(localStorage.getItem('cartQuantity'));
    }
    $scope.Order = [];
    $scope.Cart = []
    $scope.sumPrice = 0;
    $scope.sumPriceShow = "0";

    console.log(sessionStorage.getItem('login'));
    connect_api('get',baseApi+customersController+sessionStorage.getItem('login'),(res)=>{
        console.log(res);
    })


    connect_api('get',baseApi+cartController,(res)=>{
        $scope.Cart = res.data;
        for(var i=0;i<$scope.Cart.length;i++){
            var element = $scope.Cart[i];
            $scope.sumPrice+=element.new_price*element.Quantity;
            element.old_price = numberFormat.format(element.old_price)
            element.new_price = numberFormat.format(element.new_price)
        }
        $scope.sumPriceShow = numberFormat.format($scope.sumPrice);
    })
    // }
    // else {
    //     toastr.info("Hãy đăng nhập để xem giỏ hàng của bạn");
    // }

    $scope.delete = function (obj) {
        connect_api('delete',baseApi+cartController+obj.id,(res)=>{
            $scope.Cart.splice($scope.Cart.indexOf(obj), 1);
            toastr.success("Đã xóa sản phẩm khỏi giỏ hàng")
            $rootScope.CartQuantity = parseInt($rootScope.CartQuantity )-1;
            localStorage.setItem('cartQuantity', $rootScope.CartQuantity);
        })
    }

    $scope.sub = function (obj) {
        if (obj.Quantity > 1) {
            obj.Quantity -= 1;
            $scope.sumPrice -= obj.color.prices.Price;
            $scope.sumPriceShow = numberFormat.format($scope.sumPrice);
        }
    }
    $scope.add = function (obj) {
        if (obj.Quantity < 999) {
            obj.Quantity += 1;
            $scope.sumPrice += obj.color.prices.Price;
            $scope.sumPriceShow = numberFormat.format($scope.sumPrice);
        }
    }

    $scope.go_payment_info =function (Cart){
        if (sessionStorage.getItem('login') != null && sessionStorage.getItem('login') == "1"){
            var c = [];
            Cart.forEach((item)=>{
                c_item = {};
                c_item.id = item.id;
                c_item.ColorID = item.ColorID;
                c_item.CustomerID = item.CustomerID;
                c_item.Quantity = item.Quantity;
                c_item.created_at = item.created_at;
                c.push(c_item)
            })
            
            connect_api_data('post',baseApi+cartController+'update_carts',c,(res)=>{
                sessionStorage.setItem("cart", JSON.stringify(c));
                window.location.href = 'payment_info';
            })
        }
        else{
            toastr.info('Bạn cần đăng nhập');
        }
    }


    $scope.addOrder = function () {
        $scope.Order.Amount = $scope.sumPrice;
        $scope.Order.OrderDetail = $scope.Cart
        $http({
            method: 'post',
            params: { json: ConvertToJsonString($scope.Order) },
            url: '/Order/InsertOrder'
        }).then(function success(res) {
            toastr.success("Đặt hàng thành công");
            //Reset Cart
            $scope.Cart = []
            $scope.sumPrice = 0;
            $scope.sumPriceShow = numberFormat.format("0");
            $rootScope.CartQuantity = 0;
            localStorage.setItem('cartQuantity', $rootScope.CartQuantity);
            localStorage.setItem('cartQuantity',0);
        }, function error(res) {
            console.log(res);
        })
    }

    $.getJSON("assets_guess/Javascript/cities.json", function(json) {
        $scope.citis = json
    });
    
    $.getJSON("assets_guess/Javascript/districts.json", function(json) {
        $scope.districts = json
    });

    $.getJSON("assets_guess/Javascript/wards.json", function(json) {
        $scope.wards = json
    });

    $scope.city_change =function(city){
        $scope.districts_change = $scope.districts.filter(record => record.parent_code == city.code)
    }

    $scope.district_change =function(district){
        $scope.wards_change = $scope.wards.filter(record => record.parent_code == district.code)
    }

    $scope.go_voucher = function(){
        if($scope.ward == null){
            toastr.info("Hãy chọn xã");
        }
        else{
            if (typeof $scope.Address_detail !== 'undefined'){
                $scope.Order.Address = $scope.ward.path + $scope.Address_detail;
            }
            else{
                $scope.Order.Address = $scope.ward.path;
            }
        }
        
    }
})

const numberFormat = new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND',
});

function ConvertToJsonString(obj) {
    var CustomerID = obj.CustomerID;
    var DeliveryAddress = obj.DeliveryAddress;
    var Phone = obj.Phone;
    var Amount = obj.Amount;
    var OrderDetails = "";
    for (var i = 0; i < obj.OrderDetail.length; i++) {
        var OrderDetail = obj.OrderDetail[i];
        var ColorID = OrderDetail.ColorID;
        var MemoryID = OrderDetail.MemoryID;
        var ProductID = OrderDetail.ProductID;
        var Quantity = OrderDetail.Quantity;
        OrderDetails += `{
                    "ColorID" : "`+ ColorID+`",
                    "MemoryID" : "`+ MemoryID+`",
                    "ProductID" : "`+ ProductID+`",
                    "Quantity" : "`+ Quantity+`"
                            },`
    }
    OrderDetails = OrderDetails.slice(0, -1);
    var main = `{`;
    main += `"CustomerID": "` + CustomerID + `",
            "DeliveryAddress":"`+ DeliveryAddress + `",
            "Phone":"`+ Phone + `",
            "Amount":"`+ Amount + `",
            "OrderDetails" : [`+ OrderDetails + `]}`
    return main;
}