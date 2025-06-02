@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Thêm mới nhà cung cấp</h3>
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
                        <a href="#">Quản lý nhà cung cấp</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Thêm mới nhà cung cấp</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('provider.update', ['id' => $provider->id]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Thêm mới nhà cung cấp</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Tên nhà cung cấp <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Nhập tên nhà cung cấp"
                                                value="{{ old('name', isset($provider) ? $provider->name : '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Địa chỉ <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="Nhập địa chỉ"
                                                value="{{ old('address', isset($provider) ? $provider->address : '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Người đại diện <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" id="represent" name="represent"
                                                placeholder="Nhập người đại diện"
                                                value="{{ old('represent', isset($provider) ? $provider->represent : '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone1">Số điện thoại 1 <span
                                                            class="text-red">*</span></label>
                                                    <input type="number" class="form-control no-spinner" id="phone1"
                                                        name="phone1" placeholder="Nhập số điện thoại"
                                                        value="{{ old('phone1', isset($provider) ? $provider->phone1 : '') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone2">Số điện thoại 2</label>
                                                    <input type="number" class="form-control no-spinner" id="phone2"
                                                        name="phone2" placeholder="Nhập số điện thoại"
                                                        value="{{ old('phone2', isset($provider) ? $provider->phone2 : '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Nhập email"
                                                value="{{ old('email', isset($provider) ? $provider->email : '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kích hoạt</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" id="active"
                                                    value="active"
                                                    {{ old('active', 'active') == 'active' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="active">Kích hoạt</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" id="notactive"
                                                    value="notactive" {{ old('active') == 'notactive' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="notactive">Ẩn</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="note">Ghi chú</label>
                                            <textarea name="note" id="note" cols="30" rows="8" class="form-control">{{ old('note', isset($provider) ? $provider->note : '') }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="position">Chức vụ</label>
                                            <select class="form-control select2" id="position" name="position">
                                                <option value="">Chọn chức vụ</option>
                                                <option value="Giám Đốc">Giám Đốc</option>
                                                <option value="Phó Giám Đốc">Phó Giám Đốc</option>
                                            </select>
                                        </div>
                                    </div> --}}

                                </div>

                            </div>
                            <div class="card-action">
                                <button class="btn btn-success">Cập nhật</button>
                                <a href="{{ route('provider.index') }}" class="btn btn-danger">Hủy</a>
                                {{-- <button type="button" class="btn btn-info" id="addSampleBtn">Thêm dữ liệu mẫu</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
