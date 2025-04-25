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
                        <a href="#">Quản lý nhà thầu</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Thêm mới đấu thầu</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('bidder.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Thêm mới đấu thầu</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_id">Nhà thầu</label>
                                            <select name="category_id" id="category_id" class="select2">
                                                @if (isset($categories))
                                                    @foreach ($categories as $category)
                                                        <option value="{{$category['code']}}">{{$category['name']}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            {{-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email
                                        with anyone
                                        else.</small> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ma_phan">Mã phần</label>
                                            <input type="text" class="form-control" name="ma_phan" id="ma_phan" placeholder="Nhập mã phần">
                                            {{-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email
                                        with anyone
                                        else.</small> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ten_phan">Tên phần</label>
                                            <input type="text" class="form-control" name="ten_phan" id="ten_phan" placeholder="Nhập tên phần">
                                            {{-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email
                                        with anyone
                                        else.</small> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_name">Danh mục hàng hóa</label>
                                            <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Nhập danh mục hàng hóa">
                                            {{-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email
                                        with anyone
                                        else.</small> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="quantity">Số lượng</label>
                                            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Nhập số lượng">
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
