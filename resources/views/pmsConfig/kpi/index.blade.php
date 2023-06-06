@extends('layouts.app')
@include('_partials.delete_alert')
@section('page-header')
<i class="menu-icon tf-icons bx bx-list-ul" style="margin:0;font-size:30px"></i> Make KRI Wise KPI
@stop
@section('table_header')
@include('_partials.page_header', [
'fa' => 'message-alt-add',
'name' => 'Demo Kpi Form',
'route' => route('pmsConfig.kpi.create')
])
@stop
@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card border-top">
            @yield('table_header')

            <div class="card-body">
                <div class="table-responsive text-nowrap"">
                    <table class=" table table-bordered text-center dataTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Note</th>
                            <th>PMS-Year</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($years as $key=> $data)
                        <tr>
                            <td>{{ $key+1}}</td>
                            <td>{{ $data->name}}</td>
                            <td>{{ $data->note}}</td>
                            <td>{{ $data->activeYear->name}}</td>
                            <td>
                                <a href="{{ route('pmsConfig.kpi.edit', $data->id) }}"
                                    class="btn btn-sm btn-warning float-right">
                                    <i class="bx bx-edit-alt bx-burst bx-border-circle"></i>
                                </a>
                                {{-- <button data-href="{{ route('pmsConfig.kpi.destroy',$data) }}" type="button"
                                    class="btn btn-sm btn-danger float-right delete_check">
                                    <i class="bx bx-fade-up-hover bx-trash-alt me-1"></i> --}}

                            </td>

                        </tr>
                        @empty

                        @endforelse

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
