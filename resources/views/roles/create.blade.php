@extends('layouts.master')

@section('title')
    {{ __('roles') }}
@endsection
@section('content')

@section('page-title')
  <x-breadcrumb pagetitle="{{ __('role') }}" title="{{ __('create') }}" />
@endsection

@section('page-button')
<a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
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
                {!! Form::open(array('route' => 'roles.store','method'=>'POST', 'class' => 'row g-3 needs-validation' , 'novalidate')) !!}
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">{{ __('name') }}:</label>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide name
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">{{ __('Permission') }}:</label>
                        <br/>
                        @foreach($permission as $value)
                            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                            {{ $value->name }}</label>
                        <br/>
                        @endforeach
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
