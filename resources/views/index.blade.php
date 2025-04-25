<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>MITA DEMO</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
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

</head>

<body>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
            $("#basic-datatables").DataTable({});

            $("#multi-filter-select").DataTable({
                pageLength: 5,
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function() {
                            var column = this;
                            var select = $(
                                    '<select class="form-select"><option value=""></option></select>'
                                )
                                .appendTo($(column.footer()).empty())
                                .on("change", function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                    column
                                        .search(val ? "^" + val + "$" : "", true, false)
                                        .draw();
                                });

                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.append(
                                        '<option value="' + d + '">' + d + "</option>"
                                    );
                                });
                        });
                },
            });

            // Add Row
            $("#add-row").DataTable({
                pageLength: 5,
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
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
            });
        });
        $('#select-nha-thau').on('change', function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: '/category-bidder/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        if (res.success) {
                            var data = res.data[0];
                            console.log(data);

                            // Clear existing rows in the table
                            $('#product-table').empty();

                            // Loop through all bidders and create rows
                            if (data.bidder && data.bidder.length > 0) {
                                data.bidder.forEach(function(bidder) {
                                    var row = `
                                <tr>
                                    <td>${data.code || ''}</td>
                                    <td>${data.name || ''}</td>
                                    <td>${bidder.ma_phan || ''}</td>
                                    <td>${bidder.ten_phan || ''}</td>
                                    <td>${bidder.product_name || ''}</td>
                                    <td>${bidder.quantity || ''}</td>
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
                                        <input type="number" class="form-control border-primary extra-price"
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
            console.log(id)
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

            // Get price text from the current row
            var priceText = currentRow.find('.product-price').text().replace(/[^0-9]/g, '');
            var originalPrice = parseFloat(priceText);

            if (!isNaN(originalPrice) && originalPrice > 0) {
                var extraPrice = parseFloat($(this).val()) || 0;
                var bidPrice;

                if (extraPrice >= 1 && extraPrice <= 100) {
                    bidPrice = originalPrice * (1 + extraPrice / 100); // Tính giá theo phần trăm
                } else {
                    bidPrice = originalPrice + extraPrice; // Nếu trên 100, cộng trực tiếp vào giá
                }

                // Update bid price in current row
                currentRow.find('.nt-giaduthau').text(bidPrice.toLocaleString('vi-VN') + ' đ');
                currentRow.find('.input-giaduthau').val(Math.round(bidPrice));

                // Get quantity from current row
                var quantity = parseInt(currentRow.find('td:eq(5)').text()) ||
                    1; // assuming quantity is in the 6th column
                var total = bidPrice * quantity;

                // Update total in current row
                currentRow.find('.total').text(total.toLocaleString('vi-VN') + ' đ');
                currentRow.find('.input-total').val(Math.round(total));
            }
        });
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

        // Hàm bắt sự kiện change cho select bằng ID
        $(document).ready(function() {
            // Bắt sự kiện cho tất cả các phần tử có ID bắt đầu bằng "select-product"
            $(document).on('change', 'select[id^="select-product"]', function() {
                var code = $(this).val();
                console.log("Đã chọn sản phẩm có mã:", code);
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
        // Lắng nghe sự kiện thay đổi của checkbox "check-all"
        document.getElementById('check-all').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('.row-checkbox');
            var isChecked = this.checked; // Lấy trạng thái checkbox "check-all"

            // Lặp qua tất cả các checkbox trong bảng và thay đổi trạng thái chúng
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });

        });

        // Lắng nghe sự kiện thay đổi của checkbox trong mỗi hàng
        document.querySelectorAll('.row-checkbox').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {

            });
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
                    selectedRows.push(rowData);
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

        document.querySelectorAll('.clickable').forEach(td => {
            td.addEventListener('click', function(event) {
                // Lấy mã ID từ thuộc tính data-id của tr
                var codeCategoryBidder = this.closest('tr').getAttribute('data-id');
                // Tạo URL chi tiết
                var url = '{{ route('document.edit', ['code' => '__code__']) }}'.replace('__code__',
                    codeCategoryBidder);
                // Chuyển hướng đến trang chi tiết
                window.location.href = url;
            });
        });
    </script>
    <script>
        // Mảng chứa các dữ liệu mẫu khác nhau liên quan đến bệnh viện
        const sampleData = [{
                code: 'NT001',
                name: 'Bệnh Viện ABC',
                address: '123 Đường ABC, Quận 1, TP.HCM',
                phone: '02812345678',
                fax: '02887654321',
                tk: 'abc123',
                tax_code: '123456789',
                represent: 'Nguyễn Văn A',
                gender: 'male', // Giới tính Nam
                position: 'ceo' // Giám Đốc
            },
            {
                code: 'NT002',
                name: 'Bệnh Viện XYZ',
                address: '456 Đường XYZ, Quận 2, TP.HCM',
                phone: '02898765432',
                fax: '02876543210',
                tk: 'xyz456',
                tax_code: '987654321',
                represent: 'Trần Thị B',
                gender: 'female', // Giới tính Nữ
                position: 'deputy_ceo' // Phó Giám Đốc
            },
            {
                code: 'NT003',
                name: 'Bệnh Viện PQR',
                address: '789 Đường PQR, Quận 3, TP.HCM',
                phone: '02854321098',
                fax: '02865432109',
                tk: 'pqr789',
                tax_code: '456789123',
                represent: 'Lê Minh C',
                gender: 'male', // Giới tính Nam
                position: 'ceo' // Giám Đốc
            }
        ];

        // Hàm để điền dữ liệu mẫu vào form
        function addSampleData() {
            // Chọn một dữ liệu ngẫu nhiên từ mảng dữ liệu mẫu
            const randomData = sampleData[Math.floor(Math.random() * sampleData.length)];

            // Cập nhật thông tin các trường
            document.getElementById('manhathau').value = randomData.code;
            document.getElementById('name').value = randomData.name;
            document.getElementById('address').value = randomData.address;
            document.getElementById('phone').value = randomData.phone;
            document.getElementById('fax').value = randomData.fax;
            document.getElementById('tk').value = randomData.tk;
            document.getElementById('tax_code').value = randomData.tax_code;
            document.getElementById('represent').value = randomData.represent;

            // Chọn giới tính và chức vụ
            document.getElementById(randomData.gender).checked = true; // Chọn giới tính
            document.getElementById('position').value = randomData.position; // Chức vụ
        }

        // Thêm sự kiện cho nút "Thêm dữ liệu mẫu"
        document.getElementById('addSampleBtn').addEventListener('click', addSampleData);
    </script>
</body>

</html>
