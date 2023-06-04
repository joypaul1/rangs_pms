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

            <div class="card-body">
                <div class="col-6">
                    <form method="post" action="{{ route('pmsConfig.kra.update',$kra->id) }}">
                        @csrf
                        @method("PUT")
                        <div class="mb-3">
                            <label class="form-label" for="name"> Name <strong class="text-danger">*</strong></label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter kra Name..."
                            value="{{ $kra->name }}"
                            required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="note"> Note </label>
                            <input type="text" name="note" class="form-control" id="note" placeholder="Enter note..."
                            value="{{ $kra->note }}"
                            >
                        </div>


                        <div class="b-block text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
                <div class="col-6">
                    <div class="align-baseline">year</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
