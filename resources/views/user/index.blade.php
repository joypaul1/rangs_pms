@extends('layouts.app')
@include('_partials.delete_alert')
@section('page-header')
<i class="menu-icon tf-icons bx bx-list-ul" style="margin:0;font-size:30px"></i> User List
@stop
@section('table_header')
@include('_partials.page_header', [
'fa' => 'message-alt-add',
'name' => 'Create User',
'route' => route('user.create')
])
@stop
@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card border-top">
            @yield('table_header')

            <div class="card-body">
                <div class="table-responsive text-nowrap"">
                 <table class=" table table-bordered text-center dataTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Employee ID</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $key=> $data)
                        <tr>
                            <td>{{ $key+1}}</td>
                            <td>{{ $data->name}}</td>
                            <td>{{ $data->user_id}}</td>
                            <td>{{ $data->email}}</td>
                            <td>{{ $data->mobile}}</td>
                            <td>
                                {{-- <form action="{{ route('role-permission.destroy', $data->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('role-permission.edit', $data->id) }}"
                                        class="btn btn-sm btn-secondary float-right">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="submit" class="btn btn-sm btn-danger float-right">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form> --}}
                            </td>
                            @empty

                            @endforelse

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
