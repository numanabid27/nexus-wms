@extends('layouts.master')

@section('title')
    {{ __('users') }}
@endsection
@section('css')
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css">
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')

@section('page-title')
    <x-breadcrumb pagetitle="{{ __('users') }}" title="" />
@endsection

@section('page-button')
<a class="btn btn-info" href="{{ route('users.create') }}">
    <i class="ph ph-user me-1 align-middle"></i> {{ __('create_new_user') }}
</a>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('users') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                <h6 class="text-success fs-sm mb-0">{{ $v }}</h6>
                                @endforeach
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
                                                <a href="{{ route('users.show',$user->id) }}" class="dropdown-item">
                                                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i> {{ __('view') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item edit-item-btn" href="{{ route('users.edit',$user->id) }}">
                                                    <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> {{ __('edit') }}
                                                </a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('users.destroy',$user->id) }}" style="display:inline;">
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

<!--<div class="row">-->
<!--    <div class="col-lg-12 margin-tb">-->
<!--        <div class="pull-left">-->
<!--            <h2>Users Management</h2>-->
<!--        </div>-->
<!--        <div class="pull-right">-->
<!--            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


<!--@if ($message = Session::get('success'))-->
<!--<div class="alert alert-success">-->
<!--  <p>{{ $message }}</p>-->
<!--</div>-->
<!--@endif-->


<!--<table class="table table-bordered">-->
<!-- <tr>-->
<!--   <th>No</th>-->
<!--   <th>Name</th>-->
<!--   <th>Email</th>-->
<!--   <th>Roles</th>-->
<!--   <th width="280px">Action</th>-->
<!-- </tr>-->
<!-- @foreach ($data as $key => $user)-->
<!--  <tr>-->
<!--    <td>{{ ++$i }}</td>-->
<!--    <td>{{ $user->name }}</td>-->
<!--    <td>{{ $user->email }}</td>-->
<!--    <td>-->
<!--      @if(!empty($user->getRoleNames()))-->
<!--        @foreach($user->getRoleNames() as $v)-->
<!--           <label class="badge badge-success">{{ $v }}</label>-->
<!--        @endforeach-->
<!--      @endif-->
<!--    </td>-->
<!--    <td>-->
<!--       <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>-->
<!--       <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>-->
<!--        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}-->
<!--            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}-->
<!--        {!! Form::close() !!}-->
<!--    </td>-->
<!--  </tr>-->
<!-- @endforeach-->
<!--</table>-->


<!--{!! $data->render() !!}-->


<!--<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>-->
@endsection

@section('scripts')



@endsection