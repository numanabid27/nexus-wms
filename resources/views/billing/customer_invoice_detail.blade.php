@php
    $customer = $billing->customer_uid->customer;
    $customer_uid = $billing->customer_uid;
@endphp
<div class="row g-lg-4 g-3">
    <table class="table notDataTable table-bordered">
        <tbody>
            <tr>
                <th colspan="4" class="text-center">{{ __('customer_detail') }}</th>
                <th colspan="4" class="text-center">{{ __('invoice_detail') }}</th>
            </tr>
            <tr>
                <th>{{ __("company_name") }}</th>
                <td colspan="3">{{ $customer->company_name }}</td>
                <th>{{ __("invoice_number") }}</th>
                <td colspan="3">{{ $billing->invoice_number }}</td>
            </tr>
            <tr>
                <th>{{ __("customer_id") }}</th>
                <td colspan="3">{{ $customer->client_id }}</td>
                <th>{{ __("invoice_date") }}</th>
                <td colspan="3">{{ !is_null($billing->invoice_generated_date) ? date("d/M/Y", strtotime($billing->invoice_generated_date)) : "N/A" }}</td>
            </tr>
            <tr>
                <th>{{ __("address") }}</th>
                <td colspan="3">{{ $customer->address }}</td>
                <th>{{ __("payment_terms") }}</th>
                <td colspan="3">{{ $company->invoice_due_period }} days</td>
            </tr>
            <tr>
                <th>{{ __("phone_no") }}</th>
                <td colspan="3">{{ $customer->phone_no }}</td>
                <th>{{ __("due_date") }}</th>
                <td colspan="3">{{ !is_null($billing->invoice_generated_date) ? date("d/M/Y",strtotime($billing->invoice_generated_date . ' + '.  (int)$company->invoice_due_period .' days')) : "N/A" }}</td>
            </tr>
            
            <tr>
                <th>{{ __("email") }}</th>
                <td colspan="3">{{ $customer->email }}</td>
                <th>{{ __("tax_registration_number") }}</th>
                <td colspan="3">{{ $customer->tax_registration_number }}</td>
            </tr>
            <tr>
                <th>{{ __("invoice_period") }}</th>
                <td colspan="3">{{ date("M-Y") }}</td>
                <th>{{ __("contact_person") }}</th>
                <td colspan="3">{{ $company->invoice_contact_person }}</td>
            </tr>
            <tr>
                <th>{{ __("po_number") }}</th>
                <td colspan="3">{{ $customer->po_number }}</td>
                <th>{{ __("contact_number") }}</th>
                <td colspan="3">{{ $company->invoice_phone_no }}</td>
            </tr>
            <tr>
                <th>{{ __("skip_location") }}</th>
                <td colspan="3">{{ $customer_uid->skip_location }}</td>
                <th></th>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>