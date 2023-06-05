@extends('layouts.app')
@include('_partials.delete_alert')
@section('page-header')
<i class="menu-icon tf-icons bx bx-list-ul" style="margin:0;font-size:30px"></i> Permission List
@stop
@section('table_header')
@include('_partials.page_header', [
'fa' => 'message-alt-add',
'name' => 'Create Permission',
'route' => route('permission.create')
])
@stop
@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card border-top">
            @yield('table_header')

            <div class="card-body">
                <div class="table-responsive text-nowrap"">
                    <table class=" table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($permissions as $key=> $data)
                        <tr>
                            <td>{{ $key+1}}</td>
                            <td>{{ $data->name}}</td>
                            <td>{{ $data->slug}}</td>
                            <td>
                                @if (auth()->user()->can('role-edit'))
                                <a href="{{ route('permission.edit', $data->id) }}"
                                    class="btn btn-sm btn-secondary float-right">
                                    <i class="bx bx-edit-alt me-1"></i>
                                </a>
                                @endif
                                @if (auth()->user()->can('role-edit'))
                                <button data-href="{{ route('permission.destroy',$data) }}" type="button"
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
                <div class="d-flex">
                    {!! $permissions->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
