@extends('layouts.master')

@section('title')
    {{ __('role_management') }}
@endsection
@section('css')
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css">
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')

@section('page-title')
    <x-breadcrumb pagetitle="{{ __('role_management') }}" title="" />
@endsection

@section('page-button')
@can('role-create')
<a class="btn btn-info" href="{{ route('roles.create') }}">
    <i class="ph ph-user me-1 align-middle"></i> {{ __('create_new_role') }}
</a>
@endcan
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('roles') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                         <th>No</th>
                         <th>Name</th>
                         <th width="280px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-subtle-secondary btn-sm dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                             @can('role-edit')
                                            <li>
                                                <a class="dropdown-item edit-item-btn" href="{{ route('roles.edit',$role->id) }}">
                                                    <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> {{ __('edit') }}
                                                </a>
                                            </li>
                                            @endcan
                                            @can('role-delete')
                                            <li>
                                                <form method="POST" action="{{ route('roles.destroy',$role->id) }}" style="display:inline;">
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    @csrf
                                                    <button class="dropdown-item edit-item-btn" type="button"  onclick="sa_warning_delete_form_submit(this)">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> {{ __('delete') }}
                                                    </button>
                                                </form>
                                            </li>
                                            @endcan
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