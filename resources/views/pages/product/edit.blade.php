@extends('index')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Chi tiết hàng hóa</h3>
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
                        <a href="#">Quản lý hàng hóa</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Chi tiết hàng hóa</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('product.update', ['id' => $product->ky_ma_hieu]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Chi tiết hàng hóa</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="name">Tên thương mại</label>
                                            <input type="text" class="form-control" id="name"
                                                name="name" placeholder="Nhập tên hàng hóa" value="{{ $product->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="ky_ma_hieu">Ký mã hiệu</label>
                                            <input type="text" class="form-control" id="ky_ma_hieu" name="ky_ma_hieu"
                                                placeholder="Nhập ký mã hiệu" value="{{ $product->ky_ma_hieu }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="hang_sx">Hãng sản xuất</label>
                                            <input type="text" class="form-control" id="hang_sx" name="hang_sx"
                                                placeholder="Nhập hãng sản xuất" value="{{ $product->hang_sx }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nuoc_sx">Nước sản xuất</label>
                                            <input type="text" class="form-control" id="nuoc_sx" name="nuoc_sx"
                                                placeholder="Nhập nước sản xuất" value="{{ $product->nuoc_sx }}">
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Điện thoại</label>
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                        placeholder="Nhập số điện thoại">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fax">Fax</label>
                                                    <input type="text" class="form-control" id="fax" name="fax"
                                                        placeholder="Nhập Fax">
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="hang_nuoc_chu_so_huu">Hãng/nước chủ sở hữu</label>
                                            <input type="text" class="form-control" id="hang_nuoc_chu_so_huu"
                                                name="hang_nuoc_chu_so_huu" placeholder="Nhập hãng/nước chủ sở hữu" value="{{ $product->hang_nuoc_chu_so_huu }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="quy_cach">Quy cách đóng gói</label>
                                            <input type="text" class="form-control" id="quy_cach" name="quy_cach"
                                                placeholder="Nhập quy cách đóng gói" value="{{ $product->quy_cach }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Đơn vị tính</label><br>
                                            <input type="text" class="form-control" id="don_vi_tinh" name="don_vi_tinh"
                                                placeholder="Nhập tên đại diện" value="{{ $product->don_vi_tinh }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Hạn sử dụng</label><br>
                                            <input type="date" class="form-control" id="hsd" name="hsd" 
                                                placeholder="Nhập hạn sử dụng" value="{{ $product->hsd }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Giá vốn</label><br>
                                            <input type="number" class="form-control" id="gia_von" name="gia_von"
                                                placeholder="Nhập giá vốn" value="{{ $product->gia_von }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Giá đề xuất</label><br>
                                            <input type="number" class="form-control" id="gia_de_xuat"
                                                name="gia_de_xuat" placeholder="Nhập giá đề xuất" value="{{ $product->gia_de_xuat }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Tên NCC</label><br>
                                            <input type="text" class="form-control" id="ten_ncc" name="ten_ncc"
                                                placeholder="Nhập tên ncc" value="{{ $product->ten_ncc }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Mã VTYT dùng chung Quyết định 5086</label><br>
                                            <input type="text" class="form-control" id="ma_vtyt" name="ma_vtyt"
                                                placeholder="Nhập mã VTYT dùng chung" value="{{ $product->ma_vtyt }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Nhóm theo TT04/2017/TT-BYT</label><br>
                                            <input type="text" class="form-control" id="nhom_theo_tt" name="nhom_theo_tt"
                                                placeholder="Nhập nhóm theo TT04/2017/TT-BYT" value="{{ $product->nhom_theo_tt }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Phân loại TTBYT theo TT39/2016/TT-BYT</label><br>
                                            <input type="text" class="form-control" id="phan_loai_ttbyt" name="phan_loai_ttbyt"
                                                placeholder="Nhập phân loại TTBYT theo TT39/2016/TT-BYT" value="{{ $product->phan_loai_ttbyt }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Số đăng ký lưu hành/Số GPNK</label><br>
                                            <input type="text" class="form-control" id="so_dang_ky_luu_hanh" name="so_dang_ky_luu_hanh"
                                                placeholder="Nhập số đăng ký lưu hành/Số GPNK" value="{{ $product->so_dang_ky_luu_hanh }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Số bảng phân loại</label><br>
                                            <input type="text" class="form-control" id="so_bang_phan_loai" name="so_bang_phan_loai"
                                                placeholder="Nhập số bảng phân loại" value="{{ $product->so_bang_phan_loai }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="thong_so_ky_thuat_co_ban">Đặc tính thông số kỹ thuật cơ bản</label>
                                            <textarea name="thong_so_ky_thuat_co_ban" id="thong_so_ky_thuat_co_ban" cols="30" rows="10" class="form-control product-description">
                                                {{ $product->thong_so_ky_thuat_co_ban }}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="thong_so_ky_thuat_thau">Đặc tính thông số kỹ thuật thầu</label>
                                            <textarea name="thong_so_ky_thuat_thau" id="thong_so_ky_thuat_thau" cols="30" rows="10" class="form-control product-description">
                                                {{ $product->thong_so_ky_thuat_thau }}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ghi_chu">Ghi chú</label>
                                            <textarea name="ghi_chu" id="ghi_chu" cols="30" rows="12" class="form-control">
                                                {{ $product->ghi_chu }}
                                            </textarea>
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
                                <a href="{{ route('product.index') }}" class="btn btn-danger">Hủy</a>
                                {{-- <button type="button" class="btn btn-info" id="addSampleBtn">Thêm dữ liệu mẫu</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
