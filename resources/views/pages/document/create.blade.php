@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Thêm mới hồ sơ</h3>
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
                        <a href="#">Thêm mới hồ sơ</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('document.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Thêm mới hồ sơ</div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="city-document" class="form-label">Tỉnh/TP</label>
                                            <select name="" id="city-document" class="select2 form-control">
                                                <option value="" selected>Chọn tỉnh/tp</option>
                                                @foreach ($cities ?? [] as $city)
                                                    <option value="{{ $city['id'] }}">{{ $city['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="select-nha-thau">Bệnh viện</label>
                                            <select name="id_nhathau" id="select-nha-thau" class="select2 form-control">
                                                <option value="" selected>-- Chọn Bệnh viện --</option>
                                                {{-- @if (isset($categories))
                                                    @foreach ($categories as $k => $v)
                                                        <option value="{{ $v['code'] }}">{{ $v['name'] }}</option>
                                                    @endforeach
                                                @endif --}}
                                            </select>

                                            {{-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email
                                        with anyone
                                        else.</small> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="group">Gói thầu</label>
                                            <select name="group" id="group" class="select2 form-control">
                                                <option value="" selected>-- Chọn Gói thầu --</option>
                                                {{-- @if (isset($categories))
                                                    @foreach ($categories as $k => $v)
                                                        <option value="{{ $v['code'] }}">{{ $v['name'] }}</option>
                                                    @endforeach
                                                @endif --}}
                                            </select>

                                            {{-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email
                                        with anyone
                                        else.</small> --}}
                                        </div>
                                    </div>
                                    <div class="card-body pt-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="total-original">Tổng tiền ban đầu:</label>
                                                    <div id="total-original"
                                                        class="form-control-plaintext border rounded p-2 bg-light">0</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="total-bid">Tổng thành tiền:</label>
                                                    <div id="display-total-amount"
                                                        class="form-control-plaintext border rounded p-2 bg-light">0</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="total-profit">Lợi nhuận:</label>
                                                    <div id="total-profit"
                                                        class="form-control-plaintext border rounded p-2 bg-light">0</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12" id="thong-tin-nha-thau" style="display: none;">
                                        <div class="table-responsive">
                                            <table
                                                class="table table-bordered table-hover align-middle text-nowrap table-banle">
                                                <thead class="table-light text-center">
                                                    <tr>
                                                        <th style="min-width: 50px;">Mã nhà thầu</th>
                                                        <th style="min-width: 150px;">Tên nhà thầu</th>
                                                        <th style="min-width: 50px;">Mã phần (lô)</th>
                                                        <th style="min-width: 120px;">Tên phần</th>
                                                        <th style="min-width: 120px;">Danh mục hàng hóa</th>
                                                        <th style="min-width: 80px;">Số lượng</th>
                                                        <th style="min-width: 450px;">Tên thương mại</th>
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
                                                    <tr>
                                                        <td id="nt-ma"></td>
                                                        <td id="nt-ten"></td>
                                                        <td id="nt-maphan"></td>
                                                        <td id="nt-tenphan"></td>
                                                        <td id="nt-dmhh"></td>
                                                        <td id="nt-soluong"></td>
                                                        <td style="min-width: 160px;">
                                                            <select name="id_product" id="select-product" class="select2">
                                                                <option value="" selected disabled>Chọn mặt hàng
                                                                </option>
                                                                @if (isset($products))
                                                                    @foreach ($products as $k => $v)
                                                                        <option value="{{ $v['code'] }}">
                                                                            {{ $v['name'] }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </td>
                                                        <td id="product-quycach"></td>
                                                        <td id="product-brand"></td>
                                                        <td id="product-country"></td>
                                                        <td id="product-price"></td>
                                                        <td>
                                                            <input type="number" class="form-control border-primary qty-input"
                                                                title="Nhập giá chênh lệch" value=""
                                                                id="extra-price" name="extra_price">
                                                        </td>
                                                        <td id="nt-giaduthau"></td>
                                                        <input type="hidden" value="" id="input-giaduthau"
                                                            name="giaduthau">
                                                        <td id="total"></td>
                                                        <input type="hidden" value="" id="input-total"
                                                            name="thanhtien">
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-action">
                                <button class="btn btn-success">Thêm</button>
                                <a href="{{ route('document.index') }}" class="btn btn-danger">Hủy</a>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
