@extends('layouts.master')

@section('title')
    {{ __('vehicles') }}
@endsection
@section('css')


@endsection
@section('content')

@section('page-title')
    <x-breadcrumb pagetitle="{{ __('vehicles') }}" title="" />
@endsection

@section('page-button')
<a class="btn btn-info" href="{{ route('vehicles.create') }}">
    <i class="ph ph-office me-1 align-middle"></i> {{ __('create_new_vehicle') }}
</a>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('vehicles') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>{{ __('driver') }}</th>
                            <th>{{ __('plate_no') }}</th>
                            <th>{{ __('vehicle_type') }}</th>
                            <th>{{ __('contract_type') }}</th>
                            <th>Status</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $vehicle)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $vehicle->name }}</td>
                                <td>{{ $vehicle->plate_no }}</td>
                                <td>{{ StatusHelper::vehicle_type($vehicle->vehicle_type) }}</td>
                                <td>{{ StatusHelper::vehicle_contract($vehicle->contract_type) }}</td>
                                <td>
                                    @if($vehicle->is_deleted == 1)
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
                                                <a class="dropdown-item edit-item-btn" href="{{ route('vehicles.edit',$vehicle->id) }}">
                                                    <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> {{ __('edit') }}
                                                </a>
                                            </li>
                                            <li>
                                                @if($vehicle->is_deleted != 1)
                                                <form method="POST" action="{{ route('vehicles.destroy',$vehicle->id) }}" style="display:inline;">
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    @csrf
                                                    <button class="dropdown-item edit-item-btn" type="button"  onclick="sa_warning_delete_form_submit(this)">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> {{ __('delete') }}
                                                    </button>
                                                </form>
                                                @else
                                                <form method="GET" action="{{ route('vehicles.active',$vehicle->id) }}" style="display:inline;">
                                                    <button class="dropdown-item edit-item-btn" type="button"  onclick="sa_warning_delete_form_submit(this,'Are you sure?','Are you sure you want to activate this vehicle?','Yes, activate it!')">
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

@endsection

@section('scripts')



@endsection