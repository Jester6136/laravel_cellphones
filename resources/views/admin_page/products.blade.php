@extends('_admin_layout')
@section('content')

@section('css')    
    <link rel="stylesheet" href="/assets/vendor/select2/select2.css" />
    <link rel="stylesheet" href="/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
    <link rel="stylesheet" href="/assets/stylesheets/popup.css">
    <link rel="stylesheet" href="/assets/vendor/toast/toastr.min.css" />
    <link rel="stylesheet" href="/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
    <link href="/assets/vendor/jquery-datatables-bs3/assets/css/jquery.dataTables.min.css" rel="stylesheet" />
@stop

<section role="main" class="content-body">
    <header class="page-header">
        <h2>Quản lý sản phẩm</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Quản lý sản phẩm</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <section class="panel" ng-controller="productsController">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>
            <h2 class="panel-title">Danh sách sản phẩm</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6" style="float:left">
                    <div class="mb-md">
                        <button id="addToTablee" class="btn btn-primary">Thêm sản phẩm <i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="col-sm-6" style="float:left">
                    <div class="mb-md">
                        <input type="type" name="name" style="float:right;" placeholder="Tìm kiếm" value="" ng-model="q"/>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <!-- @*Test*@ -->
                <thead>
                    <tr>
                        <th></th>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Loại SP</th>
                        <th>Hãng SP</th>
                        <th>Ảnh chính</th>
                        <th style="width:55px;">Tác vụ</th>
                    </tr>
                </thead>
                <tbody id="ttable">
                <tr dir-paginate="Product in Products|filter: q|itemsPerPage:6" current-page="currentPage">
                        <td class=" text-center">
                            <i data-toggle="" class="fa fa-plus-square-o text-primary h5 m-none" id="" style="cursor: pointer;"></i>
                        </td>
                        <td id="@{{Product.id}}">@{{$index+1}}</td>
                        <td>@{{Product.ProductName}}</td>
                        <td>@{{Product.categories.CategoryName}}</td>
                        <td>@{{Product.brands.BrandName}}</td>
                        <td class="image_index"><img src="/assets/images/@{{Product.image}}" alt="Alternate Text" /></td>
                        <td class="actions" style="width:65px;">
                            <a href="" class="on-default editt-row" ng-click="openDialogEdit(Product)"><i class="fa fa-pencil"></i></a>
                            <a href="" class="on-default removeMember" ng-click="deleteProduct(Product)"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <dir-pagination-controls style="float: right; padding-right: 100px;"
                direction-links="true"
                boundary-links="true"
                >
            </dir-pagination-controls>
        </div>
    </section>
    <!-- end: page -->
</section>

<div id="dialog" class="modal-block mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Bạn có chắc chắn muốn xóa?</h2>
        </header>
        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-text">
                    <p>Bạn có chắc chắn muốn xóa sản phẩm này?</p>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button id="dialogConfirm" class="btn btn-primary">Xác nhận</button>
                    <button id="dialogCancel" class="btn btn-default">Đóng</button>
                </div>
            </div>
        </footer>
    </section>
</div>

<div class="mx-auto workform" id="dialogAddproduct" style="display: none;" ng-controller="addProductController">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-19 text-center">
            <div class="card">
                <h3 class="text-center mb-4">Nhập thông tin</h3>
                <form class="form-card" id="frmadd">
                    <div class="block" style=" background: seashell;">
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-4 flex-column d-flex"> <label class="form-control-label px-3">Mã sản phẩm<span class="text-danger"> *</span></label> <input type="text" id="fid" name="fid" placeholder="Nhập mã" required readonly> </div>
                            <div class="form-group col-sm-4 flex-column d-flex"> <label class="form-control-label px-3">Tên sản phẩm<span class="text-danger"> *</span></label> <input type="text" id="fname" name="fname" placeholder="Nhập Tên" ng-model="NewProduct.ProductName" required> </div>
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Ngày ra mắt<span class="text-danger"> *</span></label>
                                <input id="DateRelease" data-plugin-datepicker name="OrderDate" readonly autocomplete="on" ng-model="NewProduct.DateRelease" required>
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Loại sản phẩm<span class="text-danger"> *</span></label>
                                <select class="selectpicker category" id="cName" style="border: 1px solid #ccc; font-size: 14px;" ng-model="NewProduct.CategoryName">
                                    <option ng-repeat="Category in Categories" class="@{{Category.STT}}" value="@{{Category.id}}">@{{Category.CategoryName}}</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Hãng sản xuất<span class="text-danger"> *</span></label>
                                <select id="brand" class="selectpicker" style="border: 1px solid #ccc; font-size: 14px;" ng-model="NewProduct.BrandName">
                                    <option ng-repeat="Brand in Brands" value="@{{Brand.id}}">@{{Brand.BrandName}}</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Ảnh chính<span class="text-danger"> *</span></label>
                                <div class="fileupload fileupload-new" data-provides="fileupload" style="width: 100%;" id="impressive_image">
                                    <div class="input-append">
                                        <div class="uneditable-input">
                                            <span class="fileupload-preview" id="imageName" ></span>
                                        </div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Thay đổi</span>
                                            <span class="fileupload-new">Chọn ảnh</span>
                                            <input id="imageProduct" type="file" accept="image/*">
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-20" style="display: flex;"  ng-controller="memoryTable">
                        <div class="col-10 sub-block">
                            <div class="block" style=" background: oldlace;">
                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-12 flex-column d-flex" style="margin-bottom:15px;">
                                        <label class="form-control-label px-3">Bộ nhớ<span class="text-danger"> *</span></label>
                                        <input type="text" id="memory" list="memo" ng-model="Memory.MemoryName"/>
                                        <datalist id="memo">
                                            <option>2GB</option>
                                            <option>4GB</option>
                                            <option selected>8GB</option>
                                            <option>16GB</option>
                                            <option>32GB</option>
                                            <option>64GB</option>
                                            <option>128GB</option>
                                            <option>512GB</option>
                                            <option>1TB</option>
                                            <option>2TB</option>
                                        </datalist>
                                    </div>
                                </div>
                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-8 flex-column d-flex">
                                        <label class="form-control-label px-3">Mô tả<span class="text-danger"> *</span></label>
                                        <input type="text" id="memodiscription" ng-model="Memory.Description" name="memodiscription" placeholder="Nhập mô tả" required>
                                    </div>
                                    <div class="form-group col-sm-4 flex-column d-flex">
                                        <div class="col-md-12 text-right">
                                            <button id="dialogAddmemory" class="btn btn-primary  save" style="height: 55.2px; width: 80px;margin-right:10px;" type="button" ng-click="addMemory(Memory)">Thêm</button>
                                            </div>
                                    </div>  

                                </div>
                            </div>

                            <table class="table table-bordered table-striped mb-none" id="datatable-editable1">
                                <thead>
                                    <tr>
                                        <th class="center">STT</th>
                                        <th class="center">Bộ nhớ</th>
                                        <th class="center">Mô tả</th>
                                        <th class="center" style="width:65px;">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody id="ttable2">
                                    <tr class="gradeA" ng-repeat="Memory in Memories">
                                        <td>@{{Memory.Number}}</td>
                                        <td>@{{Memory.MemoryName}}</td>
                                        <td>@{{Memory.Description}}</td>
                                        <td class="actions" style="width:65px;">
                                            <a href="#" class="on-default removeMemory"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-10 sub-block">
                            <div class="block" style=" background: oldlace;">
                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-4 flex-column d-flex"> <label class="form-control-label px-3">Màu<span class="text-danger"> *</span></label> <input type="text" id="colorName" name="colorName" placeholder="Nhập Màu" required ng-model="Color.ColorName"> </div>
                                    <div class="form-group col-sm-4 flex-column d-flex"> <label class="form-control-label px-3">Giá<span class="text-danger"> *</span></label> <input type="text" id="price" name="price" placeholder="Nhập giá" required ng-model="Color.Price"> </div>
                                    <div class="form-group col-sm-4 flex-column d-flex"> <label class="form-control-label px-3">Số lượng<span class="text-danger"> *</span></label> <input type="text" id="quantityColor" name="quantityColor" placeholder="Số lượng" required ng-model="Color.Quantity"> </div>
                                </div>
                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-8 flex-column d-flex">
                                        <label class="form-control-label px-3">Ảnh<span class="text-danger"> *</span></label>
                                        <div class="fileupload fileupload-new" data-provides="fileupload" style="width: 100%;">
                                            <div class="input-append">
                                                <div class="uneditable-input">
                                                    <span class="fileupload-preview" id="colorImage"></span>
                                                </div>
                                                <span class="btn btn-default btn-file">
                                                    <span class="fileupload-exists">Thay đổi</span>
                                                    <span class="fileupload-new">Chọn ảnh</span>
                                                    <input type="file" id="colorimage" accept="image/*" >
                                                </span>
                                                <a href="#" class="btn btn-default fileupload-exists" id="Acolorimage" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4 flex-column d-flex">
                                        <div class="col-md-12 text-right">
                                            <button id="dialogAddColorPrice" class="btn btn-primary  save" style="height: 55.2px; width: 80px; " type="button" ng-click="addColor(Color)">Thêm</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <table class="table table-bordered table-striped mb-none" id="datatable-editable2">
                                <thead>
                                    <tr>
                                        <th class="center">Màu</th>
                                        <th class="center">Giá bán lẻ</th>
                                        <th class="center">Số lượng</th>
                                        <th class="center">Ảnh</th>
                                        <th class="center" style="width:65px;">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody id="ttable3">
                                    <tr class="gradeA" ng-repeat="Color in Colors">
                                        <td>@{{Color.ColorName}}</td>
                                        <td>@{{Color.Price}}</td>
                                        <td>@{{Color.Quantity}}</td>
                                        <td class="image_index"><img src="/assets/images/@{{Color.ColorImage}}" /></td>
                                        <td class="actions" style="width:65px;">
                                            <a href="#" class="on-default removeColor"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div style="margin-top:40px;">
                        <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                            <fieldset class="form-group">
                            <label for="description">Mô tả</label>
                            <div ckeditor="text.options" ng-model="text.textInput">
                                <!-- <ckeditor ng-model="book.description"></ckeditor> -->
                                <!-- <textarea name="description" class="form-control" id="description" (data)="book.description"  rows="8"></textarea> -->
                            </fieldset>
                        </div>
                    </div>

                    <footer class="" style="padding: 15px 0px;">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button id="dialogConfirmNewProduct" class="btn btn-primary  save" type="button">Lưu</button>
                                <button id="dialogCancelNewProduct" class="btn btn-default  exit" type="button">Đóng</button>
                            </div>
                        </div>
                    </footer>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- @* Edit *@ -->
<div class="mx-auto workform" id="dialogEditmember" style="display: none;" ng-controller="editProductController">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-19 text-center">
            <div class="card">
                <h3 class="text-center mb-4">Nhập thông tin</h3>
                <form class="form-card" id="frmedit">
                    <div class="block" style=" background: seashell;">
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-4 flex-column d-flex"> <label class="form-control-label px-3">Mã sản phẩm<span class="text-danger"> *</span></label> <input type="text" id="eid" name="eid" placeholder="Nhập mã" required readonly ng-model="Megaproduct.ProductID"></div>
                            <div class="form-group col-sm-4 flex-column d-flex"> <label class="form-control-label px-3">Tên sản phẩm<span class="text-danger"> *</span></label> <input type="text" id="ename" name="fname" placeholder="Nhập Tên" required ng-model="Megaproduct.ProductName"></div>
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Ngày ra mắt<span class="text-danger"> *</span></label>
                                <input id="eDateRelease" data-plugin-datepicker name="OrderDate" readonly autocomplete="off" ng-model="Megaproduct.ReleaseDate" required>
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Loại sản phẩm<span class="text-danger"> *</span></label>
                                <select class="selectpicker ecategory" style="border: 1px solid #ccc; font-size: 14px;" ng-model="Megaproduct.categories.CategoryName">
                                    <option ng-repeat="Category in Categories" class="@{{Category.STT}}">@{{Category.CategoryName}}</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Hãng sản xuất<span class="text-danger"> *</span></label>
                                <select id="ebrand" class="selectpicker" style="border: 1px solid #ccc; font-size: 14px;" ng-model="Megaproduct.brands.BrandName">
                                    <option ng-repeat="Brand in Brands">@{{Brand.BrandName}}</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Ảnh chính<span class="text-danger"> *</span></label>
                                <div class="fileupload fileupload-new" data-provides="fileupload" style="width: 100%;" id="eimpressive_image">
                                    <div class="input-append">
                                        <div class="uneditable-input">
                                            <span class="fileupload-preview" id="eimageName">@{{Megaproduct.image}}</span>
                                        </div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Thay đổi</span>
                                            <span class="fileupload-new">Chọn ảnh</span>
                                            <input id="eimageProduct" type="file" accept="image/*">
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-20" style="display: flex;">
                        <div class="col-10 sub-block">
                            <div class="block" style=" background: oldlace;">
                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-12 flex-column d-flex" style="margin-bottom:15px;">
                                        <label class="form-control-label px-3">Bộ nhớ<span class="text-danger"> *</span></label>
                                        <input type="text" id="ememory" list="memo" ng-model="MemoryName" />
                                        <datalist id="ememo">
                                            <option>2GB</option>
                                            <option>4GB</option>
                                            <option selected>8GB</option>
                                            <option>16GB</option>
                                            <option>32GB</option>
                                            <option>64GB</option>
                                            <option>128GB</option>
                                            <option>512GB</option>
                                            <option>1TB</option>
                                            <option>2TB</option>
                                        </datalist>
                                    </div>
                                </div>
                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-8 flex-column d-flex">
                                        <label class="form-control-label px-3">Mô tả<span class="text-danger"> *</span></label>
                                        <input type="text" id="ememodiscription" ng-model="MDescription" name="memodiscription" placeholder="Nhập mô tả" required>
                                    </div>
                                    <div class="form-group col-sm-4 flex-column d-flex">
                                        <div class="col-md-12 text-right" style="display:flex;">
                                            <button id="edialogAddmemory" class="btn btn-primary  save" style="height: 55.2px; width: 80px;margin-right:10px;" type="button" ng-click="eaddMemory(MemoryName,MDescription)">Thêm</button>
                                            <button id="edialogEditmemory" class="btn btn-primary  edit-save" style="height: 55.2px; width: 80px; " type="button" ng-click="eeditMemory(MemoryName,MDescription)">Edit</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <table class="table table-bordered table-striped mb-none" id="edatatable-editable1">
                                <thead>
                                    <tr>
                                        <th class="center">Bộ nhớ tag</th>
                                        <th class="center">Bộ nhớ</th>
                                        <th class="center">Mô tả</th>
                                        <th class="center" style="width:65px;">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody id="ettable2">
                                    <tr class="gradeA" ng-repeat="Memory in Megaproduct.memories" ng-click="eclickMemory(Memory)">
                                        <td>@{{$index+1}}</td>
                                        <td>@{{Memory.MemoryName}}</td>
                                        <td>@{{Memory.Description}}</td>
                                        <td class="actions" style="width:65px;">
                                            <a href="" class="on-default removeMemory" ng-click="eRemoveMemory(Memory)"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-10 sub-block">
                            <div class="block" style=" background: oldlace;">
                                <div class="row justify-content-between text-left">
                                    <input type="hidden" id="ColorId" name="ColorId" value="@{{EColorID}}">
                                    <div class="form-group col-sm-4 flex-column d-flex"> <label class="form-control-label px-3">Màu<span class="text-danger"> *</span></label> <input type="text" id="colorName" name="colorName" placeholder="Nhập Màu" required ng-model="EColorName"> </div>
                                    <div class="form-group col-sm-4 flex-column d-flex"> <label class="form-control-label px-3">Giá<span class="text-danger"> *</span></label> <input type="text" id="price" name="price" placeholder="Nhập giá" required ng-model="EPrice"> </div>
                                    <div class="form-group col-sm-4 flex-column d-flex"> <label class="form-control-label px-3">Số lượng<span class="text-danger"> *</span></label> <input type="text" id="quantityColor" name="quantityColor" placeholder="Số lượng" required ng-model="EQuantity"> </div>
                                </div>
                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-8 flex-column d-flex">
                                        <label class="form-control-label px-3">Ảnh<span class="text-danger"> *</span></label>
                                        <div class="fileupload fileupload-new" data-provides="fileupload" style="width: 100%;">
                                            <div class="input-append">
                                                <div class="uneditable-input">
                                                    <span class="fileupload-preview" id="einputcolorImage">@{{EColorImage}}</span>
                                                </div>
                                                <span class="btn btn-default btn-file">
                                                    <span class="fileupload-exists">Thay đổi</span>
                                                    <span class="fileupload-new">Chọn ảnh</span>
                                                    <input type="file" accept="image/*" id="Ecolorimage">
                                                </span>
                                                <a href="" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4 flex-column d-flex">
                                        <div class="col-md-12 text-right" style="display:flex;">
                                            <button id="edialogAddColorPrice" class="btn btn-primary  save" style="height: 55.2px; width: 80px;margin-right:10px; " type="button" ng-click="eaddColor(EColorID,EColorName,EPrice,EQuantity)">Thêm</button>
                                            <button id="edialogEditColorPrice" class="btn btn-primary  edit-save" style="height: 55.2px; width: 80px; " type="button" ng-click="eeditColor(EColorID,EColorName,EPrice,EQuantity)">Edit</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <table class="table table-bordered table-striped mb-none" id="edatatable-editable2">
                                <thead>
                                    <tr>
                                        <th class="center">Màu</th>
                                        <th class="center">Giá bán lẻ</th>
                                        <th class="center">Số lượng</th>
                                        <th class="center">Ảnh</th>
                                        <th class="center" style="width:65px;">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody id="ettable3">
                                    <tr class="gradeA" ng-repeat="Color in Colors" ng-click="clickColor(Color)">
                                        <td>@{{$index+1}}</td>
                                        <td>@{{Color.prices.Price}}</td>
                                        <td>@{{Color.Quantity}}</td>
                                        <td class="image_index"><img src="/assets/images/@{{Color.ColorImage}}" /></td>
                                        <td class="actions" style="width:65px;">
                                            <a href="" class="on-default removeColor" ng-click="eRemoveColor(Color)"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div style="margin-top:40px;">
                            <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                <fieldset class="form-group">
                                <label for="description">Mô tả</label>
                                <div ckeditor="text.options" ng-model="text.textInput">
                                </fieldset>
                            </div>
                        </div>

                    <footer class="" style="padding: 15px 0px;">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button id="dialogConfirmEditProduct" class="btn btn-primary  save" type="button" ng-click="EditProduct(Megaproduct.id,Megaproduct.ProductName,Megaproduct.ReleaseDate)">Lưu</button>
                                <button id="dialogCancelEditProduct" class="btn btn-default  exit" type="button">Đóng</button>
                            </div>
                        </div>
                    </footer>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="dialog2" class="modal-block mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Bạn có chắc chắn muốn khởi tại mật khẩu</h2>
        </header>
        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-text">
                    <p id="sur">Bạn có chắc chắn muốn khởi tạo lại mật khẩu cho sản phẩm <span></span> không?</p>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button id="dialogConfirm1" class="btn btn-primary">Xác nhận</button>
                    <button id="dialogCancel1" class="btn btn-default">Đóng</button>
                </div>
            </div>
        </footer>
    </section>
</div>
@stop


@section('js')
    <script src="//cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <script src="/assets/js_controller/angular_path/angular-ckeditor.js"></script>
    <script src="/assets/js_controller/ProductController.js"></script>
    <script src="/assets/vendor/select2/select2.js"></script>
    <script src="/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
    <script src="/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
    <script src="/assets/vendor/toast/toastr.min.js"></script>
    <script src="/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
@stop

