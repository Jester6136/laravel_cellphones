

myapp.controller('BrandController', function ($http, $scope, $rootScope) {
  $scope.finding = '';
  $scope.currentPage = 1;
  $scope.pageSize = 10;
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
    var url = window.location.pathname;
    var id = url.substring(url.lastIndexOf('/') + 1);
   connect_api('get',baseApi+productsController+'getprocductbybrand/'+id,(res)=>{
    var data = res.data;
    console.log(data);
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
    $scope.Products = Products;

    },"")

    $scope.getProduct = function (pd) {
      localStorage.setItem('product', JSON.stringify(pd))
      window.location="/productdetail";
  }
})