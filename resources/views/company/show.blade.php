@extends('layouts.master')
@section('title')
    {{ __('company') }}
@endsection
@section('content')

@section('page-title')
    <x-breadcrumb pagetitle="{{ __('company') }}" title="{{ __('profile') }}" />
@endsection

<div class="card">
    <div class="card-body rounded-top py-5 bg-danger-subtle"
        style="background-image: url('https://img.themesbrand.com/judia/effect-pattern/abc.svg');background-repeat: no-repeat;background-position: right;">
        <div class="py-5 my-2"></div>
    </div>
    <div class="card-body">
        <div class="mt-n5">
            <div class="mt-n2 row g-3 g-sm-0 align-items-end gap-3">

                <div class="col-sm-auto">
                    <div class="position-relative d-inline-block">
                        @if(empty($company->logo_guid))
                        <img src="https://img.themesbrand.com/judia/users/avatar-1.jpg" alt=""
                            class="avatar-xl rounded p-1 bg-body-secondary">
                        @else
                        <img src="{{ asset($company->logo_guid) }}" alt=""
                            class="avatar-xl rounded p-1 bg-body-secondary">
                        @endif
                        <span class="position-absolute profile-dot bg-success rounded-circle"><span
                                class="visually-hidden">unread messages</span></span>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="mt-4">
                        <h5>{{ $company->company_name }} <i class="bi bi-patch-check-fill align-baseline text-info ms-1"></i></h5>
                        <p class="text-muted mb-3">{{ $company->company_address }}</p>
                    </div>
                </div>
                <!--<div class="col-sm-auto mb-3">-->
                <!--    <div class="hstack gap-2">-->
                <!--        <button class="btn btn-subtle-success">Hire Now</button>-->
                <!--        <button type="button" class="btn btn-outline-secondary custom-toggle active"-->
                <!--            data-bs-toggle="button" aria-pressed="false">-->
                <!--            <span class="icon-on"><i class="ri-add-line align-bottom me-1"></i> Follow</span>-->
                <!--            <span class="icon-off"><i class="ri-user-unfollow-line align-bottom me-1"></i>-->
                <!--                Unfollow</span>-->
                <!--        </button>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>

        <div class="row g-lg-4 g-3 mt-2">
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('email') }}</p>
                    <h6 class="mb-0 lh-base fs-md"><a href="{{ $company->email }}"
                            class="text-reset">{{ $company->email }}</a></h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('contact_person_name') }}</p>
                    <h6 class="mb-0 lh-base fs-md">{{ $company->contact_person_name }}</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('contact_person_phone') }}</p>
                    <h6 class="mb-0 lh-base fs-md">{{ $company->contact_person_number }}</h6>
                </div>
            </div>
        </div>
        <hr/>
        <h4 class="card-title mb-1">{{ __('package_detail') }}</h4>
        <div class="row g-lg-4 g-3 mt-2">
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('users') }}</p>
                    <h6 class="mb-0 lh-base fs-md">{{ $company->user_count }}</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('asset') }}</p>
                    <h6 class="mb-0 lh-base fs-md">{{ $company->asset_count }}</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('taps') }}</p>
                    <h6 class="mb-0 lh-base fs-md">{{ $company->taps_count }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection