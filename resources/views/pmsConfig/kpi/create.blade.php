@extends('layouts.app')
@section('page-header')
<i class="menu-icon tf-icons bx bx-message-alt-add" style="margin:0;font-size:30px"></i> Pms-KRI Create
@stop
@section('table_header')
@include('_partials.page_header', [
'fa' => 'list-ul',
'name' => ' Pms-KPI List',
'route' => route('pmsConfig.kra.index')
])
@stop
@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card border-top">
            @yield('table_header')
            <div class="card">
                <div class="card-header">
                    <input type="text" class="form-control" value="KPI NAME" disabled>
                </div>
                {{-- <h5 class="text-center">
                    Create KPI List <i class="menu-icon tf-icons bx bx-edit-alt"></i>
                </h5> --}}
                {{--
                <hr> --}}
                <div class="card-body">
                    <div class="row" style="border: 1px solid #e9e4e4; padding: 2%;">
                        <div class="col-sm-12 col-md-12 col-lg-6  mb-2">
                            <label class="form-label" for="name"> KPI Text <strong class="text-danger">*</strong></label>
                            <textarea name="name[]" id="" cols="30" rows="5" style="width: 100%;border-color: lightgray;" required></textarea>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 row">
                            <div class="col-sm-12 col-md-12 col-lg-6 mb-2">
                                <label class="form-label" for="target"> Target <strong class="text-danger">*</strong></label>
                                <input type="text" name="target[]" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="target" class="form-control" placeholder="100" required autocomplete="off">
                                <small class="text-danger">{{ $errors->first('target') }}</small>

                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 mb-2">
                                <label class="form-label" for="complite"> Complite <strong class="text-danger">*</strong></label>

                                <input type="text" name="complite[]" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="complite" class="form-control" placeholder="100%" required autocomplete="off">
                                <small class="text-danger">{{ $errors->first('complite') }}</small>

                            </div>
                            <div class="col-sm-12 col-md-12 col-lg- mb-2">
                                <label class="form-label" for="remark"> Any Remark ? </label>

                                <input type="text" name="remark[]" id="remark" class="form-control" placeholder="....." autocomplete="off">
                                <small class="text-danger">{{ $errors->first('remark') }}</small>


                            </div>
                        </div>
                    </div>

                    <div id="kpi_dynamic" style="width:100%"></div>
                    <div class="text-right mt-2">
                        <button type="button" class="btn btn-sm btn-info kpi_add">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger kpi_remove">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
@push('js')
<script>
    $(document).on('click', '.kpi_add', function() {
        let html = `<div class="row mt-1" style="border: 1px solid #e9e4e4; padding: 2%;">
                        <div class="col-sm-12 col-md-12 col-lg-6  mb-2">
                            <label class="form-label" for="name"> KPI Text <strong class="text-danger">*</strong></label>
                            <textarea name="name[]" id="" cols="30" rows="5" style="width: 100%;border-color: lightgray;" required></textarea>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6  row">
                            <div class="col-sm-12 col-md-12 col-lg-6 mb-2">
                                <label class="form-label" for="target"> Target <strong class="text-danger">*</strong></label>
                                <input type="text" name="target[]" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="target" class="form-control" placeholder="100" required autocomplete="off">
                                <small class="text-danger">{{ $errors->first('target') }}</small>

                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 mb-2">
                                <label class="form-label" for="complite"> Complite <strong class="text-danger">*</strong></label>

                                <input type="text" name="complite[]" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="complite" class="form-control" placeholder="100%" required autocomplete="off">
                                <small class="text-danger">{{ $errors->first('complite') }}</small>

                            </div>
                            <div class="col-sm-12 col-md-12 col-lg- mb-2">
                                <label class="form-label" for="remark"> Any Remark ? </label>

                                <input type="text" name="remark[]" id="remark" class="form-control" placeholder="....." autocomplete="off">
                                <small class="text-danger">{{ $errors->first('remark') }}</small>


                            </div>
                        </div>
                    </div>`;
        $('#kpi_dynamic').append(html)
    });

    $(document).on('click', '.kpi_remove', function() {
        let inputName = $(this).closest('.row').find('#kpi_dynamic').find('.mt-1').length;
        if (inputName > 0) {
            $(this).closest('.row').find('#kpi_dynamic').find('.mt-1').last().remove();
        } else {
            let $message = "Can't Delete First One!";
            let $context = 'error';
            let $positionClass = 'toast-top-right';
            toastr.remove();
            toastr[$context]($message, '', {
                positionClass: $positionClass
            });
        }

    });

</script>
@endpush

