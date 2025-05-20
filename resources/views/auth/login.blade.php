<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('assets/img/mita-3755.png')}}" rel="shortcut icon" type="image/x-icon">
    <title>Administrator - CÔNG TY CỔ PHẦN GIẢI PHÁP MITA</title>

    <!-- Css all -->
    <!-- Css Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Css Files -->
    <link href="{{ asset('assets/login/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/confirm.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/sumoselect.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/jquery.datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/ion.rangeSlider.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/jquery.filer.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/jquery.filer-dragdropbox-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/HoldOn.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/HoldOn-style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/simple-notify.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/comment.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/adminlte.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/owl.theme.default.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/adminlte-style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/login/css/login.css') }}" rel="stylesheet">
    <style>
        .success .swal2-timer-progress-bar {
            background: #10b981 !important;
        }
    </style>
</head>

<body class="sidebar-mini hold-transition text-sm login-page">
    <!--  -->
    <section class="banner-area">
        <div class="all-banner-slide owl-carousel">
        </div>
    </section>
    <!--  -->
    <!-- Loader -->
    <!-- <div class="loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer">
                    <div class="circle-clipper float-left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper float-right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div> -->
    <!-- Wrapper -->

    <div class="login-box login_blueweb">

        <div class="img_loginadmin">

            <img class="" src="{{ asset('assets/login/images/chua-co-ten-600-x-700-px-6070-4973-7642.png') }}"
                alt="" title="mitacorp.vn" />

        </div>

        <div class="gr_loginn">

            <div class="gr_toploginf">

                <div class="title_bluewf">M<span>IT</span>A</div>

                {{-- <a href="../" target="_blank" title="Xem website">

                    <div class="btn_vtrchu">

                        <div class="txt_quayve">Về trang chủ</div>

                        <img src="{{asset('assets/login/images/icontrangchu.png')}}" alt="" class="icontrangchu">

                    </div>

                </a> --}}

            </div>

            <div class="gr_titlehethong">

                <img src="{{ asset('assets/login/images/security.png') }}" alt="" class="security">

                <div class="title_loginhethong">Đăng Nhập Hệ Thống</div>

                <!-- <div class="mien">ytemientay......</div> -->

            </div>

            <div class="card-body login-card-body">

                <form enctype="multipart/form-data" action="{{ route('login.create') }}" method="POST"
                    id="form-login">
                    @csrf
                    <div class=" mb-3 input_loginf">

                        <img src="{{ asset('assets/login/images/user_l.png') }}" alt="" class="user_l">

                        <input type="text" class="form-control text-sm" name="user_name" id="user_name"
                            placeholder="Tài khoản *" autocomplete="off">

                    </div>

                    <div class=" mb-3 input_loginf">

                        <img src="{{ asset('assets/login/images/pass_l.png') }}" alt="" class="user_l">

                        <input type="password" class="form-control text-sm" name="password" id="password"
                            placeholder="Mật khẩu *" autocomplete="off">

                        <div class="input-group-append" onclick="togglePassword()">

                            <div class="show-password">

                                <span id="toggle-icon" class="fas fa-eye"></span>

                            </div>

                        </div>

                    </div>

                    <button type="submit" class="btn btn-sm btn-block btn-login text-sm butttonlogin">

                        <div class="sk-chase d-none">

                            <div class="sk-chase-dot"></div>

                            <div class="sk-chase-dot"></div>

                            <div class="sk-chase-dot"></div>

                            <div class="sk-chase-dot"></div>

                            <div class="sk-chase-dot"></div>

                            <div class="sk-chase-dot"></div>

                        </div>

                        <span class="span-mother">

                            <span>Đ</span>

                            <span>Ă</span>

                            <span>N</span>

                            <span>G</span>

                            <span> </span>

                            <span>N</span>

                            <span>H</span>

                            <span>Ậ</span>

                            <span>P</span>

                        </span>

                        <span class="span-mother2">

                            <span>Đ</span>

                            <span>Ă</span>

                            <span>N</span>

                            <span>G</span>

                            <span> </span>

                            <span>N</span>

                            <span>H</span>

                            <span>Ậ</span>

                            <span>P</span>

                        </span>

                    </button>

                    <div class="alert my-alert alert-login d-none text-center text-sm p-2 mb-0 mt-2" role="alert">
                    </div>

                    <div class="login-copyright text-sm">Powered by <a href="https://mitacorp.vn/" target="_blank"
                            title="mitacorp.vn">mitacorp.vn</a></div>

                </form>

            </div>

        </div>

    </div> <!-- Js all -->
    <!-- Js Config -->
    <script type="text/javascript">
        var PHP_VERSION = 80228;
        console.log(PHP_VERSION);
        var CONFIG_BASE = 'https://mitacorp.vn/';
        var TOKEN = '40ce942ab2396560e6d8290b78698a38';
        var ADMIN = 'admin';
        var ASSET = 'https://mitacorp.vn/';
        var LINK_FILTER = '';
        var ID = 0;
        var COM = 'user';
        var ACT = 'login';
        var TYPE = '';
        var HASH = '2e9KPy1AxN';
        var ACTIVE_GALLERY = false;
        var BASE64_QUERY_STRING = 'Y29tPXVzZXImYWN0PWxvZ2lu';
        var LOGIN_PAGE = true;
        var MAX_DATE = '2025/05/16';
        var CHARTS = {};
        var ADD_OR_EDIT_PERMISSIONS = false;
        var IMPORT_IMAGE_EXCELL = false;
        var ORDER_ADVANCED_SEARCH = false;
        var ORDER_MIN_TOTAL = 1;
        var ORDER_MAX_TOTAL = 1;
        var ORDER_PRICE_FROM = 1;
        var ORDER_PRICE_TO = 1;
        var LANG = {
            'taithembinhluan': 'Tải thêm bình luận',
            'xemthembinhluan': 'Xem thêm bình luận',
            'traloi': 'Trả lời',
            'dangtai': 'Đang tải',
            'huybo': 'Hủy bỏ',
            'duyet': 'Duyệt',
            'boduyet': 'Bỏ duyệt',
            'timkiem': 'Tìm kiếm',
            'thongbao': 'Thông báo',
            'chondanhmuc': 'Chọn danh mục',
            'dulieukhonghople': 'Dữ liệu không hợp lệ',
            'dinhdanghinhanhkhonghople': 'Định dạng hình ảnh không hợp lệ',
            'dungluonghinhanhlondungluongchopheplt4mb4096kb': 'Dung lượng hình ảnh lớn. Dung lượng cho phép <= 4MB ~ 4096KB',
            'xoabinhluanthanhcong': 'Xóa bình luận thành công',
            'banmuonxoabinhluannay': 'Bạn muốn xóa bình luận này ?',
            'capnhattrangthaithanhcong': 'Cập nhật trạng thái thành công',
            'phanhoithanhcong': 'Phản hồi thành công',
            'hethongbiloivuilongthulaisau': 'Hệ thống bị lỗi. Vui lòng thử lại sau.',
            'duongdankhonghople': 'Đường dẫn không hợp lệ',
            'banhaychonitnhat1mucdegui': 'Bạn hãy chọn ít nhất 1 mục để gửi',
            'albumhientai': 'Album hiện tại',
            'chontatca': 'Chọn tất cả',
            'sapxep': 'Sắp xếp',
            'dongy': 'Đồng ý',
            'xoatatca': 'Xóa tất cả',
            'cothechonnhieuhinhdedichuyen': 'Có thể chọn nhiều hình để di chuyển',
            'xulythatbaivuilongthulaisau': 'Xử lý thất bại. Vui lòng thử lại sau.',
            'banmuondaytinnay': 'Bạn muốn đẩy tin này ?',
            'banmuonguithongtinchocacmucdachon': 'Bạn muốn gửi thông tin cho các mục đã chọn ?',
            'bancochacmuonxoamucnay': 'Bạn có chắc muốn xóa mục này ?',
            'bancochacmuonxoanhungmucnay': 'Bạn có chắc muốn xóa những mục này ?',
            'dulieuhinhanhkhonghople': 'Dữ liệu hình ảnh không hợp lệ',
            'noidungseodaduocthietlapbanmuontaolainoidungseo': 'Nội dung SEO đã được thiết lập. Bạn muốn tạo lại nội dung SEO ?',
            'bancochacmuonxoahinhanhnay': 'Bạn có chắc muốn xóa hình ảnh này ?',
            'bancochacmuonxoacachinhanhdachon': 'Bạn có chắc muốn xóa các hình ảnh đã chọn ?',
            'keovathahinhvaoday': 'Kéo và thả hình vào đây',
            'hoac': 'hoặc',
            'hinhanh': 'Hình ảnh',
            'chonhinh': 'Chọn hình',
            'chiduocuploadmoilan': 'Chỉ được upload mỗi lần',
            'themhinh': 'Thêm hình',
            'vuilongchonhinhanh': 'Vui lòng chọn hình ảnh',
            'nhunghinhdaduocchon': 'Những hình đã được chọn',
            'keohinhvaodaydeupload': 'Kéo hình vào đây để upload',
            'banmuonloaibohinhanhnay': 'Bạn muốn loại bỏ hình ảnh này ?',
            'uploadhinhanh': 'Upload hình ảnh',
            'sothutu': 'Số thứ tự',
            'chihotrotaptinlahinhanhcodinhdang': 'Chỉ hỗ trợ tập tin là hình ảnh có định dạng',
            'cokichthuocqualonvuilonguploadhinhanhcokichthuoctoida': 'có kích thước quá lớn. Vui lòng upload hình ảnh có kích thước tối đa',
            'nhunghinhanhbanchoncokichthuocqualonvuilongchonnhunghinhanhcokichthuoctoida': 'Những hình ảnh bạn chọn có kích thước quá lớn. Vui lòng chọn những hình ảnh có kích thước tối đa',
        };
    </script>

    <!-- Js Files -->
    <script src="{{ asset('assets/login/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/login/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/login/js/adminlte.js') }}"></script>
    {{-- <script src="{{asset('assets/login/js/fancybox.umd.js')}}"></script> --}}
    <script src="{{ asset('assets/login/js/apps.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('toggle-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    popup: 'success',
                    closeButton: 'toast-close-btn'
                }
            });

            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}",
                showCloseButton: true
            });

            setTimeout(() => {
                const closeBtn = document.querySelector('.toast-close-btn');
                if (closeBtn) {
                    closeBtn.addEventListener('click', () => {
                        Swal.close();
                    });
                }
            }, 50);
        </script>
    @elseif (session('error'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    popup: 'error',
                    closeButton: 'toast-close-btn'
                }
            });

            Toast.fire({
                icon: 'error',
                title: "{{ session('error') }}",
                showCloseButton: true
            });

            setTimeout(() => {
                const closeBtn = document.querySelector('.toast-close-btn');
                if (closeBtn) {
                    closeBtn.addEventListener('click', () => {
                        Swal.close();
                    });
                }
            }, 50);
        </script>
    @endif
</body>

</html>
