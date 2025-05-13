@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Hồ sơ đấu thầu</h3>
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
                        <a href="#">Danh sách trúng thầu</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <h4 class="card-title">Danh sách trúng thầu</h4>
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
                                    <div class="dropdown ms-2">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownButton"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-file-export me-2"></i>
                                            Xuất file
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownButton" style="min-width: 200px;">
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
                                    </div>
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
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
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
                                <table id="add-row" class="table table-bordered align-middle text-nowrap">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th style="min-width: 40px;">
                                                <input type="checkbox" id="check-all" style="width:17px; height:17px">
                                            </th>
                                            <th style="min-width: 50px;">STT</th>
                                            <th style="min-width: 150px;">Mã bệnh viện</th>
                                            <th style="min-width: 150px;">Tên bệnh viện</th>
                                            <th style="min-width: 150px;">Gói thầu</th>
                                            <th style="min-width: 120px;">Tổng thành tiền</th>
                                            <th style="min-width: 120px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @if (isset($documents) && count($documents) > 0)
                                            @foreach ($documents as $k => $v)
                                                <tr class="clickable-row" data-id="{{ $v['code_category_bidder'] }}"
                                                    style="cursor: pointer;" data-url="{{ route('document.bidDetail', ['code' => $v['code_category_bidder'], 'group' => $v['group_id']]) }}">
                                                    <td>
                                                        <input type="checkbox" class="row-checkbox"
                                                            style="width:17px; height:17px">
                                                    </td>
                                                    <td class="clickable">{{ $k + 1 }}</td>
                                                    <td class="clickable">{{ $v['code_category_bidder'] }}</td>
                                                    <td class="clickable">{{ $v['bidder_name'] ?? '' }}</td>
                                                    <td class="clickable">{{ $v['group'] ?? '' }}</td>
                                                    <td class="clickable">{{ number_format($v['total_price']) ?? '' }} đ
                                                    </td>
                                                    <td>
                                                        {{-- @if (is_array($v['code_category_bidder'])) --}}
                                                            <a
                                                                href="{{ route('document.bidDetail', ['code' => $v['code_category_bidder'], 'group' => $v['group_id']]) }}" class="text-dark">Chi
                                                                tiết <i class="fa pointer ms-2 fa-caret-right"></i></a>
                                                        {{-- @else
                                                            <a href="{{ route('document.bidDetail', ['code' => $v['code_category_bidder']]) }}"
                                                                class="text-dark">Chi tiết <i
                                                                    class="fa pointer ms-2 fa-caret-right"></i></a>
                                                        @endif --}}
                                                    </td>
                                                </tr>
                                                {{-- <tr class="details-row" id="details-{{ $v['code_category_bidder'] }}"
                                                    style="display:none;">
                                                    <td colspan="10">
                                                        <table class="table table-bordered align-middle text-nowrap bg-green">
                                                            <thead>
                                                                <tr>
                                                                    <th>Mã phần</th>
                                                                    <th>Tên phần</th>
                                                                    <th>Đơn vị</th>
                                                                    <th>Số lượng</th>
                                                                    <th>Tên sản phẩm</th>
                                                                    <th>Quy cách</th>
                                                                    <th>Hãng</th>
                                                                    <th>Quốc gia</th>
                                                                    <th>Giá</th>
                                                                    <th>Tổng giá</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($details as $detail)
                                                                    @if ($detail['code_category_bidder'] == $v['code_category_bidder'])
                                                                        <tr>
                                                                            <td>{{ $detail['ma_phan'] }}</td>
                                                                            <td>{{ $detail['ten_phan'] }}</td>
                                                                            <td>{{ $detail['unit'] }}</td>
                                                                            <td>{{ $detail['quantity'] }}</td>
                                                                            <td>{{ $detail['product_name'] }}</td>
                                                                            <td>{{ $detail['quy_cach'] }}</td>
                                                                            <td>{{ $detail['brand'] }}</td>
                                                                            <td>{{ $detail['country'] }}</td>
                                                                            <td>{{ number_format($detail['price']) }} đ
                                                                            </td>
                                                                            <td>{{ number_format($detail['total_price']) }}
                                                                                đ</td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr> --}}
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">Không có dữ liệu</td>
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
