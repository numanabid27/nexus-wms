@foreach($customer_uids as $customer_uid)
@php $customer = $customer_uid->customer; @endphp
@if(count($customer_uid->collections) > 0)
{!! Form::open(array('route' => 'billings.generate','method'=>'POST', 'class' => 'row g-3 needs-validation generate-form',  'novalidate', 'enctype'=>"multipart/form-data")) !!}
    <input type="hidden" name="customer_id" value="{{ $customer->id }}"/>
    <input type="hidden" name="customer_uid_id" value="{{ $customer_uid->id }}"/>
    <div class="card customer-card">
        <div class="card-header">
            <h4 class="card-title mb-1">{{ $customer->company_name }} ({{ $customer->client_id }})</h4>
        </div>
        <div class="card-body">
            <div class="row g-lg-4 g-3 mt-2">
                <div class="col-lg-3 col-md-6">
                    <div>
                        <p class="text-muted text-uppercase fs-sm mb-1">{{ __('address') }}</p>
                        <h6 class="mb-0 lh-base fs-md">{{ $customer->address }}</h6>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div>
                        <p class="text-muted text-uppercase fs-sm mb-1">{{ __('skip_location') }}</p>
                        <h6 class="mb-0 lh-base fs-md">
                            {{ $customer_uid->skip_location }}
                        </h6>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div>
                        <p class="text-muted text-uppercase fs-sm mb-1">{{ __('billing_model') }} </p>
                        <h6 class="mb-0 lh-base fs-md">
                         
                            {{ StatusHelper::billing_model($customer->billing_model) }}
                        </h6>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div>
                        <p class="text-muted text-uppercase fs-sm mb-1">{{ __('schedule') }}</p>
                        <h6 class="mb-0 lh-base fs-md">
                            {{ StatusHelper::schedules($customer->schedule) }}
                        </h6>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row mb-2">
                <!--<div class="col-md-4">-->
                <!--    <label for="validationCustom01" class="form-label">{{ __('municipality_fee') }}:</label>-->
                <!--    {!! Form::text('municipality_fee', $customer->municipality_fee, array('placeholder' => __('municipality_fee'),'class' => 'form-control', 'required')) !!}-->
                <!--    <div class="invalid-feedback">-->
                <!--        Please provide {{ __('municipality_fee') }}-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-md-6">-->
                <!--    <label for="validationCustom01" class="form-label">{{ __('total_bill') }}:</label>-->
                <!--    {!! Form::text('total_bill', null, array('placeholder' => __('total_bill'),'class' => 'form-control', 'required')) !!}-->
                <!--    <div class="invalid-feedback">-->
                <!--        Please provide {{ __('total_bill') }}-->
                <!--    </div>-->
                <!--</div>-->
                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">{{ __('gate_fee') }}:</label>
                    {!! Form::text('gate_fee', $customer->gate_fee, array('placeholder' => __('gate_fee'),'class' => 'form-control', 'required')) !!}
                    <div class="invalid-feedback">
                        Please provide {{ __('gate_fee') }}
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">{{ __('discount') }}:</label>
                    {!! Form::text('discount', null, array('placeholder' => __('discount'),'class' => 'form-control', 'required')) !!}
                    <div class="invalid-feedback">
                        Please provide {{ __('discount') }}
                    </div>
                </div>
                
                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">{{ __('extra_charges') }}:</label>
                    {!! Form::text('extra_charges', null, array('placeholder' => __('extra_charges'),'class' => 'form-control', 'required')) !!}
                    <div class="invalid-feedback">
                        Please provide {{ __('extra_charges') }}
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <h4 class="p-0">{{ __('collection_record') }}</h4>
            </div>
            @php
            $manucipality = [];
            $total_manucipality = 0;
            @endphp
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('pickup_date') }}</th>
                            <th>{{ __('collection_duration') }}</th>
                            <th>{{ __('before_image') }}</th>
                            <th>{{ __('after_image') }}</th>
                            <th>{{ __('status') }}</th>
                            <th>{{ __('signatory') }}</th>
                            <th>{{ __('signature') }}</th>
                            <th>{{ __('waste_type') }}</th>
                            <th>{{ __('skip_size') }}</th>
                            <th>{{ __('skip_price') }}</th>
                            <th>{{ __('skip_quantity') }}</th>
                            <th>{{ __('total_price') }}</th>
                            <!--<th>{{ __('extra_charges') }}</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer_uid->collections as $cl_key => $collection)
                        <input type="hidden" name="collection_id[]" value="{{ $collection->id }}"/>
                        <input type="hidden" name="driver[]" value="{{ $collection->driver_id }}"/>
                        <input type="hidden" name="helpers[]" value="{{ $collection->helper_ids }}"/>
                        <input type="hidden" name="pickup_date[]" value="{{ $collection->pickup_date }}"/>
                        <tr>
                            <td class="align-content-center" rowspan="{{ count($collection->collectionSkips) }}">{{ \Carbon\Carbon::parse($collection->pickup_date)->format($company->time_format == 1 ? 'Y-m-d H:i' : 'Y-m-d h:i A') }}</td>
                            <td class="align-content-center" rowspan="{{ count($collection->collectionSkips) }}">{{ date_duration($collection->created_at, $collection->pickup_date) }}</td>
                            <td class="align-content-center" rowspan="{{ count($collection->collectionSkips) }}"><img src="{{ asset($collection->before_image_guid) }}" height="30"/></td>
                            <td class="align-content-center" rowspan="{{ count($collection->collectionSkips) }}"><img src="{{ asset($collection->after_image_guid) }}" height="30"/></td>
                            <td class="align-content-center @if($collection->status == 4 || $collection->status == 5) bg-danger @endif" rowspan="{{ count($collection->collectionSkips) }}">
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
                            </td rowspan="{{ count($collection->collectionSkips) }}">
                            <td class="align-content-center" rowspan="{{ count($collection->collectionSkips) }}"> {{ $collection->signatory_name }}</td>
                            <td class="align-content-center" rowspan="{{ count($collection->collectionSkips) }}">@if(!is_null($collection->signature_guid)) <img src="{{ asset($collection->signature_guid) }}" height="30"/> @else No Signature @endif</td>
                            
                            @foreach($collection->collectionSkips as $key => $skip)
                            
                            @php
                            
                            if(!isset($manucipality[$skip->skip_size][$skip->waste_type])){
                                $manucipality[$skip->skip_size][$skip->waste_type] = (Object)["quantity" => $skip->quantity , "municipality_fee" => $skip->municipality_fee];
                            }else{
                                $manucipality[$skip->skip_size][$skip->waste_type]->quantity = $manucipality[$skip->skip_size][$skip->waste_type]->quantity + $skip->quantity;
                            }
                            
                            @endphp
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
                                        foreach($collection->collectionSkips as $skp){
                                            $total_amount += ($skp->quantity * $skp->skip_price);
                                        }
                                    @endphp
                                    <td class="align-content-center" rowspan="{{ count($collection->collectionSkips) }}">{!! Form::hidden('total_price[]', ($total_amount), array('placeholder' => __('total_price'),'class' => 'form-control', 'required')) !!}{{ $total_amount }}</td>
                                    <!--<td class="align-content-center" rowspan="{{ count($collection->collectionSkips) }}">{!! Form::number('extra_charges[]', null, array('placeholder' => __('extra_charges'),'class' => 'form-control', 'required')) !!}</td>-->
                                    @endif
                                    
                                @if($key != 0)</tr> @endif
                            @endforeach
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="8"></td>
                            <td colspan="2">{{ __('total_bill') }}</td>
                            <td class="total_bill">dfdf</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row mt-3">
                <h4 class="p-0">{{ __('municipality_record') }}</h4>
            </div>
            <div class="row">
                <table class="table table-bordered municipality-table">
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
                        @foreach($manucipality as $key => $skip)
                            @foreach($skip as $key2 => $val)
                            @php
                                $total_manucipality += ($val->quantity * $val->municipality_fee);
                            @endphp
                            <tr>
                                <input type="hidden" name="municipality_skip_size[]" value="{{ $key }}"/>
                                <input type="hidden" name="municipality_skip_price[]" value="{{ $val->municipality_fee }}"/>
                                <input type="hidden" name="municipality_waste_type[]" value="{{ $key2 }}"/>
                                <td>{{ $key }}</td>
                                <td>{{ StatusHelper::waste_type($key2) }}</td>
                                <td>{!! Form::number('municipality_quantity[]', $val->quantity, array('placeholder' => __('quantity'),'class' => 'form-control', 'required')) !!}</td>
                                <td>{{ $val->municipality_fee }}</td>
                                <td>{{ ($val->quantity * $val->municipality_fee) }}</td>
                            </tr>
                            @endforeach
                        @endforeach
                        <tr>
                            <td colspan="3"></td>
                            <td>{{ __('total_bill') }}</td>
                            <td>{{ $total_manucipality }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row mb-2">
                <label for="validationCustom01" class="form-label">{{ __('remarks') }}:</label>
                {!! Form::textarea('note', null, array('placeholder' => __('remarks'),'class' => 'form-control  flatpickr-input', 'required' ,"rows" => "2")) !!}
                <div class="invalid-feedback">
                    Please provide {{ __('remarks') }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-auto ms-auto">
                    <button class="btn btn-primary btn-generate" type="submit">Generate</button>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}
@endif
@endforeach
