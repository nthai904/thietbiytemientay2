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
                            <td>
                                <select name="id_product[]" class="select2 select-product">
                                    <option value="" selected disabled>-- Chọn mặt hàng --</option>
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