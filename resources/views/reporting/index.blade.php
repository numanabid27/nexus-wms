@extends('layouts.master')

@section('title')
    {{ __('reporting') }}
@endsection
@section('css')


@endsection
@section('content')

@section('page-title')
    <x-breadcrumb pagetitle="{{ __('reporting') }}" title="" />
@endsection

@section('page-button')

@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('reporting') }}</h5>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'report.fetch','method'=>'POST', 'class' => 'row g-3 needs-validation', 'id' => 'fetch-report' , 'novalidate', 'enctype'=>"multipart/form-data")) !!}
                <div class="row">
                    <div class="col-3">
                        <label for="validationCustom01" class="form-label">{{ __('drivers') }}:</label>
                        <select class="form-control" name="drivers[]" data-choices data-choices-removeItem data-choices-sorting-false multiple tabindex="-1">
                            <option value>{{ __('please_select') }}</option>
                            @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    
                    <div class="col-3">
                        <label for="validationCustom01" class="form-label">{{ __('vehicles') }}:</label>
                        <select class="form-control" name="vehicles[]" data-choices data-choices-removeItem data-choices-sorting-false multiple tabindex="-1">
                            <option value>{{ __('please_select') }}</option>
                            @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ $vehicle->plate_no }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="col-3">
                        <label for="validationCustom01" class="form-label">{{ __('range') }}:</label>
                        {!! Form::text('range', null, array('placeholder' => __('range'),'class' => 'form-control  flatpickr-input', 'data-provider'=>"flatpickr",  'data-date-format'=>"Y-m-d", 'data-range-date'=>"true" , 'readonly'=>"readonly")) !!}
                        <div class="invalid-feedback">
                            Please provide company name
                        </div>
                    </div>
                    <div class="col-3 align-content-end">
                        <button class="btn btn-primary" type="submit" id="btn-fetch">{{ __('fetch') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div id="generated-div">
    
</div>
<!-- Hidden iframe -->
<iframe id="printFrame" style="display:none;"></iframe>

@endsection

@section('script-content')
<!-- apexcharts -->
<script src="{{ asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- barcharts init -->
<script src="{{ asset('build/js/pages/apexcharts-bar.init.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

<script>

    $("body").on("submit","#fetch-report",function(e){
        
        e.preventDefault(); // Stop normal form submission
        
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
    
    $("body").on("click","#btn-print" ,function(){
        let div = $("#print-report")[0];

        html2canvas(div).then(function (canvas) {
            let imgData = canvas.toDataURL("image/png");
    
            let iframe = $("#printFrame")[0];
            let iframeDoc = iframe.contentWindow || iframe.contentDocument;
            iframeDoc = iframeDoc.document ? iframeDoc.document : iframeDoc;
    
            iframeDoc.open();
            iframeDoc.write(`
                <html>
                <head><title>Print</title></head>
                <body style="margin:0; text-align:center;">
                    <img src="${imgData}" style="width:100%;"/>
                </body>
                </html>
            `);
            iframeDoc.close();
    
            // Wait for iframe content to load before printing
            iframe.onload = function () {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();
            };
        });
    })
    
</script>


@endsection