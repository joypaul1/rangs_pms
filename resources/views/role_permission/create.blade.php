{{-- <form method="POST" action="{{ route('role-permission.store') }}">
    @csrf

    <div class="row mb-3">

        <div class="col-md-3">
            <label for="name" class="col-12 col-form-label text-md-center">{{ __('Role') }}</label>
            <hr>

            <select name="role_id" id="" class="form-control @error('role_id') is-invalid @enderror" required>
                <option value="{{null}}" hidden>
                    <-- Select Role -->
                </option>
                @forelse ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @empty

                @endforelse

            </select>
            @error('role_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-9">
            <label for="name" class="col-12 col-form-label text-md-center">{{ __('All Permission') }}</label>
            <hr>


            @forelse ($permissions as $permission)
            <div class="form-check form-check-inline col-3">
                <input class="form-check-input" type="checkbox" name="permission_id[]" id="checkbox{{$permission->id}}"
                    value="{{$permission->id}}">
                <label class="form-check-label" for="checkbox{{$permission->id}}">{{$permission->name}}</label>
            </div>
            @error('permission_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @empty

            @endforelse



        </div>
    </div>


    <div class="row mb-0">
        <div class="d-block text-center">
            <button type="submit" class="btn btn-primary">
                {{ __('Submit') }}
            </button>

        </div>
    </div>
</form> --}}


@extends('layouts.app')
@section('page-header')
<i class="menu-icon tf-icons bx bx-message-alt-add" style="margin:0;font-size:30px"></i> Role-Permission Create
@stop
@section('table_header')
@include('_partials.page_header', [
'fa' => 'list-ul',
'name' => 'Role-Permission List',
'route' => route('role-permission.index')
])
@stop
@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card border-top">
            @yield('table_header')
            <div class="card-body">
                <div class="col-12">
                    <form method="POST" action="{{ route('role-permission.store') }}">
                        @csrf

                        <div class="row mb-3">

                            <div class="col-md-3">
                                <label for="name" class="col-12 col-form-label text-md-center">{{ __('Role')
                                    }}</label>
                                <hr>

                                <select name="role_id" id="" class="form-control @error('role_id') is-invalid @enderror"
                                    required>
                                    <option value="{{null}}" hidden>
                                        <-- Select Role -->
                                    </option>
                                    @forelse ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @empty

                                    @endforelse

                                </select>
                                @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-9">
                                <label for="name" class="col-12 col-form-label text-md-center">{{ __('All
                                    Permission') }}</label>
                                <hr>


                                @forelse ($permissions as $permission)
                                <div class="form-check form-check-inline col-3">
                                    <input class="form-check-input" type="checkbox" name="permission_id[]"
                                        id="checkbox{{$permission->id}}" value="{{$permission->id}}">
                                    <label class="form-check-label"
                                        for="checkbox{{$permission->id}}">{{$permission->name}}</label>
                                </div>
                                @error('permission_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @empty

                                @endforelse



                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="d-block text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
