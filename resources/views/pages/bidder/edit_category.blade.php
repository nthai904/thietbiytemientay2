@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Chi tiết thông tin bệnh viện</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Quản lý bệnh viện</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Chi tiết thông tin bệnh viện</a></li>
                </ul>
            </div>

            <form action="{{ route('categorybidder.update', ['code' => $category->code]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Chi tiết thông tin bệnh viện</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="manhathau">Mã bệnh viện</label>
                                            <input type="text" class="form-control" id="manhathau" name="code"
                                                placeholder="Nhập mã bệnh viện"
                                                value="{{ old('code', $category->code ?? '') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Tên bệnh viện</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Nhập tên bệnh viện"
                                                value="{{ old('name', $category->name ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city">Tỉnh/Thành phố</label>
                                            <select name="city" class="select2" id="city">
                                                <option value="">Chọn tỉnh/tp</option>
                                                @if (isset($cities) && $cities->count())
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}"
                                                            {{ old('city', $category->city ?? '') == $city->id ? 'selected' : '' }}>
                                                            {{ $city->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Địa chỉ</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="Nhập địa chỉ"
                                                value="{{ old('address', $category->address ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Điện thoại</label>
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                        placeholder="Nhập số điện thoại"
                                                        value="{{ old('phone', $category->phone ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fax">Fax</label>
                                                    <input type="text" class="form-control" id="fax" name="fax"
                                                        placeholder="Nhập Fax"
                                                        value="{{ old('fax', $category->fax ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tk">Tài khoản</label>
                                            <input type="text" class="form-control" id="tk" name="tk"
                                                placeholder="Nhập tài khoản"
                                                value="{{ old('tk', $category->tk ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tax_code">Mã số thuế</label>
                                            <input type="text" class="form-control" id="tax_code" name="tax_code"
                                                placeholder="Nhập mã số thuế"
                                                value="{{ old('tax_code', $category->tax_code ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="represent">Đại diện</label>
                                            <input type="text" class="form-control" id="represent" name="represent"
                                                placeholder="Nhập tên đại diện"
                                                value="{{ old('represent', $category->represent ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Giới tính</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="male" value="male"
                                                    {{ old('gender', $category->gender ?? '') == 'male' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="male">Nam</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="female" value="female"
                                                    {{ old('gender', $category->gender ?? '') == 'female' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="female">Nữ</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="position">Chức vụ</label>
                                            <select class="form-control select2" id="position" name="position">
                                                <option value="">Chọn chức vụ</option>
                                                <option value="Giám Đốc"
                                                    {{ old('position', $category->position ?? '') == 'Giám Đốc' ? 'selected' : '' }}>
                                                    Giám Đốc
                                                </option>
                                                <option value="Phó Giám Đốc"
                                                    {{ old('position', $category->position ?? '') == 'Phó Giám Đốc' ? 'selected' : '' }}>
                                                    Phó Giám Đốc
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-action">
                                <button class="btn btn-success">Cập nhật</button>
                                <a href="{{ route('category.index') }}" class="btn btn-danger">Hủy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
