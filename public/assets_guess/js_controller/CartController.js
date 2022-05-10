const cartController = "cart/";
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
    

    if (localStorage.getItem("cartQuantity") === null) {
        $rootScope.CartQuantity = 0
    }
    else {
        $rootScope.CartQuantity = localStorage.getItem('cartQuantity');
    }
    $scope.Order = [];
    $scope.Cart = []
    $scope.sumPrice = 0;
    $scope.sumPriceShow = "0";

   
    // if (sessionStorage.getItem('login') != null && sessionStorage.getItem('login') == "1") {
    //     var user = JSON.parse(sessionStorage.getItem('khach'));
    //     var UserID = user.CustomerID
    //     var DeliveryAddress = user.DeliveryAddress;
    //     var Phone = user.Phone;
    //     var CustomerName = user.CustomerName;
    //     $scope.Order.CustomerID = UserID;
    //     $scope.Order.CustomerName = CustomerName;
    //     $scope.Order.DeliveryAddress = DeliveryAddress;
    //     $scope.Order.Phone = Phone;


    connect_api('get',baseApi+cartController,(res)=>{
        $scope.Cart = res.data;
        console.log($scope.Cart );
        for(var i=0;i<$scope.Cart.length;i++){
            var element = $scope.Cart[i];
            $scope.sumPrice+=element.color.prices.Price*element.Quantity;
            element.old_prices = numberFormat.format(element.color.old_prices.Price)
            element.new_price = numberFormat.format(element.color.prices.Price)
        }
        $scope.sumPriceShow = numberFormat.format($scope.sumPrice);
    })
    // }
    // else {
    //     toastr.info("Hãy đăng nhập để xem giỏ hàng của bạn");
    // }

    $scope.delete = function (obj) {
        $scope.Cart.splice($scope.Cart.indexOf(obj), 1);
        $http({
            method: 'post',
            url: '/Cart/DeleteCart',
            params: {cartID : obj.CartID}
        }).then(function success() {
            toastr.success("Đã xóa sản phẩm khỏi giỏ hàng")
            $rootScope.CartQuantity -= 1;
            localStorage.setItem('cartQuantity', $rootScope.CartQuantity);
        }, function error() {
            toastr.info("Lỗi giỏ hàng");
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
    $scope.addOrder = function () {
        $scope.Order.Amount = $scope.sumPrice;
        $scope.Order.OrderDetail = $scope.Cart
        console.log($scope.Order);
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