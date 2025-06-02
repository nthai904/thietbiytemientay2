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
            <form action="{{ route('bidder.updateGroup', ['id' => $group->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header ">
                                <div class="d-flex justify-content-between">
                                    <div class="card-title">Chi tiết gói thầu</div>
                                    <div class="w-25">
                                        <div class="form-group">
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="status" value="new"
                                                        class="selectgroup-input"
                                                        {{ $group->status === 'new' ? 'checked' : '' }}>
                                                    <span class="selectgroup-button">Mới</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="status" value="dauthau"
                                                        class="selectgroup-input"
                                                        {{ $group->status === 'dauthau' ? 'checked' : '' }}>
                                                    <span class="selectgroup-button">Đã đấu thầu</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="status" value="dongthau"
                                                        class="selectgroup-input"
                                                        {{ $group->status === 'dongthau' ? 'checked' : '' }}>
                                                    <span class="selectgroup-button">Đã đóng thầu</span>
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
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
                                                        <option value="{{ $cities->id }}" selected>{{ $cities->name }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="category_id" class="form-label">Bệnh viện</label>
                                                    <select name="category_id" id="category_id"
                                                        class="select2 form-control">
                                                        <option value="{{ $group->category->code }}" selected>{{ $group->category->name }}
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
                            <div class="card-action d-flex">
                                @if($group->status === "new")
                                <div>
                                    <input type="file" name="file" accept=".xlsx,.xls,.csv"
                                        class="form-control d-none" id="fileInput" />
                                    <button type="button" class="btn btn-primary ms-2 btn-addnew" id="importButton">
                                        <i class="fa fa-file-import me-2"></i>
                                        Import đấu thầu
                                    </button>
                                </div>
                                @endif
                                <button class="btn btn-success ms-2">Cập nhật</button>
                                <a href="{{ route('bidder.group') }}" class="btn btn-danger ms-2">Hủy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
