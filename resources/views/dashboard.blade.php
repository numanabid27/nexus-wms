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
                <div style="margin-top: 42px;" id="pageviews_overview" 
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
                    class="apex-charts" dir="ltr"></div>
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
                        
                        // Calculate days difference
                        const daysDiff = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
                        
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
        
        // Update both data attributes
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
        
        // Update both data attributes
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
                setTimeout(function() {
                    if (typeof salesFunnelChart !== 'undefined' && salesFunnelChart && salesFunnelChart !== "" && typeof salesFunnelChart.updateSeries === 'function') {
                        salesFunnelChart.updateSeries([dumpCount, collectionCount]);
                    }
                }, 200);
            }
        }
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initSummeryDatePicker, 1500);
        });
    } else {
        setTimeout(initSummeryDatePicker, 1500);
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
        
        // Default: Show last 15 days from today
        const today = new Date();
        today.setUTCHours(23, 59, 59, 999);
        const endDate = new Date(today);
        const startDate = new Date(today);
        startDate.setUTCDate(startDate.getUTCDate() - 14); // 15 days total (today + 14 previous days)
        startDate.setUTCHours(0, 0, 0, 0);
        
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
        
        // Mark current month as active in dropdown
        const collectionDropdown = document.querySelector('.collection-filter[data-month="' + currentMonth + '"]');
        if (collectionDropdown) {
            collectionDropdown.classList.add('active');
        }
        
        // Update chart if it exists - check if update is needed
        const chart = (typeof pageViewsOverviewChart !== 'undefined' && pageViewsOverviewChart && pageViewsOverviewChart !== "") 
            ? pageViewsOverviewChart 
            : (typeof window.pageViewsOverviewChart !== 'undefined' && window.pageViewsOverviewChart && window.pageViewsOverviewChart !== "") 
                ? window.pageViewsOverviewChart 
                : null;
        
        if (chart) {
            try {
                // Check if data is different before updating
                const currentSeries = chart.w.globals.series[0].data || [];
                const currentCategories = chart.w.globals.categoryLabels || [];
                
                const dataChanged = JSON.stringify(currentSeries) !== JSON.stringify(chartData.series);
                const categoriesChanged = JSON.stringify(currentCategories) !== JSON.stringify(chartData.categories);
                
                if (dataChanged || categoriesChanged) {
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
                }
            } catch (e) {
                // Chart might not be fully initialized, try again later
                console.warn('Chart update failed, will retry:', e);
                chartUpdateInProgress = false;
            }
        }
    }
    
    // Wait for chart to be ready before updating
    function waitForChartAndUpdate() {
        if (typeof pageViewsOverviewChart !== 'undefined' && pageViewsOverviewChart && pageViewsOverviewChart !== "") {
            initializeCurrentMonthChart();
        } else if (typeof window.pageViewsOverviewChart !== 'undefined' && window.pageViewsOverviewChart && window.pageViewsOverviewChart !== "") {
            initializeCurrentMonthChart();
        } else {
            // Chart not ready yet, check again
            setTimeout(waitForChartAndUpdate, 100);
        }
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            fetchAllData();
            // Wait for chart to initialize, then update it
            setTimeout(waitForChartAndUpdate, 300);
        });
    } else {
        fetchAllData();
        setTimeout(waitForChartAndUpdate, 300);
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
        
        // Create date objects at midnight local time
        const startDateLocal = new Date(startYear, startMonth, startDay, 0, 0, 0, 0);
        const endDateLocal = new Date(endYear, endMonth, endDay, 0, 0, 0, 0);
        
        // Calculate the number of days between start and end (inclusive)
        const daysDiff = Math.ceil((endDateLocal - startDateLocal) / (1000 * 60 * 60 * 24)) + 1;
        
        // Generate all dates in the range (inclusive of both start and end)
        for (let i = 0; i < daysDiff; i++) {
            const date = new Date(startYear, startMonth, startDay + i, 0, 0, 0, 0);
            datesToShow.push(date);
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
                        
                        // Calculate days difference
                        const daysDiff = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
                        
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
        // Reset to last 15 days from today
        const today = new Date();
        today.setUTCHours(23, 59, 59, 999);
        const endDate = new Date(today);
        const startDate = new Date(today);
        startDate.setUTCDate(startDate.getUTCDate() - 14); // 15 days total (today + 14 previous days)
        startDate.setUTCHours(0, 0, 0, 0);
        
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
</script>
@endsection