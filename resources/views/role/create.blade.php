{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Role') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('role.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-1 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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
@endsection --}}

@extends('layouts.app')
@section('page-header')
{{-- <i class="menu-icon tf-icons bx bx-list-ul" style="margin:0;font-size:30px"></i> Role Create --}}
<i class="menu-icon tf-icons bx bx-message-alt-add" style="margin:0;font-size:30px"></i> Role Create
@stop
@section('table_header')
@include('_partials.page_header', [
'fa' => 'list-ul',
'name' => 'Role List',
'route' => route('role.index')
])
@stop
@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card border-top">
            @yield('table_header')

            <div class="card-body">
                <div class="col-6">
                    <div class=" mb-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('role.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="name"> Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Role Name.." required>
                                </div>

                                <div class="b-block text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
