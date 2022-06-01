@extends('_guess_layout')
@section('content')

<div class="brand" ng-controller="BrandController">
			<div class="container" style="background-color: white; display: table;">
				<div class="breadcrumbs" style="padding-top: 10px; padding-bottom: 20px;">
					<ul style="font-size:14px !important;">
						<li class="home">
							<a href="">Home</a>
							<i class="far fa-chevron-right"></i>
						</li>
						<li class="category1">
							<a href="">Điện thoại</a>
							<i class="far fa-chevron-right"></i>
						</li>
						<li class="category14" style="text-decoration: none;">
							<a href="">Apple</a>
							<i class="far fa-chevron-right" style="display: none;"></i>
						</li>
					</ul>
				</div> 
					<div class="col-20 col-m-20 col-s-20 right-side">
						<div class="tittle-box" style="box-shadow:none;">
							<h3>Điện thoại iPhone</h3>
						</div>
						<div class="sort">
							<div style="float: left;"> 
								<ul class="sort-group">
									<span style="padding-right: 6px;">Chọn mức giá: </span>
									<li onclick="getInRange('9-12')" id="912">9 - 12 triệu</li>
									<li onclick="getInRange('12-15')" id="1215">12 - 15 triệu</li>
									<li onclick="getInRange('15-18')" id="1518">15 - 18 triệu</li>
									<li onclick="getInRange('18-21')" id="1821">18 - 21 triệu</li>
									<li onclick="getInRange('21-')" id="21">trên 21 triệu</li>
								</ul>
							</div>
							<div style="float: right;">
								<ul class="sort-by">
									<span style="padding-right: 6px;">Sắp xếp theo: </span>
									<li id="sort-high" onclick="sortProduct('sort-high')">Giá cao</li>
									<li id="sort-low" onclick="sortProduct('sort-low')">Giá thấp</li>
									<li id="special" style="text-decoration: underline;" onclick="reLoad('Apple.html')">Nổi bật</li>
								</ul>
							</div>
						</div>
						<div class="list-product" style="box-shadow:none;">
							<div class="shadow"></div>
							<div class="product col-4 col-m-5 col-s-10" dir-paginate="Product in Products|orderBy:min_price|itemsPerPage:10" current-page="currentPage">    
								<div class="product-img">
									<img src="/assets/images/@{{Product.image_product}}" alt="">
								</div>
								<div class="product-info">
									<h4 class="product-name">@{{Product.ProductName}}</h4>
									<div class="price">
										<p class="special-price">@{{Product.min_price}}</p>
										<p class="old-price">@{{Product.old_price}}</p>
									</div>
									<div class="offers">
										<p>@{{Product.PromotionName}}</p>
									</div>
									<div class="product-btn">
										<a href=""><button class="buy-btn" ng-click="getProduct(Product)">Mua ngay</button></a>
										<a href=""><button class="compare">So sánh</button></a>
									</div>
								</div>
							</div>
						</div>
						<dir-pagination-controls style="float: right; padding-right: 100px;" direction-links="true" boundary-links="true">
                      </dir-pagination-controls>
					</div>
			</div>
		</div>

@stop


@section('js')
    <script src="/assets_guess/js_controller/BrandController.js"></script>
@stop
