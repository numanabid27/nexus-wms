<tr>
    <td><input type="checkbox" value="{{ $bill->id }}" name="bill_id[]"/></td>
    <td>{{ ++$i }}</td>
    <td>{{ $bill->client_id }}</td>
    <td>{{ $bill->invoice_number }}</td>
    <td>{{ $bill->date_from }}</td>
    <td>{{ $bill->date_to }}</td>
    <td>{{ $bill->name }}</td>
    <td>{{ $bill->generated_date }}</td>
    <td>{{ $bill->extra_charges }}</td>
    <td>{{ $bill->note }}</td>
    <td>
        @if($bill->invoice_generated == 1)
        <span class="badge bg-success-subtle text-success">Yes</span>
        @else
        <span class="badge bg-danger-subtle text-danger">No</span>
        @endif
    </td>
    <td>
        @if($bill->is_paid == 1)
        <span class="badge bg-success-subtle text-success">Yes</span>
        @else
        <span class="badge bg-danger-subtle text-danger">No</span>
        @endif
    </td>
    <td>
        <div class="dropdown d-inline-block">
            <button class="btn btn-subtle-secondary btn-sm dropdown" type="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ri-more-fill align-middle"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a href="{{ route('billings.view',$bill->id) }}" class="dropdown-item">
                        <i class="ri-eye-fill align-bottom me-2 text-muted"></i> {{ __('view') }}
                    </a>
                </li>
                @if(auth()->user()->can('billing-update') && $bill->is_paid == 0)
                <li>
                    <a href="{{ route('billings.edit',$bill->id) }}" class="dropdown-item">
                        <i class="ri-edit-2-fill align-bottom me-2 text-muted"></i> {{ __('edit') }}
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('invoice-paid') && $bill->invoice_generated == 1 && $bill->is_paid == 0)
                <li>
                    <form method="POST" action="{{ route('billings.invoice_paid',$bill->id) }}" style="display:inline;">
                        @csrf
                        <button class="dropdown-item edit-item-btn" type="button"  onclick="sa_warning_delete_form_submit(this,'Bill Paid?','Are you sure this bill is paid? You won\'t be able to revert this!','Yes')">
                            <i class="ri-check-fill align-bottom me-2 text-muted"></i> {{ __('Paid') }}
                        </button>
                    </form>
                </li>
                @endif
            </ul>
        </div>
    </td>
</tr>