
@extends('layouts.app')
@section('page-header')
<i class="menu-icon tf-icons bx bx-message-alt-add" style="margin:0;font-size:30px"></i> User-Role Create
@stop
@section('table_header')
@include('_partials.page_header', [
'fa' => 'list-ul',
'name' => 'User-Role List',
'route' => route('user-role.index')
])
@stop
@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card border-top">
            @yield('table_header')
            <div class="card-body">
                <div class="col-12">
                    <form method="POST" action="{{ route('user-role.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="name" class="col-12 col-form-label text-md-center">{{ __('User') }}</label>
                                <hr>

                                <select name="user_id" id="" class="form-control @error('user_id') is-invalid @enderror"
                                    required>
                                    <option value="{{null}}" hidden>
                                        <-- Select User -->
                                    </option>
                                    @forelse ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                                <label for="name" class="col-12 col-form-label text-md-center">{{ __('All Role')
                                    }}</label>
                                <hr>


                                @forelse ($roles as $role)
                                <div class="form-check form-check-inline col-3">
                                    <input class="form-check-input" type="checkbox" name="role_id[]"
                                        id="checkbox{{$role->id}}" value="{{$role->id}}">
                                    <label class="form-check-label" for="checkbox{{$role->id}}">{{$role->name}}</label>
                                </div>
                                @error('role_id')
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

