@extends('layouts.master')

@section('title')
    {{ __('customers') }}
@endsection
@section('css')


@endsection
@section('content')

@section('page-title')
    <x-breadcrumb pagetitle="{{ __('customers') }}" title="" />
@endsection

@section('page-button')
<a class="btn btn-info" href="{{ route('customer.create') }}">
    <i class="ph ph-office me-1 align-middle"></i> {{ __('create_new_customer') }}
</a>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('customers') }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>{{ __('company_name') }}</th>
                                <th>{{ __('client_id') }}</th>
                                <th>{{ __('tag_id') }}s</th>
                                <th>{{ __('address') }}</th>
                                <th>{{ __('billing_model') }}</th>
                                <th>{{ __('schedule') }}</th>
                                <th>Status</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $customer)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $customer->company_name }}</td>
                                    <td>{{ $customer->client_id }}</td>
                                    <td>{{ count($customer->customer_uid) }}</td>
                                    <td>{{ $customer->address }}</td>
                                    
                                    
                                    <td>{{ StatusHelper::billing_model($customer->billing_model) }}</td>
                                    <td>{{ StatusHelper::schedules($customer->schedule) }}</td>
                                    <td>
                                        @if($customer->is_deleted == 1)
                                        <span class="badge bg-danger-subtle text-danger">Deleted</span>
                                        @else
                                        <span class="badge bg-success-subtle text-success">Active</span>
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
                                                    <a href="{{ route('customer.show',$customer->id) }}" class="dropdown-item">
                                                        <i class="ri-eye-fill align-bottom me-2 text-muted"></i> {{ __('view') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('billings.index',$customer->id) }}" class="dropdown-item">
                                                        <i class="ri-file-fill align-bottom me-2 text-muted"></i> {{ __('view_bills') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item edit-item-btn" href="{{ route('customer.edit',$customer->id) }}">
                                                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> {{ __('edit') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    @if($customer->is_deleted != 1)
                                                    <form method="POST" action="{{ route('customer.destroy',$customer->id) }}" style="display:inline;">
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        @csrf
                                                        <button class="dropdown-item edit-item-btn" type="button"  onclick="sa_warning_delete_form_submit(this)">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> {{ __('delete') }}
                                                        </button>
                                                    </form>
                                                    @else
                                                    <form method="GET" action="{{ route('customer.active',$customer->id) }}" style="display:inline;">
                                                        <button class="dropdown-item edit-item-btn" type="button"  onclick="sa_warning_delete_form_submit(this,'Are you sure?','Are you sure you want to activate this asset?','Yes, activate it!')">
                                                            <i class="ph-check align-bottom me-2 text-muted"></i> {{ __('activate') }}
                                                        </button>
                                                    </form>
                                                    
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')



@endsection