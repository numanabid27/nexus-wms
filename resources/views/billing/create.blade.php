@extends('layouts.master')

@section('title')
    {{ __('bills') }}
@endsection
@section('content')

@section('page-title')
  <x-breadcrumb pagetitle="{{ __('bills') }}" title="{{ __('create') }}" />
@endsection

@section('page-button')
<a class="btn btn-primary" href="{{ route('billings.index') }}"> Back</a>
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
                {!! Form::open(array('route' => 'billings.fetch','method'=>'POST', 'class' => 'row g-3 needs-validation', 'id' => 'fetch-form' , 'novalidate', 'enctype'=>"multipart/form-data")) !!}
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">{{ __('customers') }}:</label>
                        <select class="form-control" name="customers[]" data-choices data-choices-removeItem data-choices-sorting-false multiple tabindex="-1">
                            <option value>{{ __('please_select') }}</option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->skip_location }} - {{ $customer->customer->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">{{ __('billing_period') }}:</label>
                        {!! Form::text('billing_period', null, array('placeholder' => __('billing_period'),'class' => 'form-control  flatpickr-input', 'required' , 'data-provider'=>"flatpickr",  'data-date-format'=>"Y-m-d", 'data-range-date'=>"true" , 'readonly'=>"readonly")) !!}
                        <div class="invalid-feedback">
                            Please provide company name
                        </div>
                    </div>
                    <div class="col-4 align-content-end">
                        <button class="btn btn-primary" id="btn-fetch" type="submit">{{ __('fetch') }}</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div id="generated-div">
    
</div>

@endsection

@section('script-content')
<script>
    $("body").on("submit","#fetch-form",function(e){
        
        e.preventDefault(); // Stop normal form submission
        
        
        if($("[name=billing_period]").val() == ""){
            Toastify({
                text: "Billing Period is required",
                gravity: "center",   // top or bottom
                position: "center",   // left, right or center
                className: "bg-danger"
            }).showToast();
            return;
        }
        var _this = $(this);
        $(this).find("#btn-fetch").prop("disabled",true)
        $(this).find("#btn-fetch").addClass("btn-load")
        $(this).find("#btn-fetch").prepend('<span class="spinner-border flex-shrink-0" role="status"></span>')
        $.ajax({
            url: $(this).attr('action'),        // Your endpoint
            type: "POST",              // Method
            data: $(this).serialize(), // Form data
            dataType: 'html',
            success: function(response) {
                
                $("#generated-div").html(response)
                calculate_total();
                // $("#response").html(response); // Show server response
            },
            error: function() {
                Toastify({
                    text: "An error occurred.",
                    gravity: "center",   // top or bottom
                    position: "center",   // left, right or center
                    className: "bg-danger"
                }).showToast();
            },
            complete:function(){
                _this.find("#btn-fetch").prop("disabled",false)
                _this.find("#btn-fetch").removeClass("btn-load")
                _this.find("#btn-fetch span").remove()
            }
        });
        
    })
    
    function calculate_total(){
        $('.customer-card').each(function() {
            var grandTotal = 0;
            $(this).find('input[name="total_price[]"]').each(function(){
               grandTotal += parseFloat($(this).val()) || 0; 
            });
            grandTotal += parseFloat($(this).find("[name=extra_charges]").val()) || 0;
            grandTotal -= parseFloat($(this).find("[name=discount]").val()) || 0;
            // $(this).find('input[name="extra_charges[]"]').each(function(){
            //   grandTotal += parseFloat($(this).val()) || 0; 
            // });
            // $(this).find('input[name="total_bill"]').val(grandTotal)
            $(this).find('.total_bill').text(grandTotal)
            
        });
    }
    $("body").on("change","[name='total_price[]']",function(){
        calculate_total();
    })
    $("body").on("change","[name=extra_charges]",function(){
        calculate_total();
    })
    $("body").on("change","[name=discount]",function(){
        calculate_total();
    })
    // $("body").on("change","[name='extra_charges[]']",function(){
    //     calculate_total();
    // })
    function calculate_municipality_total(){
        $('.municipality-table').each(function() {
            var grandTotal = 0;
            $(this).find('input[name="municipality_quantity[]"]').each(function(){
                
               var val = parseFloat($(this).val()) || 0; 
               
               var price = $(this).parents("tr").find('[name="municipality_skip_price[]"]').val()
               $(this).parents("tr").find("td").last().text(parseInt(price) * val)
               
               grandTotal += (parseInt(price) * val)
            });
            
            $(this).find('tbody tr').last().find("td").last().text(grandTotal)
            
        });
    }
    $("body").on("keyup","[name='municipality_quantity[]']",function(){
        calculate_municipality_total();
    })
    $("body").on("submit",".generate-form",function(e){
        e.preventDefault();
        
        var _this = $(this);
        
        $(this).find(".btn-generate").prop("disabled",true)
        $(this).find(".btn-generate").addClass("btn-load")
        $(this).find(".btn-generate").prepend('<span class="spinner-border flex-shrink-0" role="status"></span>')
        
        $.ajax({
            url: $(this).attr('action'),        // Your endpoint
            type: "POST",              // Method
            data: $(this).serialize(), // Form data
            dataType: 'json',
            success: function(response) {
                Toastify({
                    text: "Bill Generated",
                    gravity: "bottom",
                    // top or bottom
                    position: "center",
                    // left, right or center
                    className: "bg-success"
                }).showToast()
                
            },
            error: function(err) {
                debugger
                Toastify({
                    text: "An error occurred.",
                    gravity: "center",   // top or bottom
                    position: "center",   // left, right or center
                    className: "bg-danger"
                }).showToast();
            },
            complete:function(){
                _this.find(".btn-generate").prop("disabled",false)
                _this.find(".btn-generate").removeClass("btn-load")
                _this.find(".btn-generate span").remove()
            }
        });
    })
    
</script>

@endsection