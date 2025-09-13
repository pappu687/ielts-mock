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
        <nav class="main-menu-container nav nav-pills flex-column sub-open mt-3">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">
                
                <!-- Dashboard -->
                <li class="slide has-sub">                
                    <a href="javascript:void(0);" class="side-menu__item {{ request()->is('admin') ? 'active open text-indigo' : '' }}">
                        <i class="ri ri-dashboard-3-line ri-13x me-2 lh-1"></i>
                        <span class="side-menu__label">Dashboard</span>
                        <i class="ri-arrow-right-line side-menu__angle"></i>
                    </a>                    
                    <ul class="slide-menu child1 list-unstyled">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Dashboard Overview</a>
                        </li>
                        <li class="slide {{ request()->is('admin') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard.overview') }}" class="side-menu__item">
                                Overview</a>
                        </li>
                        <li class="slide {{ request()->is('admin/dashboard-recent-activity') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard.recent-activity') }}" class="side-menu__item">
                                Recent Activity</a>
                        </li>
                        <li class="slide {{ request()->is('admin/dashboard-system-status') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard.system-status') }}" class="side-menu__item">
                                System Status</a>
                        </li>
                    </ul>
                </li>

                <!-- User Management -->
                <li class="slide has-sub">         
                    <a href="javascript:void(0);" class="side-menu__item {{ request()->is('admin/users*') || request()->is('admin/subscriptions*') || request()->is('admin/progress*') || request()->is('admin/roles-permissions*') ? 'active open text-indigo' : '' }}">
                        <i class="ri ri-group-line ri-13x me-2 lh-1"></i>
                        <span class="side-menu__label">Users</span>
                        <i class="ri-arrow-right-line side-menu__angle"></i>
                    </a>                    
                    <ul class="slide-menu child1 {{ request()->is('admin/users*') || request()->is('admin/subscriptions*') || request()->is('admin/progress*') || request()->is('admin/roles-permissions*') ? 'double-menu-active' : '' }}">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)"> Users</a>
                        </li>
                        <li class="slide {{ request()->is('admin/users') ? 'active' : '' }}">
                            <a href="{{ route('admin.users.index') }}" class="side-menu__item">
                                Users</a>
                        </li>
                        <li class="slide {{ request()->is('admin/users/create') ? 'active' : '' }}">
                            <a href="{{ route('admin.users.create') }}" class="side-menu__item">
                                Add User</a>
                        </li>
                        <li class="slide {{ request()->is('admin/subscriptions*') ? 'active' : '' }}">
                            <a href="{{ route('admin.subscriptions.index') }}" class="side-menu__item">
                                Subscriptions</a>
                        </li>
                        <li class="slide {{ request()->is('admin/progress*') ? 'active' : '' }}">
                            <a href="{{ route('admin.progress.index', 1) }}" class="side-menu__item">
                                User Progress</a>
                        </li>
                        <li class="slide {{ request()->is('admin/roles-permissions*') ? 'active' : '' }}">
                            <a href="{{ route('admin.roles.index') }}" class="side-menu__item">
                                Roles & Permissions</a>
                        </li>
                    </ul>
                </li>

                <!-- Exam Management -->
                <li class="slide has-sub">                
                    <a href="javascript:void(0);" class="side-menu__item {{ request()->is('admin/exam-types*') || request()->is('admin/exam-sessions*') || request()->is('admin/exam-sections*') ? 'active open text-indigo' : '' }}">
                        <i class="ri ri-contract-line ri-13x me-2 lh-1"></i>
                        <span class="side-menu__label">Manage Exams</span>
                        <i class="ri-arrow-right-line side-menu__angle"></i> 
                    </a>                    
                    <ul class="slide-menu child1 {{ request()->is('admin/exam-types*') || request()->is('admin/exam-sessions*') || request()->is('admin/exam-sections*') ? 'double-menu-active' : '' }}">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Manage Exams</a>
                        </li>
                        <li class="slide {{ request()->is('admin/exam-types*') ? 'active' : '' }}">
                            <a href="{{ route('admin.exam-types.index') }}" class="side-menu__item">
                                Exam Types</a>
                        </li>
                        <li class="slide {{ request()->is('admin/exam-sessions*') ? 'active' : '' }}">
                            <a href="{{ route('admin.exam-sessions.active') }}" class="side-menu__item">
                                Exam Sessions</a>
                        </li>
                        <li class="slide {{ request()->is('admin/exam-sections*') ? 'active' : '' }}">
                            <a href="{{ route('admin.exam-sections.show', 1) }}" class="side-menu__item">
                                Exam Sections</a>
                        </li>
                    </ul>
                </li>

                <!-- Content Management -->
                <li class="slide has-sub">                
                    <a href="javascript:void(0);" class="side-menu__item {{ request()->is('admin/question-banks*') || request()->is('admin/questions*') || request()->is('admin/reading-passages*') || request()->is('admin/listening-audios*') || request()->is('admin/writing-prompts*') || request()->is('admin/speaking-questions*') || request()->is('admin/content-approval*') ? 'active open text-indigo' : '' }}">
                        <i class="ri ri-file-text-line ri-13x me-2 lh-1"></i>
                        <span class="side-menu__label">Manage Content</span>
                        <i class="ri-arrow-right-line side-menu__angle"></i>
                    </a>                    
                    <ul class="slide-menu child1 {{ request()->is('admin/question-banks*') || request()->is('admin/questions*') || request()->is('admin/reading-passages*') || request()->is('admin/listening-audios*') || request()->is('admin/writing-prompts*') || request()->is('admin/speaking-questions*') || request()->is('admin/content-approval*') ? 'double-menu-active' : '' }}">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Manage Content</a>
                        </li>
                        <li class="slide {{ request()->is('admin/question-banks*') ? 'active' : '' }}">
                            <a href="{{ route('admin.question-banks.index') }}" class="side-menu__item">
                                Question Banks</a>
                        </li>
                        <li class="slide {{ request()->is('admin/questions*') ? 'active' : '' }}">
                            <a href="{{ route('admin.questions.index') }}" class="side-menu__item">
                                Questions</a>
                        </li>
                        <li class="slide {{ request()->is('admin/reading-passages*') ? 'active' : '' }}">
                            <a href="{{ route('admin.reading-passages.index') }}" class="side-menu__item">
                                Reading Passages</a>
                        </li>
                        <li class="slide {{ request()->is('admin/listening-audios*') ? 'active' : '' }}">
                            <a href="{{ route('admin.listening-audios.index') }}" class="side-menu__item">
                                Listening Audios</a>
                        </li>
                        <li class="slide {{ request()->is('admin/writing-prompts*') ? 'active' : '' }}">
                            <a href="{{ route('admin.writing-prompts.index') }}" class="side-menu__item">
                                Writing Prompts</a>
                        </li>
                        <li class="slide {{ request()->is('admin/speaking-questions*') ? 'active' : '' }}">
                            <a href="{{ route('admin.speaking-questions.index') }}" class="side-menu__item">
                                Speaking Questions</a>
                        </li>
                        <li class="slide {{ request()->is('admin/content-approval*') ? 'active' : '' }}">
                            <a href="{{ route('admin.content-approval.pending') }}" class="side-menu__item">
                                Content Approval</a>
                        </li>
                    </ul>
                </li>

                <!-- Assessments -->
                <li class="slide has-sub">                
                    <a href="javascript:void(0);" class="side-menu__item {{ request()->is('admin/reading-assessments*') || request()->is('admin/listening-assessments*') || request()->is('admin/writing-assessments*') || request()->is('admin/speaking-assessments*') || request()->is('admin/score-history*') ? 'active open text-indigo' : '' }}">
                        <i class="ri ri-clipboard-line ri-13x me-2 lh-1"></i>
                        <span class="side-menu__label">Assessments</span>
                        <i class="ri-arrow-right-line side-menu__angle"></i>
                    </a>                    
                    <ul class="slide-menu child1 {{ request()->is('admin/reading-assessments*') || request()->is('admin/listening-assessments*') || request()->is('admin/writing-assessments*') || request()->is('admin/speaking-assessments*') || request()->is('admin/score-history*') ? 'double-menu-active' : '' }}">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Assessments</a>
                        </li>
                        <li class="slide {{ request()->is('admin/reading-assessments*') ? 'active' : '' }}">
                            <a href="{{ route('admin.reading-assessments.scores') }}" class="side-menu__item">
                                Reading</a>
                        </li>
                        <li class="slide {{ request()->is('admin/listening-assessments*') ? 'active' : '' }}">
                            <a href="{{ route('admin.listening-assessments.scores') }}" class="side-menu__item">
                                Listening</a>
                        </li>
                        <li class="slide {{ request()->is('admin/writing-assessments*') ? 'active' : '' }}">
                            <a href="{{ route('admin.writing-assessments.index') }}" class="side-menu__item">
                                Writing</a>
                        </li>
                        <li class="slide {{ request()->is('admin/speaking-assessments*') ? 'active' : '' }}">
                            <a href="{{ route('admin.speaking-assessments.index') }}" class="side-menu__item">
                                Speaking Assessments</a>
                        </li>
                        <li class="slide {{ request()->is('admin/score-history*') ? 'active' : '' }}">
                            <a href="{{ route('admin.score-history.index', 1) }}" class="side-menu__item">
                                Score History</a>
                        </li>
                    </ul>
                </li>

                <!-- Analytics & Reporting -->
                <li class="slide has-sub">                
                    <a href="javascript:void(0);" class="side-menu__item {{ request()->is('admin/analytics*') ? 'active open text-indigo' : '' }}">
                        <i class="ri ri-bar-chart-line ri-13x me-2 lh-1"></i>
                        <span class="side-menu__label">Analytics</span>
                        <i class="ri-arrow-right-line side-menu__angle"></i>
                    </a>                    
                    <ul class="slide-menu child1 {{ request()->is('admin/analytics*') ? 'double-menu-active' : '' }}">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Analytics</a>
                        </li>
                        <li class="slide {{ request()->is('admin/analytics/users') ? 'active' : '' }}">
                            <a href="{{ route('admin.analytics.users') }}" class="side-menu__item">
                                User Analytics</a>
                        </li>
                        <li class="slide {{ request()->is('admin/analytics/exams') ? 'active' : '' }}">
                            <a href="{{ route('admin.analytics.exams') }}" class="side-menu__item">
                                Exam Analytics</a>
                        </li>
                        <li class="slide {{ request()->is('admin/analytics/system') ? 'active' : '' }}">
                            <a href="{{ route('admin.analytics.system') }}" class="side-menu__item">
                                System Analytics</a>
                        </li>
                        <li class="slide {{ request()->is('admin/analytics/learning') ? 'active' : '' }}">
                            <a href="{{ route('admin.analytics.learning') }}" class="side-menu__item">
                                Learning Analytics</a>
                        </li>
                    </ul>
                </li>

                <!-- Notifications -->
                <li class="slide has-sub">                
                    <a href="javascript:void(0);" class="side-menu__item {{ request()->is('admin/notifications*') ? 'active open text-indigo' : '' }}">
                        <i class="ri ri-notification-3-line ri-13x me-2 lh-1"></i>
                        <span class="side-menu__label">Notifications</span>
                        <i class="ri-arrow-right-line side-menu__angle"></i>
                    </a>                    
                    <ul class="slide-menu child1 {{ request()->is('admin/notifications*') ? 'double-menu-active' : '' }}">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Notification Management</a>
                        </li>
                        <li class="slide {{ request()->is('admin/notifications/email*') ? 'active' : '' }}">
                            <a href="{{ route('admin.notifications.email.templates') }}" class="side-menu__item">
                                Email Templates</a>
                        </li>
                        <li class="slide {{ request()->is('admin/notifications/in-app*') ? 'active' : '' }}">
                            <a href="{{ route('admin.notifications.in-app.history') }}" class="side-menu__item">
                                In-App Notifications</a>
                        </li>
                        <li class="slide {{ request()->is('admin/notifications/sms*') ? 'active' : '' }}">
                            <a href="{{ route('admin.notifications.sms.templates') }}" class="side-menu__item">
                                SMS Templates</a>
                        </li>
                        <li class="slide {{ request()->is('admin/notifications/push*') ? 'active' : '' }}">
                            <a href="{{ route('admin.notifications.push.logs') }}" class="side-menu__item">
                                Push Notifications</a>
                        </li>
                    </ul>
                </li>

                <!-- Payments -->
                <li class="slide has-sub">                
                    <a href="javascript:void(0);" class="side-menu__item {{ request()->is('admin/payments*') ? 'active open text-indigo' : '' }}">
                        <i class="ri ri-money-dollar-circle-line ri-13x me-2 lh-1"></i>
                        <span class="side-menu__label">Payments</span>
                        <i class="ri-arrow-right-line side-menu__angle"></i>
                    </a>                    
                    <ul class="slide-menu child1 {{ request()->is('admin/payments*') ? 'double-menu-active' : '' }}">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Payment Management</a>
                        </li>
                        <li class="slide {{ request()->is('admin/payments/plans') ? 'active' : '' }}">
                            <a href="{{ route('admin.payments.plans') }}" class="side-menu__item">
                                Plans</a>
                        </li>
                        <li class="slide {{ request()->is('admin/payments/history') ? 'active' : '' }}">
                            <a href="{{ route('admin.payments.history') }}" class="side-menu__item">
                                Payment History</a>
                        </li>
                        <li class="slide {{ request()->is('admin/payments/refunds') ? 'active' : '' }}">
                            <a href="{{ route('admin.payments.refunds') }}" class="side-menu__item">
                                Refunds</a>
                        </li>
                        <li class="slide {{ request()->is('admin/payments/coupons*') ? 'active' : '' }}">
                            <a href="{{ route('admin.payments.coupons.usage') }}" class="side-menu__item">
                                Coupons</a>
                        </li>
                    </ul>
                </li>

                <!-- System Settings -->
                <li class="slide has-sub">                
                    <a href="javascript:void(0);" class="side-menu__item {{ request()->is('admin/settings*') || request()->is('admin/future-enhancements*') ? 'active open text-indigo' : '' }}">
                        <i class="ri ri-settings-3-line ri-13x me-2 lh-1"></i>
                        <span class="side-menu__label">System</span>
                        <i class="ri-arrow-right-line side-menu__angle"></i>
                    </a>                    
                    <ul class="slide-menu child1 {{ request()->is('admin/settings*') || request()->is('admin/future-enhancements*') ? 'double-menu-active' : '' }}">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">System Management</a>
                        </li>
                        <li class="slide {{ request()->is('admin/settings/general') ? 'active' : '' }}">
                            <a href="{{ route('admin.settings.general') }}" class="side-menu__item">
                                General Settings</a>
                        </li>
                        <li class="slide {{ request()->is('admin/settings/security') ? 'active' : '' }}">
                            <a href="{{ route('admin.settings.security') }}" class="side-menu__item">
                                Security Settings</a>
                        </li>
                        <li class="slide {{ request()->is('admin/settings/integrations') ? 'active' : '' }}">
                            <a href="{{ route('admin.settings.integrations') }}" class="side-menu__item">
                                Integrations</a>
                        </li>
                        <li class="slide {{ request()->is('admin/settings/exam-integrity') ? 'active' : '' }}">
                            <a href="{{ route('admin.settings.exam-integrity') }}" class="side-menu__item">
                                Exam Integrity</a>
                        </li>
                        <li class="slide {{ request()->is('admin/settings/maintenance') ? 'active' : '' }}">
                            <a href="{{ route('admin.settings.maintenance') }}" class="side-menu__item">
                                Maintenance</a>
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
<style>
    .ri-13x{
        font-size:1.3rem;        
    }    
    .app-sidebar a.side-menu__item.active{        
        font-weight: 600;
    }
    [data-vertical-style="overlay"][data-toggled="icon-overlay-close"]:not([data-icon-overlay="open"]) .app-sidebar .main-menu{
        padding-inline:0.3rem;
    }
</style>
