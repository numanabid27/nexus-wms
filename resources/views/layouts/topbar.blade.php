<div class="menu-wrapper">
    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header" id="navbar-header">
                <div class="d-flex" id="header-logo">
                    <!-- LOGO -->
                    <div class="navbar-brand-box horizontal-logo">
                        <a href="#" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('asset/images/logos/logo-sm.png') }}" alt="" height="45">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('asset/images/logos/logo-dark.png') }}" alt=""
                                    height="35">
                            </span>
                        </a>

                        <a href="#" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('asset/images/logos/logo-sm.png') }}" alt="" height="45">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('asset/images/logos/logo-light.png') }}" alt=""
                                    height="35">
                            </span>
                        </a>
                    </div>

                    <button type="button"
                        class="btn btn-sm px-3 header-item vertical-menu-btn topnav-hamburger shadow-none"
                        id="topnav-hamburger-icon">
                        <span class="hamburger-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>

                </div>
                <!-- ========== App Menu ========== -->
                <div class="app-menu navbar-menu mx-auto">
                    <div id="scrollbar">
                        <ul class="navbar-nav" id="navbar-nav">
                            @if(auth()->user()->can('invoice-setup') || auth()->user()->can('skip-setup'))
                            
                            <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#tabSettings"
                                    data-bs-toggle="collapse" role="button" aria-expanded="false"
                                    aria-controls="tabSettings">
                                    <i class="ph-gear"></i> <span>{{ __('settings') }}</span>
                                </a>
                                <div class="collapse menu-dropdown" id="tabSettings">
                                    <ul class="nav nav-sm flex-column">
                                        @can('invoice-setup')
                                        <li class="nav-item">
                                            <a href="{{ route('settings') }}" class="nav-link">{{ __('invoice_setup') }} </a>
                                        </li>
                                        @endcan
                                        @can('skip-setup')
                                        <li class="nav-item">
                                            <a href="{{ route('skip_setup') }}" class="nav-link">{{ __('skip_setup') }} </a>
                                        </li>
                                        @endcan
                                    </ul>
                                </div>
                            </li>
                            
                            @endif
                            @can('customer-list')
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('customer.index') }}">
                                    <i class="ph-buildings-bold"></i> <span>{{ __('customers') }}</span>
                                </a>
                            </li>
                            @endcan
                            @can('employee-list')
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('employee.index') }}">
                                    <i class="ph-users"></i> <span>{{ __('employees') }}</span>
                                </a>
                            </li>
                            @endcan
                            @can('vehicle-list')
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('vehicles.index') }}">
                                    <i class="ph-truck"></i> <span>{{ __('vehicles') }}</span>
                                </a>
                            </li>
                            @endcan
                            @can('billing-list')
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('billings.index') }}">
                                    <i class="ph-file-text"></i> <span>{{ __('billings') }}</span>
                                </a>
                            </li>
                            @endcan
                            @can('reporting')
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('report') }}">
                                    <i class="ph-files"></i> <span>{{ __('reports') }}</span>
                                </a>
                            </li>
                            @endcan
                            @can('company-list')
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('company.index') }}">
                                    <i class="ph-buildings"></i> <span>{{ __('company') }}</span>
                                </a>
                            </li>
                            @endcan
                            @can('user-list')
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('users.index') }}">
                                    <i class="ph-users"></i> <span>{{ __('users') }}</span>
                                </a>
                            </li>
                            @endcan

                            @if(auth()->user()->can('role-list'))
                            <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sidebarSettings"
                                    data-bs-toggle="collapse" role="button" aria-expanded="false"
                                    aria-controls="sidebarSettings">
                                    <i class="ph-gear"></i> <span>{{ __('settings') }}</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarSettings">
                                    <ul class="nav nav-sm flex-column">
                                        @can('role-list')
                                        <li class="nav-item">
                                            <a href="{{ route('roles.index') }}" class="nav-link">{{ __('manage_roles') }} </a>
                                        </li>
                                        @endcan
                                    </ul>
                                </div>
                            </li>
                            @endif
                        </ul>
                        <!--<ul class="navbar-nav" id="navbar-nav">-->
                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link menu-link collapsed" href="#sidebarDashboards"-->
                        <!--            data-bs-toggle="collapse" role="button" aria-expanded="false"-->
                        <!--            aria-controls="sidebarDashboards">-->
                        <!--            <i class="ph-gauge"></i> <span>{{ __('t-dashboards') }}</span>-->
                        <!--        </a>-->
                        <!--        <div class="collapse menu-dropdown" id="sidebarDashboards">-->
                        <!--            <ul class="nav nav-sm flex-column">-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="dashboard-analytics" class="nav-link">{{ __('t-analytics') }} </a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="dashboard-crypto" class="nav-link">{{ __('t-crypto') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="index" class="nav-link">{{ __('t-ecommerce') }}</a>-->
                        <!--                </li>-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </li>-->

                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link menu-link collapsed" href="#topbarApps" data-bs-toggle="collapse"-->
                        <!--            role="button" aria-expanded="false" aria-controls="topbarApps">-->
                        <!--            <i class="ph-layout"></i> <span>{{ __('t-apps') }}</span>-->
                        <!--        </a>-->
                        <!--        <div class="collapse menu-dropdown" id="topbarApps">-->
                        <!--            <ul class="nav nav-sm flex-column">-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="apps-calendar" class="nav-link">{{ __('t-calendar') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="#sidebarChat" class="nav-link" data-bs-toggle="collapse"-->
                        <!--                        role="button" aria-expanded="false" aria-controls="sidebarChat">-->
                        <!--                        {{ __('t-chat') }} </a>-->
                        <!--                    <div class="collapse menu-dropdown" id="sidebarChat">-->
                        <!--                        <ul class="nav nav-sm flex-column">-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="apps-chat"-->
                        <!--                                    class="nav-link">{{ __('t-single-chat') }}</a>-->
                        <!--                            </li>-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="apps-chat-video-conference"-->
                        <!--                                    class="nav-link">{{ __('t-video-conference') }}</a>-->
                        <!--                            </li>-->
                        <!--                        </ul>-->
                        <!--                    </div>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="#topbarCrypto" class="nav-link" data-bs-toggle="collapse"-->
                        <!--                        role="button" aria-expanded="false" aria-controls="topbarCrypto">-->
                        <!--                        {{ __('t-crypto') }} </a>-->
                        <!--                    <div class="collapse menu-dropdown" id="topbarCrypto">-->
                        <!--                        <ul class="nav nav-sm flex-column">-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="apps-crypto-marketplace"-->
                        <!--                                    class="nav-link">{{ __('t-marketplace') }}</a>-->
                        <!--                            </li>-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="apps-crypto-exchange"-->
                        <!--                                    class="nav-link">{{ __('t-exchange') }}</a>-->
                        <!--                            </li>-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="apps-crypto-ico"-->
                        <!--                                    class="nav-link">{{ __('t-ico') }}</a>-->
                        <!--                            </li>-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="apps-crypto-transactions"-->
                        <!--                                    class="nav-link">{{ __('t-transactions') }}</a>-->
                        <!--                            </li>-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="apps-crypto-coin-overview"-->
                        <!--                                    class="nav-link">{{ __('t-coin-overview') }}</a>-->
                        <!--                            </li>-->
                        <!--                        </ul>-->
                        <!--                    </div>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="#topbarCustomer" class="nav-link" data-bs-toggle="collapse"-->
                        <!--                        role="button" aria-expanded="false" aria-controls="topbarCustomer">-->
                        <!--                        {{ __('t-customers') }} </a>-->
                        <!--                    <div class="collapse menu-dropdown" id="topbarCustomer">-->
                        <!--                        <ul class="nav nav-sm flex-column">-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="apps-customers-list"-->
                        <!--                                    class="nav-link">{{ __('t-list-view') }}</a>-->
                        <!--                            </li>-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="apps-customers-overview"-->
                        <!--                                    class="nav-link">{{ __('t-overview') }}</a>-->
                        <!--                            </li>-->
                        <!--                        </ul>-->
                        <!--                    </div>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="apps-file-manager"-->
                        <!--                        class="nav-link">{{ __('t-file-manager') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="#topbarInvoice" class="nav-link" data-bs-toggle="collapse"-->
                        <!--                        role="button" aria-expanded="false" aria-controls="topbarInvoice">-->
                        <!--                        {{ __('t-invoices') }} </a>-->
                        <!--                    <div class="collapse menu-dropdown" id="topbarInvoice">-->
                        <!--                        <ul class="nav nav-sm flex-column">-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="apps-invoices-list"-->
                        <!--                                    class="nav-link">{{ __('t-list-view') }}</a>-->
                        <!--                            </li>-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="apps-invoices-create"-->
                        <!--                                    class="nav-link">{{ __('t-create-invoice') }}</a>-->
                        <!--                            </li>-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="apps-invoices-overview"-->
                        <!--                                    class="nav-link">{{ __('t-overview') }}</a>-->
                        <!--                            </li>-->
                        <!--                        </ul>-->
                        <!--                    </div>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="apps-notes" class="nav-link">{{ __('t-notes') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="apps-to-do" class="nav-link">{{ __('t-to-do') }}</a>-->
                        <!--                </li>-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </li>-->

                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link menu-link collapsed" href="#sidebarPages"-->
                        <!--            data-bs-toggle="collapse" role="button" aria-expanded="false"-->
                        <!--            aria-controls="sidebarPages">-->
                        <!--            <i class="ph-address-book"></i> <span>{{ __('t-pages') }}</span>-->
                        <!--        </a>-->
                        <!--        <div class="collapse menu-dropdown" id="sidebarPages">-->
                        <!--            <ul class="nav nav-sm flex-column">-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="pages-starter" class="nav-link">{{ __('t-starter') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="pages-profile" class="nav-link">{{ __('t-profile') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="pages-timeline" class="nav-link">{{ __('t-timeline') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="pages-faqs" class="nav-link">{{ __('t-faqs') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="pages-pricing" class="nav-link">{{ __('t-pricing') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a class="nav-link collapsed" href="#sidebarAuth"-->
                        <!--                        data-bs-toggle="collapse" role="button" aria-expanded="false"-->
                        <!--                        aria-controls="sidebarAuth">-->
                        <!--                        <span>{{ __('t-authentication') }}</span>-->
                        <!--                    </a>-->
                        <!--                    <div class="collapse menu-dropdown" id="sidebarAuth">-->
                        <!--                        <ul class="nav nav-sm flex-column">-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="auth-signin" class="nav-link" role="button">-->
                        <!--                                    {{ __('t-signin') }} </a>-->
                        <!--                            </li>-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="auth-signup" class="nav-link" role="button">-->
                        <!--                                    {{ __('t-signup') }} </a>-->
                        <!--                            </li>-->

                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="auth-pass-reset" class="nav-link" role="button">-->
                        <!--                                    {{ __('t-password-reset') }}-->
                        <!--                                </a>-->
                        <!--                            </li>-->

                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="auth-pass-change" class="nav-link" role="button">-->
                        <!--                                    {{ __('t-password-create') }}-->
                        <!--                                </a>-->
                        <!--                            </li>-->

                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="auth-lockscreen" class="nav-link" role="button">-->
                        <!--                                    {{ __('t-lock-screen') }}-->
                        <!--                                </a>-->
                        <!--                            </li>-->

                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="auth-logout" class="nav-link" role="button">-->
                        <!--                                    {{ __('t-logout') }} </a>-->
                        <!--                            </li>-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="auth-success-msg" class="nav-link" role="button">-->
                        <!--                                    {{ __('t-success-message') }} </a>-->
                        <!--                            </li>-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="auth-twostep" class="nav-link" role="button">-->
                        <!--                                    {{ __('t-two-step-verification') }}-->
                        <!--                                </a>-->
                        <!--                            </li>-->
                        <!--                        </ul>-->
                        <!--                    </div>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="#sidebarErrors" class="nav-link" data-bs-toggle="collapse"-->
                        <!--                        role="button" aria-expanded="false" aria-controls="sidebarErrors">-->
                        <!--                        {{ __('t-errors') }} </a>-->
                        <!--                    <div class="collapse menu-dropdown" id="sidebarErrors">-->
                        <!--                        <ul class="nav nav-sm flex-column">-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="auth-404"-->
                        <!--                                    class="nav-link">{{ __('t-404-error') }}</a>-->
                        <!--                            </li>-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="auth-500" class="nav-link">{{ __('t-500') }}</a>-->
                        <!--                            </li>-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="auth-503" class="nav-link">{{ __('t-503') }}</a>-->
                        <!--                            </li>-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="auth-offline"-->
                        <!--                                    class="nav-link">{{ __('t-offline-page') }}</a>-->
                        <!--                            </li>-->
                        <!--                        </ul>-->
                        <!--                    </div>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="pages-maintenance"-->
                        <!--                        class="nav-link">{{ __('t-maintenance') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="pages-coming-soon"-->
                        <!--                        class="nav-link">{{ __('t-coming-soon') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="pages-privacy-policy"-->
                        <!--                        class="nav-link">{{ __('t-privacy-policy') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="pages-term-conditions"-->
                        <!--                        class="nav-link">{{ __('t-term-conditions') }}</a>-->
                        <!--                </li>-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </li>-->

                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link menu-link collapsed" href="#sidebarUI" data-bs-toggle="collapse"-->
                        <!--            role="button" aria-expanded="false" aria-controls="sidebarUI">-->
                        <!--            <i class="ph-bandaids"></i> <span>{{ __('t-bootstrap-ui') }}</span>-->
                        <!--        </a>-->
                        <!--        <div class="collapse menu-dropdown mega-dropdown-menu" id="sidebarUI">-->
                        <!--            <div class="row">-->
                        <!--                <div class="col-lg-4">-->
                        <!--                    <ul class="nav nav-sm flex-column">-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-accordions"-->
                        <!--                                class="nav-link">{{ __('t-accordion-collapse') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-alerts" class="nav-link">{{ __('t-alerts') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-badges" class="nav-link">{{ __('t-badges') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-buttons" class="nav-link">{{ __('t-buttons') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-cards" class="nav-link">{{ __('t-cards') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-carousel" class="nav-link">{{ __('t-carousel') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-colors" class="nav-link">{{ __('t-colors') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-dropdowns"-->
                        <!--                                class="nav-link">{{ __('t-dropdowns') }}</a>-->
                        <!--                        </li>-->
                        <!--                    </ul>-->
                        <!--                </div>-->
                        <!--                <div class="col-lg-4">-->
                        <!--                    <ul class="nav nav-sm flex-column">-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-embed-video"-->
                        <!--                                class="nav-link">{{ __('t-embed-video') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-general" class="nav-link">{{ __('t-general') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-grid" class="nav-link">{{ __('t-grid') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-images" class="nav-link">{{ __('t-images') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-links" class="nav-link">{{ __('t-links') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-lists" class="nav-link">{{ __('t-lists') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-media"-->
                        <!--                                class="nav-link">{{ __('t-media-object') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-modals" class="nav-link">{{ __('t-modals') }}</a>-->
                        <!--                        </li>-->
                        <!--                    </ul>-->
                        <!--                </div>-->
                        <!--                <div class="col-lg-4">-->
                        <!--                    <ul class="nav nav-sm flex-column">-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-notifications"-->
                        <!--                                class="nav-link">{{ __('t-notifications') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-offcanvas"-->
                        <!--                                class="nav-link">{{ __('t-offcanvas') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-placeholders"-->
                        <!--                                class="nav-link">{{ __('t-placeholders') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-progress" class="nav-link">{{ __('t-progress') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-scrollspy"-->
                        <!--                                class="nav-link">{{ __('t-scrollSpy') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-tabs" class="nav-link">{{ __('t-tabs') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-typography"-->
                        <!--                                class="nav-link">{{ __('t-typography') }}</a>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item">-->
                        <!--                            <a href="ui-utilities"-->
                        <!--                                class="nav-link">{{ __('t-utilities') }}</a>-->
                        <!--                        </li>-->
                        <!--                    </ul>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </li>-->

                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link menu-link collapsed" href="#sidebarAdvanceUI"-->
                        <!--            data-bs-toggle="collapse" role="button" aria-expanded="false"-->
                        <!--            aria-controls="sidebarAdvanceUI">-->
                        <!--            <i class="ph-stack-simple"></i> <span>{{ __('t-advance-ui') }}</span>-->
                        <!--        </a>-->
                        <!--        <div class="collapse menu-dropdown" id="sidebarAdvanceUI">-->
                        <!--            <ul class="nav nav-sm flex-column">-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="advance-ui-crop-images"-->
                        <!--                        class="nav-link">{{ __('t-crop-images') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="advance-ui-highlight"-->
                        <!--                        class="nav-link">{{ __('t-highlight') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="advance-ui-nestable"-->
                        <!--                        class="nav-link">{{ __('t-nestable-list') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="advance-ui-ratings" class="nav-link">{{ __('t-ratings') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="advance-ui-scrollbar"-->
                        <!--                        class="nav-link">{{ __('t-scrollbar') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="advance-ui-sweetalerts"-->
                        <!--                        class="nav-link">{{ __('t-sweet-alerts') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="advance-ui-swiper"-->
                        <!--                        class="nav-link">{{ __('t-swiper-slider') }}</a>-->
                        <!--                </li>-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </li>-->

                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link menu-link" href="widgets">-->
                        <!--            <i class="ph-paint-brush-broad"></i> <span>{{ __('t-widgets') }}</span>-->
                        <!--        </a>-->
                        <!--    </li>-->

                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link menu-link collapsed" href="#sidebarForms"-->
                        <!--            data-bs-toggle="collapse" role="button" aria-expanded="false"-->
                        <!--            aria-controls="sidebarForms">-->
                        <!--            <i class="ri-file-list-3-line"></i> <span>{{ __('t-forms') }}</span>-->
                        <!--        </a>-->
                        <!--        <div class="collapse menu-dropdown" id="sidebarForms">-->
                        <!--            <ul class="nav nav-sm flex-column">-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="forms-elements"-->
                        <!--                        class="nav-link">{{ __('t-basic-elements') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="forms-select" class="nav-link">{{ __('t-form-select') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="forms-checkboxs-radios"-->
                        <!--                        class="nav-link">{{ __('t-checkboxes-radios') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="forms-pickers" class="nav-link">{{ __('t-pickers') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="forms-masks" class="nav-link">{{ __('t-input-masks') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="forms-advanced" class="nav-link">{{ __('t-advanced') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="forms-range-sliders"-->
                        <!--                        class="nav-link">{{ __('t-range-slider') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="forms-validation" class="nav-link">{{ __('t-validation') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="forms-wizard" class="nav-link">{{ __('t-wizard') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="forms-editors" class="nav-link">{{ __('t-editors') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="forms-file-uploads"-->
                        <!--                        class="nav-link">{{ __('t-file-uploads') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="forms-layouts" class="nav-link">{{ __('t-form-layouts') }}</a>-->
                        <!--                </li>-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </li>-->

                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link menu-link collapsed" href="#sidebarTables"-->
                        <!--            data-bs-toggle="collapse" role="button" aria-expanded="false"-->
                        <!--            aria-controls="sidebarTables">-->
                        <!--            <i class="ph-table"></i> <span>{{ __('t-tables') }}</span>-->
                        <!--        </a>-->
                        <!--        <div class="collapse menu-dropdown" id="sidebarTables">-->
                        <!--            <ul class="nav nav-sm flex-column">-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="tables-basic" class="nav-link">{{ __('t-basic-tables') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="tables-gridjs" class="nav-link">{{ __('t-grid-js') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="tables-listjs" class="nav-link">{{ __('t-list-js') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="tables-datatables"-->
                        <!--                        class="nav-link">{{ __('t-datatables') }}</a>-->
                        <!--                </li>-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </li>-->

                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link menu-link collapsed" href="#sidebarCharts"-->
                        <!--            data-bs-toggle="collapse" role="button" aria-expanded="false"-->
                        <!--            aria-controls="sidebarCharts">-->
                        <!--            <i class="ph-chart-pie-slice"></i> <span>{{ __('t-apexcharts') }}</span>-->
                        <!--        </a>-->
                        <!--        <div class="collapse menu-dropdown" id="sidebarCharts">-->
                        <!--            <ul class="nav nav-sm flex-column">-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="charts-apex-area" class="nav-link">{{ __('t-area') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="charts-apex-bar" class="nav-link">{{ __('t-bar') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="charts-apex-boxplot" class="nav-link">{{ __('t-boxplot') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="charts-apex-bubble" class="nav-link">{{ __('t-bubble') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="charts-apex-candlestick"-->
                        <!--                        class="nav-link">{{ __('t-candlstick') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="charts-apex-column" class="nav-link">{{ __('t-column') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="charts-apex-heatmap" class="nav-link">{{ __('t-heatmap') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="charts-apex-line" class="nav-link">{{ __('t-line') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="charts-apex-mixed" class="nav-link">{{ __('t-mixed') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="charts-apex-pie" class="nav-link">{{ __('t-pie') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="charts-apex-polar"-->
                        <!--                        class="nav-link">{{ __('t-polar-area') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="charts-apex-radar" class="nav-link">{{ __('t-radar') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="charts-apex-radialbar"-->
                        <!--                        class="nav-link">{{ __('t-radialbar') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="charts-apex-range-area"-->
                        <!--                        class="nav-link">{{ __('t-range-area') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="charts-apex-scatter" class="nav-link">{{ __('t-scatter') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="charts-apex-timeline"-->
                        <!--                        class="nav-link">{{ __('t-timeline') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="charts-apex-treemap" class="nav-link">{{ __('t-treemap') }}</a>-->
                        <!--                </li>-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </li>-->

                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link menu-link collapsed" href="#sidebarIcons"-->
                        <!--            data-bs-toggle="collapse" role="button" aria-expanded="false"-->
                        <!--            aria-controls="sidebarIcons">-->
                        <!--            <i class="ph-traffic-cone"></i> <span>{{ __('t-icons') }}</span>-->
                        <!--        </a>-->
                        <!--        <div class="collapse menu-dropdown" id="sidebarIcons">-->
                        <!--            <ul class="nav nav-sm flex-column">-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="icons-bootstrap" class="nav-link">{{ __('t-bootstrap') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="icons-boxicons" class="nav-link">{{ __('t-boxicons') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="icons-phosphor" class="nav-link">{{ __('t-phosphor') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="icons-remix" class="nav-link">{{ __('t-remix') }}</a>-->
                        <!--                </li>-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </li>-->

                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link menu-link collapsed" href="#sidebarMaps" data-bs-toggle="collapse"-->
                        <!--            role="button" aria-expanded="false" aria-controls="sidebarMaps">-->
                        <!--            <i class="ph-map-trifold"></i> <span>{{ __('t-maps') }}</span>-->
                        <!--        </a>-->
                        <!--        <div class="collapse menu-dropdown" id="sidebarMaps">-->
                        <!--            <ul class="nav nav-sm flex-column">-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="maps-google" class="nav-link">{{ __('t-google') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="maps-leaflet" class="nav-link">{{ __('t-leaflet') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="maps-vector" class="nav-link">{{ __('t-vector') }}</a>-->
                        <!--                </li>-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </li>-->
                        <!--    <li class="nav-item">-->
                        <!--        <a class="nav-link menu-link" href="#sidebarMultilevel" data-bs-toggle="collapse"-->
                        <!--            role="button" aria-expanded="false" aria-controls="sidebarMultilevel">-->
                        <!--            <i class="bi bi-share"></i> <span>{{ __('t-multi-level') }}</span>-->
                        <!--        </a>-->
                        <!--        <div class="collapse menu-dropdown" id="sidebarMultilevel">-->
                        <!--            <ul class="nav nav-sm flex-column">-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="#" class="nav-link">{{ __('t-level-1.1') }}</a>-->
                        <!--                </li>-->
                        <!--                <li class="nav-item">-->
                        <!--                    <a href="#sidebarAccount" class="nav-link" data-bs-toggle="collapse"-->
                        <!--                        role="button" aria-expanded="false"-->
                        <!--                        aria-controls="sidebarAccount">{{ __('t-level-1.2') }}-->
                        <!--                    </a>-->
                        <!--                    <div class="collapse menu-dropdown" id="sidebarAccount">-->
                        <!--                        <ul class="nav nav-sm flex-column">-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="#" class="nav-link">{{ __('t-level-2.1') }}-->
                        <!--                                </a>-->
                        <!--                            </li>-->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a href="#sidebarCrm" class="nav-link"-->
                        <!--                                    data-bs-toggle="collapse" role="button"-->
                        <!--                                    aria-expanded="false" aria-controls="sidebarCrm">-->
                        <!--                                    {{ __('t-level-2.2') }}-->
                        <!--                                </a>-->
                        <!--                                <div class="collapse menu-dropdown" id="sidebarCrm">-->
                        <!--                                    <ul class="nav nav-sm flex-column">-->
                        <!--                                        <li class="nav-item">-->
                        <!--                                            <a href="#" class="nav-link">-->
                        <!--                                                {{ __('t-level-3.1') }}-->
                        <!--                                            </a>-->
                        <!--                                        </li>-->
                        <!--                                        <li class="nav-item">-->
                        <!--                                            <a href="#" class="nav-link">-->
                        <!--                                                {{ __('t-level-3.2') }}</a>-->
                        <!--                                        </li>-->
                        <!--                                    </ul>-->
                        <!--                                </div>-->
                        <!--                            </li>-->
                        <!--                        </ul>-->
                        <!--                    </div>-->
                        <!--                </li>-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </li>-->

                        <!--</ul>-->
                    </div>
                </div>

                <div class="d-flex align-items-center" id="header-items">

                    <!--<div class="dropdown ms-1 topbar-head-dropdown header-item">-->
                    <!--    <button type="button" class="btn btn-icon btn-topbar rounded-circle"-->
                    <!--        id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"-->
                    <!--        aria-expanded="false">-->
                    <!--        <i class="bx bx-search align-middle fs-3xl"></i>-->
                    <!--    </button>-->
                    <!--    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"-->
                    <!--        aria-labelledby="page-header-search-dropdown">-->
                    <!--        <form class="p-3">-->
                    <!--            <div class="form-group m-0">-->
                    <!--                <div class="input-group">-->
                    <!--                    <input type="text" class="form-control" placeholder="Search ..."-->
                    <!--                        aria-label="Recipient's username">-->
                    <!--                    <button class="btn btn-primary" type="submit"><i-->
                    <!--                            class="bi bi-search"></i></button>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </form>-->
                    <!--    </div>-->
                    <!--</div>-->

                    <div class="dropdown ms-1 topbar-head-dropdown header-item">
                        <button type="button" class="btn btn-icon btn-topbar rounded-circle"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if(!empty(Session::get('lang')))
                            {{ strtoupper(Session::get('lang')) }}
                            @else
                            EN
                            @endif
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">

                            <!-- item-->
                            <a href="{{ url('index/en') }}" class="dropdown-item notify-item py-2" data-lang="en"
                                title="English">
                                <!--<img src="https://img.themesbrand.com/judia/flags/us.svg" alt="user-image"-->
                                <!--    class="me-2 rounded" height="18">-->
                                <span class="align-middle">English</span>
                            </a>

                            <!-- item-->
                            <a href="{{ url('index/sp') }}" class="dropdown-item notify-item" data-lang="sp"
                                title="Spanish">
                                <!--<img src="https://img.themesbrand.com/judia/flags/spain.svg" alt="user-image"-->
                                <!--    class="me-2 rounded" height="18">-->
                                <span class="align-middle">Española</span>
                            </a>

                            <!-- item-->
                            <a href="{{ url('index/gr') }}" class="dropdown-item notify-item" data-lang="gr"
                                title="German">
                                <!--<img src="https://img.themesbrand.com/judia/flags/germany.svg" alt="user-image"-->
                                <!--    class="me-2 rounded" height="18">-->
                                    <span class="align-middle">Deutsche</span>
                            </a>

                            <!-- item-->
                            <a href="{{ url('index/it') }}" class="dropdown-item notify-item" data-lang="it"
                                title="Italian">
                                <!--<img src="https://img.themesbrand.com/judia/flags/italy.svg" alt="user-image"-->
                                <!--    class="me-2 rounded" height="18">-->
                                <span class="align-middle">Italiana</span>
                            </a>

                            <!-- item-->
                            <a href="{{ url('index/ru') }}" class="dropdown-item notify-item" data-lang="ru"
                                title="Russian">
                                <!--<img src="https://img.themesbrand.com/judia/flags/russia.svg" alt="user-image"-->
                                <!--    class="me-2 rounded" height="18">-->
                                <span class="align-middle">русский</span>
                            </a>

                            <!-- item-->
                            <a href="{{ url('index/ch') }}" class="dropdown-item notify-item" data-lang="ch"
                                title="Chinese">
                                <!--<img src="https://img.themesbrand.com/judia/flags/china.svg" alt="user-image"-->
                                <!--    class="me-2 rounded" height="18">-->
                                <span class="align-middle">中国人</span>
                            </a>

                            <!-- item-->
                            <a href="{{ url('index/fr') }}" class="dropdown-item notify-item" data-lang="fr"
                                title="French">
                                <!--<img src="https://img.themesbrand.com/judia/flags/french.svg" alt="user-image"-->
                                <!--    class="me-2 rounded" height="18">-->
                                <span class="align-middle">français</span>
                            </a>

                            <!-- item-->
                            <a href="{{ url('index/ar') }}" class="dropdown-item notify-item" data-lang="ar"
                                title="Arabic">
                                <!--<img src="https://img.themesbrand.com/judia/flags/ae.svg" alt="user-image"-->
                                <!--    class="me-2 rounded" height="18">-->
                                <span class="align-middle">عربي</span>
                            </a>
                        </div>
                    </div>

                    <!--<div class="dropdown topbar-head-dropdown ms-1 header-item">-->
                    <!--    <button type="button" class="btn btn-icon btn-topbar rounded-circle mode-layout"-->
                    <!--        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                    <!--        <i class="bi bi-sun align-middle fs-3xl"></i>-->
                    <!--    </button>-->
                    <!--    <div class="dropdown-menu p-2 dropdown-menu-end" id="light-dark-mode">-->
                    <!--        <a href="#!" class="dropdown-item" data-mode="light"><i-->
                    <!--                class="bi bi-sun align-middle me-2"></i> Default (light mode)</a>-->
                    <!--        <a href="#!" class="dropdown-item" data-mode="dark"><i-->
                    <!--                class="bi bi-moon align-middle me-2"></i> Dark</a>-->
                    <!--        <a href="#!" class="dropdown-item" data-mode="brand"><i-->
                    <!--                class="bi bi-award align-middle me-2"></i> Brand</a>-->
                    <!--        <a href="#!" class="dropdown-item" data-mode="auto"><i-->
                    <!--                class="bi bi-moon-stars align-middle me-2"></i> Auto (system default)</a>-->
                    <!--    </div>-->
                    <!--</div>-->

                    <!--<div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">-->
                    <!--    <button type="button" class="btn btn-icon btn-topbar rounded-circle"-->
                    <!--        id="page-header-notifications-dropdown" data-bs-toggle="dropdown"-->
                    <!--        data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">-->
                    <!--        <i class='bi bi-bell fs-2xl'></i>-->
                    <!--        <span-->
                    <!--            class="position-absolute topbar-badge p-0 d-flex align-items-center justify-content-center translate-middle badge rounded-pill bg-danger"><span-->
                    <!--                class="notification-badge">4</span><span class="visually-hidden">unread-->
                    <!--                messages</span></span>-->
                    <!--    </button>-->
                    <!--    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0"-->
                    <!--        aria-labelledby="page-header-notifications-dropdown">-->

                    <!--        <div class="dropdown-head rounded-top">-->
                    <!--            <div class="p-3 pb-1">-->
                    <!--                <div class="row align-items-center mb-3">-->
                    <!--                    <div class="col">-->
                    <!--                        <h6 class="mb-0 fs-lg fw-semibold"> Notifications <span-->
                    <!--                                class="badge bg-danger-subtle text-danger fs-sm notification-badge">-->
                    <!--                                4</span></h6>-->
                    <!--                    </div>-->
                    <!--                    <div class="col-auto dropdown">-->
                    <!--                        <a href="javascript:void(0);" data-bs-toggle="dropdown"-->
                    <!--                            class="link-secondary fs-md"><i-->
                    <!--                                class="bi bi-three-dots-vertical"></i></a>-->
                    <!--                        <ul class="dropdown-menu">-->
                    <!--                            <li><a class="dropdown-item" href="javascript:void(0)"-->
                    <!--                                id="deleteAllNotification">All Clear</a></li>-->
                    <!--                        <li><a class="dropdown-item" href="javascript:void(0)"-->
                    <!--                                id="markRead">Mark all as read</a></li>-->
                    <!--                        <li><a class="dropdown-item" href="#">Archive All</a></li>-->
                    <!--                        </ul>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="card border-top border-bottom mb-0 rounded-0">-->
                    <!--            <div class="p-3 d-flex align-items-center gap-2">-->
                    <!--                <div class="flex-shrink-0">-->
                    <!--                    <i class="bi bi-bell fs-3xl"></i>-->
                    <!--                </div>-->
                    <!--                <div class="flex-grow-1">-->
                    <!--                    <h6 class="mb-1">Push Notification</h6>-->
                    <!--                    <p class="text-muted mb-0">Automatically send new notification</p>-->
                    <!--                </div>-->
                    <!--                <div class="flex-shrink-0">-->
                    <!--                    <div class="form-check form-switch">-->
                    <!--                        <input class="form-check-input" type="checkbox" role="switch"-->
                    <!--                            id="flexSwitchCheckDefault">-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->

                    <!--        <div class="py-2 ps-3" id="notificationItemsTabContent">-->
                    <!--            <div data-simplebar style="max-height: 300px;" class="pe-3">-->
                    <!--                <div-->
                    <!--                    class="text-reset notification-item d-block dropdown-item position-relative unread-message">-->
                    <!--                    <div class="d-flex gap-3">-->
                    <!--                        <div class="flex-shrink-0">-->
                    <!--                            <img src="{{ URL::asset('build/images/companies/img-3.png') }}"-->
                    <!--                                class="rounded-circle avatar-xs" alt="Notification Images">-->
                    <!--                        </div>-->
                    <!--                        <div class="flex-grow-1">-->
                    <!--                            <a href="#!" class="stretched-link">-->
                    <!--                                <h6 class="fs-md mb-1 lh-base">Judia Membership</h6>-->
                    <!--                            </a>-->
                    <!--                            <p class="text-muted mb-0">Successfully purchased a business plan for-->
                    <!--                                <span class="text-danger fw-medium">-$24.99</span>-->
                    <!--                            </p>-->
                    <!--                        </div>-->
                    <!--                        <p class="mb-0 fs-xs fw-medium flex-shrink-0 text-muted">-->
                    <!--                            57 sec ago-->
                    <!--                        </p>-->
                    <!--                    </div>-->
                    <!--                </div>-->

                    <!--                <div class="text-reset notification-item d-block dropdown-item position-relative">-->
                    <!--                    <div class="d-flex gap-3">-->
                    <!--                        <div class="flex-shrink-0">-->
                    <!--                            <img src="https://img.themesbrand.com/judia/users/avatar-8.jpg"-->
                    <!--                                class="rounded-circle avatar-xs" alt="Notification Images">-->
                    <!--                        </div>-->
                    <!--                        <div class="flex-grow-1">-->
                    <!--                            <a href="#!" class="stretched-link">-->
                    <!--                                <h6 class="fs-md mb-1 lh-base">Bella Bailey</h6>-->
                    <!--                            </a>-->
                    <!--                            <p class="text-muted mb-0">Assigned you on the call with Fatima</p>-->
                    <!--                        </div>-->
                    <!--                        <p class="mb-0 fs-xs fw-medium flex-shrink-0 text-muted">-->
                    <!--                            5 min ago-->
                    <!--                        </p>-->
                    <!--                    </div>-->
                    <!--                </div>-->

                    <!--                <div class="text-reset notification-item d-block dropdown-item position-relative unread-message">-->
                    <!--                    <div class="d-flex gap-3">-->
                    <!--                        <div class="avatar-xs flex-shrink-0">-->
                    <!--                            <span-->
                    <!--                                class="avatar-title bg-danger-subtle text-danger rounded-circle fs-lg">-->
                    <!--                                <i class='bx bx-message-square-dots'></i>-->
                    <!--                            </span>-->
                    <!--                        </div>-->
                    <!--                        <div class="flex-grow-1">-->
                    <!--                            <p class="text-muted mb-0"><b class="text-body">Nathan Keeling</b>-->
                    <!--                                replied to your comment on <b>Steex - Admin & Dashboards</b></p>-->
                    <!--                        </div>-->
                    <!--                        <p class="mb-0 fs-xs fw-medium flex-shrink-0 text-muted">-->
                    <!--                            3 hrs ago-->
                    <!--                        </p>-->
                    <!--                    </div>-->
                    <!--                </div>-->

                    <!--                <div class="text-reset notification-item d-block dropdown-item position-relative">-->
                    <!--                    <div class="d-flex gap-3">-->
                    <!--                        <div class="position-relative flex-shrink-0">-->
                    <!--                            <img src="https://img.themesbrand.com/judia/users/avatar-2.jpg"-->
                    <!--                                class="rounded-circle avatar-xs" alt="Notification Images">-->
                    <!--                            <span-->
                    <!--                                class="active-badge position-absolute start-100 translate-middle p-1 bg-success rounded-circle">-->
                    <!--                                <span class="visually-hidden">New alerts</span>-->
                    <!--                            </span>-->
                    <!--                        </div>-->
                    <!--                        <div class="flex-grow-1">-->
                    <!--                            <a href="#!" class="stretched-link">-->
                    <!--                                <h6 class="fs-md mb-1 lh-base">Angela Bernier</h6>-->
                    <!--                            </a>-->
                    <!--                            <p class="text-muted mb-0">Answered to your comment on the cash flow-->
                    <!--                                forecast's graph 🔔.</p>-->
                    <!--                        </div>-->
                    <!--                        <p class="mb-0 fs-xs fw-medium flex-shrink-0 text-muted">-->
                    <!--                            1 week ago-->
                    <!--                        </p>-->
                    <!--                    </div>-->
                    <!--                </div>-->

                    <!--                <div class="text-reset notification-item d-block dropdown-item position-relative">-->
                    <!--                    <div class="d-flex gap-3">-->
                    <!--                        <div class="position-relative flex-shrink-0">-->
                    <!--                            <img src="https://img.themesbrand.com/judia/users/avatar-3.jpg"-->
                    <!--                                class="rounded-circle avatar-xs" alt="Notification Images">-->
                    <!--                            <span-->
                    <!--                                class="active-badge position-absolute start-100 translate-middle p-1 bg-warning rounded-circle">-->
                    <!--                                <span class="visually-hidden">New alerts</span>-->
                    <!--                            </span>-->
                    <!--                        </div>-->
                    <!--                        <div class="flex-grow-1">-->
                    <!--                            <a href="#!" class="stretched-link">-->
                    <!--                                <h6 class="fs-md mb-1 lh-base">Maureen Gibson</h6>-->
                    <!--                            </a>-->
                    <!--                            <p class="text-muted mb-0">We talked about a project on linkedin.</p>-->
                    <!--                        </div>-->
                    <!--                        <p class="mb-0 fs-xs fw-medium flex-shrink-0 text-muted">-->
                    <!--                            2 week ago-->
                    <!--                        </p>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--            <div class="notification-actions" id="notification-actions">-->
                    <!--                <div class="d-flex text-muted justify-content-center align-items-center">-->
                    <!--                    Select <div id="select-content" class="text-body fw-semibold px-1">0</div>-->
                    <!--                    Result <button type="button" class="btn btn-link link-danger p-0 ms-2"-->
                    <!--                        data-bs-toggle="modal"-->
                    <!--                        data-bs-target="#removeNotificationModal">Remove</button>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--            <div class="empty-notification-elem text-center px-4 d-none">-->
                    <!--                <div class="mt-3 avatar-md mx-auto">-->
                    <!--                    <div class="avatar-title bg-info-subtle text-info fs-24 rounded-circle"> <i class="bi bi-bell "></i> </div>-->
                    <!--                </div>-->
                    <!--                <div class="pb-3 mt-2">-->
                    <!--                    <h6 class="fs-lg fw-semibold lh-base">Hey! You have no any notifications </h6>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->

                    <div class="dropdown topbar-head-dropdown ms-2 header-item">
                        <button type="button" class="btn btn-icon rounded-circle" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle img-fluid"
                            src="@if (Auth::user()->avatar != ''){{ URL::asset('images/' . Auth::user()->avatar) }}@else{{ URL::asset('build/images/users/user-dummy-img.jpg') }}@endif" alt="Header Avatar">
                        </button>
                        <div class="dropdown-menu p-2 dropdown-menu-end">
                            <div class="d-flex gap-2 mb-3 topbar-profile">
                                <div class="position-relative">
                                    <img class="rounded-1" src="@if (Auth::user()->avatar != ''){{ URL::asset('images/' . Auth::user()->avatar) }}@else{{ URL::asset('build/images/users/user-dummy-img.jpg') }}@endif"
                                        alt="Header Avatar">
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-success"><span
                                            class="visually-hidden">unread messages</span></span>
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-sm user-name">{{ @Auth::user()->name }}</h6>
                                    <p class="mb-0 fw-medium fs-xs"><a href="#!">{{ @Auth::user()->email }}</a></p>
                                </div>
                            </div>
                            <a href="{{ route('profile') }}" class="dropdown-item"><i
                                    class="bi bi-person align-middle me-2"></i> Profile</a>
                            <!--<a href="apps-chat" class="dropdown-item"><i-->
                            <!--        class="bi bi-chat-right-text align-middle me-2"></i> Messages</a>-->
                            <!--<a href="pages-pricing" class="dropdown-item"><i class="bi bi-gem align-middle me-2"></i>-->
                            <!--    My Subscription</a>-->
                            <!--<a href="pages-profile" class="dropdown-item"><i-->
                            <!--        class="bi bi-person-gear align-middle me-2"></i> Account Settings</a>-->
                            <a href="javascript:void(0)" class="dropdown-item" href="javascript:void();"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="bi bi-box-arrow-right align-middle me-2"></i> Sign Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- removeNotificationModal -->
    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="NotificationModalbtn-close"></button>
                </div>
                <div class="modal-body p-md-5">
                    <div class="text-center">
                        <div class="text-danger">
                            <i class="bi bi-trash display-4"></i>
                        </div>
                        <div class="mt-4 fs-base">
                            <h4 class="mb-1">Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete
                            It!</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- removeCartModal -->
    <div id="removeCartModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-cartmodal"></button>
                </div>
                <div class="modal-body p-md-5">
                    <div class="text-center">
                        <div class="text-danger">
                            <i class="bi bi-trash display-5"></i>
                        </div>
                        <div class="mt-4">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this product ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="remove-cartproduct">Yes, Delete
                            It!</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
