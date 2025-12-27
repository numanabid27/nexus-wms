@extends('layouts.master')

@section('title')
    {{ __('bills') }}
@endsection
@section('content')

@section('page-title')
  <x-breadcrumb pagetitle="{{ __('bills') }}" title="{{ __('edit') }}" />
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
                
                @php
                    $scheduleTypes = [
                        1 => __('daily_7'),
                        2 => __('daily_6'),
                        3 => __('3_days_week'),
                        4 => __('2_days_week'),
                    ];
                @endphp
                
                @include("billing.customer_invoice_detail",["billing" => $billing, "company" => $company])
                
                <div class="row">
                    <table class="table notDataTable table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('pickup_date') }}</th>
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
                                <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}">{{ $collection->pickup_date }}</td>
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
                                <td class="align-content-center" rowspan="{{ count($collection->collectionSkips) }}"> {{ $collection->signatory_name }}</td>
                                <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}">@if(!is_null($collection->signature_guid)) <img src="{{ asset($collection->signature_guid) }}" height="30"/> @else No Signature @endif</td>
                                <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}"> {{ $collection->driver->name }}</td>
                                <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}"> {{ implode(",",$collection->helpers) }}</td>
                                @foreach($detail->billing_detail_skip as $key => $skip)
                                
                                <input type="hidden" name="waste_type[{{ $cl_key }}][]" value="{{ $skip->waste_type }}"/>
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
                                <td colspan="10"></td>
                                <td colspan="2">{{ __('total_price') }}</td>
                                <td class="total_bill">{{ $total_skip_price }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                {!! Form::open(array('route' => ['billings.update', $billing->id],'method'=>'POST', 'class' => 'row needs-validation' , 'novalidate', 'enctype'=>"multipart/form-data")) !!}
                @php
                $total_manucipality = 0;
                @endphp
                <div class="row">
                    <table class="table notDataTable table-bordered municipality-table">
                        <thead>
                            <tr>
                                <th>{{ __('skip_size') }}</th>
                                <th>{{ __('waste_type') }}</th>
                                <th>{{ __('quantity') }}</th>
                                <th>{{ __('municipality_fee') }}</th>
                                <th>{{ __('total_price') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($billing->billing_municipality as $key => $bill)
                            @php
                                $total_manucipality += ($bill->quantity * $bill->price);
                            @endphp
                                <tr>
                                    <input type="hidden" name="municipality_skip_size[]" value="{{ $bill->skip_size }}"/>
                                    <input type="hidden" name="municipality_skip_price[]" value="{{ $bill->price }}"/>
                                    <input type="hidden" name="municipality_waste_type[]" value="{{ $bill->waste_type }}"/>
                                    <td>{{ $bill->skip_size }}</td>
                                    <td>{{ StatusHelper::waste_type($bill->waste_type) }}</td>
                                    <td>{!! Form::number('municipality_quantity[]', $bill->quantity, array('placeholder' => __('quantity'),'class' => 'form-control', 'required')) !!}</td>
                                    <td>{{ $bill->price }}</td>
                                    <td>{{ ($bill->quantity * $bill->price) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"></td>
                                <td>{{ __('total_bill') }}</td>
                                <td>{{ $total_manucipality }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">{{ __('gate_fee') }}:</label>
                        {!! Form::text('gate_fee', $billing->gate_fee, array('placeholder' => __('gate_fee'),'class' => 'form-control')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('gate_fee') }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">{{ __('discount') }}:</label>
                        {!! Form::number('discount', $billing->discount, array('placeholder' => __('discount'),'class' => 'form-control')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('discount') }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">{{ __('extra_charges') }}:</label>
                        {!! Form::number('extra_charges', $billing->extra_charges, array('placeholder' => __('extra_charges'),'class' => 'form-control')) !!}
                        <div class="invalid-feedback">
                            Please provide {{ __('extra_charges') }}
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="validationCustom01" class="form-label">{{ __('remarks') }}:</label>
                    <p>{!! Form::textarea('remarks', $billing->note, array('placeholder' => __('remarks'),'class' => 'form-control', 'rows' => 4, )) !!}</p>
                </div>
                <div class="col-12">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


<div id="print-div">
    
</div>
@endsection
@section('script-content')

<script>
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

</script>

@endsection