@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Thêm mới báo giá</h3>
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
                        <a href="#">Quản lý báo giá</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Thêm mới báo giá</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('exchange.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="card-title">Thêm mới báo giá</div>
                                <input type="file" name="file" accept=".xlsx,.xls,.csv" class="form-control d-none"
                                    id="fileInput" />
                                <button type="button" class="btn btn-primary ms-2 btn-addnew" id="importButton" disabled>
                                    <i class="fa fa-file-import me-2"></i>
                                    Import
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="city-exchange" class="form-label">Tỉnh/TP</label>
                                            <select name="" id="city-exchange" class="select2 form-control">
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
                                            <label for="select-benh-vien">Bệnh viện</label>
                                            <select name="id_nhathau" id="select-benh-vien"
                                                class="select2 form-control required-hospital" required>
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
                                            <label for="select-exchange-product">Hàng hóa</label>
                                            <select name="id_product" id="select-exchange-product"
                                                class="select2 form-control">
                                                <option value="" selected>-- Chọn hàng hóa --</option>
                                                @if (isset($products))
                                                    @foreach ($products as $k => $v)
                                                        <option value="{{ $v['ky_ma_hieu'] }}">{{ $v['name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            {{-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email
                                        with anyone
                                        else.</small> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="thong-tin-san-pham" style="display: none;">
                                        <div class="table-responsive">

                                            <div class="table-wrapper">
                                                <table
                                                    class="table table-bordered table-hover align-middle text-nowrap table-banle">
                                                    <thead class="table-light text-center">
                                                        <tr>
                                                            <th style="min-width: 50px;">STT</th>
                                                            <th style="min-width: 100px;">Mã sản phẩm</th>
                                                            <th style="min-width: 100px;">Danh mục hàng hóa</th>
                                                            <th style="min-width: 150px;">Tên thương mại</th>
                                                            <th style="min-width: 500px;">Thông số kỹ thuật</th>
                                                            <th style="min-width: 200px;">Quy cách</th>
                                                            <th style="min-width: 200px;">Hãng sx</th>
                                                            <th style="min-width: 200px;">Nước sx</th>
                                                            <th style="min-width: 80px;">Số lượng</th>
                                                            <th style="min-width: 120px;">Giá</th>
                                                            <th style="min-width: 120px;">Tăng trưởng giá</th>
                                                            <th style="min-width: 120px;">Giá bán ra</th>
                                                            <th style="min-width: 120px;">Thành tiền</th>
                                                            <th style="min-width: 120px;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot class="table-light text-center">
                                                        <tr>
                                                            <td colspan="8" class="text-end fw-bold">Tổng cộng:</td>
                                                            <td id="total-quantity">0</td>
                                                            <td colspan="3"></td>
                                                            <td id="total-amount">0</td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody class="text-center" id="product-table">
                                                        <!-- Dữ liệu sản phẩm sẽ được render ở đây -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success">Thêm</button>
                                <a href="{{ route('exchange.index') }}" class="btn btn-danger">Hủy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@push('scripts')
@endpush
