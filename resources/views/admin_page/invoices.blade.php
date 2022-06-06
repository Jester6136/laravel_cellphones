@extends('_admin_layout')
@section('css')    
    <link rel="stylesheet" href="/assets/vendor/select2/select2.css" />
    <link rel="stylesheet" href="/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
    <link rel="stylesheet" href="/assets/stylesheets/popup.css">
    <link rel="stylesheet" href="/assets/vendor/toast/toastr.min.css" />
    <link rel="stylesheet" href="/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
    <link href="/assets/vendor/jquery-datatables-bs3/assets/css/jquery.dataTables.min.css" rel="stylesheet" />

    <style>
        datalist {
            position: absolute;
            max-height: 20em;
            border: 0 none;
            overflow-x: hidden;
            overflow-y: auto;
            }

            datalist option {
            font-size: 0.8em;
            padding: 0.3em 1em;
            background-color: white;
            cursor: pointer;
            }

            /* option active styles */
            datalist option:hover, datalist option:focus {
            color: #fff;
            background-color: #036;
            outline: 0 none;
            }
    </style>
@stop
@section('content')

<section role="main" class="content-body" ng-controller="invoicesController">
    <header class="page-header">
        <h2>Quản lý nhập hàng</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Quản lý nhập hàng</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <section class="panel" >
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>
            <h2 class="panel-title">Danh sách đơn nhập</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6" style="float:left">
                    <div class="mb-md">
                        <button class="btn btn-primary" style="margin: 0px;" ng-click="openModal(0)">Thêm đơn nhập  <i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="col-sm-6" style="float:left">
                    <div class="mb-md">
                        <input type="type" name="name" style="float:right;" placeholder="Tìm kiếm" value="" ng-model="q"/>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped mb-none">
               <thead>
                 <tr>
                   <th>STT</th>
                   <th>Thời gian</th>
                   <th>Nhà cung cấp</th>
                   <th>Tổng cộng</th>
                   <th>Trạng thái</th>
                   <th>Actions</th>
                 </tr>
               </thead>
               <tbody>
                 <tr dir-paginate="row in data|filter: q|itemsPerPage:10" current-page="currentPage" pagination-id="paginate1">
                   <td>@{{$index+1}}</td>
                   <td>@{{row.invoice_date}}</td>
                   <td>@{{row.suppliers.supplier_name}}</td>
                   <td align="right">@{{row.total}}</td>
                   <td>@{{row.status_name}}</td>
                    
                   <td class="actions" style="width:65px;">
                       <a href="" class="on-default editt-row" ng-click="openModal(row.id)" data-toggle="tooltip" title="Sửa"><i class="fa fa-pencil"></i></a>
                       <a href="" class="on-default removeMember" ng-click="deleteClick(row.id)"><i class="fa fa-trash-o"></i></a>
                   </td>
                              
                 </tr>
               </tbody>
            </table>
            <dir-pagination-controls style="float: right; padding-right: 100px;"
                direction-links="true"
                boundary-links="true"
                pagination-id="paginate1"
                >
            </dir-pagination-controls>
        </div>
    </section>
    <!-- end: page -->
    <div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" style="display: none;" aria-hidden="true">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-19 text-center">
            <div class="card">
                <h3 class="text-center mb-4" id="myModalLabel17">@{{modalTitle}}</h3>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="col-xl-12 col-lg-12 col-md-12" style="display:flex;">
                                <div class="col-xl-8 col-lg-8 col-md-8 block"  style="background: oldlace;padding: 20px;border-radius: 6px;">
                                    <div class="row" style="display: flex;justify-content: center;">
                                        <div class="form-group" style="width:70%;" ng-if="is_create">
                                            <input class="form-control" placeholder="Tìm kiếm sản phẩm" list="ShowDataList">
                                            <datalist id="ShowDataList" style="z-index: 100;overflow-y: auto!important">
                                                <option value="@{{color.ColorName}}" style="text-align: left;" ng-repeat="color in colors" ng-click="color_selected(color)">@{{color.ColorName}}</option>
                                            </datalist>
                                        </div>
                                        <div class="form-group" style="width:70%;" ng-if="!is_create">
                                            <input class="form-control" placeholder="Tìm kiếm sản phẩm" ng-model="qt">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="row justify-content-between text-left" style="display: flex;">
                                            <div class="form-group col-sm-5 flex-column d-flex" style="margin: 0px;">
                                                <label class="form-control-label px-3">Tên sản phẩm<span class="text-danger"></span></label>
                                                <input ng-model="selected_invoice_details.color.ColorName" type="text" readonly>
                                            </div>  

                                            <div class="form-group col-sm-3 flex-column d-flex">
                                                <label class="form-control-label px-3">Đơn giá<span class="text-danger"> *</span></label>
                                                <input ng-model="selected_invoice_details.price" type="number" min="0" >
                                            </div>

                                            <div class="form-group col-sm-2 flex-column d-flex">
                                                <label class="form-control-label px-3">Số lượng<span class="text-danger"> *</span></label>
                                                <input ng-model="selected_invoice_details.quantity"type="number" min="0" >
                                            </div>
                                            
                                            <div class="form-group col-sm-2 flex-column d-flex">
                                                <label class="form-control-label px-3">Giảm giá<span class="text-danger"> *</span></label>
                                                <input ng-model="selected_invoice_details.discount" type="number" min="0" >
                                            </div>
                                        </div>
                                        <div class="blockk" style="width:100%;">
                                            <button class="btn btn-info" style="float:right;" ng-click="update(selected_invoice_details)">Cập nhật</button>
                                        </div>
                                        <table class="table table-responsive-md text-center table-striped" id="invoice_details">
                                            <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th style="width:35%">Tên sách</th>
                                                <th>Tồn kho</th>
                                                <th>Đơn giá</th>
                                                <th>Số lượng</th>
                                                <th>Giảm giá</th>
                                                <th>Thành tiền</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr dir-paginate="row in invoice_details| filter: qt |itemsPerPage:6" current-page="currentPage2" ng-click="selected_row(row)" pagination-id="paginate2">
                                                <td>@{{$index+1}}</td>
                                                <td align="left">@{{row.color.ColorName}}</td>
                                                <td>@{{row.color.Quantity}}</td>
                                                <td>@{{row.price}}</td>
                                                <td>@{{row.quantity}}</td>
                                                <td>@{{row.discount}}</td>
                                                <td>@{{row.total}}</td>
                                                <td>
                                                <a class="danger p-0" data-original-title="" data-toggle="tooltip" title="Xóa" ng-click="deleteClick_createform(row)" ng-if="isCreate">
                                                    <i class="fa fa-trash-o font-medium-3 mr-2"></i>
                                                </a>
                                                <a class="danger p-0" data-original-title="" data-toggle="tooltip" title="Xóa" ng-click="deleteClick(row)" ng-if="!isCreate">
                                                    <i class="fa fa-trash-o font-medium-3 mr-2"></i>
                                                </a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <dir-pagination-controls style="float: right; padding-right: 100px;"
                                            direction-links="true"
                                            boundary-links="true" pagination-id="paginate2">
                                        </dir-pagination-controls>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4">
                                    <div class="row" style="display: flex;justify-content: center;">
                                        <div class="form-group">
                                            <select name="" id="" class="form-control" ng-model="invoice.supplier_id" ng-change="supplier_change(invoice.supplier_id)">
                                                <option value="" selected disabled>Chọn nhà cung cấp</option>
                                                <option value="@{{supplier.id}}" ng-repeat="supplier in suppliers">@{{supplier.supplier_name}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row justify-content-between text-left" style="display: flex;">
                                        <div class="form-group col-sm-12 flex-column d-flex">
                                            <label class="form-control-label px-3">Tên nhà cung cấp<span class="text-danger"></span></label>
                                            <input ng-model="supplier_name" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="row justify-content-between text-left" style="display: flex;">
                                        <div class="form-group col-sm-12 flex-column d-flex">
                                            <label class="form-control-label px-3">Tổng tiền tạm tính<span class="text-danger"></span></label>
                                            <input ng-model="total_invoice" readonly  type="number" min="0" readonly>
                                        </div>
                                    </div>

                                    <div class="row justify-content-between text-left" style="display: flex;">
                                        <div class="form-group col-sm-12 flex-column d-flex">
                                            <label class="form-control-label px-3">Giảm giá<span class="text-danger"></span></label>
                                            <input ng-model="invoice.discount" ng-change="invoice_discount_change(invoice.discount)" type="number" min="0" max="99" >
                                        </div>
                                    </div>

                                    <div class="row justify-content-between text-left" style="display: flex;">
                                        <div class="form-group col-sm-12 flex-column d-flex">
                                            <label class="form-control-label px-3">Tổng tiền phải trả<span class="text-danger"></span></label>
                                            <input ng-model="invoice.total" readonly  type="number" min='0' readonly>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between text-left" style="display: flex;">
                                        <div class="form-group col-xl-12 col-lg-12 col-md-12" style="display: flex;align-items: center;justify-content: space-between;">
                                            <select class="form-control col-xl-12 col-lg-12 col-md-12" ng-model="invoice.status" ng-options="status.id as status.name for status in InvoiceStatus">
                                                <option value="" selected disabled>Trạng thái</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-outline-primary" ng-click="saveData()">Lưu</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</section>

@stop


@section('js')
    <script src="//cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <script src="/assets/js_controller/angular_path/angular-ckeditor.js"></script>
    <script src="/assets/js_controller/InvoiceController.js"></script>
    <script src="/assets/vendor/toast/toastr.min.js"></script>
    <script src="/assets/js_controller/datalist.js"></script>
@stop

