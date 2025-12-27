@extends('layouts.master')

@section('title')
    {{ __('employees') }}
@endsection
@section('content')

@section('page-title')
  <x-breadcrumb pagetitle="{{ __('employee') }}" title="{{ __('create') }}" />
@endsection

@section('page-button')
<a class="btn btn-primary" href="{{ route('employee.index') }}"> Back</a>
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
                <h4 class="card-title mb-1">{{ __('create') }}</h4>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'employee.store','method'=>'POST', 'class' => 'row g-3 needs-validation' , 'novalidate', 'enctype'=>"multipart/form-data")) !!}
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">{{ __('profile_pic') }}:</label>
                        <input type="file" name="logo"  accept="image/png, image/gif, image/jpeg" class="form-control"/>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">Name:</label>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide name
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label required-label">Email:</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control','required')) !!}
                            <div class="invalid-feedback">
                                Please provide email
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">{{ __('mobile_no') }}:</label>
                        {!! Form::text('mobile_no', null, array('placeholder' => __('mobile_no'),'class' => 'form-control')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('mobile_no') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Password:</label>
                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control','required')) !!}
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Confirm Password:</label>
                         {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                    </div>
                    
                    <div class="col-6">
                        <label for="validationCustom01" class="form-label">Role:</label>
                         {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','required')) !!}
                         <div class="invalid-feedback">
                            Please provide role
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="validationCustom01" class="form-label">{{ __('working_shift') }}:</label>
                         <div class="input-group has-validation">
                            <select class="form-control" name="working_shift">
                                <option value="0" selected>{{ __('please_select') }}</option>
                                <option value="1">{{ __('morning') }}</option>
                                <option value="2">{{ __('evening') }}</option>
                                <option value="3">{{ __('night') }}</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide {{ __('working_shift') }}
                            </div>
                        </div>
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
