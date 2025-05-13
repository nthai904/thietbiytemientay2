@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Chi tiết đấu thầu</h3>
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
                        <a href="#">Chi tiết đấu thầu</a>
                    </li>
                </ul>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Chi tiết đấu thầu</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if (isset($bidder) && $bidder->count())
                                        @foreach ($bidder as $maDauThau => $group)
                                            {{-- Thông tin nhà thầu --}}
                                            @php
                                                $first = $group->first();
                                            @endphp
                                            <div class="col-12">
                                                <div class="card shadow-sm mb-4">
                                                    <div class="card-header bg-den text-white d-flex justify-content-between align-items-center"
                                                        style="cursor: pointer;" data-bs-toggle="collapse"
                                                        data-bs-target="#thong-tin-nha-thau" aria-expanded="true"
                                                        aria-controls="thong-tin-nha-thau">
                                                        <strong>Thông tin nhà thầu</strong>
                                                        {{-- <i class="fa fa-chevron-down"></i> --}}
                                                    </div>
                                                    <div class="collapse show" id="thong-tin-nha-thau">
                                                        <div class="card-body">
                                                            <div class="row g-3">
                                                                <div class="col-md-4">
                                                                    <label for="city" class="form-label">Tỉnh/TP</label>
                                                                    <select name="city" id="city"
                                                                        class="select2 form-control no-click"
                                                                        tabindex="-1">
                                                                        <option value="" selected>
                                                                            @if ($cities->count())
                                                                                @foreach ($cities as $city)
                                                                                    @if ($first->category->city == $city->id)
                                                                                        {{ $city->name ?? '' }}
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="category_id" class="form-label">Bệnh
                                                                        viện</label>
                                                                    <select name="category_id" id="category_id"
                                                                        class="select2 form-control no-click"
                                                                        tabindex="-1">
                                                                        <option value="" selected>
                                                                            {{ $first->category->name ?? '' }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="group" class="form-label">Gói
                                                                        thầu</label>
                                                                    <select name="group" id="group"
                                                                        class="select2 form-control no-click"
                                                                        tabindex="-1">
                                                                        <option value="" selected>
                                                                            {{ $first->group->name ?? '' }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            {{-- Chi tiết --}}
                                            <div class="col-12">
                                                <div class="card shadow-sm mb-4">
                                                    <div class="card-header bg-den text-white d-flex justify-content-between align-items-center"
                                                        style="cursor: pointer;" data-bs-toggle="collapse"
                                                        data-bs-target="#chi-tiet-card" aria-expanded="true"
                                                        aria-controls="chi-tiet-card">
                                                        <strong>Chi tiết</strong>
                                                        {{-- <i class="fa fa-chevron-down"></i> --}}

                                                        <input type="file" name="file" accept=".xlsx,.xls,.csv"
                                                            class="form-control d-none" id="fileInput" />
                                                        <button type="button" class="btn btn-primary ms-2 btn-addnew"
                                                            id="importButton">
                                                            <i class="fa fa-file-import me-2"></i>
                                                            Import
                                                        </button>

                                                    </div>

                                                    <div class="table-responsive">

                                                        <div class="table-wrapper">
                                                            <table
                                                                class="table table-bordered table-hover align-middle text-nowrap mb-0">
                                                                <thead class="table-light text-center">
                                                                    <tr>
                                                                        <th style="min-width: 50px;">STT</th>
                                                                        <th style="min-width: 100px;">Mã phần (lô)</th>
                                                                        <th style="min-width: 150px;">Tên phần (lô)</th>
                                                                        <th style="min-width: 120px;">Danh mục hàng hóa</th>
                                                                        <th style="min-width: 120px;">Số lượng</th>
                                                                        <th style="min-width: 120px;"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="text-center">
                                                                    @foreach ($group as $key => $item)
                                                                        <tr data-id="{{ $item->id }}">
                                                                            <td>{{ $key + 1 }}</td>
                                                                            <td>{{ $item->ma_phan }}</td>
                                                                            <td>{{ $item->ten_phan }}</td>
                                                                            <td>{{ $item->product_name ?? '' }}</td>
                                                                            <td>{{ $item->quantity }}</td>
                                                                            <td>
                                                                                <button type="button"
                                                                                    class="btn btn-danger"><i
                                                                                        class="fas fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                            </div>
                            <div class="card-action">
                                <button class="btn btn-success">Cập nhật</button>
                                <a href="{{ route('bidder.index') }}" class="btn btn-danger">Hủy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
