<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="{{ url('index') }}" class="header-logo">
            <img src="{{ asset('build/assets/images/brand-logos/desktop-logo.png') }}" alt="logo" class="desktop-logo">
            <img src="{{ asset('build/assets/images/brand-logos/toggle-dark.png') }}" alt="logo" class="toggle-dark">
            <img src="{{ asset('build/assets/images/brand-logos/desktop-dark.png') }}" alt="logo"
                class="desktop-dark">
            <img src="{{ asset('build/assets/images/brand-logos/toggle-logo.png') }}" alt="logo"
                class="toggle-logo">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">
                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Main</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide has-sub">                
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="ri ri-home-9-line ri-2x lh-1"></i>
                        <span class="side-menu__label">Admin</span>
                        <i class="ri-arrow-right side-menu__angle"></i>
                    </a>                    
                    <ul class="slide-menu child1 {{ request()->is('admin') ? 'double-menu-active' : '' }}">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Admin Dashboard</a>
                        </li>
                        <li class="slide {{ request()->is('admin') ? 'active' : '' }}">
                            <a href="{{ url('admin.dashboard.overview') }}" class="side-menu__item">
                                <i class="ri ri-arrow-right-line ri-xl me-1"></i> Home</a>
                        </li>
                    </ul>
                </li>                
                <li class="slide has-sub">                
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="ri ri-group-line ri-2x lh-1"></i>
                        <span class="side-menu__label">Users</span>
                        <i class="ri-arrow-right side-menu__angle"></i>
                    </a>                    
                    <ul class="slide-menu child1 {{ request()->is('admin/users') ? 'double-menu-active' : '' }}">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Manage Users</a>
                        </li>
                        <li class="slide {{ request()->is('admin/users') ? 'active' : '' }}">
                            <a href="{{ route('admin.users.index') }}" class="side-menu__item">
                                <i class="ri ri-arrow-right-line ri-xl me-1"></i> List Users</a>
                        </li>
                        <li class="slide {{ request()->is('admin/users/add') ? 'active' : '' }}">
                            <a href="{{ route('admin.users.create') }}" class="side-menu__item">
                                <i class="ri ri-arrow-right-line ri-xl me-1"></i> Add User</a>
                        </li>
                    </ul>
                </li>
                <li class="slide has-sub">                
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="ri ri-contract-line ri-2x lh-1"></i>
                        <span class="side-menu__label">Exams</span>
                        <i class="ri-arrow-right side-menu__angle"></i>
                    </a>                    
                    <ul class="slide-menu child1 {{ request()->is('exams') ? 'double-menu-active' : '' }}">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Exams</a>
                        </li>
                        <li class="slide {{ request()->is('admin') ? 'active' : '' }}">
                            <a href="{{ url('admin.dashboard.overview') }}" class="side-menu__item">
                                <i class="ri ri-arrow-right-line ri-xl me-1"></i> Types</a>
                        </li>
                        <li class="slide {{ request()->is('admin') ? 'active' : '' }}">
                            <a href="{{ url('admin.dashboard.overview') }}" class="side-menu__item">
                                <i class="ri ri-arrow-right-line ri-xl me-1"></i> Sessions</a>
                        </li>
                        <li class="slide {{ request()->is('admin') ? 'active' : '' }}">
                            <a href="{{ url('admin.dashboard.overview') }}" class="side-menu__item">
                                <i class="ri ri-arrow-right-line ri-xl me-1"></i> Sections</a>
                        </li>
                    </ul>
                </li>
                <li class="slide has-sub">                
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="ri ri-money-dollar-circle-line ri-2x lh-1"></i>
                        <span class="side-menu__label">Payments</span>
                        <i class="ri-arrow-right side-menu__angle"></i>
                    </a>                    
                    <ul class="slide-menu child1 {{ request()->is('payments') ? 'double-menu-active' : '' }}">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Payments</a>
                        </li>
                        <li class="slide {{ request()->is('admin') ? 'active' : '' }}">
                            <a href="{{ url('admin.dashboard.overview') }}" class="side-menu__item">
                                <i class="ri ri-arrow-right-line ri-xl me-1"></i> Home</a>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->                

                <!-- End::slide -->            

            </ul>
            <ul class="doublemenu_bottom-menu main-menu mb-0 border-top">
                <!-- Start::slide -->
                <li class="slide">
                    <a href="javascript:void(0);" class="side-menu__item layout-setting-doublemenu">
                        <span class="light-layout">
                            <!-- Start::header-link-icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <path d="M108.11,28.11A96.09,96.09,0,0,0,227.89,147.89,96,96,0,1,1,108.11,28.11Z"
                                    opacity="0.2" />
                                <path d="M108.11,28.11A96.09,96.09,0,0,0,227.89,147.89,96,96,0,1,1,108.11,28.11Z"
                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="16" />
                            </svg>
                            <!-- End::header-link-icon -->
                        </span>
                        <span class="dark-layout">
                            <!-- Start::header-link-icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <circle cx="128" cy="128" r="56" opacity="0.2" />
                                <line x1="128" y1="40" x2="128" y2="32" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <circle cx="128" cy="128" r="56" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                <line x1="64" y1="64" x2="56" y2="56" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <line x1="64" y1="192" x2="56" y2="200" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <line x1="192" y1="64" x2="200" y2="56" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <line x1="192" y1="192" x2="200" y2="200" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <line x1="40" y1="128" x2="32" y2="128" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <line x1="128" y1="216" x2="128" y2="224" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <line x1="216" y1="128" x2="224" y2="128" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                            </svg>
                            <!-- End::header-link-icon -->
                        </span>
                        <span class="side-menu__label">Theme Settings</span>
                    </a>
                </li>
                <!-- End::slide -->
                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ url('sign-in-cover') }}" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none" />
                            <path
                                d="M48,40H208a16,16,0,0,1,16,16V200a16,16,0,0,1-16,16H48a0,0,0,0,1,0,0V40A0,0,0,0,1,48,40Z"
                                opacity="0.2" />
                            <polyline points="112 40 48 40 48 216 112 216" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            <line x1="112" y1="128" x2="224" y2="128" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" />
                            <polyline points="184 88 224 128 184 168" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        </svg>
                        <span class="side-menu__label">Logout</span>
                    </a>
                </li>
                <!-- End::slide -->
                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ url('profile-settings') }}" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none" />
                            <path
                                d="M205.31,71.08a16,16,0,0,1-20.39-20.39A96,96,0,0,0,63.8,199.38h0A72,72,0,0,1,128,160a40,40,0,1,1,40-40,40,40,0,0,1-40,40,72,72,0,0,1,64.2,39.37A96,96,0,0,0,205.31,71.08Z"
                                opacity="0.2" />
                            <line x1="200" y1="40" x2="200" y2="28" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" />
                            <circle cx="200" cy="56" r="16" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            <line x1="186.14" y1="48" x2="175.75" y2="42" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" />
                            <line x1="186.14" y1="64" x2="175.75" y2="70" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" />
                            <line x1="200" y1="72" x2="200" y2="84" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" />
                            <line x1="213.86" y1="64" x2="224.25" y2="70" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" />
                            <line x1="213.86" y1="48" x2="224.25" y2="42" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" />
                            <circle cx="128" cy="120" r="40" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            <path d="M63.8,199.37a72,72,0,0,1,128.4,0" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            <path d="M222.67,112A95.92,95.92,0,1,1,144,33.33" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        </svg>
                        <span class="side-menu__label">Profile Settings</span>
                    </a>
                </li>
                <!-- End::slide -->
                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ url('profile') }}" class="side-menu__item p-1 rounded-circle mb-0">
                        <span class="avatar avatar-md avatar-rounded">
                            <img src="{{ asset('build/assets/images/faces/10.jpg') }}" alt="">
                        </span>
                    </a>
                </li>
                <!-- End::slide -->
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
