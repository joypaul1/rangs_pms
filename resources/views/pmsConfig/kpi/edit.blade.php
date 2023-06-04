@extends('layouts.app')
@section('page-header')
<i class="menu-icon tf-icons bx bx-message-alt-add" style="margin:0;font-size:30px"></i> Make KPI
@stop
@section('table_header')
@include('_partials.page_header', [
'fa' => 'list-ul',
'name' => ' PMS-KRA List',
'route' => route('pmsConfig.kra.index')
])
@stop
@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card border-top">
            @yield('table_header')

            <div class="card-body row">
                <div class="col-12">

                    <div class="mb-3">
                        <strong class="form-label" for="name">KRI Name</strong>
                        <input type="text" disabled name="name" class="form-control" id="name"
                            placeholder="Enter kra Name..." value="{{ $kra->name }}" required>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4>
                            Created KPI List
                        </h4>
                        <hr>
                        <div class="row" style="
                            border: 1px solid #e9e4e4;
                            padding: 2%;">

                            <div class="col-6 mb-2">
                                <label class="form-label" for="name"> KPI Text <strong
                                        class="text-danger">*</strong></label>
                                <textarea name="name[]" id="" cols="30" rows="5"
                                    style="width: 100%;border-color: lightgray;" required></textarea>

                            </div>
                            <div class="col-6 row">
                                <div class="col-6 mb-2">
                                    <label class="form-label" for="name"> Date <strong
                                            class="text-danger">*</strong></label>
                                    <input type="date" name="date[]" value="{{date('Y-m-d')}}" required
                                        class="form-control">
                                </div>
                                <div class="col-6 mb-2">
                                    <label class="form-label" for="target"> Target <strong
                                            class="text-danger">*</strong></label>

                                    <input type="text" name="target[]"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="target"
                                        class="form-control target" placeholder="100" required autocomplete="off">

                                </div>
                                <div class="col-6 mb-2">
                                    <label class="form-label" for="complite"> Complite <strong
                                            class="text-danger">*</strong></label>

                                    <input type="text" name="complite[]"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="complite"
                                        class="form-control complite" placeholder="100%" required autocomplete="off">

                                </div>
                                <div class="col-6 mb-2">
                                    <label class="form-label" for="complite"> Any Remark ? </label>

                                    <input type="text" name="remark[]" id="complite" class="form-control complite"
                                        placeholder="....." autocomplete="off">

                                </div>
                                {{-- <div class=" justify-content-center"> --}}

                                    {{-- </div> --}}
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-2">
                                    <button type="button" class="btn btn-sm btn-info chief_add">
                                        <i class="menu-icon tf-icons bx bx-message-alt-add"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger chief_remove">
                                        {{-- <box-icon type='solid' name='message-alt-minus'></box-icon> --}}
                                        <i class="menu-icon tf-icons bx bx-minus-circle"></i>

                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="chief_complaints" style="width:100%"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- <div class="col-2">
    <button type="button" class="btn btn-md btn-info chief_add">
        +
    </button>
    <button type="button" class="btn btn-md btn-danger chief_remove">
        -
    </button>
</div> --}}

@endsection
