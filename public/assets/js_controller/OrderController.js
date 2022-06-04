const invoicesController = 'invoices/';
const booksController = 'books/';
const suppliersController = 'suppliers/';
const baseApi = 'http://localhost:8000/api/';
const invoice_detailsController = 'invoice_details/';
const ordersController = 'orders/';
const nameChild = 'child/';
const successStatus = 'success';
const errorStatus = 'Error!';
 
myapp.controller('OrderController', OrderController);
function OrderController($scope, $http) {
    var OrderStatus = [
      {
          "id":1,
          "name":"Chờ xác nhận"
      },
      {
          "id":2,
          "name":"Đã xác nhận"
      },
      {
          "id":3,
          "name":"Đang lấy hàng"
      },
      {
          "id":4,
          "name":"Đã lấy hàng"
      },
      {
          "id":5,
          "name":"Đã thanh toán"
      },
      {
          "id":6,
          "name":"Đã hủy"
      }
  ];

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

  $scope.finding = "";
  $scope.currentPage = 1;
  $scope.pageSize = 10;
  $scope.item;
  $scope.total_invoice = 0;
  //get all invoices
  connect_api('post',baseApi + ordersController+'get_all',(response)=>{
    $scope.data = response.data;
    $scope.data.forEach((item)=>{
      item.created_at = convertDate(item.created_at)
      for(var i =0 ; i < OrderStatus.length;i++){
        element = OrderStatus[i];
        if( item.Status == element.id){
          item.Status_name =  element.name;
        }
      }
    })
    console.log($scope.data);
  })

  // connect_api('get',baseApi + order_statusController,(response)=>{
  //   $scope.statuses = response.data;
  // })
 
  // open modal
  $scope.openModal = function (row) {
    $scope.OrderStatus = OrderStatus;
    $scope.order = row;
    console.log(row);
    // console.log($scope.order);
    // row.order_status_id = String(row.order_status_id);
    $('#large').modal('show');
  }
     // Save data from modal
  $scope.saveData = function (order) {
    if(typeof  order.Status =='string'){
      order.Status = parseInt( order.Status);
    }
    console.log(order);
    connect_api_data('POST',baseApi+ordersController+'update_status',order,(res)=>{
      console.log(res);
      var objIndex = $scope.data.findIndex((obj => obj.id == order.id));
      $scope.data[objIndex] = order; 
      var objIndex2 = $scope.OrderStatus.findIndex((obj => obj.id == order.Status));
      $scope.data[objIndex].Status= $scope.OrderStatus[objIndex2].id;
      $scope.data[objIndex].Status_name= $scope.OrderStatus[objIndex2].name;
      $('#large').modal('hide');
    })
  };
  
  
}