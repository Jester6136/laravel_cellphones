var myapp = angular.module('Myapp', ['angularUtils.directives.dirPagination','ngFileUpload']);//khai baso module

const baseApi = 'http://localhost:8000/api/';
const productsController = 'products/';
const memoriesController = 'memories/';
const categoriesController = 'categories/';
const colorsController = 'colors/';
const successStatus = 'success';
const errorStatus = 'error';


myapp.factory('Product_ROM', function () {
    return {
        ProductID : "",
        ProductName : "",
        CategoryName : "",
        BrandName : "",
        ImageName : ""
    };
});


var checkUnderined = function (o) {
    return typeof(o) == "undefined";
}
var ConvertToJsonString = function (Object) {
    var BrandName = Object.BrandName;
    var CategoryName = Object.CategoryName;
    var DateRelease = Object.DateRelease;
    var ImageName = Object.ImageName;
    var ProductName = Object.ProductName;
    var Memories = Object.Memories;
    var Base_Memories = ``;
    for (var i = 0; i < Memories.length; i++) {
        var MemoryName = Memories[i].MemoryName;
        var Number = Memories[i].Number;
        var Description = Memories[i].Description;
        var Base_Colors = ``;
        var Colors = Memories[i].Colors;
        for (var j = 0; j < Colors.length; j++) {
            var ColorName = Colors[j].ColorName;
            var Price = Colors[j].Price;
            var Quantity = Colors[j].Quantity;
            var ColorImage = Colors[j].ColorImage;
            Base_Colors = Base_Colors+`{
                              "ColorName": "`+ColorName+`",
                              "Price": "`+ Price + `",
                              "Quantity": "`+ Quantity + `",
                              "ColorImage": "`+ColorImage+`"
                            },`
        }
        Base_Colors = Base_Colors.slice(0,-1);
        Base_Memories = Base_Memories+`{
                           "MemoryName": "`+ MemoryName + `",
                           "Number": "`+ Number + `",
                           "Description": "`+ Description + `",
                           "Colors": [`+ Base_Colors +`]
                         },`
    }
    Base_Memories=Base_Memories.slice(0,-1);
    return `{
                  "BrandName": "`+ BrandName+`",
                  "CategoryName": "`+ CategoryName + `",
                  "DateRelease": "`+ DateRelease + `",
                  "ImageName": "`+ ImageName +`",
                  "Memories": [`+ Base_Memories+`],
                  "ProductName": "`+ ProductName +`"
                }`
}

function showAlert(status) {
    if (status === 'success')
    {
      toastr.success('Thành công! Chúc vui 🐱‍🏍', 'Thành công rồi', {
        progressBar: !0,
      });
    } else
    {
      toastr.error('Có lỗi, xử lý đi 😒', 'Có lỗi rồi', {
        progressBar: !0,
      });
    }
  }


//ProductDetailController
myapp.controller("productsController", function ($http, $scope, $rootScope, Product_ROM) {
    var connect_api = function (method,url,callback) { 
        $http({
          method: method,
          url: url,
        }).then(
          function (response) {
            callback(response);
          },
          (error) => {console.log(error);showAlert(errorStatus);}
        );
     }
    $('#dialogConfirmNewProduct').click(function () {
        $rootScope.Products.push(Product_ROM);
        Product_ROM.ProductID = "";
        Product_ROM.ProductName = "";
        Product_ROM.CategoryName = "";
        Product_ROM.BrandName = "";
        Product_ROM.ImageName = "";
        $scope.$apply();
    })

    $rootScope.NewProduct = [];
    connect_api('get',baseApi+productsController,(response)=>{
        var Products = response.data.products;
        $rootScope.Products = Products;
    })
    // $http({
    //     method: 'get',
    //     url: 'GetProductsByCategory',
    //     params: {
    //         categoryID: 'CT00000001'
    //     }
    // }).then(function Success(res) {
    //     var Products = res.data;
    //     $rootScope.Products = Products;

    // }, function Error(res) {
    //     alert("Lấp sản phẩm lỗi");
    // })

    $('#datatable-details').on('click', 'i[data-toggle]', function () {
        var $this = $(this),
            tr = $(this).closest('tr'),
            productID = $(this).parent().siblings()[0].id,
            memoryID = $(this).parent().siblings()[0].textContent;
        if ($this[0].dataset.toggle =='') {
            $this.removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
            connect_api('get',baseApi+memoriesController+productID,(res)=>{
                var data = GetMemoriesDetail(res.data);
                    var subtable = `<tr><td colspan="7"><table class="table mb-none">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Bộ nhớ tag</th>
                                    <th>Loại bộ nhớ</th>
                                    <th>Mô tả</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${data.join(' ')}
                            </tbody>
                        </table></td></tr>`
                    tr.after(subtable);
            })    
            $this[0].dataset.toggle = 'has';
            
        }
        else if ($this[0].dataset.toggle == 'sub') {
            $this.removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
            connect_api('get',baseApi+'memories/getcolordetails/'+memoryID,(res)=>{
                var data = GetProductDetail(res.data.colors);
                var subtable = `<tr><td colspan="7"><table class="table mb-none">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Màu tag</th>
                                <th>Màu</th>
                                <th>Ảnh</th>
                                <th>Giá hiện tại</th>
                                <th>Giá khởi điểm</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${data.join(' ')}
                        </tbody>
                    </table></td></tr>`
                tr.after(subtable);
            })
           
            $this[0].dataset.toggle = 'has2';
        }
        else if ($this[0].dataset.toggle == 'has2') {
            $this.removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
            $this[0].dataset.toggle = 'sub';
            tr.next().remove();
        }
        else if ($this[0].dataset.toggle == 'has') {
            $this.removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
            $this[0].dataset.toggle = '';
            tr.next().remove();
        }
    });

})
var GetProductDetail = function (details) {
    var detailContents = [];
    for (var i = 0; i < details.length; i++) {
        detailContents.push(`
                        <tr>
                            <th></th>
                            <th></th>
                            <td>${details[i].id}</td>
                            <td>${details[i].ColorName}</td>
                            <td  class="image_index"><img src="/assets/images/`+ details[i].ColorImage + `"/></td>
                            <td>${details[i].prices.Price}</td>
                            <td>${details[i].old_prices.Price}</td>
                        </tr>
                    `);
    }
    return detailContents;
}
var GetMemoriesDetail = function (details) {
    var detailContents = [];
    for (var i = 0; i < details.length; i++) {
        detailContents.push(`
                        <tr class="${details[i].ProductID}">
                            <td class=" text-center">
                                <i data-toggle="sub" class="fa fa-plus-square-o text-primary h5 m-none" id="" style="cursor: pointer;color:#a94629 !important;"></i>
                            </td>
                            <td>${details[i].id}</td>
                            <td>${details[i].MemoryName}</td>
                            <td>${details[i].Description}</td>
                        </tr>
                    `);
    }
    return detailContents;
}
//Cilck extend detail


//////////////////////Addproduct////////////////////////////
//1
myapp.controller("addProductController", function ($http, $scope, $rootScope, Upload, Product_ROM) {
    var connect_api = function (method,url,callback) { 
        $http({
          method: method,
          url: url,
        }).then(
          function (response) {
            callback(response);
          },
          (error) => {console.log(error);showAlert(errorStatus);}
        );
     }

    $('#dialogConfirmNewProduct').click(function () {
        $rootScope.Products.push(Product_ROM);
        Product_ROM.ProductID = "";
        Product_ROM.ProductName = "";
        Product_ROM.CategoryName = "";
        Product_ROM.BrandName = "";
        Product_ROM.ImageName = "";
        $scope.$apply();
    })
    connect_api('get',baseApi+categoriesController,(res)=>{
        var CategoryBrand = res.data;
        $scope.Categories = [];
        $scope.Brands = [];
        for (var i = 0; i < CategoryBrand.length; i++) {
            var Catetory = [];
            var category_tmp = CategoryBrand[i];
            Catetory.STT = i;
            Catetory.CategoryID = category_tmp.CategoryID;
            Catetory.CategoryName = category_tmp.CategoryName;
            $scope.Categories.push(Catetory);
            $scope.Categories[i].Brands = [];
            if (category_tmp.Brands != null) {
                for (var j = 0; j < category_tmp.Brands.length; j++) {
                    var Brand = []
                    var brand_tmp = category_tmp.Brands[j];
                    Brand.BrandID = brand_tmp.BrandID;
                    Brand.BrandName = brand_tmp.BrandName;
                    $scope.Categories[i].Brands.push(Brand);
                }
            }
        }
        $scope.CategoryBrand = CategoryBrand;
        // $rootScope.NewProduct.CategoryName = $scope.CategoryBrand[0].CategoryName;
        $scope.Brands = $scope.Categories[0].Brands;
        // $rootScope.NewProduct.BrandName = $scope.Brands[0].BrandName;
    })


    $('.category').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var index = optionSelected[0].className;
        $scope.Brands = $scope.Categories[index].Brands;
        $rootScope.NewProduct.BrandName = $scope.Brands[0].BrandName;
    });


    $rootScope.UploadFiles = function (file) {  
        $scope.SelectedFiles = file;
        if ($scope.SelectedFiles) {
            Upload.upload({
                url: 'UploadImage',
                data: { files: $scope.SelectedFiles }
            }).then(function Success(res) {
                $rootScope.tmpImage = res.data[0];
                toastr.success("Thêm ảnh thành công");
            }, function Error(res) {
                toastr.error("Thêm ảnh thất bại");
            })
        }
    }

    $('#dialogConfirmNewProduct').click(function () {
        $rootScope.NewProduct.ProductName = $rootScope.NewProduct.ProductName;
        $rootScope.NewProduct.DateRelease = $('#DateRelease').val();
        $rootScope.NewProduct.ImageName = $('#imageName')[0].textContent;
        $rootScope.NewProduct.CategoryName = $('#cName').val();
        $rootScope.NewProduct.BrandName = $('#brand').val();
        $rootScope.NewProduct.Memories = $rootScope.Memories;
        console.log($rootScope.NewProduct);
        $http({
            method: 'POST',
            url: 'InsertProduct',
            data: { p: ConvertToJsonString($rootScope.NewProduct) }
        }).then(function Success(res) {
            //console.log(res);
            //Set new to current view
            Product_ROM.ProductID = $('#fid').val();
            Product_ROM.ProductName = $rootScope.NewProduct.ProductName;
            Product_ROM.CategoryName = $rootScope.NewProduct.CategoryName;
            Product_ROM.BrandName = $rootScope.NewProduct.BrandName;
            Product_ROM.ImageName = $('#imageName')[0].textContent;
            toastr.success("Thêm thông tin sản phẩm thành công");
            //Reset value table
            $rootScope.NewProduct.ImageName = '';
            $rootScope.NewProduct = [];
            $rootScope.Memories = [];
            $rootScope.Colors = [];
            $rootScope.num = 0;
            $('#imageName').text('')
            $('#colorImage')[0].textContent = "";
            $('#impressive_image').removeClass('fileupload-exists').addClass('fileupload-new');
            //Reset ID
            $.get(`/Product/GetNextProductID`).done(
                function (res) {
                    $('#fid').val(res);
                }
            )
        }, function Error(res) {
            toastr.error("Thêm thông tin thất bại");
        })
    })

})

//2
myapp.controller("memoryTable", function ($http, $scope, $rootScope) {
    $rootScope.num = 0;
    $rootScope.Memories = [];


    $scope.addMemory = function (Memory) {
        $rootScope.num = $rootScope.num + 1;
        $scope.Memory.Number = $rootScope.num;
        $scope.Memory.MemoryName = $scope.Memory.MemoryName;
        if (checkUnderined($scope.Memory.Description)) {
            $scope.Memory.Description = "";
        }
        else
            $scope.Memory.Description = $scope.Memory.Description;
        $scope.Memory.Colors = [];
        $rootScope.Memories.push(Memory);
        $scope.Memory = {};
    }

    $(document).on('click', '.removeMemory', function () {
        var nodes = Array.prototype.slice.call(document.getElementById('ttable2').children),
            liRef = $(this).parent().parent()[0];
        var id = nodes.indexOf(liRef);
        $rootScope.Memories.splice($rootScope.Memories.indexOf(id), 1);
        $rootScope.$apply();
    });


    $('#ttable2').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            $.each($('#ttable2 tr.selected'), function (idx, val) {
                $(this).removeClass('selected');
            });
            $(this).addClass('selected');

            var nodes = Array.prototype.slice.call(document.getElementById('ttable2').children),
                liRef = document.getElementsByClassName('selected')[0];
            var id = nodes.indexOf(liRef);
            var Colors = $rootScope.Memories[id].Colors;
            $rootScope.Colors = Colors;
            $scope.$apply();
            $rootScope.$apply();
        }
    });


    $scope.addColor = function (Color) {
        $scope.Color.ColorName = $scope.Color.ColorName;
        $scope.Color.Price = $scope.Color.Price;
        $scope.Color.ColorImage = $('#colorImage')[0].textContent;
        $scope.Color.Quantity = $scope.Color.Quantity;
        $rootScope.Colors.push(Color);
        $('#colorImage')[0].textContent = "";
        $scope.Color = {};
        $scope.Color.ColorImage = '';
    }
})

////////////////////////////EditProduct////////////////////////////
myapp.controller("editProductController", function ($http, $scope, $rootScope) {
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
    
    function uploadFile (filedata, type = 'img') {
        $scope.image = filedata.name;
        //upload
        var postData = new FormData();
        postData.append('file', filedata);
        $.ajax({
          headers: { 'X-CSRF-Token': $('meta[name=csrf_token]').attr('content') },
          async: true,
          type: 'post',
          contentType: false,
          processData: false,
          url: baseApi + 'products/upload',
          data: postData,
          success: function (res) {
            console.log('success');
          },
          error: function (res) {
            console.log('loi');
          },
        });
    };
    var connect_api = function (method,url,callback) { 
        $http({
          method: method,
          url: url,
        }).then(
          function (response) {
            callback(response);
          },
          (error) => {console.log(error);showAlert(errorStatus);}
        );
     }





    $scope.Megaproduct = [];
    $rootScope.openDialogEdit = function (obj) {
        connect_api('get',baseApi+productsController+obj.id,(res)=>{
            $scope.Megaproduct = res.data;
            //Controller EDIT

            console.log($scope.Megaproduct);
            //Begin menu category
            connect_api('get',baseApi+categoriesController,(res)=>{
                var CategoryBrand = res.data;
                $scope.Categories = res.data;
                $scope.Categories = [];
                $scope.Brands = [];
                var index = 0;
                for (var i = 0; i < CategoryBrand.length; i++) {
                    var Catetory = [];
                    var category_tmp = CategoryBrand[i];
                    Catetory.STT = i;
                    Catetory.CategoryID = category_tmp.CategoryID;
                    Catetory.CategoryName = category_tmp.CategoryName;
                    $scope.Categories.push(Catetory);
                    $scope.Categories[i].brands = [];
                    if (category_tmp.brands != null) {
                        for (var j = 0; j < category_tmp.brands.length; j++) {
                            var Brand = []
                            var brand_tmp = category_tmp.brands[j];
                            Brand.BrandID = brand_tmp.BrandID;
                            Brand.BrandName = brand_tmp.BrandName;
                            $scope.Categories[i].brands.push(Brand);
                            if (brand_tmp.BrandID == $scope.Megaproduct.BrandID) {
                                index = i;
                            }
                        }
                    }
                }
                $scope.CategoryBrand = CategoryBrand;
                $scope.Brands = $scope.Categories[index].brands;
                $('#dialogEditmember').show();  
            })
            //end menu category 


            //begin Memoríe Colors
            $scope.Colors = [];
            $scope.eclickMemory = function (obj) {
                $scope.MemoryName = obj.MemoryName;
                $scope.MDescription = obj.Description;
                var id = obj.id;
                for (var i = 0; i < $scope.Megaproduct.memories.length; i++) {
                    if (id == $scope.Megaproduct.memories[i].id) {
                        $scope.Colors = $scope.Megaproduct.memories[i].colors;
                    }
                }
                ///EDIT MEMORY
                $scope.eeditMemory = function (MemoryName, MDescription) {
                    obj.MemoryName = MemoryName;
                    obj.Description = MDescription;
                    // connect_api('Put',baseApi+'memories/edit_memory?id='+obj.id+'&MemoryName='+MemoryName+'&Description='+MDescription,(res)=>{
                        connect_api_data('PUT',baseApi+memoriesController+obj.id,obj,(res)=>{
                        console.log(res);
                        toastr.success("Sửa thành công")
                    })
                }
                ///END EDIT MEMORY
            }

            
            //ADD Memory
            $scope.eaddMemory = function (MemoryName, MDescription) {
                if (MDescription == null) {
                    MDescription = "";
                }
                var status = 0;
                for (var i = 0; i < $scope.Megaproduct.memories.length; i++) {
                    if ($scope.Megaproduct.memories[i].MemoryName == MemoryName) {
                        status = 1;
                    }
                }
                if (status == 0) {
                    request = {};
                    request.ProductID = $scope.Megaproduct.id;
                    request.MemoryName = MemoryName;
                    request.Description = MDescription;
                    connect_api_data('post',baseApi+memoriesController,request,(res)=>{
                        var Memory = {};    
                        Memory.id = res.data.id;
                        Memory.MemoryName = MemoryName;
                        Memory.Description = MDescription;
                        $scope.Megaproduct.memories.push(Memory);
                    })
                    
                } else {
                    toastr.error("Đã tồn tại bộ nhớ này");
                }
            }
                //END add memory
            //

            //Click Color
            $scope.clickColor = function (obj) {
                $scope.EColorID = obj.id;
                $scope.EColorName = obj.ColorName;
                $scope.EPrice = obj.prices.Price;
                $scope.EQuantity = obj.Quantity;
                //If have image
                if (obj.ColorImage != "") {
                    $('#ecolorImage').removeClass('fileupload-new').addClass('fileupload-exists');
                    $scope.EColorImage = obj.ColorImage;
                }
                else {
                    $('#ecolorImage').removeClass('fileupload-exists').addClass('fileupload-new')
                    $scope.EColorImage = "";
                }
            }
            //
            //END change color click memory
            //END begin Memoríe Colors

            $('#eimageProduct').on('change', function (ev) {
                var filedata = this.files[0];
                uploadFile(filedata);
              });

            $('#Ecolorimage').on('change', function (ev) {
                var filedata = this.files[0];
                uploadFile(filedata);
              });

            //ADD Color 
            $scope.eaddColor = function (EColorID,EColorName, EPrice, EQuantity) {
                var index =-1;
                var checked = 0;

                var MemoryID = $('#ettable2 .selected').children()[0].textContent;
                for (var i = 0; i < $scope.Megaproduct.memories.length; i++) {
                    if ($scope.Megaproduct.memories[i].id == MemoryID) {
                        index = i;
                        if ($scope.Megaproduct.memories[i].colors != null) {
                            for (var j = 0; j < $scope.Megaproduct.memories[i].colors.length; j++) {
                                if ($scope.Megaproduct.memories[i].colors[j].ColorName == EColorName) {
                                    checked = 1;
                                }
                            }
                        }
                        
                        break;
                    }
                }
                if (checked == 0) {
                    var request =  {};
                    request.ProductID = $scope.Megaproduct.id;
                    console.log(index);
                    request.MemoryID = $scope.Megaproduct.memories[index].id;
                    
                    request.ColorName = EColorName;
                    request.ColorImage = $('#einputcolorImage')[0].textContent;
                    request.Quantity = EQuantity;
                    request.Price = EPrice;
                    connect_api_data('post',baseApi+colorsController,request,(res)=>{
                        var color = {}
                        color.ColorID = res.data.id;
                        color.ColorName = EColorName
                        color.prices={}
                        color.prices.Price = EPrice;
                        color.Quantity = EQuantity
                        color.ColorImage = $('#einputcolorImage')[0].textContent


                        toastr.success("Thành công");
                        if (typeof ($scope.Megaproduct.memories[index].colors) == 'undefined') {
                            $scope.Megaproduct.memories[index].colors = []
                            $scope.Megaproduct.memories[index].colors.push(color);
                            $scope.Colors = $scope.Megaproduct.memories[i].colors;
                        }
                        else
                            $scope.Megaproduct.memories[index].colors.push(color);
                    })
                 }
                else {
                    toastr.error("Màu đã tồn tại")
                }
            }

            //END ADD COLor


            //EDIT COLOR
            $scope.eeditColor = function (EColorID, EColorName, EPrice, EQuantity) {
                var ColorImage = $('#einputcolorImage')[0].textContent
                for (var i = 0; i < $scope.Megaproduct.memories.length; i++) {
                    
                    if (typeof ($scope.Megaproduct.memories[i].colors) == 'undefined') {
                        continue
                    }
                    for (var j = 0; j < $scope.Megaproduct.memories[i].colors.length; j++) {
                        if ($scope.Megaproduct.memories[i].colors[j].id == EColorID) {
                            var indexMemory = i
                            var indexColor = j
                            var request =  {};
                            request.ProductID = $scope.Megaproduct.id;
                            request.MemoryID = $scope.Megaproduct.memories[indexMemory].id;
                            
                            request.ColorName = EColorName;
                            request.ColorImage = $('#einputcolorImage')[0].textContent;
                            request.Quantity = EQuantity;
                            request.Price = EPrice;
                            connect_api_data('put',baseApi+colorsController+EColorID,request,(res)=>{
                                console.log(res);
                                $scope.Megaproduct.memories[indexMemory].colors[indexColor].ColorName = EColorName;
                                $scope.Megaproduct.memories[indexMemory].colors[indexColor].Quantity = EQuantity;
                                $scope.Megaproduct.memories[indexMemory].colors[indexColor].prices.Price = EPrice;
                                $scope.Megaproduct.memories[indexMemory].colors[indexColor].ColorImage = ColorImage;
                            })
                        }
                    }
                }
            }

            $scope.eRemoveMemory = function (obj) {
                connect_api('delete',baseApi+memoriesController+obj.id,()=>{
                    $scope.Memories.splice($scope.Memories.indexOf(obj), 1);
                })
            }

            $scope.eRemoveColor = function (obj) {
                $http({
                    url: 'DeleteColor',
                    params: { id: obj.ColorID },
                    method: 'post'
                }).then(function success(res) {
                    $scope.Colors.splice($scope.Colors.indexOf(obj), 1);
                }, function error() {
                    toastr.error("Xóa lỗi");
                })
            }
            //EDIT COlor
        })





        $('#eimpressive_image').removeClass('fileupload-new').addClass('fileupload-exists');
        
    }

    //change color click memory
    $('#ettable2').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            $.each($('#ettable2 tr.selected'), function (idx, val) {
                $(this).removeClass('selected');
            });
            $(this).addClass('selected');
        }
    });

    $('#ettable3').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $scope.EColorName = "";
            $scope.EPrice = "";
            $scope.EQuantity = "";
            $('#einputcolorImage')[0].textContent = "";
            $('#ecolorImage').removeClass('fileupload-exists').addClass('fileupload-new')
            $scope.$apply();
            $(this).removeClass('selected');
        }
        else {
            $.each($('#ettable3 tr.selected'), function (idx, val) {
                $(this).removeClass('selected');
            });
            $(this).addClass('selected');
        }
    });

    //Change category
    $('.ecategory').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var index = optionSelected[0].className;
        console.log(index);
        $scope.Brands = $scope.Categories[index].brands;
    });

    $scope.EditProduct = function (ProductID, ProductName, ReleaseDate) {
        var ImageName = $('#eimageName').text()
        $http({
            url: 'EditProduct',
            params: { id: ProductID, name: ProductName, date: ReleaseDate, imageName: ImageName },
            method: 'post'
        }).then(function success() {
            for (var i = 0; i < $rootScope.Products.length; i++) {
                if ($rootScope.Products[i].ProductID == ProductID) {
                    $rootScope.Products[i].ProductName = ProductName;
                    $rootScope.Products[i].ImageName = ImageName;
                }
            }
            toastr.success("Sửa thành công")
            $('#dialogEditmember').hide();
        }, function error() {
            toastr.error("Sửa thất bại")
        })
    }   
})

//click
$('#addToTablee').click(function () {
    $.get(`GetNextProductID`).done(
        function (res) {
            $('#fid').val(res);
        }
    )

    $('#dialogAddproduct').show();

});
$('.exit').click(function () {
    $('.workform').hide();
});

