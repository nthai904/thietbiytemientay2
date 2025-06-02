@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Chi tiết đấu thầu</h3>
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
                        <a href="#">Quản lý bệnh viện</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Chi tiết đấu thầu</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('document.storeBanNhap') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Chi tiết đấu thầu</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if (isset($bidder) && $bidder->count())
                                        @foreach ($bidder as $maDauThau => $group)
                                            {{-- Thông tin nhà thầu --}}
                                            @php
                                                $first = $group->first();
                                            @endphp
                                            
                                            <div class="col-12">
                                                <div class="card shadow-sm mb-4">
                                                    <div class="card-header bg-den text-white d-flex justify-content-between align-items-center"
                                                        style="cursor: pointer;" data-bs-toggle="collapse"
                                                        data-bs-target="#thong-tin-nha-thau" aria-expanded="true"
                                                        aria-controls="thong-tin-nha-thau">
                                                        <strong>Thông tin nhà thầu</strong>
                                                        {{-- <i class="fa fa-chevron-down"></i> --}}
                                                    </div>
                                                    <div class="collapse show" id="thong-tin-nha-thau">
                                                        <div class="card-body">
                                                            <div class="row g-3">
                                                                <div class="col-md-4">
                                                                    <label for="city" class="form-label">Tỉnh/TP</label>
                                                                    <select name="city" id="city"
                                                                        class="select2 form-control no-click"
                                                                        tabindex="-1">
                                                                        <option value="{{$first->category->city}}" selected>
                                                                            @if ($cities->count())
                                                                                @foreach ($cities as $city)
                                                                                    @if ($first->category->city == $city->id)
                                                                                        {{ $city->name ?? '' }}
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="category_id" class="form-label">Bệnh
                                                                        viện</label>
                                                                    <select name="id_nhathau" id="category_id"
                                                                        class="select2 form-control no-click"
                                                                        tabindex="-1">
                                                                        <option value="{{ $first->category->code ?? '' }}" selected>
                                                                            {{ $first->category->name ?? '' }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="group" class="form-label">Gói
                                                                        thầu</label>
                                                                    <select name="group" id="group"
                                                                        class="select2 form-control no-click"
                                                                        tabindex="-1">
                                                                        <option value="{{ $first->group->id ?? '' }}" selected>
                                                                            {{ $first->group->name ?? '' }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            {{-- Chi tiết --}}
                                            <div class="col-12">
                                                <div class="card shadow-sm mb-4">
                                                    <div class="card-header bg-den text-white d-flex justify-content-between align-items-center"
                                                        style="cursor: pointer;">
                                                        <strong>Chi tiết</strong>
                                                        {{-- <i class="fa fa-chevron-down"></i> --}}
                                                        <button class="btn btn-primary">Thêm mới phụ lục</button>
                                                    </div>

                                                    <div class="table-responsive">

                                                        <div class="table-wrapper">
                                                            <table
                                                                class="table table-bordered table-hover align-middle text-nowrap mb-0">
                                                                <thead class="table-light text-center">
                                                                    <tr>
                                                                        <th style="min-width: 50px;">STT</th>
                                                                        <th style="min-width: 100px;">Mã phần (lô)</th>
                                                                        <th style="min-width: 150px;">Tên phần (lô)</th>
                                                                        <th style="min-width: 120px;">Danh mục hàng hóa</th>
                                                                        <th style="min-width: 120px;">Thông số mời thầu</th>
                                                                        <th style="min-width: 80px;">Đơn vị tính</th>
                                                                        <th style="min-width: 120px;">Khối lượng</th>
                                                                        <th style="min-width: 120px;">Ước tính phần lô</th>
                                                                        <th style="min-width: 120px;">Giá KH</th>
                                                                        <th style="min-width: 120px;">Yêu cầu về xuất xứ hàng hóa (nếu có)</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="text-center">
                                                                    @foreach ($group as $key => $item)
                                                                        <tr data-id="{{ $item->id }}">
                                                                            <td>{{ $key + 1 }}</td>
                                                                            <td>{{ $item->ma_phan }}</td>
                                                                            <td>{{ $item->ten_phan }}</td>
                                                                            <td>{{ $item->product_name ?? '' }}</td>
                                                                            <td>{{ $item->thong_so_moi_thau ?? '' }}</td>
                                                                            <td>{{ $item->unit ?? '' }}</td>
                                                                            <td>{{ $item->quantity ?? '' }}</td>
                                                                            <td>{{ $item->uoc_tinh_phan_lo ?? ''}}</td>
                                                                            <td>{{ $item->gia_kh ?? ''}}</td>
                                                                            <td>{{ $item->yeu_cau_ve_xuat_xu ?? ''}}</td>
                                                                            
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                            </div>
                            <div class="card-action">
                                <a href="{{ route('bidder.index') }}" class="btn btn-secondary">Quay lại</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
