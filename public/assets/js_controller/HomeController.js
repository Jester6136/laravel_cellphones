const baseApi = 'http://localhost:8000/api/';
const productsController = 'products/';
const memoriesController = 'memories/';
const categoriesController = 'categories/';
const customersController = 'customers/';
const colorsController = 'colors/';
const orderdetailsController = 'orderdetails/';
const successStatus = 'success';
const errorStatus = 'error';

myapp.controller('homeController', homeController);
function homeController($scope, $http) {
    var connect_api = function (method,url,callback) { 
        $http({
          method: method,
          url: url,
        }).then(
          function (response) {
            callback(response);
          },
          (error) => {console.log(error);toastr.error(errorStatus);}
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
          (error) => {console.log(error);showAlert(errorStatus);}
        );
       }

    var numberFormat = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
    });

    connect_api('get',baseApi+orderdetailsController+'getTopProductSell',(res)=>{
      $scope.orderdetails = res.data;
      console.log($scope.orderdetails);
    })

    connect_api('get',baseApi+orderdetailsController+'total',(res)=>{
      $scope.total = numberFormat.format(res.data);
    })
    connect_api('get',baseApi+orderdetailsController+'count_order',(res)=>{
      $scope.count_order =res.data;
    })
}