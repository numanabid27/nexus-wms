@extends('layouts.master')

@section('title')
    {{ __('vehicle') }}
@endsection
@section('content')

@section('page-title')
  <x-breadcrumb pagetitle="{{ __('vehicle') }}" title="{{ __('edit') }}" />
@endsection

@section('page-button')
<a class="btn btn-primary" href="{{ route('vehicles.index') }}"> Back</a>
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
                {!! Form::open(array('route' => ['vehicles.update', $vehicle->id],'method'=>'PATCH', 'class' => 'row g-3 needs-validation' , 'novalidate', 'enctype'=>"multipart/form-data")) !!}
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">{{ __('plate_no') }}:</label>
                        {!! Form::text('plate_no', $vehicle->plate_no, array('placeholder' => __('plate_no'),'class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('plate_no') }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label required-label">{{ __('driver') }}:</label>
                        <div class="input-group has-validation">
                            <select class="form-control" name="driver_id">
                                <option value="">{{ __('select_driver') }}</option>
                                @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" @if($vehicle->driver_id == $driver->id) selected @endif>{{ $driver->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please provide {{ __('driver') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label required-label">{{ __('vehicle_type') }}:</label>
                        <div class="input-group has-validation">
                            <select class="form-control" name="vehicle_type">
                                <option value="1" @if($vehicle->vehicle_type == 1) selected @endif>{{ __('compactor') }}</option>
                                <option value="2" @if($vehicle->vehicle_type == 2) selected @endif>{{ __('hook_loader') }}</option>
                                <option value="3" @if($vehicle->vehicle_type == 3) selected @endif>{{ __('chain_loader') }}</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide {{ __('vehicle_type') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label required-label">{{ __('contract_type') }}:</label>
                        <div class="input-group has-validation">
                            <select class="form-control" name="contract_type">
                                <option value="1" @if($vehicle->contract_type == 1) selected @endif>{{ __('owned') }}</option>
                                <option value="2" @if($vehicle->contract_type == 2) selected @endif>{{ __('rented_lease') }}</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide {{ __('contract_type') }}
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

@section('script-content')
<script>
    $("body").on("change","[name='skip_size[]']",function(){
        var _price = $(":selected",this).attr("_price")
        var _row = $(":selected",this).parents(".skip_count_row")
        _row.find("[name='skip_price[]']").val(_price)
    })
    $("body").on("click","#add_more_skip",function(){
        var _clone = $(".skip_count_row").last().clone();
        _clone.find('input, textarea, select').val('');
        $("#skip_row_parent").append(_clone)
        
    })
    $("body").on("click",".btn_remove_skip_count",function(){
        if($(".skip_count_row").length > 1){
            $(this).parents(".skip_count_row").remove()
        }
        
    })
    
</script>

@endsection
