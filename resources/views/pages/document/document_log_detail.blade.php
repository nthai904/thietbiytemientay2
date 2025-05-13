@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Chi tiết phiếu giao hàng</h3>
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
                        <a href="#">Chi tiết phiếu giao hàng</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <h4 class="card-title">Chi tiết phiếu giao hàng</h4>
                                <div class="d-flex">
                                    {{-- <a href="{{ route('document.create') }}" class="btn btn-primary ms-2 btn-addnew">
                                        <i class="fa fa-plus me-2"></i>
                                        Thêm mới
                                    </a> --}}
                                    {{-- <form action="{{ route('bidder.import') }}" method="POST" enctype="multipart/form-data"
                                        class="d-inline-block">
                                        @csrf
                                        <input type="file" name="file" accept=".xlsx,.xls,.csv"
                                            class="form-control d-none" id="fileInput" />

                                        <button type="button" class="btn btn-primary ms-2 btn-addnew" id="importButton">
                                            <i class="fa fa-file-import me-2"></i>
                                            Import
                                        </button>
                                    </form> --}}
                                    {{-- <form action="{{ route('documents.exportExcel') }}" method="POST"
                                        enctype="multipart/form-data" id="exportForm">
                                        @csrf
                                        <input type="hidden" name="selectedRows" id="selectedRows">
                                        <button type="submit" class="btn btn-primary ms-2 btn-addnew" id="exportButton">
                                            <i class="fa fa-file-export me-2"></i>
                                            Xuất file
                                        </button>
                                    </form> --}}
                                    {{-- <div class="dropdown ms-2">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownButton"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-file-export me-2"></i>
                                            Xuất file
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownButton"
                                            style="min-width: 200px;">
                                            <li>
                                                <form action="{{ route('documents.exportExcel') }}" method="POST"
                                                    enctype="multipart/form-data" id="exportFormExcel">
                                                    @csrf
                                                    <input type="hidden" name="selectedRows" id="selectedRowsExcel">
                                                    <button type="submit" class="btn ms-2 btn-addnew exportButton"
                                                        data-action="excel">
                                                        <i class="fa fa-file-excel me-2"></i>
                                                        Phụ lục
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('documents.exportWord') }}" method="POST"
                                                    enctype="multipart/form-data" id="exportFormWord">
                                                    @csrf
                                                    <input type="hidden" name="selectedRows" id="selectedRowsWord">
                                                    <button type="submit" class="btn ms-2 btn-addnew exportButton"
                                                        data-action="word">
                                                        <i class="fa fa-file-word me-2"></i>
                                                        Báo giá
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('documents.exportContract') }}" method="POST"
                                                    enctype="multipart/form-data" id="exportFormContract">
                                                    @csrf
                                                    <input type="hidden" name="selectedRows" id="selectedRowsContract">
                                                    <button type="submit" class="btn ms-2 btn-addnew exportButton"
                                                        data-action="contract">
                                                        <i class="fa fa-file-word me-2"></i>
                                                        Hợp đồng
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('documents.exportContractPhuluc') }}" method="POST"
                                                    enctype="multipart/form-data" id="exportFormPhuluc">
                                                    @csrf
                                                    <input type="hidden" name="selectedRows" id="selectedRowsPhuluc">
                                                    <button type="submit" class="btn ms-2 btn-addnew exportButton"
                                                        data-action="phuluc">
                                                        <i class="fa fa-file-excel me-2"></i>
                                                        Phụ lục - Hợp đồng
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div> --}}
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
                                <table class="table table-bordered align-middle">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th width="5%">STT</th>
                                            <th width="30%">Tên phiếu</th>
                                            <th width="30%">Thời gian tạo</th>
                                            <th width="15%"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @if (isset($logsByGroupId) && count($logsByGroupId) > 0)
                                            @php $counter = 1; @endphp
                                            @foreach ($logsByGroupId as $groupId => $logsByDate)
                                                @foreach ($logsByDate as $date => $logs)
                                                    <tr class="clickable-row" data-id="{{ $groupId }}-{{ $date }}" style="cursor: pointer;">
                                                        <td class="clickable">{{ $counter++ }}</td>
                                                        <td class="clickable">Phiếu ngày {{ \Carbon\Carbon::parse($date)->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y') }}</td>
                                                        <td class="clickable">{{ \Carbon\Carbon::parse($date)->timezone('Asia/Ho_Chi_Minh')->format('H:i d/m/Y') }}</td>
                                                        <td>
                                                            <a class="text-dark" data-bs-toggle="collapse" href="#collapse-{{ $groupId }}-{{ str_replace(' ', '-', $date) }}" role="button" aria-expanded="false" aria-controls="collapse-{{ $groupId }}-{{ str_replace(' ', '-', $date) }}">
                                                                Chi tiết <i class="fa pointer ms-2 fa-caret-right"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr class="collapse" id="collapse-{{ $groupId }}-{{ str_replace(' ', '-', $date) }}">
                                                        <td colspan="4" class="p-2 bg-light">
                                                            <div class="border rounded p-2">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-sm align-middle m-0">
                                                                        <thead class="table-primary">
                                                                            <tr>
                                                                                <th width="5%">STT</th>
                                                                                <th width="10%">Mã phần</th>
                                                                                <th width="15%">Tên phần</th>
                                                                                <th width="15%">Danh mục</th>
                                                                                <th width="10%">SL</th>
                                                                                <th width="10%">SL giao</th>
                                                                                <th width="10%">SL còn</th>
                                                                                <th width="15%">Thời gian</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @php $innerCounter = 1; @endphp
                                                                            @foreach ($logs as $log)
                                                                                <tr>
                                                                                    <td>{{ $innerCounter++ }}</td>
                                                                                    <td>{{ $log->document->ma_phan ?? '-' }}</td>
                                                                                    <td class="text-truncate" style="max-width: 150px;">{{ $log->document->ten_phan ?? '-' }}</td>
                                                                                    <td class="text-truncate" style="max-width: 150px;">{{ $log->document->product_name ?? '-' }}</td>
                                                                                    <td>{{ $log->document->quantity ?? '-' }}</td>
                                                                                    <td>{{ $log->so_luong_da_giao ?? '-' }}</td>
                                                                                    <td>{{ $log->so_luong_con_lai ?? '-' }}</td>
                                                                                    <td>{{ \Carbon\Carbon::parse($log->created_at)->timezone('Asia/Ho_Chi_Minh')->format('H:i d/m/Y') }}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">Không có dữ liệu</td>
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
