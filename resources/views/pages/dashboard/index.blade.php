@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">Free Bootstrap 5 Admin Dashboard</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                <a href="#" class="btn btn-primary btn-round">Add Customer</a>
            </div>
        </div> --}}
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <a href="{{ route('document.index') }}" class="text-decoration-none text-dark">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category text-dark fw-bolder">Hồ sơ thầu</p>
                                            <h4 class="card-title">{{ $documents ?? 0 }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <a href="{{ route('document.bid') }}" class="text-decoration-none text-dark">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="fas fa-user-check"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category text-dark fw-bolder">Trúng thầu</p>
                                            <h4 class="card-title">{{ $document_bid ?? 0 }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-bullseye"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Tỉ lệ trúng thầu</p>
                                        <h4 class="card-title">{{ isset($bid_rate) ? $bid_rate . '%' : '0' }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">User Statistics</div>
                            <div class="card-tools">
                                <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                                    <span class="btn-label">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    Export
                                </a>
                                <a href="#" class="btn btn-label-info btn-round btn-sm">
                                    <span class="btn-label">
                                        <i class="fa fa-print"></i>
                                    </span>
                                    Print
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="min-height: 375px">
                            <canvas id="statisticsChart"></canvas>
                        </div>
                        <div id="myChartLegend"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-primary card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Daily Sales</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-label-light dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Export
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-category">March 25 - April 02</div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="mb-4 mt-2">
                            <h1>$4,578.58</h1>
                        </div>
                        <div class="pull-in">
                            <canvas id="dailySalesChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card card-round">
                    <div class="card-body pb-0">
                        <div class="h1 fw-bold float-end text-primary">+5%</div>
                        <h2 class="mb-2">17</h2>
                        <p class="text-muted">Users online</p>
                        <div class="pull-in sparkline-fix">
                            <div id="lineChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <h4 class="card-title">Thống kê theo nhân viên</h4>
                                {{-- <div class="card-tools">
                                <button class="btn btn-icon btn-link btn-primary btn-xs">
                                    <span class="fa fa-angle-down"></span>
                                </button>
                                <button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card">
                                    <span class="fa fa-sync-alt"></span>
                                </button>
                                <button class="btn btn-icon btn-link btn-primary btn-xs">
                                    <span class="fa fa-times"></span>
                                </button>
                            </div> --}}
                            </div>
                            {{-- <p class="card-category">
                            Map of the distribution of users around the world
                        </p> --}}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive table-hover table-sales">
                                        <table class="table">
                                            <thead>
                                                <th>STT</th>
                                                <th>Tên nhân viên</th>
                                                <th class="text-center">Số gói thầu đã tạo</th>
                                                <th class="text-center">Số gói thầu đã trúng thầu</th>
                                                <th class="text-center">Số báo giá ngoài thầu</th>
                                                <th class="text-center">Chi tiết</th>
                                            </thead>
                                            <tbody>
                                                @if (isset($user) && $user->count() > 0)
                                                    @foreach ($user as $g => $u)
                                                        <tr>
                                                            <td>
                                                                {{ $g + 1 }}
                                                            </td>
                                                            <td>{{ $u->name }}</td>
                                                            <td class="text-center">{{ $u->group->count() }}</td>
                                                            <td class="text-center">{{ $results[$u->id] }}</td>
                                                            <td class="text-center">{{ $exchanges[$u->id] }}</td>
                                                            {{-- <td class="text-center">@php
                                                                $totalGroup = $u->group->count();
                                                                $wonGroup = $results[$u->id] ?? 0;
                                                                $bidRate =
                                                                    $totalGroup > 0
                                                                        ? round(($wonGroup / $totalGroup) * 100, 2)
                                                                        : 0;
                                                            @endphp
                                                                {{ $bidRate }}%</td> --}}
                                                            <td class="text-center">
                                                                <a class="btn btn-sm btn-primary employee"
                                                                    data-bs-toggle="collapse"
                                                                    href="#detail-{{ $u->id }}" role="button"
                                                                    aria-expanded="false" aria-controls="collapse">
                                                                    <i class="fa pointer fa-eye"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
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
            {{-- <div class="row">
                <div class="col-md-4">
                    <div class="card card-round">
                        <div class="card-body">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">New Customers</div>
                                <div class="card-tools">
                                    <div class="dropdown">
                                        <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-list py-4">
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="assets/img/jm_denis.jpg" alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username">Jimmy Denis</div>
                                        <div class="status">Graphic Designer</div>
                                    </div>
                                    <button class="btn btn-icon btn-link op-8 me-1">
                                        <i class="far fa-envelope"></i>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <span class="avatar-title rounded-circle border border-white">CF</span>
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username">Chandra Felix</div>
                                        <div class="status">Sales Promotion</div>
                                    </div>
                                    <button class="btn btn-icon btn-link op-8 me-1">
                                        <i class="far fa-envelope"></i>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="assets/img/talha.jpg" alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username">Talha</div>
                                        <div class="status">Front End Designer</div>
                                    </div>
                                    <button class="btn btn-icon btn-link op-8 me-1">
                                        <i class="far fa-envelope"></i>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="assets/img/chadengle.jpg" alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username">Chad</div>
                                        <div class="status">CEO Zeleaf</div>
                                    </div>
                                    <button class="btn btn-icon btn-link op-8 me-1">
                                        <i class="far fa-envelope"></i>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <span class="avatar-title rounded-circle border border-white bg-primary">H</span>
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username">Hizrian</div>
                                        <div class="status">Web Designer</div>
                                    </div>
                                    <button class="btn btn-icon btn-link op-8 me-1">
                                        <i class="far fa-envelope"></i>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <span class="avatar-title rounded-circle border border-white bg-secondary">F</span>
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username">Farrah</div>
                                        <div class="status">Marketing</div>
                                    </div>
                                    <button class="btn btn-icon btn-link op-8 me-1">
                                        <i class="far fa-envelope"></i>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Transaction History</div>
                                <div class="card-tools">
                                    <div class="dropdown">
                                        <button class="btn btn-icon btn-clean me-0" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <!-- Projects table -->
                                <table class="table align-items-center mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Payment Number</th>
                                            <th scope="col" class="text-end">Date & Time</th>
                                            <th scope="col" class="text-end">Amount</th>
                                            <th scope="col" class="text-end">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                Payment from #10231
                                            </th>
                                            <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                            <td class="text-end">$250.00</td>
                                            <td class="text-end">
                                                <span class="badge badge-success">Completed</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                Payment from #10231
                                            </th>
                                            <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                            <td class="text-end">$250.00</td>
                                            <td class="text-end">
                                                <span class="badge badge-success">Completed</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                Payment from #10231
                                            </th>
                                            <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                            <td class="text-end">$250.00</td>
                                            <td class="text-end">
                                                <span class="badge badge-success">Completed</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                Payment from #10231
                                            </th>
                                            <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                            <td class="text-end">$250.00</td>
                                            <td class="text-end">
                                                <span class="badge badge-success">Completed</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                Payment from #10231
                                            </th>
                                            <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                            <td class="text-end">$250.00</td>
                                            <td class="text-end">
                                                <span class="badge badge-success">Completed</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                Payment from #10231
                                            </th>
                                            <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                            <td class="text-end">$250.00</td>
                                            <td class="text-end">
                                                <span class="badge badge-success">Completed</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                Payment from #10231
                                            </th>
                                            <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                            <td class="text-end">$250.00</td>
                                            <td class="text-end">
                                                <span class="badge badge-success">Completed</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            @if (isset($user) && $user->count() > 0)
                <!-- Thêm wrapper accordion -->
                <div id="employeeAccordion">
                    @foreach ($user as $g => $u)
                        <div class="col-md-12 collapse" id="detail-{{ $u->id }}"
                            data-bs-parent="#employeeAccordion">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Chi tiết nhân viên {{ $u->name }}</div>
                                </div>
                                <div class="card-body">
                                    <div class="detail-dropdown">
                                        <!-- Tabs cho chi tiết -->
                                        <ul class="nav detail-nav-tabs" id="detail{{ $u->id }}Tabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link tab-link active"
                                                    id="thongtin{{ $u->id }}-tab" data-bs-toggle="tab"
                                                    data-bs-target="#thongtin{{ $u->id }}" type="button"
                                                    role="tab">
                                                    Đấu thầu
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link tab-link" id="lichsu{{ $u->id }}-tab"
                                                    data-bs-toggle="tab" data-bs-target="#lichsu{{ $u->id }}"
                                                    type="button" role="tab">
                                                    Báo giá
                                                </button>
                                            </li>
                                        </ul>

                                        <!-- Nội dung tabs chi tiết -->
                                        <div class="tab-content detail-table-container"
                                            id="detail{{ $u->id }}TabsContent">
                                            <!-- Tab Thông tin -->
                                            <div class="tab-pane fade show active" id="thongtin{{ $u->id }}"
                                                role="tabpanel">
                                                <div class="border rounded p-2">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-sm align-middle m-0">
                                                            <thead class="table-primary">
                                                                <tr>
                                                                    <th width="5%">STT</th>
                                                                    <th width="10%">Gói thầu</th>
                                                                    <th width="15%">Mã bệnh viện</th>
                                                                    <th width="15%">Tên bệnh viện</th>
                                                                    <th width="10%">Ngày đóng thầu</th>
                                                                    <th width="10%">Trạng thái</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if ($group_bidder && count($group_bidder) > 0)
                                                                    @foreach ($group_bidder as $k => $v)
                                                                        @if ($v->user_id == $u->id)
                                                                            <tr>
                                                                                <td>{{ $k + 1 }}</td>
                                                                                <td>{{ $v->name ?? '' }}</td>
                                                                                <td>{{ $v->category_id ?? '' }}</td>
                                                                                <td>{{ $v->category->name ?? '' }}</td>
                                                                                <td>
                                                                                    {{ $v->ngay_dong_thau ? \Carbon\Carbon::parse($v->ngay_dong_thau)->format('d/m/Y') : '' }}
                                                                                </td>
                                                                                <td>
                                                                                    @if ($v->status == 'dauthau')
                                                                                        <span
                                                                                            class="badge badge-primary">Đang
                                                                                            thực hiện</span>
                                                                                    @elseif($v->status == 'dongthau')
                                                                                        <span
                                                                                            class="badge badge-success">Đã
                                                                                            hoàn thành</span>
                                                                                    @else
                                                                                        <span
                                                                                            class="badge badge-warning">Chưa
                                                                                            thực hiện</span>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="6" class="text-center">Không có dữ
                                                                            liệu</td>
                                                                    </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tab Lịch sử thầu -->
                                            <div class="tab-pane fade" id="lichsu{{ $u->id }}" role="tabpanel">
                                                <div class="border rounded p-2">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-sm align-middle m-0">
                                                            <thead class="table-primary">
                                                                <tr>
                                                                    <th width="5%">STT</th>
                                                                    <th width="10%">Mã bệnh viện</th>
                                                                    <th width="15%">Tên bệnh viện</th>
                                                                    <th width="15%">Tổng thành tiền</th>
                                                                    <th width="15%">Thời gian</th>
                                                                    <th width="5%" class="text-center">Chi tiết</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php $stt = 1; @endphp
                                                                @if ($exchange_detail && count($exchange_detail) > 0)
                                                                    @foreach ($exchange_detail as $v)
                                                                        @if ($v['user_id'] == $u->id)
                                                                            <tr>
                                                                                <td>{{ $stt++ }}</td>
                                                                                <td>{{ $v['code_category_bidder'] ?? '' }}
                                                                                </td>
                                                                                <td>{{ $v['bidder_name'] ?? '' }}</td>
                                                                                <td>{{ number_format($v['total_price']) }}
                                                                                    đ</td>
                                                                                <td>{{ $v['created_at'] ?? '' }}</td>
                                                                                <td class="text-center">
                                                                                    <a class="btn btn-sm btn-primary"
                                                                                        href="{{ route('exchange.detail', ['date' => $v['date_slug']]) }}">
                                                                                        <i class="fa pointer fa-eye"></i>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="6" class="text-center">Không có dữ
                                                                            liệu</td>
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
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Thống kê theo khu vực</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="pieChart" style="height: 400px; display: block;"
                                class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>
    <script>
        var cityStatsData = @json($city_stats);

        var cityLabels = [];
        var cityData = [];
        var baseColors = ["#1d7af3", "#f3545d", "#fdaf4b", "#28a745", "#6f42c1", "#fd7e14", "#20c997", "#6c757d", "#e83e8c",
            "#ffc107"
        ];

        function generateColors(count) {
            var colors = [];
            for (var i = 0; i < count; i++) {
                if (i < baseColors.length) {
                    colors.push(baseColors[i]);
                } else {
                    var hue = (i * 137.508) % 360;
                    colors.push(`hsl(${hue}, 70%, 60%)`);
                }
            }
            return colors;
        }

        cityStatsData.forEach(function(item, index) {
            cityLabels.push(item.city_name);
            cityData.push(item.total_categories);
        });

        var pieChart = document.getElementById("pieChart").getContext("2d");
        var myPieChart = new Chart(pieChart, {
            type: "pie",
            data: {
                datasets: [{
                    data: cityData,
                    backgroundColor: generateColors(cityData.length),
                    borderWidth: 0,
                }],
                labels: cityLabels,
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: "bottom",
                    labels: {
                        fontColor: "rgb(154, 154, 154)",
                        fontSize: 11,
                        usePointStyle: true,
                        padding: 20,
                    },
                },
                pieceLabel: {
                    render: "percentage",
                    fontColor: "white",
                    fontSize: 14,
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var total = dataset.data.reduce(function(previousValue, currentValue) {
                                return previousValue + currentValue;
                            });
                            var currentValue = dataset.data[tooltipItem.index];
                            var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                            return data.labels[tooltipItem.index] + ': ' + currentValue + ' (' + percentage +
                                '%)';
                        }
                    }
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20,
                    },
                },
            },
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lặp qua tất cả các nút employee
            document.querySelectorAll('.employee').forEach(function(btn) {
                var targetId = btn.getAttribute('href');
                var icon = btn.querySelector('i');
                var collapseEl = document.querySelector(targetId);

                if (collapseEl) {
                    collapseEl.addEventListener('show.bs.collapse', function() {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    });
                    collapseEl.addEventListener('hide.bs.collapse', function() {
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    });
                }
            });
        });
    </script>
@endsection
