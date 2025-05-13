<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('assets/img/mita-1-3193.png') }}" alt="navbar brand" class="navbar-brand"
                    height="90" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.index') }}">
                        <i class="fas fa-home"></i>
                        <p>Bảng điều khiển</p>
                        {{-- <span class="caret"></span> --}}
                    </a>
                    {{-- <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Bảng điều khiển</p>
                        <span class="caret"></span>
                    </a> --}}
                    {{-- <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="../demo1/index.html">
                                    <span class="sub-item">Dashboard 1</span>
                                </a>
                            </li>
                        </ul>
                    </div> --}}
                </li>
                {{-- <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li> --}}
                <li class="nav-item {{ request()->routeIs('product.*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#base"
                        aria-expanded="{{ request()->routeIs('product.*') ? 'true' : 'false' }}">
                        <i class="fas fa-layer-group"></i>
                        <p>Quản lý hàng hóa</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('product.*') ? 'show' : '' }}" id="base">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('product.index') ? 'active' : '' }}">
                                <a href="{{ route('product.index') }}">
                                    <span class="sub-item">Hàng hóa</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li
                    class="nav-item {{ request()->routeIs('category.index') || request()->routeIs('bidder.group') || request()->routeIs('bidder.index') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts"
                        aria-expanded="{{ request()->routeIs('category.index') || request()->routeIs('bidder.group') || request()->routeIs('bidder.index') ? 'true' : 'false' }}">
                        <i class="fas fa-th-list"></i>
                        <p>Quản lý bệnh viện</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('category.index') || request()->routeIs('bidder.group') || request()->routeIs('bidder.index') ? 'show' : '' }}"
                        id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('category.index') ? 'active' : '' }}">
                                <a href="{{ route('category.index') }}">
                                    <span class="sub-item">Danh mục bệnh viện</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('bidder.group') ? 'active' : '' }}">
                                <a href="{{ route('bidder.group') }}">
                                    <span class="sub-item">Gói thầu</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('bidder.index') ? 'active' : '' }}">
                                <a href="{{ route('bidder.index') }}">
                                    <span class="sub-item">Đấu thầu</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li
                    class="nav-item {{ request()->routeIs('document.index') || request()->routeIs('document.bid') || request()->routeIs('document.docLog') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts1"
                        aria-expanded="{{ request()->routeIs('document.index') || request()->routeIs('document.bid') || request()->routeIs('document.docLog') ? 'true' : 'false' }}">
                        <i class="fas fa-folder"></i>
                        <p>Hồ sơ đấu thầu</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('document.index') || request()->routeIs('document.bid') || request()->routeIs('document.docLog') ? 'show' : '' }}"
                        id="sidebarLayouts1">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('document.index') ? 'active' : '' }}">
                                <a href="{{ route('document.index') }}">
                                    <span class="sub-item">Phụ lục</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('document.bid') ? 'active' : '' }}">
                                <a href="{{ route('document.bid') }}">
                                    <span class="sub-item">Danh sách trúng thầu</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('document.docLog') ? 'active' : '' }}">
                                <a href="{{ route('document.docLog') }}">
                                    <span class="sub-item">Phiếu giao hàng</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item {{ request()->routeIs('exchange.index') ? 'active' : '' }}">
                    <a href="{{ route('exchange.index') }}">
                        <i class="fas fa-exchange-alt"></i>
                        <p>Quản lý bán lẻ</p>
                        {{-- <span class="caret"></span> --}}
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#forms">
                        <i class="fas fa-pen-square"></i>
                        <p>Forms</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="forms/forms.html">
                                    <span class="sub-item">Basic Form</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Tables</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="tables/tables.html">
                                    <span class="sub-item">Basic Table</span>
                                </a>
                            </li>
                            <li>
                                <a href="tables/datatables.html">
                                    <span class="sub-item">Datatables</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#maps">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Maps</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="maps/googlemaps.html">
                                    <span class="sub-item">Google Maps</span>
                                </a>
                            </li>
                            <li>
                                <a href="maps/jsvectormap.html">
                                    <span class="sub-item">Jsvectormap</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
                        <p>Charts</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="charts/charts.html">
                                    <span class="sub-item">Chart Js</span>
                                </a>
                            </li>
                            <li>
                                <a href="charts/sparkline.html">
                                    <span class="sub-item">Sparkline</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="widgets.html">
                        <i class="fas fa-desktop"></i>
                        <p>Widgets</p>
                        <span class="badge badge-success">4</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../documentation/index.html">
                        <i class="fas fa-file"></i>
                        <p>Documentation</p>
                        <span class="badge badge-secondary">1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#submenu">
                        <i class="fas fa-bars"></i>
                        <p>Menu Levels</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a data-bs-toggle="collapse" href="#subnav1">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav1">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a data-bs-toggle="collapse" href="#subnav2">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav2">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Level 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
