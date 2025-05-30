<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
                    height="20" />
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
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">
            {{-- <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-search pe-1">
                            <i class="fa fa-search search-icon"></i>
                        </button>
                    </div>
                    <input type="text" placeholder="Tìm kiếm ..." class="form-control" />
                </div>
            </nav> --}}

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false" aria-haspopup="true">
                        <i class="fa fa-search"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-search animated fadeIn">
                        <form class="navbar-left navbar-form nav-search">
                            <div class="input-group">
                                <input type="text" placeholder="Search ..." class="form-control" />
                            </div>
                        </form>
                    </ul>
                </li>
                {{-- <li class="nav-item topbar-icon dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-envelope"></i>
                    </a>
                    <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                        <li>
                            <div class="dropdown-title d-flex justify-content-between align-items-center">
                                Messages
                                <a href="#" class="small">Mark all as read</a>
                            </div>
                        </li>
                        <li>
                            <div class="message-notif-scroll scrollbar-outer">
                                <div class="notif-center">
                                    <a href="#">
                                        <div class="notif-img">
                                            <img src="assets/img/jm_denis.jpg" alt="Img Profile" />
                                        </div>
                                        <div class="notif-content">
                                            <span class="subject">Jimmy Denis</span>
                                            <span class="block"> How are you ? </span>
                                            <span class="time">5 minutes ago</span>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-img">
                                            <img src="assets/img/chadengle.jpg" alt="Img Profile" />
                                        </div>
                                        <div class="notif-content">
                                            <span class="subject">Chad</span>
                                            <span class="block"> Ok, Thanks ! </span>
                                            <span class="time">12 minutes ago</span>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-img">
                                            <img src="assets/img/mlane.jpg" alt="Img Profile" />
                                        </div>
                                        <div class="notif-content">
                                            <span class="subject">Jhon Doe</span>
                                            <span class="block">
                                                Ready for the meeting today...
                                            </span>
                                            <span class="time">12 minutes ago</span>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-img">
                                            <img src="assets/img/talha.jpg" alt="Img Profile" />
                                        </div>
                                        <div class="notif-content">
                                            <span class="subject">Talha</span>
                                            <span class="block"> Hi, Apa Kabar ? </span>
                                            <span class="time">17 minutes ago</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="see-all" href="javascript:void(0);">See all messages<i
                                    class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-item topbar-icon dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        @if ($countUnread > 0)
                            <span class="notification">{{ $countUnread }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="notifDropdown"
                        style="width: 400px;">
                        <li>
                            <div class="dropdown-title d-flex justify-content-between align-items-center">
                                Thông báo
                                {{-- <a href="#" class="small">Mark all as read</a> --}}
                            </div>
                        </li>
                        @foreach ($notifications as $note)
                            <li class="{{ $note['status'] === 'new' ? 'bg-new-notification' : '' }}">
                                <div class="message-notif-scroll scrollbar-outer">
                                    <div class="notif-center">
                                        <a href="{{ route('bidder.editGroup', ['id' => $note['group_id']]) }}">
                                            <div class="notif-img">
                                                <img src="{{ asset('assets/img/logo_ytemientay.png') }}"
                                                    alt="Img ytemientay" />
                                            </div>
                                            <div class="notif-content">
                                                <span class="subject">{{ $note['title'] }}</span>
                                                <span class="block"> {{ $note['content'] }} </span>
                                                <span class="time">{{ $note->created_at->diffForHumans() }}</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        {{-- <li style="text-align: center; padding: 10px; color: #666;">
                            Không có thông báo nào
                        </li> --}}
                    </ul>
                </li>
                {{-- <li class="nav-item topbar-icon dropdown hidden-caret">
                    <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                    </a>
                    <div class="dropdown-menu quick-actions animated fadeIn">
                        <div class="quick-actions-header">
                            <span class="title mb-1">Quick Actions</span>
                            <span class="subtitle op-7">Shortcuts</span>
                        </div>
                        <div class="quick-actions-scroll scrollbar-outer">
                            <div class="quick-actions-items">
                                <div class="row m-0">
                                    <a class="col-6 col-md-4 p-0" href="#">
                                        <div class="quick-actions-item">
                                            <div class="avatar-item bg-danger rounded-circle">
                                                <i class="far fa-calendar-alt"></i>
                                            </div>
                                            <span class="text">Calendar</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="#">
                                        <div class="quick-actions-item">
                                            <div class="avatar-item bg-warning rounded-circle">
                                                <i class="fas fa-map"></i>
                                            </div>
                                            <span class="text">Maps</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="#">
                                        <div class="quick-actions-item">
                                            <div class="avatar-item bg-info rounded-circle">
                                                <i class="fas fa-file-excel"></i>
                                            </div>
                                            <span class="text">Reports</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="#">
                                        <div class="quick-actions-item">
                                            <div class="avatar-item bg-success rounded-circle">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <span class="text">Emails</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="#">
                                        <div class="quick-actions-item">
                                            <div class="avatar-item bg-primary rounded-circle">
                                                <i class="fas fa-file-invoice-dollar"></i>
                                            </div>
                                            <span class="text">Invoice</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="#">
                                        <div class="quick-actions-item">
                                            <div class="avatar-item bg-secondary rounded-circle">
                                                <i class="fas fa-credit-card"></i>
                                            </div>
                                            <span class="text">Payments</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li> --}}

                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                        aria-expanded="false">
                        <div class="avatar-sm">
                            @auth
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar"
                                    class="avatar-img rounded-circle" />
                            @endauth
                        </div>
                        <span class="profile-username">
                            <span class="op-7">Xin chào,</span>
                            <span class="fw-bold">
                                @auth
                                    {{ Auth::user()->name }}
                                @endauth
                            </span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        @auth
                                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar"
                                                class="avatar-img rounded-circle" />
                                        @endauth
                                    </div>
                                    <div class="u-text">
                                        <h4> @auth
                                                {{ Auth::user()->name }}
                                            @endauth
                                        </h4>
                                        <p class="text-muted"> @auth
                                                {{ Auth::user()->email }}
                                            @endauth
                                        </p>
                                        <a href="profile.html" class="btn btn-xs btn-secondary btn-sm">Hồ sơ cá
                                            nhân</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Hồ sơ của tôi</a>
                                {{-- <div class="dropdown-divider"></div> --}}
                                <a class="dropdown-item" href="#">Cài đặt tài khoản</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Đăng xuất</button>
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
