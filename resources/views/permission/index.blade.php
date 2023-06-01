{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-block" style="text-align: right">
                <a href="{{ route('permission.create') }}">
                    <button>Create</button>
                </a>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="card">
                <div class="card-header bg-info text-center">{{ __('Permission List') }}</div>
                @php
                $sl = 0;
                @endphp
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug Name</th>
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
                                    <form action="{{ route('permission.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <a href="{{ route('permission.edit', $data->id) }}"
                                            class="btn btn-sm btn-secondary float-right">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="submit" class="btn btn-sm btn-danger float-right">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                </td>
                            </tr>
                            @empty

                            @endforelse


                        </tbody>
                    </table>
                    <div class="d-flex">
                        {!! $permissions->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
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
                    <table class="table table-bordered text-center">
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
                                    <form action="{{ route('permission.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <a href="{{ route('permission.edit', $data->id) }}"
                                            class="btn btn-sm btn-secondary float-right">
                                            <i class="bx bx-edit-alt me-1"></i>
                                        </a>
                                        <button data-href="{{ route('permission.destroy',$data) }}" type="button"
                                            class="btn btn-sm btn-danger float-right delete_check">
                                            <i class="bx bx-trash-alt me-1"></i>

                                        </button>
                                    </form>
                                </td>
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
