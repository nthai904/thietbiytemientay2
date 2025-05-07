@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Thêm mới gói thầu</h3>
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
                        <a href="#">Thêm mới gói thầu</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('bidder.storeGroup') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Thêm mới gói thầu</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="p-3">
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label for="city" class="form-label">Tỉnh/TP</label>
                                                    <select name="city" id="city" class="select2 form-control">
                                                        <option value="" selected>Chọn tỉnh/tp</option>
                                                        @foreach ($cities ?? [] as $city)
                                                            <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
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
                                                    <label for="name" class="form-label">Tên gói thầu</label>
                                                    <input type="text" class="form-control" name="name"
                                                        id="name" placeholder="Nhập tên gói thầu">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="card-action">
                                <button class="btn btn-success">Thêm</button>
                                <a href="{{ route('bidder.group') }}" class="btn btn-danger">Hủy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
