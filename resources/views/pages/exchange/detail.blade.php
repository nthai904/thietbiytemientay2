@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Chi tiết báo giá</h3>
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
                        <a href="#">Chi tiết báo giá</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('exchange.update', ['date' => $date]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Chi tiết báo giá </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="select-exchange-product">Tỉnh/tp</label>
                                            <select class="select2 form-control no-click" tabindex="-1">
                                                <option value="" selected>{{ $city }}</option>
                                            </select>
                                            {{-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email
                                        with anyone
                                        else.</small> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="select-exchange-product">Bệnh viện</label>
                                            <select name="id_nhathau" class="select2 form-control no-click" tabindex="-1">
                                                <option value="{{ $id_nhathau }}" selected>{{ $name }}</option>
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
                                    <div class="col-md-12" id="thong-tin-san-pham">
                                        <div class="table-responsive">

                                            <div class="table-wrapper">
                                                <table
                                                    class="table table-bordered table-hover align-middle text-nowrap table-banle">
                                                    <thead class="table-light text-center">
                                                        <tr>
                                                            <th style="min-width: 50px;">STT</th>
                                                            <th style="min-width: 100px;">Mã sản phẩm</th>
                                                            <th style="min-width: 150px;">Danh mục hàng hóa</th>
                                                            <th style="min-width: 400px;">Tên thương mại</th>
                                                            <th style="min-width: 500px;">Thông số kỹ thuật</th>
                                                            <th style="min-width: 200px;">Quy cách</th>
                                                            <th style="min-width: 200px;">Hãng sx</th>
                                                            <th style="min-width: 200px;">Nước sx</th>
                                                            <th style="min-width: 80px;">Số lượng</th>
                                                            <th style="min-width: 120px;">Giá</th>
                                                            {{-- <th style="min-width: 120px;">Giá đề xuất</th> --}}
                                                            <th style="min-width: 120px;">Tăng trưởng giá</th>
                                                            <th style="min-width: 120px;">Giá bán ra</th>
                                                            <th style="min-width: 120px;">Thành tiền</th>
                                                            <th
                                                                style="min-width: 120px;position: sticky; right: 0; z-index: 20;">
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center" id="product-table">
                                                        @if (isset($documents) && $documents->count() > 0)
                                                            @foreach ($documents as $k => $v)
                                                                @if ($v->status === 'bannhap')
                                                                    <tr class="{{ $v->extra_price < 0 ? 'bg-red' : '' }}">
                                                                        <td>{{ $k + 1 }}</td>
                                                                        <td class="product-kymahieu"><input type="text"
                                                                                name="ky_ma_hieu[]" class="input-full-td" value="{{$v->id_product}}">
                                                                        </td>
                                                                        <td class="product-code">
                                                                            {{ $v->product_name_bidder }}
                                                                        </td>
                                                                        <td>
                                                                            <select name="id_product[]"
                                                                                class="select2 select-product"
                                                                                style="width: 100%">
                                                                                <option value="" selected disabled>
                                                                                    Chọn mặt hàng</option>
                                                                                @if (isset($products))
                                                                                    @foreach ($products as $i => $p)
                                                                                        <option
                                                                                            value="{{ $p['ky_ma_hieu'] }}"
                                                                                            {{ isset($v) && $v->id_product == $p['ky_ma_hieu'] ? 'selected' : '' }}>
                                                                                            {{ $p['name'] }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                        </td>
                                                                        <td class="product-thongsokythuatcoban">
                                                                            <textarea name="thong_so_ky_thuat_co_ban[]" rows="3" class="form-control">{{ $v->thong_so_ky_thuat_co_ban }}</textarea>
                                                                        </td>
                                                                        <td class="product-quycach"><input type="text"
                                                                                name="quy_cach[]" class="input-full-td" value="{{$v->quy_cach}}">
                                                                        </td>
                                                                        <td class="product-hangsx"><input type="text"
                                                                                name="hang_sx[]" class="input-full-td" value="{{$v->brand}}"></td>
                                                                        <td class="product-nuocsx"><input type="text"
                                                                                name="nuoc_sx[]" class="input-full-td" value="{{$v->country}}">
                                                                        </td>
                                                                        <td><input type="number"
                                                                                class="form-control border-primary product-quantity"
                                                                                name="so_luong[]" value="{{$v->quantity ?? 1}}"
                                                                                id="nt-soluong">
                                                                        </td>
                                                                        <td class="product-price">
                                                                            @if (isset($v->product->gia_von) && $v->product->gia_von)
                                                                                {{ number_format($v->product->gia_von, 0, ',', '.') }}
                                                                                đ
                                                                            @endif
                                                                        </td>
                                                                        {{-- <td class="product-giadexuat">
                                                                            @if (isset($v->product->gia_von) && $v->product->gia_von)
                                                                                {{ number_format($v->product->gia_von, 0, ',', '.') }}
                                                                                đ
                                                                            @endif
                                                                        </td> --}}
                                                                        <td><input type="number"
                                                                                class="form-control border-primary extra-price-exchange qty-input"
                                                                                name="extra_price[]"
                                                                                value="{{ $v->extra_price }}"
                                                                                data-bs-toggle="tooltip"
                                                                                title="Nhấn Ctrl + D để coppy công thức">
                                                                        </td>
                                                                        <td class="exchange-price nt-giaduthau"
                                                                            contenteditable="true">
                                                                            @if (isset($v->price) && $v->price)
                                                                                {{ number_format($v->price, 0, ',', '.') }}
                                                                                đ
                                                                            @endif
                                                                        </td>
                                                                        <input type="hidden" name="exchange_price[]"
                                                                            class="input-exchange-price"
                                                                            value="{{ $v->price }}">
                                                                        <td class="total">
                                                                            @if (isset($v->total_price) && $v->total_price)
                                                                                {{ number_format($v->total_price, 0, ',', '.') }}
                                                                                đ
                                                                            @endif
                                                                        </td>
                                                                        <input type="hidden" name="thanhtien[]"
                                                                            class="input-total"
                                                                            value="{{ $v->total_price }}">
                                                                        <input type="hidden" name="id_products[]"
                                                                            value="{{ $v->id_product }}">
                                                                        <td
                                                                            style="position: sticky; right: 0; background: white; z-index: 10;">
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-delete-baogia">
                                                                                <i class="fas fa-trash-alt"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @else
                                                                    <tr class="{{ $v->extra_price < 0 ? 'bg-red' : '' }}">
                                                                        <td>{{ $k + 1 }}</td>
                                                                        <td class="product-code">{{ $v->id_product }}</td>
                                                                        <td class="product-code">
                                                                            {{ $v->product_name_bidder }}
                                                                        </td>
                                                                        <td class="product-name">{{ $v->product_name }}
                                                                        </td>
                                                                        <td class="product-thongsokythuatcoban">
                                                                            <textarea name="thong_so_ky_thuat_co_ban[]" rows="3" class="form-control">{{ $v->thong_so_ky_thuat_co_ban }}</textarea>
                                                                        </td>
                                                                        <td class="product-quycach">{{ $v->quy_cach }}
                                                                        </td>
                                                                        <td class="product-brand">{{ $v->brand }}</td>
                                                                        <td class="product-country">{{ $v->country }}
                                                                        </td>
                                                                        <td><input type="number"
                                                                                class="form-control border-primary product-quantity"
                                                                                name="so_luong[]"
                                                                                value="{{ $v->quantity }}"
                                                                                id="nt-soluong">
                                                                        </td>
                                                                        <td class="product-price">
                                                                            @if (isset($v->product->gia_von) && $v->product->gia_von)
                                                                                {{ number_format($v->product->gia_von, 0, ',', '.') }}
                                                                                đ
                                                                            @endif
                                                                        </td>
                                                                        {{-- <td class="product-giadexuat">
                                                                            @if (isset($v->product->gia_de_xuat) && $v->product->gia_de_xuat)
                                                                                {{ number_format($v->product->gia_de_xuat, 0, ',', '.') }}
                                                                                đ
                                                                            @endif
                                                                        </td> --}}
                                                                        <td><input type="number"
                                                                                class="form-control border-primary extra-price-exchange qty-input"
                                                                                name="extra_price[]"
                                                                                value="{{ $v->extra_price }}"
                                                                                data-bs-toggle="tooltip"
                                                                                title="Nhấn Ctrl + D để coppy công thức">
                                                                        </td>
                                                                        <td class="exchange-price">
                                                                            @if (isset($v->price) && $v->price)
                                                                                {{ number_format($v->price, 0, ',', '.') }}
                                                                                đ
                                                                            @endif
                                                                        </td>
                                                                        <input type="hidden" name="exchange_price[]"
                                                                            class="input-exchange-price"
                                                                            value="{{ $v->price }}">
                                                                        <td class="total">
                                                                            @if (isset($v->total_price) && $v->total_price)
                                                                                {{ number_format($v->total_price, 0, ',', '.') }}
                                                                                đ
                                                                            @endif
                                                                        </td>
                                                                        <input type="hidden" name="thanhtien[]"
                                                                            class="input-total"
                                                                            value="{{ $v->total_price }}">
                                                                        <input type="hidden" name="id_products[]"
                                                                            value="{{ $v->id_product }}">
                                                                        <td
                                                                            style="position: sticky; right: 0; background: white; z-index: 10;">
                                                                            <button
                                                                                class="btn btn-danger btn-delete-baogia"><i
                                                                                    class="fas fa-trash-alt"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endif
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
                                <a href="{{ route('exchange.index') }}" class="btn btn-danger">Hủy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
