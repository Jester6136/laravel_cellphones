const invoicesController = 'invoices/';
const booksController = 'books/';
const suppliersController = 'suppliers/';
const baseApi = 'http://localhost:8000/api/';
const invoice_detailsController = 'invoice_details/';
const nameChild = 'child/';
const successStatus = 'success';
const errorStatus = 'Error!';
 
myapp.controller('invoicesController', InvoicesController);
function InvoicesController($scope, $http) {

  const modalE = $('#large');

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
  //set begin
  $scope.currentPage = 1;
  $scope.currentPage2 = 1;
  $scope.pageSize = 10;
  $scope.q = "";
  $scope.qt = "";
  $scope.total_invoice = 0;
  
  $scope.InvoiceStatus = [
    {
        "id":1,
        "name":"Đặt hàng"
    },
    {
        "id":2,
        "name":"Đang giao dịch"
    },
    {
        "id":3,
        "name":"Hoàn thành"
    },
    {
        "id":4,
        "name":"Đã hủy"
    }
];
  //get all invoices
  connect_api('get',baseApi + invoicesController,(response)=>{
    $scope.data = response.data;
    console.log($scope.data);
    $scope.data.forEach((item)=>{
      item.invoice_date = convertDate(item.invoice_date);
      item.status_name = $scope.InvoiceStatus.find((x)=>x.id==item.status).name;
    })
  })

  connect_api('get',baseApi + 'color/'+'get_basic',(res)=>{
    $scope.colors = res.data;
    console.log($scope.colors);
  })

  connect_api('get',baseApi + suppliersController,(response)=>{
    $scope.suppliers = response.data.suppliers;
    console.log($scope.suppliers);
  })
 
  // open modal
  $scope.openModal = function (id) {
    $scope.publisher = {};
    $scope.selected_invoice_details ={};
    // CKEDITOR.replace( 'des' );
    $scope.id = id;
    if (id == 0) {
      $scope.is_create = true;
      $scope.invoice_details = [];
      $scope.invoice = {};
      $scope.invoice.discount = 0;
      $scope.invoice.total = 0;
      $scope.publisher_name ="";
      //
      $scope.total_invoice = 0;
      //
      $scope.isCreate = true;
      $scope.modalTitle = 'Nhập hàng';
      $scope.color = null;
    } else {
      $scope.is_create = false;
      $scope.invoice_details = [];
      $scope.invoice = {};
      $scope.invoice.discount = 0;
      $scope.invoice.total = 0;
      $scope.publisher_name ="";
      //
      $scope.total_invoice = 0;

      $scope.isCreate = false;
      $scope.modalTitle = 'Chỉnh sửa hóa đơn nhập';

      connect_api('get',baseApi + invoicesController + $scope.id,(response)=>{

        $scope.invoice = response.data;

        console.log($scope.invoice);

        $scope.invoice.supplier_id = String($scope.invoice.supplier_id);
        $scope.invoice_details = $scope.invoice.invoice_details;

        //set ban dau cho nxb
        index= $scope.suppliers.findIndex((obj=>obj.id == $scope.invoice.supplier_id))
        $scope.supplier_name = $scope.suppliers[index].supplier_name;

        $scope.total_invoice = 0;
        for(var i = 0 ;i<$scope.invoice_details.length;i++){
          $scope.total_invoice  += $scope.invoice_details[i].total;
        }        
      })
    }
    $('#large').modal('show');
  };
  // Save data from modal
  $scope.saveData = function () {
    //Insert
    if ($scope.id == 0) {
      $scope.invoice.invoice_details = $scope.invoice_details;
      $scope.invoice.status_name = $scope.InvoiceStatus.find((x)=>x.id==$scope.invoice.status).name;
      var time = new Date();
      $scope.invoice.invoice_date = convertDate(time);
      
      connect_api_data('POST',baseApi+invoicesController,$scope.invoice,(res)=>{
        $scope.invoice.id = res.data.id;
        $scope.data.push($scope.invoice);
        toastr.success('Thêm thành công');
        modalE.modal('hide');
      })
    } else {
      //Update
      $scope.invoice.invoice_details = $scope.invoice_details;
      var time = new Date();
      $scope.invoice.invoice_date = convertDate(time);
      $scope.invoice.status_name = $scope.InvoiceStatus.find((x)=>x.id==$scope.invoice.status).name;
      connect_api_data('PUT',baseApi+invoicesController+$scope.id,$scope.invoice,(res)=>{
        console.log(res);
        var objIndex = $scope.data.findIndex((obj => obj.id == $scope.id));
        $scope.data[objIndex] = $scope.invoice; 
        toastr.success('Cập nhật thành công');
        modalE.modal('hide');
      })
    }
  };
  // Delete
  $scope.deleteClick = function (id) {
    var hoi = confirm('Ban co muon xoa that khong');
    // console.log($scope.id);
    if (hoi) {
      $http({
        method: 'DELETE',
        url: baseApi + invoicesController + id,
      }).then(
        function (response) {
          $scope.message = response.data;
          location.reload();
          showAlert(successStatus);
        },
        (error) => {
          console.log(error);
          showAlert(errorStatus);
        }
      );
    }
  };

  $scope.selected_row = function (row){
    if($('#invoice_details tr.selected').length !=0){
      $scope.selected_invoice_details = {};
    }
    else{
      $scope.selected_invoice_details = angular.copy(row);
    }
    console.log($scope.selected_invoice_details);
  }

  $scope.color_selected = function (color){
    var objIndex  = $scope.invoice_details.findIndex((obj => obj.colorID == color.id))
    if(objIndex==-1){
      var invoice_detail = {};
      invoice_detail.colorID = color.id;
      invoice_detail.color = color;
      invoice_detail.discount = 0;
      invoice_detail.price = 0;
      invoice_detail.quantity = 0;
      invoice_detail.total = 0; 
      $scope.invoice_details.push(invoice_detail);
      $scope.selected_invoice_details = angular.copy(invoice_detail);
      for(var i = 0 ;i<$scope.invoice_details.length;i++){
          $scope.total_invoice  += $scope.invoice_details[i].total;
        }
        console.log($($('#invoice_details tr')[($('#invoice_details tr').length)-1]));
        $($('#invoice_details tr')[1]).addClass('selected')
      }
    else{
      toastr.info('Đã tồn tại sản phẩm này');
      // showAlert(errorStatus);
    }
    
  }

  $scope.supplier_change = function (id){
    $scope.invoice.supplier_id = id; 
    if($scope.suppliers !== undefined){
      index= $scope.suppliers.findIndex((obj=>obj.id == id))
      var supplier = $scope.suppliers[index]
      
      $scope.invoice.suppliers = supplier; 
      $scope.supplier_name = supplier.supplier_name
    }
  }

  $scope.update = function (selected_invoice_details){
    console.log(selected_invoice_details);
    if(selected_invoice_details.colorID === undefined){
      toastr.info("Bạn cần chọn 1 sản phẩm!");
    }
    else{
      selected_invoice_details.discount = parseInt(selected_invoice_details.discount)
      selected_invoice_details.price = parseFloat(selected_invoice_details.price)
      selected_invoice_details.quantity = parseInt(selected_invoice_details.quantity)
      selected_invoice_details.total = selected_invoice_details.quantity * selected_invoice_details.price * (100-selected_invoice_details.discount)/100
      var objIndex = $scope.invoice_details.findIndex((obj => obj.colorID == selected_invoice_details.colorID))
      $scope.invoice_details[objIndex] = selected_invoice_details; 
    
      $scope.total_invoice = 0; 
      for(var i = 0 ;i<$scope.invoice_details.length;i++){
        $scope.total_invoice  += $scope.invoice_details[i].total;
      }
      $scope.invoice.total = $scope.total_invoice * (100-$scope.invoice.discount)/100;
    }
    $scope.selected_invoice_details = {};
  }
  
  $scope.deleteClick_createform = function (row){
    console.log(row);
    var objIndex = $scope.invoice_details.findIndex((obj => obj.colorID == row.colorID))
    $scope.total_invoice = $scope.total_invoice - (row.total);
    $scope.invoice.total = $scope.total_invoice * (100-$scope.invoice.discount)/100;
    $scope.invoice_details.splice(objIndex, 1);
  }

  $scope.invoice_discount_change = function (discount){
    $scope.invoice.total = $scope.total_invoice * (100-discount)/100;
  }
  $('#invoice_details').on('click', 'tr', function () {
    if ($(this).hasClass('selected')) {
        $(this).removeClass('selected');
    }
    else {
        $.each($('#invoice_details tr.selected'), function (idx, val) {
            $(this).removeClass('selected');
        });
        $(this).addClass('selected');
    }
  });

  
}