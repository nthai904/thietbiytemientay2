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
            <form action="" method="post">
                {{-- @csrf
                @method('PUT') --}}
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
                                                {{ number_format($totalTrung, 0, '.', '.') ?? 0 }} đ
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col custom-col">
                                        <div class="form-group">
                                            <label for="total-profit">Lợi nhuận:</label>
                                            <div id="total-profit"
                                                class="form-control-plaintext border rounded p-2 bg-light">
                                                {{ number_format($totalTrung - $total_orginal, 0, '.', '.') ?? 0 }} đ
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
                                            <table id="table-no-paging"
                                                class="table table-bordered table-hover align-middle text-nowrap">
                                                <thead class="table-light text-center">
                                                    <tr>
                                                        <th style="min-width: 40px;">
                                                            <input type="checkbox" id="check-all"
                                                                style="width:17px; height:17px">
                                                        </th>
                                                        <th style="min-width: 50px;">Mã bệnh viện</th>
                                                        <th style="min-width: 150px;">Tên bệnh viện</th>
                                                        <th style="min-width: 120px;">Mã phần (lô)</th>
                                                        <th style="min-width: 120px;">Tên phần</th>
                                                        <th style="min-width: 120px;">Danh mục hàng hóa</th>
                                                        <th style="min-width: 80px;">Số lượng</th>
                                                        {{-- <th style="min-width: 80px;">Số lượng đã giao</th>
                                                        <th style="min-width: 80px;">Số lượng còn lại</th> --}}
                                                        <th style="min-width: 360px;">Tên thương mại</th>
                                                        <th style="min-width: 120px;">Quy cách</th>
                                                        <th style="min-width: 120px;">Hãng sx</th>
                                                        <th style="min-width: 120px;">Nước sx</th>
                                                        <th style="min-width: 120px;">Giá</th>
                                                        <th style="min-width: 120px;">Giá đề xuất</th>
                                                        <th style="min-width: 120px;">Tăng trưởng giá</th>
                                                        <th style="min-width: 120px;">Giá dự thầu</th>
                                                        <th style="min-width: 120px;">Thành tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center" id="product-table">
                                                    @if (isset($documents) && count($documents) > 0)
                                                        @foreach ($documents as $k => $v)
                                                            <tr style="cursor: pointer;" data-id="{{ $v['id'] }}">
                                                                <td>
                                                                    <input type="checkbox" class="row-checkbox"
                                                                        style="width:17px; height:17px">
                                                                </td>
                                                                <td data-group_id="{{$v['group_id']}}">{{ $v['code_category_bidder'] }}</td>
                                                                <td>{{ $v->bidder->category->name }}</td>
                                                                <td data-ma_phan="{{ $v['ma_phan'] }}">{{ $v['ma_phan'] }}</td>
                                                                <td data-ten_phan="{{ $v['ten_phan'] }}">{{ $v['ten_phan'] }}</td>
                                                                <td data-product_name_bidder="{{ $v['product_name_bidder'] }}">{{ $v['product_name_bidder'] }}</td>
                                                                <td data-quantity="{{ $v['so_luong_con_lai'] ?? $v['quantity'] }}">{{ $v['quantity'] }}</td>
                                                                {{-- <td data-so_luong_da_giao="{{ $v['so_luong_da_giao'] ?? 0 }}">{{ $v['so_luong_da_giao'] ?? 0 }}</td>
                                                                <td>{{ $v['so_luong_con_lai'] ?? $v['quantity']}}</td> --}}
                                                                <td>
                                                                    {{ $v->product->name }}
                                                                </td>
                                                                <td>{{ $v['quy_cach'] }}</td>
                                                                <td>{{ $v['brand'] }}</td>
                                                                <td>{{ $v['country'] }}</td>
                                                                <td class="product-price">
                                                                    {{ number_format($v->product->gia_von) }} đ</td>
                                                                    <td class="product-giadexuat">
                                                                    {{ number_format($v->product->gia_de_xuat) }} đ</td>
                                                                <td class="text-center">
                                                                    @if (($v['extra_price'] >= 1 && $v['extra_price'] <= 100) || ($v['extra_price'] <= -1 && $v['extra_price'] >= -100))
                                                                        {{ $v['extra_price'] }}%
                                                                    @else
                                                                        {{ $v['extra_price'] }}đ
                                                                    @endif
                                                                </td>
                                                                <td>{{ number_format($v['price']) }} đ</td>
                                                                <td class="total">{{ number_format($v['total_price']) }} đ</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h3 class="modal-title">
                                                <span class="fw-mediumbold">Tạo phiếu giao hàng</span>
                                            </h3>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true" style="font-size: 38px">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-12" id="thong-tin-san-pham" style="">
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table table-bordered table-hover align-middle text-nowrap">
                                                                <thead class="table-light text-center">
                                                                    <tr>
                                                                        <th style="min-width: 100px;">Mã phần lô
                                                                        </th>
                                                                        <th style="min-width: 150px;">Tên phần lô
                                                                        </th>
                                                                        <th style="min-width: 120px;">Danh mục hàng hóa</th>
                                                                        <th style="min-width: 120px;">Số lượng</th>
                                                                        <th style="min-width: 120px;">SL giao</th>
                                                                        <th style="min-width: 80px;">SL còn lại</th>
                                                                        <th style="min-width: 120px;"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="text-center" id="product-table">
                                                                    <tr>
                                                                        <td colspan="7">Không có dữ liệu</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer border-0">
                                            {{-- <button type="button" id="addRowButton" class="btn btn-success">
                                                Tạo phiếu
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                Hủy
                                            </button> --}}
                                            <a href="{{route('document.bid')}}" class="btn btn-secondary">Quay lại</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                {{-- <button class="btn btn-success ms-auto" type="button" data-bs-toggle="modal"
                                    data-bs-target="#addRowModal">
                                    Tạo phiếu giao hàng
                                </button>
                                <a href="{{ route('document.bid') }}" class="btn btn-danger">Hủy</a> --}}
                                <a href="{{route('document.bid')}}" class="btn btn-secondary">Quay lại</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
