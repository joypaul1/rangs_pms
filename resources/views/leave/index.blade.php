@extends('layouts.app')
@include('_partials.delete_alert')
@section('page-header')
<i class="menu-icon tf-icons bx bx-list-ul" style="margin:0;font-size:30px"></i> Leave Taken List
@stop
@section('table_header')
@include('_partials.page_header', [
// 'fa' => 'message-alt-add',
// 'name' => 'Create Role',
'route' => route('leave.create')
])
@stop
@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card border-top">
            @yield('table_header')

            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead class="table-dark">
                        <tr>
                          <th>SL</th>
                          <th scope="col">Leave Type</th>
                          <th scope="col">To Date</th>
                          <th scope="col">From Date</th>
                          <th scope="col">Remarks</th>
                          <th scope="col">Branch</th>
                          <th scope="col">Approval Status</th>
                        </tr>
                      </thead>
                      <tbody>




                      </tbody>
                    </table>
                  </div>
            </div>
        </div>
    </div>
</div>

@endsection
