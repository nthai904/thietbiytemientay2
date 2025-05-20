@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Chi tiết gói thầu</h3>
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
                        <a href="#">Chi tiết gói thầu</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('bidder.updateGroup', ['id' => $group->id]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Chi tiết gói thầu</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="p-3">
                                            <div class="row g-3">
                                                <div class="col-md-3">
                                                    <label for="city" class="form-label">
                                                        Tỉnh/TP <span class="text-danger">*</span>
                                                    </label>
                                                    <select name="city" id="city" class="select2 form-control"
                                                        readonly>
                                                        <option value="" selected>{{ $cities->name }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="category_id" class="form-label">Bệnh viện</label>
                                                    <select name="category_id" id="category_id"
                                                        class="select2 form-control">
                                                        <option value="" selected>{{ $group->category->name }}
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="name" class="form-label">Tên gói thầu</label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        placeholder="Nhập tên gói thầu" autocomplete="of"
                                                        value="{{ $group->name }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="ngay_dong_thau" class="form-label">Ngày đóng thầu</label>
                                                    <input type="date" class="form-control" name="ngay_dong_thau"
                                                        id="ngay_dong_thau"
                                                        value="{{ \Carbon\Carbon::parse($group->ngay_dong_thau)->format('Y-m-d') }}">
                                                </div>
                                                @if (auth()->user()->department === 'admin')
                                                    <div class="col-md-3">
                                                        <label for="user_id" class="form-label">Người tạo</label>
                                                        <input type="text" class="form-control" name="user_id"
                                                            id="user_id" value="{{ $group->user->name }}" readonly>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="card-action">
                                <button class="btn btn-success">Cập nhật</button>
                                <a href="{{ route('bidder.group') }}" class="btn btn-danger">Hủy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
