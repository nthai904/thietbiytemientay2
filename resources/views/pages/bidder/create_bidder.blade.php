@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Thêm mới đấu thầu</h3>
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
                        <a href="#">Thêm mới đấu thầu</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('bidder.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Thêm mới đấu thầu</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    {{-- Thông tin nhà thầu --}}
                                    <div class="col-12">
                                        <div class="card shadow-sm mb-4">
                                            <div class="card-header bg-den text-white d-flex justify-content-between align-items-center"
                                                style="cursor: pointer;" data-bs-toggle="collapse"
                                                data-bs-target="#thong-tin-nha-thau" aria-expanded="true"
                                                aria-controls="thong-tin-nha-thau">
                                                <strong>Thông tin bệnh viện</strong>
                                                {{-- <i class="fa fa-chevron-down"></i> --}}
                                            </div>
                                            <div class="collapse show" id="thong-tin-nha-thau">
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <label for="city" class="form-label">Tỉnh/TP</label>
                                                            <select name="city" id="city"
                                                                class="select2 form-control">
                                                                <option value="" selected>Chọn tỉnh/tp</option>
                                                                @foreach ($cities ?? [] as $city)
                                                                    <option value="{{ $city['id'] }}">{{ $city['name'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="category_id" class="form-label">Bệnh viện</label>
                                                            <select name="category_id" id="category_id"
                                                                class="select2 form-control">
                                                                <option value="" selected>Chọn bệnh viện</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="group" class="form-label">Gói thầu</label>
                                                            <select name="group" id="group"
                                                                class="select2 form-control">
                                                                <option value="" selected>Chọn gói thầu</option>
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
                                                style="cursor: pointer;" data-bs-toggle="collapse"
                                                data-bs-target="#chi-tiet-card" aria-expanded="true"
                                                aria-controls="chi-tiet-card">
                                                <strong>Chi tiết</strong>
                                                {{-- <i class="fa fa-chevron-down"></i> --}}

                                                <input type="file" name="file" accept=".xlsx,.xls,.csv"
                                                    class="form-control d-none" id="fileInput" />
                                                <button type="button" class="btn btn-primary ms-2 btn-addnew"
                                                    id="importButton">
                                                    <i class="fa fa-file-import me-2"></i>
                                                    Import
                                                </button>

                                            </div>
                                            <div class="collapse show">
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label for="ma_phan" class="form-label">Mã phần</label>
                                                            <input type="text" class="form-control" name="ma_phan"
                                                                id="ma_phan" placeholder="Nhập mã phần">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="ten_phan" class="form-label">Tên phần</label>
                                                            <input type="text" class="form-control" name="ten_phan"
                                                                id="ten_phan" placeholder="Nhập tên phần">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="product_name" class="form-label">Danh mục hàng
                                                                hóa</label>
                                                            <input type="text" class="form-control" name="product_name"
                                                                id="product_name" placeholder="Nhập danh mục hàng hóa">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="quantity" class="form-label">Số lượng</label>
                                                            <input type="number" class="form-control" name="quantity"
                                                                id="quantity" placeholder="Nhập số lượng">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="card-action">
                                <button class="btn btn-success">Thêm</button>
                                <a href="{{ route('bidder.index') }}" class="btn btn-danger">Hủy</a>
                                {{-- <button type="button" class="btn btn-info" id="addSampleBtn">Thêm dữ liệu mẫu</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
