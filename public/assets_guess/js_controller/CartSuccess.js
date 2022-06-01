
myapp.controller('cartsuccessController', function ($http, $scope, $rootScope) {

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
    login = sessionStorage.getItem('login')
    connect_api('get',baseApi+ordersController+'showByCusID/'+login,(res)=>{
      console.log(res.data);
        $scope.order = res.data;

        $scope.order.Amount = numberFormat.format($scope.order.Amount)

        for(var i = 0 ; i<OrderStatus.length;i++){
          var element = OrderStatus[i];
          if(element.id == $scope.order.Status){
              $scope.order.Status = element.name;
          }
        }
        for(var i=0;i<$scope.order.orderdetails.length;i++){
          var element = $scope.order.orderdetails[i];
          // $scope.sumPrice+=element.new_price*element.Quantity;
          if(element.color.old_prices!=null){
            element.color.old_prices.Price = numberFormat.format(element.color.old_prices.Price)
          }
          element.single_price = numberFormat.format(element.single_price)
        } 
    },"")
})