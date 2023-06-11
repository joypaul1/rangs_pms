@extends('layouts.app')
@include('_partials.delete_alert')
@section('page-header')
<i class="menu-icon tf-icons bx bx-list-ul" style="margin:0;font-size:30px"></i> Pms-KRA List
@stop
@section('table_header')
@include('_partials.page_header', [
'fa' => 'message-alt-add',
'name' => 'Create Pms-KRA',
'route' => route('pmsConfig.kra.create')
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
                            <th>Created By </th>
                            <th>Created Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($karData as $key=> $data)

                        <tr>
                            <td>{{ $key+1}}</td>
                            <td>{{ $data['name']}}</td>
                            <td>{{  $data['user_id']}}</td>
                            {{-- <td>{{ $data['emp_name'] . '/ '. $data['user_id']}}</td> --}}
                            <td>{{ $data['created_date']}}</td>
                            <td class="text-center">
                                @if ( $data['status'])
                                <button type="button" class="btn btn-icon btn-primary">
                                    <span class="tf-icons bx-tada  bx bx-check-circle"></span>
                                </button>
                                @else
                                <button type="button" class="btn btn-icon btn-danger">
                                    <span class="tf-icons bx-tada bx bx-x-circle"></span>
                                </button>
                                @endif

                            </td>
                            <td>
                                <a href="{{ route('pmsConfig.kra.edit', $data['id']) }}"
                                    class="btn btn-sm btn-info float-right">
                                    <i class="bx bx-fade-up-hover bx-edit-alt  me-1"></i>
                                </a>
                                <button data-href="{{ route('pmsConfig.kra.destroy', $data['id']) }}" type="button"
                                    class="btn btn-sm btn-danger float-right delete_check">
                                    <i class="bx bx-fade-up-hover bx-trash-alt me-1"></i>

                            </td>

                        </tr>
                        @empty

                        @endforelse

                    </tbody>
                    </table>
                </div>
            </div>
            {{-- {{$karData-> }} --}}
            {{ $karData->links() }}
        </div>
    </div>
</div>

@endsection
