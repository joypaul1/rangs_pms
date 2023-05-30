@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create User-Role') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user-role.store') }}">
                        @csrf

                        <div class="row mb-3">

                            <div class="col-md-3">
                                <label for="name" class="col-12 col-form-label text-md-center">{{ __('Role') }}</label>
                                <hr>

                                {{-- <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror --}}
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
