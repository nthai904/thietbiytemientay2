@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Quản lý nhà cung cấp</h3>
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
                        <a href="#">Danh mục nhà cung cấp</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <h4 class="card-title">Danh mục nhà cung cấp</h4>
                                <div class="d-flex">
                                    <!-- Nút Thêm mới -->
                                    <a href="{{ route('provider.create') }}" class="btn btn-primary ms-2 btn-addnew">
                                        <i class="fa fa-plus me-2"></i>
                                        Thêm mới
                                    </a>
                                    <!-- Form Import -->
                                    <form action="{{ route('product.import') }}" method="POST"
                                        enctype="multipart/form-data" class="d-inline-block">
                                        @csrf <!-- Token CSRF để bảo mật -->
                                        <input type="file" name="file" accept=".xlsx,.xls,.csv"
                                            class="form-control d-none" id="fileInput" />

                                        <button type="button" class="btn btn-primary ms-2 btn-addnew" id="importButton">
                                            <i class="fa fa-file-import me-2"></i>
                                            Import
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Modal -->
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold"> New</span>
                                                <span class="fw-light"> Row </span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="small">
                                                Create a new row using this form, make sure you
                                                fill them all
                                            </p>
                                            <form>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Name</label>
                                                            <input id="addName" type="text" class="form-control"
                                                                placeholder="fill name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pe-0">
                                                        <div class="form-group form-group-default">
                                                            <label>Position</label>
                                                            <input id="addPosition" type="text" class="form-control"
                                                                placeholder="fill position" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Office</label>
                                                            <input id="addOffice" type="text" class="form-control"
                                                                placeholder="fill office" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" id="addRowButton" class="btn btn-primary">
                                                Add
                                            </button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="add-row" class="table table-bordered table-hover align-middle text-nowrap">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th style="min-width: 50px;">STT</th>
                                            <th style="min-width: 150px;">Tên</th>
                                            <th style="min-width: 120px;">Người đại diện</th>
                                            <th style="min-width: 120px;">SĐT</th>
                                            <th style="min-width: 120px;">Email</th>
                                            <th style="min-width: 120px;">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @if (isset($providers) && $providers->count())
                                            @foreach ($providers as $k => $v)
                                                <tr>
                                                    <td>{{ $k + 1 }}</td>
                                                    <td>{{ $v['name'] }}</td>
                                                    <td>{{ $v['represent'] }}</td>
                                                    <td>
                                                        {{ $v['phone1'] }} <br>
                                                        {{ $v['phone2'] }}
                                                    </td>
                                                    <td>{{ $v['email'] }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <a href="{{ route('provider.edit', $v['id']) }}"
                                                                class="btn btn-sm btn-primary" title="Sửa">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal-{{ $v['id'] }}">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                            <div class="modal fade"
                                                                id="deleteModal-{{ $v['id'] }}" tabindex="-1"
                                                                aria-labelledby="deleteModalLabel{{ $v['id'] }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-custom">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="deleteModalLabel{{ $v['id'] }}">
                                                                                Xác nhận xóa</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Bạn có chắc chắn muốn xóa
                                                                            <strong>{{ $v['name'] }}</strong>
                                                                            không?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <form method="POST"
                                                                                action="{{ route('provider.destroy', $v['id']) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Hủy</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Xóa</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6">Không có dữ liệu</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
