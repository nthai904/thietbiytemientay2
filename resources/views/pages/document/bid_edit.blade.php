@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Chi tiết trúng thầu</h3>
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
                        <a href="#">Chi tiết trúng thầu</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('document.update', ['code' => $documents[0]['code_category_bidder'], 'group' => $documents[0]['group']]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Chi tiết trúng thầu</div>
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
                                                {{ number_format(($totalAmount - $total_orginal), 0, '.', '.') ?? 0 }} đ
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col custom-col">
                                        <div class="form-group">
                                            <label for="total-profit">SL trúng thầu:</label>
                                            <div id="total-profit"
                                                class="form-control-plaintext border rounded p-2 bg-light">
                                                {{$rate ?? 0}}
                                                ({{$percent ?? 0}} %)
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col custom-col">
                                        <div class="form-group">
                                            <label for="total-profit">Tổng tiền trúng thầu:</label>
                                            <div id="total-profit"
                                                class="form-control-plaintext border rounded p-2 bg-light">
                                                {{ number_format(($totalTrung), 0, '.', '.') ?? 0 }} đ/ {{ number_format($totalAmount, 0, '.', '.') ?? 0 }} đ
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12" id="thong-tin-nha-thau">
                                        <div class="table-responsive">
                                            <table id="basic-datatables"
                                                class="table table-bordered table-hover align-middle text-nowrap">
                                                <thead class="table-light text-center">
                                                    <tr>
                                                        <th style="min-width: 40px;">
                                                            <input type="checkbox" id="check-all" style="width:17px; height:17px">
                                                        </th>
                                                        <th style="min-width: 50px;">Mã nhà thầu</th>
                                                        <th style="min-width: 150px;">Tên nhà thầu</th>
                                                        <th style="min-width: 120px;">Mã phần (lô)</th>
                                                        <th style="min-width: 120px;">Tên phần</th>
                                                        <th style="min-width: 120px;">Danh mục hàng hóa</th>
                                                        <th style="min-width: 80px;">Số lượng</th>
                                                        <th style="min-width: 360px;">Tên thương mại</th>
                                                        <th style="min-width: 120px;">Quy cách</th>
                                                        <th style="min-width: 120px;">Hãng sx</th>
                                                        <th style="min-width: 120px;">Nước sx</th>
                                                        <th style="min-width: 120px;">Giá</th>
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
                                                                    <input type="checkbox" class="row-checkbox"
                                                                        style="width:17px; height:17px">
                                                                </td>
                                                                <td id="nt-ma">{{ $v['code_category_bidder'] }}</td>
                                                                <td id="nt-ten">{{ $v->bidder->category->name }}</td>
                                                                <td id="nt-maphan">{{ $v['ma_phan'] }}</td>
                                                                <td id="nt-tenphan">{{ $v['ten_phan'] }}</td>
                                                                <td id="nt-dmhh">{{ $v['product_name_bidder'] }}</td>
                                                                <td id="nt-soluong">{{ $v['quantity'] }}</td>
                                                                <td>
                                                                    <select name="id_product[]"
                                                                        id="select-product{{ $v['id_product'] }}"
                                                                        class="select2">
                                                                        <option value="" disabled
                                                                            {{ empty($v['id_product']) ? 'selected' : '' }}>
                                                                            -- Chọn mặt hàng --</option>
                                                                        @if (isset($products))
                                                                            @foreach ($products as $product)
                                                                                <option value="{{ $product['code'] }}"
                                                                                    {{ $product['code'] == $v['id_product'] ? 'selected' : '' }}>
                                                                                    {{ $product['name'] }}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </td>
                                                                <td class="product-quycach">{{ $v['quy_cach'] }}</td>
                                                                <td class="product-brand">{{ $v['brand'] }}</td>
                                                                <td class="product-country">{{ $v['country'] }}</td>
                                                                <td class="product-price">
                                                                    {{ number_format($v->product->price) }} đ</td>
                                                                <td class="d-flex align-items-center">
                                                                    <input type="number"
                                                                        class="form-control border-primary extra-price"
                                                                        title="Nhập giá chênh lệch" name="extra_price[]"
                                                                        value="{{ $v['extra_price'] }}">
                                                                </td>

                                                                <td class="nt-giaduthau">{{ number_format($v['price']) }} đ
                                                                </td>
                                                                <input type="hidden" value="{{ $v['price'] }}"
                                                                    class="input-giaduthau" name="giaduthau[]">
                                                                <td class="total">{{ number_format($v['total_price']) }} đ
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
                            <div class="card-action">
                                <button class="btn btn-success">Cập nhật</button>
                                <a href="{{ route('document.bid') }}" class="btn btn-danger">Hủy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
