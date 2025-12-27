@extends('layouts.master')

@section('title')
    {{ __('company') }}
@endsection
@section('content')

@section('page-title')
  <x-breadcrumb pagetitle="{{ __('company') }}" title="{{ __('invoice_setup') }}" />
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
                <h4 class="card-title mb-1">{{ __('invoice_settings') }}</h4>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => ['company.invoice_logo', Auth::user()->company_id],'method'=>'POST', 'class' => 'row g-3 needs-validation' , 'novalidate', 'enctype'=>"multipart/form-data")) !!}
                   <div class="row">
                       <div class="col-md-6 align-content-end">
                           <label for="validationCustom01" class="form-label">{{ __('invoice_logo') }}:</label>
                           <div class="row">
                                @if(!empty($company->logo_guid))
                                <div class="col-md-12">
                                    <img src="{{ asset($company->logo_guid) }}" height="inherit"/>
                                </div>
                                @endif
                                <div class="col-md-12">
                                    <input type="file" name="logo"  accept="image/png, image/gif, image/jpeg" class="form-control"/>
                                </div>
                           </div>
                       </div>
                       <div class="col-md-6 align-content-end">
                           <label for="validationCustom01" class="form-label">{{ __('invoice_stamp') }}:</label>
                           <div class="row">
                                @if(!empty($company->stamp_image_guid))
                                <div class="col-md-12">
                                    <img src="{{ asset($company->stamp_image_guid) }}" height="inherit"/>
                                </div>
                                @endif
                                <div class="col-md-12">
                                    <input type="file" name="stamp_image"  accept="image/png, image/gif, image/jpeg" class="form-control"/>
                                </div>
                           </div>
                       </div>
                   </div>
                    
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">{{ __('contact_person') }}:</label>
                        {!! Form::text('contact_person', $company->invoice_contact_person, array('placeholder' => __('contact_person'),'class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('contact_person') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">{{ __('phone_no') }}:</label>
                        {!! Form::number('phone_no', $company->invoice_phone_no, array('placeholder' => __('phone_no'),'class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('phone_no') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">{{ __('tax_registration_number') }}:</label>
                        {!! Form::text('tax_registration_number', $company->tax_registration_number, array('placeholder' => __('tax_registration_number'),'class' => 'form-control')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('tax_registration_number') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">{{ __('invoice_due_period') }}:</label>
                        {!! Form::number('invoice_due_period', $company->invoice_due_period, array('placeholder' => __('invoice_due_period'). " (".__('in_days').")",'class' => 'form-control')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('invoice_due_period') }}
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">{{ __('terms_n_conditions') }}:</label>
                        {!! Form::textarea('terms_n_conditions', $company->terms_n_conditions, array('placeholder' => __('terms_n_conditions'),'class' => 'form-control', 'id' => 'sun_editor', 'rows' => '5')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('terms_n_conditions') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="validationCustom01" class="form-label">{{ __('invoice_number_format') }}:</label>
                                {!! Form::text('invoice_number_format', $company->invoice_number_format, array('placeholder' => __('(Example: Nexus-{i}-{d}/{m}/{y})'),'class' => 'form-control', 'required')) !!}
                                <div class="invalid-feedback">
                                    Please provide {{ __('invoice_number_format') }}
                                </div>
                                <p class="text-muted mb-0"><code>{i}</code> for auto increment value</p>
                                <p class="text-muted mb-0"><code>{d}</code> for current date</p>
                                <p class="text-muted mb-0"><code>{m}</code> for current month</p>
                                <p class="text-muted"><code>{y}</code> for current year</p>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="validationCustom01" class="form-label">{{ __('invoice_last_increment_number') }}:</label>
                                {!! Form::number('invoice_last_increment_number', $company->invoice_last_increment_number, array('placeholder' => __('invoice_last_increment_number'),'class' => 'form-control', 'required')) !!}
                                <div class="invalid-feedback">
                                    Please provide {{ __('invoice_last_increment_number') }}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="validationCustom01" class="form-label">{{ __('time_format') }}:</label>
                                <select class="form-control" name="time_format" required>
                                    <option value="1" @if($company->time_format == 1) selected @endif>24 hours</option>
                                    <option value="2" @if($company->time_format == 2) selected @endif>12 hours</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please provide {{ __('time_format') }}
                                </div>
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
   
    
    
    // Listen for changes in the editor content
    editor.onChange = function () {
        // Update the value of the textarea or a hidden input when the content changes
        $('[name=terms_n_conditions]').val(editor.getContents());
    };
</script>

@endsection