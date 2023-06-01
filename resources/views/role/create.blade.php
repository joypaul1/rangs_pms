

@extends('layouts.app')
@section('page-header')
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
