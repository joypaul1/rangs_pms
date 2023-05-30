@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-block" style="text-align: right">
                <a href="{{ route('user.create') }}">
                    <button>Create</button>
                </a>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="card">
                <div class="card-header bg-info text-center">{{ __('User List') }}</div>
                @php
                $sl = 0;
                @endphp
                <div class="card-body">
                    <table class="table">
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
                                <td>{{  $key+1}}</td>
                                <td>{{  $data->name}}</td>
                                <td>{{  $data->user_id}}</td>
                                <td>{{  $data->email}}</td>
                                <td>{{  $data->mobile}}</td>
                                <td>
                                    <form action="{{ route('role-permission.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <a href="{{ route('role-permission.edit', $data->id) }}" class="btn btn-sm btn-secondary float-right">
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
                    </table>

                    {{-- {!! $role_permissions->links() !!} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
