@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Chi tiết bán lẻ</h3>
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
                        <a href="#">Quản lý bán lẻ</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Chi tiết bán lẻ</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('exchange.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Chi tiết bán lẻ</div>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="select-exchange-product">Hàng hóa</label>
                                            <select name="id_product" id="select-exchange-product"
                                                class="select2 form-control">
                                                <option value="" selected>-- Chọn hàng hóa --</option>
                                                @if (isset($products))
                                                    @foreach ($products as $k => $v)
                                                        <option value="{{ $v['code'] }}">{{ $v['name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            {{-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email
                                        with anyone
                                        else.</small> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="thong-tin-san-pham">
                                        <div class="table-responsive">

                                            <div class="table-wrapper">
                                                <table
                                                    class="table table-bordered table-hover align-middle text-nowrap table-banle">
                                                    <thead class="table-light text-center">
                                                        <tr>
                                                            <th style="min-width: 50px;">STT</th>
                                                            <th style="min-width: 100px;">Mã sản phẩm</th>
                                                            <th style="min-width: 150px;">Tên sản phẩm</th>
                                                            <th style="min-width: 120px;">Quy cách</th>
                                                            <th style="min-width: 120px;">Hãng sx</th>
                                                            <th style="min-width: 120px;">Nước sx</th>
                                                            <th style="min-width: 80px;">Số lượng</th>
                                                            <th style="min-width: 120px;">Giá</th>
                                                            <th style="min-width: 120px;">Tăng trưởng giá</th>
                                                            <th style="min-width: 120px;">Giá bán ra</th>
                                                            <th style="min-width: 120px;">Thành tiền</th>
                                                            <th style="min-width: 120px;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center" id="product-table">
                                                        @if (isset($documents) && $documents->count() > 0)
                                                            @foreach ($documents as $k => $v)
                                                                <tr>
                                                                    <td>{{ $k+1 }}</td>
                                                                    <td class="product-code">{{ $v->id_product }}</td>
                                                                    <td class="product-name">{{ $v->product_name }}</td>
                                                                    <td class="product-quycach">{{ $v->quy_cach }}</td>
                                                                    <td class="product-brand">{{ $v->brand }}</td>
                                                                    <td class="product-country">{{ $v->country }}</td>
                                                                    <td><input type="number"
                                                                            class="form-control border-primary product-quantity"
                                                                            name="so_luong[]" value="{{ $v->quantity }}"></td>
                                                                        <td class="product-price">{{ number_format($v->product->price, 0, ',', '.') }} đ</td>
                                                                    <td><input type="number"
                                                                            class="form-control border-primary extra-price-exchange qty-input"
                                                                            name="extra_price[]" value="{{ $v->extra_price }}"
                                                                            data-bs-toggle="tooltip"
                                                                            title="Nhấn Ctrl + D để coppy công thức"></td>
                                                                    <td class="exchange-price">{{ number_format($v->price, 0, ',', '.') }} đ</td>
                                                                    <input type="hidden" name="exchange_price[]"
                                                                        class="input-exchange-price" value="">
                                                                    <td class="total">{{ number_format($v->total_price, 0, ',', '.') }} đ</td>
                                                                    <input type="hidden" name="thanhtien[]"
                                                                        class="input-total" value="">
                                                                    <input type="hidden" name="id_products[]"
                                                                        value="USB OO214">
                                                                    <td>
                                                                        <button class="btn btn-danger"><i
                                                                                class="fas fa-trash-alt"></i></button>
                                                                    </td>
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
