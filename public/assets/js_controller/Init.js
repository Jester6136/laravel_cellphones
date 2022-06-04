var myapp = angular.module('Myapp', ['angularUtils.directives.dirPagination','ckeditor']);//khai baso module
function convertDate(date) {
    let result;
    if (date)
      date = new Date(date);
      result = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes();
    return result;
  }
  
  myapp.controller('menu', menu);
  function menu($scope, $http) {
    $scope.staff_name = JSON.parse(sessionStorage.getItem('login')).staffname;


  }