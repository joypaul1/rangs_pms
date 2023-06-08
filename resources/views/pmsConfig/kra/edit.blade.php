@extends('layouts.app')
@section('page-header')
<i class="menu-icon tf-icons bx bx-message-alt-add" style="margin:0;font-size:30px"></i>  Pms-KRA Edit
@stop
@section('table_header')
@include('_partials.page_header', [
'fa' => 'list-ul',
'name' => ' Pms-KRA List',
'route' => route('pmsConfig.kra.index')
])
@stop
@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card border-top">
            @yield('table_header')

            <div class="card-body row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <form method="post" action="{{ route('pmsConfig.kra.update',$kra['ID']) }}">
                        @csrf
                        @method("PUT")
                        <div class="mb-3">
                            <label class="form-label" for="name"> Name <strong class="text-danger">*</strong></label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter kra Name..."
                            value="{{ $kra['PMS_NAME'] }}"
                            required>
                        </div>

                        <div class="b-block text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
                {{-- <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="row col-12 align-items-center justify-content-center text-center "
                        style="width:100%; height:100%">
                        <strong class="border border-secondary  text-white" style="
                            background: cadetblue;
                            box-shadow: 1px 1px 3px 1px gray;
                        "> Created PMS Year For
                            <br>
                            <span>
                                {{$kra->year->name}}
                            </span>

                        </strong>

                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>

@endsection
