﻿
const baseApi = 'http://localhost:8000/api/';
const productsController = 'products/';
const memoriesController = 'memories/';
const categoriesController = 'categories/';
const colorsController = 'colors/';


myapp.controller("menuController", function ($scope, $http, $rootScope) {
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


    if (localStorage.getItem("cartQuantity") === null) {
        $rootScope.CartQuantity = 0
    }
    else {
        $rootScope.CartQuantity = localStorage.getItem('cartQuantity');
    }

    connect_api('get',baseApi+categoriesController,(res)=>{
        $scope.categories = res.data;
        console.log($scope.categories);
    })

    // $http.get("/Home/GetMenu").then(function Success(res) {
    //     var table = JSON.parse(JSON.parse(res.data));
    //     var keys = Object.keys(table);
    //     ids = keys.map(function (key) {
    //         var dollar = key.indexOf('$')+1
    //         return key.slice(dollar,-40)
    //     });
    //     categoriesName = keys.map(function (key) {
    //         var dollar = key.indexOf('$')
    //         return key.slice(0, dollar)
    //     });
    //     icons = keys.map(function (key) { return key.slice(-40).trim() })

        
    //     menu = {};

    //     //Create object categories
    //     var categories=[];
    //     for (let i = 0; i < keys.length; i++) {
    //         var category = new Object();
    //         category.categoryID = ids[i];
    //         category.categoryName = categoriesName[i];
    //         category.icon = icons[i]
    //         //Add list brands in each category
    //         var brands=[]
    //         brand_ref = table[keys[i]];
    //         for (let j = 0; j < brand_ref.length; j++) {
    //             brands.push({ BrandID: brand_ref[j].BrandID, BrandName: brand_ref[j].BrandName, CategoryID: brand_ref[j].CategoryID });
    //         }
    //         category.brands = brands;
    //         categories.push(category)
    //     }
    //     $scope.PushBrand = function (categoryID) {
    //         var category = categoryID
    //         localStorage.setItem("category", category)
    //     }

    //     $scope.PushBrand = function (categoryID, brandID) {
    //         var brand = categoryID + brandID
    //         localStorage.setItem("brand",brand)
    //     }
    //     //sort categories by CategoryID
    //     categories.sort((a, b) => parseInt(a.categoryID.slice(-8)) - parseInt(b.categoryID.slice(-8)))

    //     $scope.categories = categories;
    // }, function Error(err) {
    //     alert(err);
    // })
})

myapp.controller("loginController", function ($rootScope, $window, $http, $scope) {
    if (sessionStorage.getItem('login') != null) {
        var islogin = sessionStorage.getItem('login');
        var user = JSON.parse(sessionStorage.getItem('khach'));
    }
    if (islogin == "1") {
        $rootScope.Status = user.CustomerName;
    }
    else {
        $rootScope.Status='Login'
    }
    $('#c').click(function () {
        $('.mainn').hide();
    })  
    $rootScope.close = "";
    $rootScope.Khach = null;
    $rootScope.remember = false;
    $rootScope.userName = "";
    $rootScope.Login = function (un, pw, rp) {
        $http({
            method: 'get',
            params: {
                us: un,
                pw: pw,
                rp: rp
            },
            url:'/Home/Login'
        }).then(function (d) {
            if (d.data.login == "0") {
                $rootScope.Status = "Login"
            }
            else {
                //Get quantity cart
                $http({
                    method: 'get',
                    params: { id: d.data.Khach.CustomerID },
                    url: '/Cart/GetCartQuantity'
                }).then(function success(res) {
                    $rootScope.CartQuantity = parseInt(JSON.parse(res.data));
                    localStorage.setItem('cartQuantity', $rootScope.CartQuantity);
                }, function error(e) {
                    console.log(e);
                })
                //Get quantity cart
                sessionStorage.setItem("login", d.data.login);
                sessionStorage.setItem("khach", JSON.stringify(d.data.Khach));
                $rootScope.Status = d.data.Khach.CustomerName
                $('.mainn').hide();
                location.reload();
            }
        }, function error(e) {
            sessionStorage.setItem("login", "0");
            sessionStorage.setItem("khach", "");
        });
    }
    $rootScope.LInLout = function () {
        if ($rootScope.lInOut == "SignIn") {
            $rootScope.Finout = "#myModal";
        }
        else {
            $rootScope.Finout = "";
            $rootScope.Logout();
        }
    }

   $('#login').click(function () {
       $('.mainn').show();
   })

    $('#login1').click(function () {
        var email = $('#mail').val();
        var pass = $('#pass').val();
    })

})
