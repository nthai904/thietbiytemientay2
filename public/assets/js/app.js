$(document).ready(function () {
    $("#city").on("change", function () {
        var cityId = $(this).val();

        $("#category_id").html('<option value="">Đang tải...</option>');

        if (cityId) {
            $.ajax({
                url: "/get-categories-by-city/" + cityId,
                type: "GET",
                success: function (data) {
                    let options = '<option value="">Chọn bệnh viện</option>';
                    data.forEach(function (item) {
                        options += `<option value="${item.code}">${item.name}</option>`;
                    });
                    $("#category_id").html(options);
                    $("#category_id").trigger("change");
                },
                error: function () {
                    $("#category_id").html(
                        '<option value="">Không tìm thấy</option>'
                    );
                },
            });
        } else {
            $("#category_id").html('<option value="">Chọn bệnh viện</option>');
        }
    });
});

$(document).ready(function () {
    $("#category_id").on("change", function () {
        var categoryId = $(this).val();

        $("#group").html('<option value="">Đang tải...</option>');

        if (categoryId) {
            $.ajax({
                url: "/get-group-by-categories/" + categoryId,
                type: "GET",
                success: function (data) {
                    let options = '<option value="">Chọn gói thầu</option>';
                    data.forEach(function (item) {
                        options += `<option value="${item.id}">${item.name}</option>`;
                    });
                    $("#group").html(options);
                    $("#group").trigger("change");
                },
                error: function () {
                    $("#group").html(
                        '<option value="">Không tìm thấy</option>'
                    );
                },
            });
        } else {
            $("#group").html('<option value="">Chọn gói thầu</option>');
        }
    });
});

$(document).ready(function () {
    $("#city-document").on("change", function () {
        var cityId = $(this).val();
        $("#select-nha-thau").html('<option value="">Đang tải...</option>');

        if (cityId) {
            $.ajax({
                url: "/get-categories-by-city/" + cityId,
                type: "GET",
                success: function (data) {
                    let options = '<option value="">Chọn bệnh viện</option>';
                    data.forEach(function (item) {
                        options += `<option value="${item.code}">${item.name}</option>`;
                    });
                    $("#select-nha-thau").html(options);
                    $("#select-nha-thau").trigger("change");
                },
                error: function () {
                    $("#select-nha-thau").html(
                        '<option value="">Không tìm thấy</option>'
                    );
                },
            });
        } else {
            $("#select-nha-thau").html(
                '<option value="">Chọn bệnh viện</option>'
            );
        }
    });
});

$(document).ready(function () {
    $("#select-nha-thau").on("change", function () {
        var categoryId = $(this).val();

        $("#group").html('<option value="">Đang tải...</option>');

        if (categoryId) {
            $.ajax({
                url: "/get-group-by-categories/" + categoryId,
                type: "GET",
                success: function (data) {
                    let options = '<option value="">Chọn gói thầu</option>';
                    data.forEach(function (item) {
                        options += `<option value="${item.id}">${item.name}</option>`;
                    });
                    $("#group").html(options);
                    $("#group").trigger("change");
                },
                error: function () {
                    $("#group").html(
                        '<option value="">Không tìm thấy</option>'
                    );
                },
            });
        } else {
            $("#group").html('<option value="">Chọn gói thầu</option>');
        }
    });
});

$(document).ready(function () {
    $("#city-exchange").on("change", function () {
        var cityId = $(this).val();
        $("#select-benh-vien").html('<option value="">Đang tải...</option>');

        if (cityId) {
            $.ajax({
                url: "/get-categories-by-city/" + cityId,
                type: "GET",
                success: function (data) {
                    let options = '<option value="">Chọn bệnh viện</option>';
                    data.forEach(function (item) {
                        options += `<option value="${item.code}">${item.name}</option>`;
                    });
                    $("#select-benh-vien").html(options);
                    $("#select-benh-vien").trigger("change");
                },
                error: function () {
                    $("#select-benh-vien").html(
                        '<option value="">Không tìm thấy</option>'
                    );
                },
            });
        } else {
            $("#select-benh-vien").html(
                '<option value="">Chọn bệnh viện</option>'
            );
        }
    });
});

$(document).ready(function () {
    $("#select-exchange-product").on("change", function () {
        var code = $(this).val();
        if (code) {
            // Kiểm tra sản phẩm đã tồn tại chưa
            var existingRow = null;
            $("#product-table tr").each(function () {
                if ($(this).find(".product-code").text().trim() === code) {
                    existingRow = $(this);
                    return false; // break
                }
            });

            if (existingRow) {
                // Nếu đã tồn tại thì cộng số lượng lên 1
                var quantityInput = existingRow.find(
                    'input[name="so_luong[]"]'
                );
                var currentQty = parseInt(quantityInput.val()) || 0;
                quantityInput.val(currentQty + 1).trigger("input"); // Gọi trigger để cập nhật lại giá
            } else {
                // Nếu chưa có thì gọi Ajax để thêm dòng mới
                $.ajax({
                    url: "/product/" + code,
                    type: "GET",
                    success: function (res) {
                        if (res.success) {
                            var data = res.data;
                            var rowCount = $("#product-table tr").length + 1;

                            var newRow = `
                                <tr>
                                    <td>${rowCount}</td>
                                    <td class="product-code">${
                                        data.code || ""
                                    }</td>
                                    <td class="product-name">${
                                        data.name || ""
                                    }</td>
                                    <td class="product-quycach">${
                                        data.quy_cach || ""
                                    }</td>
                                    <td class="product-brand">${
                                        data.brand || ""
                                    }</td>
                                    <td class="product-country">${
                                        data.country || ""
                                    }</td>
                                    <td><input type="number" class="form-control border-primary product-quantity" name="so_luong[]" value="1"></td>
                                    <td class="product-price">${
                                        data.price
                                            ? Number(data.price).toLocaleString(
                                                  "vi-VN"
                                              ) + " đ"
                                            : ""
                                    }</td>
                                    <td><input type="number" class="form-control border-primary extra-price-exchange qty-input" name="extra_price[]" value="" data-bs-toggle="tooltip" title="Nhấn Ctrl + D để coppy công thức"></td>
                                    <td class="exchange-price"></td>
                                    <input type="hidden" name="exchange_price[]" class="input-exchange-price" value="">
                                    <td class="total"></td>
                                    <input type="hidden" name="thanhtien[]" class="input-total" value="">
                                    <input type="hidden" name="id_products[]" value="${
                                        data.code
                                    }">
                                    <td>
                                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            `;

                            $("#product-table").append(newRow);
                            $("#thong-tin-san-pham").show();

                            // Tính exchange-price và total ban đầu
                            var productPrice = parseFloat(data.price) || 0;
                            var quantity = 1;
                            var exchangePrice = productPrice;
                            var total = exchangePrice * quantity;

                            var lastRow = $("#product-table tr:last");
                            lastRow
                                .find(".exchange-price")
                                .text(
                                    exchangePrice.toLocaleString("vi-VN") + " đ"
                                );
                            lastRow
                                .find(".input-exchange-price")
                                .val(Math.round(exchangePrice));
                            lastRow
                                .find(".total")
                                .text(total.toLocaleString("vi-VN") + " đ");
                            lastRow.find(".input-total").val(Math.round(total));
                        }
                    },
                });
            }
        }
    });

    // Cập nhật lại exchange-price và total khi thay đổi phụ phí
    $(document).on("input", ".extra-price-exchange", function () {
        var row = $(this).closest("tr");

        var priceText = row.find(".product-price").text().replace(/\D/g, "");
        var originalPrice = parseFloat(priceText) || 0;

        var extraPrice = parseFloat($(this).val()) || 0;
        var exchangePrice = originalPrice;

        if (extraPrice < 0) {
            row.addClass("bg-red");
        } else {
            row.removeClass("bg-red");
        }

        if (extraPrice >= 1 && extraPrice <= 100) {
            exchangePrice = originalPrice * (1 + extraPrice / 100);
        } else if (extraPrice >= -100 && extraPrice <= -1) {
            exchangePrice = originalPrice * (1 + extraPrice / 100);
        } else {
            exchangePrice = originalPrice + extraPrice;
        }

        row.find(".exchange-price").text(
            exchangePrice.toLocaleString("vi-VN") + " đ"
        );
        row.find(".input-exchange-price").val(Math.round(exchangePrice));

        var quantity =
            parseInt(row.find('input[name="so_luong[]"]').val()) || 0;
        var total = quantity * exchangePrice;
        row.find(".total").text(total.toLocaleString("vi-VN") + " đ");
        row.find(".input-total").val(Math.round(total));
    });

    // Cập nhật exchange-price và total khi thay đổi số lượng
    $(document).on("input", 'input[name="so_luong[]"]', function () {
        var quantity = parseInt($(this).val()) || 0;
        var row = $(this).closest("tr");

        var priceText = row.find(".product-price").text().replace(/\D/g, "");
        var originalPrice = parseFloat(priceText) || 0;

        var extraPrice =
            parseFloat(row.find(".extra-price-exchange").val()) || 0;
        var exchangePrice = originalPrice;

        if (extraPrice >= 1 && extraPrice <= 100) {
            exchangePrice = originalPrice * (1 + extraPrice / 100);
        } else {
            exchangePrice = originalPrice + extraPrice;
        }

        row.find(".exchange-price").text(
            exchangePrice.toLocaleString("vi-VN") + " đ"
        );
        row.find(".input-exchange-price").val(Math.round(exchangePrice));

        var total = quantity * exchangePrice;
        row.find(".total").text(total.toLocaleString("vi-VN") + " đ");
        row.find(".input-total").val(Math.round(total));
    });

    // Xóa dòng sản phẩm
    $(document).on("click", ".btn-danger", function () {
        $(this).closest("tr").remove();

        // Kiểm tra lại số dòng sau khi xóa
        if ($("#product-table tr").length === 0) {
            $("#thong-tin-san-pham").hide();
        }
    });
    // Bản gốc
});
$(document).on("keydown", ".qty-input", function (e) {
    if (e.ctrlKey && (e.key === "d" || e.key === "c")) {
        e.preventDefault();
        const currentValue = parseFloat($(this).val());
        const inputs = $(".qty-input");
        const currentIndex = inputs.index(this);

        if (currentIndex + 1 < inputs.length) {
            const nextInput = inputs.eq(currentIndex + 1);
            nextInput.val(currentValue).focus();
            
            // Lấy hàng chứa ô kế tiếp
            const nextRow = nextInput.closest("tr");
            
            // Đánh dấu màu nếu giá trị âm
            if (currentValue < 0) {
                nextRow.addClass("bg-red");
            } else {
                nextRow.removeClass("bg-red");
            }
            
            // Lấy giá gốc từ product-price
            var priceText = nextRow.find('.product-price').text().replace(/[^0-9]/g, '');
            var originalPrice = parseFloat(priceText);
            
            if (!isNaN(originalPrice) && originalPrice > 0) {
                var extraPrice = currentValue;
                var bidPrice;
                
                // 👉 Xử lý tăng/giảm theo phần trăm hoặc cộng/trừ trực tiếp
                if (extraPrice >= 1 && extraPrice <= 100) {
                    bidPrice = originalPrice * (1 + extraPrice / 100);
                } else if (extraPrice >= -100 && extraPrice <= -1) {
                    bidPrice = originalPrice * (1 + extraPrice / 100);
                } else {
                    bidPrice = originalPrice + extraPrice;
                }
                
                // Cập nhật giá đấu thầu
                nextRow.find('.exchange-price').text(bidPrice.toLocaleString('vi-VN') + ' đ');
                nextRow.find('.input-exchange-price').val(Math.round(bidPrice));
                
                // Lấy số lượng
                var quantity = parseInt(nextRow.find('#nt-soluong').text()) || 1;
                var total = bidPrice * quantity;
                
                // Cập nhật tổng giá từng dòng
                nextRow.find('.total').text(total.toLocaleString('vi-VN') + ' đ');
                nextRow.find('.input-total').val(Math.round(total));
                
                // Cập nhật tổng tiền toàn bộ
                updateTotals();
            }
        }
    }
});

function toggleStatus(checkbox) {
    const label = checkbox.nextElementSibling;
    if (!label) return; 

    if (checkbox.checked) {
        label.textContent = "Trúng thầu";
        checkbox.value = "datrung"; 
    } else {
        label.textContent = "Chưa trúng";
        checkbox.value = "chuatrung"; 
    }
}
$(document).on("keydown", ".qty-input-document", function (e) {
    if (e.ctrlKey && (e.key === "d" || e.key === "c")) {
        e.preventDefault();
        const currentValue = parseFloat($(this).val());
        const inputs = $(".qty-input-document");
        const currentIndex = inputs.index(this);

        if (currentIndex + 1 < inputs.length) {
            const nextInput = inputs.eq(currentIndex + 1);
            nextInput.val(currentValue).focus();
            
            // Lấy hàng chứa ô kế tiếp
            const nextRow = nextInput.closest("tr");
            
            // Đánh dấu màu nếu giá trị âm
            if (currentValue < 0) {
                nextRow.addClass("bg-red");
            } else {
                nextRow.removeClass("bg-red");
            }
            
            // Lấy giá gốc từ product-price
            var priceText = nextRow.find('.product-price').text().replace(/[^0-9]/g, '');
            var originalPrice = parseFloat(priceText);
            
            if (!isNaN(originalPrice) && originalPrice > 0) {
                var extraPrice = currentValue;
                var bidPrice;
                
                // 👉 Xử lý tăng/giảm theo phần trăm hoặc cộng/trừ trực tiếp
                if (extraPrice >= 1 && extraPrice <= 100) {
                    bidPrice = originalPrice * (1 + extraPrice / 100);
                } else if (extraPrice >= -100 && extraPrice <= -1) {
                    bidPrice = originalPrice * (1 + extraPrice / 100);
                } else {
                    bidPrice = originalPrice + extraPrice;
                }
                
                // Cập nhật giá đấu thầu
                nextRow.find('.nt-giaduthau').text(bidPrice.toLocaleString('vi-VN') + ' đ');
                nextRow.find('.input-giaduthau').val(Math.round(bidPrice));
                
                // Lấy số lượng
                var quantity = parseInt(nextRow.find('#nt-soluong').text()) || 1;
                var total = bidPrice * quantity;
                
                // Cập nhật tổng giá từng dòng
                nextRow.find('.total').text(total.toLocaleString('vi-VN') + ' đ');
                nextRow.find('.input-total').val(Math.round(total));
                
                // Cập nhật tổng tiền toàn bộ
                updateTotals();
            }
        }
    }
});







