@extends('layouts.master')

@section('title')
    {{ __('customer') }}
@endsection
@section('content')

@section('page-title')
  <x-breadcrumb pagetitle="{{ __('customer') }}" title="{{ __('edit') }}" />
@endsection

@section('page-button')
<a class="btn btn-primary" href="{{ route('customer.index') }}"> Back</a>
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
                {!! Form::open(array('route' => ['customer.update', $customer->id],'method'=>'PATCH', 'class' => 'row g-3 needs-validation' , 'novalidate', 'enctype'=>"multipart/form-data")) !!}
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">{{ __('company_name') }}:</label>
                        {!! Form::text('company_name', $customer->company_name, array('placeholder' => __('company_name'),'class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('company_name') }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">{{ __('client_id') }}:</label>
                        {!! Form::text('client_id', $customer->client_id, array('placeholder' => __('client_id'),'class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('client_id') }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">{{ __('tax_registration_number') }}:</label>
                        {!! Form::text('tax_registration_number', $customer->tax_registration_number, array('placeholder' => __('tax_registration_number'),'class' => 'form-control')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('tax_registration_number') }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">{{ __('phone_no') }}:</label>
                        {!! Form::text('phone_no', $customer->phone_no, array('placeholder' => __('phone_no'),'class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('phone_no') }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">{{ __('email') }}:</label>
                        {!! Form::email('email', $customer->email, array('placeholder' => __('email'),'class' => 'form-control', 'required')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('email') }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">{{ __('mobile_no') }}:</label>
                        {!! Form::text('mobile_no', $customer->mobile_no, array('placeholder' => __('mobile_no'),'class' => 'form-control')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('mobile_no') }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">{{ __('po_number') }}:</label>
                        {!! Form::text('po_number', $customer->po_number, array('placeholder' => __('po_number'),'class' => 'form-control')) !!}
                        <div class="invalid-feedback">
                            Please provide po_number
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">{{ __('address') }}:</label>
                        {!! Form::textarea('address', $customer->address, array('placeholder' => __('address'),'class' => 'form-control', 'required','rows' => 4, )) !!}
                        <div class="invalid-feedback">
                            Please provide address
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label required-label">{{ __('billing_model') }}:</label>
                        <div class="input-group has-validation">
                            <select class="form-control" name="billing_model">
                                <option value="1" @if($customer->billing_model == 1) selected @endif>{{ __('contract') }}</option>
                                <option value="2" @if($customer->billing_model == 2) selected @endif>{{ __('per_lift') }}</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide billing_model
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label required-label">{{ __('schedule') }}:</label>
                        <div class="input-group has-validation">
                            <select class="form-control" name="schedule">
                                <option value="1" @if($customer->schedule == 1) selected @endif>{{ __('daily_7') }}</option>
                                <option value="2" @if($customer->schedule == 2) selected @endif>{{ __('daily_6') }}</option>
                                <option value="3" @if($customer->schedule == 3) selected @endif>{{ __('3_days_week') }}</option>
                                <option value="4" @if($customer->schedule == 4) selected @endif>{{ __('2_days_week') }}</option>
                                <option value="5" @if($customer->schedule == 5) selected @endif>{{ __('twice_daily') }}</option>
                                <option value="6" @if($customer->schedule == 6) selected @endif>{{ __('on_call') }}</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide schedule
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label required-label">{{ __('skip_provided') }}:</label>
                        <div class="input-group has-validation">
                            <select class="form-control" name="skip_provided">
                                <option value="1"  @if($customer->skip_provided == 1) selected @endif>{{ __('owned') }}</option>
                                <option value="2" @if($customer->skip_provided == 2) selected @endif>{{ __('client') }}</option>
                                
                            </select>
                            <div class="invalid-feedback">
                                Please provide waste_type
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">{{ __('gate_fee') }}:</label>
                        {!! Form::text('gate_fee', $customer->gate_fee, array('placeholder' => __('gate_fee'),'class' => 'form-control')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('gate_fee') }}
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-auto  ms-auto">
                            <button class="btn btn-primary" type="button" id="add_more_locations">{{ __('add_more_locations') }}</button>
                        </div>
                    </div>
                    <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box accordion-success" id="accordionFill">
                        @foreach($customer->customer_uid as $key => $val)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="accordionFillInner{{ $key + 1 }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_fill{{ $key + 1 }}" aria-expanded="false" aria-controls="accor_fill{{ $key + 1 }}">
                                    <div class="col-md-11 buttonText">
                                        {{ $val->location_name }} @if($val->is_deleted == 1) (Deleted) @endif
                                    </div>
                                    <div class="col-md-auto ms-auto">
                                        @if($val->is_deleted == 0)
                                        <span type="button" class="btn btn-outline-danger btn-icon btn_remove_location_count">
                                            <i class="ri-delete-bin-line"></i>
                                        </span>
                                        @else
                                        <span type="button" class="btn btn-outline-success btn-icon">
                                            <i class="ri-check-line"></i>
                                        </span>
                                        @endif
                                    </div>
                                </button>
                            </h2>
                            <div id="accor_fill{{ $key + 1 }}" class="accordion-collapse collapse" aria-labelledby="accordionFillInner{{ $key + 1 }}" data-bs-parent="#accordionFill">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="validationCustom01" class="form-label">{{ __('location_name') }}:</label>
                                            {!! Form::text('location_name[]', $val->location_name, array('placeholder' => __('location_name'),'class' => 'form-control', 'required')) !!}
                                            <div class="invalid-feedback">
                                                Please provide location_name
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="validationCustom01" class="form-label">{{ __('tag_id') }} ({{ __('UID') }}):</label>
                                            {!! Form::text('tag_uid[]', $val->tag_uid, array('placeholder' => __('tag_id'),'class' => 'form-control', 'required')) !!}
                                            <div class="invalid-feedback">
                                                Please provide tag_uid
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="validationCustom01" class="form-label">{{ __('skip_location') }}:</label>
                                            {!! Form::textarea('skip_location[]', $val->skip_location, array('placeholder' => __('skip_location'),'class' => 'form-control', 'required','rows' => 4, )) !!}
                                            <div class="invalid-feedback">
                                                Please provide {{ __('skip_location') }}
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="skip_parent">
                                        <div class="my-2 skip_row_parent">
                                            @foreach($val->customer_skip as $key2 => $val2)
                                            <div class="row skip_count_row my-1">
                                                <div class="col-md-3">
                                                    <label for="validationCustom01" class="form-label required-label">{{ __('waste_type') }}:</label>
                                                    <div class="input-group has-validation">
                                                        <select class="form-control waste_type" name="waste_type[{{$key}}][]" required>
                                                            <option value="">{{ __('select_value') }}</option>
                                                            <option value="1" @if($val2->waste_type == 1) selected @endif>{{ __('general') }}</option>
                                                            <option value="2" @if($val2->waste_type == 2) selected @endif>{{ __('construction') }}</option>
                                                            <option value="3" @if($val2->waste_type == 3) selected @endif>{{ __('hazardous') }}</option>
                                                            <option value="4" @if($val2->waste_type == 4) selected @endif>{{ __('msw') }}</option>
                                                            
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please provide {{ __('waste_type') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="validationCustom01" class="form-label required-label">{{ __('skip_size') }}:</label>
                                                    <div class="input-group has-validation">
                                                        <select class="form-control skip_size" name="skip_size[{{$key}}][]" required>
                                                            <option value="">{{ __('select_value') }}</option>
                                                            @foreach($skips as $val)
                                                            <option value="{{ $val->skip_size }}" _price="{{ $val->skip_price }}" _municipality_fee="{{ $val->municipality_fee }}" @if($val->skip_size == $val2->skip_size) selected @endif>{{ $val->skip_size }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please provide {{ __('skip_size') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="validationCustom01" class="form-label required-label">{{ __('skip_price') }}:</label>
                                                    {!! Form::text("skip_price[$key][]", $val2->skip_price, array('placeholder' => __('skip_price'),'class' => 'form-control skip_price', 'required' )) !!}
                                                    <div class="invalid-feedback">
                                                        Please provide {{ __('skip_price') }}
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="validationCustom01" class="form-label required-label">{{ __('municipality_fee') }}:</label>
                                                    {!! Form::text("municipality_fee[$key][]", $val2->municipality_fee, array('placeholder' => __('municipality_fee'),'class' => 'form-control municipality_fee', 'required' )) !!}
                                                    <div class="invalid-feedback">
                                                        Please provide {{ __('municipality_fee') }}
                                                    </div>
                                                </div>
                                                <div class="col-md-1 align-content-end">
                                                    <button type="button" class="btn btn-outline-danger btn-icon btn_remove_skip_count"><i class="ri-delete-bin-line"></i></button>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-md-auto  ms-auto">
                                                <button class="btn btn-success add_more_skip" type="button">{{ __('add_more_skip') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

@section('script-content')
<script>
    $("body").on("change",".skip_size",function(){
        var _price = $(":selected",this).attr("_price")
        var _municipality_fee = $(":selected",this).attr("_municipality_fee")
        var _row = $(":selected",this).parents(".skip_count_row")
        _row.find(".skip_price").val(_price)
        _row.find(".municipality_fee").val(_municipality_fee)
        
    })
    
    async function accordion_attributes_render(){
        $(".accordion-item").each(function(index){
            var _this = $(this);
            var cnt = (index + 1);
            _this.find(".accordion-header").attr("id","accordionFillInner" + cnt)
            _this.find(".accordion-header .buttonText").text("Location "+cnt)
            _this.find(".accordion-header button").attr("data-bs-target", "#accor_fill"+cnt)
            _this.find(".accordion-header button").attr("aria-controls", "accor_fill"+cnt)
        
            _this.find(".accordion-collapse").attr("aria-labelledby","#accordionFillInner" + cnt)
            _this.find(".accordion-collapse").attr("id","accor_fill" + cnt)
            
            _this.find(".skip_count_row").each(function(){
                $(this).find(".waste_type").attr("name","waste_type["+index+"][]")
                $(this).find(".skip_size").attr("name","skip_size["+index+"][]")
                $(this).find(".skip_price").attr("name","skip_price["+index+"][]")
                $(this).find(".municipality_fee").attr("name","municipality_fee["+index+"][]")
            })
            
        })
        
        document.querySelectorAll('.accordion-collapse').forEach((collapseEl) => {
            const collapseInstance = bootstrap.Collapse.getOrCreateInstance(collapseEl, { toggle: false });
            collapseInstance.hide(); // ensures all panels are closed
          });
          
          // wait for collapse animations (~350ms default in Bootstrap)
        await new Promise(r => setTimeout(r, 400));
        $(".accordion-item").last().find(".accordion-button").click();
    }
    
    $("body").on("click","#add_more_locations",function(){
        var _clone = $(".accordion-item").last().clone();
        _clone.find('input, textarea, select').val('');
        
        _clone.find(".skip_count_row").not(":first").remove();
        
        $("#accordionFill").append(_clone)
        
        accordion_attributes_render()
    })
    $("body").on("click",".add_more_skip",function(){
        var _clone = $(this).parents(".skip_parent").find(".skip_count_row").last().clone();
        _clone.find('input, textarea, select').val('');
        $(this).parents(".skip_parent").find(".skip_row_parent").append(_clone)
        
    })
    
    $("body").on("click",".btn_remove_location_count",function(){
        if($(this).parents(".accordion").find(".accordion-item").length > 1){
            $(this).parents(".accordion-item").remove()
            
            accordion_attributes_render()
        }else{
            Toastify({
                text: "At least one record is required!",
                gravity: "bottom",   // top or bottom
                position: "center",   // left, right or center
                className: "bg-danger"
            }).showToast();
        }
    })
    $("body").on("click",".btn_remove_skip_count",function(){
        if($(this).parents(".skip_parent").find(".skip_count_row").length > 1){
            $(this).parents(".skip_count_row").remove()
        }else{
            Toastify({
                text: "At least one record is required!",
                gravity: "bottom",   // top or bottom
                position: "center",   // left, right or center
                className: "bg-danger"
            }).showToast();
        }
        
    })
    
</script>

@endsection
