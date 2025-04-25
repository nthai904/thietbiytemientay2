@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Thêm mới nhà thầu</h3>
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
                        <a href="#">Thêm mới nhà thầu</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('categorybidder.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Thêm mới nhà thầu</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="manhathau">Mã nhà thầu</label>
                                            <input type="text" class="form-control" id="manhathau" name="code"
                                                placeholder="Nhập mã nhà thầu">
                                            {{-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email
                                        with anyone
                                        else.</small> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Tên nhà thầu</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Nhập tên nhà thầu">
                                            {{-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email
                                        with anyone
                                        else.</small> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Địa chỉ</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="Nhập địa chỉ">
                                            {{-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email
                                        with anyone
                                        else.</small> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Điện thoại</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                placeholder="Nhập số điện thoại">
                                            {{-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email
                                        with anyone
                                        else.</small> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fax">Fax</label>
                                            <input type="text" class="form-control" id="fax" name="fax"
                                                placeholder="Nhập Fax">
                                            {{-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email
                                        with anyone
                                        else.</small> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tk">Tài khoản</label>
                                            <input type="text" class="form-control" id="tk" name="tk"
                                                placeholder="Nhập tài khoản">
                                            {{-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email
                                        with anyone
                                        else.</small> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tax_code">Mã số thuế</label>
                                            <input type="text" class="form-control" id="tax_code" name="tax_code"
                                                placeholder="Nhập mã số thuế">
                                            {{-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email
                                        with anyone
                                        else.</small> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="represent">Đại diện</label>
                                            <input type="text" class="form-control" id="represent" name="represent"
                                                placeholder="Nhập tên đại diện">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Giới tính</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="male"
                                                    value="male">
                                                <label class="form-check-label" for="male">Nam</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="female" value="female">
                                                <label class="form-check-label" for="female">Nữ</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="position">Chức vụ</label>
                                            <select class="form-control select2" id="position" name="position">
                                                <option value="">Chọn chức vụ</option>
                                                <option value="Giám Đốc">Giám Đốc</option>
                                                <option value="Phó Giám Đốc">Phó Giám Đốc</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="card-action">
                                <button class="btn btn-success">Thêm</button>
                                <a href="{{route('category.index')}}" class="btn btn-danger">Hủy</a>
                                <button type="button" class="btn btn-info" id="addSampleBtn">Thêm dữ liệu mẫu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
