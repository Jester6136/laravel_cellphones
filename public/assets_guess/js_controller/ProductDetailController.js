const cartController = "cart/";
myapp.controller('ProductDetailController', function ($http, $scope, $rootScope) {
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

    var ROM_product = JSON.parse(localStorage.getItem('product'));
    console.log(ROM_product)
    //Set begin price
    $rootScope.OldPrice = ROM_product.old_price;
    $rootScope.NewPrice = ROM_product.min_price;
    $rootScope.SelectedProduct =[];
    $rootScope.SelectedProduct.ProductID = ROM_product.ProductID;
    $rootScope.SelectedProduct.MemoryID = ROM_product.id;
    
    //Get Product

    connect_api('get',baseApi+'products/getprocductdetail/'+ ROM_product.ProductID,(res)=>{
        var product = res.data[0];
        var price_memories = res.data[1];
        // product.memories.forEach(x=> x.old_price = )
        for(var i = 0; i< product.memories.length;i++){
            element = product.memories[i];
            element.old_price = numberFormat.format(price_memories[i][0])
            element.new_price = numberFormat.format(price_memories[i][1])
        }
        
        console.log(product);
        $rootScope.Product={};
        $rootScope.Product.Memories = []
        $rootScope.Product.Memories = product.memories;
        //Selected product
        $rootScope.SelectedProduct.ProductName = product.ProductName;
        var Selected_Memo;
        for (var i = 0; i < product.memories.length; i++) {
            if (product.memories[i].id == ROM_product.id) {
                Selected_Memo = product.memories[i];
                $rootScope.Product.Memories[i].active = 'active'
            }

            for (var j = 0; j < product.memories[i].colors.length; j++) {
                //Get begin image color
                if (product.memories[i].colors[j].id == ROM_product.ColorID)
                    $rootScope.BigImage = product.memories[i].colors[j].ColorImage;
                product.memories[i].colors[j].prices.Price = numberFormat.format(product.memories[i].colors[j].prices.Price)
            }
            //Set product memory colors
            $rootScope.Product.Memories[i].Colors = product.memories[i].colors;
        }
        $rootScope.Colors = Selected_Memo.Colors
        $rootScope.Product.ProductName = product.ProductName;
        $rootScope.Product.ProductID = product.ProductID;
        $rootScope.Product.CategoryName = product.categories.CategoryName;
        $rootScope.Product.BrandName = product.brands.BrandName;
        $rootScope.Product.ImageName = product.image;
        $(".full-detail").html(product.Description.replaceAll('###','"'));
        $rootScope.Product.Description = product.Description;
        $rootScope.BigImage = ROM_product.colors[0].ColorImage;
    },"" )
    //chang status memo
    $('.config').on('click', '.box-option-config', function () {
        if ($(this).hasClass('active')) {
        }
        else {
            $.each($('.config div.active'), function (idx, val) {
                $(this).removeClass('active');
            });
            $(this).addClass('active');
            var name_memo = $(document.getElementsByClassName('active')[0]).children('p')[0].textContent
        }
    })
    //change status color
    $('.color').on('click', '.box-option-color', function () {
        if ($(this).hasClass('active')) {
        }
        else {
            $.each($('.color div.active'), function (idx, val) {
                $(this).removeClass('active');
            });
            $(this).addClass('active');
            /*  var name_memo = $(document.getElementsByClassName('active')[0]).children('p')[0].textContent*/
        }
    })
    //Change memoryname
    $(document).ready(function () {
        memo_VIEW = $('.memoname')
        for (var i = 0; i < memo_VIEW.length; i++) {
            if ($(memo_VIEW[i]).text() == Selected_Memo.MemoryName) {
                $(memo_VIEW[i]).parent().addClass('active')
            }
        }
    })
    //change memory
    $scope.selectColor = function (memo) {
        $rootScope.OldPrice = memo.old_price;
        $rootScope.NewPrice = memo.new_price;
        $rootScope.Colors = memo.Colors
        $rootScope.SelectedProduct.MemoryID = memo.MemoryID;
        $rootScope.SelectedProduct.MemoryName = memo.MemoryName;
    }
    //change image color
    $scope.selectBigImage = function (color) {
        $rootScope.BigImage = color.ColorImage;
    }
    //change color price
    $scope.selectColorPrice = function (color) {    
        $rootScope.SelectedProduct.ColorID = color.id
        $rootScope.SelectedProduct.ColorName = color.ColorName
        $rootScope.SelectedProduct.NewPrice = color.Price
        $rootScope.SelectedProduct.OldPrice = ROM_product.OldPrice;
    }
    //add to cart
    $scope.addCart = function (SelectedProduct) {
        connect_api('get',baseApi+cartController,(res)=>{
            console.log(res.data);
            
        })
        //If login
        // if (sessionStorage.getItem('login') != null && sessionStorage.getItem('login') == "1") {
            //Get object cart
            $scope.tocart = []
            var user = JSON.parse(sessionStorage.getItem('khach'));
            // $scope.tocart.UserID = user.CustomerID
            $scope.tocart.UserID = 1;
            $scope.tocart.ColorID = SelectedProduct.ColorID;
            var newcartJson = ConvertToJsonString($scope.tocart).replace(/\s/g, '');
            console.log(newcartJson);
            //If have
            if (typeof SelectedProduct.ColorID !== 'undefined') {
                connect_api_data('post',baseApi+cartController,$scope.tocart,(res)=>{
                    $rootScope.CartQuantity += 1;
                    localStorage.setItem('cartQuantity', $rootScope.CartQuantity);
                    window.location.href = 'cart';
                    console.log(res);
                })
            }
            else {
                toastr.info("Hãy chọn màu");
            }
        // }
        // else {
        //     toastr.info("Hãy đăng nhập");
        // }
       
    }
})
const numberFormat = new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND',
});
var ConvertToJsonString = function (Object) {
    var UserID = Object.UserID
    var ColorID = Object.ColorID;
    var MemoryID = Object.MemoryID;
    var ProductID = Object.ProductID;

    var base = ``;
    return `{"UserID": "` + UserID + `",
            "ColorID": "` + ColorID + `",
            "MemoryID": "` + MemoryID + `",
            "ProductID": "` + ProductID + `"
            }`
}

