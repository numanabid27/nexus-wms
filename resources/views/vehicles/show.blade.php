@extends('layouts.master')
@section('title')
    {{ __('customer') }}
@endsection
@section('content')

@section('page-title')
    <x-breadcrumb pagetitle="{{ __('customer') }}" title="{{ __('profile') }}" />
@endsection

<div class="card">
    <div class="card-body rounded-top py-5 bg-danger-subtle"
        style="background-image: url('https://img.themesbrand.com/judia/effect-pattern/abc.svg');background-repeat: no-repeat;background-position: right;">
        <div class="py-5 my-2"></div>
    </div>
    <div class="card-body">
        <div class="mt-n5">
            <div class="mt-n2 row g-3 g-sm-0 align-items-end gap-3">

                <div class="col-sm">
                    <div class="mt-4">
                        <h5>{{ $customer->client_id }} <i class="bi bi-patch-check-fill align-baseline text-info ms-1"></i></h5>
                        <p class="text-muted mb-3">{{ $customer->address }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-lg-4 g-3 mt-2">
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('skip_location') }}</p>
                    <h6 class="mb-0 lh-base fs-md">{{ $customer->skip_location }}</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('billing_model') }}</p>
                    <h6 class="mb-0 lh-base fs-md">@php
                                        $billingTypes = [
                                            1 => __('contract'),
                                            2 => __('per_pick'),
                                        ];
                                    @endphp
                                    {{ $billingTypes[$customer->billing_model] }}</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('schedule') }}</p>
                    <h6 class="mb-0 lh-base fs-md"> @php
                                        $scheduleTypes = [
                                            1 => __('daily_7'),
                                            2 => __('daily_6'),
                                            3 => __('3_days_week'),
                                            4 => __('2_days_week'),
                                        ];
                                    @endphp
                                    {{ $scheduleTypes[$customer->schedule] }}</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('waste_type') }}</p>
                    <h6 class="mb-0 lh-base fs-md"> 
                    @php
                                        $waste_Types = [
                                            1 => __('general'),
                                            2 => __('construction'),
                                            3 => __('hyzerdous'),
                                        ];
                                    @endphp
                                    {{ $waste_Types[$customer->waste_type] }}
                    </h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('municipalty_fee') }}</p>
                    <h6 class="mb-0 lh-base fs-md">{{ $customer->municipalty_fee }}</h6>
                </div>
            </div>
        </div>
        <hr/>
        <h4 class="card-title mb-1">{{ __('skips') }}</h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('skip_size') }}</th>
                        <th>{{ __('skip_price') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customer->skips as $val)
                        <tr>
                            <td>{{ $val->skip_size }}</td>
                            <td>{{ $val->skip_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection