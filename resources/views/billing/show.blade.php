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
        <div class="card customer-card">
            
            <div class="card-body">
                
                <div class="row mb-2">
                    <div class="col-md-auto ms-auto">
                        <form method="GET" id="generate-invoice-print-form" action="{{ route('billings.generate_invoice_print',[$billing->id,$billing->invoice_generated]) }}" style="display:inline;">
                            <button class="btn btn-success" type="button"  onclick="sa_warning_delete_form_submit(this,'Are you sure?',@if($billing->invoice_generated == 1)  'Are you sure you want to view invoice?' @else 'Are you sure you want to generate invoice?' @endif ,@if($billing->invoice_generated == 1) 'Yes' @else 'Yes, Generate!' @endif)">
                                <i class="{{ $billing->invoice_generated == 1 ? 'ri-eye-line' : 'ri-printer-line' }} align-bottom me-1"></i> {{ $billing->invoice_generated == 1 ? __('View Invoice') : __('Generate Invoice') }}
                            </button>
                        </form>
                    </div>
                </div>
                
                
                @include("billing.customer_invoice_detail",["billing" => $billing, "company" => $company])
                
                <div class="row g-lg-4 g-3">
                    <table class="table notDataTable table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('gate_fee') }}</th>
                                <th>{{ __('discount') }}</th>
                                <th>{{ __('extra_charges') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                                <td>{{ $billing->gate_fee }}</td>
                                <td>{{ $billing->discount }}</td>
                                
                                <td>{{ $billing->extra_charges }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <div class="row mt-3">
                <h4 class="p-0">{{ __('collection_record') }}</h4>
            </div>
                <div class="row">
                    <table class="table notDataTable table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('pickup_date') }}</th>
                                <th>{{ __('collection_duration') }}</th>
                                <th>{{ __('before_image') }}</th>
                                <th>{{ __('after_image') }}</th>
                                <th>{{ __('status') }}</th>
                                <th>{{ __('signatory') }}</th>
                                <th>{{ __('signature') }}</th>
                                <th>{{ __('Driver') }}</th>
                                <th>{{ __('Helpers') }}</th>
                                <th>{{ __('waste_type') }}</th>
                                <th>{{ __('skip_size') }}</th>
                                <th>{{ __('skip_price') }}</th>
                                <th>{{ __('skip_quantity') }}</th>
                                <th>{{ __('sub_total') }}</th>
                                <!--<th>{{ __('extra_charges') }}</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $total_skip_price = 0;
                            @endphp
                            @foreach($billing->billing_detail as $cl_key =>  $detail)
                            @php
                            $collection = $detail->collection;
                            @endphp
                            <tr>
                                <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}">{{ \Carbon\Carbon::parse($collection->pickup_date)->format($company->time_format == 1 ? 'Y-m-d H:i' : 'Y-m-d h:i A') }}</td>
                                <td class="align-content-center" rowspan="{{ count($collection->collectionSkips) }}">{{ date_duration($collection->created_at, $collection->pickup_date) }}</td>
                                <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}"><img src="{{ asset($collection->before_image_guid) }}" height="30"/></td>
                                <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}"><img src="{{ asset($collection->after_image_guid) }}" height="30"/></td>
                                <td class="align-content-center @if($collection->status == 4 || $collection->status == 5) bg-danger @endif" rowspan="{{ count($detail->billing_detail_skip) }}">
                                    @php
                                        $statusTypes = [
                                            0 => "Undefined" ,
                                            1 => "Collected" , 
                                            2 => "Access blocked" ,
                                            3 => "No Waste" , 
                                            4 => "Excess Waste" , 
                                            5 => "Wrong Waste",
                                        ];
                                    @endphp
                                    {{ $statusTypes[$collection->status] }}
                                </td rowspan="{{ count($detail->billing_detail_skip) }}">
                                <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}"> {{ $collection->signatory_name }}</td>
                                <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}">@if(!is_null($collection->signature_guid)) <img src="{{ asset($collection->signature_guid) }}" height="30"/> @else No Signature @endif</td>
                                <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}"> {{ $collection->driver->name }}</td>
                                <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}"> {{ implode(",",$collection->helpers) }}</td>
                                @foreach($detail->billing_detail_skip as $key => $skip)
                                <input type="hidden" name="skip_size[{{ $cl_key }}][]" value="{{ $skip->skip_size }}"/>
                                <input type="hidden" name="skip_price[{{ $cl_key }}][]" value="{{ $skip->skip_price }}"/>
                                <input type="hidden" name="skip_quantity[{{ $cl_key }}][]" value="{{ $skip->quantity }}"/>
                                    @if($key != 0)<tr> @endif
                                        <td>{{ StatusHelper::waste_type($skip->waste_type) }}</td>
                                        <td>{{ $skip->skip_size }}</td>
                                        <td>{{ $skip->skip_price }}</td>
                                        <td>{{ $skip->quantity }}</td>
                                        
                                        @if($key == 0)
                                        
                                        @php
                                            $total_amount = 0;
                                            foreach($detail->billing_detail_skip as $skp){
                                                $total_amount += ($skp->quantity * $skp->skip_price);
                                            }
                                            $total_skip_price += $total_amount;
                                        @endphp
                                        <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}">{!! Form::hidden('total_price[]', ($total_amount), array('placeholder' => __('total_price'),'class' => 'form-control', 'required')) !!}{{ $total_amount }}</td>
                                        <!--<td class="align-content-center" rowspan="{{ count($collection->collectionSkips) }}">{!! Form::number('extra_charges[]', null, array('placeholder' => __('extra_charges'),'class' => 'form-control', 'required')) !!}</td>-->
                                        @endif
                                        
                                    @if($key != 0)</tr> @endif
                                @endforeach
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="8"></td>
                                <td colspan="3">{{ __('total_price') }}</td>
                                <td colspan="2" class="total_bill">{{ $total_skip_price }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <h4 class="p-0">{{ __('Municipality Charges') }}</h4>
                </div>
                <div class="row">
                    <table class="table notDataTable table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('skip_size') }}</th>
                                <th>{{ __('waste_type') }}</th>
                                <th>{{ __('quantity') }}</th>
                                <th>{{ __('price') }}</th>
                                <th>{{ __('sub_total') }}</th>
                                <!--<th>{{ __('extra_charges') }}</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $total_municipality_price = 0;
                            @endphp
                            @foreach($billing->billing_municipality as $cl_key =>  $detail)
                            @php 
                            $sub_total = ($detail->price * $detail->quantity);
                            $total_municipality_price += $sub_total;
                            @endphp
                            <tr>
                                <td>{{ $detail->skip_size }}</td>
                                <td>{{ StatusHelper::waste_type($detail->waste_type) }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>{{ $detail->price }}</td>
                                <td>{{ $sub_total }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">{{ __('total_price') }}</td>
                                <td class="total_bill">{{ $total_municipality_price }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="row mb-2">
                    <label for="validationCustom01" class="form-label">{{ __('remarks') }}:</label>
                    <p>{{ $billing->note }}</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="print-div">
    
</div>
@endsection
@section('script-content')

<script>
    
     $("body").on("submit","#generate-invoice-print-form",function(e){
        
        e.preventDefault(); // Stop normal form submission
        
        $.ajax({
            url: $(this).attr('action'),        // Your endpoint
            type: "GET",              // Method
            data: $(this).serialize(), // Form data
            dataType: 'html',
            success: function(response) {
                $("#print-div").html(response)
                
                
                Swal.close()
                
                openPrintTab()
                
                // var printContents = $('#print-div').clone();

                // // Open a new window for printing
                // var printWindow = window.open('', '_blank', 'height=600,width=800');
                // printWindow.document.write('<html><head><title>Print</title>');
        
                // // Include the same styles (for page breaks)
                // printWindow.document.write('<style>@media print { .pages { page-break-before: always; } }</style>');
        
                // printWindow.document.write('</head><body >');
                // printWindow.document.write(printContents.html());
                // printWindow.document.write('</body></html>');
        
                // printWindow.document.close();
                // // Wait until everything (including images) is loaded
                // printWindow.onload = function() {
                //     printWindow.focus();
                //     printWindow.print();
                //     printWindow.close();
                //     $("#print-div").html("")
                // };
                
                
            },
            error: function() {
                Swal.close()
                Toastify({
                    text: "An error occurred.",
                    gravity: "bottom",   // top or bottom
                    position: "center",   // left, right or center
                    className: "bg-danger"
                }).showToast();
            }
        });
        
    })
    
    function openPrintTab() {
        // Open the tab *first*, during the user action
        var printWindow = window.open('', '_blank');
    
        // If null, popup was blocked
        if (!printWindow || printWindow.closed || typeof printWindow.closed === 'undefined') {
            alert('Please allow pop-ups for this site to use the print feature.');
            return;
        }
    
        // Clone the content
        var printContents = $('#print-div').clone();
    
        // Build the HTML for the new tab
        printWindow.document.open();
        printWindow.document.write(`
            <html>
              <head>
                <title>Print</title>
                <style>
                     @media print {
                        .pages {
                            page-break-after: always;
                            break-after: page;
                        }
                        @page {
                            size: A4;
                          
                        }
                        
    
                        .pages:last-child {
                            page-break-after: auto;
                            break-after: auto;
                        }
    
                        table, tr, td, th {
                            page-break-inside: avoid;
                        }
                        
                    }
                    body {
                        font-family: Arial, sans-serif;
                        margin: 20px;
                    }
                    
                    
                </style>
              </head>
              <body>
                ${printContents.html()}
              </body>
            </html>
        `);
        printWindow.document.close();
        setTimeout(() => {
            try {
              printWindow.focus();
              printWindow.print();
            } finally {
              // Closing immediately can cancel the dialog in Safari; delay close a bit
              setTimeout(() => {
                printWindow.close();
                $("#print-div").html("");
              }, 200);
            }
          }, 300);
    
        // Wait until the new tab is fully ready
        // printWindow.onload = function () {
        //     printWindow.focus();
        //     printWindow.print();
        //     printWindow.close();
        //     $("#print-div").html("");
             

        // };
    }

</script>

@endsection