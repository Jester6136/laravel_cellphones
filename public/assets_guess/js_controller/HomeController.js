
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

    connect_api('post',baseApi+productsController+'get15product',(res)=>{
        var data = res.data;
        var Products =[];

        data.forEach((product)=>{
            var memories = product.memories;
            memories.forEach((memory)=>{
                memory.old_price = numberFormat.format(memory.old_price)
                memory.min_price = numberFormat.format(memory.min_price)
                Products.push(memory);
            })
        })
        Products = Products.slice(0,15);
        $scope.Products = Products;

    },"")

    connect_api('post',baseApi+productsController+'get5product',(res)=>{
        console.log(res);
        var data = res.data;
        var Products =[];

        data.forEach((product)=>{
            var memories = product.memories;
            memories.forEach((memory)=>{
                memory.old_price = numberFormat.format(memory.old_price)
                memory.min_price = numberFormat.format(memory.min_price)
                Products.push(memory);
            })
        })

        console.log(Products);
        
        Products = Products.slice(0,5);
        $scope.Computer_Products = Products;

    },"")

    $scope.getProduct = function (pd) {
        localStorage.setItem('product', JSON.stringify(pd))
        window.location.href="productdetail";
    }

    // $scope.OldProducts = []
    // $http({
    //     method: 'get',
    //     params: {},
    //     url: '/Home/GetOldProducts'
    // }).then(function success(res) {
    //     var Products = JSON.parse(JSON.parse(res.data));
    //     console.log(Products);
    //     Products = Products.map(function (product) {
    //         product.NewPrice = numberFormat.format(product.NewPrice)
    //         product.OldPrice = numberFormat.format(product.OldPrice)
    //         return product
    //     })
    //     $scope.OldProducts = Products;
    // }, function error(res) {
    //     console.log(res)
    // })

})
