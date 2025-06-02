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
        $("#select-nha-thau-da-dau-thau").html(
            '<option value="">Đang tải...</option>'
        );

        if (cityId) {
            $.ajax({
                url: "/get-categories-by-city/" + cityId,
                type: "GET",
                success: function (data) {
                    let options = '<option value="">Chọn bệnh viện</option>';
                    data.forEach(function (item) {
                        options += `<option value="${item.code}">${item.name}</option>`;
                    });
                    $("#select-nha-thau-da-dau-thau").html(options);
                    $("#select-nha-thau-da-dau-thau").trigger("change");
                },
                error: function () {
                    $("#select-nha-thau-da-dau-thau").html(
                        '<option value="">Không tìm thấy</option>'
                    );
                },
            });
        } else {
            $("#select-nha-thau-da-dau-thau").html(
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
    $("#select-nha-thau-da-dau-thau").on("change", function () {
        var categoryId = $(this).val();

        $("#group-da-dau-thau").html('<option value="">Đang tải...</option>');

        if (categoryId) {
            $.ajax({
                url: "/get-group-dau-thau/" + categoryId,
                type: "GET",
                success: function (data) {
                    let options = '<option value="">Chọn gói thầu</option>';
                    data.forEach(function (item) {
                        options += `<option value="${item.id}">${item.name}</option>`;
                    });
                    $("#group-da-dau-thau").html(options);
                    $("#group-da-dau-thau").trigger("change");
                },
                error: function () {
                    $("#group-da-dau-thau").html(
                        '<option value="">Không tìm thấy</option>'
                    );
                },
            });
        } else {
            $("#group-da-dau-thau").html(
                '<option value="">Chọn gói thầu</option>'
            );
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
    // Hàm tính tổng số lượng và tổng thành tiền
    function updateTotals() {
        var totalQuantity = 0;
        var totalAmount = 0;

        $("#product-table tr").each(function () {
            var quantity = parseInt($(this).find('input[name="so_luong[]"]').val()) || 0;
            var totalText = $(this).find(".input-total").val();
            var total = parseFloat(totalText) || 0;

            totalQuantity += quantity;
            totalAmount += total;
        });

        // Cập nhật tổng số lượng
        $("#total-quantity").text(totalQuantity);
        
        // Cập nhật tổng thành tiền (định dạng tiền tệ VN)
        $("#total-amount").text(totalAmount.toLocaleString("vi-VN") + " đ");
    }

    $("#select-exchange-product").on("change", function () {
        var code = $(this).val();
        if (code) {
            var existingRow = null;
            $("#product-table tr").each(function () {
                if ($(this).find(".product-code").text().trim() === code) {
                    existingRow = $(this);
                    return false; // break
                }
            });

            if (existingRow) {
                var quantityInput = existingRow.find(
                    'input[name="so_luong[]"]'
                );
                var currentQty = parseInt(quantityInput.val()) || 0;
                quantityInput.val(currentQty + 1).trigger("input"); // Gọi trigger để cập nhật lại giá
            } else {
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
                                        data.ky_ma_hieu || ""
                                    }</td>
                                    <td>
                                        <input type="text" name="danh_muc_hang_hoa[]" class="input-full-td" title="Nhập danh mục hàng hóa">
                                    </td>
                                    <td class="product-name">
                                    ${data.name || ""}</td>
                                    <td>
                                        <textarea name="thong_so_ky_thuat_co_ban[]" rows="3" class="form-control">${
                                            data.thong_so_ky_thuat_co_ban || ""
                                        }</textarea>
                                    </td>
                                    <td class="product-quycach">
                                        <input type="text" name="quy_cach[]" value="${
                                            data.quy_cach || ""
                                        }" class="input-full-td" title="Nhập quy cách đóng gói" required>
                                    </td>
                                    
                                    <td class="product-brand"><input type="text" name="hang_sx[]" value="${
                                        data.hang_sx || ""
                                    }" class="input-full-td" title="Nhập hãng sản xuất" required></td>
                                    <td class="product-brand"><input type="text" name="nuoc_sx[]" value="${
                                        data.nuoc_sx || ""
                                    }" class="input-full-td" title="Nhập nước sản xuất" required></td>
                                    <td><input type="number" id="nt-soluong" class="form-control border-primary product-quantity" name="so_luong[]" value="1"></td>
                                    <td class="product-price" >${
                                        data.gia_von
                                            ? Number(
                                                  data.gia_von
                                              ).toLocaleString("vi-VN") + " đ"
                                            : ""
                                    }</td>
                                    <td><input type="number" class="form-control border-primary extra-price-exchange qty-input" name="extra_price[]" value="" data-bs-toggle="tooltip" title="Nhấn Ctrl + D để coppy công thức"></td>
                                    <td class="exchange-price nt-giaduthau" contenteditable="true"></td>
                                    <input type="hidden" name="exchange_price[]" class="input-exchange-price" value="">
                                    <td class="total"></td>
                                    <input type="hidden" name="thanhtien[]" class="input-total" value="">
                                    <input type="hidden" name="id_products[]" value="${
                                        data.ky_ma_hieu
                                    }">
                                    <td style="position: sticky; right: 0; background: white; z-index: 10;">
                                        <button class="btn btn-danger btn-delete-sp"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            `;

                            $("#product-table").append(newRow);
                            $("#thong-tin-san-pham").show();

                            // Tính exchange-price và total ban đầu
                            var productPrice = parseFloat(data.gia_von) || 0;
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

                            // Cập nhật tổng sau khi thêm sản phẩm mới
                            updateTotals();
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
        let exchangePriceTron = Math.round(exchangePrice)
        row.find(".exchange-price").text(
            exchangePriceTron.toLocaleString("vi-VN") + " đ"
        );
        row.find(".input-exchange-price").val(Math.round(exchangePriceTron));

        var quantity =
            parseInt(row.find('input[name="so_luong[]"]').val()) || 0;
        var total = quantity * exchangePriceTron;
        row.find(".total").text(total.toLocaleString("vi-VN") + " đ");
        row.find(".input-total").val(Math.round(total));

        // Cập nhật tổng sau khi thay đổi phụ phí
        updateTotals();
    });

    // Cập nhật exchange-price và total khi thay đổi số lượng
    $(document).on("input", 'input[name="so_luong[]"]', function () {
        var quantity = parseInt($(this).val()) || 0;
        var row = $(this).closest("tr");

        var exchangePriceElement = row.find(".exchange-price");
        var exchangePrice;

        // Kiểm tra xem exchange-price có được chỉnh sửa thủ công không
        if (
            exchangePriceElement.data("manually-edited") ||
            exchangePriceElement.attr("contenteditable")
        ) {
            // Lấy giá từ exchange-price hiện tại (đã được chỉnh sửa thủ công)
            var exchangePriceText = exchangePriceElement
                .text()
                .replace(/\D/g, "");
            exchangePrice = parseFloat(exchangePriceText) || 0;
        } else {
            // Tính toán exchange-price như bình thường
            var priceText = row
                .find(".product-price")
                .text()
                .replace(/\D/g, "");
            var originalPrice = parseFloat(priceText) || 0;
            var extraPrice =
                parseFloat(row.find(".extra-price-exchange").val()) || 0;

            if (extraPrice >= 1 && extraPrice <= 100) {
                exchangePrice = originalPrice * (1 + extraPrice / 100);
            } else {
                exchangePrice = originalPrice + extraPrice;
            }

            // Cập nhật exchange-price chỉ khi chưa được chỉnh sửa thủ công
            exchangePriceElement.text(
                exchangePrice.toLocaleString("vi-VN") + " đ"
            );
            row.find(".input-exchange-price").val(Math.round(exchangePrice));
        }

        // Luôn tính lại total dựa trên quantity và exchange-price hiện tại
        var total = quantity * exchangePrice;
        row.find(".total").text(total.toLocaleString("vi-VN") + " đ");
        row.find(".input-total").val(Math.round(total));

        // Cập nhật tổng sau khi thay đổi số lượng
        updateTotals();
    });

    // Xóa dòng sản phẩm
    $(document).on("click", ".btn-delete-sp", function () {
        $(this).closest("tr").remove();

        // Kiểm tra lại số dòng sau khi xóa
        if ($("#product-table tr").length === 0) {
            $("#thong-tin-san-pham").hide();
        }

        // Cập nhật tổng sau khi xóa sản phẩm
        updateTotals();
    });

    // Cập nhật tổng khi chỉnh sửa thủ công exchange-price
    $(document).on("input", ".exchange-price", function () {
        var row = $(this).closest("tr");
        var exchangePriceText = $(this).text().replace(/\D/g, "");
        var exchangePrice = parseFloat(exchangePriceText) || 0;
        
        // Đánh dấu là đã chỉnh sửa thủ công
        $(this).data("manually-edited", true);
        
        // Cập nhật input ẩn
        row.find(".input-exchange-price").val(Math.round(exchangePrice));
        
        // Tính lại total
        var quantity = parseInt(row.find('input[name="so_luong[]"]').val()) || 0;
        var total = quantity * exchangePrice;
        row.find(".total").text(total.toLocaleString("vi-VN") + " đ");
        row.find(".input-total").val(Math.round(total));

        // Cập nhật tổng
        updateTotals();
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
            var priceText = nextRow
                .find(".product-price")
                .text()
                .replace(/[^0-9]/g, "");
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

                nextRow
                    .find(".exchange-price")
                    .text(bidPrice.toLocaleString("vi-VN") + " đ");
                nextRow.find(".input-exchange-price").val(Math.round(bidPrice));

                // Lấy số lượng
                var quantity;

                var quantityElement = nextRow.find("#nt-soluong");

                // Kiểm tra xem là thẻ <td> hay <input>
                if (quantityElement.is("td")) {
                    quantity = parseInt(quantityElement.text()) || 1;
                } else if (quantityElement.is("input")) {
                    quantity = parseInt(quantityElement.val()) || 1;
                }
                var total = bidPrice * quantity;
                // Cập nhật tổng giá từng dòng
                nextRow
                    .find(".total")
                    .text(total.toLocaleString("vi-VN") + " đ");
                nextRow.find(".input-total").val(Math.round(total));

                // Cập nhật tổng tiền toàn bộ
                updateTotals();
            }
        }
    }
});
// document.getElementById('check-alls').addEventListener('change', function() {
//     var checkboxes = document.querySelectorAll('.row-checkboxs');
//     var isChecked = this.checked; // Lấy trạng thái checkbox "check-all"

//     checkboxes.forEach(function(checkbox) {
//         checkbox.checked = isChecked;
//         toggleStatus(checkbox);
//     });
// });
// // Lắng nghe sự kiện thay đổi của checkbox trong mỗi hàng
// document.querySelectorAll('.row-checkboxs').forEach(function(checkbox) {
//     checkbox.addEventListener('change', function() {
//         toggleStatus(checkbox);
//     });
// });
// function toggleStatus(checkbox) {
//     const label = checkbox.nextElementSibling;
//     if (!label) return;

//     if (checkbox.checked) {
//         label.textContent = "Trúng thầu";
//         checkbox.value = "datrung";
//     } else {
//         label.textContent = "Chưa trúng";
//         checkbox.value = "chuatrung";
//     }
// }
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
            var priceText = nextRow
                .find(".product-price")
                .text()
                .replace(/[^0-9]/g, "");
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
                nextRow
                    .find(".nt-giaduthau")
                    .text(bidPrice.toLocaleString("vi-VN") + " đ");
                nextRow.find(".input-giaduthau").val(Math.round(bidPrice));

                // Lấy số lượng
                var quantity =
                    parseInt(nextRow.find("#nt-soluong").text()) || 1;
                var total = bidPrice * quantity;

                // Cập nhật tổng giá từng dòng
                nextRow
                    .find(".total")
                    .text(total.toLocaleString("vi-VN") + " đ");
                nextRow.find(".input-total").val(Math.round(total));

                // Cập nhật tổng tiền toàn bộ
                updateTotals();
            }
        }
    }
});

// Script để xử lý checkbox và thêm sản phẩm vào modal
$(document).ready(function () {
    // Mảng lưu trữ các sản phẩm được chọn
    var selectedProducts = [];

    // Xử lý khi click vào checkbox đầu tiên (check all)
    $("#check-all").on("change", function () {
        var isChecked = $(this).prop("checked");

        // Chỉ check những checkbox của sản phẩm còn số lượng để giao
        $("#product-table tr, table tr").each(function () {
            var row = $(this);
            if (row.data("id")) {
                // Tìm cột số lượng còn lại trực tiếp từ UI
                var soLuongConLai = 0;

                // Thử đọc từ cột "SỐ LƯỢNG CÒN LẠI" nếu có
                if (row.find('td:contains("SỐ LƯỢNG CÒN LẠI")').length > 0) {
                    var colIndex = row
                        .find('td:contains("SỐ LƯỢNG CÒN LẠI")')
                        .index();
                    soLuongConLai =
                        parseInt(row.find("td").eq(colIndex).text().trim()) ||
                        0;
                } else {
                    // Tìm từ các cột có thể chứa số lượng còn lại
                    row.find("td").each(function () {
                        var cellText = $(this).text().trim();
                        // Nếu là cột số lượng còn lại
                        if (
                            $(this).is(".so-luong-con-lai") ||
                            $(this)
                                .closest("table")
                                .find("th, td")
                                .eq($(this).index())
                                .text()
                                .trim()
                                .toLowerCase()
                                .includes("còn lại")
                        ) {
                            soLuongConLai = parseInt(cellText) || 0;
                        }
                    });

                    // Nếu không tìm thấy, thử lấy từ data attribute
                    if (soLuongConLai === 0) {
                        soLuongConLai = parseInt(
                            row.find("td[data-remaining]").data("remaining") ||
                                row
                                    .find("td[data-quantity]")
                                    .data("remaining") ||
                                0
                        );
                    }
                }

                // Chỉ cho phép check các sản phẩm còn số lượng để giao
                if (soLuongConLai > 0) {
                    row.find(".row-checkbox").prop("checked", isChecked);

                    // Cập nhật danh sách sản phẩm được chọn
                    if (isChecked) {
                        var product = extractProductData(row);
                        if (
                            !isProductSelected(product.id) &&
                            product.so_luong_con_lai > 0
                        ) {
                            selectedProducts.push(product);
                        }
                    }
                } else {
                    // Không check các sản phẩm đã giao hết
                    row.find(".row-checkbox").prop("checked", false);
                }
            }
        });

        if (!isChecked) {
            // Bỏ chọn tất cả
            selectedProducts = [];
        }

        // Cập nhật danh sách sản phẩm trong modal
        updateModalProductList();
    });

    // Xử lý khi click vào các checkbox riêng lẻ
    $(document).on("change", ".row-checkbox", function () {
        var isChecked = $(this).prop("checked");
        var row = $(this).closest("tr");

        // Tìm cột số lượng còn lại trực tiếp từ UI
        var soLuongConLai = 0;

        // Nếu là trong bảng chính, tìm từ các cột
        row.find("td").each(function (index) {
            // Tìm cột "SỐ LƯỢNG CÒN LẠI" bằng text của header
            var headerText = $(this)
                .closest("table")
                .find("th, tr:first td")
                .eq(index)
                .text()
                .trim()
                .toLowerCase();
            if (headerText.includes("còn lại") || headerText === "sl còn lại") {
                soLuongConLai = parseInt($(this).text().trim()) || 0;
            }
        });

        // Nếu không tìm thấy, có thể sản phẩm được hiển thị ở định dạng khác
        if (soLuongConLai === 0) {
            // Lấy từ HTML trực tiếp nếu có trên UI
            var soLuongText = "";

            // Thử từ cột đặc biệt
            if (row.find(".so-luong-con-lai").length > 0) {
                soLuongText = row.find(".so-luong-con-lai").text().trim();
            }
            // Thử các cột chứa thuộc tính data
            else if (row.find("td[data-remaining]").length > 0) {
                soLuongText = row.find("td[data-remaining]").data("remaining");
            }
            // Dựa vào cấu trúc bảng hiện tại trong hình, cột 5 hoặc 6 có thể là số lượng còn lại
            else {
                // Trong ảnh của bạn, SL còn lại ở cột 6 (index 5)
                soLuongText = row.find("td:eq(5)").text().trim();
            }

            soLuongConLai = parseInt(soLuongText) || 0;
        }

        var product = extractProductData(row, soLuongConLai);

        // Kiểm tra lại một lần nữa từ dữ liệu đã trích xuất
        if (product.so_luong_con_lai <= 0 && isChecked) {
            alert(
                "Sản phẩm này đã giao hết số lượng, không thể thêm vào phiếu giao hàng"
            );
            $(this).prop("checked", false);
            return;
        }

        if (isChecked) {
            // Thêm sản phẩm vào danh sách đã chọn nếu chưa có và còn số lượng
            if (
                !isProductSelected(product.id) &&
                product.so_luong_con_lai > 0
            ) {
                selectedProducts.push(product);
            } else if (product.so_luong_con_lai <= 0) {
                // Nếu không còn số lượng, không cho chọn
                $(this).prop("checked", false);
            }
        } else {
            // Xóa sản phẩm khỏi danh sách đã chọn
            selectedProducts = selectedProducts.filter(function (item) {
                return item.id !== product.id;
            });

            // Bỏ check ở checkbox tổng nếu có bất kỳ checkbox nào bị bỏ chọn
            $("#check-all").prop("checked", false);
        }

        // Cập nhật danh sách sản phẩm trong modal
        updateModalProductList();
    });

    // Hàm trích xuất thông tin sản phẩm từ một dòng
    function extractProductData(row, forcedSoLuongConLai) {
        var soLuong = 0;
        var soLuongDaGiao = 0;
        var soLuongConLai = 0;
        var maPhan = "";
        var tenPhan = "";
        var dmhh = "";
        var groupId = ""; // Thêm biến để lưu group_id

        // Xác định vị trí của các cột dựa vào header
        var headerCells = row.closest("table").find("th, tr:first-child td");
        var colIndexes = {};

        headerCells.each(function (index) {
            var headerText = $(this).text().trim().toLowerCase();
            if (headerText.includes("mã") && headerText.includes("phân")) {
                colIndexes.maPhan = index;
            } else if (
                headerText.includes("tên") &&
                headerText.includes("phân")
            ) {
                colIndexes.tenPhan = index;
            } else if (
                headerText.includes("danh mục") ||
                headerText.includes("hàng hóa")
            ) {
                colIndexes.dmhh = index;
            } else if (headerText === "số lượng" || headerText === "sl") {
                colIndexes.soLuong = index;
            } else if (headerText.includes("đã giao")) {
                colIndexes.daGiao = index;
            } else if (headerText.includes("còn lại")) {
                colIndexes.conLai = index;
            } else if (
                headerText.includes("nhóm") ||
                headerText.includes("group")
            ) {
                colIndexes.groupId = index; // Thêm index cho cột group_id nếu có
            }
        });

        // Trích xuất dữ liệu từ các cột đã xác định
        if (colIndexes.maPhan !== undefined) {
            maPhan = row.find("td").eq(colIndexes.maPhan).text().trim();
        } else {
            maPhan =
                row.find("td[data-ma_phan]").data("ma_phan") ||
                row.find("td[data-ma_phan]").text().trim();
        }

        if (colIndexes.tenPhan !== undefined) {
            tenPhan = row.find("td").eq(colIndexes.tenPhan).text().trim();
        } else {
            tenPhan =
                row.find("td[data-ten_phan]").data("ten_phan") ||
                row.find("td[data-ten_phan]").text().trim();
        }

        if (colIndexes.dmhh !== undefined) {
            dmhh = row.find("td").eq(colIndexes.dmhh).text().trim();
        } else {
            dmhh =
                row
                    .find("td[data-product_name_bidder]")
                    .data("product_name_bidder") ||
                row.find("td[data-product_name_bidder]").text().trim();
        }

        if (colIndexes.soLuong !== undefined) {
            soLuong =
                parseInt(row.find("td").eq(colIndexes.soLuong).text().trim()) ||
                0;
        } else {
            soLuong =
                parseInt(
                    row.find("td[data-quantity]").data("quantity") ||
                        row.find("td[data-quantity]").text().trim()
                ) || 0;
        }

        if (colIndexes.daGiao !== undefined) {
            soLuongDaGiao =
                parseInt(row.find("td").eq(colIndexes.daGiao).text().trim()) ||
                0;
        } else {
            soLuongDaGiao =
                parseInt(
                    row.find("td[data-delivered]").data("delivered") ||
                        row.find("td[data-delivered]").text().trim()
                ) || 0;
        }

        // Thêm phần trích xuất group_id
        if (colIndexes.groupId !== undefined) {
            groupId = row.find("td").eq(colIndexes.groupId).text().trim();
        } else {
            groupId =
                row.find("td[data-group_id]").data("group_id") ||
                row.data("group_id") ||
                "";
        }

        // Nếu có số lượng còn lại được cưỡng chế từ bên ngoài
        if (forcedSoLuongConLai !== undefined) {
            soLuongConLai = forcedSoLuongConLai;
        } else if (colIndexes.conLai !== undefined) {
            soLuongConLai =
                parseInt(row.find("td").eq(colIndexes.conLai).text().trim()) ||
                0;
        } else {
            soLuongConLai =
                parseInt(
                    row.find("td[data-remaining]").data("remaining") ||
                        soLuong - soLuongDaGiao
                ) || soLuong;
        }

        // Điều chỉnh trong trường hợp dữ liệu thiếu hoặc không nhất quán
        if (soLuongDaGiao === 0 && soLuongConLai === 0 && soLuong > 0) {
            soLuongConLai = soLuong;
        }

        // Nếu tổng số lượng bằng số lượng đã giao, thì số lượng còn lại là 0
        if (soLuong > 0 && soLuong === soLuongDaGiao) {
            soLuongConLai = 0;
        }

        // Trường hợp đặc biệt - nếu row có chứa UI hiển thị "SL CÒN LẠI" với giá trị là 0
        var isZeroRemaining = false;
        row.find("td").each(function () {
            if (
                $(this).text().trim() === "0" &&
                $(this)
                    .closest("table")
                    .find("th, tr:first td")
                    .eq($(this).index())
                    .text()
                    .trim()
                    .toLowerCase()
                    .includes("còn lại")
            ) {
                isZeroRemaining = true;
            }
        });

        if (isZeroRemaining) {
            soLuongConLai = 0;
        }

        return {
            id: row.data("id") || maPhan, // Fallback nếu không có id
            ma_phan: maPhan,
            ten_phan: tenPhan,
            dmhh: dmhh,
            so_luong: soLuong,
            so_luong_da_giao: soLuongDaGiao,
            so_luong_giao: 0,
            so_luong_con_lai: soLuongConLai,
            group_id: groupId, // Thêm group_id vào đối tượng sản phẩm
        };
    }

    // Kiểm tra xem sản phẩm đã tồn tại trong danh sách chọn chưa
    function isProductSelected(id) {
        return selectedProducts.some(function (product) {
            return product.id === id;
        });
    }

    // Cập nhật danh sách sản phẩm trong modal
    function updateModalProductList() {
        var modalBody = $("#addRowModal").find("#product-table");
        modalBody.empty();

        // Lọc bỏ các sản phẩm không còn số lượng để giao
        selectedProducts = selectedProducts.filter(function (product) {
            return product.so_luong_con_lai > 0;
        });

        if (selectedProducts.length === 0) {
            modalBody.append(
                '<tr><td colspan="8" class="text-center">Không có dữ liệu</td></tr>'
            ); // Tăng colspan lên 8 vì thêm cột group_id
        } else {
            selectedProducts.forEach(function (product, index) {
                // Đảm bảo số lượng còn lại không âm
                if (product.so_luong_con_lai < 0) {
                    product.so_luong_con_lai = 0;
                }

                // Chỉ thêm sản phẩm nếu còn số lượng
                if (product.so_luong_con_lai > 0) {
                    var row = `
                        <tr data-id="${product.id}" data-group_id="${product.group_id}">
                            <td>${product.ma_phan}</td>
                            <td>${product.ten_phan}</td>
                            <td>${product.dmhh}</td>
                            <td>${product.so_luong}</td>
                            <td>
                                <input type="number" class="form-control so-luong-giao" 
                                       min="0" max="${product.so_luong_con_lai}" value="${product.so_luong_giao}"
                                       data-index="${index}" style="width:80px; margin:0 auto;">
                            </td>
                            <td class="so-luong-con-lai">${product.so_luong_con_lai}</td>
                            
                            <td>
                                <button class="btn btn-danger btn-sm remove-product" data-index="${index}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                    modalBody.append(row);
                }
            });

            // Xử lý khi thay đổi số lượng giao
            $(".so-luong-giao").on("input", function () {
                var index = $(this).data("index");
                var soLuongGiao = parseInt($(this).val()) || 0;
                var maxSoLuong = selectedProducts[index].so_luong_con_lai;

                // Đảm bảo số lượng giao không vượt quá số lượng còn lại
                if (soLuongGiao > maxSoLuong) {
                    soLuongGiao = maxSoLuong;
                    $(this).val(maxSoLuong);
                }

                // Cập nhật số lượng giao và số lượng còn lại trong modal
                selectedProducts[index].so_luong_giao = soLuongGiao;
                selectedProducts[index].so_luong_con_lai_moi =
                    maxSoLuong - soLuongGiao;

                // Cập nhật hiển thị số lượng còn lại
                $(this)
                    .closest("tr")
                    .find(".so-luong-con-lai")
                    .text(maxSoLuong - soLuongGiao);
            });

            // Xử lý khi nhấn nút xóa sản phẩm khỏi danh sách
            $(".remove-product").on("click", function () {
                var index = $(this).data("index");
                var productId = selectedProducts[index].id;
                selectedProducts.splice(index, 1);
                updateModalProductList();

                // Bỏ check ở checkbox tương ứng trên bảng chính
                $(`#product-table tr[data-id="${productId}"]`)
                    .find(".row-checkbox")
                    .prop("checked", false);
            });
        }
    }

    // Xử lý khi click vào nút "Tạo phiếu"
    $("#addRowButton").on("click", function () {
        if (selectedProducts.length === 0) {
            alert("Vui lòng chọn ít nhất một sản phẩm để tạo phiếu giao hàng");
            return;
        }

        // Kiểm tra xem đã nhập số lượng giao cho tất cả sản phẩm chưa
        var allValid = true;
        selectedProducts.forEach(function (product) {
            if (product.so_luong_giao <= 0) {
                allValid = false;
            }
        });

        if (!allValid) {
            alert("Vui lòng nhập số lượng giao hợp lệ cho tất cả sản phẩm");
            return;
        }

        // Tạo form mới và thêm dữ liệu sản phẩm vào form
        var form = $("<form></form>").attr({
            method: "POST",
            action: "/bid/update",
        });

        // Thêm các input ẩn chứa thông tin sản phẩm
        selectedProducts.forEach(function (product, index) {
            form.append(
                $("<input>").attr({
                    type: "hidden",
                    name: `products[${index}][id]`,
                    value: product.id,
                })
            );

            form.append(
                $("<input>").attr({
                    type: "hidden",
                    name: `products[${index}][ma_phan]`,
                    value: product.ma_phan,
                })
            );

            form.append(
                $("<input>").attr({
                    type: "hidden",
                    name: `products[${index}][ten_phan]`,
                    value: product.ten_phan,
                })
            );

            form.append(
                $("<input>").attr({
                    type: "hidden",
                    name: `products[${index}][dmhh]`,
                    value: product.dmhh,
                })
            );

            form.append(
                $("<input>").attr({
                    type: "hidden",
                    name: `products[${index}][so_luong]`,
                    value: product.so_luong,
                })
            );

            form.append(
                $("<input>").attr({
                    type: "hidden",
                    name: `products[${index}][so_luong_giao]`,
                    value: product.so_luong_giao,
                })
            );

            form.append(
                $("<input>").attr({
                    type: "hidden",
                    name: `products[${index}][so_luong_con_lai]`,
                    value: product.so_luong_con_lai_moi,
                })
            );

            // Thêm input ẩn chứa group_id
            form.append(
                $("<input>").attr({
                    type: "hidden",
                    name: `products[${index}][group_id]`,
                    value: product.group_id,
                })
            );
        });

        // Thêm CSRF token nếu cần
        form.append(
            $("<input>").attr({
                type: "hidden",
                name: "_token",
                value: $('meta[name="csrf-token"]').attr("content"),
            })
        );

        // Thêm form vào body và submit
        $("body").append(form);
        form.submit();
    });

    $("#addRowModal").on("hidden.bs.modal", function () {
        selectedProducts = [];
        $(".row-checkbox, #check-all").prop("checked", false);
        updateModalProductList();
    });
});

document.querySelectorAll(".clickable").forEach((td) => {
    td.addEventListener("click", function () {
        const url = this.closest("tr").getAttribute("data-url");
        if (url) {
            window.location.href = url;
        }
    });
});

$("#select-benh-vien-filter").on("change", function () {
    var selectedValue = $(this).val();
    var table = $("#add-row").DataTable();

    if (selectedValue) {
        table.search(selectedValue).draw();

        $(".dataTables_filter input").val("");
    } else {
        // Clear the filter
        table.search("").draw();
    }
});

var originalData = [];

$(document).ready(function () {
    var table = $("#add-row").DataTable();

    // Lưu dữ liệu gốc khi trang load
    table.rows().every(function () {
        originalData.push(this.data());
    });

    $("#created-at-filter").on("change", function () {
        var date = $(this).val();

        if (date) {
            $.ajax({
                url: "/get-group-by-date/" + date,
                type: "GET",
                success: function (data) {
                    table.clear();

                    if (data.length) {
                        data.forEach(function (group, index) {
                            let ngayDongThauFormatted = "";
                            if (group.ngay_dong_thau) {
                                const date = new Date(group.ngay_dong_thau);
                                ngayDongThauFormatted =
                                    String(date.getDate()).padStart(2, "0") +
                                    "/" +
                                    String(date.getMonth() + 1).padStart(
                                        2,
                                        "0"
                                    ) +
                                    "/" +
                                    date.getFullYear();
                            }
                            table.row.add([
                                index + 1,
                                group.name,
                                group.category_id,
                                group.category.name,
                                ngayDongThauFormatted,
                                group.user.name,
                                `<div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-sm btn-primary" title="Sửa">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" title="Xóa">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>`,
                            ]);
                        });
                    }

                    table.draw();
                },
            });
        } else {
            table.clear();
            originalData.forEach(function (row) {
                table.row.add(row);
            });
            table.draw();
        }
    });
});

const avatarInput = document.getElementById("avatar");
const previewContainer = document.getElementById("preview-container");
const previewImage = document.getElementById("preview");

avatarInput.addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewImage.style.maxWidth = "100%";
            previewImage.style.maxHeight = "100%";
            previewContainer.classList.remove("d-none");
        };
        reader.readAsDataURL(file);
    } else {
        previewImage.src = "";
        previewContainer.classList.add("d-none");
    }
});
// Script để tự động submit form khi thay đổi radio (tùy chọn)
const radioButtons = document.querySelectorAll(".status-radio");

radioButtons.forEach((radio) => {
    radio.addEventListener("change", function () {
        // Chỉ để demo - Bỏ comment dòng dưới nếu bạn muốn form tự submit
        // document.getElementById('statusForm').submit();

        console.log("Selected status:", this.value);
    });
});


