@extends('_admin_layout')
@section('content')
<section role="main" class="content-body" ng-controller="homeController" style="padding:0px;">
    <header class="page-header">
        <h2>Trang chủ</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Trang chủ</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="col-md-6 col-lg-12 col-xl-6" style="font-size:12px !important;">
        <div class="row">
            <div class="col-md-12 col-lg-6 col-xl-6">
                <section class="panel panel-featured-left panel-featured-secondary">
                    <div class="panel-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-success">
                                    <i class="fa fa-usd"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Tổng doanh thu tháng 6</h4>
                                    <div class="info">
                                        <strong class="amount" style="color:#5bca5b">@{{total}}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-6">
                <section class="panel panel-featured-left panel-featured-tertiary">
                    <div class="panel-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-tertiary">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Số lượng đơn hàng trong ngày</h4>
                                    <div class="info">
                                        <strong class="amount">@{{count_order}}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a href="/admin/order/now" class="text-muted text-uppercase" style="cursor: pointer;">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        
        <div class="row" style="display: flex;justify-content: space-between;">
            <section class="panel" style="width:72%;">
                <header class="panel-heading">
                    <h2 class="panel-title">Sản phẩm bán chạy trong tháng</h2>
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-striped mb-none">
                    <thead>
                        <tr>
                        <th style="width: 5%;">STT</th>
                        <th>Sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Loại sản phẩm</th>
                        <th>Số lượng đã bán</th>
                        <th>Tổng thu dự kiến</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="row in orderdetails">
                        <td style="width: 5%;">@{{$index+1}}</td>
                        <td>@{{row.name}}</td>
                        <td class="image_index"><img style="    height: 45px;" src="/assets/images/@{{row.color.ColorImage}}" alt="Alternate Text" /></td>
                        <td align="right">@{{row.color.memory.product.categories.CategoryName}}</td>
                        <td align="right">@{{row.Quantity}}</td>
                        <td align="right">@{{row.Quantity * row.single_price}}</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </section>
            <section class="panel" style="width:26%;">
                <header class="panel-heading">
                    <h2 class="panel-title">Thống kê trạng thái đơn hàng</h2>
                </header>
                <div class="panel-body">
                    <div class="chart">
                        <canvas id="myChart" ></canvas>
                    </div>
                </div>
            </section>
        </div>

        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Doanh số bán hàng theo tháng</h2>
            </header>
            <div class="panel-body">
                    <div class="chart">
                      <canvas id="myChart2" height="80px"></canvas>
                    </div>
            </div>
        </section>
    </div>
</section>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <script src="/assets/js_controller/angular_path/angular-ckeditor.js"></script>
    <script src="/assets/js_controller/HomeController.js"></script>
    <script src="/assets/vendor/select2/select2.js"></script>
    <script src="/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
    <script src="/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
    <script src="/assets/vendor/toast/toastr.min.js"></script>
    <script src="/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
@stop