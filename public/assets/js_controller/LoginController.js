const app = angular.module('login-app', []);
const staffsController = 'staffs/';
const baseApi = 'http://localhost:8000/api/';
 
app.controller('loginController', loginController);
function loginController($scope, $http) {
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
      (error) => {console.log(error);toastr.error('Lỗi rồi');}
    );
   }
  // init
  $scope.staff = {};

  $scope.login = function (){
      console.log('ga');
    connect_api_data('post',baseApi+staffsController+'checkLogin',$scope.staff,(res)=>{
      var staff = res.data
      console.log(res);
      if(res.data==""){
        //sai mật khâu tài khoản
        toastr.info("Sai tài khoản hoặc mật khẩu!!");
      }
      else{
        var login = {};
        login.id = staff.id
        login.role = staff.RoleID
        login.staffname = staff.StaffName
        sessionStorage.setItem('login',JSON.stringify(login));
        window.location.replace('/admin')
      }
    })
  }
}