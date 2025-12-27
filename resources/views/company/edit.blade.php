@extends('layouts.master')

@section('title')
    {{ __('company') }}
@endsection
@section('content')

@section('page-title')
  <x-breadcrumb pagetitle="{{ __('company') }}" title="{{ __('edit') }}" />
@endsection

@section('page-button')
<a class="btn btn-primary" href="{{ route('company.index') }}"> Back</a>
@endsection

@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-1">{{ __('edit') }}</h4>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => ['company.update', $company->id],'method'=>'PATCH', 'class' => 'row g-3 needs-validation' , 'novalidate', 'enctype'=>"multipart/form-data")) !!}
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">{{ __('company_logo') }}:</label>
                        @if(!empty($company->logo_guid))
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset($company->logo_guid) }}" style="height:100px"/>
                            </div>
                        </div>
                        @endif
                        <input type="file" name="logo"  accept="image/png, image/gif, image/jpeg" class="form-control"/>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">{{ __('company_name') }}:</label>
                        {!! Form::text('company_name', $company->company_name, array('placeholder' => __('company_name'),'class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide company name
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">{{ __('company_address') }}:</label>
                        {!! Form::textarea('company_address', $company->company_address, array('placeholder' => __('company_address'),'class' => 'form-control', 'required','rows' => 4, )) !!}
                        <div class="invalid-feedback">
                            Please provide address
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">{{ __('contact_person_name') }}:</label>
                        {!! Form::text('contact_person_name', $company->contact_person_name, array('placeholder' => __('contact_person_name'),'class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide name
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">{{ __('contact_person_email') }}: <span style="font-size: 10px;"> (This email will be used to SignIn as Company)</span></label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            {!! Form::text('contact_person_email', $company->email, array('placeholder' => __('contact_person_email'),'class' => 'form-control','required',"autocomplete"=>"new-email")) !!}
                            <div class="invalid-feedback">
                                Please provide email
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">{{ __('contact_person_phone') }}:</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend"><i class="ph ph-phone"></i></span>
                            {!! Form::text('contact_person_phone', $company->contact_person_number, array('placeholder' => __('contact_person_phone'),'class' => 'form-control','required')) !!}
                            <div class="invalid-feedback">
                                Please provide Phone
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Password:</label>
                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control',"autocomplete"=>"new-password")) !!}
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Confirm Password:</label>
                         {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


@endsection
