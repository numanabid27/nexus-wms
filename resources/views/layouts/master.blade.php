<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout-width="boxed" data-topbar="dark"
    data-preloader="disable" data-card-layout="borderless" data-bs-theme="light" data-topbar-image="pattern-1">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | {{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico') }}">

    <!-- include head css -->
    @include('layouts.head-css')
</head>

@yield('body')

<!-- Begin page -->
<div id="layout-wrapper">
    <!-- topbar -->
    @include('layouts.topbar')

    <!-- pattern components -->
    @include('layouts.pattern')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            @yield('page-title')
                        </div>
                        <!--end col-->
                        <div class="col-md-auto ms-auto">
                            <div class="customizer-setting d-none d-md-block">
                                @yield('page-button')
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>

                @yield('content')
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- footer -->
        @include('layouts.footer')

    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!-- vendor-scripts -->
@include('layouts.vendor-scripts')

</body>
@yield('script-content')
</html>
