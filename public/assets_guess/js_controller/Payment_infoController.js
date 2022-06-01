myapp.controller('Payment_infoController', function ($http, $scope, $rootScope) {
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
       
    $scope.sumPrice = 0;
    $scope.sumPriceShow = "0";
    connect_api('get',baseApi+cartController+sessionStorage.getItem('login'),(res)=>{
        console.log(res.data);
        var Cart = res.data;
        for(var i=0;i<Cart.length;i++){
            var element = Cart[i];
            $scope.sumPrice+=element.new_price*element.Quantity;
            element.old_price = numberFormat.format(element.old_price)
            element.new_price = numberFormat.format(element.new_price)
        }
        $scope.sumPriceShow = numberFormat.format($scope.sumPrice);


        $rootScope.Order={};
        $rootScope.Order.sumPrice = $scope.sumPrice;
        $rootScope.Order.sumPriceShow = $scope.sumPriceShow;
    },"")

     connect_api('get',baseApi+customersController+sessionStorage.getItem('login'),(res)=>{
        $scope.Order.CustomerName = res.data.CustomerName;
        $scope.Order.Phone = res.data.Phone;
        $scope.Order.Email = res.data.Email;
        $scope.Order.Address = "";
        $scope.Order.More = "";
    },"")

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
        if (sessionStorage.getItem('login') != null) {
            if($scope.ward == null){
                toastr.info("Hãy chọn xã");
            }
            else{
                if (typeof $scope.Address_detail !== 'undefined'){
                    $rootScope.Order.Address = $scope.Address_detail+", "+  $scope.ward.path ;
                }
                else{
                    $rootScope.Order.Address = $scope.ward.path;
                }
                $rootScope.Order.CustomerID = sessionStorage.getItem('login');
                
                sessionStorage.setItem('order',JSON.stringify($rootScope.Order))
                window.location.href = 'voucher';
                // connect_api_data('post',baseApi+ordersController,$rootScope.Order,(res)=>{
                    
                // })
            }
        }
        else{
            toastr.info("Hãy đăng nhập");
        }
        
    }
});