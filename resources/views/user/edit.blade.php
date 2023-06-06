@extends('layouts.app')
@section('page-header')
<i class="menu-icon tf-icons bx bx-message-alt-add" style="margin:0;font-size:30px"></i> User Create
@stop
@section('table_header')
@include('_partials.page_header', [
'fa' => 'list-ul',
'name' => 'User List',
'route' => route('user.index')
])
@stop
@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card border-top">
            @yield('table_header')
            <form method="POST" action="{{ route('user.update', $user) }}">
                @csrf
                <div class="card-body row">
                    <div class="col-lg-6">

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $user->name }}" required autofocus>

                                @error('name')
                                <strong class="text-danger">{{ $message }}</strong>

                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Mobile') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('mobile') is-invalid @enderror"
                                    name="mobile" value="{{ $user->mobile }}" required autofocus>

                                @error('mobile')
                                <strong class="text-danger">{{ $message }}</strong>

                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Employee Id')
                                }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('user_id') is-invalid @enderror"
                                    name="user_id" value="{{ $user->user_id }}" required autofocus>

                                @error('user_id')

                                <strong class="text-danger">{{ $message }}</strong>

                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                <strong class="text-danger">{{ $message }}</strong>

                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('New Password')
                                }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <strong class="text-danger">{{ $message }}</strong>

                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm
                                Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                                @error('password_confirmation')
                                <strong class="text-danger">{{ $message }}</strong>

                                @enderror
                            </div>
                        </div>



                    </div>
                    @php
                    $getAllRole = ($user->roles()->pluck('role_id')->toArray());
                    @endphp
                    <div class="col-lg-6">
                        <label for="name" class="col-12 col-form-label text-md-center">{{ __('All Role')
                            }}</label>
                        <hr>

                        @forelse ($roles as $role)
                        <div class="form-check form-check-inline col-12">
                            <input class="form-check-input" type="checkbox" name="role_id[]" id="checkbox{{$role->id}}"
                            @if(in_array($role->id,$getAllRole))
                                @checked(true)
                            @endif
                            value="{{$role->id}}">
                            <label class="form-check-label" for="checkbox{{$role->id}}">{{$role->name}}</label>
                        </div>
                        @error('role_id')
                        <strong class="text-danger">{{ $message }}</strong>

                        @enderror
                        @empty

                        @endforelse
                    </div>
                    <div class="row mb-0">
                        <div class="text-center mx-auto">
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

@endsection
