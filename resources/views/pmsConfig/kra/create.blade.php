@extends('layouts.app')
@section('page-header')
<i class="menu-icon tf-icons bx bx-message-alt-add" style="margin:0;font-size:30px"></i> Pms-KRA Create
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
            <div class="col-4 align-items-center justify-content-center text-center " style="width:100%; height:100%">
                <strong class="border border-secondary  text-white" style="
                        background: cadetblue;
                        box-shadow: 1px 1px 3px 1px gray;
                    ">Active PMS Year For
                    <br>
                    <span>
                        {{$year->name}}
                    </span>

                </strong>

            </div>
            <div class="card-body row">
                <div class="">

                    <form method="POST" action="{{ route('pmsConfig.kra.store') }}">
                        @csrf
                        <div class=" mb-3">
                            <label class="form-label" for="name"> kRA Name <strong
                                    class="text-danger">*</strong></label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Enter kra Name..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="note"> Note</label>
                            <input type="text" name="note" class="form-control" id="note" placeholder="Enter note...">
                        </div>
                        <input type="hidden" name="pms_year_id" value="{{$year->id}}">
                        {{-- <div class="b-block text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> --}}
                    </form>

                </div>
                <div class="card">
                    <div class="card-body">
                        <h4>
                            Created KPI List
                        </h4>
                        <hr>
                        <div class="row" style="border: 1px solid #e9e4e4; padding: 2%;">

                            <div class="col-sm-12 col-md-12 col-lg-6  mb-2">
                                <label class="form-label" for="name"> KPI Text <strong
                                        class="text-danger">*</strong></label>
                                <textarea name="name[]" id="" cols="30" rows="5"
                                    style="width: 100%;border-color: lightgray;" required></textarea>

                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6  row">

                                <div class="col-sm-12 col-md-12 col-lg-6 mb-2">
                                    <label class="form-label" for="target"> Target <strong
                                            class="text-danger">*</strong></label>

                                    <input type="text" name="target[]"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="target"
                                        class="form-control target" placeholder="100" required autocomplete="off">

                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 mb-2">
                                    <label class="form-label" for="complite"> Complite <strong
                                            class="text-danger">*</strong></label>

                                    <input type="text" name="complite[]"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="complite"
                                        class="form-control complite" placeholder="100%" required autocomplete="off">

                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 mb-2">
                                    <label class="form-label" for="complite"> Any Remark ? </label>

                                    <input type="text" name="remark[]" id="complite" class="form-control complite"
                                        placeholder="....." autocomplete="off">

                                </div>
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

@endsection
