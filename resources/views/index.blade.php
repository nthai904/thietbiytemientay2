<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>MITA DEMO</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/img/mita-3755.png') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Add this to your <head> section -->
    <style>
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgb(251, 251, 251);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .loader {
            width: 60px;
            height: 60px;
            border: 5px solid #333;
            border-top: 5px solid #177dff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 15px;
        }

        .loader-text {
            font-family: "Public Sans", sans-serif;
            color: black;
            font-size: 16px;
            font-weight: 500;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .fade-out {
            opacity: 0;
            pointer-events: none;
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div id="loading-overlay">
        <div class="loader"></div>
        <div class="loader-text">Đang tải...</div>
    </div>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('components.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            @include('components.header')

            @yield('content')

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <nav class="pull-left">
                        {{-- <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="http://www.themekita.com">
                                    ThemeKita
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Help </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Licenses </a>
                            </li>
                        </ul> --}}
                    </nav>
                    <div class="copyright">
                        &copy; 2025, made with <i class="fa fa-heart heart text-danger"></i> by
                        <a href="https://mitacorp.vn/" target="_blank" rel="noopener noreferrer">MITACORP</a>
                    </div>

                    <div>
                        Distributed by
                        <a target="_blank" href="https://mitacorp.vn/">MITACORP</a>.
                    </div>
                </div>
            </footer>
        </div>

        {{-- <div class="custom-template">
            <div class="title">Settings</div>
            <div class="custom-content">
                <div class="switcher">
                    <div class="switch-block">
                        <h4>Logo Header</h4>
                        <div class="btnSwitch">
                            <button type="button" class="selected changeLogoHeaderColor" data-color="dark"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
                            <br />
                            <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Navbar Header</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeTopBarColor" data-color="dark"></button>
                            <button type="button" class="changeTopBarColor" data-color="blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="purple"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="green"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange"></button>
                            <button type="button" class="changeTopBarColor" data-color="red"></button>
                            <button type="button" class="selected changeTopBarColor" data-color="white"></button>
                            <br />
                            <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                            <button type="button" class="changeTopBarColor" data-color="blue2"></button>
                            <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                            <button type="button" class="changeTopBarColor" data-color="green2"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                            <button type="button" class="changeTopBarColor" data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Sidebar</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeSideBarColor" data-color="white"></button>
                            <button type="button" class="selected changeSideBarColor" data-color="dark"></button>
                            <button type="button" class="changeSideBarColor" data-color="dark2"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-toggle">
                <i class="icon-settings"></i>
            </div>
        </div> --}}
        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>


    <!-- Bootstrap Notify -->
    {{-- <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script> --}}

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>



    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/js/setting-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%'
            }).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });
        });
        $('#group').on('change', function() {
            var id = $(this).val();
            var categoryId = $('#select-nha-thau').val();
            if (id && categoryId) {
                $.ajax({
                    url: '/category-bidder/' + categoryId + '/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        if (res.success) {
                            var data = res.data;
                            var categoryBidder = data.bidder; // là object chứa thông tin nhà thầu
                            var groupBidder = data.group_bidder;
                            var bidderList = categoryBidder.bidder;
                            // Clear existing rows in the table
                            $('#product-table').empty();

                            // Loop through all bidders and create rows
                            if (bidderList && bidderList.length > 0) {
                                bidderList.forEach(function(bidder) {
                                    var row = `
                                <tr>
                                    <td>${categoryBidder.code || ''}</td>
                                    <td>${categoryBidder.name || ''}</td>
                                    <td>${bidder.ma_phan || ''}</td>
                                    <td>${bidder.ten_phan || ''}</td>
                                    <td>${bidder.product_name || ''}</td>
                                    <td id="nt-soluong">${bidder.quantity || ''}</td>
                                    <td style="width: 160px">
                                        <select name="id_product[]" class="select2 select-product" style="width: 100%">
                                            <option value="" selected disabled>Chọn mặt hàng</option>
                                            @if (isset($products))
                                                @foreach ($products as $k => $v)
                                                    <option value="{{ $v['code'] }}">{{ $v['name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td class="product-quycach"></td>
                                    <td class="product-brand"></td>
                                    <td class="product-country"></td>
                                    <td class="product-price"></td>
                                    <td>
                                        <input type="number" class="form-control border-primary extra-price qty-input-document"
                                            title="Nhập giá chênh lệch" value="" name="extra_price[]">
                                    </td>
                                    <td class="nt-giaduthau"></td>
                                    <input type="hidden" class="input-giaduthau" name="giaduthau[]">
                                    <td class="total"></td>
                                    <input type="hidden" class="input-total" name="thanhtien[]">
                                </tr>
                            `;
                                    $('#product-table').append(row);
                                });

                                // Initialize select2 for dynamically created selects
                                $('.select2').select2();

                                $('#thong-tin-nha-thau').show();
                            } else {
                                alert('Không có thông tin nhà thầu');
                                $('#thong-tin-nha-thau').hide();
                            }
                        } else {
                            alert('Không tìm thấy nhà thầu');
                            $('#thong-tin-nha-thau').hide();
                        }
                    },
                    error: function() {
                        alert('Lỗi khi tải thông tin');
                    }
                });
            }
        });
        $('#extra-price').addClass('d-none');
        $(document).on('change', '.select-product', function() {
            var id = $(this).val();
            var currentRow = $(this).closest('tr');

            if (id) {
                $.ajax({
                    url: '/product/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        if (res.success) {
                            var data = res.data;
                            currentRow.find('.product-quycach').text(data.quy_cach || '');
                            currentRow.find('.product-brand').text(data.brand || '');
                            currentRow.find('.product-country').text(data.country || '');
                            currentRow.find('.product-price').text(
                                data.price ?
                                Number(data.price).toLocaleString('vi-VN') + ' đ' :
                                ''
                            );
                            currentRow.find('.extra-price').removeClass('d-none');

                            // Sau khi cập nhật giá gốc, gọi hàm tính toán lại giá đấu thầu
                            var extraPriceInput = currentRow.find('.extra-price');
                            if (extraPriceInput.val()) {
                                extraPriceInput.trigger(
                                    'input'); // Kích hoạt sự kiện input để tính toán lại
                            } else {
                                // Nếu chưa có giá trị phụ thu, cập nhật giá đấu thầu bằng giá gốc
                                var originalPrice = data.price || 0;

                                // Cập nhật giá đấu thầu
                                currentRow.find('.nt-giaduthau').text(Number(originalPrice)
                                    .toLocaleString('vi-VN') + ' đ');
                                currentRow.find('.input-giaduthau').val(Math.round(originalPrice));

                                // Lấy số lượng
                                var quantity = parseInt(currentRow.find('td:eq(5)').text()) || 1;
                                var total = originalPrice * quantity;

                                // Cập nhật tổng giá từng dòng
                                currentRow.find('.total').text(Number(total).toLocaleString('vi-VN') +
                                    ' đ');
                                currentRow.find('.input-total').val(Math.round(total));

                                // Cập nhật tổng tiền toàn bộ
                                updateTotals();
                            }
                        }
                    },
                    error: function() {
                        alert('Lỗi khi tải thông tin');
                    }
                });
            }
        });

        $(document).on('input', '.extra-price', function() {
            var currentRow = $(this).closest('tr');

            var priceText = currentRow.find('.product-price').text().replace(/[^0-9]/g, '');
            var originalPrice = parseFloat(priceText);

            if (!isNaN(originalPrice) && originalPrice > 0) {
                var extraPrice = parseFloat($(this).val()) || 0;
                var bidPrice;

                if (extraPrice < 0) {
                    currentRow.addClass("bg-red");
                } else {
                    currentRow.removeClass("bg-red");
                }

                // 👉 Xử lý tăng/giảm theo phần trăm hoặc cộng/trừ trực tiếp
                if (extraPrice >= 1 && extraPrice <= 100) {
                    bidPrice = originalPrice * (1 + extraPrice / 100);
                } else if (extraPrice >= -100 && extraPrice <= -1) {
                    bidPrice = originalPrice * (1 + extraPrice / 100);
                } else {
                    bidPrice = originalPrice + extraPrice;
                }

                // Cập nhật giá đấu thầu
                currentRow.find('.nt-giaduthau').text(bidPrice.toLocaleString('vi-VN') + ' đ');
                currentRow.find('.input-giaduthau').val(Math.round(bidPrice));

                // Lấy số lượng
                var quantity = parseInt(currentRow.find('#nt-soluong').text()) || 1;
                var total = bidPrice * quantity;
                // Cập nhật tổng giá từng dòng
                currentRow.find('.total').text(total.toLocaleString('vi-VN') + ' đ');
                currentRow.find('.input-total').val(Math.round(total));

                // Cập nhật tổng tiền toàn bộ
                updateTotals();
            }
        });

        function removeCurrencyFormat(str) {
            return str.replace(/[^0-9]/g, '');
        }

        function formatCurrency(num) {
            num = Number(num);
            if (isNaN(num)) return '';
            return num.toLocaleString('vi-VN') + ' đ';
        }

        function setupEditableCurrencyFields() {
            document.querySelectorAll('.nt-giaduthau').forEach(td => {
                td.addEventListener('focus', function() {
                    let raw = removeCurrencyFormat(this.textContent);
                    this.dataset.oldValue = raw;
                    this.textContent = raw;
                });

                td.addEventListener('blur', function() {
                    let raw = removeCurrencyFormat(this.textContent);

                    // So sánh giá trị mới với giá trị cũ
                    if (raw === this.dataset.oldValue) {
                        // Nếu không thay đổi, format lại và thoát luôn
                        this.textContent = formatCurrency(raw);
                        return;
                    }

                    // Nếu có thay đổi, xử lý cập nhật
                    this.textContent = formatCurrency(raw);

                    const currentRow = this.closest('tr');
                    if (!currentRow) return;

                    const price = Number(raw);
                    const quantityText = currentRow.querySelector('#nt-soluong')?.textContent || '1';
                    const quantity = parseInt(quantityText, 10) || 1;
                    const total = price * quantity;
                    var priceTextEl = currentRow.querySelector('.product-price');
                    var priceText = priceTextEl ? priceTextEl.textContent.replace(/[^0-9]/g, '') : '0';
                    var originalPrice = parseFloat(priceText);

                    // Cập nhật hiển thị tổng tiền (class .total)
                    const totalEl = currentRow.querySelector('.total');
                    if (totalEl) {
                        totalEl.textContent = formatCurrency(total);
                    }

                    // Cập nhật input ẩn tổng tiền
                    const inputTotal = currentRow.querySelector('.input-total');
                    if (inputTotal) {
                        inputTotal.value = Math.round(total);
                    }

                    // Cập nhật input giá đấu thầu (.input-giaduthau) = giá mới (.nt-giaduthau)
                    const inputGiaDauThau = currentRow.querySelector('.input-giaduthau');
                    if (inputGiaDauThau) {
                        inputGiaDauThau.value = Math.round(price);
                    }

                    // Reset giá trị extra-price input
                    const extraPriceInput = currentRow.querySelector('.extra-price');
                    if (extraPriceInput && originalPrice > 0) {
                        const extra = (price / originalPrice - 1) * 100;
                        extraPriceInput.value = Number.isInteger(extra) ?
                            extra :
                            parseFloat(extra.toFixed(2));
                    }


                    // Gọi hàm tổng toàn bộ (nếu có)
                    if (typeof updateTotals === 'function') {
                        updateTotals();
                    }
                });

                td.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        this.blur();
                    }
                });
            });
        }

        // Gọi khi trang load xong
        document.addEventListener('DOMContentLoaded', setupEditableCurrencyFields);

        function updateTotals() {
            // Tổng tiền ban đầu
            var totalOriginal = 0;
            $('.product-price').each(function(index) {
                var price = parseFloat($(this).text().replace(/[^0-9]/g, '')) || 0;
                var qty = parseInt($('tr').eq(index + 1).find('#nt-soluong').text()) || 1; // +1 bỏ header
                totalOriginal += price * qty;
            });
            $('#total-original').text(totalOriginal.toLocaleString('vi-VN') + ' đ');

            // Tổng thành tiền sau bid
            var grandTotal = 0;
            $('.input-total').each(function() {
                var val = parseFloat($(this).val()) || 0;
                grandTotal += val;
            });
            $('#display-total-amount').text(grandTotal.toLocaleString('vi-VN') + ' đ');

            // 👉 Cập nhật lợi nhuận = tổng thành tiền - tổng gốc
            var profit = grandTotal - totalOriginal;
            $('#total-profit').text(profit.toLocaleString('vi-VN') + ' đ');
        }
        $(document).ready(function() {
            // Khi người dùng bấm vào một hàng, hiển thị chi tiết
            $(".clickable-row").click(function() {
                var rowId = $(this).data("id");

                // Tìm hàng chi tiết liên quan và chuyển đổi hiển thị
                var detailsRow = $("#details-" + rowId);

                if (detailsRow.is(":visible")) {
                    detailsRow.hide(); // Ẩn chi tiết nếu nó đang hiển thị
                } else {
                    detailsRow.show(); // Hiển thị chi tiết nếu nó đang ẩn
                }
            });
        });
        $(document).ready(function() {
            // Bắt sự kiện cho tất cả các phần tử có ID bắt đầu bằng "select-product"
            $(document).on('change', 'select[id^="select-product"]', function() {
                var code = $(this).val();
                var currentRow = $(this).closest('tr');

                if (code) {
                    $.ajax({
                        url: '/product/' + code,
                        type: 'GET',
                        dataType: 'json',
                        success: function(res) {
                            if (res.success) {
                                var data = res.data;
                                currentRow.find('.product-quycach').text(data.quy_cach || '');
                                currentRow.find('.product-brand').text(data.brand || '');
                                currentRow.find('.product-country').text(data.country || '');
                                currentRow.find('.product-price').text(
                                    data.price ?
                                    Number(data.price).toLocaleString('vi-VN') + ' đ' :
                                    ''
                                );
                                currentRow.find('.extra-price').removeClass('d-none');

                                // Đặt giá trị mặc định cho extra-price nếu chưa có
                                if (!currentRow.find('.extra-price').val()) {
                                    currentRow.find('.extra-price').val(0);
                                }

                                // Kích hoạt sự kiện input cho extra-price để tính toán giá
                                currentRow.find('.extra-price').trigger('input');
                            }
                        },
                        error: function(xhr) {
                            var errorMessage = 'Lỗi khi tải thông tin sản phẩm';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            alert(errorMessage);
                        }
                    });
                } else {
                    // Nếu không chọn sản phẩm, xóa các thông tin liên quan
                    currentRow.find('.product-quycach').text('');
                    currentRow.find('.product-brand').text('');
                    currentRow.find('.product-country').text('');
                    currentRow.find('.product-price').text('');
                    currentRow.find('.extra-price').addClass('d-none');
                }
            });
        });
    </script>
    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script>
    <script>
        $(document).ready(function() {
            // Hàm chuyển đổi tiếng Việt có dấu thành không dấu


            // Khởi tạo DataTables với tùy chỉnh cho tìm kiếm tiếng Việt
            $('#basic-datatables').DataTable({
                order: [],

                pageLength: 10,
                language: {
                    "lengthMenu": "Hiển thị _MENU_ kết quả",
                    "zeroRecords": "Không tìm thấy kết quả nào",
                    "info": "Hiển thị từ _START_ đến _END_ của _TOTAL_ kết quả",
                    "infoEmpty": "Không có dữ liệu",
                    "infoFiltered": "(lọc từ _MAX_ tổng kết quả)",
                    "search": "Tìm kiếm:",
                    "paginate": {
                        "first": "Đầu",
                        "last": "Cuối",
                        "next": "Sau",
                        "previous": "Trước"
                    },
                    "loadingRecords": "Đang tải...",
                    "processing": "Đang xử lý...",
                }
            });

            $('#multi-filter-select').DataTable({
                pageLength: 10,
                language: {
                    "lengthMenu": "Hiển thị _MENU_ kết quả",
                    "zeroRecords": "Không tìm thấy kết quả nào",
                    "info": "Hiển thị từ _START_ đến _END_ của _TOTAL_ kết quả",
                    "infoEmpty": "Không có dữ liệu",
                    "infoFiltered": "(lọc từ _MAX_ tổng kết quả)",
                    "search": "Tìm kiếm:",
                    "paginate": {
                        "first": "Đầu",
                        "last": "Cuối",
                        "next": "Sau",
                        "previous": "Trước"
                    },
                    "loadingRecords": "Đang tải...",
                    "processing": "Đang xử lý...",
                },
                initComplete: function() {
                    var api = this.api();

                    // Fill select options từ dữ liệu thật
                    function fillSelect(colIndex, selectId) {
                        var column = api.column(colIndex);
                        var select = $(selectId);
                        column.data().unique().sort().each(function(d) {
                            if (d) select.append(`<option value="${d}">${d}</option>`);
                        });

                        select.on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    }

                    fillSelect(1, '#filter-package');
                    fillSelect(2, '#filter-hospital-code');
                    fillSelect(3, '#filter-hospital-name');
                }
            });


            // Add Row
            $("#add-row").DataTable({
                pageLength: 10,
                language: {
                    "lengthMenu": "Hiển thị _MENU_ kết quả",
                    "zeroRecords": "Không tìm thấy kết quả nào",
                    "info": "Hiển thị từ _START_ đến _END_ của _TOTAL_ kết quả",
                    "infoEmpty": "Không có dữ liệu",
                    "infoFiltered": "(lọc từ _MAX_ tổng kết quả)",
                    "search": "Tìm kiếm:",
                    "paginate": {
                        "first": "Đầu",
                        "last": "Cuối",
                        "next": "Sau",
                        "previous": "Trước"
                    },
                    "loadingRecords": "Đang tải...",
                    "processing": "Đang xử lý...",
                }
            });
            $("#add-row-bid").DataTable({
                paging: false,
                info: false,
                order: [],
                language: {
                    "lengthMenu": "Hiển thị _MENU_ kết quả",
                    "zeroRecords": "Không tìm thấy kết quả nào",
                    "info": "Hiển thị từ _START_ đến _END_ của _TOTAL_ kết quả",
                    "infoEmpty": "Không có dữ liệu",
                    "infoFiltered": "(lọc từ _MAX_ tổng kết quả)",
                    "search": "Tìm kiếm:",
                    "paginate": {
                        "first": "Đầu",
                        "last": "Cuối",
                        "next": "Sau",
                        "previous": "Trước"
                    },
                    "loadingRecords": "Đang tải...",
                    "processing": "Đang xử lý...",
                },
                search: {
                    smart: true,
                    regex: false,
                    caseInsensitive: true
                },
                initComplete: function() {
                    $('.dataTables_filter input')
                        .attr('placeholder', 'Nhập mã phần lô để tìm kiếm...')
                        .css('width', '250px');
                }
            });
            $("#table-no-paging").DataTable({
                paging: false,
                searching: true,
                info: false,
                order: [],
                search: {
                    smart: true,
                    regex: false,
                    caseInsensitive: true
                },
                language: {
                    "lengthMenu": "Hiển thị _MENU_ kết quả",
                    "zeroRecords": "Không tìm thấy kết quả nào",
                    "info": "Hiển thị từ _START_ đến _END_ của _TOTAL_ kết quả",
                    "infoEmpty": "Không có dữ liệu",
                    "infoFiltered": "(lọc từ _MAX_ tổng kết quả)",
                    "search": "Tìm kiếm:",
                    "paginate": {
                        "first": "Đầu",
                        "last": "Cuối",
                        "next": "Sau",
                        "previous": "Trước"
                    },
                    "loadingRecords": "Đang tải...",
                    "processing": "Đang xử lý...",
                },
            });
            var action =
                '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

            $("#addRowButton").click(function() {
                $("#add-row")
                    .dataTable()
                    .fnAddData([
                        $("#addName").val(),
                        $("#addPosition").val(),
                        $("#addOffice").val(),
                        action,
                    ]);
                $("#addRowModal").modal("hide");
            });
        });
    </script>
    <script>
        document.getElementById('importButton').addEventListener('click', function() {
            // Mở hộp thoại chọn tệp khi bấm vào nút Import
            document.getElementById('fileInput').click();
        });

        // Khi người dùng chọn tệp, gửi form
        document.getElementById('fileInput').addEventListener('change', function(event) {
            if (this.files.length > 0) {
                // Nếu người dùng đã chọn tệp, gửi form
                event.target.form.submit(); // Đảm bảo là form được gửi
            }
        });
    </script>

    <script>
        document.addEventListener('change', function(e) {
            if (e.target && e.target.classList.contains('row-checkbox')) {
                // Đây là checkbox trong dòng
                // toggleStatus(e.target); // nếu cần xử lý
            }

            if (e.target && e.target.id === 'check-all') {
                var isChecked = e.target.checked;
                var checkboxes = document.querySelectorAll('.row-checkbox');
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = isChecked;
                    // toggleStatus(checkbox);
                });
            }
        });


        document.querySelector('body').addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('exportButton')) {
                event.preventDefault();

                var selectedRows = [];
                var actionType = event.target.getAttribute('data-action');

                // Lấy tất cả checkbox đã chọn
                document.querySelectorAll('.row-checkbox:checked').forEach(function(checkbox) {
                    var row = checkbox.closest('tr');
                    var rowData = row.dataset.id;
                    var rowDate = row.dataset.date;
                    if (row.dataset.date?.trim()) {
                        selectedRows.push({
                            id: rowData,
                            date: rowDate
                        });
                    } else {
                        selectedRows.push(rowData);
                    }

                });

                // Nếu là Word mà chọn nhiều hơn 1 dòng → alert rồi dừng
                if (actionType === 'word' && selectedRows.length > 1) {
                    alert('Chỉ có thể xuất 1 nhà thầu');
                    return;
                }

                // Nếu không chọn dòng nào → alert rồi dừng
                if (selectedRows.length === 0) {
                    alert('Vui lòng chọn ít nhất một bảng để xuất!');
                    return;
                }

                // Gán selectedRows vào input hidden
                document.getElementById('selectedRows' + capitalizeFirstLetter(actionType)).value = JSON.stringify(
                    selectedRows);

                // Submit form tương ứng
                document.getElementById('exportForm' + capitalizeFirstLetter(actionType)).submit();
            }
        });

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>
    <script>
        const sampleData = [{
                code: 'BV001',
                name: 'Bệnh viện Chợ Rẫy',
                address: '201B Nguyễn Chí Thanh, Phường 12, Quận 5, TP.HCM',
                phone: '02838554137',
                fax: '02838565900',
                tk: '0200123456789',
                tax_code: '0301440971',
                represent: 'BS. Nguyễn Văn Hùng',
                gender: 'male',
                position: 'Giám Đốc',
                city_id: 60 // TP.HCM (ví dụ)
            },
            {
                code: 'BV002',
                name: 'Bệnh viện Bạch Mai',
                address: '78 Giải Phóng, Đống Đa, Hà Nội',
                phone: '02438693731',
                fax: '02438692163',
                tk: '0100123456789',
                tax_code: '0100116755',
                represent: 'PGS.TS. Trần Thị Lan',
                gender: 'female',
                position: 'Phó Giám Đốc',
                city_id: 25 // Hà Nội
            },
            {
                code: 'BV003',
                name: 'Bệnh viện Trung ương Huế',
                address: '16 Lê Lợi, Vĩnh Ninh, TP. Huế',
                phone: '02343822448',
                fax: '02343822519',
                tk: '1900123456789',
                tax_code: '3300100281',
                represent: 'TS. Phạm Văn Khoa',
                gender: 'male',
                position: 'Giám Đốc',
                city_id: 56 // Thừa Thiên Huế
            },
            {
                code: 'BV004',
                name: 'Bệnh viện Đại học Y Dược TP.HCM',
                address: '215 Hồng Bàng, Phường 11, Quận 5, TP.HCM',
                phone: '02838554269',
                fax: '02838554270',
                tk: '0300123456789',
                tax_code: '0303193689',
                represent: 'ThS. Nguyễn Thị Hạnh',
                gender: 'female',
                position: 'Phó Giám Đốc',
                city_id: 60 // TP.HCM
            },
            {
                code: 'BV005',
                name: 'Bệnh viện Đại học Y Dược Cần Thơ',
                address: '179 Nguyễn Văn Cừ, An Khánh, Ninh Kiều, Cần Thơ',
                phone: '02923835678',
                fax: '02923835679',
                tk: '0300987654321',
                tax_code: '1800123456',
                represent: 'BS. Trần Văn Minh',
                gender: 'male',
                position: 'Giám Đốc',
                city_id: 14 // Cần Thơ
            }

        ];

        function addSampleData() {
            const randomData = sampleData[Math.floor(Math.random() * sampleData.length)];

            document.getElementById('manhathau').value = randomData.code;
            document.getElementById('name').value = randomData.name;
            document.getElementById('address').value = randomData.address;
            document.getElementById('phone').value = randomData.phone;
            document.getElementById('fax').value = randomData.fax;
            document.getElementById('tk').value = randomData.tk;
            document.getElementById('tax_code').value = randomData.tax_code;
            document.getElementById('represent').value = randomData.represent;
            document.getElementById(randomData.gender).checked = true;

            // Set select2 position
            $('#position').val(randomData.position).trigger('change');

            // Set select2 city
            $('#city').val(randomData.city_id).trigger('change');
        }

        document.getElementById('addSampleBtn').addEventListener('click', addSampleData);
    </script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        function hideLoadingOverlay() {
            const overlay = document.getElementById('loading-overlay');
            overlay.classList.add('fade-out');
            setTimeout(() => {
                overlay.style.display = 'none';
            }, 500); // Matches the transition duration
        }

        window.addEventListener('load', function() {
            setTimeout(hideLoadingOverlay, 300);
        });

        setTimeout(hideLoadingOverlay, 8000);
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
    @endif

</body>

</html>
