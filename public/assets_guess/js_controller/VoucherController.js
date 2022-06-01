myapp.controller('VoucherController', function ($http, $scope, $rootScope) {
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
        (error) => {console.log(error);toastr.error('Lỗi');}
      );
     }

    $rootScope.Order = JSON.parse(sessionStorage.getItem('order'))


    $scope.order = function () {
        $rootScope.Order.Amount = $scope.Order.sumPrice;
        $rootScope.Order.OrderDetail = JSON.parse(sessionStorage.getItem('cart'))
        console.log($rootScope.Order);

        connect_api_data('post',baseApi+ordersController,$rootScope.Order,(res)=>{
          toastr.success("Đặt hàng thành công");
          //Reset Cart
          $scope.Cart = []
          $scope.sumPrice = 0;
          $scope.sumPriceShow = numberFormat.format("0");
          $rootScope.CartQuantity = 0;
          sessionStorage.setItem('cartQuantity', $rootScope.CartQuantity);
          sessionStorage.setItem('cartQuantity',0);
          window.location.replace('cart-success');
        })
        
    }
});

$('.box-option-config2').click(function(){
  if($(this).hasClass('active')){

  }
  else{
    for(var i=0;i<$('.box-option-config2').length;i++){
      $($('.box-option-config2')[i]).removeClass('active');
    }
  }
  console.log($(this).toggleClass('active'));
})