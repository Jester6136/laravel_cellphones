const baseApi = 'http://localhost:8000/api/';
const productsController = 'products/';
const memoriesController = 'memories/';
const categoriesController = 'categories/';
const ordersController = 'orders/';
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

    connect_api('post',baseApi+ordersController+'getSellYear',(res)=>{
      var data  = [];
      for(var item in res.data){
        data.push([item,res.data[item]]);
      }
      // console.log(data);
      var result1 = [];
      var result2 = [];

      var first_item = data[0][0][1];
      console.log(first_item);
      for(var i = 1 ; i<parseInt(first_item);i++){
        result1.push('Tháng '+i);
        result2.push(0);
      }

      for(var i=0;i<data.length;i++){
        element = data[i];
        sum_price_month = 0;
        for(var j = 0 ; j<element[1].length;j++){
          sum_price_month+=element[1][j].Amount;
        }
        result1.push('Tháng '+element[0])
        result2.push(sum_price_month)
        last_item = element[0];
      }
       
      const ctx = document.getElementById('myChart2').getContext('2d');
      const myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: result1,
              datasets: [{
                  label: 'Doanh thu (VNĐ)',
                  data: result2,
                  backgroundColor: 'rgba(75, 192, 192)',
                  borderColor:'rgba(75, 192, 192, 1)',
                  borderWidth: 1
              }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                position: 'bottom',
              }
            }
          }
      });
   })

   connect_api('post',baseApi+ordersController+'getStatusAnalysis',(res)=>{
    const ctx = document.getElementById('myChart').getContext('2d');
    ctx.canvas.width = 300;
    ctx.canvas.height = 300;
    const myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Chờ xác nhận', 'Đã xác nhận', 'Đang lấy hàng', 'Đã lấy hàng', 'Đã thanh toán', 'Đã hủy'],
            datasets: [{
                label: '# of Votes',
                data: res.data,
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(54, 162, 235)',
                    'rgba(255, 206, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(153, 102, 255)',
                    'rgba(255, 159, 64)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
          responsive: false,
          plugins: {
            legend: {
              position: 'bottom',
            }
          }
        }
    });
   })
}