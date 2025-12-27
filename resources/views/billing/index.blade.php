@extends('layouts.master')

@section('title')
    {{ __('billings') }}
@endsection
@section('css')


@endsection
@section('content')

@section('page-title')
    <x-breadcrumb pagetitle="{{ __('billings') }}" title="" />
@endsection

@section('page-button')
@can('billing-create')
<a class="btn btn-info" href="{{ route('billings.create') }}">
    <i class="ph ph-office me-1 align-middle"></i> {{ __('create_new_billing') }}
</a>
@endcan
@endsection

<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __('billings') }}</h5>
                
                <button class="btn btn-primary btn-sm" id="btnDownload">Generate Bulk Invoice</button>
            </div>
            <div class="card-body">
                <hr class="mt-0"/>
                <ul class="nav nav-tabs nav-justified inner-tab mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#nav-badge-home" role="tab" aria-selected="false" tabindex="-1">
                            Generated Bills
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link align-middle" data-bs-toggle="tab" href="#nav-badge-profile" role="tab" aria-selected="false" tabindex="-1">
                            Unpaid Invoices
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link align-middle" data-bs-toggle="tab" href="#nav-badge-messages" role="tab" aria-selected="false" tabindex="-1">
                            Paid Invoices
                        </a>
                    </li>
                </ul>
                <div class="tab-content text-muted">
                    <div class="tab-pane active" id="nav-badge-home" role="tabpanel">
                        <div class="table-responsive">
                    
                            <table class="table notDataTable table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                @include("billing.thead")
                                <tbody>
                                    @if($data->contains('invoice_generated', 0) && $data->contains('is_paid', 0))
                                        @foreach ($data as $key => $bill)
                                            @if($bill->invoice_generated == 0 && $bill->is_paid == 0)
                                                @include("billing.tbody_tr",["bill" => $bill])
                                            @endif
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="13" class="text-center">No Record</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="nav-badge-profile" role="tabpanel">
                        <div class="table-responsive">
                    
                            <table class="table notDataTable table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                @include("billing.thead")
                                <tbody>
                                    @if($data->contains('invoice_generated', 1) && $data->contains('is_paid', 0))
                                        @foreach ($data as $key => $bill)
                                            @if($bill->invoice_generated == 1 && $bill->is_paid == 0)
                                                @include("billing.tbody_tr",["bill" => $bill])
                                            @endif
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="13" class="text-center">No Record</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="nav-badge-messages" role="tabpanel">
                        <div class="table-responsive">
                    
                            <table class="table notDataTable table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                @include("billing.thead")
                                <tbody>
                                    @if($data->contains('invoice_generated', 1) && $data->contains('is_paid', 1))
                                        @foreach ($data as $key => $bill)
                                            @if($bill->invoice_generated == 1 && $bill->is_paid == 1)
                                                @include("billing.tbody_tr",["bill" => $bill])
                                            @endif
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="13" class="text-center">No Record</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>

    $("body").on("change","#bill_all_id",function(){
        $('[name="bill_id[]"]').prop("checked",$(this).prop("checked"))
    })
    $('#btnDownload').on('click', function () {
        const selected = $('input[name="bill_id[]"]:checked').map(function() {
            return $(this).val();
        }).get();
    
        if (selected.length === 0) {
            Toastify({
                text: "Please select at least one bill for invoice.",
                gravity: "center",   // top or bottom
                position: "center",   // left, right or center
                className: "bg-danger"
            }).showToast();
            return;
        }
        
        var _this = $(this);
        
        $(this).prop("disabled",true)
        $(this).addClass("btn-load")
        $(this).prepend('<span class="spinner-border flex-shrink-0" role="status"></span>')
        
        $.ajax({
            url: "{{ route('billings.generate_bulk_invoice_print') }}",
            type: 'POST',
            data: JSON.stringify({ bill_ids: selected  }),
            processData: false,
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            xhrFields: {
                responseType: 'blob'   // <- important for binary
            },
            success: function (blob, status, xhr) {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
    
                // try to get filename from header if available
                const disposition = xhr.getResponseHeader('Content-Disposition');
                let fileName = 'download.zip';
                if (disposition && disposition.indexOf('filename=') !== -1) {
                    fileName = disposition.split('filename=')[1].replace(/"/g, '');
                }
                a.download = fileName;
    
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
                
                Toastify({
                    text: "Bulk Invoice Generated",
                    gravity: "bottom",
                    // top or bottom
                    position: "center",
                    // left, right or center
                    className: "bg-success"
                }).showToast()
            },
            error: function () {
                Toastify({
                    text: "An error occurred.",
                    gravity: "center",   // top or bottom
                    position: "center",   // left, right or center
                    className: "bg-danger"
                }).showToast();
            },
            complete:function(){
                _this.prop("disabled",false)
                _this.removeClass("btn-load")
                _this.find("span").remove()
            }
        });
    });
</script>

@endsection