@extends('layouts.master')

@section('title')
    {{ __('employees') }}
@endsection
@section('content')

@section('page-title')
  <x-breadcrumb pagetitle="{{ __('employee') }}" title="{{ __('edit') }}" />
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
                <h4 class="card-title mb-1">{{ __('edit') }}</h4>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => ['employee.update', $user->id],'method'=>'PATCH', 'class' => 'row g-3 needs-validation' , 'novalidate', 'enctype'=>"multipart/form-data")) !!}
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">{{ __('profile_pic') }}:</label>
                        @if(!empty($user->image_guid))
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset($user->image_guid) }}" style="height:100px"/>
                            </div>
                        </div>
                        @endif
                        <input type="file" name="logo"  accept="image/png, image/gif, image/jpeg" class="form-control"/>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">Name:</label>
                        {!! Form::text('name', $user->name, array('placeholder' => 'Name','class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide name
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Email:</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            {!! Form::text('email',  $user->email, array('placeholder' => 'Email','class' => 'form-control','required')) !!}
                            <div class="invalid-feedback">
                                Please provide email
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">{{ __('mobile_no') }}:</label>
                        {!! Form::text('mobile_no', $user->mobile_no, array('placeholder' => __('mobile_no'),'class' => 'form-control')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('mobile_no') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Password:</label>
                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Confirm Password:</label>
                         {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                    </div>
                    
                    <div class="col-6">
                        <label for="validationCustom01" class="form-label">Role:</label>
                         {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','required')) !!}
                         <div class="invalid-feedback">
                            Please provide role
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="validationCustom01" class="form-label">{{ __('working_shift') }}:</label>
                         <div class="input-group has-validation">
                            <select class="form-control" name="working_shift">
                                <option value="0" @if($user->working_shift == 0 ) selected @endif>{{ __('please_select') }}</option>
                                <option value="1" @if($user->working_shift == 1 ) selected @endif>{{ __('morning') }}</option>
                                <option value="2" @if($user->working_shift == 2 ) selected @endif>{{ __('evening') }}</option>
                                <option value="3" @if($user->working_shift == 3 ) selected @endif>{{ __('night') }}</option>
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