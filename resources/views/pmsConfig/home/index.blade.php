@extends('layouts.app')
@include('_partials.delete_alert')
@section('page-header')
<i class="menu-icon tf-icons bx bx-list-ul" style="margin:0;font-size:30px"></i> PMS List
@stop
@section('table_header')
@include('_partials.page_header', [
// 'fa' => 'message-alt-add',
// 'name' => 'Create Pms-KRA',
// 'route' => route('pmsConfig.kpi.create')
])
@stop
@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card border-top">
            @yield('table_header')

            <div class="card-body">
                <div class="table-responsive text-nowrap"">
                    {{-- <table class=" table table-bordered text-center dataTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>User Name</th>
                            <th>KRA</th>
                            <th>Note</th>
                            <th>PMS-Year</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>


                    </tbody>
                    </table> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
