@extends('layouts.master')

@section('title')
    {{ __('users') }}
@endsection
@section('content')

@section('page-title')
  <x-breadcrumb pagetitle="{{ __('user') }}" title="{{ __('edit') }}" />
@endsection

@section('page-button')
<a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
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
                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id], 'class' => 'row g-3 needs-validation' , 'novalidate']) !!}
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">Name:</label>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide name
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">Email:</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control','required')) !!}
                            <div class="invalid-feedback">
                                Please provide email
                            </div>
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
                    
                    <div class="col-12">
                        <label for="validationCustom01" class="form-label">Role:</label>
                         {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple','required')) !!}
                         <div class="invalid-feedback">
                            Please provide role
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