@extends('layouts.master')
@section('title')
    {{ __('profile') }}
@endsection
@section('content')

@section('page-title')
    <x-breadcrumb pagetitle="{{ __('user') }}" title="{{ __('profile') }}" />
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
                        <img src="@if ($user->image_guid != ''){{ URL::asset($user->image_guid) }}@else{{ URL::asset('build/images/users/user-dummy-img.jpg') }}@endif" alt=""
                            class="avatar-xl rounded p-1 bg-body-secondary">
                        
                    </div>
                </div>
                <div class="col-sm">
                    <div class="mt-4">
                        <h5>{{ $user->name }} <i class="bi bi-patch-check-fill align-baseline text-info ms-1"></i></h5>
                        <!--<p class="text-muted mb-3">Fashion & Graphic Designer</p>-->
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
            <!--<div class="col-lg-3 col-md-6">-->
            <!--    <div>-->
            <!--        <p class="text-muted text-uppercase fs-sm mb-1">{{ __('name') }}</p>-->
            <!--        <h6 class="mb-0 lh-base fs-md">{{ $user->name }}</h6>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('email') }}</p>
                    <h6 class="mb-0 lh-base fs-md"><a href="{{ $user->email }}"
                            class="text-reset">{{ $user->email }}</a></h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('working_shift') }}</p>
                    <h6 class="mb-0 lh-base fs-md">{{ StatusHelper::working_shift($user->working_shift) }}</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div>
                    <p class="text-muted text-uppercase fs-sm mb-1">{{ __('roles') }}</p>
                    <h6 class="mb-0 lh-base fs-md">
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                {{ $v }}
                            @endforeach
                        @endif
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

