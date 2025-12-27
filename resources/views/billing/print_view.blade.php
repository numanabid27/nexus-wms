<link href="{{ $isPdf ? public_path('build/css/bootstrap.css') : asset('build/css/bootstrap.css') }}" rel="stylesheet" type="text/css">


<style  type="text/css">
    .invoice-wrapper {
      max-width: 1000px;
      margin: 30px auto;
      background-color: #ffffff;
      padding: 25px 35px;
      border: 1px solid #dee2e6;
    }
    .invoice-title {
      font-size: 1.6rem;
      font-weight: 700;
      letter-spacing: 1px;
      text-align:center;
    }
    .invoice-subtitle {
      font-size: 0.9rem;
      text-align:center;
    }
     table.table {
        border-collapse: collapse !important;
        border-spacing: 0 !important;
    }
    
    .page {
        page-break-after: always;
    }
    
    /* Ensure elements with class 'pages' start on a new page */
   
    
    @media print {

        body {
            margin: 0;
        }
        table.table {
            border-collapse: collapse !important;
            width: 100%;
        }
    
       @-moz-document url-prefix() {
            table.table th,
            table.table td,
            table.table tr {
                border: 1.4px solid #dde1ef !important;
            }
        }
        .pages {
            page-break-after: always;
            break-after: page;
        }

        .pages:last-child {
            page-break-after: auto;
            break-after: auto;
            
        }

        .pages *:not(.invoice-title):not(.invoice-subtitle) {
            font-size: 12px !important;
        }

        .pages:nth-of-type(2) *:not(.invoice-title):not(.invoice-subtitle) {
            font-size: 8px !important;
        }

        table, tr, td, th {
            page-break-inside: avoid;
        }
        

        .table > :not(caption) > * > * {
            padding: .1rem .6rem;
        }
</style>

<div class="pages">
    <div class="invoice-wrapper">
        <div class="mb-2">
            <img src="{{ $isPdf ? public_path($company->logo_guid) : asset($company->logo_guid) }}" height="50"/>
        </div>
        <!-- Header -->
        <div class="text-center">
          <div class="invoice-title">TAX INVOICE</div>
          <div class="invoice-subtitle">TRN NUMBER: {{ $company->tax_registration_number }}</div>
        </div>
        @include("billing.customer_invoice_detail",["billing" => $billing, "company" => $company])
        
        <!-- Line items table -->
        <div class="row g-lg-4 g-3">
          <table class="table  notDataTable table-bordered table-sm mb-0">
            <thead class="table-light text-center align-middle">
              <tr>
                <th style="width: 4%;">Sr. No.</th>
                <th style="width: 40%;">Particulars</th>
                <th style="width: 8%;">Quantity</th>
                <th style="width: 10%;">Unit Price</th>
                <th style="width: 12%;">Total (Exclude VAT)</th>
                <th style="width: 8%;">Tax Rate</th>
                <th style="width: 10%;">Tax Amount</th>
                <th style="width: 12%;">Total (Include VAT)</th>
              </tr>
            </thead>
            <tbody class="align-middle">
            @php
            $quantity = 0;
            $total_tax_amount = 0;
            $total_amount = 0;
            @endphp
            @foreach($billing->merge_collections as $key => $skip)
            
                @php
                $quantity += $skip->quantity;
                
                $amount = ($skip->price * $skip->quantity);
                $tax_amount = ($amount / 100) * 5;
                $total_amount += $amount;
                $total_tax_amount += $tax_amount;
                @endphp
                  <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>
                      @if(isset($skip->skip_collection))Garbage collection &amp; Disposal Charge @else {{ __('municipality_fee') }} @endif - {{ $skip->skip_size }} bin {{ StatusHelper::waste_type($skip->waste_type) }} waste
                    </td>
                    <td class="text-center">{{ $skip->quantity }}</td>
                    <td class="text-end">{{ number_format($skip->price,2) }} AED</td>
                    <td class="text-end">{{ number_format($amount , 2) }} AED</td>
                    <td class="text-center">5%</td>
                    <td class="text-end">{{ number_format($tax_amount,2) }} AED</td>
                    <td class="text-end">{{ number_format($amount + $tax_amount, 2) }} AED</td>
                  </tr>
              @endforeach
            </tbody>
            <tfoot>
                @php
                  $total_tax_amount = (($total_amount + $billing->extra_charges + $billing->gate_fee - $billing->discount) / 100) * 5;
                  $grand_total_amount = ($total_tax_amount + $total_amount + $billing->extra_charges + $billing->gate_fee - $billing->discount);
              @endphp
              <tr>
                 <th colspan="3" >Remarks <br/>
                 {{ $billing->note }}
                 </th>
                <th colspan="3" class="text-end">Total (Excluding VAT)</th>
                <th colspan="2" class="text-end">{{ number_format($total_amount,2) }} AED</th>
              </tr>
              <tr>
                  <th colspan="3" rowspan="{{ 3 + ($billing->extra_charges > 0 ? 1 : 0) + ($billing->gate_fee > 0 ? 1 : 0) }}">Amount in words <br/>
                  {{ amount_to_words($grand_total_amount) }}
                  </th>
                  <th colspan="3" class="text-end">Discount</th>
                  <th colspan="2" class="text-end">- {{ number_format($billing->discount,2) }} AED</th>
              </tr>
              @if($billing->extra_charges)
              <tr>
                  <th colspan="3" class="text-end">Extra Charges</th>
                  <th colspan="2" class="text-end">{{ number_format($billing->extra_charges,2) }} AED</th>
              </tr>
              @endif
              @if($billing->gate_fee)
              <tr>
                  <th colspan="3" class="text-end">Gate Fee</th>
                  <th colspan="2" class="text-end">{{ number_format($billing->gate_fee,2) }} AED</th>
              </tr>
              @endif
              
              
              <tr>
                  <th colspan="3" class="text-end">Vat 5%</th>
                  <th colspan="2" class="text-end">{{ number_format($total_tax_amount,2) }} AED</th>
              </tr>
              <tr>
                  <th colspan="3" class="text-end">Total (Including VAT)</th>
                  <th colspan="2" class="text-end">{{ number_format($grand_total_amount,2) }} AED</th>
              </tr>
              <tr>
                  <th colspan="3"  class="text-center">{{ __('terms_n_conditions') }}</th>
                  <th colspan="5"  class="text-center">{{ __('verified_by') }}</th>
              </tr>
              <tr>
                  <th colspan="3"  class="text-start">
                      @php echo $company->terms_n_conditions; @endphp
                      <!--<ol>-->
                      <!--    <li>Services once provided, has to be paid for.</li>-->
                      <!--    <li>Any discrepancies in the invoice, should be notified to us within 7 days from the date of receipt, else it will be considered as correct.</li>-->
                      <!--    <li>Payment can be made either by an "Account Payee" cheque or remitted to below the mentioned bank account.</li>-->
                      <!--</ol>-->
                      <!--<h3>BANK DETAILS</h3>-->
                      <!--<p class="mb-0"><strong>Account Name:</strong> ARABIAN GREEN WASTE MANAGEMENT LLC</p>-->
                      <!--<p class="mb-0"><strong>Account No:</strong> 100012249115</p>-->
                      <!--<p class="mb-0"><strong>Bank Name:</strong> COMMERCIAL BANK INTERNATIONAL, DUBAI</p>-->
                      <!--<p class="mb-0"><strong>IBAN:</strong> AE110200000100012249115</p>-->
                      <!--<p class="mb-0"><strong>Swift Code:</strong> CLBIAEAD</p>-->
                  </th>
                  <td colspan="5" class="text-center" style="height:200px;">
                      @if(!empty($company->stamp_image_guid))
                        <img src="{{ $isPdf ?  public_path($company->stamp_image_guid) :  asset($company->stamp_image_guid) }}" height="inherit"/>
                    @endif
                  </td>
              </tr>
              <tr>
                  <!--<th colspan="3"  class="text-center">{{ __('thank_you_for_doing_business_with_us') }}</th>-->
                  <th colspan="8"  class="text-center">This is a system-generated invoice and does not require a signature.</th>
              </tr>
            </tfoot>
          </table>
        </div>
    </div>
</div>
<div class="pages">
    <div class="invoice-wrapper">
        <div class="mb-2">
            <img src="{{ $isPdf ? public_path($company->logo_guid) : asset($company->logo_guid) }}" height="50"/>
        </div>
        <!-- Header -->
        <div class="text-center mb-2">
          <div class="invoice-title">Trip Summary</div>
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
                        <th>{{ __('skip_size') }}</th>
                        <th>{{ __('skip_price') }}</th>
                        <th>{{ __('skip_quantity') }}</th>
                        <!--<th>{{ __('extra_charges') }}</th>-->
                    </tr>
                </thead>
                <tbody>
                    @foreach($billing->billing_detail as $cl_key =>  $detail)
                        @php
                        $collection = $detail->collection;
                        @endphp
                    <tr>
                        <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}">{{ \Carbon\Carbon::parse($collection->pickup_date)->format($company->time_format == 1 ? 'Y-m-d H:i' : 'Y-m-d h:i A') }}</td>
                        <td class="align-content-center" rowspan="{{ count($collection->collectionSkips) }}">{{ date_duration($collection->created_at, $collection->pickup_date) }}</td>
                        <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}"><img src="{{ $isPdf ? public_path($collection->before_image_guid): asset($collection->before_image_guid) }}" height="30"/></td>
                        <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}"><img src="{{ $isPdf ? public_path($collection->after_image_guid) : asset($collection->after_image_guid) }}" height="30"/></td>
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
                        <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}">@if(!is_null($collection->signature_guid)) <img src="{{ $isPdf ? public_path($collection->signature_guid) : asset($collection->signature_guid) }}" height="30"/> @else No Signature @endif</td>
                        <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}"> {{ $collection->driver->name }}</td>
                        <td class="align-content-center" rowspan="{{ count($detail->billing_detail_skip) }}"> {{ implode(",",$collection->helpers) }}</td>
                        @foreach($detail->billing_detail_skip as $key => $skip)
                            @if($key != 0)<tr> @endif
                                <td class="align-content-center">{{ $skip->skip_size }}</td>
                                <td class="align-content-center">{{ $skip->skip_price }}</td>
                                <td class="align-content-center">{{ $skip->quantity }}</td>
                                
                                
                                
                            @if($key != 0)</tr> @endif
                        @endforeach
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>