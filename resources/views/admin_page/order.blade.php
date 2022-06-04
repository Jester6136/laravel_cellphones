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

<section role="main" class="content-body" ng-controller="OrderController">
    <header class="page-header">
        <h2>Quản lý đơn hàng</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Quản lý đơn hàng</span></li>
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
            <h2 class="panel-title">Danh sách đơn hàng</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12" style="float:left">
                    <div class="mb-md">
                        <input type="type" name="name" style="float:right;" placeholder="Tìm kiếm" value="" ng-model="finding"/>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped mb-none">
               <thead>
                 <tr>   
                   <th  style="width:10%;" >Mã đơn hàng</th>
                   <th>Thời gian</th>
                   <th>Khách hàng</th>
                   <th>Số ĐT</th>
                   <th>Tổng cộng</th>
                   <th>Trạng thái</th>
                   <th style="width:5%;">Actions</th>
                 </tr>
               </thead>
               <tbody>
                    <tr dir-paginate="row in data| orderBy:'+':true |filter: finding|itemsPerPage:10" current-page="currentPage">
                      <td>@{{row.id}}</td>
                      <td>@{{row.created_at}}</td>
                      <td>@{{row.customer.CustomerName}}</td>
                      <td>@{{row.Phone}}</td>
                      <td align="right">@{{row.Amount}}</td>
                      <td>@{{row.Status_name}}</td>
                      <td style="width:5%;" align="center">
                        <a class="success p-0" data-original-title="" ng-click="openModal(row)" data-toggle="tooltip" title="Xem chi tiết">
                          <i class="fa fa-eye font-medium-3 mr-2"></i>
                        </a>  
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
    <div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" style="display: none;" aria-hidden="true">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-19 text-center">
            <div class="card">
                <h3 class="text-center mb-4" id="myModalLabel17">Thông tin đơn hàng</h3>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="col-xl-12 col-lg-12 col-md-12" style="display:flex;">
                                <div class="col-xl-8 col-lg-8 col-md-8 block"  style="background: oldlace;padding: 20px;border-radius: 6px;">
                                    <div class="row" style="display: flex;justify-content: center;">
                                        <div class="form-group" style="width:70%;">
                                            <input class="form-control" placeholder="Tìm kiếm chi tiết đơn hàng" ng-model='q'>
                                        </div>
                                    </div>

                                            <table class="table table-responsive-md text-center table-striped">
                                                <thead>
                                                    <tr>
                                                        <th align="center">STT</th>
                                                        <th align="center" style="text-align: center;">Tên sản phẩm</th>
                                                        <th align="center">Số lượng</th>
                                                        <th align="center">Đơn giá</th>
                                                        <th align="center">Thành tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr dir-paginate="row in order.orderdetails|filter: q|itemsPerPage:10" current-page="currentPage">
                                                        <td>@{{$index+1}}</td>
                                                        <td>@{{row.name}}</td>
                                                        <td align="right">@{{row.Quantity}}</td>
                                                        <td align="right">@{{row.single_price}}</td>
                                                        <td align="right">@{{row.Quantity*row.single_price}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                    </div>

                                    <div class="col-xl-4 col-lg-4 col-md-4">
                                        <div class="row justify-content-between text-left" style="display: flex;">
                                            <div class="form-group col-sm-12 flex-column d-flex">
                                                <label class="form-control-label px-3">Ngày đặt hàng</label>
                                                <input ng-model="order.created_at" type="text" readonly>
                                            </div>
                                        </div>

                                        <div class="row justify-content-between text-left" style="display: flex;">
                                            <div class="form-group col-sm-12 flex-column d-flex">
                                                <label class="form-control-label px-3">Tổng tiền</label>
                                                <input ng-model="order.Amount" readonly  type="number" min="0" readonly>
                                            </div>
                                        </div>

                                        <div class="row justify-content-between text-left" style="display: flex;">
                                            <div class="form-group col-sm-12 flex-column d-flex" style="display: flex;">
                                                <label class="form-control-label px-3">Địa chỉ</label>
                                                <input ng-model="order.DeliveryAddress" type="text" readonly >
                                            </div>
                                        </div>

                                        <div class="row justify-content-between text-left" style="display: flex;">
                                            <div class="form-group col-sm-12 flex-column d-flex" style="display: flex;">
                                                <select style="width: 100%;" name="" id="" class="form-control" ng-model="order.Status" ng-change="status_change(order.Status)">
                                                    <option value="" selected disabled>Trạng thái</option>
                                                    <option value="@{{status.id}}" ng-repeat="status in OrderStatus">@{{status.name}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary">In hóa đơn</button>
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-outline-primary" ng-click="saveData(order)">Lưu</button>
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
    <script src="/assets/js_controller/OrderController.js"></script>
    <script src="/assets/vendor/toast/toastr.min.js"></script>
    <script src="/assets/js_controller/datalist.js"></script>
@stop

