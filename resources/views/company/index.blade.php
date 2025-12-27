@extends('layouts.master')

@section('title')
    {{ __('companies') }}
@endsection
@section('css')


@endsection
@section('content')

@section('page-title')
    <x-breadcrumb pagetitle="{{ __('companies') }}" title="" />
@endsection

@section('page-button')
<a class="btn btn-info" href="{{ route('company.create') }}">
    <i class="ph ph-office me-1 align-middle"></i> {{ __('create_new_company') }}
</a>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('companies') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact Person</th>
                            <th>Contact Number</th>
                            <th>Status</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $company)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td>{{ $company->contact_person_name }}</td>
                                <td>{{ $company->contact_person_number }}</td>
                                <td>
                                    @if($company->is_deleted == 1)
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
                                                <a href="{{ route('company.show',$company->company_id) }}" class="dropdown-item">
                                                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i> {{ __('view') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item edit-item-btn" href="{{ route('company.edit',$company->company_id) }}">
                                                    <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> {{ __('edit') }}
                                                </a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('company.destroy',$company->company_id) }}" style="display:inline;">
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    @csrf
                                                    <button class="dropdown-item edit-item-btn" type="button"  onclick="sa_warning_delete_form_submit(this)">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> {{ __('delete') }}
                                                    </button>
                                                </form>
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