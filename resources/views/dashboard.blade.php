@extends('layouts.master')
@section('title')
    {{ __('dashboard') }}
@endsection
@section('css')
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')

@section('page-title')
    <x-breadcrumb pagetitle="{{ __('dashboard') }}" title="" />
@endsection

<div class="row">
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="avatar-sm float-end">
                    <div class="avatar-title bg-success-subtle text-success rounded fs-3xl">
                        <i class="bi bi-activity"></i>
                    </div>
                </div>
                <p class="fs-md text-muted mb-4">Total Çustomers</p>
                <h4 class="mb-3"><span class="counter-value" data-target="{{ $totalCustomers ?? 0 }}">0</span></h4>
            </div>
        </div>
    </div>
    <!--end col-->
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="avatar-sm float-end">
                    <div class="avatar-title bg-primary-subtle text-primary rounded fs-3xl">
                        <i class="bi bi-magnet"></i>
                    </div>
                </div>
                <p class="fs-md text-muted mb-4">Total Employes</p>
                <h4 class="mb-3"><span class="counter-value" data-target="{{ $totalEmployes ?? 0 }}">0</span></h4>
            </div>
        </div>
    </div>
    <!--end col-->
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="avatar-sm float-end">
                    <div class="avatar-title bg-info-subtle text-info rounded fs-3xl">
                        <i class="bi bi-optical-audio"></i>
                    </div>
                </div>
                <p class="fs-md text-muted mb-4">Total Vehicles</p>
                <h4 class="mb-3"><span class="counter-value" data-target="{{ $totalVehicles ?? 0 }}">0</span></h4>
            </div>
        </div>
    </div>
    <!--end col-->
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="avatar-sm float-end">
                    <div class="avatar-title bg-warning-subtle text-warning rounded fs-3xl">
                        <i class="bi bi-eye"></i>
                    </div>
                </div>
                <p class="fs-md text-muted mb-4">Total Collections</p>
                <h4 class="mb-3"><span class="counter-value" data-target="{{ $totalCollections ?? 0 }}">0</span></h4>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->

<div class="row">
    <div class="col-xl-9">
        <div class="card">
            <div class="card-header d-flex align-items-center flex-wrap gap-3">
                <h5 class="card-title mb-0 flex-grow-1">Collections</h5>
                <div class="flex-shrink-0">
                    <div class="dropdown card-header-dropdown">
                        <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted fs-lg"><i class="bi bi-three-dots-vertical"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-3" style="min-width: 300px;">
                            <div class="mb-2">
                                <label class="form-label small text-muted mb-1">{{ __('range') }} (Max 15 days):</label>
                                <div class="position-relative">
                                    {!! Form::text('collection_date_range', null, array('placeholder' => __('range'),'class' => 'form-control flatpickr-input', 'id' => 'collection_date_range', 'readonly'=>"readonly")) !!}
                                    <button type="button" class="btn btn-link text-muted p-0 position-absolute end-0 top-50 translate-middle-y me-2" id="clear_collection_date" style="display: none; z-index: 10; border: none; background: none; font-size: 1.2rem; line-height: 1;" title="Clear date">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end card-header-->
            <div class="card-body">
                <div style="margin-top: 42px; min-width: 100%;" id="pageviews_overview" 
                    data-collection="{{ $totalCollections ?? 0 }}" 
                    data-chart-data="{{ json_encode($chartData ?? []) }}"
                    data-chart-categories="{{ json_encode($chartCategories ?? []) }}"
                    data-colors='["--tb-primary", "--tb-light"]' 
                    class="apex-charts ms-n3"
                    dir="ltr"></div>
                
                <!--end row-->
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6">
        <div class="card card-height-100">
            <div class="card-header d-flex">
                <h5 class="card-title mb-0 flex-grow-1">Summery</h5>
                <div class="flex-shrink-0">
                    <div class="dropdown card-header-dropdown">
                        <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted fs-lg"><i class="bi bi-three-dots-vertical"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-3" style="min-width: 300px;">
                            <div class="mb-2">
                                <label class="form-label small text-muted mb-1">{{ __('range') }} (Max 15 days):</label>
                                <div class="position-relative">
                                    {!! Form::text('summery_date_range', null, array('placeholder' => __('range'),'class' => 'form-control flatpickr-input', 'id' => 'summery_date_range', 'readonly'=>"readonly")) !!}
                                    <button type="button" class="btn btn-link text-muted p-0 position-absolute end-0 top-50 translate-middle-y me-2" id="clear_summery_date" style="display: none; z-index: 10; border: none; background: none; font-size: 1.2rem; line-height: 1;" title="Clear date">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="sales_funnel"
                    data-colors='["--tb-primary ", "--tb-success"]'
                    data-dump-histories="{{ $totalDumpHistories ?? 0 }}"
                    data-collection="{{ $totalCollections ?? 0 }}"
                    data-chart-initialized="false"
                    style="min-height: 300px;"
                    class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>
    <!--end col-->
   

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center flex-wrap gap-3">
                <h5 class="card-title mb-0 flex-grow-1">Billing Summary</h5>
                <div class="flex-shrink-0">
                    <div class="dropdown card-header-dropdown">
                        <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted fs-lg"><i class="bi bi-three-dots-vertical"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-3" style="min-width: 300px;">
                            <div class="mb-2">
                                <label class="form-label small text-muted mb-1">{{ __('range') }}:</label>
                                <div class="position-relative">
                                    {!! Form::text('billing_chart_date_range', null, array('placeholder' => __('range'),'class' => 'form-control flatpickr-input', 'id' => 'billing_chart_date_range', 'readonly'=>"readonly")) !!}
                                    <button type="button" class="btn btn-link text-muted p-0 position-absolute end-0 top-50 translate-middle-y me-2" id="clear_billing_chart_date" style="display: none; z-index: 10; border: none; background: none; font-size: 1.2rem; line-height: 1;" title="Clear date">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div id="billing_summary_bar" data-colors='["--tb-warning-border-subtle","--tb-danger-border-subtle","--tb-success-border-subtle"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->

    <div class="col-xl-4 col-lg-6">
        <div class="card card-height-100" style="height: 40vh;">
            <div class="card-header d-flex">
                <h5 class="card-title mb-0 flex-grow-1">Top Drivers</h5>
            </div>
            <div class="card-body">
                @if(isset($topDrivers) && $topDrivers->count() > 0)
                    <ul class="list-unstyled vstack gap-2 mb-0">
                        @foreach($topDrivers as $index => $helper)
                            <li class="d-flex align-items-center gap-2">
                                @if(!empty($helper['image_guid']))
                                    <img src="{{ asset($helper['image_guid']) }}" alt="{{ $helper['name'] }}" height="32" width="32"
                                        class="rounded-circle object-fit-cover">
                                @else
                                    <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 14px; font-weight: 600;">
                                        {{ strtoupper(substr($helper['name'], 0, 1)) }}
                                    </div>
                                @endif
                                <h6 class="flex-grow-1 mb-0">{{ $helper['name'] }}</h6>
                                <p class="text-muted mb-0">{{ $helper['count'] }}</p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center text-muted py-4">
                        <p class="mb-0">No driver data available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6">
        <div class="card card-height-100" style="height: 40vh;">
            <div class="card-header d-flex">
                <h5 class="card-title mb-0 flex-grow-1">Top Helpers</h5>
            </div>
            <div class="card-body">
                @if(isset($topHelpers) && $topHelpers->count() > 0)
                    <ul class="list-unstyled vstack gap-2 mb-0">
                        @foreach($topHelpers as $index => $helper)
                            <li class="d-flex align-items-center gap-2">
                                @if(!empty($helper['image_guid']))
                                    <img src="{{ asset($helper['image_guid']) }}" alt="{{ $helper['name'] }}" height="32" width="32"
                                        class="rounded-circle object-fit-cover">
                                @else
                                    <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 14px; font-weight: 600;">
                                        {{ strtoupper(substr($helper['name'], 0, 1)) }}
                                    </div>
                                @endif
                                <h6 class="flex-grow-1 mb-0">{{ $helper['name'] }}</h6>
                                <p class="text-muted mb-0">{{ $helper['count'] }}</p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center text-muted py-4">
                        <p class="mb-0">No helper data available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>


</div>
<!--end row-->


<!--end row-->

@endsection
@section('scripts')
<!-- apexcharts -->
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

<script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>

<!-- dashboard-analytics init js - Load charts only once when DOM is ready -->
<script>
// Prevent duplicate chart initialization - wait for ApexCharts to load
(function() {
    // Prevent multiple initializations
    if (window.dashboardChartsInitialized) {
        return;
    }
    
    // Store reference to check if chart is already initialized
    window.salesFunnelChartInitialized = false;
    window.pageviewsChartInitialized = false;
    window.chartInstances = window.chartInstances || {};
    
    function interceptApexCharts() {
        // Wait for ApexCharts to be available (important for live server with network latency)
        if (typeof ApexCharts === 'undefined') {
            // Retry after a short delay if ApexCharts not loaded yet
            setTimeout(interceptApexCharts, 100);
            return;
        }
        
        // Only intercept if not already done
        if (window.apexChartsIntercepted) {
            return;
        }
        window.apexChartsIntercepted = true;
        
        const OriginalApexCharts = ApexCharts;
        ApexCharts = function(selector, options) {
            const element = typeof selector === 'string' ? document.querySelector(selector) : selector;
            const elementId = element ? element.id : (typeof selector === 'string' ? selector : '');
            
            // Check if element already has a chart instance
            if (element && elementId) {
                // Check if chart already exists in DOM
                const existingChart = element.querySelector('.apexcharts-canvas');
                if (existingChart) {
                    // Chart already exists, try to return existing instance
                    if (window.chartInstances[elementId]) {
                        return window.chartInstances[elementId];
                    }
                }
            }
            
            // Check if this is for sales_funnel and already initialized
            if (elementId === 'sales_funnel') {
                if (window.salesFunnelChartInitialized) {
                    // Check if element has chart already
                    if (element && element.querySelector('.apexcharts-canvas')) {
                        // Return existing chart instance if available
                        if (window.salesFunnelChart && window.salesFunnelChart !== "") {
                            return window.salesFunnelChart;
                        }
                        // Chart exists in DOM but no instance, destroy and recreate
                        element.innerHTML = '';
                    } else if (window.salesFunnelChart && window.salesFunnelChart !== "") {
                        return window.salesFunnelChart;
                    }
                }
                window.salesFunnelChartInitialized = true;
            }
            
            // Check if this is for pageviews_overview and already initialized
            if (elementId === 'pageviews_overview') {
                if (window.pageviewsChartInitialized) {
                    // Check if element has chart already
                    if (element && element.querySelector('.apexcharts-canvas')) {
                        // Return existing chart instance if available
                        if (window.pageViewsOverviewChart && window.pageViewsOverviewChart !== "") {
                            return window.pageViewsOverviewChart;
                        }
                        // Chart exists in DOM but no instance, destroy and recreate
                        element.innerHTML = '';
                    } else if (window.pageViewsOverviewChart && window.pageViewsOverviewChart !== "") {
                        return window.pageViewsOverviewChart;
                    }
                }
                window.pageviewsChartInitialized = true;
            }
            
            const chartInstance = new OriginalApexCharts(selector, options);
            
            // Store instance for future reference
            if (elementId) {
                window.chartInstances[elementId] = chartInstance;
            }
            
            return chartInstance;
        };
        
        // Copy static methods and prototype
        Object.setPrototypeOf(ApexCharts, OriginalApexCharts);
        Object.setPrototypeOf(ApexCharts.prototype, OriginalApexCharts.prototype);
        Object.keys(OriginalApexCharts).forEach(key => {
            ApexCharts[key] = OriginalApexCharts[key];
        });
    }
    
    // Ensure sales_funnel element is visible
    function ensureSalesFunnelVisible() {
        const salesFunnelElement = document.getElementById('sales_funnel');
        if (salesFunnelElement) {
            // Remove any inline styles that might hide it
            if (salesFunnelElement.style.display === 'none') {
                salesFunnelElement.style.display = '';
            }
            if (salesFunnelElement.style.visibility === 'hidden') {
                salesFunnelElement.style.visibility = 'visible';
            }
            // Ensure parent is visible
            const parent = salesFunnelElement.closest('.card-body');
            if (parent) {
                if (parent.style.display === 'none') {
                    parent.style.display = '';
                }
                if (parent.style.visibility === 'hidden') {
                    parent.style.visibility = 'visible';
                }
            }
        }
    }
    
    // Watch for duplicate chart creation using MutationObserver
    function setupChartObserver() {
        const salesFunnelElement = document.getElementById('sales_funnel');
        const pageviewsElement = document.getElementById('pageviews_overview');
        
        if (!salesFunnelElement && !pageviewsElement) {
            return;
        }
        
        let isProcessing = false;
        
        const observer = new MutationObserver(function(mutations) {
            // Prevent multiple simultaneous cleanups
            if (isProcessing) {
                return;
            }
            
            // Use a debounce to avoid excessive checks
            setTimeout(function() {
                isProcessing = true;
                
                // Check sales_funnel
                if (salesFunnelElement) {
                    const charts = salesFunnelElement.querySelectorAll('.apexcharts-canvas');
                    if (charts.length > 1) {
                        // Keep only the first one, remove the rest
                        for (let i = 1; i < charts.length; i++) {
                            const chart = charts[i];
                            if (chart._apexcharts) {
                                try { 
                                    chart._apexcharts.destroy(); 
                                } catch (e) {}
                            }
                            chart.remove();
                        }
                    }
                }
                
                // Check pageviews_overview
                if (pageviewsElement) {
                    const charts = pageviewsElement.querySelectorAll('.apexcharts-canvas');
                    if (charts.length > 1) {
                        // Keep only the first one, remove the rest
                        for (let i = 1; i < charts.length; i++) {
                            const chart = charts[i];
                            if (chart._apexcharts) {
                                try { 
                                    chart._apexcharts.destroy(); 
                                } catch (e) {}
                            }
                            chart.remove();
                        }
                    }
                }
                
                isProcessing = false;
            }, 50); // Small delay to debounce
        });
        
        // Observe both elements
        if (salesFunnelElement) {
            observer.observe(salesFunnelElement, { childList: true, subtree: true });
        }
        if (pageviewsElement) {
            observer.observe(pageviewsElement, { childList: true, subtree: true });
        }
        
        // Store observer for potential cleanup later
        window.chartObserver = observer;
    }
    
    // Initialize everything when DOM is ready
    function initializeCharts() {
        // Prevent multiple initializations
        if (window.dashboardChartsInitialized) {
            return;
        }
        
        // Mark as initialized immediately to prevent duplicates
        window.dashboardChartsInitialized = true;
        
        // Start interception
        interceptApexCharts();
        
        // Setup MutationObserver to watch for duplicates
        setupChartObserver();
        
        // Ensure visibility
        ensureSalesFunnelVisible();
        
        // Load dashboard-analytics script
        loadDashboardAnalyticsScript();
    }
    
    // Clean up any existing charts before loading script
    function cleanupExistingCharts() {
        // Clean up sales_funnel
        const salesFunnelElement = document.getElementById('sales_funnel');
        if (salesFunnelElement) {
            // Clear any existing chart content
            const existingCharts = salesFunnelElement.querySelectorAll('.apexcharts-canvas, .apexcharts-inner, svg');
            existingCharts.forEach(function(chart) {
                if (chart._apexcharts) {
                    try {
                        chart._apexcharts.destroy();
                    } catch (e) {}
                }
            });
            // Clear innerHTML to remove any chart remnants
            salesFunnelElement.innerHTML = '';
            // Reset initialization flags
            salesFunnelElement.setAttribute('data-chart-initialized', 'false');
        }
        
        // Clean up pageviews_overview
        const pageviewsElement = document.getElementById('pageviews_overview');
        if (pageviewsElement) {
            // Clear any existing chart content
            const existingCharts = pageviewsElement.querySelectorAll('.apexcharts-canvas, .apexcharts-inner, svg');
            existingCharts.forEach(function(chart) {
                if (chart._apexcharts) {
                    try {
                        chart._apexcharts.destroy();
                    } catch (e) {}
                }
            });
            // Clear innerHTML to remove any chart remnants
            pageviewsElement.innerHTML = '';
        }
        
        // Reset global chart instances
        if (window.salesFunnelChart && window.salesFunnelChart !== "") {
            try {
                window.salesFunnelChart.destroy();
            } catch (e) {}
            window.salesFunnelChart = null;
        }
        if (window.pageViewsOverviewChart && window.pageViewsOverviewChart !== "") {
            try {
                window.pageViewsOverviewChart.destroy();
            } catch (e) {}
            window.pageViewsOverviewChart = null;
        }
        
        // Reset initialization flags
        window.salesFunnelChartInitialized = false;
        window.pageviewsChartInitialized = false;
    }
    
    // Load dashboard-analytics script only once
    function loadDashboardAnalyticsScript() {
        // Check if script is already loaded or loading
        if (window.dashboardAnalyticsScriptLoaded || window.dashboardAnalyticsScriptLoading) {
            return;
        }
        
        // Remove any existing script tags (in case of page refresh/cache issues)
        const existingScripts = document.querySelectorAll('script[src*="dashboard-analytics.init.js"]');
        existingScripts.forEach(function(script) {
            script.remove();
        });
        
        // Clean up any existing charts BEFORE loading the script
        cleanupExistingCharts();
        
        // Mark as loading to prevent multiple loads
        window.dashboardAnalyticsScriptLoading = true;
        
        // Create and load script with a unique ID to track it
        const script = document.createElement('script');
        script.src = '{{ URL::asset("build/js/pages/dashboard-analytics.init.js") }}';
        script.async = false;
        script.id = 'dashboard-analytics-init-script';
        script.onload = function() {
            window.dashboardAnalyticsScriptLoaded = true;
            window.dashboardAnalyticsScriptLoading = false;
            
            // Clean up duplicates immediately after script loads and periodically
            function quickCleanup() {
                const salesFunnelElement = document.getElementById('sales_funnel');
                if (salesFunnelElement) {
                    const charts = salesFunnelElement.querySelectorAll('.apexcharts-canvas');
                    if (charts.length > 1) {
                        for (let i = 1; i < charts.length; i++) {
                            const chart = charts[i];
                            if (chart._apexcharts) {
                                try { chart._apexcharts.destroy(); } catch (e) {}
                            }
                            chart.remove();
                        }
                    }
                }
                
                const pageviewsElement = document.getElementById('pageviews_overview');
                if (pageviewsElement) {
                    const charts = pageviewsElement.querySelectorAll('.apexcharts-canvas');
                    if (charts.length > 1) {
                        for (let i = 1; i < charts.length; i++) {
                            const chart = charts[i];
                            if (chart._apexcharts) {
                                try { chart._apexcharts.destroy(); } catch (e) {}
                            }
                            chart.remove();
                        }
                    }
                }
            }
            
            // Run cleanup multiple times to catch any duplicates
            setTimeout(quickCleanup, 50);
            setTimeout(quickCleanup, 200);
            setTimeout(quickCleanup, 500);
            setTimeout(quickCleanup, 1000);
        };
        script.onerror = function() {
            console.error('Failed to load dashboard-analytics script');
            window.dashboardAnalyticsScriptLoading = false;
        };
        document.head.appendChild(script);
    }
    
    // Wait for DOM to be ready before initializing
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            // Small delay to ensure ApexCharts library is loaded
            setTimeout(initializeCharts, 150);
        });
    } else {
        // DOM already ready, initialize with small delay
        setTimeout(initializeCharts, 150);
    }
    
    // Also check visibility on window load (important for live server)
    window.addEventListener('load', function() {
        setTimeout(ensureSalesFunnelVisible, 100);
        setTimeout(ensureSalesFunnelVisible, 500);
    });
})();
</script>

<!-- barcharts init - Load after DOM is ready -->
<script>
(function() {
    // Prevent multiple script loads
    if (window.barchartsScriptLoaded) {
        return;
    }
    
    function loadBarchartsScript() {
        // Check if script is already loaded
        if (window.barchartsScriptLoaded || window.barchartsScriptLoading) {
            return;
        }
        
        // Check if script tag already exists
        const existingScript = document.querySelector('script[src*="apexcharts-bar.init.js"]');
        if (existingScript) {
            window.barchartsScriptLoaded = true;
            return;
        }
        
        // Mark as loading
        window.barchartsScriptLoading = true;
        
        // Create and load script
        const script = document.createElement('script');
        script.src = '{{ URL::asset("build/js/pages/apexcharts-bar.init.js") }}';
        script.async = false;
        script.onload = function() {
            window.barchartsScriptLoaded = true;
            window.barchartsScriptLoading = false;
        };
        script.onerror = function() {
            console.error('Failed to load barcharts script');
            window.barchartsScriptLoading = false;
        };
        document.head.appendChild(script);
    }
    
    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(loadBarchartsScript, 100);
        });
    } else {
        setTimeout(loadBarchartsScript, 100);
    }
})();
</script>

<script>
// Additional protection against duplicate chart initialization
(function() {
    // Wait for dashboard-analytics script to potentially initialize charts
    function preventDuplicateInitialization() {
        // Check and clean up sales_funnel
        const salesFunnelElement = document.getElementById('sales_funnel');
        if (salesFunnelElement) {
            // Ensure visibility
            salesFunnelElement.style.display = '';
            salesFunnelElement.style.visibility = 'visible';
            salesFunnelElement.style.opacity = '1';
            
            // Check for multiple chart instances
            const charts = salesFunnelElement.querySelectorAll('.apexcharts-canvas');
            if (charts.length > 1) {
                // Keep only the first one
                for (let i = 1; i < charts.length; i++) {
                    const chart = charts[i];
                    if (chart._apexcharts) {
                        try {
                            chart._apexcharts.destroy();
                        } catch (e) {}
                    }
                    chart.remove();
                }
            }
        }
        
        // Check and clean up pageviews_overview
        const pageviewsElement = document.getElementById('pageviews_overview');
        if (pageviewsElement) {
            const charts = pageviewsElement.querySelectorAll('.apexcharts-canvas');
            if (charts.length > 1) {
                // Keep only the first one
                for (let i = 1; i < charts.length; i++) {
                    const chart = charts[i];
                    if (chart._apexcharts) {
                        try {
                            chart._apexcharts.destroy();
                        } catch (e) {}
                    }
                    chart.remove();
                }
            }
        }
    }
    
    // Run immediately and after delays
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(preventDuplicateInitialization, 500);
            setTimeout(preventDuplicateInitialization, 1500);
            setTimeout(preventDuplicateInitialization, 3000);
        });
    } else {
        setTimeout(preventDuplicateInitialization, 500);
        setTimeout(preventDuplicateInitialization, 1500);
        setTimeout(preventDuplicateInitialization, 3000);
    }
    
    window.addEventListener('load', function() {
        setTimeout(preventDuplicateInitialization, 500);
        setTimeout(preventDuplicateInitialization, 1500);
    });
})();
</script>

<script>
// Handle Summery dropdown filter with datepicker
(function() {
    let summeryDatePicker = null;
    
    function initSummeryDatePicker() {
        // Find the Summery card
        const cards = document.querySelectorAll('.card');
        let summeryCard = null;
        
        for (let i = 0; i < cards.length; i++) {
            const title = cards[i].querySelector('.card-title');
            if (title && title.textContent.trim() === 'Summery') {
                summeryCard = cards[i];
                break;
            }
        }
        
        if (!summeryCard) {
            return;
        }
        
        const dateRangeInput = document.getElementById('summery_date_range');
        if (!dateRangeInput) {
            return;
        }
        
        const dropdownBtn = summeryCard.querySelector('.dropdown-btn');
        const dropdownMenu = summeryCard.querySelector('.dropdown-menu');
        
        // Destroy any existing flatpickr instance
        if (dateRangeInput._flatpickr) {
            dateRangeInput._flatpickr.destroy();
        }
        
        // Get clear button
        const clearBtn = document.getElementById('clear_summery_date');
        
        // Initialize flatpickr with 15-day maximum range
        if (typeof flatpickr !== 'undefined') {
            summeryDatePicker = flatpickr(dateRangeInput, {
                mode: "range",
                dateFormat: "Y-m-d",
                maxDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    // Show/hide clear button
                    if (clearBtn) {
                        if (selectedDates.length === 2 && dateStr) {
                            clearBtn.style.display = 'block';
                        } else {
                            clearBtn.style.display = 'none';
                        }
                    }
                    
                    if (selectedDates.length === 2) {
                        const startDate = selectedDates[0];
                        const endDate = selectedDates[1];
                        
                        // Calculate days difference using date components for accuracy
                        const startYear = startDate.getFullYear();
                        const startMonth = startDate.getMonth();
                        const startDay = startDate.getDate();
                        const endYear = endDate.getFullYear();
                        const endMonth = endDate.getMonth();
                        const endDay = endDate.getDate();
                        
                        const startDateOnly = new Date(startYear, startMonth, startDay);
                        const endDateOnly = new Date(endYear, endMonth, endDay);
                        const daysDiff = Math.round((endDateOnly - startDateOnly) / (1000 * 60 * 60 * 24)) + 1;
                        
                        // Check if range exceeds 15 days
                        if (daysDiff > 15) {
                            // Reset to valid range (first 15 days from start)
                            const validEndDate = new Date(startDate);
                            validEndDate.setDate(validEndDate.getDate() + 14);
                            
                            instance.setDate([startDate, validEndDate], false);
                            
                            // Show warning
                            if (typeof Toastify !== 'undefined') {
                                Toastify({
                                    text: "Maximum date range is 15 days. Selection adjusted.",
                                    gravity: "top",
                                    position: "right",
                                    className: "bg-warning"
                                }).showToast();
                            }
                            return;
                        }
                        
                        // Filter and update chart
                        filterSummeryByDateRange(startDate, endDate);
                    } else if (selectedDates.length === 0) {
                        // Date cleared, reset chart to show all data
                        resetSummeryChart();
                    }
                },
                onClose: function(selectedDates, dateStr, instance) {
                    // Update clear button visibility
                    if (clearBtn) {
                        if (selectedDates.length === 2 && dateStr) {
                            clearBtn.style.display = 'block';
                        } else {
                            clearBtn.style.display = 'none';
                        }
                    }
                },
                onReady: function(selectedDates, dateStr, instance) {
                    // Prevent closing dropdown when clicking inside datepicker
                    if (instance.calendarContainer) {
                        instance.calendarContainer.addEventListener('click', function(e) {
                            e.stopPropagation();
                        });
                    }
                    
                    // Update clear button visibility on ready
                    if (clearBtn) {
                        if (selectedDates.length === 2 && dateStr) {
                            clearBtn.style.display = 'block';
                        } else {
                            clearBtn.style.display = 'none';
                        }
                    }
                }
            });
        }
        
        // Handle clear button click
        if (clearBtn) {
            clearBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (summeryDatePicker) {
                    summeryDatePicker.clear();
                    resetSummeryChart();
                }
            });
        }
        
        // Open datepicker when dropdown is opened
        if (dropdownBtn && dropdownMenu && summeryDatePicker) {
            dropdownBtn.addEventListener('click', function(e) {
                // Wait for dropdown to be shown, then open datepicker
                setTimeout(function() {
                    // Check if dropdown is visible
                    if (dropdownMenu.classList.contains('show')) {
                        // Small delay to ensure dropdown is fully rendered
                        setTimeout(function() {
                            if (summeryDatePicker && !summeryDatePicker.isOpen) {
                                summeryDatePicker.open();
                            }
                        }, 100);
                    }
                }, 100);
            });
        }
        
        // Prevent dropdown from closing when clicking inside (except on the input)
        if (dropdownMenu) {
            dropdownMenu.addEventListener('click', function(e) {
                // Allow clicks on the input, clear button, and datepicker calendar
                const isDatepickerElement = e.target.closest('.flatpickr-calendar') || 
                                          e.target === dateRangeInput || 
                                          dateRangeInput.contains(e.target) ||
                                          e.target === clearBtn ||
                                          e.target.closest('#clear_summery_date');
                
                if (!isDatepickerElement) {
                    e.stopPropagation();
                }
            });
        }
    }
    
    function filterSummeryByDateRange(startDate, endDate) {
        // Filter data using JavaScript
        const dumpCount = getCountForDateRange(dashboardData.dumpHistories, startDate, endDate);
        const collectionCount = getCountForDateRange(dashboardData.collectionCounts, startDate, endDate);
        
        const salesFunnelElement = document.getElementById('sales_funnel');
        if (!salesFunnelElement) {
            console.error('sales_funnel element not found');
            return;
        }
        
        // Ensure element is visible
        if (salesFunnelElement.style.display === 'none') {
            salesFunnelElement.style.display = '';
        }
        if (salesFunnelElement.style.visibility === 'hidden') {
            salesFunnelElement.style.visibility = 'visible';
        }
        
        // Check for duplicate charts and remove them
        const existingCharts = salesFunnelElement.querySelectorAll('.apexcharts-canvas');
        if (existingCharts.length > 1) {
            // Multiple charts detected, keep only the first one
            for (let i = 1; i < existingCharts.length; i++) {
                const chartToRemove = existingCharts[i];
                if (chartToRemove._apexcharts) {
                    try {
                        chartToRemove._apexcharts.destroy();
                    } catch (e) {}
                }
                chartToRemove.remove();
            }
        }
        
        // Update both data attributes
        salesFunnelElement.setAttribute('data-dump-histories', dumpCount);
        salesFunnelElement.setAttribute('data-collection', collectionCount);
        
        // Try to update the chart - check multiple ways to access it
        let chart = null;
        if (typeof salesFunnelChart !== 'undefined' && salesFunnelChart && salesFunnelChart !== "") {
            chart = salesFunnelChart;
        } else if (typeof window.salesFunnelChart !== 'undefined' && window.salesFunnelChart && window.salesFunnelChart !== "") {
            chart = window.salesFunnelChart;
        } else if (existingCharts.length > 0 && existingCharts[0]._apexcharts) {
            // Try to get chart from DOM element
            chart = existingCharts[0]._apexcharts;
        }
        
        if (chart && typeof chart.updateSeries === 'function') {
            try {
                chart.updateSeries([dumpCount, collectionCount]);
                return; // Successfully updated, exit early
            } catch (e) {
                console.warn('Error updating sales funnel chart:', e);
            }
        }
        
        // Chart not ready or update failed, wait a bit and try again
        setTimeout(function() {
            let existingChart = null;
            if (typeof salesFunnelChart !== 'undefined' && salesFunnelChart && salesFunnelChart !== "") {
                existingChart = salesFunnelChart;
            } else if (typeof window.salesFunnelChart !== 'undefined' && window.salesFunnelChart && window.salesFunnelChart !== "") {
                existingChart = window.salesFunnelChart;
            } else {
                // Check DOM for chart instance
                const charts = salesFunnelElement.querySelectorAll('.apexcharts-canvas');
                if (charts.length > 0 && charts[0]._apexcharts) {
                    existingChart = charts[0]._apexcharts;
                }
            }
            
            if (existingChart && typeof existingChart.updateSeries === 'function') {
                try {
                    existingChart.updateSeries([dumpCount, collectionCount]);
                    return;
                } catch (e) {
                    console.warn('Error updating sales funnel chart on retry:', e);
                }
            }
            
            // Only reload if chart truly doesn't exist and no charts in DOM
            const chartsInDOM = salesFunnelElement.querySelectorAll('.apexcharts-canvas');
            if (chartsInDOM.length === 0 && typeof loadCharts === 'function') {
                // Destroy any existing chart instance first
                if (existingChart && typeof existingChart.destroy === 'function') {
                    try {
                        existingChart.destroy();
                    } catch (e) {}
                }
                // Clear element to ensure clean initialization
                salesFunnelElement.innerHTML = '';
                loadCharts();
                // Try to update after a short delay
                setTimeout(function() {
                    let newChart = null;
                    if (typeof salesFunnelChart !== 'undefined' && salesFunnelChart && salesFunnelChart !== "") {
                        newChart = salesFunnelChart;
                    } else if (typeof window.salesFunnelChart !== 'undefined' && window.salesFunnelChart && window.salesFunnelChart !== "") {
                        newChart = window.salesFunnelChart;
                    }
                    if (newChart && typeof newChart.updateSeries === 'function') {
                        newChart.updateSeries([dumpCount, collectionCount]);
                    }
                }, 300);
            }
        }, 200);
    }
    
    function resetSummeryChart() {
        // Reset to current month's data
        const today = new Date();
        const currentMonth = today.getFullYear() + '-' + String(today.getMonth() + 1).padStart(2, '0');
        const dumpCount = getCountForMonth(dashboardData.dumpHistories, currentMonth);
        const collectionCount = getCountForMonth(dashboardData.collectionCounts, currentMonth);
        
        const salesFunnelElement = document.getElementById('sales_funnel');
        if (!salesFunnelElement) {
            return;
        }
        
        // Ensure element is visible
        if (salesFunnelElement.style.display === 'none') {
            salesFunnelElement.style.display = '';
        }
        if (salesFunnelElement.style.visibility === 'hidden') {
            salesFunnelElement.style.visibility = 'visible';
        }
        
        // Check for duplicate charts and remove them
        const existingCharts = salesFunnelElement.querySelectorAll('.apexcharts-canvas');
        if (existingCharts.length > 1) {
            // Multiple charts detected, keep only the first one
            for (let i = 1; i < existingCharts.length; i++) {
                const chartToRemove = existingCharts[i];
                if (chartToRemove._apexcharts) {
                    try {
                        chartToRemove._apexcharts.destroy();
                    } catch (e) {}
                }
                chartToRemove.remove();
            }
        }
        
        // Update both data attributes
        salesFunnelElement.setAttribute('data-dump-histories', dumpCount);
        salesFunnelElement.setAttribute('data-collection', collectionCount);
        
        // Try to update the chart - check multiple ways to access it
        let chart = null;
        if (typeof salesFunnelChart !== 'undefined' && salesFunnelChart && salesFunnelChart !== "") {
            chart = salesFunnelChart;
        } else if (typeof window.salesFunnelChart !== 'undefined' && window.salesFunnelChart && window.salesFunnelChart !== "") {
            chart = window.salesFunnelChart;
        } else if (existingCharts.length > 0 && existingCharts[0]._apexcharts) {
            // Try to get chart from DOM element
            chart = existingCharts[0]._apexcharts;
        }
        
        if (chart && typeof chart.updateSeries === 'function') {
            try {
                chart.updateSeries([dumpCount, collectionCount]);
                return; // Successfully updated, exit early
            } catch (e) {
                console.warn('Error updating sales funnel chart:', e);
            }
        }
        
        // Chart not ready or update failed, wait a bit and try again
        setTimeout(function() {
            let existingChart = null;
            if (typeof salesFunnelChart !== 'undefined' && salesFunnelChart && salesFunnelChart !== "") {
                existingChart = salesFunnelChart;
            } else if (typeof window.salesFunnelChart !== 'undefined' && window.salesFunnelChart && window.salesFunnelChart !== "") {
                existingChart = window.salesFunnelChart;
            } else {
                // Check DOM for chart instance
                const charts = salesFunnelElement.querySelectorAll('.apexcharts-canvas');
                if (charts.length > 0 && charts[0]._apexcharts) {
                    existingChart = charts[0]._apexcharts;
                }
            }
            
            if (existingChart && typeof existingChart.updateSeries === 'function') {
                try {
                    existingChart.updateSeries([dumpCount, collectionCount]);
                    return;
                } catch (e) {
                    console.warn('Error updating sales funnel chart on retry:', e);
                }
            }
            
            // Only reload if chart truly doesn't exist and no charts in DOM
            const chartsInDOM = salesFunnelElement.querySelectorAll('.apexcharts-canvas');
            if (chartsInDOM.length === 0 && typeof loadCharts === 'function') {
                // Destroy any existing chart instance first
                if (existingChart && typeof existingChart.destroy === 'function') {
                    try {
                        existingChart.destroy();
                    } catch (e) {}
                }
                // Clear element to ensure clean initialization
                salesFunnelElement.innerHTML = '';
                loadCharts();
                setTimeout(function() {
                    let newChart = null;
                    if (typeof salesFunnelChart !== 'undefined' && salesFunnelChart && salesFunnelChart !== "") {
                        newChart = salesFunnelChart;
                    } else if (typeof window.salesFunnelChart !== 'undefined' && window.salesFunnelChart && window.salesFunnelChart !== "") {
                        newChart = window.salesFunnelChart;
                    }
                    if (newChart && typeof newChart.updateSeries === 'function') {
                        newChart.updateSeries([dumpCount, collectionCount]);
                    }
                }, 300);
            }
        }, 200);
    }
    
    // Cleanup function to remove duplicate charts and show charts after cleanup
    function cleanupDuplicateCharts() {
        // Cleanup sales_funnel chart
        const salesFunnelElement = document.getElementById('sales_funnel');
        if (salesFunnelElement) {
            // Ensure element is visible
            if (salesFunnelElement.style.display === 'none') {
                salesFunnelElement.style.display = '';
            }
            if (salesFunnelElement.style.visibility === 'hidden') {
                salesFunnelElement.style.visibility = 'visible';
            }
            
            const existingCharts = salesFunnelElement.querySelectorAll('.apexcharts-canvas');
            if (existingCharts.length > 1) {
                // Multiple charts detected, keep only the first one and remove others
                for (let i = 1; i < existingCharts.length; i++) {
                    const chartToRemove = existingCharts[i];
                    // Try to destroy the chart instance if it exists
                    if (chartToRemove._apexcharts) {
                        try {
                            chartToRemove._apexcharts.destroy();
                        } catch (e) {
                            console.warn('Error destroying duplicate chart:', e);
                        }
                    }
                    chartToRemove.parentNode.remove();
                }
                // Also remove any duplicate SVG elements
                const svgElements = salesFunnelElement.querySelectorAll('svg');
                if (svgElements.length > 1) {
                    for (let i = 1; i < svgElements.length; i++) {
                        svgElements[i].remove();
                    }
                }
                // Remove any duplicate apexcharts containers
                const containers = salesFunnelElement.querySelectorAll('.apexcharts-inner, .apexcharts-svg');
                if (containers.length > 2) {
                    // Keep first two (inner and svg), remove rest
                    for (let i = 2; i < containers.length; i++) {
                        containers[i].remove();
                    }
                }
            }
        }
        
        // Cleanup pageviews_overview chart
        const pageviewsElement = document.getElementById('pageviews_overview');
        if (pageviewsElement) {
            const existingCharts = pageviewsElement.querySelectorAll('.apexcharts-canvas');
            if (existingCharts.length > 1) {
                // Multiple charts detected, keep only the first one and remove others
                for (let i = 1; i < existingCharts.length; i++) {
                    const chartToRemove = existingCharts[i];
                    // Try to destroy the chart instance if it exists
                    if (chartToRemove._apexcharts) {
                        try {
                            chartToRemove._apexcharts.destroy();
                        } catch (e) {
                            console.warn('Error destroying duplicate chart:', e);
                        }
                    }
                    chartToRemove.parentNode.remove();
                }
                // Also remove any duplicate SVG elements
                const svgElements = pageviewsElement.querySelectorAll('svg');
                if (svgElements.length > 1) {
                    for (let i = 1; i < svgElements.length; i++) {
                        svgElements[i].remove();
                    }
                }
                // Remove any duplicate apexcharts containers
                const containers = pageviewsElement.querySelectorAll('.apexcharts-inner, .apexcharts-svg');
                if (containers.length > 2) {
                    // Keep first two (inner and svg), remove rest
                    for (let i = 2; i < containers.length; i++) {
                        containers[i].remove();
                    }
                }
            }
        }
    }
    
    // Run cleanup after charts are initialized (not immediately to avoid interfering)
    setTimeout(cleanupDuplicateCharts, 1500);
    setTimeout(cleanupDuplicateCharts, 2500);
    setTimeout(cleanupDuplicateCharts, 3500);
    
    // Also run cleanup when window loads
    window.addEventListener('load', function() {
        setTimeout(cleanupDuplicateCharts, 500);
        setTimeout(cleanupDuplicateCharts, 1500);
        setTimeout(cleanupDuplicateCharts, 2500);
    });
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                cleanupDuplicateCharts();
                initSummeryDatePicker();
            }, 1500);
        });
    } else {
        setTimeout(function() {
            cleanupDuplicateCharts();
            initSummeryDatePicker();
        }, 1500);
    }
})();

// Global data storage for client-side filtering
let dashboardData = {
    collections: {},
    dumpHistories: {},
    collectionCounts: {}
};

// Fetch all data on page load and initialize chart with current month
(function() {
    function fetchAllData() {
        fetch('{{ route("dashboard") }}?get_all_data=1', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            dashboardData.collections = data.collections || {};
            dashboardData.dumpHistories = data.dumpHistories || {};
            dashboardData.collectionCounts = data.collectionCounts || {};
            
            // Don't update chart here - wait for chart to be initialized first
            // Chart will be updated after it's ready
        })
        .catch(error => {
            console.error('Error fetching dashboard data:', error);
        });
    }
    
    let chartUpdateInProgress = false;
    
    function initializeCurrentMonthChart() {
        // Prevent multiple simultaneous updates
        if (chartUpdateInProgress) {
            return;
        }
        
        // Check if data is loaded
        if (!dashboardData.collections || Object.keys(dashboardData.collections).length === 0) {
            // Data not loaded yet, wait a bit and try again
            setTimeout(initializeCurrentMonthChart, 200);
            return;
        }
        
        // Use the same logic as resetCollectionsChart() to ensure consistency
        // Reset to last 15 days from today (using local time to avoid timezone issues)
        const today = new Date();
        today.setHours(23, 59, 59, 999);
        const endDate = new Date(today);
        const startDate = new Date(today);
        startDate.setDate(startDate.getDate() - 14); // 15 days total (today + 14 previous days)
        startDate.setHours(0, 0, 0, 0);
        
        // Filter collections for the date range
        const filteredCollections = filterByDateRange(dashboardData.collections, startDate, endDate);
        
        // Generate chart data
        const chartData = generateChartData(filteredCollections, startDate, endDate);
        
        const pageViewsElement = document.getElementById('pageviews_overview');
        if (!pageViewsElement) {
            return;
        }
        
        // Update data attributes
        pageViewsElement.setAttribute('data-chart-data', JSON.stringify(chartData.series));
        pageViewsElement.setAttribute('data-chart-categories', JSON.stringify(chartData.categories));
        
        // Update chart if it exists - use the same update logic as resetCollectionsChart
        const chart = (typeof pageViewsOverviewChart !== 'undefined' && pageViewsOverviewChart && pageViewsOverviewChart !== "") 
            ? pageViewsOverviewChart 
            : (typeof window.pageViewsOverviewChart !== 'undefined' && window.pageViewsOverviewChart && window.pageViewsOverviewChart !== "") 
                ? window.pageViewsOverviewChart 
                : null;
        
        if (chart) {
            try {
                chartUpdateInProgress = true;
                chart.updateOptions({
                    series: [{
                        name: 'Collection',
                        data: chartData.series
                    }],
                    xaxis: {
                        categories: chartData.categories
                    }
                }, false, true); // false = no animation, true = sync update
                
                // Reset flag after a short delay
                setTimeout(() => {
                    chartUpdateInProgress = false;
                }, 100);
            } catch (e) {
                // Chart might not be fully initialized, try again later
                console.warn('Chart update failed, will retry:', e);
                chartUpdateInProgress = false;
                setTimeout(initializeCurrentMonthChart, 300);
            }
        } else {
            // Chart not ready, wait and try again
            setTimeout(initializeCurrentMonthChart, 200);
        }
    }
    
    // Wait for both data and chart to be ready before updating
    function waitForChartAndUpdate() {
        // Check if data is loaded
        const dataReady = dashboardData.collections && Object.keys(dashboardData.collections).length > 0;
        
        // Check if chart is ready
        const chartReady = (typeof pageViewsOverviewChart !== 'undefined' && pageViewsOverviewChart && pageViewsOverviewChart !== "") ||
                          (typeof window.pageViewsOverviewChart !== 'undefined' && window.pageViewsOverviewChart && window.pageViewsOverviewChart !== "");
        
        if (dataReady && chartReady) {
            // Both ready, initialize chart
            initializeCurrentMonthChart();
        } else {
            // Not ready yet, check again
            setTimeout(waitForChartAndUpdate, 200);
        }
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            fetchAllData();
            // Wait for both data and chart to be ready
            setTimeout(waitForChartAndUpdate, 500);
        });
    } else {
        fetchAllData();
        setTimeout(waitForChartAndUpdate, 500);
    }
})();

// JavaScript filtering functions
function filterByMonth(data, yearMonth) {
    const [year, month] = yearMonth.split('-').map(Number);
    // Use UTC dates to avoid timezone issues
    const startDate = new Date(Date.UTC(year, month - 1, 1, 0, 0, 0));
    const endDate = new Date(Date.UTC(year, month, 0, 23, 59, 59));
    
    const filtered = {};
    Object.keys(data).forEach(dateStr => {
        // Parse date string as UTC
        const [y, m, d] = dateStr.split('-').map(Number);
        const date = new Date(Date.UTC(y, m - 1, d, 0, 0, 0));
        if (date >= startDate && date <= endDate) {
            filtered[dateStr] = data[dateStr];
        }
    });
    return filtered;
}

function filterByDate(data, dateStr) {
    const filtered = {};
    if (data[dateStr]) {
        filtered[dateStr] = data[dateStr];
    }
    return filtered;
}

function filterByDateRange(data, startDate, endDate) {
    const filtered = {};
    
    // Ensure dates are Date objects and extract date components
    const start = new Date(startDate);
    const end = new Date(endDate);
    
    // Get date components using local date methods
    const startYear = start.getFullYear();
    const startMonth = start.getMonth();
    const startDay = start.getDate();
    
    const endYear = end.getFullYear();
    const endMonth = end.getMonth();
    const endDay = end.getDate();
    
    // Create date objects at midnight local time for comparison
    const startDateLocal = new Date(startYear, startMonth, startDay, 0, 0, 0, 0);
    const endDateLocal = new Date(endYear, endMonth, endDay, 23, 59, 59, 999);
    
    Object.keys(data).forEach(dateStr => {
        // Parse date string (YYYY-MM-DD format from server)
        const [y, m, d] = dateStr.split('-').map(Number);
        // Create date at midnight local time for comparison
        const date = new Date(y, m - 1, d, 0, 0, 0, 0);
        
        if (date >= startDateLocal && date <= endDateLocal) {
            filtered[dateStr] = data[dateStr];
        }
    });
    
    return filtered;
}

function generateChartData(data, startDate, endDate) {
    const chartData = [];
    const chartCategories = [];
    const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    
    // Use provided date range if available, otherwise fall back to last 15 days from today
    let datesToShow = [];
    
    if (startDate && endDate) {
        // Use the provided date range - extract year, month, day to avoid timezone issues
        const start = new Date(startDate);
        const end = new Date(endDate);
        
        // Get date components using local date methods to match what user selected
        const startYear = start.getFullYear();
        const startMonth = start.getMonth();
        const startDay = start.getDate();
        
        const endYear = end.getFullYear();
        const endMonth = end.getMonth();
        const endDay = end.getDate();
        
        // Create date objects at midnight local time for start
        const startDateLocal = new Date(startYear, startMonth, startDay, 0, 0, 0, 0);
        // Create end date at end of day to ensure the last day is included
        const endDateLocal = new Date(endYear, endMonth, endDay, 23, 59, 59, 999);
        
        // Calculate the number of days between start and end (inclusive)
        // Use date components directly for accurate calculation
        const startDateOnly = new Date(startYear, startMonth, startDay);
        const endDateOnly = new Date(endYear, endMonth, endDay);
        const daysDiff = Math.round((endDateOnly - startDateOnly) / (1000 * 60 * 60 * 24)) + 1;
        
        // Generate all dates in the range (inclusive of both start and end)
        // Use a more reliable method: iterate from start to end date
        // Calculate the exact number of days to ensure we get exactly 15 days when range is 15 days
        const currentDate = new Date(startDateLocal);
        const endDateForLoop = new Date(endYear, endMonth, endDay, 0, 0, 0, 0);
        
        // Use daysDiff to ensure we generate exactly the right number of days
        for (let i = 0; i < daysDiff; i++) {
            const dateToAdd = new Date(startYear, startMonth, startDay + i, 0, 0, 0, 0);
            datesToShow.push(dateToAdd);
        }
    } else {
        // Fall back to last 15 days from today (for backward compatibility)
        const today = new Date();
        today.setHours(23, 59, 59, 999);
        
        for (let i = 0; i < 15; i++) {
            const date = new Date(today);
            date.setDate(date.getDate() - i);
            date.setHours(0, 0, 0, 0);
            datesToShow.unshift(date); // Add to beginning to show oldest first
        }
    }
    
    // Process dates from oldest to newest
    datesToShow.forEach(current => {
        // Format date as YYYY-MM-DD using local date methods
        const year = current.getFullYear();
        const month = String(current.getMonth() + 1).padStart(2, '0');
        const day = String(current.getDate()).padStart(2, '0');
        const dateStr = `${year}-${month}-${day}`;
        
        // Format day without leading zero (1, 3, 5, etc.)
        const dayNum = current.getDate();
        const monthName = monthNames[current.getMonth()];
        
        chartCategories.push(dayNum + ' ' + monthName);
        chartData.push(data[dateStr] || 0);
    });
    
    return { series: chartData, categories: chartCategories };
}

function getCountForMonth(data, yearMonth) {
    const filtered = filterByMonth(data, yearMonth);
    return Object.values(filtered).reduce((sum, count) => sum + count, 0);
}

function getCountForDate(data, dateStr) {
    return data[dateStr] || 0;
}

function getCountForDateRange(data, startDate, endDate) {
    const filtered = filterByDateRange(data, startDate, endDate);
    return Object.values(filtered).reduce((sum, count) => sum + count, 0);
}

// Handle Collections dropdown filter with datepicker
(function() {
    let collectionDatePicker = null;
    
    function initCollectionDatePicker() {
        // Find the Collections card
        const cards = document.querySelectorAll('.card');
        let collectionsCard = null;
        
        for (let i = 0; i < cards.length; i++) {
            const title = cards[i].querySelector('.card-title');
            if (title && title.textContent.trim() === 'Collections') {
                collectionsCard = cards[i];
                break;
            }
        }
        
        if (!collectionsCard) {
            return;
        }
        
        const dateRangeInput = document.getElementById('collection_date_range');
        if (!dateRangeInput) {
            return;
        }
        
        const dropdownBtn = collectionsCard.querySelector('.dropdown-btn');
        const dropdownMenu = collectionsCard.querySelector('.dropdown-menu');
        
        // Destroy any existing flatpickr instance
        if (dateRangeInput._flatpickr) {
            dateRangeInput._flatpickr.destroy();
        }
        
        // Get clear button
        const clearBtn = document.getElementById('clear_collection_date');
        
        // Initialize flatpickr with 15-day maximum range
        if (typeof flatpickr !== 'undefined') {
            collectionDatePicker = flatpickr(dateRangeInput, {
                mode: "range",
                dateFormat: "Y-m-d",
                maxDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    // Show/hide clear button
                    if (clearBtn) {
                        if (selectedDates.length === 2 && dateStr) {
                            clearBtn.style.display = 'block';
                        } else {
                            clearBtn.style.display = 'none';
                        }
                    }
                    
                    if (selectedDates.length === 2) {
                        const startDate = selectedDates[0];
                        const endDate = selectedDates[1];
                        
                        // Calculate days difference using date components for accuracy
                        const startYear = startDate.getFullYear();
                        const startMonth = startDate.getMonth();
                        const startDay = startDate.getDate();
                        const endYear = endDate.getFullYear();
                        const endMonth = endDate.getMonth();
                        const endDay = endDate.getDate();
                        
                        const startDateOnly = new Date(startYear, startMonth, startDay);
                        const endDateOnly = new Date(endYear, endMonth, endDay);
                        const daysDiff = Math.round((endDateOnly - startDateOnly) / (1000 * 60 * 60 * 24)) + 1;
                        
                        // Check if range exceeds 15 days
                        if (daysDiff > 15) {
                            // Reset to valid range (first 15 days from start)
                            const validEndDate = new Date(startDate);
                            validEndDate.setDate(validEndDate.getDate() + 14);
                            
                            instance.setDate([startDate, validEndDate], false);
                            
                            // Show warning
                            if (typeof Toastify !== 'undefined') {
                                Toastify({
                                    text: "Maximum date range is 15 days. Selection adjusted.",
                                    gravity: "top",
                                    position: "right",
                                    className: "bg-warning"
                                }).showToast();
                            }
                            return;
                        }
                        
                        // Filter and update chart
                        filterCollectionsByDateRange(startDate, endDate);
                    } else if (selectedDates.length === 0) {
                        // Date cleared, reset chart to show all data
                        resetCollectionsChart();
                    }
                },
                onClose: function(selectedDates, dateStr, instance) {
                    // Update clear button visibility
                    if (clearBtn) {
                        if (selectedDates.length === 2 && dateStr) {
                            clearBtn.style.display = 'block';
                        } else {
                            clearBtn.style.display = 'none';
                        }
                    }
                },
                onReady: function(selectedDates, dateStr, instance) {
                    // Prevent closing dropdown when clicking inside datepicker
                    if (instance.calendarContainer) {
                        instance.calendarContainer.addEventListener('click', function(e) {
                            e.stopPropagation();
                        });
                    }
                    
                    // Update clear button visibility on ready
                    if (clearBtn) {
                        if (selectedDates.length === 2 && dateStr) {
                            clearBtn.style.display = 'block';
                        } else {
                            clearBtn.style.display = 'none';
                        }
                    }
                }
            });
        }
        
        // Handle clear button click
        if (clearBtn) {
            clearBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (collectionDatePicker) {
                    collectionDatePicker.clear();
                    resetCollectionsChart();
                }
            });
        }
        
        // Open datepicker when dropdown is opened
        if (dropdownBtn && dropdownMenu && collectionDatePicker) {
            dropdownBtn.addEventListener('click', function(e) {
                // Wait for dropdown to be shown, then open datepicker
                setTimeout(function() {
                    // Check if dropdown is visible
                    if (dropdownMenu.classList.contains('show')) {
                        // Small delay to ensure dropdown is fully rendered
                        setTimeout(function() {
                            if (collectionDatePicker && !collectionDatePicker.isOpen) {
                                collectionDatePicker.open();
                            }
                        }, 100);
                    }
                }, 100);
            });
        }
        
        // Prevent dropdown from closing when clicking inside (except on the input)
        if (dropdownMenu) {
            dropdownMenu.addEventListener('click', function(e) {
                // Allow clicks on the input, clear button, and datepicker calendar
                const clearBtn = document.getElementById('clear_collection_date');
                const isDatepickerElement = e.target.closest('.flatpickr-calendar') || 
                                          e.target === dateRangeInput || 
                                          dateRangeInput.contains(e.target) ||
                                          e.target === clearBtn ||
                                          e.target.closest('#clear_collection_date');
                
                if (!isDatepickerElement) {
                    e.stopPropagation();
                }
            });
        }
    }
    
    function filterCollectionsByDateRange(startDate, endDate) {
        // Filter data using JavaScript
        const filteredCollections = filterByDateRange(dashboardData.collections, startDate, endDate);
        
        // Generate chart data
        const chartData = generateChartData(filteredCollections, startDate, endDate);
        
        const pageViewsElement = document.getElementById('pageviews_overview');
        if (!pageViewsElement) {
            console.error('pageviews_overview element not found');
            return;
        }
        
        // Update data attributes
        pageViewsElement.setAttribute('data-chart-data', JSON.stringify(chartData.series));
        pageViewsElement.setAttribute('data-chart-categories', JSON.stringify(chartData.categories));
        
        // Update the chart
        if (typeof pageViewsOverviewChart !== 'undefined' && pageViewsOverviewChart && pageViewsOverviewChart !== "") {
            pageViewsOverviewChart.updateOptions({
                series: [{
                    name: 'Collection',
                    data: chartData.series
                }],
                xaxis: {
                    categories: chartData.categories
                }
            });
        } else if (typeof window.pageViewsOverviewChart !== 'undefined' && window.pageViewsOverviewChart && window.pageViewsOverviewChart !== "") {
            window.pageViewsOverviewChart.updateOptions({
                series: [{
                    name: 'Collection',
                    data: chartData.series
                }],
                xaxis: {
                    categories: chartData.categories
                }
            });
        } else {
            // Chart not ready, reload it
            if (typeof loadCharts === 'function') {
                loadCharts();
            }
        }
    }
    
    function resetCollectionsChart() {
        // Reset to last 15 days from today (using local time to avoid timezone issues)
        const today = new Date();
        today.setHours(23, 59, 59, 999);
        const endDate = new Date(today);
        const startDate = new Date(today);
        startDate.setDate(startDate.getDate() - 14);
        startDate.setHours(0, 0, 0, 0);
        
        // Filter collections for the date range
        const filteredCollections = filterByDateRange(dashboardData.collections, startDate, endDate);
        
        // Generate chart data
        const chartData = generateChartData(filteredCollections, startDate, endDate);
        
        const pageViewsElement = document.getElementById('pageviews_overview');
        if (!pageViewsElement) {
            return;
        }
        
        // Update data attributes
        pageViewsElement.setAttribute('data-chart-data', JSON.stringify(chartData.series));
        pageViewsElement.setAttribute('data-chart-categories', JSON.stringify(chartData.categories));
        
        // Update the chart
        if (typeof pageViewsOverviewChart !== 'undefined' && pageViewsOverviewChart && pageViewsOverviewChart !== "") {
            pageViewsOverviewChart.updateOptions({
                series: [{
                    name: 'Collection',
                    data: chartData.series
                }],
                xaxis: {
                    categories: chartData.categories
                }
            });
        } else if (typeof window.pageViewsOverviewChart !== 'undefined' && window.pageViewsOverviewChart && window.pageViewsOverviewChart !== "") {
            window.pageViewsOverviewChart.updateOptions({
                series: [{
                    name: 'Collection',
                    data: chartData.series
                }],
                xaxis: {
                    categories: chartData.categories
                }
            });
        } else {
            if (typeof loadCharts === 'function') {
                loadCharts();
            }
        }
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initCollectionDatePicker, 1500);
        });
    } else {
        setTimeout(initCollectionDatePicker, 1500);
    }
})();

// Handle Billing Summary dropdown filter with datepicker
(function() {
    let billingDatePicker = null;
    
    function initBillingDatePicker() {
        const dateRangeInput = document.getElementById('billing_date_range');
        if (!dateRangeInput) {
            return;
        }
        
        // Find the Billing Summary card
        const cards = document.querySelectorAll('.card');
        let billingCard = null;
        
        for (let i = 0; i < cards.length; i++) {
            const title = cards[i].querySelector('.card-title');
            if (title && title.textContent.trim() === 'Billing Summary') {
                billingCard = cards[i];
                break;
            }
        }
        
        if (!billingCard) {
            return;
        }
        
        const dropdownBtn = billingCard.querySelector('.dropdown-btn');
        const dropdownMenu = billingCard.querySelector('.dropdown-menu');
        
        // Destroy any existing flatpickr instance
        if (dateRangeInput._flatpickr) {
            dateRangeInput._flatpickr.destroy();
        }
        
        // Get clear button
        const clearBtn = document.getElementById('clear_billing_date');
        
        // Initialize flatpickr
        if (typeof flatpickr !== 'undefined') {
            billingDatePicker = flatpickr(dateRangeInput, {
                mode: "range",
                dateFormat: "Y-m-d",
                maxDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    // Show/hide clear button
                    if (clearBtn) {
                        if (selectedDates.length === 2 && dateStr) {
                            clearBtn.style.display = 'block';
                        } else {
                            clearBtn.style.display = 'none';
                        }
                    }
                    
                    if (selectedDates.length === 2) {
                        const startDate = selectedDates[0];
                        const endDate = selectedDates[1];
                        
                        // Fetch billing counts for the selected date range
                        fetchBillingCounts(startDate, endDate);
                    } else if (selectedDates.length === 0) {
                        // Date cleared, reset to current month
                        resetBillingCounts();
                    }
                },
                onClose: function(selectedDates, dateStr, instance) {
                    // Update clear button visibility
                    if (clearBtn) {
                        if (selectedDates.length === 2 && dateStr) {
                            clearBtn.style.display = 'block';
                        } else {
                            clearBtn.style.display = 'none';
                        }
                    }
                },
                onReady: function(selectedDates, dateStr, instance) {
                    // Prevent closing dropdown when clicking inside datepicker
                    if (instance.calendarContainer) {
                        instance.calendarContainer.addEventListener('click', function(e) {
                            e.stopPropagation();
                        });
                    }
                    
                    // Update clear button visibility on ready
                    if (clearBtn) {
                        if (selectedDates.length === 2 && dateStr) {
                            clearBtn.style.display = 'block';
                        } else {
                            clearBtn.style.display = 'none';
                        }
                    }
                }
            });
        }
        
        // Handle clear button click
        if (clearBtn) {
            clearBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (billingDatePicker) {
                    billingDatePicker.clear();
                    resetBillingCounts();
                }
            });
        }
        
        // Open datepicker when dropdown is opened
        if (dropdownBtn && dropdownMenu && billingDatePicker) {
            dropdownBtn.addEventListener('click', function(e) {
                // Wait for dropdown to be shown, then open datepicker
                setTimeout(function() {
                    // Check if dropdown is visible
                    if (dropdownMenu.classList.contains('show')) {
                        // Small delay to ensure dropdown is fully rendered
                        setTimeout(function() {
                            if (billingDatePicker && !billingDatePicker.isOpen) {
                                billingDatePicker.open();
                            }
                        }, 100);
                    }
                }, 100);
            });
        }
        
        // Prevent dropdown from closing when clicking inside (except on the input)
        if (dropdownMenu) {
            dropdownMenu.addEventListener('click', function(e) {
                // Allow clicks on the input, clear button, and datepicker calendar
                const isDatepickerElement = e.target.closest('.flatpickr-calendar') || 
                                          e.target === dateRangeInput || 
                                          dateRangeInput.contains(e.target) ||
                                          e.target === clearBtn ||
                                          e.target.closest('#clear_billing_date');
                
                if (!isDatepickerElement) {
                    e.stopPropagation();
                }
            });
        }
    }
    
    function fetchBillingCounts(startDate, endDate) {
        const startDateStr = startDate.toISOString().split('T')[0];
        const endDateStr = endDate.toISOString().split('T')[0];
        
        fetch('{{ route("dashboard") }}?get_billing_counts=1&start_date=' + startDateStr + '&end_date=' + endDateStr, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            // Update the counter values
            updateBillingCounts(data.generatedBills || 0, data.unpaidInvoices || 0, data.paidInvoices || 0);
        })
        .catch(error => {
            console.error('Error fetching billing counts:', error);
        });
    }
    
    function resetBillingCounts() {
        // Reset to current month (default values from server)
        fetch('{{ route("dashboard") }}?get_billing_counts=1', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            // Update the counter values
            updateBillingCounts(data.generatedBills || 0, data.unpaidInvoices || 0, data.paidInvoices || 0);
        })
        .catch(error => {
            console.error('Error fetching billing counts:', error);
        });
    }
    
    function updateBillingCounts(generatedBills, unpaidInvoices, paidInvoices) {
        // Find billing summary card
        const billingCard = document.querySelector('.card-title');
        let billingSummaryCard = null;
        
        // Find the card with "Billing Summary" title
        const cards = document.querySelectorAll('.card');
        for (let i = 0; i < cards.length; i++) {
            const title = cards[i].querySelector('.card-title');
            if (title && title.textContent.trim() === 'Billing Summary') {
                billingSummaryCard = cards[i];
                break;
            }
        }
        
        if (!billingSummaryCard) {
            return;
        }
        
        // Find each count card within billing summary
        const countCards = billingSummaryCard.querySelectorAll('.card-border-warning, .card-border-danger, .card-border-success');
        
        countCards.forEach(function(card) {
            const label = card.querySelector('.fs-md');
            const counter = card.querySelector('.counter-value');
            
            if (label && counter) {
                const labelText = label.textContent.trim();
                let newValue = 0;
                
                if (labelText === 'Generated Bills') {
                    newValue = generatedBills;
                } else if (labelText === 'Unpaid Invoices') {
                    newValue = unpaidInvoices;
                } else if (labelText === 'Paid Invoices') {
                    newValue = paidInvoices;
                }
                
                if (newValue !== null) {
                    counter.setAttribute('data-target', newValue);
                    counter.textContent = newValue;
                    // Trigger counter animation if available
                    if (typeof counterUp !== 'undefined') {
                        counterUp(counter, {
                            duration: 1000,
                            delay: 16
                        });
                    }
                }
            }
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initBillingDatePicker, 1500);
        });
    } else {
        setTimeout(initBillingDatePicker, 1500);
    }
})();

// Handle Driver Chart dropdown filter with datepicker
(function() {
    let driverChartDatePicker = null;
    var chartGroupbar = "";
    
    function initDriverChartDatePicker() {
        const dateRangeInput = document.getElementById('driver_chart_date_range');
        if (!dateRangeInput) {
            return;
        }
        
        // Find the Driver Chart card
        const cards = document.querySelectorAll('.card');
        let driverChartCard = null;
        
        for (let i = 0; i < cards.length; i++) {
            const title = cards[i].querySelector('.card-title');
            if (title && title.textContent.trim() === 'Collection & Dumps Count by Driver') {
                driverChartCard = cards[i];
                break;
            }
        }
        
        if (!driverChartCard) {
            return;
        }
        
        const dropdownBtn = driverChartCard.querySelector('.dropdown-btn');
        const dropdownMenu = driverChartCard.querySelector('.dropdown-menu');
        
        // Destroy any existing flatpickr instance
        if (dateRangeInput._flatpickr) {
            dateRangeInput._flatpickr.destroy();
        }
        
        // Get clear button
        const clearBtn = document.getElementById('clear_driver_chart_date');
        
        // Initialize flatpickr
        if (typeof flatpickr !== 'undefined') {
            driverChartDatePicker = flatpickr(dateRangeInput, {
                mode: "range",
                dateFormat: "Y-m-d",
                maxDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    // Show/hide clear button
                    if (clearBtn) {
                        if (selectedDates.length === 2 && dateStr) {
                            clearBtn.style.display = 'block';
                        } else {
                            clearBtn.style.display = 'none';
                        }
                    }
                    
                    if (selectedDates.length === 2) {
                        const startDate = selectedDates[0];
                        const endDate = selectedDates[1];
                        
                        // Fetch and update chart data for the selected date range
                        fetchDriverChartData(startDate, endDate);
                    } else if (selectedDates.length === 0) {
                        // Date cleared, reset to current month
                        resetDriverChart();
                    }
                },
                onClose: function(selectedDates, dateStr, instance) {
                    // Update clear button visibility
                    if (clearBtn) {
                        if (selectedDates.length === 2 && dateStr) {
                            clearBtn.style.display = 'block';
                        } else {
                            clearBtn.style.display = 'none';
                        }
                    }
                },
                onReady: function(selectedDates, dateStr, instance) {
                    // Prevent closing dropdown when clicking inside datepicker
                    if (instance.calendarContainer) {
                        instance.calendarContainer.addEventListener('click', function(e) {
                            e.stopPropagation();
                        });
                    }
                    
                    // Update clear button visibility on ready
                    if (clearBtn) {
                        if (selectedDates.length === 2 && dateStr) {
                            clearBtn.style.display = 'block';
                        } else {
                            clearBtn.style.display = 'none';
                        }
                    }
                }
            });
        }
        
        // Handle clear button click
        if (clearBtn) {
            clearBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (driverChartDatePicker) {
                    driverChartDatePicker.clear();
                    resetDriverChart();
                }
            });
        }
        
        // Open datepicker when dropdown is opened
        if (dropdownBtn && dropdownMenu && driverChartDatePicker) {
            dropdownBtn.addEventListener('click', function(e) {
                // Wait for dropdown to be shown, then open datepicker
                setTimeout(function() {
                    // Check if dropdown is visible
                    if (dropdownMenu.classList.contains('show')) {
                        // Small delay to ensure dropdown is fully rendered
                        setTimeout(function() {
                            if (driverChartDatePicker && !driverChartDatePicker.isOpen) {
                                driverChartDatePicker.open();
                            }
                        }, 100);
                    }
                }, 100);
            });
        }
        
        // Prevent dropdown from closing when clicking inside (except on the input)
        if (dropdownMenu) {
            dropdownMenu.addEventListener('click', function(e) {
                // Allow clicks on the input, clear button, and datepicker calendar
                const isDatepickerElement = e.target.closest('.flatpickr-calendar') || 
                                          e.target === dateRangeInput || 
                                          dateRangeInput.contains(e.target) ||
                                          e.target === clearBtn ||
                                          e.target.closest('#clear_driver_chart_date');
                
                if (!isDatepickerElement) {
                    e.stopPropagation();
                }
            });
        }
        
        // Initialize chart with current month data from server
        @if(isset($bar_cart))
        setTimeout(function() {
            updateDriverChart({
                drivers: "{{ $bar_cart['drivers'] }}",
                collections: "{{ $bar_cart['collections'] }}",
                dumps: "{{ $bar_cart['dumps'] }}"
            });
        }, 1000);
        @else
        setTimeout(function() {
            resetDriverChart();
        }, 500);
        @endif
    }
    
    function fetchDriverChartData(startDate, endDate) {
        const startDateStr = startDate.toISOString().split('T')[0];
        const endDateStr = endDate.toISOString().split('T')[0];
        
        fetch('{{ route("dashboard") }}?get_driver_chart_data=1&start_date=' + startDateStr + '&end_date=' + endDateStr, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            updateDriverChart(data);
        })
        .catch(error => {
            console.error('Error fetching driver chart data:', error);
        });
    }
    
    function resetDriverChart() {
        // Reset to current month (default values from server)
        fetch('{{ route("dashboard") }}?get_driver_chart_data=1', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            updateDriverChart(data);
        })
        .catch(error => {
            console.error('Error fetching driver chart data:', error);
        });
    }
    
    function updateDriverChart(barCart) {
        // Wait for DOM and dependencies to be ready
        function initChart() {
            var chartElement = document.querySelector("#collection_dump_bar");
            if (!chartElement) {
                setTimeout(initChart, 100);
                return;
            }
            
            // Check if ApexCharts is available
            if (typeof ApexCharts === 'undefined') {
                setTimeout(initChart, 200);
                return;
            }
            
            // Check if getChartColorsArray is available
            if (typeof getChartColorsArray === 'undefined') {
                setTimeout(initChart, 200);
                return;
            }
            
            try {
                var chartGroupbarColors = "";
                chartGroupbarColors = getChartColorsArray("collection_dump_bar");
                if (chartGroupbarColors) {
                    // Parse the data strings into arrays
                    var collectionsData = barCart.collections ? barCart.collections.split(',').map(function(item) {
                        return parseInt(item.trim()) || 0;
                    }) : [];
                    var dumpsData = barCart.dumps ? barCart.dumps.split(',').map(function(item) {
                        return parseInt(item.trim()) || 0;
                    }) : [];
                    var driversCategories = barCart.drivers ? barCart.drivers.split(',').map(function(item) {
                        return item.trim().replace(/"/g, '');
                    }) : [];
                    
                    var options = {
                        series: [{
                            name: "Collection Count",
                            data: collectionsData
                        }, {
                            name: "Dumps Count",
                            data: dumpsData
                        }],
                        chart: {
                            type: 'bar',
                            height: 410,
                            toolbar: {
                                show: false,
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                dataLabels: {
                                    position: 'top',
                                },
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            offsetX: -6,
                            style: {
                                fontSize: '12px',
                                colors: ['#fff']
                            }
                        },
                        grid: {
                            padding: {
                                bottom: -14,
                                left: 0,
                                right: 0
                            }
                        },
                        stroke: {
                            show: true,
                            width: 1,
                            colors: ['#fff']
                        },
                        tooltip: {
                            shared: true,
                            intersect: false
                        },
                        xaxis: {
                            categories: driversCategories,
                        },
                        colors: chartGroupbarColors
                    };

                    // Ensure chartGroupbar is declared globally
                    if (typeof chartGroupbar === 'undefined') {
                        window.chartGroupbar = "";
                    }
                    
                    if (window.chartGroupbar && window.chartGroupbar !== "") {
                        window.chartGroupbar.destroy();
                    }
                    
                    window.chartGroupbar = new ApexCharts(chartElement, options);
                    window.chartGroupbar.render();
                }
            } catch (e) {
                console.error("Error initializing driver chart:", e);
            }
        }
        
        // Start initialization
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(initChart, 100);
            });
        } else {
            setTimeout(initChart, 100);
        }
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initDriverChartDatePicker, 1500);
        });
    } else {
        setTimeout(initDriverChartDatePicker, 1500);
    }
})();

// Handle Billing Chart dropdown filter with datepicker
(function() {
    let billingChartDatePicker = null;
    var billingChartGroupbar = "";
    
    function initBillingChartDatePicker() {
        const dateRangeInput = document.getElementById('billing_chart_date_range');
        if (!dateRangeInput) {
            return;
        }
        
        // Find the Billing Chart card
        const cards = document.querySelectorAll('.card');
        let billingChartCard = null;
        
        for (let i = 0; i < cards.length; i++) {
            const title = cards[i].querySelector('.card-title');
            if (title && title.textContent.trim() === 'Billing Summary') {
                billingChartCard = cards[i];
                break;
            }
        }
        
        if (!billingChartCard) {
            return;
        }
        
        const dropdownBtn = billingChartCard.querySelector('.dropdown-btn');
        const dropdownMenu = billingChartCard.querySelector('.dropdown-menu');
        
        // Destroy any existing flatpickr instance
        if (dateRangeInput._flatpickr) {
            dateRangeInput._flatpickr.destroy();
        }
        
        // Get clear button
        const clearBtn = document.getElementById('clear_billing_chart_date');
        
        // Initialize flatpickr
        if (typeof flatpickr !== 'undefined') {
            billingChartDatePicker = flatpickr(dateRangeInput, {
                mode: "range",
                dateFormat: "Y-m-d",
                maxDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    // Show/hide clear button
                    if (clearBtn) {
                        if (selectedDates.length === 2 && dateStr) {
                            clearBtn.style.display = 'block';
                        } else {
                            clearBtn.style.display = 'none';
                        }
                    }
                    
                    if (selectedDates.length === 2) {
                        const startDate = selectedDates[0];
                        const endDate = selectedDates[1];
                        
                        // Fetch and update chart data for the selected date range
                        fetchBillingChartData(startDate, endDate);
                    } else if (selectedDates.length === 0) {
                        // Date cleared, reset to current month
                        resetBillingChart();
                    }
                },
                onClose: function(selectedDates, dateStr, instance) {
                    // Update clear button visibility
                    if (clearBtn) {
                        if (selectedDates.length === 2 && dateStr) {
                            clearBtn.style.display = 'block';
                        } else {
                            clearBtn.style.display = 'none';
                        }
                    }
                },
                onReady: function(selectedDates, dateStr, instance) {
                    // Prevent closing dropdown when clicking inside datepicker
                    if (instance.calendarContainer) {
                        instance.calendarContainer.addEventListener('click', function(e) {
                            e.stopPropagation();
                        });
                    }
                    
                    // Update clear button visibility on ready
                    if (clearBtn) {
                        if (selectedDates.length === 2 && dateStr) {
                            clearBtn.style.display = 'block';
                        } else {
                            clearBtn.style.display = 'none';
                        }
                    }
                }
            });
        }
        
        // Handle clear button click
        if (clearBtn) {
            clearBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (billingChartDatePicker) {
                    billingChartDatePicker.clear();
                    resetBillingChart();
                }
            });
        }
        
        // Open datepicker when dropdown is opened
        if (dropdownBtn && dropdownMenu && billingChartDatePicker) {
            dropdownBtn.addEventListener('click', function(e) {
                // Wait for dropdown to be shown, then open datepicker
                setTimeout(function() {
                    // Check if dropdown is visible
                    if (dropdownMenu.classList.contains('show')) {
                        // Small delay to ensure dropdown is fully rendered
                        setTimeout(function() {
                            if (billingChartDatePicker && !billingChartDatePicker.isOpen) {
                                billingChartDatePicker.open();
                            }
                        }, 100);
                    }
                }, 100);
            });
        }
        
        // Prevent dropdown from closing when clicking inside (except on the input)
        if (dropdownMenu) {
            dropdownMenu.addEventListener('click', function(e) {
                // Allow clicks on the input, clear button, and datepicker calendar
                const isDatepickerElement = e.target.closest('.flatpickr-calendar') || 
                                          e.target === dateRangeInput || 
                                          dateRangeInput.contains(e.target) ||
                                          e.target === clearBtn ||
                                          e.target.closest('#clear_billing_chart_date');
                
                if (!isDatepickerElement) {
                    e.stopPropagation();
                }
            });
        }
        
        // Initialize chart with current month data from server
        @if(isset($generatedBills) && isset($unpaidInvoices) && isset($paidInvoices))
        setTimeout(function() {
            updateBillingChart({
                generatedBills: {{ $generatedBills ?? 0 }},
                unpaidInvoices: {{ $unpaidInvoices ?? 0 }},
                paidInvoices: {{ $paidInvoices ?? 0 }}
            });
        }, 1000);
        @else
        setTimeout(function() {
            resetBillingChart();
        }, 500);
        @endif
    }
    
    function fetchBillingChartData(startDate, endDate) {
        const startDateStr = startDate.toISOString().split('T')[0];
        const endDateStr = endDate.toISOString().split('T')[0];
        
        fetch('{{ route("dashboard") }}?get_billing_counts=1&start_date=' + startDateStr + '&end_date=' + endDateStr, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            updateBillingChart(data);
        })
        .catch(error => {
            console.error('Error fetching billing chart data:', error);
        });
    }
    
    function resetBillingChart() {
        // Reset to current month (default values from server)
        fetch('{{ route("dashboard") }}?get_billing_counts=1', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            updateBillingChart(data);
        })
        .catch(error => {
            console.error('Error fetching billing chart data:', error);
        });
    }
    
    function updateBillingChart(billingData) {
        // Wait for DOM and dependencies to be ready
        function initChart() {
            var chartElement = document.querySelector("#billing_summary_bar");
            if (!chartElement) {
                setTimeout(initChart, 100);
                return;
            }
            
            // Check if ApexCharts is available
            if (typeof ApexCharts === 'undefined') {
                setTimeout(initChart, 200);
                return;
            }
            
            // Check if getChartColorsArray is available
            if (typeof getChartColorsArray === 'undefined') {
                setTimeout(initChart, 200);
                return;
            }
            
            try {
                var chartGroupbarColors = "";
                chartGroupbarColors = getChartColorsArray("billing_summary_bar");
                if (chartGroupbarColors) {
                    var options = {
                        series: [{
                            name: "Billing Count",
                            data: [
                                billingData.generatedBills || 0,
                                billingData.unpaidInvoices || 0,
                                billingData.paidInvoices || 0
                            ]
                        }],
                        chart: {
                            type: 'bar',
                            height: 410,
                            toolbar: {
                                show: false,
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                dataLabels: {
                                    position: 'top',
                                },
                                distributed: true, // This makes each bar use a different color
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            offsetX: -6,
                            style: {
                                fontSize: '12px',
                                colors: ['#fff']
                            }
                        },
                        grid: {
                            padding: {
                                bottom: -14,
                                left: 0,
                                right: 0
                            }
                        },
                        stroke: {
                            show: true,
                            width: 1,
                            colors: ['#fff']
                        },
                        tooltip: {
                            shared: false,
                            intersect: true
                        },
                        xaxis: {
                            categories: ['Generated Bills', 'Unpaid Invoices', 'Paid Invoices'],
                        },
                        colors: chartGroupbarColors
                    };

                    // Ensure billingChartGroupbar is declared globally
                    if (typeof billingChartGroupbar === 'undefined') {
                        window.billingChartGroupbar = "";
                    }
                    
                    if (window.billingChartGroupbar && window.billingChartGroupbar !== "") {
                        window.billingChartGroupbar.destroy();
                    }
                    
                    window.billingChartGroupbar = new ApexCharts(chartElement, options);
                    window.billingChartGroupbar.render();
                }
            } catch (e) {
                console.error("Error initializing billing chart:", e);
            }
        }
        
        // Start initialization
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(initChart, 100);
            });
        } else {
            setTimeout(initChart, 100);
        }
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initBillingChartDatePicker, 1500);
        });
    } else {
        setTimeout(initBillingChartDatePicker, 1500);
    }
})();
</script>
@endsection
