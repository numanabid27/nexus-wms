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
                        <div class="dropdown-menu dropdown-menu-end">
                            @php
                                $today = \Carbon\Carbon::today();
                                $currentMonth = $today->month;
                                $currentYear = $today->year;
                                
                                // Generate months (current month and previous months)
                                $currentMonthStart = $today->copy()->startOfMonth();
                                for ($i = 0; $i < 12; $i++) {
                                    $month = $currentMonthStart->copy()->subMonths($i);
                                    $monthLabel = $month->format('M Y');
                                    $monthValue = $month->format('Y-m');
                                    echo '<a class="dropdown-item collection-filter" href="#!" data-month="' . $monthValue . '">' . $monthLabel . '</a>';
                                }
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
            <!--end card-header-->
            <div class="card-body">
                <div id="pageviews_overview" 
                    data-collection="{{ $totalCollections ?? 0 }}" 
                    data-chart-data="{{ json_encode($chartData ?? []) }}"
                    data-chart-categories="{{ json_encode($chartCategories ?? []) }}"
                    data-colors='["--tb-primary", "--tb-light"]' 
                    class="apex-charts ms-n3"
                    dir="ltr"></div>
                <div class="row mt-3 g-3">
                    <div class="col-md-4 col-sm-6">
                        <div class="d-flex gap-2 align-items-center border-end-sm">
                            <div class="avatar-sm flex-shrink-0">
                                <div class="avatar-title rounded bg-light bg-opacity-50 text-secondary fs-2xl">
                                    <i class="bi bi-megaphone"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-lg"><span class="counter-value" data-target="7490"></span> <span
                                        class="fs-xs text-success ms-1"><i class="ph ph-trend-up align-middle me-1"></i>
                                        11.78%</span></h5>
                                <p class="text-muted mb-0">Social Media</p>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-md-4 col-sm-6">
                        <div class="d-flex gap-2 align-items-center border-end-sm">
                            <div class="avatar-sm flex-shrink-0">
                                <div class="avatar-title rounded bg-light bg-opacity-50 text-info fs-2xl">
                                    <i class="bi bi-globe"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-lg"><span class="counter-value" data-target="6583"></span> <span
                                        class="fs-xs text-success ms-1"><i class="ph ph-trend-up align-middle me-1"></i>
                                        07.25%</span></h5>
                                <p class="text-muted mb-0">Website</p>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-md-4 col-sm-6">
                        <div class="d-flex gap-2 align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <div class="avatar-title rounded bg-light bg-opacity-50 text-body fs-2xl">
                                    <i class="bi bi-clock-history"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-lg"><span class="counter-value" data-target="14652"></span> <span
                                        class="fs-xs text-danger ms-1"><i
                                            class="ph ph-trend-down align-middle me-1"></i> 02.31%</span></h5>
                                <p class="text-muted mb-0">Avg. Session Duration</p>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end col-->
    <div class="col-xl-3 col-lg-6">
        <div class="card card-height-100">
            <div class="card-header d-flex">
                <h5 class="card-title mb-0 flex-grow-1">Weekly Visitors</h5>
                <div class="flex-shrink-0">
                    <div class="dropdown card-header-dropdown">
                        <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted fs-lg"><i class="bi bi-three-dots-vertical"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#!">Current Years</a>
                            <a class="dropdown-item" href="#!">Last Years</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="weekly_visitors" data-colors='["--tb-info", "--tb-primary"]' class="apex-charts"
                    dir="ltr"></div>
            </div>
        </div>
    </div>
    <!--end col-->
    <div class="col-xl-4 col-lg-6">
        <div class="card card-height-100">
            <div class="card-header d-flex">
                <h5 class="card-title mb-0 flex-grow-1">Audience Sessions by Country</h5>
                <div class="flex-shrink-0">
                    <div class="dropdown card-header-dropdown">
                        <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted fs-lg"><i class="bi bi-three-dots-vertical"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#!">Current Years</a>
                            <a class="dropdown-item" href="#!">Last Years</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="session_country" data-colors='["--tb-primary", "--tb-card-bg"]' class="apex-charts ms-n3"
                    dir="ltr"></div>
            </div>
        </div>
    </div>
    <!--end col-->
    <div class="col-xl-4">
        <div class="card card-height-100">
            <div class="card-header d-flex">
                <h5 class="card-title mb-0 flex-grow-1">Traffic Channel</h5>
                <div class="flex-shrink-0">
                    <div class="dropdown card-header-dropdown">
                        <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted fs-lg"><i class="bi bi-three-dots-vertical"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#!">Current Years</a>
                            <a class="dropdown-item" href="#!">Last Years</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="simple_bubble" data-colors='["--tb-primary", "--tb-info"]' class="apex-charts ms-n3"
                    dir="ltr"></div>
            </div>
        </div>
    </div>
    <!--end col-->
    <div class="col-xl-4 col-lg-6">
        <div class="card card-height-100">
            <div class="card-header d-flex">
                <h5 class="card-title mb-0 flex-grow-1">Summery</h5>
                <div class="flex-shrink-0">
                    <div class="dropdown card-header-dropdown">
                        <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted fs-lg"><i class="bi bi-three-dots-vertical"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            @php
                                $today = \Carbon\Carbon::today();
                                $currentMonth = $today->month;
                                $currentYear = $today->year;
                                
                                // Generate months (current month and previous months)
                                $currentMonthStart = $today->copy()->startOfMonth();
                                for ($i = 0; $i < 12; $i++) {
                                    $month = $currentMonthStart->copy()->subMonths($i);
                                    $monthLabel = $month->format('M Y');
                                    $monthValue = $month->format('Y-m');
                                    echo '<a class="dropdown-item" href="#!" data-month="' . $monthValue . '">' . $monthLabel . '</a>';
                                }
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="sales_funnel"
                    data-colors='["--tb-primary ", "--tb-success"]'
                    data-dump-histories="{{ $totalDumpHistories ?? 0 }}"
                    data-collection="{{ $totalCollections ?? 0 }}"
                    class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>
    <!--end col-->
    <div class="col-xl-4 col-lg-6">
        <div class="card card-height-100">
            <div class="card-header d-flex">
                <h5 class="card-title mb-0 flex-grow-1">Top Country</h5>
                <div class="flex-shrink-0">
                    <div class="dropdown card-header-dropdown">
                        <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted fs-lg"><i class="bi bi-three-dots-vertical"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#!">This Years</a>
                            <a class="dropdown-item" href="#!">Last Years</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="p-3 text-center bg-light bg-opacity-50 mb-4 rounded">
                    <h4 class="mb-0">$<span class="counter-value" data-target="314.57">0</span>M <span
                            class="text-muted fw-normal fs-sm"><span class="text-success fw-medium"><i
                                    class="bi bi-arrow-up"></i> +23.57%</span> Last Month</span></h4>
                </div>
                <ul class="list-unstyled vstack gap-2 mb-0">
                    <li class="d-flex align-items-center gap-2">
                        <img src="https://img.themesbrand.com/judia/flags/us.svg" alt="" height="16"
                            class="rounded-circle object-fit-cover">
                        <h6 class="flex-grow-1 mb-0">United States</h6>
                        <p class="text-muted mb-0">39.41%</p>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <img src="https://img.themesbrand.com/judia/flags/de.svg" alt="" height="16"
                            class="rounded-circle object-fit-cover">
                        <h6 class="flex-grow-1 mb-0">Germany</h6>
                        <p class="text-muted mb-0">16.84%</p>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <img src="https://img.themesbrand.com/judia/flags/fr.svg" alt="" height="16"
                            class="rounded-circle object-fit-cover">
                        <h6 class="flex-grow-1 mb-0">France</h6>
                        <p class="text-muted mb-0">12.54%</p>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <img src="https://img.themesbrand.com/judia/flags/ru.svg" alt="" height="16"
                            class="rounded-circle object-fit-cover">
                        <h6 class="flex-grow-1 mb-0">Russia</h6>
                        <p class="text-muted mb-0">11.13%</p>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <img src="https://img.themesbrand.com/judia/flags/br.svg" alt="" height="16"
                            class="rounded-circle object-fit-cover">
                        <h6 class="flex-grow-1 mb-0">Brazil</h6>
                        <p class="text-muted mb-0">9.17%</p>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <img src="https://img.themesbrand.com/judia/flags/se.svg" alt="" height="16"
                            class="rounded-circle object-fit-cover">
                        <h6 class="flex-grow-1 mb-0">Sweden</h6>
                        <p class="text-muted mb-0">1.25%</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--end col-->
    <div class="col-xl-5 col-lg-6">
        <div class="card card-height-100">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">Sales Report</h5>
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-subtle-info btn-sm"><i
                            class="bi bi-file-earmark-text me-1 align-baseline"></i> Generate Reports</button>
                </div>
            </div>
            <div class="card-body">
                <div id="sales_Report" data-colors='["--tb-primary", "--tb-danger"]' class="apex-charts ms-n3"
                    dir="ltr"></div>
            </div>
        </div>
    </div>
    <!--end col-->
    <div class="col-xl-3 col-lg-6">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title mb-2">Your team Performance this week</h5>
                <div id="team_performance" data-colors='["--tb-primary"]' class="apex-charts" dir="ltr"></div>
                <p class="text-muted mt-4">Your team performance is <b>8%</b> better than this week</p>
                <button class="btn btn-info">View Details</button>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->

@endsection
@section('scripts')
<!-- apexcharts -->
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

<script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>

<!-- dashboard-analytics init js -->
<script src="{{ URL::asset('build/js/pages/dashboard-analytics.init.js') }}"></script>

<script>
(function() {
    function initDumpHistoryFilter() {
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
        
        const summeryDropdown = summeryCard.querySelector('.dropdown-menu');
        if (!summeryDropdown) {
            return;
        }
        
        // Use event delegation on the dropdown
        summeryDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const target = e.target.closest('.dropdown-item');
            if (!target) return;
            
            const date = target.getAttribute('data-date');
            const month = target.getAttribute('data-month');
            
            if (!date && !month) {
                return;
            }
            
            // Build the request URL using the same dashboard route
            let url = '{{ route("dashboard") }}';
            if (date) {
                url += '?date=' + encodeURIComponent(date);
            } else if (month) {
                url += '?month=' + encodeURIComponent(month);
            }
            
            // Update active state
            summeryDropdown.querySelectorAll('.dropdown-item').forEach(item => {
                item.classList.remove('active');
            });
            target.classList.add('active');
            
            // Make AJAX request
            fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                credentials: 'same-origin'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('HTTP error! status: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                const salesFunnelElement = document.getElementById('sales_funnel');
                if (!salesFunnelElement) {
                    console.error('sales_funnel element not found');
                    return;
                }
                
                // Update both data attributes
                const dumpCount = data.dumpCount || 0;
                const collectionCount = data.collectionCount || 0;
                
                salesFunnelElement.setAttribute('data-dump-histories', dumpCount);
                salesFunnelElement.setAttribute('data-collection', collectionCount);
                
                // Try to update the chart - check multiple ways to access it
                let chart = null;
                if (typeof salesFunnelChart !== 'undefined' && salesFunnelChart && salesFunnelChart !== "") {
                    chart = salesFunnelChart;
                } else if (typeof window.salesFunnelChart !== 'undefined' && window.salesFunnelChart && window.salesFunnelChart !== "") {
                    chart = window.salesFunnelChart;
                }
                
                if (chart && typeof chart.updateSeries === 'function') {
                    chart.updateSeries([dumpCount, collectionCount]);
                } else {
                    // Chart not ready, reload it
                    if (typeof loadCharts === 'function') {
                        loadCharts();
                        // Try to update after a short delay
                        setTimeout(function() {
                            if (typeof salesFunnelChart !== 'undefined' && salesFunnelChart && salesFunnelChart !== "" && typeof salesFunnelChart.updateSeries === 'function') {
                                salesFunnelChart.updateSeries([dumpCount, collectionCount]);
                            }
                        }, 200);
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching dump history count:', error);
                target.classList.remove('active');
            });
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initDumpHistoryFilter, 1000);
        });
    } else {
        setTimeout(initDumpHistoryFilter, 1000);
    }
})();

// Handle Collections dropdown filter
(function() {
    function initCollectionFilter() {
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
        
        const collectionDropdown = collectionsCard.querySelector('.dropdown-menu');
        if (!collectionDropdown) {
            return;
        }
        
        // Use event delegation on the dropdown
        collectionDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const target = e.target.closest('.collection-filter');
            if (!target) return;
            
            const date = target.getAttribute('data-date');
            const month = target.getAttribute('data-month');
            
            if (!date && !month) {
                return;
            }
            
            // Build the request URL
            let url = '{{ route("dashboard") }}?collection_chart=1';
            if (date) {
                url += '&date=' + encodeURIComponent(date);
            } else if (month) {
                url += '&month=' + encodeURIComponent(month);
            }
            
            // Update active state
            collectionDropdown.querySelectorAll('.dropdown-item').forEach(item => {
                item.classList.remove('active');
            });
            target.classList.add('active');
            
            // Make AJAX request
            fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                credentials: 'same-origin'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('HTTP error! status: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                const pageViewsElement = document.getElementById('pageviews_overview');
                if (!pageViewsElement) {
                    console.error('pageviews_overview element not found');
                    return;
                }
                
                // Update data attributes
                pageViewsElement.setAttribute('data-chart-data', JSON.stringify(data.series));
                pageViewsElement.setAttribute('data-chart-categories', JSON.stringify(data.categories));
                
                // Update the chart
                if (typeof pageViewsOverviewChart !== 'undefined' && pageViewsOverviewChart && pageViewsOverviewChart !== "") {
                    pageViewsOverviewChart.updateOptions({
                        series: [{
                            name: 'Collection',
                            data: data.series
                        }],
                        xaxis: {
                            categories: data.categories
                        }
                    });
                } else if (typeof window.pageViewsOverviewChart !== 'undefined' && window.pageViewsOverviewChart && window.pageViewsOverviewChart !== "") {
                    window.pageViewsOverviewChart.updateOptions({
                        series: [{
                            name: 'Collection',
                            data: data.series
                        }],
                        xaxis: {
                            categories: data.categories
                        }
                    });
                } else {
                    // Chart not ready, reload it
                    if (typeof loadCharts === 'function') {
                        loadCharts();
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching collection chart data:', error);
                target.classList.remove('active');
            });
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initCollectionFilter, 1000);
        });
    } else {
        setTimeout(initCollectionFilter, 1000);
    }
})();
</script>
@endsection
