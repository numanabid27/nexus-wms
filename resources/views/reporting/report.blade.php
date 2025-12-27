<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                        
                        <div class="col-md-auto ms-auto">
                            <div class="customizer-setting d-none d-md-block">
                                <button type="button" class="btn btn-info" id="btn-print">
                                    <i class="ph ph-printer me-1 align-middle"></i> Print
                                </button>
                            </div>
                        </div>
                    </div>
                
            </div>
            <div class="card-body" id="print-report">
                <div class="row align-items-center">
                    <div class="col-md-5">
                            <!-- start page title -->
                        <h5 class="card-title">{{ __('reporting') }}</h5>
                     </div>
                    <!--end col-->
                     @if(!empty($selected_date))
                    <div class="col-md-auto ms-auto">
                        <h6 class="text-decoration-underline">Date: {{ $selected_date }}</h6>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xl-3 col-sm-6">
                        <div class="card border card-border-success">
                            <div class="card-body">
                                <div class="avatar-sm float-end">
                                    <div class="avatar-title bg-success-subtle text-success rounded fs-3xl">
                                        <img src="{{ asset('asset/images/collection.png') }}" width="30" height="30"/>
                                    </div>
                                </div>
                                <p class="fs-md text-muted mb-4">Total Collections</p>
                                <h4 class="mb-3"><span class="counter-value" data-target="{{ count($collections) }}">{{ count($collections) }}</span> </h4>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xl-3 col-sm-6">
                        <div class="card border card-border-primary">
                            <div class="card-body">
                                <div class="avatar-sm float-end">
                                    <div class="avatar-title bg-primary-subtle text-primary rounded fs-3xl">
                                        <img src="{{ asset('asset/images/trash_dump.png') }}" width="30" height="30"/>
                                    </div>
                                </div>
                                <p class="fs-md text-muted mb-4">Total Dumps</p>
                                <h4 class="mb-3"><span class="counter-value" data-target="{{ $dump_total_count }}">{{ $dump_total_count }}</span> </h4>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <div class="row">
                    <div class="col-12">
                        <div id="collection_dump_bar" data-colors='["--tb-success-border-subtle","--tb-primary-border-subtle"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('driver') }}</th>
                                    <th>{{ __('vehicle') }}</th>
                                    <th>{{ __('helpers') }}</th>
                                    <th>{{ __('customer') }}</th>
                                    <th>{{ __('collection_date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($collections as $val)
                                <tr>
                                    <td>{{ $val->name }}</td>
                                    <td>{{ $val->name }}</td>
                                    <td>{{ implode(",",$val->helpers) }}</td>
                                    <td>{{ $val->company_name }} ({{ $val->client_id }}) - {{ $val->skip_location }}</td>
                                    <td>{{ $val->pickup_date }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var chartGroupbarColors = "";
    chartGroupbarColors = getChartColorsArray("collection_dump_bar");
    if (chartGroupbarColors) {
        var options = {
            series: [{
                name: "Collection Count",
                data: [<?php echo $bar_cart['collections'] ?>]
            }, {
                name: "Dumps Count",
                data: [<?php echo $bar_cart['dumps'] ?>]
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
                categories: [ <?php echo $bar_cart['drivers'] ?>],
            },
            colors: chartGroupbarColors
        };

        if (chartGroupbar != "")
            chartGroupbar.destroy();
        chartGroupbar = new ApexCharts(document.querySelector("#collection_dump_bar"), options);
        chartGroupbar.render();
    }
</script>