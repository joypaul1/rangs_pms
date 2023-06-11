@extends('layouts.app')
@include('_partials.delete_alert')
@section('page-header')
<i class="menu-icon tf-icons bx bx-list-ul" style="margin:0;font-size:30px"></i> Pms-Year List
@stop
@section('table_header')
@include('_partials.page_header', [
'fa' => 'message-alt-add',
'name' => 'Create Pms-Year',
'route' => route('pmsConfig.year.create')
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
                            <th>Staus</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($years as $key=> $data)
                        <tr>
                            <td>{{ $key+1}}</td>
                            <td>{{ $data->name}}</td>
                            <td class="text-center">
                                @if ( $data->status)
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
                                <a href="{{ route('pmsConfig.year.edit', $data->id) }}"
                                    class="btn btn-sm btn-secondary float-right">
                                    <i class="bx bx-fade-up-hover bx-edit-alt  me-1"></i>
                                </a>
                                <button data-href="{{ route('pmsConfig.year.destroy',$data) }}" type="button"
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
        </div>
    </div>
</div>

@endsection
