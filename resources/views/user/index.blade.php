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
                            <th>ALL Role</th>

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
                            <td>{{ implode(' , ', $data->roles->pluck('name')->toArray()) }}</td>
                            <td>
                                @if (auth()->user()->can('user-edit'))
                                <a href="{{ route('user.edit', $data->id) }}"
                                    class="btn btn-sm btn-secondary float-right">
                                    <i class="bx bx-edit-alt me-1"></i>
                                </a>
                                @endif
                                @if (auth()->user()->can('user-delete'))
                                <button data-href="{{ route('user.destroy',$data) }}" type="button"
                                    class="btn btn-sm btn-danger float-right delete_check">
                                    <i class="bx bx-trash-alt me-1"></i>
                                </button>
                                @endif
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
