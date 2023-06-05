{{-- <table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>ALL Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($user_roles as $key=> $data)
        <tr>
            <td>{{ $key+1}}</td>
            <td>{{ $data->name}}</td>
            <td>{{ implode(' , ', $data->roles->pluck('name')->toArray()) }}</td>
            <td>
                <form action="{{ route('user-role.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <a href="{{ route('user-role.edit', $data->id) }}" class="btn btn-sm btn-secondary float-right">
                        <i class="fa fa-edit"></i>
                    </a>
                    <button type="submit" class="btn btn-sm btn-danger float-right">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @empty

        @endforelse


    </tbody>
</table> --}}
@extends('layouts.app')
@include('_partials.delete_alert')
@section('page-header')
<i class="menu-icon tf-icons bx bx-list-ul" style="margin:0;font-size:30px"></i> User-Role List
@stop
@section('table_header')
@include('_partials.page_header', [
'fa' => 'message-alt-add',
'name' => 'Create User-Role',
'route' => route('user-role.create')
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
                            <th>ALL Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($user_roles as $key=> $data)
                        <tr>
                            <td>{{ $key+1}}</td>
                            <td>{{ $data->name}}</td>
                            <td>{{ implode(' , ', $data->roles->pluck('name')->toArray()) }}</td>
                            <td>
                                @if (auth()->user()->can('user-role-edit'))

                                <a href="{{ route('user-role.edit', $data->id) }}"
                                    class="btn btn-sm btn-secondary float-right">
                                    <i class="bx bx-edit-alt me-1"></i>
                                </a>
                                @endif
                                @if (auth()->user()->can('user-role-delete'))

                                <button data-href="{{ route('user-role.destroy',$data) }}" type="button"
                                    class="btn btn-sm btn-danger float-right delete_check">
                                    <i class="bx bx-trash-alt me-1"></i>
                                </button>
                                @endif

                            </td>
                        </tr>
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
