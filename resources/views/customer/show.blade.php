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
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('company_name') }}</p>
                    <h6 class="mb-0 lh-base fs-md">{{ $customer->company_name }}</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('phone_no') }}</p>
                    <h6 class="mb-0 lh-base fs-md">{{ $customer->phone_no }}</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('email') }}</p>
                    <h6 class="mb-0 lh-base fs-md">{{ $customer->email }}</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('gate_fee') }}</p>
                    <h6 class="mb-0 lh-base fs-md">{{ $customer->gate_fee }}</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('billing_model') }}</p>
                    <h6 class="mb-0 lh-base fs-md">
                    {{ StatusHelper::billing_model($customer->billing_model) }}
                    </h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('schedule') }}</p>
                    <h6 class="mb-0 lh-base fs-md">
                    {{ StatusHelper::schedules($customer->schedule) }}   
                    </h6>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('tax_registration_number') }}</p>
                    <h6 class="mb-0 lh-base fs-md">{{ $customer->tax_registration_number }}</h6>
                </div>
            </div>
        </div>
        <hr/>
        <h4 class="card-title mb-1">{{ __('skips') }}</h4>
        <div class="table-responsive">
            @foreach($customer->customer_uid as $uid)
            <table class="table">
                <thead>
                    <tr class="text-center bg-success-subtle">
                        <td colspan="4">{{ $uid->skip_location }}</td>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th>{{ __('waste_type') }}</th>
                        <th>{{ __('skip_size') }}</th>
                        <th>{{ __('skip_price') }}</th>
                        <th>{{ __('municipality_fee') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($uid->customer_skip as $val)
                        <tr>
                            <td>{{ StatusHelper::waste_type($val->waste_type) }}</td>
                            <td>{{ $val->skip_size }}</td>
                            <td>{{ $val->skip_price }}</td>
                            <td>{{ $val->municipality_fee }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endforeach
        </div>
    </div>
</div>
@endsection