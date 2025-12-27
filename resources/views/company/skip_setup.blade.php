@extends('layouts.master')

@section('title')
    {{ __('company') }}
@endsection
@section('content')

@section('page-title')
  <x-breadcrumb pagetitle="{{ __('company') }}" title="{{ __('skip_setup') }}" />
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
                <h4 class="card-title mb-1">{{ __('skip_settings') }}</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('skip_size') }}</th>
                            <th>{{ __('skip_price') }}</th>
                            <th>{{ __('municipality_fee') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($skip_settings as $key => $val)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                {{ $val->skip_size }}
                            </td>
                            <td>
                                {{ $val->skip_price }}
                            </td>
                            <td>
                                {{ $val->municipality_fee }}
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <div class="edit">
                                        <button class="btn btn-sm btn-success edit-skip-btn" _id="{{ $val->id }}" data-bs-toggle="modal" data-bs-target="#showSkipEditModal">{{ __('edit') }}</button>
                                    </div>
                                    <div class="remove">
                                        
                                        <form method="GET" action="{{ route('company.delete_skip',$val->id) }}" style="display:inline;">
                                            <input name="_method" type="hidden" value="ACTIVATE">
                                            @csrf
                                            <button class="btn btn-sm btn-danger remove-skip-btn" type="button"  onclick="sa_warning_delete_form_submit(this,'Are you sure?','Are you sure you want to remove this record?','Yes, remove it!')">
                                                {{ __('remove') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <hr/>
                
                {!! Form::open(array('route' => ['company.skip_setting_store', Auth::user()->company_id],'method'=>'POST', 'class' => 'row g-3 needs-validation' , 'novalidate', 'enctype'=>"multipart/form-data")) !!}
                    
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">{{ __('skip_size') }}:</label>
                        {!! Form::text('skip_size', null, array('placeholder' => __('skip_size'),'class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('skip_size') }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">{{ __('skip_price') }} (AED):</label>
                        {!! Form::text('skip_price', null, array('placeholder' => __('skip_price'),'class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('skip_price') }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">{{ __('municipality_fee') }} (AED):</label>
                        {!! Form::text('municipality_fee', null, array('placeholder' => __('municipality_fee'),'class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('municipality_fee') }}
                        </div>
                    </div>
                    <div class="col-4 align-content-end">
                        <button class="btn btn-primary" type="submit">{{ __('submit') }}</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showSkipEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('edit_skip') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('method'=>'POST', 'class' => 'row g-3 needs-validation editSkipForm' , 'novalidate', 'enctype'=>"multipart/form-data")) !!}
                    
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">{{ __('skip_size') }}:</label>
                        {!! Form::text('skip_size', null, array('placeholder' => __('skip_size'),'class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('skip_size') }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">{{ __('skip_price') }} (AED):</label>
                        {!! Form::text('skip_price', null, array('placeholder' => __('skip_price'),'class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('skip_price') }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">{{ __('municipality_fee') }} (AED):</label>
                        {!! Form::text('municipality_fee', null, array('placeholder' => __('municipality_fee'),'class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('municipality_fee') }}
                        </div>
                    </div>
                    <div class="col-4 align-content-end">
                        <button class="btn btn-primary" type="submit">{{ __('submit') }}</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
                                

@endsection
@section('script-content')

<script>
    $("body").on("click",".edit-skip-btn",function(){
        var _id = $(this).attr("_id")
        var url = "{{ route('company.skip_setting_update','_id') }}"
        url = url.replace("_id",_id);
        $(".editSkipForm").attr("action",url)
        
        var tr = $(this).parents("tr");
        $(".editSkipForm [name=skip_size]").val(tr.find("td:eq(1)").text().trim())
        $(".editSkipForm [name=skip_price]").val(tr.find("td:eq(2)").text().trim())
        $(".editSkipForm [name=municipality_fee]").val(tr.find("td:eq(3)").text().trim())
    })
    
    
</script>

@endsection