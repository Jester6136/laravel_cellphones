@extends('_guess_layout')
@section('content')

<div class="product-detail" ng-controller="ProductDetailController">
    <div class="container">
        <div class="breadcrumbs">
            <ul>
                <li class="home">
                    <a href="">Home</a>
                    <i class="far fa-chevron-right"></i>
                </li>
                <li class="category1">
                    <a href="">@{{Product.CategoryName}}</a>
                    <i class="far fa-chevron-right"></i>
                </li>
                <li class="category14">
                    <a href="">@{{Product.BrandName}}</a>
                    <i class="far fa-chevron-right"></i>
                </li>
                <li class="product-name" id="1">
                    <b href="">@{{Product.ProductName}}</b>
                </li>
            </ul>
        </div>
        <div class="main-detail">
            <div class="top-view">
                <h2>@{{Product.ProductName}}</h2>
                <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star dis"></i>
                    <p>10 đánh giá</p>
                </div>
            </div>
            <div class="line"></div>
            <div class="product-essential">
                <div style="margin-top: 15px;"></div>
                <div class="col-7 col-m-9" style="text-align: center;">
                    <img class="big-img" src="/assets/images/@{{BigImage}}" alt="">
                    <div class="small-pic">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" ng-repeat="color in Colors" ng-click="selectBigImage(color)"><img src="/assets/images/@{{color.ColorImage}}" alt="" ></div>
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                        
                    </div>
                    <img src="/assets/images/400x100_COVID1.png" class="small-banner" alt="">
                </div>
                <div class="col-7 col-m-11">
                    <div class="pos-buy">
                        <h5>Mua hàng từ: </h5>
                        <div class="custom-select-wrapper">
                            <div class="custom-select">
                                <div class="custom-select__trigger">
                                    <span>TP.Hà Nội</span>
                                    <div class="arrow"></div>
                                </div>
                                <div class="custom-options">
                                    <span class="custom-option selected" data-value="hanoi">TP.Hà Nội</span>
                                    <span class="custom-option" data-value="volvo">TP.Hồ Chí Minh</span>
                                    <span class="custom-option" data-value="mercedes">Bình Dương</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="price">
                            <p class="special-price">@{{NewPrice}}</p>
                            <p class="old-price"><span>giá niêm yết:</span>@{{OldPrice}}</p>
                        </div>
                    </div>
                    <div class="config">
                        <div class="box-option-config @{{memo.active}}" ng-repeat="memo in Product.Memories" ng-click="selectColor(memo)">
                            <p class="memoname">@{{memo.MemoryName}}</p>
                            <p class="special-price">@{{memo.new_price}}</p>
                        </div>
                    </div>
                    <h5 style="margin: 10px 0px 10px 0px;">Chọn màu để xem giá và chi nhánh có hàng</h5>
                    <div class="color">
                        <div class="box-option-color" ng-repeat="color in Colors" ng-click="selectColorPrice(color)">
                            <p>@{{color.ColorName}}</p>
                            <p class="special-price">@{{color.prices.Price}}</p>
                        </div>
                    </div>
                    <div class="product-try">
                        <a href=""><h5>Danh sách cửa hàng có máy trải nghiệm iPhone 12</h5></a>
                    </div>
                    <div class="promotion">
                        <h4>Khuyến mãi</h4>
                        <p>Khuyến mãi hãng:</p>
                        <ul>
                            <a href="">
                            <li>Giảm thêm 500.000đ khi mua kèm Apple Watch Series 6</li></a>
                            <a href="">
                            <li>[HOT] Thu cũ lên đời giá cao - Thủ tục nhanh - Trợ giá lên tới 500.000đ</li></a>
                        </ul>
                    </div>
                    <p style="margin: 8px 0px;font-size: 12px;">*Giảm thêm tới 1% cho <a href="" style="color: #e0052b;">thành viên Smember</a></p>
                    <p style="margin: 8px 0px;font-size: 12px;">*<a href="" style="color: #e0052b;">Thu cũ đổi mới -&nbsp;&nbsp;Trợ giá tốt nhất</a></p>
                    <div class="order-online buynow">
                        <button ng-click="addCart(SelectedProduct)">
                            <h4>MUA NGAY<span>(Giao hàng tận nơi - Giá tốt - An toàn)</span></h4>
                        </button>
                    </div>
                    <div style="margin-top: 7px;"></div>
                    <div class="order installmentbyphone">
                        <button>
                            <h4>TRẢ GÓP 0%<span>(Xét duyệt qua điện thoại)</span></h4>
                        </button>
                    </div>
                    <div class="order installmentbycard">
                        <button>    
                            <h4>TRẢ GÓP QUA THẺ<span>(Visa, Master, JCB)</span></h4>
                        </button>
                    </div>
                    <div style="margin-top: 10px; text-align: center; color: #3c3d41;float: left;width: 100%;font-size: 12px;">
                        <a href="https://cellphones.com.vn/tra-gop/mpos" style="color: #e0052b;">Trả góp 0% với thẻ tín dụng tại cửa hàng - Xem chi tiết </a><br>
                        Gọi miễn phí: <b>1800.2097</b> | <a href="" style="color: #e0052b;">Chat với tư vấn viên</a>
                    </div>
                </div>
                <div class="col-6 col-m-20 pre-detail">
                    <div class="box">
                        <h4 style="text-transform: uppercase;">HIỆN <span>12</span> CỬA HÀNG CÓ SẴN SẢN PHẨM</h4>
                    </div>
                    <img src="~/assets/images/banner1.png" class="small-banner full_width" alt="">
                    <h5>Tình trạng</h5>
                    <p>
                        Máy mới 100% , chính hãng Apple Việt Nam.
                        CellphoneS hiện là đại lý bán lẻ uỷ quyền iPhone chính hãng VN/A của Apple Việt Nam
                    </p>
                    <h5>Hộp bao gồm</h5>
                    <p>Thân máy, cáp USB-C to Lightning, sách HDSD</p>
                    <h5>Bảo hành</h5>
                    <p>Bảo hành 12 tháng tại trung tâm bảo hành chính hãng Apple Việt Nam. 1 ĐỔI 1 trong 30 ngày nếu có lỗi phần cứng nhà sản xuất.(Chi tiết)</p>
                </div>
            </div>
        </div>
        <div style="clear: both;"></div>
        <div class="line"></div>
        <div class="full-detail col-14 col-m-20 col-s-20">
            <h4>Điện thoại iPhone 12 Pro Max: Nâng tầm đẳng cấp sử dụng</h4>
            <p>Cứ mỗi năm, đến dạo cuối tháng 8 và gần đầu tháng 9 thì mọi thông tin sôi sục mới về chiếc iPhone mới lại xuất hiện. Apple năm nay lại ra thêm một chiếc iPhone mới với tên gọi mới là iPhone 12 Pro Max, đây là một dòng điện thoại mới và mạnh mẽ nhất của nhà Apple năm nay. Mời bạn tham khảo thêm một số mô tả sản phẩm bên dưới để bạn có thể ra quyết định mua sắm.</p>
            <h4>Màn hình 6.7 inches Super Retina XDR</h4>
            <p>
                Năm nay, công nghệ màn hình trên 12 Pro Max cũng đượcx đổi mới và trang bị tốt hơn cùng kích thước lên đến 6.7 inch, lớn hơn so với điện thoại iPhone 12. Với công nghệ màn hình OLED cho khả năng hiển thị hình ảnh lên đến 2778 x 1284 pixels. Bên cạnh đó, màn hình này còn cho độ sáng tối đa cao nhất lên đến 800 nits, luôn đảm bảo cho bạn một độ sáng cao và dễ nhìn nhất ngoài nắng.
            </p>
            <img src="assets/images/iphone-12-pro-max-1_1.png" alt="">
            <span id="dots">...</span>
            <span id="more">
                <p>Một điểm đổi mới nữa trên màn hình của chiếc điện thoại Apple iPhone 12 năm nay là việc chúng được thiết kế với khung viền vuông vức, viền thép không gỉ mang đến vẻ đẹp sang trọng cho điện thoại. Máy cũng được trang bị nhiều phiên bản màu sắc đặc biệt cho người dùng lựa chọn.</p>
                <h4>RAM 6GB đa nhiệm thoải mái, bộ nhớ trong dung lượng lớn</h4>
                <p>Về trang bị phần cứng bên trong thì iPhone 12 Pro Max có một thanh RAM lên đến 6GB. Điều này cho thấy rằng Apple ngày đang lắng nghe người dùng nhiều hơn khi trang bị một dung lượng RAM lớn hơn để việc đa nhiệm ngày càng được cải thiện hơn. Việc thanh ram lớn giúp cho bạn trải nghiệm các tựa game và đa nhiệm mượt mà hơn.</p>
                <img src="assets/images/iphone-12-pro-max-2.webp" alt="">
                <p>Năm nay, 12 Pro Max cũng sẽ có ba phiên bản bộ nhớ trong khác nhau, với bộ nhớ trong nhỏ nhất bắt đầu từ 128GB, 256GB và cao nhất sẽ là 512GB. Một chiếc điện thoại mà có một bộ nhớ trong lớn ngang ngửa một chiếc laptop là điều mà Apple muốn mang lại cho người dùng để có thể san sẻ bớt bộ nhớ cho các thiết bị khác.</p>
                <h4>Con chip Apple A14 SoC 5nm, RAM 6GB mạnh mẽ</h4>
                <p>iPhone 12 Pro Max không những chỉ có các cải tiến trên, mà chúng còn có một thứ cải tiến được coi là nguồn lõi và là trái tim để vận hành chiếc điện thoại siêu phẩm 2020, đó là con chip Apple A14 SoC 5nm. Trang bị này giúp cho điện thoại có một sức mạnh đáng gờm hơn các đối thủ hơn về hiệu năng, hiệu suất sử dụng pin.</p>
                <img src="assets/images/iphone-12-pro-max-1_1.jpg" alt="">
                <p>Máy cũng được trang bị chuẩn kết nối wifi và mạng di động giúp cho bạn có thể cải thiện hiệu suất sử dụng mạng và chúng còn giúp các đường truyền tín hiệu luôn được đảm bảo không rớt kết nối và tăng chất lượng hiển thị hình ảnh trên mạng.</p>
                <h4>Cụm 3 camera sau với độ phân giải 12MP  </h4>
                <p>Có thể nói camera cũng là một bước tiến mới trên iPhone 12 Pro Max khi chúng có một bộ 3 camera với chung một độ phân giải là 12MP. Tuy nhiên chúng có khẩu độ lớn và mật độ điểm ảnh trên một panel cũng lớn hơn, do đó chúng cho hình ảnh chi tiết hơn, bắt sáng tốt hơn. Ngoài ra, kết hợp chống rung quang học OIS thì máy còn có thể quay phim 4K tốt.</p>
                <img src="assets/images/iphone-12-pro-max-4.webp" alt="">
                <p>Camera trên iPhone 12 Pro Max có chức năng quét chiều sâu và đảm bảo hình ảnh có một độ sâu nhất định. Cùng với đó chức năng chính của chiếc ống kính này là khả năng thể hiện hình ảnh 3D khi quét chúng vào một căn phòng nhất định. Giúp phục vụ cho công việc xây dựng cũng như định dạng hình ảnh trước khi xây.</p>
                <h4>Camera trước 12MP hỗ trợ mở FaceiD cùng công nghệ chống nước IP68</h4>
                <p>Camera trước 12MP cũng có cùng khẩu độ và kích thước điểm ảnh trong panel giống như camera. Điều này giúp cho việc sử dụng chúng cho chụp ảnh selfie tốt hơn và chân thực hơn. Cùng với đó một tính năng mà Apple luôn giữ chúng từ đời iPhone X đến giờ là khả năng quét khuôn mặt 3D FaceiD.</p>
                <img src="assets/images/iphone-12-pro-max-6.png" alt="">
                <p>Công nghệ chống nước là không thể thiếu trên các dòng điện thoại cao cấp và đặc biệt là đối với iPhone 12 Pro Max. Chúng được trang bị công nghệ chống nước và chống bụi tốt nhất hiện nay trên các dòng smartphone đó là tiêu chuẩn IP68. Giúp bạn luôn có thể yên tâm hơn trong việc sử dụng quay phim dưới nước hay ở môi trường khắc nghiệt.</p>
                <h4>Viên pin liền cho thời lượng sử dụng lên đến cả ngày cùng công nghệ sạc nhanh </h4>
                <p>Một viên pin liền với dung lượng lớn trên iPhone 12 Pro Max giúp cho chiếc điện thoại bạn có thể hoạt động được một cách ổn thoả hơn và thời gian sử dụng được lâu dài hơn. Cụ thể, máy cho thời gian nghe nhạc lên tới 80 giờ hoặc 12 giờ xem video trực truyến.</p>
                <img src="assets/images/iphone-12-pro-max-5.png" alt="">
                <p>Công nghệ sạc là trên 12 Pro Max là công nghệ sạc nhanh không dây lên đến 15W. Điều này có thể giúp bạn hạn chế được các việc phải ngồi đợi chiếc điện thoại của mình sạc xong khi máy có thể bổ sung 50% dung lượng chỉ trong vòng 30 phút.</p>
                <h4>iPhone 12 Pro Max 2020 giá bao nhiêu</h4>
                <p>Tại hệ thống CellphoneS, giá bán iPhone 12 Pro Max chỉ từ 27.99 triệu, iPhone 12 từ 19.99 triệu và iPhone 12 Pro từ 25.49 triệu. Thấp nhất sẽ là iPhone 12 Mini chỉ từ 16.99 triệu đồng. Đây là mức giá hàng chính hãng VN/A được bảo hành 12 tháng tại trung tâm bảo hành ủy quyền của Apple tại Việt Nam.</p>
                <h4>Mua iPhone 12 Pro Max chính hãng VN/A giá tốt tại CellphoneS</h4>
                <p>Bạn là một iFan và bạn đang mong chờ để được trải nghiệm thử chiếc điện thoại iPhone 12 Pro Max mới nhất của Apple? Mời bạn đến ngay với CellphoneS để được tư vấn và trải nghiệm nhanh chóng nhất có thể. </p>
            </span>
            <div style="width: 100%;text-align: center;margin-bottom: 10px;">
                <button onclick="myFunction()" id="myBtn">Read more</button>
            </div>
        </div>
        <div class="pre-detail2 col-5 col-m-0 col-s-0" style="float: right;">
            <div class="tittle"><h3>Thông số kỹ thuật</h3></div>
            <div class="info">
                <span id="info-name">
                    Kích thước màn hình
                </span>
                <p id="info-detail">6.7 inches</p>
            </div>
            <div class="info">
                <span id="info-name">
                    Công nghệ màn hình
                </span>
                <p id="info-detail">OLED</p>
            </div>
            <div class="info">
                <span id="info-name">
                    Camera sau
                </span>
                <p id="info-detail">
                    12 MP, f/1.6, 26mm (wide), 1.4µm, dual pixel PDAF, OIS
                    12 MP, f/2.0, 52mm (telephoto), 1/3.4", 1.0µm, PDAF, OIS, 2x optical zoom
                    12 MP, f/2.4, 120˚, 13mm (ultrawide), 1/3.6"
                    TOF 3D LiDAR scanner (depth)
                </p>
            </div>
            <div class="info">
                <span id="info-name">
                    Camera trước
                </span>
                <p id="info-detail">
                    12 MP, f/2.2, 23mm (wide), 1/3.6"
                    SL 3D, (depth/biometrics sensor)
                </p>
            </div>
            <div class="info">
                <span id="info-name">
                    Chipset
                </span>
                <p id="info-detail">Apple A14 Bionic (5 nm)</p>
            </div>

            <div class="info">
                <span id="info-name">
                    Bộ nhớ trong
                </span>
                <p id="info-detail">128GB</p>
            </div>
            <div class="info">
                <span id="info-name">
                    Pin
                </span>
                <p id="info-detail">Li-Ion, sạc nhanh 20W, sạc không dây 15W, USB Power Delivery 2.0</p>
            </div>
            <div class="info">
                <span id="info-name">
                    Thẻ SIM
                </span>
                <p id="info-detail">2 SIM (nano‑SIM và eSIM)</p>
            </div>
            <div class="info">
                <span id="info-name">
                    Hệ điều hành
                </span>
                <p id="info-detail">iOS 14.1 hoặc cao hơn (Tùy vào phiên bản phát hành)</p>
            </div>
            <div class="info">
                <span id="info-name">
                    Độ phân giải màn hình
                </span>
                <p id="info-detail">1284 x 2778 pixels</p>
            </div>
            <div class="info">
                <span id="info-name">
                    Tính năng màn hình
                </span>
                <p id="info-detail">
                    HDR10
                    Dolby Vision
                    True-tone
                    Độ sáng 800 nits
                </p>
            </div>
            <div class="info">
                <span id="info-name">
                    Thẻ SIM
                </span>
                <p id="info-detail">2 SIM (nano‑SIM và eSIM)</p>
            </div>
        </div>
    </div>
</div>

@stop
@section('js')  
    <script src="/assets_guess/js_controller/ProductDetailController.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="/assets_guess/Javascript/productdetail.js"></script>
    <script>
        var swiper = new Swiper('.swiper', {
            slidesPerView: 3,
            spaceBetween: 20,
            slidesPerGroup: 3,
            loop: false,
            loopFillGroupWithBlank: false,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>

@stop

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        .swiper {
            width: 100%;
            height: 100%;
        }
        .swiper-slide img {
            cursor: pointer;
            border: 1px solid #f2f2f2ab;
            width: calc(278% / 3);
        }
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }
    </style>

@stop