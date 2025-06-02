@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Cập nhật hồ sơ</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Quản lý hồ sơ</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Cập nhật hồ sơ</a>
                    </li>
                </ul>
            </div>
            <form
                action="{{ route('document.update', ['code' => $documents[0]['code_category_bidder'], 'group' => $documents[0]['group_id']]) }}"
                method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Cập nhật hồ sơ</div>
                            </div>
                            <div class="card-body pt-4">
                                <div class="row">
                                    <div class="col custom-col">
                                        <div class="form-group">
                                            <label for="total-original">Tổng tiền ban đầu:</label>
                                            <div id="total-original"
                                                class="form-control-plaintext border rounded p-2 bg-light">
                                                {{ number_format($total_orginal, 0, '.', '.') ?? 0 }} đ
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col custom-col">
                                        <div class="form-group">
                                            <label for="total-bid">Tổng thành tiền:</label>
                                            <div id="display-total-amount"
                                                class="form-control-plaintext border rounded p-2 bg-light">
                                                {{ number_format($totalAmount, 0, '.', '.') ?? 0 }} đ
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col custom-col">
                                        <div class="form-group">
                                            <label for="total-profit">Lợi nhuận:</label>
                                            <div id="total-profit"
                                                class="form-control-plaintext border rounded p-2 bg-light">
                                                {{ number_format($totalAmount - $total_orginal, 0, '.', '.') ?? 0 }} đ
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col custom-col">
                                        <div class="form-group">
                                            <label for="total-profit">SL trúng thầu:</label>
                                            <div id="total-profit"
                                                class="form-control-plaintext border rounded p-2 bg-light">
                                                {{ $rate ?? 0 }}
                                                ({{ $percent ?? 0 }} %)
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col custom-col">
                                        <div class="form-group">
                                            <label for="total-profit">Tổng tiền trúng thầu:</label>
                                            <div id="total-profit"
                                                class="form-control-plaintext border rounded p-2 bg-light">
                                                {{ number_format($totalTrung, 0, '.', '.') ?? 0 }} đ/
                                                {{ number_format($totalAmount, 0, '.', '.') ?? 0 }} đ
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12" id="thong-tin-nha-thau">
                                        <div class="table-responsive">
                                            <div class="table-wrapper border-0">
                                                <table id="add-row-bid"
                                                    class="table table-bordered table-banle table-hover align-middle text-nowrap">
                                                    <thead class="table-light text-center">
                                                        <tr>
                                                            <th style="min-width: 40px;">
                                                                <label class="status-wrapper">
                                                                    <input type="checkbox" class="checkbox-toggle"
                                                                        id="check-all">
                                                                    <span class="status-label">Tất cả</span>
                                                                </label>
                                                            </th>
                                                            <th style="min-width: 50px;">Mã bệnh viện</th>
                                                            <th style="min-width: 150px;">Tên bệnh viện</th>
                                                            <th style="min-width: 50px;">Mã phần (lô)</th>
                                                            <th style="min-width: 120px;">Tên phần</th>
                                                            <th style="min-width: 120px;" class="position-sticky-left">Danh mục hàng hóa</th>
                                                            <th style="min-width: 80px;">Số lượng</th>
                                                            <th style="min-width: 450px;">Tên thương mại</th>
                                                            <th style="min-width: 200px;">Ký mã hiệu</th>
                                                            <th style="min-width: 500px;">Đặc tính thông số kỹ thuật cơ bản
                                                            </th>
                                                            <th style="min-width: 500px;">Đặc tính thông số kỹ thuật thầu
                                                            </th>
                                                            <th style="min-width: 120px;">Hãng sản xuất</th>
                                                            <th style="min-width: 120px;">Nước sản xuất</th>
                                                            <th style="min-width: 120px;">Hãng/ Nước chủ sở hữu</th>
                                                            <th style="min-width: 120px;">Quy cách đóng gói</th>
                                                            <th style="min-width: 120px;">Đơn vị tính</th>
                                                            <th style="min-width: 120px;">Hạn sử dụng</th>
                                                            <th style="min-width: 300px;">Tên NCC</th>
                                                            <th style="min-width: 120px;">Mã VTYT dùng chung Quyết định 5086
                                                            </th>
                                                            <th style="min-width: 120px;">Nhóm theo TT
                                                                04/2017/TT-BYT</th>
                                                            <th style="min-width: 120px;">Phân loại TTBYT theo
                                                                TT39/2016/TT-BYT
                                                            </th>
                                                            <th style="min-width: 120px;">Số đăng ký lưu hành/Số GPNK</th>
                                                            <th style="min-width: 120px;">Số bảng phân loại</th>
                                                            <th style="min-width: 500px;">Ghi chú</th>
                                                            <th style="min-width: 120px;">Giá vốn</th>
                                                            <th style="min-width: 120px;">Giá đề xuất</th>
                                                            <th style="min-width: 120px;">Tăng trưởng giá</th>
                                                            <th style="min-width: 120px;">Giá dự thầu</th>
                                                            <th style="min-width: 120px;">Thành tiền</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center" id="product-table">
                                                        @if (isset($documents) && count($documents) > 0)
                                                            @foreach ($documents as $k => $v)
                                                                <tr style="cursor: pointer;">
                                                                    <td>
                                                                        <label class="status-wrapper">
                                                                            <span class="status-value"
                                                                                style="display:none">{{ $v->status }}</span>
                                                                            <input type="hidden"
                                                                                name="status[{{ $k }}]"
                                                                                value="chuatrung">
                                                                            <input type="checkbox"
                                                                                class="checkbox-toggle row-checkbox"
                                                                                onchange="toggleStatus(this)"
                                                                                name="status[{{ $k }}]"
                                                                                value="datrung"
                                                                                {{ $v->status == 'datrung' ? 'checked' : '' }}>
                                                                            <span class="status-label">Trúng thầu</span>
                                                                        </label>
                                                                    </td>
                                                                    <td id="nt-ma">{{ $v['code_category_bidder'] }}
                                                                    </td>
                                                                    <td id="nt-ten">{{ $v->bidder->category->name }}
                                                                    </td>
                                                                    <td id="nt-maphan">{{ $v['ma_phan'] }}</td>
                                                                    <td id="nt-tenphan">{{ $v['ten_phan'] }}</td>
                                                                    <td id="nt-dmhh" class="position-sticky-left">{{ $v['product_name_bidder'] }}
                                                                    </td>
                                                                    <td id="nt-soluong">{{ $v['quantity'] }}</td>
                                                                    <td>
                                                                        <select name="id_product[]"
                                                                            id="{{ $v['id'] }}"
                                                                            class="select2 select-product">
                                                                            <option value="" disabled
                                                                                {{ empty($v['id_product']) ? 'selected' : '' }}>
                                                                                -- Chọn mặt hàng --</option>
                                                                            @if (isset($products))
                                                                                @foreach ($products as $product)
                                                                                    <option
                                                                                        value="{{ $product['ky_ma_hieu'] }}"
                                                                                        {{ $product['ky_ma_hieu'] == $v['id_product'] ? 'selected' : '' }}>
                                                                                        {{ $product['name'] }}
                                                                                    </option>
                                                                                @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </td>
                                                                    <td class="product-kymahieu"><input type="text"
                                                                            name="ky_ma_hieu[]" class="input-full-td"
                                                                            value="{{ $v->id_product }}"></td>
                                                                    <td class="product-thongsokythuatcoban">
                                                                        <textarea name="thong_so_ky_thuat_co_ban[]" rows="3" class="form-control">{{ $v->thong_so_ky_thuat_co_ban ?? '' }}</textarea>
                                                                    </td>
                                                                    <td class="product-thongsokythuatthau">
                                                                        <textarea name="thong_so_ky_thuat_thau[]" rows="3" class="form-control">{{ $v->thong_so_ky_thuat_thau }}</textarea>
                                                                    </td>
                                                                    <td class="product-hangsx">
                                                                        <input type="text" name="hang_sx[]"
                                                                            class="input-full-td"
                                                                            value="{{ $v->brand }}">
                                                                    </td>
                                                                    <td class="product-nuocsx">
                                                                        <input type="text" name="nuoc_sx[]"
                                                                            class="input-full-td"
                                                                            value="{{ $v->country }}">
                                                                    </td>
                                                                    <td class="product-hangnuocchusohuu">
                                                                        <input type="text"
                                                                            name="hang_nuoc_chu_so_huu[]"
                                                                            class="input-full-td"
                                                                            value="{{ $v->hang_nuoc_chu_so_huu }}">
                                                                    </td>
                                                                    <td class="product-quycach">
                                                                        <input type="text" name="quy_cach[]"
                                                                            class="input-full-td"
                                                                            value="{{ $v->quy_cach }}">
                                                                    </td>
                                                                    <td class="product-donvitinh">
                                                                        <input type="text" name="unit[]"
                                                                            class="input-full-td"
                                                                            value="{{ $v->unit }}">
                                                                    </td>
                                                                    <td class="product-hsd">
                                                                        <input type="text" name="hsd[]"
                                                                            class="input-full-td"
                                                                            value="{{ \Carbon\Carbon::parse($v->hsd)->format('d/m/Y') }}">
                                                                    </td>
                                                                    <td class="product-tenncc">
                                                                        <input type="text" name="ten_ncc[]"
                                                                            class="input-full-td"
                                                                            value="{{ $v->ten_ncc }}">
                                                                    </td>
                                                                    <td class="product-mavtyt">
                                                                        <input type="text" name="ma_vtyt[]"
                                                                            class="input-full-td"
                                                                            value="{{ $v->ma_vtyt }}">
                                                                    </td>
                                                                    <td class="product-nhomtheott">
                                                                        <input type="text" name="nhom_theo_tt[]"
                                                                            class="input-full-td"
                                                                            value="{{ $v->nhom_theo_tt }}">
                                                                    </td>
                                                                    <td class="product-phanloaittbyt">
                                                                        <input type="text" name="phan_loai_ttbyt[]"
                                                                            class="input-full-td"
                                                                            value="{{ $v->phan_loai_ttbyt }}">
                                                                    </td>
                                                                    <td class="product-sodangkyluuhanh">
                                                                        <input type="text" name="so_dang_ky_luu_hanh[]"
                                                                            class="input-full-td"
                                                                            value="{{ $v->so_dang_ky_luu_hanh }}">
                                                                    </td>
                                                                    <td class="product-sobangphanloai">
                                                                        <input type="text" name="so_bang_phan_loai[]"
                                                                            class="input-full-td"
                                                                            value="{{ $v->so_bang_phan_loai }}">
                                                                    </td>
                                                                    <td class="product-ghichu">
                                                                        <textarea name="ghichu[]" rows="3" class="form-control">{{ $v->ghichu }}</textarea>
                                                                    </td>
                                                                    <td class="product-price">
                                                                        {{ number_format($v->product->gia_von ?? 0, 0, ',', '.') }}
                                                                        đ
                                                                    </td>
                                                                    <td class="product-giadexuat">
                                                                        {{ number_format($v->product->gia_von ?? 0, 0, ',', '.') }}
                                                                        đ
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" step="any"
                                                                            class="form-control border-primary extra-price qty-input-document"
                                                                            title="Nhập giá chênh lệch"
                                                                            name="extra_price[]"
                                                                            value="{{ $v['extra_price'] != 0 ? $v['extra_price'] : '' }}">
                                                                    </td>
                                                                    <td class="nt-giaduthau" contenteditable="true">
                                                                        {{ number_format($v['price'], 0, ',', '.') }} đ
                                                                    </td>
                                                                    <input type="hidden" value="{{ $v['price'] }}"
                                                                        class="input-giaduthau" name="giaduthau[]">
                                                                    <td class="total">
                                                                        {{ number_format($v['total_price'], 0, ',', '.') }}
                                                                        đ
                                                                    </td>
                                                                    <input type="hidden" value="{{ $v['total_price'] }}"
                                                                        class="input-total" name="thanhtien[]">
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-action">
                                <button class="btn btn-success">Cập nhật</button>
                                <a href="{{ route('document.index') }}" class="btn btn-danger">Hủy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
