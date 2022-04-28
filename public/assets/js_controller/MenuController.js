// const myapp5 = angular.module('Myapp', ['angularUtils.directives.dirPagination']);//khai baso module

// myapp5.controller("menu", function ($rootScope, $window, $http, $scope) {
//     if (sessionStorage.getItem('login') != null) {
//         var islogin = sessionStorage.getItem('login');
//         if (islogin != "") {
//             var user = JSON.parse(islogin);
//             $rootScope.Name = user.StaffName;
//         }
//         else {
//             sessionStorage.clear();
//         }
//     }
//     else {
//         sessionStorage.clear();
//     }
    

//     $scope.Logout = function () {
//         sessionStorage.clear();
//         location.replace("/Administrator/Login/Login")
//     }
// })