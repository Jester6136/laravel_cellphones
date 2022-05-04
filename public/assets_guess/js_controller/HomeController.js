

myapp.controller('homeController', function ($http, $scope, $rootScope) {
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

    $scope.Products = [];

    connect_api('get',baseApi+productsController+'get15procduct/'+'11',(res)=>{
        console.log(res.data);
        $scope.Products = res.data[0];
        for( i = 0 ;i< $scope.Products.length;i++ ){
            prices = res.data[1][0];
            $scope.Products[i].old_price = prices[0]
            $scope.Products[i].min_price = prices[1]
        }
        $scope.Products = $scope.Products.map(function (product) {
            // product.ProductName = product.ProductName + peoduct 
            product.min_price = numberFormat.format(product.min_price)
            product.old_price = numberFormat.format(product.old_price)
            return product
        })
        console.log($scope.Products);
    })

    // $http({
    //     method: 'get',
    //     params: {},
    //     url: '/Home/GetTop15ProductPhone'
    // }).then(function success(res) {
    //     var Products = JSON.parse(JSON.parse(res.data));
    //     console.log(Products);

    //     Products = Products.map(function (product) {
    //         product.NewPrice = numberFormat.format(product.NewPrice)
    //         product.OldPrice = numberFormat.format(product.OldPrice)
    //         return product
    //     })
    //     $scope.Products = Products;
    // }, function error(res) {
    //     console.log(res)
    // })
    $scope.getProduct = function (pd) {
        localStorage.setItem('product', JSON.stringify(pd))
    }

    $scope.OldProducts = []
    $http({
        method: 'get',
        params: {},
        url: '/Home/GetOldProducts'
    }).then(function success(res) {
        var Products = JSON.parse(JSON.parse(res.data));
        console.log(Products);
        Products = Products.map(function (product) {
            product.NewPrice = numberFormat.format(product.NewPrice)
            product.OldPrice = numberFormat.format(product.OldPrice)
            return product
        })
        $scope.OldProducts = Products;
    }, function error(res) {
        console.log(res)
    })

})

const numberFormat = new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND',
});