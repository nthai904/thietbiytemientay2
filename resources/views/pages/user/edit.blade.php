{{-- filepath: d:\WorkSpace\MITA\thietbiytemientay\thietbiytemientay2\resources\views\pages\user\edit.blade.php --}}
@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Chỉnh sửa người dùng</h3>
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
                        <a href="#">Quản lý người dùng</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Chỉnh sửa người dùng</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('user.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Chỉnh sửa người dùng</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Họ và tên</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Nhập tên người dùng" autocomplete="off"
                                                value="{{ old('name', $user->name) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Số điện thoại</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                placeholder="Nhập số điện thoại" value="{{ old('phone', $user->phone) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_name">Tên đăng nhập</label>
                                            <input type="text" class="form-control" id="user_name" name="user_name"
                                                placeholder="Nhập tên đăng nhập"
                                                value="{{ old('user_name', $user->user_name) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Nhập email" value="{{ old('email', $user->email) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password">Mật khẩu</label>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password" placeholder="Nhập mật khẩu" autocomplete="off">
                                                    <small class="text-info">Để trống nếu không đổi mật khẩu</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="comfirmPassword">Nhập lại mật khẩu</label>
                                                    <input type="password" class="form-control" id="comfirmPassword"
                                                        name="comfirmPassword" placeholder="Nhập lại mật khẩu"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Địa chỉ</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="Nhập địa chỉ" value="{{ old('address', $user->address) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="avatar">Ảnh đại diện</label>
                                                    <input type="file" class="form-control w-100" id="avatar"
                                                        name="avatar" accept="image/*">
                                                    @if ($user->avatar)
                                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                                                            style="max-width: 100px; margin-top: 10px;">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kích hoạt</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="active"
                                                    id="active" value="active"
                                                    {{ old('active', $user->is_active) == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="active">Kích hoạt</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="active"
                                                    id="notactive" value="notactive"
                                                    {{ old('active', $user->is_active) == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="notactive">Ẩn</label>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($user->is_admin != 1)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="department">Phòng ban</label>
                                                <select name="department" class="select2" id="department">
                                                    <option value="0"
                                                        {{ old('department', $user->department) == '0' ? 'selected' : '' }}>
                                                        Chọn phòng ban</option>
                                                    <option value="duan"
                                                        {{ old('department', $user->department) == 'duan' ? 'selected' : '' }}>
                                                        Phòng dự án</option>
                                                    <option value="sale"
                                                        {{ old('department', $user->department) == 'sale' ? 'selected' : '' }}>
                                                        Phòng Sale</option>
                                                    <option value="ketoan"
                                                        {{ old('department', $user->department) == 'ketoan' ? 'selected' : '' }}>
                                                        Phòng kế toán</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success">Cập nhật</button>
                                <a href="{{ route('user.index') }}" class="btn btn-danger">Hủy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
